<?php
	include( dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/wp-load.php" );
	$suscripciones = getSuscripciones();
	$despachos =getDespachosActivos();
	echo json_encode( array(
		"SUSCRPCIONES" => $suscripciones,
		"DESPACHOS" => $despachos
	) );
	exit;
?>