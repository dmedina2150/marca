<?php

	if(!function_exists('HOME')){
	    function HOME(){
	        return get_home_url();
	    }
	}

	if(!function_exists('TEMA')){
	    function TEMA(){
	        return get_template_directory_uri();
	    }
	}

	if(!function_exists('cssPAGE')){
	    function cssPAGE($_page){
	        return '
	        	<link rel="stylesheet" href="'.TEMA().'/css/'.$_page.'.css'.VERSION().'">
				<link rel="stylesheet" href="'.TEMA().'/css/responsive/'.$_page.'.css'.VERSION().'">
				<script src="'.TEMA().'/js/'.$_page.'.js'.VERSION().'"></script>
			';
	    }
	}

	if(!function_exists('VERSION')){
	    function VERSION(){
	        return "?ver=".time();
	    }
	}

	if(!function_exists('comprimir')){
	    function comprimir($HTML){
	        $HTML = str_replace("\t", "", $HTML);
	        $HTML = str_replace("      ", " ", $HTML);
	        $HTML = str_replace("     ", " ", $HTML);
	        $HTML = str_replace("    ", " ", $HTML);
	        $HTML = str_replace("   ", " ", $HTML);
	        $HTML = str_replace("  ", " ", $HTML);
	        return $HTML = str_replace("\n", " ", $HTML);
	    }
	}

	if(!function_exists('getTemplate')){
	    function getTemplate($_plantilla){
	    	$PATH_TEMPLATE = dirname(__DIR__)."/template/email/".$_plantilla;
			return file_get_contents($PATH_TEMPLATE);
	    }
	}

	if(!function_exists('addImgPath')){
	    function addImgPath($HTML){
	    	$PATH = TEMA()."/imgs/mails/";
	    	$PATH = "http://nutriheroes.com.mx/QA/wp-content/themes/kmibox/imgs/mails/";
	    	return str_replace('[IMG_PATH]', $PATH, $HTML);
	    }
	}

	if(!function_exists('MENU')){
	    function MENU($page = ""){
	    	$user = get_user_by( 'id', get_current_user_id() );
	    	$home = HOME();
	    	$salir = wp_logout_url( HOME() );


	    	switch ($page) {
	    		default:
	    			// Aqui va el codigo personalizado
	    			// De ser necesario
	    		break;
	    	}

	        $HTML = '
	        	<nav class="container nav_container"> 
	        		<div class="col-xs-6 col-sm-5 col-md-5 pull-left" >
						<a href="'.$home.'">
							<img src="'.$home.'/img/Image-Header.png" class="img-responsive">
						</a> 
					</div>
			    	<ul class="col-xs-6 col-sm-7 col-md-10 pull-right list-inline list-unstyled headerResponsive" style="padding-right:0px; margin-right: -6%;margin-top: -4%;" >';
			    		if ( is_user_logged_in() ){
			    			$HTML .= '
								<li style="padding-right:0px;padding-left:0px;">
									<a href="'.$home.get_source_url().'/quiero-mi-marca/"">
										<i class="fa fa-plus-circle fa-2x" style="margin-left: -7%;"></i>
										<span style=" font-family: GothanMedium_regular; font-size: 22px;     margin-left: 2%;">
											Quiero mi NutriHeroes
										</span>
									</a>
								</li>
								<li style="padding-right:0px;padding-left:0px;">
									<a href="'.$home.'/perfil/">
										<i class="fa fa-user fa-2x"  style="margin-left: -7%;"></i>
										<span style=" font-family: GothanMedium_regular; font-size: 22px;     margin-left: 3%;">
											Mi perfil
										</span>
									</a>
								</li>
								<li style="padding-right:0px;padding-left:0px;">
									<a href="'.$salir.'">
										<i class="fa fa-close fa-2x"  style="margin-left: -7%;"></i>
										<span style=" font-family: GothanMedium_regular; font-size: 22px;     margin-left: 3%;">
											Salir
										</span>
									</a>
								</li>';
						}else{
			    			$HTML .= '									
								<li>
									<a href="'.$home.'/iniciar-sesion/">
										<i class="fa fa-key fa-2x"  style="margin-left: -7%;"></i>
										<span style=" font-family: GothanMedium_regular; font-size: 22px;     margin-left: 2%;">
											Iniciar Sesión
										</span>
									</a>
								</li>
								<li>
									<a href="'.$home.'/registro/">
										<i class="fa fa-user-plus fa-2x"  style="margin-left: -7%;"></i> 
										<span style=" font-family: GothanMedium_regular; font-size: 22px;     margin-left: 2%;">Registrarse</span>
									</a>
								</li>';
						} $HTML .= '
					</ul>

				</nav>
	        ';
	        return $HTML;
	    }

	    
	}


?>