<?php
/**
 * ShopNest header.
 *
 * @package ShopNest
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'shopnest' ); ?></a>
<header class="site-header">
	<div class="container header-inner">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?><span>.</span></a>
			<?php endif; ?>
		</div>
		<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'shopnest' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'fallback_cb'    => 'wp_page_menu',
				)
			);
			?>
		</nav>
		<?php shopnest_header_cart(); ?>
	</div>
</header>
