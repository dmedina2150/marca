<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */ #

wp_enqueue_style( 'home_css', TEMA()."/css/home.css", array(), "1.0.0" );

get_header(); ?>

	<?php echo MENU(); ?>
	<header id="header" class="row">
		<div class="container">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<img src="<?php echo get_home_url(); ?>/img/Image_1.jpg" class="img-responsive" width="75%">
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 text-center">
				<svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 921.96 442.07">
  <defs>
    <style>
      .cls-1 {
        fill: #9de33c;
      }

      .cls-2 {
        fill: #60ba1e;
      }

      .cls-3 {
        fill: #d9f0ba;
      }

      .cls-4, .cls-5, .cls-6 {
        fill: #3d3d3d;
      }

      .cls-5 {
        font-size: 67.18px;
        letter-spacing: 0.03em;
      }

      .cls-5, .cls-6 {
        font-family: GothanMedium_regular, Gotham Medium;
      }

      .cls-6 {
        font-size: 30.14px;
        letter-spacing: 0.03em;
      }
    </style>
  </defs>
  <title>LOGO</title>
  <g>
    <g>
      <path class="cls-1" d="M355.45,141.36V262.63a71.86,71.86,0,1,0,143.72,0V141.36Z"/>
      <path class="cls-2" d="M486.5,137.88H506V276.62s-17.58,66.68-84.65,57.46c17,0,65.19-24.47,65.19-69Z"/>
      <polygon class="cls-2" points="424.18 316.05 501.02 239.2 501.02 179.3 424.39 255.94 424.18 316.05"/>
      <polygon class="cls-2" points="430.62 313.63 355.45 238.47 355.45 179.88 430.42 254.84 430.62 313.63"/>
      <circle class="cls-2" cx="425.24" cy="276.82" r="39.23"/>
      <polygon class="cls-3" points="415.82 309.57 344.23 234.07 344.23 186.87 415.62 253.01 415.82 309.57"/>
      <polygon class="cls-3" points="414.77 311.2 487.98 234.07 487.91 186.87 414.98 254.56 414.77 311.2"/>
      <path class="cls-4" d="M490.67,262.59c0-41.36,0-83.34,0-124.7H341.49v124.7h0a74.59,74.59,0,0,0,149.18,0h-5.47a69.12,69.12,0,0,1-138.24,0h0V243.3l29.65,29.65c0,.12,0,.23,0,.35a39.23,39.23,0,1,0,78.45,0c0-.15,0-.3,0-.45l30.17-30.17v19.92ZM377.3,265.91,347,235.57V192l48,48A39.25,39.25,0,0,0,377.3,265.91ZM400,237.39,347,184.32v-41H485.21v40.34l-53.67,53.67a39.23,39.23,0,0,0-31.51,0Zm54.3,28.43A39.25,39.25,0,0,0,436.6,240l48.61-48.61v43.52Z"/>
      <circle class="cls-3" cx="415.82" cy="273.3" r="33.51"/>
      <rect class="cls-4" x="401.01" y="269.41" width="35.71" height="11.03" transform="translate(693.79 -143.94) rotate(90)"/>
      <rect class="cls-4" x="404.46" y="257.07" width="19.92" height="11.03" transform="translate(828.83 525.17) rotate(-180)"/>
      <g>
        <path class="cls-4" d="M373.08,120.89h89a2.73,2.73,0,0,0,0-5.47h-89a2.73,2.73,0,1,0,0,5.47Z"/>
        <path class="cls-4" d="M427.51,354.22h-19.9a2.73,2.73,0,0,0,0,5.47h19.9a2.73,2.73,0,1,0,0-5.47Z"/>
        <path class="cls-4" d="M503.23,115.43H486.07a2.73,2.73,0,0,0,0,5.47h17.17v148h5.47V115.43Z"/>
        <path class="cls-4" d="M325,268.87h5.47v-148h17.12a2.73,2.73,0,1,0,0-5.47H324.93v5.47h0Z"/>
        <path class="cls-4" d="M391.82,351.58a86.42,86.42,0,0,1-61.38-82.71H325a91.91,91.91,0,0,0,65.34,88,2.7,2.7,0,0,0,3.47-2.59v-.09A2.71,2.71,0,0,0,391.82,351.58Z"/>
        <path class="cls-4" d="M443.25,351.13a2.72,2.72,0,0,0-1.91,2.58v.07a2.7,2.7,0,0,0,3.52,2.58,91.9,91.9,0,0,0,63.83-87.5h-5.48A86.42,86.42,0,0,1,443.25,351.13Z"/>
      </g>
    </g>
    <circle class="cls-4" cx="343.75" cy="80.89" r="4.69"/>
    <circle class="cls-4" cx="487.2" cy="80.89" r="4.69"/>
    <text class="cls-5" transform="translate(76.51 257.07)">NUTRI</text>
    <text class="cls-5" transform="translate(531.79 257.07)">HEROES</text>
    <g>
      <path class="cls-4" d="M825,292.9a5.62,5.62,0,0,0-5.85-4.16c-3.72.37-6,3.92-4.9,9.15.77,3.54,3.47,5.94,5,8.46a3.61,3.61,0,0,1-1.48,5.35,2.58,2.58,0,0,1-3.55-1,3.5,3.5,0,0,1,.11-2.7c.61-1.5-.29-3.82-2.81-2.53-2.13,1.09-2.83,4.78-2,6.93,1.05,3.24,3.75,4.49,7.89,3.43,1.93-.48,5.25-1.84,6.21-4.78.89-2.73,1-4.24-1.59-8s-3.54-4.28-4.6-6.6,1.21-4.8,2.89-3.55c1.42,1,.54,1.88.77,3.43.2,1.28,2,1.77,3.23.7.93-.85,1.21-2.43.76-4.21"/>
      <path class="cls-4" d="M807.53,292.61c-2.68-3.72-5.46-4.83-8.28-5.21-3-.15-4,1.44-4.21,2.36-.24,1.62,2.33,2.87,4.69,4a8.26,8.26,0,0,1,4.43,9.63c0,.13-.08.26-.12.39-1.42,4.13-6.36,9.7-11.1,10.7-4.07.66-8.56,0-9-3.94s3.91-9.63,8.37-10.82c4.8-1.27,4.92-2.33,4.38-3.54-.63-1.41-3.65-2.64-8.63,0a16.39,16.39,0,0,0-6.9,8c-1.33,3.08-2.05,7.24-1,10.23,1.79,5.17,6.41,5.86,11,5.38,6.91-.72,10.81-3.81,15.54-10.41,4.52-6.32,3.21-13.4.87-16.69"/>
      <path class="cls-4" d="M811.89,291.26c2.19-1.59,2.73-5.61.68-6s-3.55,2.16-3.89,3.27c-.71,2.32,1,4.29,3.22,2.7"/>
      <path class="cls-4" d="M804.63,286.39c2.19-.16,4.8-2.26,4.8-4.47s-1.19-2.63-2.23-2.73c-1.53-.15-3.72,1.24-4.65,3.64-.87,2.24-.08,3.72,2.09,3.56"/>
      <path class="cls-4" d="M794.45,286a5.87,5.87,0,0,0,5.16-2.61c1.48-2.46.32-4.71-2.18-5-1.72-.18-4.07,2.3-4.8,4.34s.49,3.15,1.82,3.25"/>
      <path class="cls-4" d="M787.75,292a4.61,4.61,0,0,0,2.68-3.3c.16-1.14.41-3.24-1.13-3.56-1.73-.36-4,.68-4.92,3.86s1.85,3.63,3.37,3"/>
      <path class="cls-4" d="M746.63,291.88a3.36,3.36,0,0,0,2.54-3.94,3.28,3.28,0,0,0-4.25-1.86,3.36,3.36,0,0,0-2.54,3.94,3.28,3.28,0,0,0,4.25,1.86"/>
      <path class="cls-4" d="M736.52,310c.14-1,.13-1.5.59-4.12s1.67-10.05,1.73-13.53c-.3-3.41-2.45-4.78-4.93-4.53-3.52.35-5,3.34-5.93,5.55,0,0-.24-4.44-3.83-5.1-2.68-.49-4-.12-7.4,4.88,0,0,.6-3.15-1.19-4.28s-4.58-.52-4.24,1.06a50.38,50.38,0,0,1-.5,13.89c-.83,8-2.59,9.13-.13,9,2.52.14,4-1.19,4.72-4.77.67-2.57,1.14-8.77,2.93-11.89s3.54-3.58,4.6-2.55,1,3.43.15,8.62c-1,6.19-3.2,10.43-.8,10.33,1.77-.07,4.33-3.46,5.23-9.57,1.14-6.07,1.61-7.28,2.41-8.51,1.24-1.9,4.09-2.39,3.62,1.65-.34,2.85-.65,5.66-1.55,11.81-.79,5,1.59,5.56,3.17,4.91.49-.2,1-.72,1.38-2.84"/>
      <path class="cls-4" d="M777.17,310.15c.13-1,.12-1.57.56-4.28.35-2.55,1.67-10.06,1.73-13.55-.3-3.41-2.45-4.78-4.93-4.53-3.52.35-5,3.34-5.93,5.55,0,0-.24-4.44-3.83-5.1-2.68-.49-4-.12-7.4,4.88,0,0,.6-3.15-1.19-4.28s-4.58-.52-4.24,1.06a50.28,50.28,0,0,1-.5,13.89c-.85,8-2.62,9.19-.14,9,2.7-.07,4.22-1.65,4.74-5.28.6-2.45,1.12-8.25,2.92-11.36s3.54-3.58,4.6-2.55,1,3.43.09,8c-.61,5.71-2.2,10.09.26,10,1.82,0,3.78-3.27,4.25-8.92,1.12-5.77,1.6-7,2.39-8.2,1.24-1.9,4.09-2.39,3.62,1.65-.34,2.85-.64,5.66-1.43,11.79-.4,5.14,1.72,5.93,3.15,5.23.46-.22,1-.78,1.29-3"/>
      <path class="cls-4" d="M745.45,311.54c.29-1.66,2-11.23,2.67-15.24.5-3.16-3.31-2.72-4.72-1.23-1.19,1.26-1.91,3.22-2.49,9.38-.38,5.78-.37,8.39,2.6,8.88,1.22.15,1.68-.25,1.94-1.78"/>
      <path class="cls-4" d="M698.38,281.29a10.64,10.64,0,0,0-.09-1.41,5.17,5.17,0,0,0-.25-1.08,2.91,2.91,0,0,0-2-1.94,2.85,2.85,0,0,0-2.68,1.11,5.82,5.82,0,0,0-1.05,2.76c-.57,3.6-1.38,7.17-2.08,10.76a113.91,113.91,0,0,1-2.63,11.18c-1.24,6.33-2.05,8-2.58,10.57s6.07,4.09,7-.82,2-8.94,2.06-9.87c0,0,4.32,8.58,6.34,10.79,2.37,2.41,5.23,1.71,5.91.12.55-1.38-.16-2.43-2.23-4.84-2.15-2.71-7.31-10.5-7.31-10.5A36,36,0,0,0,707,292.78c1.15-1.22,2.88-3.83,1-5.14a2.83,2.83,0,0,0-1.83-.44,3.67,3.67,0,0,0-1.65.66,28.62,28.62,0,0,0-3.51,2.53c-.84.68-1.69,1.37-2.59,2a10.81,10.81,0,0,1-2.9,1.69c.53-1.74,1-3.49,1.46-5.25a31.83,31.83,0,0,0,1.44-7.55"/>
    </g>
    <text class="cls-6" transform="translate(623.12 309.89)">BY</text>
    <path class="cls-4" d="M459.89,81a14.38,14.38,0,1,0-23.43-12.75l0,.18h-.18c-7-.51-13.61-.73-19.78-.73-7,0-13.63.27-19.78.73h0l-.41,0-.09-.44a14.38,14.38,0,1,0-23.4,13,14.39,14.39,0,1,0,23.46,12.58l0-.41.42,0h0c7,.51,13.61.73,19.78.73,7,0,13.63-.27,19.78-.73h.16v.25A14.39,14.39,0,1,0,459.89,81Zm-9.15,19.82A8.73,8.73,0,0,1,442,92.1a3.11,3.11,0,0,1,.1-.43,3.5,3.5,0,0,0,.17-1.05A3.58,3.58,0,0,0,438.7,87c-7.81.51-15.24.73-22.23.73-7.83,0-15.26-.27-22.23-.73a3.57,3.57,0,0,0-3.56,3.42s0,1,0,1.64a8.73,8.73,0,1,1-13.31-7.42c.43-.26,1.12-.8,1.12-.8a3.56,3.56,0,0,0,.17-5.85,8.2,8.2,0,0,0-.92-.49,8.72,8.72,0,1,1,12.93-7.63c0,.6.05,1.62.05,1.62a3.57,3.57,0,0,0,3.53,3.08c7.81-.51,15.24-.73,22.23-.73,7.83,0,15.26.27,22.23.73A3.58,3.58,0,0,0,442.28,71c0-.32-.11-1.07-.16-1.61a6.63,6.63,0,0,1,.06-1.16,8.72,8.72,0,1,1,12.57,9.4,5.31,5.31,0,0,0-.63.43,3.56,3.56,0,0,0,.16,5.76L456,85.13a8.72,8.72,0,0,1-5.24,15.7Z"/>
  </g>
