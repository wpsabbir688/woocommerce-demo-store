<?php
/**
 * ShopNest footer.
 *
 * @package ShopNest
 */
?>
<footer class="site-footer">
	<div class="container footer-inner">
		<div class="footer-text">
			<p><?php echo esc_html( get_theme_mod( 'shopnest_footer_text', __( 'ShopNest demo store. All products and offers shown are fictional demo data.', 'shopnest' ) ) ); ?></p>
		</div>
		<nav class="footer-menu" aria-label="<?php esc_attr_e( 'Footer menu', 'shopnest' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
