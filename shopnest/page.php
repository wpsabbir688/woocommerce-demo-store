<?php
/**
 * ShopNest page template (also renders cart/checkout shortcode pages).
 *
 * @package ShopNest
 */

get_header();
?>
<main id="main" class="site-main shopnest-page">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
</main>
<?php get_footer(); ?>
