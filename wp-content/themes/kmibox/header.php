<?php
	include 'pre-header.php';
	setlocale(LC_TIME, "es_MX.UTF-8");
?><!DOCTYPE html>
<html class="">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="<?php echo TEMA(); ?>/imgs/favicon/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?php echo TEMA(); ?>/imgs/favicon/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo TEMA(); ?>/imgs/favicon/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo TEMA(); ?>/imgs/favicon/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo TEMA(); ?>/imgs/favicon/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo TEMA(); ?>/imgs/favicon/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo TEMA(); ?>/imgs/favicon/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo TEMA(); ?>/imgs/favicon/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo TEMA(); ?>/imgs/favicon/apple-touch-icon-152x152.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo TEMA(); ?>/imgs/favicon/apple-touch-icon-180x180.png" />

	<!-- BEGIN Style - Plugins -->
	<link rel="stylesheet" href="<?php echo HOME(); ?>/plugins/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo HOME(); ?>/plugins/fontawesome/css/font-awesome.css">
	<!-- BEGIN Style - Plugins -->
	
	<!-- BEGIN Style -->
  	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/globales.css<?php echo VERSION(); ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive/globales.css<?php echo VERSION(); ?>">

	<link rel="stylesheet" href="<?php echo HOME(); ?>/css/animate.css">
	<link rel="stylesheet" href="<?php echo HOME(); ?>/css/kmibox.css">
	<!-- END Style -->

	<!-- BEGIN Font -->
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<!-- END Font -->
	<link rel="stylesheet" href="<?php echo HOME(); ?>/wp-content/themes/kmibox/assets/css/CaviarDreams.css">
	<link rel="stylesheet" href="<?php echo HOME(); ?>/wp-content/themes/kmibox/assets/css/PoetsenOne.css">
	<link rel="stylesheet" href="<?php echo HOME(); ?>/wp-content/themes/kmibox/assets/css/GothamMediumRegular.css">
	<link rel="stylesheet" href="<?php echo HOME(); ?>/wp-content/themes/kmibox/assets/css/GothamLightRegular.css">

	<script type="text/javascript" src="<?php echo get_home_url(); ?>/plugins/jquery/jquery-3.2.1.min.js"></script>

	<script type="text/javascript"> 
		var TEMA = "<?php echo TEMA(); ?>/"; 
		var HOME = "<?php echo HOME(); ?>/"; 
		var urlbase = "<?php echo HOME(); ?>/";
		var ventana_ancho;
		var ventana_alto;
		var orientacion;
	</script>

	<?php wp_head(); ?>
</head>

<body>
	<div id="content-primary" class="container-fluid">



