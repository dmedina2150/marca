<?php

	$mis_suscripciones = getSuscripciones();

	$mis_despachos = getDespachosActivos();
	$despacho_inicial = array();
	$carrusel_despachos = ""; $W_2 = 0;
	if( count($mis_despachos) > 0 ){
		foreach ($mis_despachos as $despacho) {
			$id_suscripcion = str_pad($despacho["orden"], 5, "0", STR_PAD_LEFT);

			$activo = "";
			if( count($despacho_inicial) == 0 ){
				$despacho_inicial = array(
					"plan" => $despacho["orden"],
					"type" => "{$despacho["nombre"]}",
					"status" => "{$despacho["status"]}",
					"img" => "{$despacho["img"]}"
				);
				$activo = "item_activo";
			}
			$carrusel_despachos .= "
				<div 
					id='plan_{$id_suscripcion}' 
					data-nombre='{$despacho["nombre"]}'
					data-status='{$despacho["status"]}'
					data-img='{$despacho["img"]}'
					class='suscripcion_item {$activo} slide' 
					data-scale='small' 
					data-position='top'
				>
					<div>
						<div class='item_carrusel_orden'> <strong>Orden:</strong> {$id_suscripcion} </div>
						<div class='item_carrusel_img' style='background-image: url({$despacho["img"]});'></div>
						<div class='item_carrusel_total'>
							{$despacho["nombre"]}
						</div>
					</div>
				</div>
			";
			$W_2++;
		}
	}

	
	$ordenes = getOrdenes();

/*	echo "<pre>";
		print_r($ordenes);
	echo "</pre>";*/

	$opciones = "";
	foreach ($ordenes as $key => $value) {
		$opciones .= "<option value={$value->id}>Orden: {$value->id}</option>";
	}

	if( count($mis_suscripciones) > 0 ){
		$HTML .= '
			<section id="tab_2" class="section_activo">
				<div class="section_box">

					<div class="selector_container">
						<div class="titulo_selector">Seleccionar Suscripción:</div>
						<select id="selector_suscripcion" class="selector">'.$opciones.'</select>
					</div>

					<div class="carrusel_suscripciones_box">
						<div class="carrusel_suscripciones_container_general">
							<label class="gothan">Productos de tu suscripci&oacute;n</label>
							<div class="carrusel_suscripciones_container slider_suscripciones"></div>
						</div>
						<div class="img_grande">
							<div class="">
								<img id="img_item" src="'.$inicial["img"].'" />
							</div>
						</div>
					</div>
					<div class="form_suscripcion">
						<div class="celda_4" style="margin-bottom: 0px;">
							<div class="">
								<label>Tipo de suscripción</label>
							    <input readonly id="tipo_suscripcion" class="profile-content-input form-control"  value="'.$inicial["plan"].'">
							</div>
							<div class="">
								<label>Tipo de Alimento</label>
								<input readonly id="presentacion" class="profile-content-input form-control"  value="'.$inicial["type"].'">				
							</div>
							<div class="">
								<label>Estatus</label>
								<input readonly id="status" class="profile-content-input form-control"  value="'.$inicial["status"].'">
							</div>
							<div class="">
								<label>Proxima entrega</label>
								<input readonly id="entrega" class="profile-content-input form-control"  value="'.$inicial["entrega"].'">
							</div>
						</div>
						<div>
							<label class="subtiulo">Entregas realizadas</label>
							<div class="celda_6 entregas">
								<div><span id="mes_01"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Enero</label></div> 
								<div><span id="mes_02"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Febrero</label></div>
								<div><span id="mes_03"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Marzo</label></div>
								<div><span id="mes_04"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Abril</label></div>
								<div><span id="mes_05"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Mayo</label></div>
								<div><span id="mes_06"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Junio</label></div>
							</div>
							<div class="celda_6 entregas">
								<div><span id="mes_07"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Julio</label></div> 
								<div><span id="mes_08"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Agosto</label></div>
								<div><span id="mes_09"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Septiembre</label></div>
								<div><span id="mes_10"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Octubre</label></div>
								<div><span id="mes_11"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Noviembre</label></div>
								<div><span id="mes_12"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Diciembre</label></div>			
							</div>
						</div>
					</div>
				</div>
			</section>';
		}else{
			$HTML .= '
			<section id="tab_2" class="section_activo">
				<h1>Usted no tiene suscripciones.</h1>
			</section>';
		}
?>