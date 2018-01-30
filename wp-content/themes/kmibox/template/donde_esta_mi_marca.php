<?php
	
	if( count($mis_despachos) > 0 ){
		$HTML .= '
		<section id="tab_3">
			<div class="section_box">

				<div class="selector_container">
					<div class="titulo_selector">Seleccionar Suscripción:</div>
					<select id="selector_despachos" class="selector">'.$opciones.'</select>
				</div>
					
				<div class="carrusel_suscripciones_box">
					<div class="carrusel_suscripciones_container_general">
						<label class="gothan">Selecciona un suscripci&oacute;n</label>
						<div class="carrusel_suscripciones_container slider_despachos">
							'.$carrusel_despachos.'
						</div>
					</div>
					<div class="img_grande">
						<div class="">
							<img id="img_item_2" src="'.$despacho_inicial["img"].'" />
						</div>
					</div>
				</div>
				<div class="form_suscripcion">
					<div>
						<!-- <label class="subtiulo">Estatus del envío</label> -->
						<div class="progress-content">
							<div class="xborder-curvo col-md-12 text-center">
								<div class="row">
									<div id="armada" class="col-xs-12 col-sm-12 col-md-4">
										<img src="'.TEMA().'/imgs/perfil/Box-01.svg" class="img-responsive" >
										<label> 
											<i class="fa fa-check-square-o" aria-hidden="true"></i>
											<i class="fa fa-square-o" aria-hidden="true"></i>  
											Armada
										</label>
									</div>
									<div id="enviada" class="col-xs-12 col-sm-12 col-md-4">
									    <img src="'.TEMA().'/imgs/perfil/Truck-02.svg" class="img-responsive" >
										<label> 
											<i class="fa fa-check-square-o" aria-hidden="true"></i> 
											<i class="fa fa-square-o" aria-hidden="true"></i>  
											Enviada
										</label>
									</div>
									<div id="recibida" class="col-xs-12 col-sm-12 col-md-4">
										<img src="'.TEMA().'/imgs/perfil/Great-03.svg" class="img-responsive" >
										<label> 
											<i class="fa fa-check-square-o" aria-hidden="true"></i> 
											<i class="fa fa-square-o" aria-hidden="true"></i> 
											Recibida
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>';
	}else{
		$HTML .= '
		<section id="tab_3">
			<h1>Usted no tiene suscripciones activas.</h1>
		</section>';
	}
?>