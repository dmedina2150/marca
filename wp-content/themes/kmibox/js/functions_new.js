var CARRITO = [];
CARRITO["cantidad"] = 0;
CARRITO["productos"] = [];
CARRITO["productos"].push({
	"tamano": "",
	"edad": "",
	"plan": "",
	"plan_id": "",
	"cantidad": 1,
	"precio": 0.00,
	"subtotal": 0.00
});


var PRODUCTOS = [];
var MARCAS = [];
var PLANES = [];

jQuery(document).ready(function() {

	if(navigator.platform.substr(0, 2) == 'iP'){
		jQuery("body").addClass('iOS');
	}

	jQuery('.carrousel-items').on('click', 'article', function(){
		var index = jQuery(this).index() + 1; 
		if( index ==  1 ){
			jQuery(".carrousel-items article:last").insertBefore( jQuery(".carrousel-items article:first") );
		}
		if( index == jQuery('.carrousel-items article').length ){
			jQuery(".carrousel-items article:first").insertAfter( jQuery(".carrousel-items article:last") );
		}
		var prod_actual = getCarritoActual();
		prod_actual["tamano"] = jQuery(".carrousel-items article:nth-child(2)").attr("data-value");
	});
	jQuery('.tamano-list').on('click', 'li', function(){
		jQuery('.tamano-list li').removeClass('selected');
		jQuery(this).addClass('selected');
	});
	jQuery("#edad span").on("click", function(e){
		jQuery("#edad span").removeClass("btn_activo");
		jQuery(this).addClass("btn_activo");
		var prod_actual = getCarritoActual();
		prod_actual["edad"] = jQuery(this).attr("data-value");
		jQuery("#descripcion_producto").html( "RAZA "+prod_actual["tamano"]+" "+prod_actual["edad"]+" <span><span>" );
		change_fase(2);
	});

	jQuery("#marca_select").on("click", function(e){
		if( !jQuery(this).hasClass("btn-disable") ){
			change_fase(3);
		}
	});

	jQuery("#presentacion_select").on("click", function(e){
		if( !jQuery(this).hasClass("btn-disable") ){
			change_fase(4);
		}
	});

	jQuery("#plan article").on("click", function(e){
		var prod_actual = getCarritoActual();
		prod_actual["plan"] = PLANES[ jQuery(this).attr("data-value") ].nombre;
		prod_actual["plan_id"] = jQuery(this).attr("data-value");
		jQuery("#plan article").removeClass("plan_activo");
		jQuery(this).addClass("plan_activo");
		change_fase(5);
	});

	jQuery("#vlz_atras").on("click", function(e){
		change_fase( jQuery(this).attr("data-value") );
	});

	jQuery("#tipo_mascota").on("change", function(e){
		var TIPO = jQuery(this).val();
		jQuery('#marca > div').css("display", "none");
		jQuery('#marca > .tipo_'+TIPO).css("display", "block");

		jQuery('#cant_marcas').html( jQuery('#marca > .tipo_'+TIPO).length );

	});

	jQuery("#agregar_plan").on("click", function(e){
		e.preventDefault();
		CARRITO["productos"].push({
			"tamano": "",
			"edad": "",
			"plan": "",
			"plan_id": "",
			"cantidad": 1,
			"precio": 0.00,
			"subtotal": 0.00
		});
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"] = undefined;
		jQuery("button").removeClass("vlz_activo");
		change_fase( 1 );
	});
	jQuery("#pagar").on("click", function(e){
		e.preventDefault();
		var _json = get_json_cart();
		jQuery.post(
			TEMA+"assets/ajax/carrito.php", {
				CART: _json
			},
			function(data){
				location.href = HOME+"/pagar-mi-marca";
			}, "json"
		).fail(function(e) {
			console.log( e );
	  	});
	});
	jQuery("#tienda").on("click", function(e){
		e.preventDefault();
		var _json = get_json_cart();
		jQuery.post(
			TEMA+"assets/ajax/carrito.php", {
				CART: _json
			},
			function(data){
				location.href = HOME+"/pago-tienda";
			}, "json"
		).fail(function(e) {
			console.log( e );
	  	});
		
	});
	initProductos_y_Planes();
	change_fase(1);

});

