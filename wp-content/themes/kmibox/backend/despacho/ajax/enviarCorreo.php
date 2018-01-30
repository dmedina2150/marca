<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";
	$condicion = "orden = {$ID} AND mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}'";

	$fecha = date("Y-m-d", strtotime( str_replace("/", "-", $fecha) ) );

	$despacho = $wpdb->get_row("SELECT * FROM despachos WHERE ".$condicion);
	 if( $despacho->fecha_entrega != $fecha ){

		// Correo

		$hoy = strtotime($despacho->fecha_entrega);
		$dia_semana_hoy = date("N", $hoy);

		if( $dia_semana_hoy >= 5 ){ $desde = strtotime('+'.(7-$dia_semana_hoy).' day', $hoy); 
		}else{ $desde = strtotime('+1 day', $hoy);  }

		if( $dia_semana_hoy == 1 ){ $hasta = strtotime('+5 day', $hoy);
		}else{ $hasta = strtotime('+7 day', $hoy); }

	    $fecha_estimada = date("d/m/Y", $desde)." - ".date("d/m/Y", $hasta);
	    $metas_user = get_user_meta($despacho->cliente);

	    $email = $wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = {$despacho->cliente}");
	    $nombre = $metas_user[ "first_name" ][0]." ".$metas_user[ "last_name" ][0];

	    $estado = utf8_decode( $wpdb->get_var("SELECT name FROM wp_estados WHERE id = ".$metas_user["dir_estado"][0]) );
	    $municipio = utf8_decode( $wpdb->get_var("SELECT name FROM wp_municipios WHERE id = ".$metas_user["dir_ciudad"][0]) );
	    $direccion = '
			<div> 
				'.$metas_user[ "dir_calle" ][0].', 
				Colonia: '.$metas_user[ "dir_colonia" ][0].', 
				'.$municipio.', 
				'.$estado.', 
				'.$metas_user[ "dir_codigo_postal" ][0].' - M&eacute;xico 
			</div>
	    ';

	    $_planes = $wpdb->get_results("SELECT * FROM planes");
	    $planes = array();
	    foreach ($_planes as $plan) {
	    	$planes[ $plan->id ] = $plan->plan;
	    }

	    $_productos = array();
	    $despachos = $wpdb->get_results("SELECT * FROM despachos WHERE ".$condicion);
	    foreach ($despachos as $data) {
	    	$sub_orden = $wpdb->get_row("SELECT * FROM items_ordenes WHERE id = ".$data->sub_orden);

	    	if( !array_key_exists($sub_orden->id_producto, $_productos) ){
	    		$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = ".$sub_orden->id_producto);
	    		$dataextra = unserialize($producto->dataextra);
	    		$_productos[ $sub_orden->id_producto ] = array(
	    			"nombre" => $producto->nombre,
	    			"descripcion" => $producto->descripcion,
	    			"plan" => $planes[ $sub_orden->plan ],
	    			"precio" => $producto->precio,
	    			"img" => TEMA()."/imgs/productos/".$dataextra["img"],
	    			"cantidad" => 1
		    	);
	    	}else{
	    		$_productos[ $sub_orden->id_producto ]["cantidad"] += 1;
	    	}

	    }
	    
	 	$productos = "";
	 	foreach ($_productos as $producto) {
	 		if( $producto != "" ){
		 		$temp = getTemplate("/compra/envio/partes/producto");
		 		$temp = str_replace("[IMG_PRODUCTO]", $producto["img"], $temp);
		 		$temp = str_replace("[NOMBRE]", $producto["nombre"], $temp);
		 		$temp = str_replace("[DESCRIPCION]", $producto["descripcion"], $temp);
		 		$temp = str_replace("[PLAN]", $producto["plan"], $temp);
		 		$temp = str_replace("[CANTIDAD]", $producto["cantidad"], $temp);
		 		$temp = str_replace("[PRECIO]", number_format($producto["precio"], 2, ',', '.'), $temp);
		 		$productos .= $temp;
		 	}
	 	}

	 	$HTML = generarEmail(
	    	"compra/envio/index", 
	    	array(
	    		"USUARIO" => $nombre,
	    		"DIRECCION" => $direccion,
	    		"FECHA_ESTIMADA" => $fecha_estimada,
	    		"GUIA" => $despacho->guia,
	    		"TOTAL" => number_format($wpdb->get_var("SELECT total FROM ordenes WHERE id = ".$ID), 2, ',', '.'),
	    		"PRODUCTOS" => $productos,
	    	)
	    );

	    wp_mail( $email, "Notificación de Envío - NutriHeroes", $HTML );


	}

?>