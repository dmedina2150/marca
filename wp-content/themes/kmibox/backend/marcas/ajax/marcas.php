<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$marcas = $wpdb->get_results("SELECT * FROM marcas ORDER BY id DESC");

	$data["data"] = array();

	$_tipos = $wpdb->get_results("SELECT * FROM tipo_mascotas");
	$tipos = array();
	foreach ($_tipos as $key => $tipo) {
		$tipos[ $tipo->id ] = $tipo->tipo;
	}

	$data["data"] = array();

	foreach ($marcas as $marca) {

		$img = TEMA()."/imgs/marcas/".$marca->img;

		$data["data"][] = array(
	        $marca->id,
	        "<img class='img_reporte' src='".$img."' />",
	        $marca->nombre,
	        $tipos[ $marca->tipo ],
	        "
	        	<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$marca->id."' 
	        		data-titulo='Editar Marca' 
	        		data-modulo='marcas' 
	        		data-modal='nuevo' 
	        		class='enlace'
	        	>Editar</span><br>
	        	<span onclick='eliminar_marca( jQuery( this ) )' data-id='".$marca->id."' class='enlace'>Eliminar</span><br>
	        "
	    );
	}

    echo json_encode($data);

?>