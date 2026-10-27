<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<div class="container">
	<header class="sc-page-header">
		<span class="sc-eyebrow"><?php esc_html_e( 'Journal', 'skincare-clean' ); ?></span>
		<h1><?php is_home() ? esc_html_e( 'Latest Articles', 'skincare-clean' ) : the_archive_title(); ?></h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="sc-post-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'sc-post-card' ); ?>>
					<a href="<?php the_permalink(); ?>" class="sc-thumb">
						<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'medium' ); ?>
					</a>
					<div class="sc-meta"><?php echo esc_html( get_the_date() ); ?></div>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php the_excerpt(); ?></p>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="sc-pagination"><?php the_posts_pagination(); ?></div>
	<?php else : ?>
		<p><?php esc_html_e( 'Nothing found.', 'skincare-clean' ); ?></p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
