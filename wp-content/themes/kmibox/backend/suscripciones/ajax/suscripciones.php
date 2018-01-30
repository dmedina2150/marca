<?php
    date_default_timezone_set('America/Mexico_City');
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;
	$suscripciones = $wpdb->get_results("SELECT * FROM items_ordenes ORDER BY id DESC");
	$data["data"] = array();
	$ordenes = array();

	foreach ($suscripciones as $suscripcion) {
		$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$suscripcion->id_orden}");
		$_meta_cliente = get_user_meta($orden->cliente);
		$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = {$suscripcion->id_producto}");
		$data_suscripcion = unserialize($suscripcion->data);
		$proximo_cobro = $wpdb->get_var("SELECT fecha_cobro FROM cobros WHERE item_orden = {$suscripcion->id} AND openpay_transaccion_id = '---'");
		if( $proximo_cobro."" == "" ){
			$proximo_cobro = "---";
		}else{
			$proximo_cobro = date("d/m/Y h:i a", strtotime($proximo_cobro));
		}
		$ordenes[ $suscripcion->id_orden ]["fecha_creacion"] = date("d/m/Y", strtotime($orden->fecha_creacion));
		$ordenes[ $suscripcion->id_orden ]["cliente"] = $_meta_cliente[ "first_name" ][0]." ".$_meta_cliente[ "last_name" ][0];
		$ordenes[ $suscripcion->id_orden ]["productos"][] = $suscripcion->cantidad." x ".$producto->nombre." - ".$producto->descripcion." - ".$producto->peso." - ".$data_suscripcion[ "plan" ];
		$ordenes[ $suscripcion->id_orden ]["proximo_cobro"] = $proximo_cobro;
		$ordenes[ $suscripcion->id_orden ]["status"] = $suscripcion->status_suscripcion;
	}

	foreach ($ordenes as $orden_id => $_data) {
		$_productos = "";
		foreach ($_data["productos"] as $producto) {
			$_productos .= $producto."<br>";
		}
		$data["data"][] = array(
	        $orden_id,
	        $_data["fecha_creacion"],
	        $_data["cliente"],
	        $_productos,
	        $_data[ "proximo_cobro" ] ,
	        $_data[ "status" ]
	    );
	}

    echo json_encode($data);

?>