function get_json_cart(){
	var _json = JSON.stringify( CARRITO["total"] )+"===";
	_json += JSON.stringify( CARRITO["cantidad"] )+"===";
	jQuery.each(CARRITO["productos"],  function(key, producto){
		_json += JSON.stringify( producto )+"|";
	});
	return _json;
}

function initProductos_y_Planes(){
	jQuery.post(
		TEMA+"assets/ajax/productos_planes.php", {},
		function(data){
			PRODUCTOS = data["PRODUCTOS"];
			MARCAS = data["MARCAS"];
			PLANES = data["PLANES"];
		}, "json"
	).fail(function(e) {
		console.log( e );
  	});
}

function change_fase(fase){
	jQuery("#vlz_controles_fases span").removeClass("fase_activa");
	jQuery("#fase_indicador_"+fase).addClass("fase_activa");
	jQuery(".comprar_container section").addClass("hidden");
	jQuery("#fase_"+fase).addClass("bounceInRight animated");
	jQuery("#fase_"+fase).removeClass('hidden');
	if( fase > 0 ){
		jQuery("#vlz_atras").attr("data-value", fase-1);
	}else{
		location.href = HOME;
	}
	loadFase(fase);
}

function loadMarcas(){
	var prod_actual = getCarritoActual();
	var actual_select = prod_actual["producto"];
	jQuery('#marca').html("");
	var CANT = 0;
	jQuery.each(MARCAS,  function(key, marca){
		/*jQuery.each(PRODUCTOS,  function(key_2, producto){
			if( key == producto.marca ){
				if( producto.tamanos[ prod_actual["tamano"] ] == 1 ){
					if( producto.edades[ prod_actual["edad"] ] == 1 ){

						jQuery('#marca').append(
							'<div id="item_'+key+'" data-id="'+key+'" data-name="'+marca.nombre+'" class="tipo_'+marca.tipo+'">'+
								'<div class="item_box">'+
									'<div class="img_box" style="background-image: url('+marca.img+');"></div>'+
								'</div>'+
							'</div>'
						);
						CANT++;
					}
				}
			}
		});*/

		jQuery('#marca').append(
			'<div id="item_'+key+'" data-id="'+key+'" data-name="'+marca.nombre+'" class="tipo_'+marca.tipo+'">'+
				'<div class="item_box">'+
					'<div class="img_box" style="background-image: url('+marca.img+');"></div>'+
				'</div>'+
			'</div>'
		);
		CANT++;
	});

	jQuery('#cant_marcas').html( CANT );	
}

function initMarcas(){
	jQuery("#marca > div").on("click", function(e){ 
		var prod_actual = getCarritoActual();
		prod_actual["marca"] = jQuery(this).attr("data-id");
		jQuery("#marca > div").removeClass("item_activo");
		jQuery(this).addClass("item_activo");
		jQuery("#marca_select").removeClass("btn-disable");
	});
	jQuery("#tipo_mascota").change();
}

function loadPresentaciones(){
	jQuery('#presentaciones').html("");
	var CANT = 0;
	var prod_actual = getCarritoActual();
	jQuery.each(PRODUCTOS,  function(key, producto){
		if( prod_actual["marca"] == producto.marca ){
			if( producto.tamanos[ prod_actual["tamano"] ] == 1 ){
				if( producto.edades[ prod_actual["edad"] ] == 1 ){

					var existencia = "";
					if( producto.existencia == -1 ){
						existencia = "Agotado";
					}

					HTML = '<div id="item_'+key+'" data-id="'+key+'" data-name="'+producto.nombre+'">'+
							'<div class="item_box">'+
								'<div class="img_box" style="background-image: url('+TEMA+"/imgs/productos/"+producto.dataextra.img+');"></div>'+
								'<div class="info_producto_container">'+
									'<div class="title_producto_box">'+producto.nombre+'</div>'+
									'<div class="descripcion_producto_box">'+producto.descripcion+'</div>'+
									'<div class="peso_producto_box">'+producto.peso+'</div>'+
									'<div class="existencia_producto_box">'+existencia+'</div>'+
									'<div class="title_producto_box">'+FN(producto.precio)+" MXN"+'</div>'+
								'</div>'+
							'</div>'+
						'</div>';
					jQuery('#presentaciones').append( HTML );
					CANT++;
				}
			}
		}
	});
	jQuery('#cant_precentaciones').html( CANT );	
}

