<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";
	$condicion = "orden = {$ID} AND mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}'";

	$_guia = $wpdb->get_var("SELECT guia FROM despachos WHERE ".$condicion);

	if( $_fecha == null ){
		$_fecha = "---";
	}

	$HTML = '
		<form id="status_despacho">
			<input type="hidden" id="ID" name="ID" value="'.$ID.'">
			<div class="celdas_1">
				<div class="input_box">
					<label>Gu&iacute;a de Rastreo:</label>
					<input id="guia" name="guia" style="width: 100%;" value="'.$_guia.'">
				</div>
			</div>
			<div class="botonera_container">
				<input type="button" value="Actualizar" name="update" onClick="actualizarGuia()" class="button button-primary button-large" />
			</div>
		</div>
	';


	echo $HTML;
?>