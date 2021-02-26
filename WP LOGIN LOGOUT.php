<div class="g5core-login-button">
	<?php if ( is_user_logged_in() ): ?>
		<a href="<?php echo esc_url( home_url( '/my-account' ) ); ?>" title="<?php esc_attr_e( 'My Account', 'g5-core' ) ?>" style="padding-right: 11px;">
			<i class="fal fa-user"></i>
			<span><?php esc_html_e( 'My Account', 'g5-core' ) ?></span>
		</a> 
		
		<a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Logout', 'g5-core' ) ?>">
			<i class="fal fa-sign-out"></i>
			<span><?php esc_html_e( 'Logout', 'g5-core' ) ?></span>
		</a>
	<?php else: ?>
		<?php if ( get_option( 'users_can_register' ) ): ?>
			<a href="#g5core_login_popup"
			   title="<?php esc_attr_e( 'Login / Join', 'g5-core' ) ?>"
			   data-g5core-mfp="true"
			   data-mfp-options='<?php echo json_encode( $args ) ?>'>
				<i class="fal fa-user-circle"></i>
				<span><?php esc_html_e( 'Login / Join', 'g5-core' ) ?></span>
			</a>
		<?php else: ?>
			<a href="#g5core_login_popup"
			   title="<?php esc_attr_e( 'Login', 'g5-core' ) ?>"
			   data-g5core-mfp="true"
			   data-mfp-options='<?php echo json_encode( $args ) ?>'>
				<i class="fal fa-user-circle"></i>
				<span><?php esc_html_e( 'Login', 'g5-core' ) ?></span>
			</a>
		<?php endif; ?>
		<?php add_action( 'wp_footer', array( G5CORE()->templates(), 'login_popup' ), 10 ) ?>
	<?php endif; ?>
</div>
