<?php $user = get_user_by( 'id', get_current_user_id() ); 
?>

 		<aside id="tophome"> 
			<div class="container" style="background-color: #181E0D">
				<a href="<?php echo get_home_url(); ?>">
				<img src="<?php echo get_home_url(); ?>/img/Image-footer.png" class="hidden-xs">
				<img src="<?php echo get_home_url(); ?>/img/Image-footer.png" class="visible-xs col-xs-6" style="margin-left: -2%">
				</a>
				
			<ul class="option-menu list-unstyled list-inline col-xs-6 col-md-6 pull-right text-right" style="    font-size: 10px;">
					<?php if ( is_user_logged_in() ){ ?>
						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/perfil-usuario">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span class="hidden-xs hidden-sm gothan" ><?php echo $user->user_email; ?></span></a><!--href="<?php echo get_home_url(); ?>/perfil-usuario">-->
						</li>
						<li>
							<a class="btn-kmibox-link" href="<?php echo wp_logout_url( get_home_url() );?>">
							
							<i class="fa fa-close" aria-hidden="true"></i>
							<span class="hidden-xs hidden-sm gothan">Salir</span></a><!--href="<?php echo wp_logout_url( get_home_url() );?> ">-->
						</li> 
					<?php }else{ ?>
						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/iniciar-sesion">
							<i class="fa fa-key fa-2x" aria-hidden="true"></i>
							<span class="hidden-xs hidden-sm gothan" style="font-size: 16px">Iniciar Sesion</span></a><!--href="<?php echo get_home_url(); ?>/iniciar-sesion">-->
						</li>
						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/registro">
							<i class="fa fa-user-plus fa-2x " aria-hidden="true"></i> <span class=" hidden-xs hidden-sm gothan" style="font-size: 16px">Registrarse</span></a><!--href="<?php echo get_home_url(); ?>/registro">-->
						</li>
					<?php } ?>

				</ul>
			</div>			
		</aside>