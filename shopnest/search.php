<?php
/**
 * ShopNest search results template.
 *
 * @package ShopNest
 */

get_header();
?>
<main id="main" class="site-main shopnest-page">
	<div class="container">
		<h1>
			<?php
			/* translators: %s: search query */
			printf( esc_html__( 'Results for "%s"', 'shopnest' ), esc_html( get_search_query() ) );
			?>
		</h1>
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article class="shopnest-post-card">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php esc_html_e( 'No results found. Try a different search.', 'shopnest' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>
