<?php
/**
 * Template Name: Blog (Custom)
 * Description: Custom blog page with category filter, featured article and pagination.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$paged   = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
$cat_slug = isset( $_GET['blog_cat'] ) ? sanitize_title( wp_unslash( $_GET['blog_cat'] ) ) : '';
$page_url = get_permalink();
$cats     = get_categories( array( 'hide_empty' => true ) );

$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 9,
	'paged'               => $paged,
	'ignore_sticky_posts' => true,
);
if ( $cat_slug ) { $args['category_name'] = $cat_slug; }
$blog = new WP_Query( $args );

$show_featured = ( 1 === $paged && ! $cat_slug && $blog->have_posts() );
$featured_id   = 0;
?>
<div class="container sc-blog sc-blog-custom">
	<header class="sc-page-header sc-blog-head">
		<span class="sc-eyebrow"><?php esc_html_e( 'Journal', 'skincare-clean' ); ?></span>
		<h1><?php echo esc_html( get_the_title() ); ?></h1>
		<p class="sc-blog-sub"><?php esc_html_e( 'Skincare guides, ingredient explainers and routines from KLAR & GLO.', 'skincare-clean' ); ?></p>
	</header>

	<?php if ( $cats && count( $cats ) > 1 ) : ?>
	<nav class="sc-blog-filter" aria-label="<?php esc_attr_e( 'Blog categories', 'skincare-clean' ); ?>">
		<a href="<?php echo esc_url( $page_url ); ?>" class="<?php echo $cat_slug ? '' : 'is-active'; ?>"><?php esc_html_e( 'All', 'skincare-clean' ); ?></a>
		<?php foreach ( $cats as $c ) : if ( 'uncategorized' === $c->slug && count( $cats ) > 1 ) { continue; } ?>
			<a href="<?php echo esc_url( add_query_arg( 'blog_cat', $c->slug, $page_url ) ); ?>" class="<?php echo $cat_slug === $c->slug ? 'is-active' : ''; ?>"><?php echo esc_html( $c->name ); ?></a>
		<?php endforeach; ?>
	</nav>
	<?php endif; ?>

	<?php if ( $blog->have_posts() ) : ?>

		<?php if ( $show_featured ) :
			$blog->the_post(); $featured_id = get_the_ID(); $fc = get_the_category(); ?>
			<article class="sc-blog-featured">
				<a href="<?php the_permalink(); ?>" class="sc-blog-featured-img" aria-hidden="true" tabindex="-1">
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'large' ); } else { echo '<span class="sc-thumb-fallback">KLAR &amp; GLO</span>'; } ?>
				</a>
				<div class="sc-blog-featured-body">
					<div class="sc-meta">
						<span class="sc-cat"><?php echo esc_html( $fc ? $fc[0]->name : __( 'Latest', 'skincare-clean' ) ); ?></span><span class="sc-dot">&middot;</span>
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</div>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="sc-post-excerpt"><?php the_excerpt(); ?></div>
					<a class="sc-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read article', 'skincare-clean' ); ?> &rarr;</a>
				</div>
			</article>
		<?php endif; ?>

		<?php if ( $blog->current_post + 1 < $blog->post_count || ! $show_featured ) : ?>
		<div class="sc-post-grid">
			<?php while ( $blog->have_posts() ) : $blog->the_post(); get_template_part( 'template-parts/content', 'card' ); endwhile; ?>
		</div>
		<?php endif; ?>

		<?php
		$links = paginate_links( array(
			'base'      => trailingslashit( $page_url ) . 'page/%#%/',
			'format'    => '',
			'current'   => $paged,
			'total'     => $blog->max_num_pages,
			'mid_size'  => 1,
			'prev_text' => '&larr;',
			'next_text' => '&rarr;',
			'add_args'  => $cat_slug ? array( 'blog_cat' => $cat_slug ) : false,
		) );
		if ( $links ) : ?><div class="sc-pagination"><div class="nav-links"><?php echo wp_kses_post( $links ); ?></div></div><?php endif; ?>

	<?php else : ?>
		<p class="sc-blog-empty"><?php esc_html_e( 'No articles found. Please check back soon.', 'skincare-clean' ); ?></p>
	<?php endif; wp_reset_postdata(); ?>
</div>
<?php get_footer(); ?>
