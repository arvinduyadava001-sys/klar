<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
while ( have_posts() ) : the_post();
?>
<div class="container sc-section">
	<article class="single-content">
		<span class="sc-eyebrow"><?php echo esc_html( get_the_date() ); ?></span>
		<h1><?php the_title(); ?></h1>
		<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'large' ); ?>
		<div class="sc-entry-content"><?php the_content(); ?></div>
	</article>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<div class="single-content">
			<?php comments_template(); ?>
		</div>
	<?php endif; ?>
</div>
<?php endwhile;
get_footer();
