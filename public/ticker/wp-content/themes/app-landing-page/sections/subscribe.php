<?php
/**
 * Banner Section
 * 
 * @package App_Landing_Page
 */

$subscribe_section = get_theme_mod( 'app_landing_page_ed_subscribe_section' );
$social            = get_theme_mod( 'app_landing_page_ed_social' );
$facebook          = get_theme_mod( 'app_landing_page_facebook' );
$twitter           = get_theme_mod( 'app_landing_page_twitter' );
$pinterest         = get_theme_mod( 'app_landing_page_pinterest' );
$linkedin          = get_theme_mod( 'app_landing_page_linkedin' );
$instagram         = get_theme_mod( 'app_landing_page_instagram' );
$youtube           = get_theme_mod( 'app_landing_page_youtube' );

if( ( app_landing_page_newsletter_activated() && is_active_sidebar( 'bottom-widget' ) && $subscribe_section ) || ( $social && ( $facebook || $twitter || $pinterest || $linkedin || $instagram || $youtube ) ) ) {
	?>
	<section class="stay-tuned" id="stay-tuned">
		<div class="container">	
		<?php 
			if( is_active_sidebar( 'bottom-widget' ) ) { 
					dynamic_sidebar( 'bottom-widget' ); 
			} 
			if( $facebook || $twitter || $pinterest || $linkedin || $instagram || $youtube ){ 
		  		echo '<ul class="social-networks wow fadeInUp" id="social-networks">'; 
		  			if( $facebook ) echo '<li><a href="' . esc_url( $facebook ) . '"><i class="fa fa-facebook"></i></a></li>';
		  			if( $twitter ) echo '<li><a href="' . esc_url( $twitter ) . '"><i class="fa fa-twitter"></i></a></li>';
		  			if( $pinterest ) echo '<li><a href="' . esc_url( $pinterest ) . '"><i class="fa fa-pinterest-p"></i></a></li>';
		  			if( $linkedin ) echo '<li><a href="' . esc_url( $linkedin ) . '"><i class="fa fa-linkedin"></i></a></li>';
		  			if( $instagram ) echo '<li><a href="' . esc_url( $instagram ) . '"><i class="fa fa-instagram"></i></a></li>';
		  			if( $youtube ) echo '<li><a href="' . esc_url( $youtube ) . '"><i class="fa fa-youtube"></i></a></li>';
                echo '</ul>';
			}
		?>
	    </div>
	</section>
<?php }
