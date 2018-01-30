<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";
	$condicion = "orden = {$ID} AND mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}'";

	$_data = $wpdb->get_row("SELECT * FROM despachos WHERE ".$condicion);

	$hoy = strtotime($_data->fecha_entrega);
	$dia_semana_hoy = date("N", $hoy);

	if( $dia_semana_hoy >= 5 ){ $desde = strtotime('+'.(7-$dia_semana_hoy).' day', $hoy); 
	}else{ $desde = strtotime('+1 day', $hoy);  }

	if( $dia_semana_hoy == 1 ){ $hasta = strtotime('+5 day', $hoy);
	}else{ $hasta = strtotime('+7 day', $hoy); }

    $fecha_estimada = date("d/m/Y", $desde)." - ".date("d/m/Y", $hasta);


	$HTML = '
		<form id="status_despacho">
			<input type="hidden" id="ID" name="ID" value="'.$ID.'">
			<div style="margin-bottom: 10px;">
				Esta es la informaci&oacute;n del pedido: 
			</div>
			<div>
				<table cellspacing=0 cellpadding=0 width="100%">
					<tr>
						<td>
							<span style="font-weight: 600;">No de GUIA: </span>
						</td>
						<td style="text-align: right;">
							'.$_data->guia.'
						</td>
					</tr>
					<tr>
						<td>
							<span style="font-weight: 600;">Fecha de Envio: </span>
						</td>
						<td style="text-align: right;">
							'.date("d/m/Y", $hoy).'
						</td>
					</tr>
					<tr>
						<td>
							<span style="font-weight: 600;">Fecha estimada de entrega: </span>
						</td>
						<td style="text-align: right;">
							'.$fecha_estimada.'
						</td>
					</tr>
				</table>
			</div>

			<div class="alerta">
				<span>Advertencia: </span> una vez presione sobre el bot&oacute;n de "<span>Confirmar Env&iacute;o de Correo</span>", 
				se realizar&aacute; el env&iacute;o del correo al cliente con la informaci&oacute;n de rastreo del pedido.
			</div>

			<div class="botonera_container">
				<input type="button" value="Confirmar Env&iacute;o de Correo" name="update" id="btn-enviarCorreo" onClick="enviarCorreo()" class="button button-primary button-large" />
			</div>
		</div>
	';


	echo $HTML;
?>