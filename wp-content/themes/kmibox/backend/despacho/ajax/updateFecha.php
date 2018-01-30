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
		$SQL = "UPDATE despachos SET fecha_entrega = '{$fecha}', status = 'Enviada' WHERE ".$condicion;
		$wpdb->query( $SQL );

	    //wp_mail( $email, "Notificación - NutriHeroes", $HTML );
	}

?>