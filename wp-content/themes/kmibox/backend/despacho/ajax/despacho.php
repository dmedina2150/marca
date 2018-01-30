<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";

	$despachos = $wpdb->get_results("SELECT * FROM despachos WHERE mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}' ORDER BY id DESC");
	$data["data"] = array();
	$ordenes = array();

	foreach ($despachos as $despacho) {

		$item = $wpdb->get_row("SELECT * FROM items_ordenes WHERE id = '{$despacho->sub_orden}' ");
		$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = '{$item->id_producto}' ");
		$user_id = $wpdb->get_var("SELECT cliente FROM ordenes WHERE id = '{$despacho->orden}' ");
		$cliente = get_user_meta($user_id, 'first_name', true)." ".get_user_meta($user_id, 'last_name', true);

		if( $despacho->fecha_entrega == null ){
			$despacho->fecha_entrega = "Cargar Fecha";
		}else{
			$despacho->fecha_entrega = date("d/m/Y", strtotime( $despacho->fecha_entrega ) );
		}

		if( $despacho->guia == "" ){
			$despacho->guia = "Cargar Gu&iacute;a";
		}

		$ordenes[ $despacho->orden ]["fecha_entrega"] = $despacho->fecha_entrega;
		$ordenes[ $despacho->orden ]["guia"] = $despacho->guia;
		$ordenes[ $despacho->orden ]["cliente"] = $cliente;
		$ordenes[ $despacho->orden ]["status"] = $despacho->status;
		$ordenes[ $despacho->orden ]["productos"][] = $producto->nombre.", ".$producto->descripcion.", ".$producto->peso;
		
	}

	foreach ($ordenes as $orden_id => $_data) {
		$_productos = "";
		foreach ($_data["productos"] as $producto) {
			$_productos .= $producto."<br>";
		}
		
		$enviar_correo = "---";

		if( $_data["guia"] != "Cargar Gu&iacute;a" && $_data["fecha_entrega"] != "Cargar Fecha" && $_data["status"] == "Enviada" ){
			$enviar_correo = "
				<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Confirmaci&oacute;n de Envio de Correo' 
	        		data-modulo='despacho' 
	        		data-modal='enviar_correo' 
	        		class='enlace' style='text-align: center;'
	        	>
	        		Enviar Correo
	        	</span>";
		}

		$guia = $_data["guia"];
		$fecha_entrega = $_data["fecha_entrega"];

		if( $_data["status"] != "Recibida" ){
			$guia = "
	        	<div 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Editar Gu&iacute;a de Rastreo' 
	        		data-modulo='despacho' 
	        		data-modal='guia' 
	        		class='enlace' style='text-align: center;'
	        	>
	        		".$_data["guia"]."
	        	</div>";

			$fecha_entrega = "
	        	<div 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Editar Fecha de Env&iacute;o' 
	        		data-modulo='despacho' 
	        		data-modal='fecha_entrega' 
	        		class='enlace' style='text-align: center;'
	        	>
	        		".$_data["fecha_entrega"]."
	        	</div>";

			$_data["status"] = "
	        	<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Editar Status' 
	        		data-modulo='despacho' 
	        		data-modal='editar' 
	        		class='enlace' style='text-align: center;'
	        	>".$_data["status"]."</span>
	        ";
		}

		$data["data"][] = array(
	        $orden_id,
	        $_data["cliente"],
	        $_productos,
	        $guia,
	        $fecha_entrega,
	        $_data["status"],
	        $enviar_correo
	    );
	}

    echo json_encode($data);

?>