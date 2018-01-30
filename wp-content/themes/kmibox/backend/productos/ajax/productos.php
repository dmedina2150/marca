<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$productos = $wpdb->get_results("SELECT * FROM productos ORDER BY id DESC");
	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$_planes = array();
	foreach ($data_planes as $plan) {
		$_planes[ $plan->id ] = $plan->plan;
	}

	$_tipos = $wpdb->get_results("SELECT * FROM tipo_mascotas");
	$tipos = array();
	foreach ($_tipos as $key => $tipo) {
		$tipos[ $tipo->id ] = $tipo->tipo;
	}

	$_origenes = $wpdb->get_results("SELECT * FROM ciudades_origen");
	$ciudades = array();
	foreach ($_origenes as $origen) {
		$ciudades[ $origen->id ] = $origen->ciudad; 
	}

	$data["data"] = array();

	foreach ($productos as $producto) {

		$dataextra = unserialize( $producto->dataextra );
		$img = TEMA()."/imgs/productos/".$dataextra["img"];

		$tamanos = array();
		foreach (unserialize($producto->tamanos) as $key => $value) {
			if( $value == 1 ){ $tamanos[] = $key; }
		}

		$edades = array();
		foreach (unserialize($producto->edades) as $key => $value) {
			if( $value == 1 ){ $edades[] = $key; }
		}

		$planes = array();
		foreach (unserialize($producto->planes) as $key => $value) {
			if( $value > 0 ){ 
				$planes[] = $_planes[ $key ]; 
			}
		}

		$marca = $wpdb->get_var("SELECT nombre FROM marcas WHERE id = {$producto->marca}");

		if( $producto->existencia == '-1' ){
			$producto->existencia = "Agotado";
		}
		if( $producto->existencia == '0' ){
			$producto->existencia = "Infinita";
		}

		$origenes = array();
		for ($i=1; $i <= 2 ; $i++) { 
			if( $dataextra["origen_".$i] != "" ){
				$origenes[] = $ciudades[ $dataextra["origen_".$i] ];
			}
		}

		$data["data"][] = array(
	        "<img class='img_reporte' src='".$img."' />",
	        $producto->id,
	        $producto->nombre,
	        $producto->descripcion,
	        "$ ".$producto->precio." MXN",
	        $producto->existencia,
	        $producto->peso,
	        $marca,
	        implode("<br>", $origenes ),
	        implode("<br>", $tamanos ),
	        implode("<br>", $edades ),
	        implode("<br>", $planes ),
	        "<div style='text-align: center;'>".$producto->status."</div>",
	        "
	        	<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$producto->id."' 
	        		data-titulo='Editar Producto' 
	        		data-modulo='productos' 
	        		data-modal='nuevo' 
	        		class='enlace'
	        	>Editar</span><br>
	        	<span onclick='eliminar_producto( jQuery( this ) )' data-id='".$producto->id."' class='enlace'>Eliminar</span><br>
	        "
	    );
	}

    echo json_encode($data);

?>