<?php

	if(!function_exists('getTemplate')){
	    function getTemplate($_plantilla){
	    	$PATH_TEMPLATE = dirname(__DIR__)."/template/email/".$_plantilla.".php";
			return file_get_contents($PATH_TEMPLATE);
	    }
	}

	if(!function_exists('addImgPath')){
	    function addImgPath($HTML){
	    	$PATH = TEMA()."/imgs/mails/";
	    	/* TODO: quitar al pasar a produccion */
	    	$PATH = "http://nutriheroes.com.mx/marca/wp-content/themes/kmibox/imgs/mails/";
	    	return str_replace('[IMG_PATH]', $PATH, $HTML);
	    }
	}

	if(!function_exists('generarEmail')){
	    function generarEmail($_plantilla, $_info = array(), $_sub_plantillas = array() ){

	    	$sub_plantillas = array();
	    	foreach ($_sub_plantillas as $key => $plantilla_temp) {
	    		$sub_plantillas[ $key ] = getTemplate($plantilla_temp);
	    	}

	    	$plantilla = getTemplate($_plantilla);
	    	foreach ($_info as $key => $info) {
	    		if( $key == "plantilla" ){
	    			$plantilla = str_replace("[{$info}]", $sub_plantillas[ $info ], $plantilla);
	    		}else{
	    			$plantilla = str_replace("[{$key}]", $info, $plantilla);
	    		}
	    	}
	    	$plantilla = 
	    		getTemplate("generales/header").
	    		$plantilla.
	    		getTemplate("generales/footer");
	    	$plantilla = addImgPath($plantilla);
	    	return $plantilla;
	    }
	}

?>