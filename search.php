<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<div class="container">
	<header class="sc-page-header">
		<h1><?php printf( esc_html__( 'Search Results for: %s', 'skincare-clean' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header>
	<?php if ( have_posts() ) : ?>
		<div class="sc-post-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'sc-post-card' ); ?>>
					<a href="<?php the_permalink(); ?>" class="sc-thumb">
						<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'medium' ); ?>
					</a>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php the_excerpt(); ?></p>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="sc-pagination"><?php the_posts_pagination(); ?></div>
	<?php else : ?>
		<p><?php esc_html_e( 'No results found.', 'skincare-clean' ); ?></p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