function initPresentaciones(){
	jQuery("#presentaciones > div").on("click", function(e){
		var prod_actual = getCarritoActual();
		prod_actual["producto"] = jQuery(this).attr("data-id");
		prod_actual["precio"] = PRODUCTOS[ jQuery(this).attr("data-id") ].precio;
		jQuery("#presentaciones > div").removeClass("item_activo");
		jQuery(this).addClass("item_activo");
		jQuery("#presentacion_select").removeClass("btn-disable");
	});
}

function change_title(txt){
	jQuery("#vlz_titulo").html(txt);
}

function add_item_cart( index, ID, name, frecuencia, thumnbnail, price, descripcion, peso, cantidad = 1 ){
	var HTML = "";
	HTML += '<tr>';
	HTML += '	 <td class="solo_pc">';
	HTML += '	 	<span onClick="eliminarProducto('+index+')" style="display: inline-block; padding-left: 10px;">';
	HTML += '	 		<i class="fa fa-close"></i> <span class="hidden-sm hidden-md hidden-lg hidden-xs">Remover</span>';
	HTML += '	 	</span>';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_movil" style="text-align: center;">';
	HTML += '	 	<span onClick="eliminarProducto('+index+')" style="margin-right: 10px;">';
	HTML += '	 		<i class="fa fa-close"></i> <span class="hidden-sm hidden-md hidden-lg hidden-xs">Remover</span>';
	HTML += '	 	</span>';
	HTML += '	 	<img src="'+thumnbnail+'"  height="60px">';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc" style="text-align: center;">';
	HTML += '	 	<img src="'+thumnbnail+'"  height="60px">';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label> <div class="resaltar_desglose">'+name+'</div> <div class="cart_descripcion">'+descripcion+' </div> <div class="">'+peso+' </div></label>';
	HTML += '	 	<label class="resaltar_desglose solo_movil">'+frecuencia+'</label>';
	HTML += '	 	<label class="solo_movil">$ '+price+' MXN</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc center">';
	HTML += '	 	<label class="resaltar_desglose">'+frecuencia+'</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc center">';
	HTML += '	 	<label>$ '+price+' MXN</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<div class="cantidad_controls">';
	HTML += '	 		<i class="fa fa-minus-circle menos" onclick="menos_cantidad('+index+')"></i>';
	HTML += '	 			<label id="cant_'+index+'"> '+cantidad+' </label>';
	HTML += '	 		<i class="fa fa-plus-circle mas" onclick="mas_cantidad('+index+')"></i>';
	HTML += '	 	</div>';
	HTML += '	 	<div class="resaltar_desglose solo_movil total_en_cantidad" style="text-align: center; width: 100%;">$ '+(price*cantidad)+' MXN</div>';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc center">';
	HTML += '	 	<label class="resaltar_desglose">$ '+(price*cantidad)+' MXN</label>';
	HTML += '	 </td>';
	HTML += '</tr>';
	HTML += '<tr>';
	HTML += '	 <td colspan=7 class="separador">';
	HTML += '	 	<hr>';
	HTML += '	 </td>';
	HTML += '</tr>';
	jQuery( '#cart-items' ).append(HTML);
}

