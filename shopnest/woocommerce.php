<?php
/**
 * WooCommerce template.
 *
 * The wrappers live here (not in the before/after main-content hooks):
 * woocommerce_content() renders the archive loop / single product directly
 * and never fires woocommerce_before_main_content, so a theme with a
 * woocommerce.php file must provide its own wrappers. The hook callbacks
 * in functions.php remain as a fallback for the plugin's own
 * archive-product.php template if this file is ever removed.
 *
 * @package ShopNest
 */

get_header();
?>
<main id="main" class="site-main shopnest-woo">
	<div class="container">
		<?php woocommerce_content(); ?>
	</div>
</main>
<?php
get_footer();
