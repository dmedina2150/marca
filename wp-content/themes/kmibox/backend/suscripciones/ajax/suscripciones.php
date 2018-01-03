<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$suscripciones = $wpdb->get_results("SELECT * FROM items_ordenes ORDER BY id DESC");

	foreach ($suscripciones as $suscripcion) {

		$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$suscripcion->id_orden}");
		$_meta_cliente = get_user_meta($orden->cliente);

		$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = {$suscripcion->id_producto}");

		$data_suscripcion = unserialize($suscripcion->data);

		$data["data"][] = array(
	        $suscripcion->id,
	        date("d/m/Y", strtotime($orden->fecha_creacion)),
	        $_meta_cliente[ "first_name" ][0]." ".$_meta_cliente[ "last_name" ][0],
	        $producto->nombre,
	        $data_suscripcion[ "tamano" ],
	        $data_suscripcion[ "edad" ],
	        $data_suscripcion[ "presentacion" ],
	        $data_suscripcion[ "plan" ],
	        $suscripcion->status_suscripcion
	    );
	}

    echo json_encode($data);

?>