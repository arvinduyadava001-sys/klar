<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
while ( have_posts() ) : the_post();
?>
<div class="container sc-section">
	<article class="single-content">
		<h1><?php the_title(); ?></h1>
		<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'large' ); ?>
		<div class="sc-entry-content"><?php the_content(); ?></div>
	</article>
</div>
<?php endwhile;
get_footer();
