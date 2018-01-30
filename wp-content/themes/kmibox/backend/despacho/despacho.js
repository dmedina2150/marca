var table = "";
jQuery(document).ready(function() {
    table = jQuery('#example').DataTable({
    	"language": {
			"emptyTable":			"No hay datos disponibles en la tabla.",
			"info":		   			"Del _START_ al _END_ de _TOTAL_ ",
			"infoEmpty":			"Mostrando 0 registros de un total de 0.",
			"infoFiltered":			"(filtrados de un total de _MAX_ registros)",
			"infoPostFix":			" (actualizados)",
			"lengthMenu":			"Mostrar _MENU_ registros",
			"loadingRecords":		"Cargando...",
			"processing":			"Procesando...",
			"search":				"Buscar:",
			"searchPlaceholder":	"Dato para buscar",
			"zeroRecords":			"No se han encontrado coincidencias.",
			"paginate": {
				"first":			"Primera",
				"last":				"Última",
				"next":				"Siguiente",
				"previous":			"Anterior"
			},
			"aria": {
				"sortAscending":	"Ordenación ascendente",
				"sortDescending":	"Ordenación descendente"
			}
		},
        "scrollX": true,
        "ajax": {
            "url": TEMA+'/backend/despacho/ajax/despacho.php',
            "type": "POST"
        }
	});

    jQuery("#close_modal").on("click", function(e){
        cerrar(e);
    });

} );

function actualizarStatus(){
	var URL = TEMA+"/backend/despacho/ajax/updateStatus.php";
	jQuery.ajax({
        async:true, 
        cache:false, 
        type: 'POST', 
        url: URL,
        data: jQuery("#status_despacho").serialize(), 
        success:  function(HTML){
            table.ajax.reload();
            cerrar();
        },
        beforeSend:function(){},
        error:function(e){
        	console.log(e);
        }
    });
}

function actualizarFecha(){
	var URL = TEMA+"/backend/despacho/ajax/updateFecha.php";
	jQuery.ajax({
        async:true, 
        cache:false, 
        type: 'POST', 
        url: URL,
        data: jQuery("#status_despacho").serialize(), 
        success:  function(HTML){
            table.ajax.reload();
            cerrar();
        },
        beforeSend:function(){},
        error:function(e){
        	console.log(e);
        }
    });
}

function actualizarGuia(){
    var URL = TEMA+"/backend/despacho/ajax/updateGuia.php";
    jQuery.ajax({
        async:true, 
        cache:false, 
        type: 'POST', 
        url: URL,
        data: jQuery("#status_despacho").serialize(), 
        success:  function(HTML){
            table.ajax.reload();
            cerrar();
        },
        beforeSend:function(){},
        error:function(e){
            console.log(e);
        }
    });
}

function enviarCorreo(){
	var URL = TEMA+"/backend/despacho/ajax/enviarCorreo.php";

    if( !jQuery("#btn-enviarCorreo").hasClass("disabled") ){
        jQuery("#btn-enviarCorreo").addClass("disabled");
        jQuery("#btn-enviarCorreo").val("Procesando...");

        jQuery.ajax({
            async:true, 
            cache:false, 
            type: 'POST', 
            url: URL,
            data: jQuery("#status_despacho").serialize(), 
            success:  function(HTML){
                jQuery("#btn-enviarCorreo").removeClass("disabled");
                jQuery("#btn-enviarCorreo").val("Confirmar Envio de Correo");

                alert("Correo Enviado!");

                table.ajax.reload();
                cerrar();
            },
            beforeSend:function(){},
            error:function(e){
                console.log(e);
            }
        });
    }
}