<?php
/**
 * ShopNest theme functions.
 *
 * Original theme for the WooCommerce demo store project. Hooks-first
 * WooCommerce support: no wholesale template overrides, only the
 * before/after main-content wrappers and a few display filters.
 *
 * @package ShopNest
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SHOPNEST_VERSION', '1.0.0' );

/**
 * Theme setup: title tag, thumbnails, custom logo, menus, WooCommerce.
 */
function shopnest_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support(
		'html5',
		array( 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'shopnest' ),
			'footer'  => __( 'Footer Menu', 'shopnest' ),
		)
	);

	// WooCommerce support, hooks-first (no template overrides).
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'shopnest_setup' );

/**
 * Enqueue the theme stylesheet, with the Customizer accent color applied.
 */
function shopnest_scripts() {
	wp_enqueue_style( 'shopnest-style', get_stylesheet_uri(), array(), SHOPNEST_VERSION );

	$accent = get_theme_mod( 'shopnest_accent_color', '#b45309' );
	$accent = sanitize_hex_color( $accent ) ? $accent : '#b45309';
	$inline = sprintf( ':root { --shopnest-accent: %s; }', $accent );
	wp_add_inline_style( 'shopnest-style', $inline );
}
add_action( 'wp_enqueue_scripts', 'shopnest_scripts' );

/**
 * Header layout body class (standard or centered).
 */
function shopnest_body_classes( $classes ) {
	$layout = get_theme_mod( 'shopnest_header_layout', 'standard' );
	if ( 'centered' === $layout ) {
		$classes[] = 'shopnest-header-centered';
	}
	return $classes;
}
add_filter( 'body_class', 'shopnest_body_classes' );

/**
 * WooCommerce wrappers (fallback): open before, close after the main
 * content. These hooks fire in the plugin's own archive-product.php /
 * single-product.php templates. When this theme's woocommerce.php is in
 * use, woocommerce_content() renders the loop directly and never fires
 * these hooks, so the wrappers in woocommerce.php apply instead.
 */
function shopnest_woocommerce_wrapper_open() {
	echo '<main id="main" class="site-main shopnest-woo"><div class="container">';
}
add_action( 'woocommerce_before_main_content', 'shopnest_woocommerce_wrapper_open', 10 );

function shopnest_woocommerce_wrapper_close() {
	echo '</div></main>';
}
add_action( 'woocommerce_after_main_content', 'shopnest_woocommerce_wrapper_close', 10 );

// Full-width shop: no WooCommerce sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Shop display: 4 columns on desktop (CSS grid collapses on mobile),
 * 12 products per page, 4 related products.
 */
add_filter( 'loop_shop_columns', function () { return 4; } );
add_filter( 'loop_shop_per_page', function () { return 12; } );

function shopnest_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'shopnest_related_products_args' );

/**
 * Customizer: accent color, header layout, hero text, footer text.
 */
function shopnest_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'shopnest_options',
		array(
			'title'    => __( 'ShopNest Options', 'shopnest' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'shopnest_accent_color',
		array(
			'default'           => '#b45309',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'shopnest_accent_color',
			array(
				'label'   => __( 'Accent Color', 'shopnest' ),
				'section' => 'shopnest_options',
			)
		)
	);

	$wp_customize->add_setting(
		'shopnest_header_layout',
		array(
			'default'           => 'standard',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shopnest_header_layout',
		array(
			'label'   => __( 'Header Layout', 'shopnest' ),
			'section' => 'shopnest_options',
			'type'    => 'select',
			'choices' => array(
				'standard' => __( 'Logo left, menu right', 'shopnest' ),
				'centered' => __( 'Centered', 'shopnest' ),
			),
		)
	);

	foreach ( array(
		'shopnest_hero_title'       => __( 'Welcome to ShopNest', 'shopnest' ),
		'shopnest_hero_text'        => __( 'Everyday essentials for your home and wardrobe — simple, honest, and made to last.', 'shopnest' ),
		'shopnest_hero_button_text' => __( 'Shop All Products', 'shopnest' ),
		'shopnest_footer_text'      => __( 'ShopNest demo store. All products and offers shown are fictional demo data.', 'shopnest' ),
	) as $key => $default ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $default,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'   => ucwords( str_replace( array( 'shopnest_', '_' ), array( '', ' ' ), $key ) ),
				'section' => 'shopnest_options',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'shopnest_customize_register' );

/**
 * Header cart link (WooCommerce only, guarded so the theme never fatals
 * when WooCommerce is inactive).
 */
function shopnest_header_cart() {
	if ( ! class_exists( 'WooCommerce' ) || ! function_exists( 'WC' ) || ! WC()->cart ) {
		return;
	}
	$count = WC()->cart->get_cart_contents_count();
	$url   = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : '#';
	printf(
		'<div class="header-cart"><a href="%s">%s (%d)</a></div>',
		esc_url( $url ),
		esc_html__( 'Cart', 'shopnest' ),
		absint( $count )
	);
}
