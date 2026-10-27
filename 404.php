<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<div class="container sc-section sc-center">
	<span class="sc-eyebrow"><?php esc_html_e( '404 Error', 'skincare-clean' ); ?></span>
	<h1><?php esc_html_e( 'Page Not Found.', 'skincare-clean' ); ?></h1>
	<p><?php esc_html_e( "The page you're looking for doesn't exist. It may have been moved or removed.", 'skincare-clean' ); ?></p>
	<a class="sc-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Homepage', 'skincare-clean' ); ?></a>
</div>
<?php get_footer(); ?>
