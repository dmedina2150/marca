<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	global $wpdb;

	extract($_POST);

	$_tamanos = array(
		"Pequeño" => 0,
		"Mediano" => 0,
		"Grande" => 0
	);

	$_edades = array(
		"Cachorro" => 0,
		"Adulto" => 0,
		"Senior" => 0
	);

	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$_planes = array();
	foreach ($data_planes as $plan) {
		$_planes[ $plan->id ] = 0;
	}

	foreach ($tamanos as $key => $value) { $_tamanos[$value] = 1; }
	foreach ($edades as $key => $value) { $_edades[$value] = 1; }
	foreach ($planes as $key => $value) { $_planes[$value] = 1; }

	$img = guardarImg(
		dirname(dirname(dirname(__DIR__)))."/imgs/productos/", 
		$img_producto
	);

	$dataextra = array(
		"img" => $img,
		"origen_1" => $origen_1,
		"origen_2" => $origen_2
	);

	$SQL = "
		INSERT INTO productos VALUES (
			NULL,
			'$nombre',
			'$descripcion',
			'$precio',
			'$peso',
			'$existencia',
			'$marca',
			'".serialize($_tamanos)."',
			'".serialize($_edades)."',
			'---',
			'".serialize($_planes)."',
			'".serialize($dataextra)."',
			'Activo'
		);
	";

	$wpdb->query( $SQL );
?>