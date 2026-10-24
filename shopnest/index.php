<?php
/**
 * ShopNest main loop template (blog archive fallback).
 *
 * @package ShopNest
 */

get_header();
?>
<main id="main" class="site-main shopnest-page">
	<div class="container">
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
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found here yet.', 'shopnest' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>
