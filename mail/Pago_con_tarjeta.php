<?php
	//include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
		¡Hola Rodrigo!
			
			<div style="font-size: 17px; padding: 10px 20px 0px; font-weight: 400;"> 
				Haz realizado un pago
			</div>

		</div> 
		<div>
			<img src="[IMG_PATH]pago_tarjeta/pago_tarjeta01.jpg" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div>
				Verifica<strong>nlos detalles de tu pago</strong>

		</div>

		<div>
		<h3>Titular</h3>
		<label>Titular de la tarjeta</label>
		</div>
		<div>
		<h3>tipo de envio</h3>
		<label>fedex</label>
		</div>
		<div>
		<h3>N&uacute;mero de la tarjeta</h3>
		<label>41111111111111111111</label>
		</div>
		<div>
		<h3>Fecha de vencimiento</h3>
		<label>01/20</label>
		</div>
		<div>
		<h3>cvv</h3>
		<label>cvv</label>
		</div>
		<div>
		<h3>Total a pagar</h3>
		<label>$2.400 MXN</label>
		</div>

		<label>¡Gracias por tu compra!</label>


	<div>
		<label>para cualquier duda o informaci&oacute;n no dudes en escribirnos por esta via o por whatsapp al <strong>5540034824</strong> donde con gusto te atenderemos</label>
		</div>	
	

		<div style="float:left;width:50%;>
			<img src="[IMG_PATH]confirmacion/general.jpg" style="width: 50%; margin: 0px 0px 10px; " />
		</div>

			<div style="float:left;width:50%;>
			<label>Recuerda que con tu suscripci&oacute;n tienes un <strong>10%</strong> de descuento en TODOS los servicios kmimos durante todo un año acumulables con otras promociones <br> Kmimos es la mayor red de cuidadores certificados de Mexico, que cuidan a las mascotas en el hogar del cuidador, sin jaulas ni encierros</label>
		</div>


	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>