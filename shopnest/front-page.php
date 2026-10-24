<?php
/**
 * ShopNest homepage: hero, shop-by-category, featured, promos, best sellers.
 * All shop blocks are guarded so the page renders cleanly without WooCommerce.
 *
 * @package ShopNest
 */

get_header();
?>

<section class="shopnest-hero">
	<div class="container">
		<h1><?php echo esc_html( get_theme_mod( 'shopnest_hero_title', __( 'Welcome to ShopNest', 'shopnest' ) ) ); ?></h1>
		<p><?php echo esc_html( get_theme_mod( 'shopnest_hero_text', __( 'Everyday essentials for your home and wardrobe — simple, honest, and made to last.', 'shopnest' ) ) ); ?></p>
		<a class="shopnest-button" href="<?php echo esc_url( class_exists( 'WooCommerce' ) && function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>">
			<?php echo esc_html( get_theme_mod( 'shopnest_hero_button_text', __( 'Shop All Products', 'shopnest' ) ) ); ?>
		</a>
	</div>
</section>

<main id="main" class="site-main">
	<section class="shopnest-section">
		<div class="container">
			<h2><?php esc_html_e( 'Shop by Category', 'shopnest' ); ?></h2>
			<div class="shopnest-categories">
				<?php
				$terms = class_exists( 'WooCommerce' ) ? get_terms(
					array(
						'taxonomy'   => 'product_cat',
						'hide_empty' => false,
						'number'     => 4,
						'exclude'    => array( get_option( 'default_product_cat', 0 ) ),
					)
				) : array();

				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
					foreach ( $terms as $term ) :
						?>
						<a class="shopnest-category-card" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
							<h3><?php echo esc_html( $term->name ); ?></h3>
							<p>
								<?php
								/* translators: %d: number of products in the category */
								printf( esc_html__( '%d products', 'shopnest' ), absint( $term->count ) );
								?>
							</p>
						</a>
						<?php
					endforeach;
				else :
					// Fallback cards when no product categories exist yet.
					foreach ( array(
						__( 'Apparel', 'shopnest' ) => __( 'Tees, jackets and everyday layers.', 'shopnest' ),
						__( 'Home & Living', 'shopnest' ) => __( 'Comfort for every corner of the house.', 'shopnest' ),
						__( 'Accessories', 'shopnest' ) => __( 'Bags, bottles and small essentials.', 'shopnest' ),
					) as $name => $desc ) :
						?>
						<a class="shopnest-category-card" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">
							<h3><?php echo esc_html( $name ); ?></h3>
							<p><?php echo esc_html( $desc ); ?></p>
						</a>
						<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
	</section>

	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		<section class="shopnest-section">
			<div class="container">
				<h2><?php esc_html_e( 'Featured Products', 'shopnest' ); ?></h2>
				<?php echo do_shortcode( '[products featured="true" limit="4" columns="4"]' ); ?>
			</div>
		</section>

		<section class="shopnest-section">
			<div class="container">
				<div class="shopnest-promos">
					<div class="shopnest-promo dark">
						<h3><?php esc_html_e( 'New Season Picks', 'shopnest' ); ?></h3>
						<p><?php esc_html_e( 'Fresh demo arrivals across apparel and home.', 'shopnest' ); ?></p>
						<a class="shopnest-button secondary" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Browse the Shop', 'shopnest' ); ?></a>
					</div>
					<div class="shopnest-promo accent">
						<h3><?php esc_html_e( 'On Sale Now', 'shopnest' ); ?></h3>
						<p><?php esc_html_e( 'A few demo products are marked down — see the sale badges.', 'shopnest' ); ?></p>
						<a class="shopnest-button secondary" href="<?php echo esc_url( add_query_arg( 'onsale', '1', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Shop Sale Items', 'shopnest' ); ?></a>
					</div>
				</div>
			</div>
		</section>

		<section class="shopnest-section">
			<div class="container">
				<h2><?php esc_html_e( 'Best Sellers', 'shopnest' ); ?></h2>
				<?php echo do_shortcode( '[products orderby="popularity" limit="8" columns="4"]' ); ?>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
