<?php
/**
 * ShopNest 404 template.
 *
 * @package ShopNest
 */

get_header();
?>
<main id="main" class="site-main shopnest-page">
	<div class="container">
		<h1><?php esc_html_e( 'Page not found', 'shopnest' ); ?></h1>
		<p><?php esc_html_e( 'The page you are looking for does not exist or has moved.', 'shopnest' ); ?></p>
		<p><a class="shopnest-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'shopnest' ); ?></a></p>
	</div>
</main>
<?php get_footer(); ?>