function loadFase(fase){

	if( parseInt(fase) == 4 ){
		jQuery("#vlz_titulo").addClass("titulo_planes");
	}else{
		jQuery("#vlz_titulo").removeClass("titulo_planes");
	}

	switch( fase ){
		case "1":
			change_title('Elije el tamaño de tu mascota');
		break;
		case 1: // Fase #1 - Tamaño
			change_title('Elije el tamaño de tu mascota');
			
			var prod_actual = getCarritoActual();
			prod_actual["tamano"] = jQuery(".carrousel-items article:nth-child(2)").attr("data-value");
		break;


		case "2":
			change_title('Escoge la marca de tu preferencia');
			
			var prod_actual = getCarritoActual();
			prod_actual["tamano"] = jQuery(".carrousel-items article:nth-child(2)").attr("data-value");

		break;
		case 2: // Fase #2 - Producto

			change_title('Escoge la marca de tu preferencia');
			loadMarcas();
			initMarcas();

		break;

		case "3":
			change_title('Selecciona la presentaci&oacute;n del alimento');
		break;
		case 3: // Fase #3 - Presentación
			change_title('Selecciona la presentaci&oacute;n del alimento');
			
			loadPresentaciones();
			initPresentaciones();

		break;
		case "4":
			change_title('Selecciona el tiempo de suscripción');
		break;
		case 4: // Fase #4 - Plan
			change_title('Selecciona el tiempo de suscripción');
			jQuery("#plan article").css("display", "none");
			var actual = getCarritoActual();
			jQuery.each(PRODUCTOS[ actual["producto"] ]["planes"],  function(key, val){
				if( val == 1 ){
					jQuery( "#plan-"+PLANES[ key ].nombre ).css("display", "inline-block");
				}
			});
		break;

		case "5":
			change_title('Verifica tu compra');
		break;
		case 5: // Fase #5 - Resumen de Compra
			change_title('Verifica tu compra');
			var subtotal = 0;
			var iva = 0;
			var total = 0;
			var cant_item = 0;
			jQuery( '#cart-items' ).html("");
			var precio = 0;
			jQuery.each( CARRITO["productos"],  function(key, producto){
				var plan = PLANES[ producto['plan_id'] ].meses;
				var _producto = producto["producto"];
				var precio_plan = producto["precio"]*plan;
				precio = precio_plan;
				add_item_cart(
					key,
					producto["producto"],
					PRODUCTOS[ _producto ].nombre,
					producto['plan'],
					TEMA+"/imgs/productos/"+PRODUCTOS[ producto["producto"] ].dataextra.img,
					precio_plan,
					PRODUCTOS[ _producto ].descripcion,
					PRODUCTOS[ _producto ].peso,
					producto["cantidad"]								
				);
				var temp_total = ( precio_plan * producto["cantidad"] );
				CARRITO["productos"][key]["subtotal"] = temp_total;
				subtotal += temp_total;
				cant_item += parseInt( producto["cantidad"] );
			});
			iva = subtotal * 0.12;
			subtotal= subtotal - iva;
			total = subtotal + iva;
			jQuery('#cant-item').html(cant_item);
			jQuery('#subtotal').html( FN(subtotal)+" MXN" );
			jQuery('#iva').html( FN(iva)+" MXN" );
			jQuery('#total').html( FN(total)+" MXN" );
			jQuery('#precio').html( FN(precio)+" MXN" );
			jQuery('#precio1').html( FN(precio)+" MXN" );
			jQuery('#precio2').html( FN(precio)+" MXN" );
			CARRITO["total"] = total;
			CARRITO["cantidad"] = cant_item;
		break;
	}
}

function getCarritoActual(){
	return CARRITO["productos"][ (CARRITO["productos"].length-1) ];
}

function FN(number){
	return new Intl.NumberFormat("de-DE", {style: "currency", currency: "USD"}).format(number);
}

function mas_cantidad(index){
	var valor = jQuery("#cant_"+index).html();
	var max = 20;
	if(valor < max){
	valor++;
	jQuery("#cant_"+index).html(valor);
	CARRITO["productos"][index]["cantidad"] = valor;
	CARRITO["cantidad"]++;
	loadFase(5);
	}else{
		jQuery('#mensaje').modal('show');
		jQuery('#label-mensaje').html('Excedio la cantidad maxima de productos nutriheoes permitido');
		
	}
}

function menos_cantidad(index){
	var valor = jQuery("#cant_"+index).html();
	if( valor > 1){
		valor--;
		jQuery("#cant_"+index).html(valor);
		CARRITO["productos"][index]["cantidad"] = valor;
		CARRITO["cantidad"]--;
		loadFase(5);
	}
}

function eliminarProducto(id){
	var confirmed = confirm("Esta seguro de quitar este producto.?");
    if (confirmed == true) {
    	var TEMP = [];
    	jQuery.each( CARRITO["productos"],  function(key, producto){
    		if(key != id){
				TEMP.push(producto);
    		}
		});
		CARRITO["productos"] = TEMP;
		if( CARRITO["productos"].length == 0 ){
			jQuery("#agregar_plan").click();
		}else{
			change_fase(5);
		}
    }
}