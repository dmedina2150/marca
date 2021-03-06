function init_modal(data){
	jQuery(".modal > div > span").html(data["titulo"]);
	jQuery.ajax({
        async:true, cache:false, type: 'POST', url: TEMA+"/backend/"+data["modulo"]+"/modales/"+data["modal"]+".php",
        data: data["info"], 
        success:  function(HTML){
            jQuery(".modal > div > div").html( HTML );
            jQuery(".modal").css("display", "block");
            jQuery("body").css("overflow", "hidden");

        },
        beforeSend:function(){},
        error:function(e){
        	console.log(e);
        }
    });
    jQuery("#close_modal").on("click", function(e){
        cerrar(e);
    });

}

function abrir_link(e){
    init_modal({
        "titulo": e.attr("data-titulo"),
        "modulo": e.attr("data-modulo"),
        "modal": e.attr("data-modal"),
        "info": {
            "ID": e.attr("data-id")
        }
    });
}

function cerrar(e){
    jQuery(".modal").css("display", "none");
    jQuery("body").css("overflow", "auto");
}

function subirImg(evt){
    var files = evt.target.files;
    getRealMime(this.files[0]).then(function(MIME){
        if( MIME.match("image.*") ){
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    /*redimencionar(e.target.result, function(img_reducida){
                        img_cargada(img_reducida);
                    }); */   
                    img_cargada(e.target.result);  
                };
           })(files[0]);
           reader.readAsDataURL(files[0]);
        }else{
            alert("Solo se permiten imagenes");
        }
    }).catch(function(error){
        alert("Solo se permiten imagenes");
    });     
}

function redimencionar(IMG_CACHE, CB){
    contenedor_temp();
    var ximg = new Image();
    ximg.src = IMG_CACHE;
    ximg.onload = function(){
        jQuery("#kmimos_redimencionar_imagenes #kmimos_img_temp").attr("src", ximg.src);
        var rxi = jQuery("#kmimos_redimencionar_imagenes #kmimos_img_temp")[0];
        var rw = rxi.width;
        var rh = rxi.height;
        var w = 600;
        var h = 450;
        if( rw > rh ){
            h = Math.round( ( rh * w ) / rw );
        }else{
            w = Math.round( ( rw * h ) / rh );
        }
        CA = d("<canvas id='kmimos_canvas' width='"+w+"' height='"+h+"'>");
        jQuery("#kmimos_redimencionar_imagenes #kmimos_canvas_temp").html(CA);
        CA = jQuery("#kmimos_redimencionar_imagenes #kmimos_canvas_temp #kmimos_canvas");
        CTX = c("kmimos_canvas");
        if(CTX){
            CTX.drawImage(ximg, 0, 0, w, h);
            CB( CA[ 0 ].toDataURL("image/jpeg") );
        }else{
            return false;
        }
    }
}

function getRealMime(file) {
    return new Promise((resolve, reject) => {
        if (window.FileReader && window.Blob) {
            let slice = file.slice(0, 4);
            let reader = new FileReader();
          
            reader.onload = () => {
                let buffer = reader.result;
                let view = new DataView(buffer);
                let signature = view.getUint32(0, false).toString(16);
                let mime = 'unknown';

                switch ( String(signature).toLowerCase() ) {
                    case "89504e47":
                        mime = "image/png";
                    break;
                    case "47494638":
                        mime = "image/gif";
                    break;
                    case "ffd8ffe0":
                        mime = "image/jpeg";
                    break;
                    case "ffd8ffe1":
                        mime = "image/jpeg";
                    break;
                    case "ffd8ffe2":
                        mime = "image/jpeg";
                    break;
                    case "ffd8ffe3":
                        mime = "image/jpeg";
                    break;
                    case "ffd8ffe8":
                        mime = "image/jpeg";
                    break;
                }

                resolve(mime);

            }
            reader.readAsArrayBuffer(slice);
        } else {
            reject(new Error('Usa un navegador moderno para una mejor experiencia'));
        }
    });
}

function initImg(id){
    document.getElementById(id).addEventListener("change", subirImg, false);
} 

function initFileNormal(id){
    document.getElementById(id).addEventListener("change", subirFileNormal, false);
} 

function subirFileNormal(evt){
    var files = evt.target.files;
    var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {  
                img_cargada(e.target.result);  
            };
       })(files[0]);
       reader.readAsDataURL(files[0]);   
} 

function d(s){ return jQuery(s)[0].outerHTML; }
function c(i){
   var e = document.getElementById(i);
   if(e && e.getContext){
        var c = e.getContext('2d');
        if(c){ return c; }
   }
   return false;
}

function contenedor_temp(){
    if( jQuery("#kmimos_redimencionar_imagenes").html() == undefined ){
        var img = jQuery("<img>", {
            id: "kmimos_img_temp"
        })[0].outerHTML;

        var cont_canvas = jQuery("<span>", {
            id: "kmimos_canvas_temp"
        })[0].outerHTML

        var cont_general = jQuery("<div>", {
            id: "kmimos_redimencionar_imagenes",
            html: cont_canvas+img,
            style: "display: none;"
        })[0].outerHTML;

        return jQuery("body").append(cont_general);
    }else{
        var img = jQuery("<img>", {
            id: "kmimos_img_temp"
        })[0].outerHTML;

        var cont_canvas = jQuery("<span>", {
            id: "kmimos_canvas_temp"
        })[0].outerHTML

        var cont_general = jQuery("<div>", {
            id: "kmimos_redimencionar_imagenes",
            html: cont_canvas+img,
            style: "display: none;"
        })[0].outerHTML;

        jQuery("#kmimos_redimencionar_imagenes").html(cont_general);
    }
}