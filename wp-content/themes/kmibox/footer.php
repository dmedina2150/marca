		</div>

		<script type="text/javascript" src="<?php echo get_home_url(); ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo get_home_url(); ?>/wp-content/themes/kmibox/lib/jquery.waterwheelCarousel.min.js"></script>
		<script type='text/javascript' src="<?php echo get_home_url(); ?>/plugins/bootstrap-validator/bootstrapValidator.js"></script>
		<script type='text/javascript' src="<?php echo get_home_url(); ?>/js/backpanel.js"></script>
		<script type='text/javascript' src="<?php echo get_home_url(); ?>/js/init.js"></script>

		<?php 
			global $post;
			if( $post->post_name == "quiero-mi-marca" ){
			 	wp_footer(); 
			}
			// cargarTablaProductos();

			if(  $_SESSION['admin_sub_login'] == 'YES' ){
		        $HTML .= "
		            <a href='".get_home_url()."/?i=".md5($_SESSION['id_admin'])."&admin=YES' class='theme_button' style='
		                position: fixed;
		                display: inline-block;
		                left: 50px;
		                bottom: 50px;
		                padding: 20px;
		                font-size: 48px;
		                font-family: Roboto;
		                z-index: 999999999999999999;
		            '>
		                X
		            </a>
		        ";

		        echo comprimir($HTML);
		    }
		?>
	</body>
</html>
