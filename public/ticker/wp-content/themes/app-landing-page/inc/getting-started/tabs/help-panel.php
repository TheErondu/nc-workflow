<?php
/**
 * Help Panel.
 *
 * @package App_Landing_Page
 */
?>
<!-- Help file panel -->
<div id="help-panel" class="panel-left">

    <div class="panel-aside">
        <h4><?php esc_html_e( 'View Our Documentation Link', 'app-landing-page' ); ?></h4>
        <p><?php esc_html_e( 'Are you new to the WordPress world? Our step by step easy documentation guide will help you create an attractive and engaging website without any prior coding knowledge or experience.', 'app-landing-page' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://docs.rarathemes.com/docs/' . APP_LANDING_PAGE_THEME_TEXTDOMAIN . '/' ); ?>" title="<?php esc_attr_e( 'Visit the Documentation', 'app-landing-page' ); ?>" target="_blank">
            <?php esc_html_e( 'View Documentation', 'app-landing-page' ); ?>
        </a>
    </div><!-- .panel-aside -->
    
    <div class="panel-aside">
        <h4><?php esc_html_e( 'Support Ticket', 'app-landing-page' ); ?></h4>
        <p><?php printf( __( 'It\'s always better to visit our %1$sDocumentation Guide%2$s before you send us a support query.', 'app-landing-page' ), '<a href="'. esc_url( 'https://docs.rarathemes.com/docs/' . APP_LANDING_PAGE_THEME_TEXTDOMAIN . '/' ) .'" target="_blank">', '</a>' ); ?></p>
        <p><?php printf( __( 'If the Documentation Guide didn\'t help you, contact us via our %1$sSupport Ticket%2$s. We reply to all the support queries within one business day, except on the weekends.', 'app-landing-page' ), '<a href="'. esc_url( 'https://rarathemes.com/support-ticket/' ) .'" target="_blank">', '</a>' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/support-ticket/' ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'app-landing-page' ); ?>" target="_blank">
            <?php esc_html_e( 'Contact Support', 'app-landing-page' ); ?>
        </a>
    </div><!-- .panel-aside -->

    <div class="panel-aside">
        <h4><?php printf( esc_html__( 'View Our %1$s Demo', 'app-landing-page' ), APP_LANDING_PAGE_THEME_NAME ); ?></h4>
        <p><?php esc_html_e( 'Visit the demo to get more idea about our theme design and its features.', 'app-landing-page' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/previews/?theme=' . APP_LANDING_PAGE_THEME_TEXTDOMAIN . '' ); ?>" title="<?php esc_attr_e( 'Visit the Demo', 'app-landing-page' ); ?>" target="_blank">
            <?php esc_html_e( 'View Demo', 'app-landing-page' ); ?>
        </a>
    </div><!-- .panel-aside -->
</div>