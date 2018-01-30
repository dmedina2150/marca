<?php
	
	include( dirname(__DIR__)."/lib/openpay/Openpay.php" );

	function dataOpenpay(){
		$OPENPAY_PRUEBAS = 1;
		$OPENPAY_URL = ( $OPENPAY_PRUEBAS == 1 ) ? "https://sandbox-dashboard.openpay.mx" : "https://dashboard.openpay.mx";

		$MERCHANT_ID = "mbagfbv0xahlop5kxrui";
		$OPENPAY_KEY_SECRET = "sk_b485a174f8d34df3b52e05c7a9d8cb22";
		$OPENPAY_KEY_PUBLIC = "pk_dacadd3820984bf494e0f5c08f361022";

		if( $OPENPAY_PRUEBAS == 1 ){
			$MERCHANT_ID = "mej4n9f1fsisxcpiyfsz";
			$OPENPAY_KEY_SECRET = "sk_684a7f8598784911a42ce52fb9df936f";
			$OPENPAY_KEY_PUBLIC = "pk_3b4f570da912439fab89303ab9f787a1";
		}
		
		return array(
			"OPENPAY_PRUEBAS" => $OPENPAY_PRUEBAS,
			"OPENPAY_URL" => $OPENPAY_URL,
			"MERCHANT_ID" => $MERCHANT_ID,
			"OPENPAY_KEY_SECRET" => $OPENPAY_KEY_SECRET,
			"OPENPAY_KEY_PUBLIC" => $OPENPAY_KEY_PUBLIC
		);
	}

	function get_productos(){
		global $wpdb;
		$_productos = $wpdb->get_results("SELECT * FROM productos WHERE status = 'activo' ");
		$productos = array();
		foreach ($_productos as $producto) {
			$productos[$producto->id] = array(
				"nombre" => $producto->nombre,
				"descripcion" => $producto->descripcion,
				"tamanos" => unserialize($producto->tamanos),
				"edades" => unserialize($producto->edades),
				"precio" => $producto->precio,
				"existencia" => $producto->existencia,
				"peso" => $producto->peso,
				"marca" => $producto->marca,
				"tipo" => $producto->tipo_mascota,
				"planes" => unserialize($producto->planes),
				"dataextra" => unserialize($producto->dataextra)
			);
		}
		return $productos;
	}

	function get_marcas(){
		global $wpdb;
		$_marcas = $wpdb->get_results("SELECT * FROM marcas");
		$marcas = array();
		foreach ($_marcas as $marca) {
			$marcas[$marca->id] = array(
				"nombre" => $marca->nombre,
				"img" => TEMA()."/imgs/marcas/".$marca->img,
				"tipo" => $marca->tipo
			);
		}
		return $marcas;
	}

	function get_planes(){
		global $wpdb;
		$_plans = $wpdb->get_results("SELECT * FROM planes WHERE status = 'Activo' ");
		$plans = array();
		foreach ($_plans as $plan) {
			$plans[$plan->id] = array(
				"nombre" => $plan->plan,
				"meses" => $plan->meses
			);
		}
		return $plans;
	}
	
	function get_plan($nombre){
		global $wpdb;
		$plan = $wpdb->get_var("SELECT id FROM plan WHERE nombre = '{$nombre}'");
		if( $plan != null ){
			return $plan;
		}else{
			return false;
		}
	}

	function crearPedido(){
		date_default_timezone_set('America/Mexico_City');
		if( !isset($_SESSION) ){ session_start(); }
		global $wpdb;
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
	    $CARRITO = unserialize( $_SESSION["CARRITO"] );
	    $hoy = date("Y-m-d H:i:s", time() );
	 	$SQL_PEDIDO = "
	 		INSERT INTO ordenes VALUES (
	 			NULL,
	 			'{$user_id}',
	 			'{$CARRITO["cantidad"]}',
	 			'{$CARRITO["total"]}',
		 		'{$hoy}'
	 		)
	 	";
	 	$wpdb->query( $SQL_PEDIDO );
	 	$orden_id = $wpdb->insert_id;

	 	foreach ($CARRITO["productos"] as $producto) {
	 		if( $producto->producto != "" ){
	 			$data = array(
	 				"tamano" => $producto->tamano,
	 				"edad" => $producto->edad,
	 				"presentacion" => $producto->presentacion,
	 				"plan" => $producto->plan
	 			);
	 			$data = serialize($data);
			 	$SQL_SUB_PEDIDO = "
			 		INSERT INTO items_ordenes VALUES (
			 			NULL,
			 			'{$orden_id}',
			 			'{$producto->producto}',
			 			'{$producto->cantidad}',
			 			'{$data}',
			 			'Activa',
			 			'{$producto->subtotal}',
			 			'{$hoy}',
			 			'{$producto->plan_id}'
			 		)
			 	";

			 	$wpdb->query( $SQL_SUB_PEDIDO );
	 		}
	 	}

	 	return $orden_id;
	}

	function crearCobro($orden_id, $pago_id){
		date_default_timezone_set('America/Mexico_City');
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
		global $wpdb;
		$items = $wpdb->get_results("SELECT * FROM items_ordenes WHERE id_orden = {$orden_id}");
    	foreach ($items as $key => $item) {
    		$SQL = "INSERT INTO cobros VALUES (NULL, {$item->id}, NOW(), '{$pago_id}', 'Pagado', NOW() );";
    		$wpdb->query( $SQL ); 
    		$hoy = date("d", time() );
    		$meses = $wpdb->get_var("SELECT meses FROM planes WHERE id = {$item->plan}");
    		$proximo_cobro = date("Y-m-d H:i:s", strtotime("+".$meses." month"));
    		$SQL = "INSERT INTO cobros VALUES (NULL, {$item->id}, '{$proximo_cobro}', '---', 'Pendiente', NOW() );";
    		$wpdb->query( $SQL ); 
    		for ($i=0; $i < $meses; $i++) { 
    			if( $i == 0 ){ $mes_actual = date("Y-m", time() )."-".$hoy; }else{ $mes_actual = date("Y-m", strtotime("+".$i." month") )."-".$hoy; }
    			$SQL = "INSERT INTO despachos VALUES (NULL, {$user_id}, {$orden_id}, {$item->id}, '{$mes_actual}', 'Pendiente', '', NOW(), NULL );";
    			$wpdb->query( $SQL );
    		}
    	}
	}

	function getOrdenes(){
    	date_default_timezone_set('America/Mexico_City');
		global $wpdb;
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
		$ordenes = $wpdb->get_results("SELECT * FROM ordenes WHERE cliente = ".$user_id);

		return $ordenes;
	}

	function getSuscripciones(){
    	date_default_timezone_set('America/Mexico_City');
		global $wpdb;
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
	    $suscripciones = array();
		$ordenes = $wpdb->get_results("SELECT * FROM ordenes WHERE cliente = ".$user_id);
		foreach ($ordenes as $orden) {
			$planes = $wpdb->get_results("SELECT * FROM items_ordenes WHERE  id_orden = ".$orden->id);
			$suscripciones[ $orden->id ]["cantidad"] = $orden->cantidad;
			foreach ($planes as $plan) {
				$data = unserialize($plan->data);
				$producto = $wpdb->get_row( "SELECT * FROM productos WHERE id=".$plan->id_producto );
				$_data = unserialize( $producto->dataextra );
				$img = TEMA()."/imgs/productos/".$_data["img"];
				$anio = date("Y")."-12-31";
				$entregas = $wpdb->get_results("SELECT * FROM despachos WHERE sub_orden = {$plan->id} AND status = 'Recibida' AND mes <= '{$anio}'");
				$_entregas = array();
				foreach ($entregas as $value) {
					$mes = date( "m", strtotime($value->mes) );
					$_entregas[] = $mes;
				}
				$_entregados_str = "-";
				if( count($_entregas) > 0 ){
					$_entregados_str = implode(",", $_entregas);
				}
				$suscripciones[ $orden->id ]["productos"][] = array(
					"orden" => $plan->id,
					"plan" => $data["plan"],
					"producto" => $plan->id_producto,
					"cantidad" => $plan->cantidad,
					"total" => $plan->total,
					"nombre" => $producto->nombre,
					"img" => $img,
					"status" => $plan->status_suscripcion,
					"entrega" => date("d/m/Y", strtotime($plan->fecha_entrega)),
					"entredagos" => $_entregados_str
				);
			}
		}

		return $suscripciones;
	}

	function getDespachosActivos(){
    	date_default_timezone_set('America/Mexico_City');
    	$mes_actual = date("Y-m", time())."-01";
		$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";
		global $wpdb;
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
	    $suscripciones = array();
		$despachos = $wpdb->get_results("SELECT * FROM despachos WHERE cliente = {$user_id} AND ( mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}' ) ORDER BY id DESC");
		foreach ($despachos as $despacho) {
			$sub_orden = $wpdb->get_row( "SELECT * FROM items_ordenes WHERE id=".$despacho->sub_orden );
			$producto = $wpdb->get_row( "SELECT * FROM productos WHERE id=".$sub_orden->id_producto );
			$_data = unserialize( $producto->dataextra );
			$img = TEMA()."/imgs/productos/".$_data["img"];
			$_despachos[] = array(
				"orden" => $sub_orden->id,
				"nombre" => $producto->nombre,
				"img" => $img,
				"status" => $despacho->status
			);
		}
		return $_despachos;
	}

?>