<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";

	$SQL = "UPDATE despachos SET guia = '{$guia}' WHERE orden = {$ID} AND mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}';";
	$wpdb->query( $SQL );

?>