</svg>

				<h2>El camino de una correcta nutrición</h2>
				<br>
				<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox">
					COMPRAR
				</a>
			</div>
		</div>
	</header>

	<section id='section-comment' class="row text-center ">
		<div class="container ">
			<h3>La mayor red de Asesores de Nutrición para tu mascota, que te envian tu alimento 
				<br class="hidden-sm hidden-xs">
				a tu casa u oficina, sin costo de envío
			</h3>
		</div>
	</section>

	<section id="como-funciona" class="row text-center">
		<div class="container">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<img src="<?php echo get_home_url(); ?>/img/Image-2.svg" class="img-responsive">
				<p>Asesores nutricionales 
					<br class="hidden-sm hidden-xs">
					certificados
				</p>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 border-lateral">  
				<img src="<?php echo get_home_url(); ?>/img/Image-3.svg" class="img-responsive">
				<p>Entregado en tu 
					<br class="hidden-sm hidden-xs">
					casa sin costo adicional
				</p>
		    </div>
		    <div class="col-xs-12 col-sm-4 col-md-4">  
				<img src="<?php echo get_home_url(); ?>/img/Image-4.svg" class="img-responsive">
				<p>Más barato que en una 
					<br class="hidden-sm hidden-xs">
					veterinaria
				</p>

			</div>
		</div>	
	</section>

	<section id="home-opciones" class="row text-center ">		
		<div class="container">
			<img src="<?php echo get_home_url(); ?>/img/Image-5.jpg" class="img-responsive" style="width: 80%;" >
			<label>
				Las mejores marcas <span> TODAS EN UN MISMO LUGAR</span>
			</label>
			<br>
			<p>Puedes escoger la mejor para tu mascota</p>
		</div>
	</section>
 
	<section id="como-consigo-kmibox" class="row text-center">
		<div class="container">
			<h2>¿Cómo funciona Nutriheroes?</h2>
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<span class="marca-circle">1</span>
					<img src="<?php echo get_home_url(); ?>/img/Icon-1.svg" class="img-responsive">
					<p>Escoge la marca y presentaci&oacute;n de tu preferencia</p>
				</div> 
				<div class="col-xs-12 col-sm-4 col-md-4"> 	
					<span class="marca-circle_2">2</span>
					<img src="<?php echo get_home_url(); ?>/img/Icon-2.svg" class="img-responsive">
					<p>Brindale a tu asesor nutricional tu información básica para el envío </p>
				</div>	
				<div class="col-xs-12 col-sm-4 col-md-4"> 
					<span class="marca-circle_2 margin" >3</span>
					<img src="<?php echo get_home_url(); ?>/img/Icon-3.svg" class="img-responsive" >
					<p>Recibe tu orden de compra y realiza tu pago </p>	
				</div> 
			</div>
			<div class="col-xs-12 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4">
				<span class="marca-circle_2">4</span>
				<img src="<?php echo get_home_url(); ?>/img/Icon-4.svg" class="img-responsive" >
				<p>Recibe el producto en tu casa u oficina sin costo adicional</p>
				<div class="col-xs-12 col-sm-12 col-md-12 hidden-xs hidden-md hidden-lg">
				<label>
					"Podrás pagar <b style="color: #000000">en efectivo</b> en miles de tiendas por conveniencia"
				</label>
			</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 hidden-sm">
				<label>
					"Podrás pagar <b style="color: #000000">en efectivo</b> en miles de tiendas por conveniencia"
				</label>
			</div>
		</div>
	</section>

	<section class="row text-center" id="home-dog" style="margin-top: 4%;">
		<div>
			<h4>Un alimento especial para un Compañero especial</h4>
		</div>
		<div id="dog" style="background: url(<?php echo get_home_url(); ?>/img/dog.jpg) no-repeat center center;"></div>
	</section>

	<section id="regalasela-amigo" class="row text-center">
		<div class="container">
			<h2>
				¡Regálasela a un amigo o un familiar!
			</h2>
			<div class="col-sm-12">
				<img src="<?php echo get_home_url(); ?>/img/Box-01.svg" id="regalo" class="img-responsive" >
			</div>
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2">
				<p>
					Regala el alimento nutritivo y necesario que todo amiguito peludo necesita,
					él se nutre y tu amigo o familiar no se preocupa más
				</p>
			</div>
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
				<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" 
					class="btn-kmibox">COMPRAR</a> 
			</div>
		</div>
	</section>
 
	<?php get_template_part( 'template/parts/footer/footer', 'page' ); ?>

<?php get_footer(); ?>


 