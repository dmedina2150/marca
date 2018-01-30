<?php 	
	
	if(!function_exists('marca_menu_reportes')){
        function marca_menu_reportes(){

            $opciones_menu_reporte = array(
                array(
                    'title'         =>  'Reportes',
                    'short-title'   =>  'Reportes',
                    'parent'        =>  '',
                    'slug'          =>  'marcas',
                    'access'        =>  'manage_options',
                    'page'          =>  'marcas',
                    'icon'          =>  '',
                    'position'      =>  4,
                ),
                array(
                    'title'         =>  __('Clientes'),
                    'short-title'   =>  __('Clientes'),
                    'parent'        =>  'marcas',
                    'slug'          =>  'clientes',
                    'access'        =>  'manage_options',
                    'page'          =>  'clientes',
                    'icon'          =>  '',
                ),
                array(
                    'title'         =>  __('Marcas'),
                    'short-title'   =>  __('Marcas'),
                    'parent'        =>  'marcas',
                    'slug'          =>  'marcas',
                    'access'        =>  'manage_options',
                    'page'          =>  'marcas',
                    'icon'          =>  '',
                ),
                array(
                    'title'         =>  __('Presentaciones'),
                    'short-title'   =>  __('Presentaciones'),
                    'parent'        =>  'marcas',
                    'slug'          =>  'productos',
                    'access'        =>  'manage_options',
                    'page'          =>  'productos',
                    'icon'          =>  '',
                ),
                array(
                    'title'         =>  __('Suscripciones'),
                    'short-title'   =>  __('Suscripciones'),
                    'parent'        =>  'marcas',
                    'slug'          =>  'suscripciones',
                    'access'        =>  'manage_options',
                    'page'          =>  'suscripciones',
                    'icon'          =>  '',
                ),
                array(
                    'title'         =>  __('Despacho'),
                    'short-title'   =>  __('Despacho'),
                    'parent'        =>  'marcas',
                    'slug'          =>  'despacho',
                    'access'        =>  'manage_options',
                    'page'          =>  'despacho',
                    'icon'          =>  '',
                ),
                array(
                    'title'         =>  __('Tipo de mascotas'),
                    'short-title'   =>  __('Tipo de mascotas'),
                    'parent'        =>  'marcas',
                    'slug'          =>  'tipos',
                    'access'        =>  'manage_options',
                    'page'          =>  'tipos',
                    'icon'          =>  '',
                )
            );

            foreach($opciones_menu_reporte as $opcion){
                if( $opcion['parent'] == '' ){
                    add_menu_page(
                        $opcion['title'],
                        $opcion['short-title'],
                        $opcion['access'],
                        $opcion['slug'],
                        $opcion['page'],
                        $opcion['icon'],
                        $opcion['position']
                    );
                } else{
                    add_submenu_page(
                        $opcion['parent'],
                        $opcion['title'],
                        $opcion['short-title'],
                        $opcion['access'],
                        $opcion['slug'],
                        $opcion['page']
                    );
                }
            }
        }

        add_action('admin_menu','marca_menu_reportes');
    }

    /* Inclucion de paginas */

    if(!function_exists('marcas')){
        function marcas(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/marcas/marcas.php');
        }
    }

    if(!function_exists('productos')){
        function productos(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/productos/productos.php');
        }
    }

    if(!function_exists('despacho')){
        function despacho(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/despacho/reporte_despacho.php');
        }
    }

    if(!function_exists('clientes')){
        function clientes(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/clientes/clientes.php');
        }
    }

    if(!function_exists('suscripciones')){
        function suscripciones(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/suscripciones/suscripciones.php');
        }
    }

    if(!function_exists('tipos')){
        function tipos(){
            include_once( dirname(__DIR__).'/backend/importador.php');
            include_once( dirname(__DIR__).'/backend/tipos/tipos.php');
        }
    }

    if(!function_exists('guardarImg')){

        function guardarImg($path, $_img, $medidas = array( 600, 450) ){
        	$imgx = explode(',', $_img);
			$img = end($imgx);
		    $sImagen = base64_decode($img);
		    if( !file_exists($path) ){ @mkdir($path); }
		    $name = time().".png";
		    $path = $path.$name;
		    @file_put_contents($path, $sImagen);
		    /*$sExt = @mime_content_type( $path );
		    switch( $sExt ) {
		        case 'image/jpeg':
		            $aImage = @imageCreateFromJpeg( $path );
		        break;
		        case 'image/gif':
		            $aImage = @imageCreateFromGif( $path );
		        break;
		        case 'image/png':
		            $aImage = @imageCreateFromPng( $path );
		        break;
		        case 'image/wbmp':
		            $aImage = @imageCreateFromWbmp( $path );
		        break;
		    }
		    $nWidth  = $medidas[0];
		    $nHeight = $medidas[1];
		    $aSize = @getImageSize( $path );
		    if( $aSize[0] > $aSize[1] ){
		        $nHeight = round( ( $aSize[1] * $nWidth ) / $aSize[0] );
		    }else{
		        $nWidth = round( ( $aSize[0] * $nHeight ) / $aSize[1] );
		    }
		    $aThumb = @imageCreateTrueColor( $nWidth, $nHeight );
		    @imageCopyResampled( $aThumb, $aImage, 0, 0, 0, 0, $nWidth, $nHeight, $aSize[0], $aSize[1] );
		    @imagepng( $aThumb, $path );
		    @imageDestroy( $aImage ); 
		    @imageDestroy( $aThumb );*/

		    return $name;
        }

    }

?>