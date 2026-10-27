<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$slide_content_defaults = array(
	1 => array(
		'title'    => 'Korean-Inspired Skincare, Made Simple.',
		'subtitle' => 'KLAR & GLO formulations are built on Niacinamide, Centella Asiatica and Ginseng Exosome technology — for a clearer, calmer, more radiant barrier.',
		'btn'      => 'Shop Bestsellers',
		'url'      => '#bestsellers',
	),
	2 => array(
		'title'    => 'Broad Spectrum Sun Protection.',
		'subtitle' => 'White-cast free, non-comedogenic Sunscreen with Niacinamide 2% and Korean Ginseng Exosome.',
		'btn'      => 'Shop Sunscreen',
		'url'      => '#sunscreen',
	),
	3 => array(
		'title'    => '10% Niacinamide Glow Serum',
		'subtitle' => 'Fades dark spots, refines skin texture, and restores a natural, radiant glow.',
		'btn'      => 'Shop Serums',
		'url'      => '#serums',
	),
	4 => array(
		'title'    => 'Gentle Hydrating Cleanser',
		'subtitle' => 'Removes impurities without stripping moisture, leaving skin fresh, soft, and hydrated.',
		'btn'      => 'Shop Hydrating Cleanser',
		'url'      => '#serums',
	),
	5 => array(
		'title'    => 'Overnight Cell Repair. Wake Up to Ageless Glow.',
		'subtitle' => 'Powered by 0.2% Apple Stem Cell Extract, 2% Rose PDRN & Retinol',
		'btn'      => 'Shop Night Cream',
		'url'      => '#serums',
	),
);
$slide_banner_defaults = array(
	1 => 'hero-banner-1.jpeg',
	2 => 'hero-banner-2.jpeg',
	3 => 'hero-banner-3.jpeg',
	4 => 'hero-banner-4.jpeg',
	5 => 'hero-banner-5.jpeg',
);

$slides = array();
for ( $i = 1; $i <= 5; $i++ ) {
	$cd = $slide_content_defaults[ $i ];
	$default_image_path = get_template_directory() . '/assets/img/' . $slide_banner_defaults[ $i ];
	$default_image_url  = get_template_directory_uri() . '/assets/img/' . $slide_banner_defaults[ $i ];
	if ( file_exists( $default_image_path ) ) {
		$default_image_url = add_query_arg( 'v', filemtime( $default_image_path ), $default_image_url );
	}
	$img_url = get_theme_mod( "sc_hero_slide{$i}_image", $default_image_url );
	// Cache-bust ANY hero image URL (default or Customizer-set) so hosting/CDN
	// caches never serve a stale banner after it's replaced on the server.
	if ( $img_url ) {
		$img_url = add_query_arg( 'scv', defined( 'SC_THEME_VERSION' ) ? SC_THEME_VERSION : time(), $img_url );
	}
	$slides[] = array(
		'image'    => $img_url,
		'video'    => get_theme_mod( "sc_hero_slide{$i}_video", '' ),
		'title'    => get_theme_mod( "sc_hero_slide{$i}_title", $cd['title'] ),
		'subtitle' => get_theme_mod( "sc_hero_slide{$i}_subtitle", $cd['subtitle'] ),
		'btn_text' => get_theme_mod( "sc_hero_slide{$i}_button_text", $cd['btn'] ),
		'btn_url'  => get_theme_mod( "sc_hero_slide{$i}_button_url", $cd['url'] ),
	);
}
$active_slides = array_values( array_filter( $slides, function( $s ) { return ! empty( $s['title'] ); } ) );
?>

<?php if ( ! empty( $active_slides ) ) : ?>
<section class="sc-hero-slider" data-sc-hero-slider>
	<div class="sc-hero-track">
		<?php foreach ( $active_slides as $i => $slide ) :
			$has_img   = ! empty( $slide['image'] );
			$has_video = ! empty( $slide['video'] );
			$style     = ( $has_img && ! $has_video ) ? 'background-image:url(' . esc_url( $slide['image'] ) . ');' : '';
			$grad      = ( ! $has_img && ! $has_video ) ? 'sc-hero-grad-' . ( ( $i % 3 ) + 1 ) : '';
		?>
		<div class="sc-hero-slide<?php echo $i === 0 ? ' is-active' : ''; ?><?php echo $grad ? ' ' . esc_attr( $grad ) : ''; ?>" style="<?php echo esc_attr( $style ); ?>" data-index="<?php echo esc_attr( $i ); ?>">
			<?php if ( $has_img && ! $has_video ) : ?>
				<img class="sc-hero-img" src="<?php echo esc_url( $slide['image'] ); ?>" alt="<?php echo esc_attr( $slide['title'] ); ?>" <?php echo 0 === $i ? 'fetchpriority="high"' : 'loading="eager"'; ?> />
			<?php endif; ?>
			<?php if ( $has_video ) : ?>
				<video class="sc-hero-video" autoplay muted loop playsinline>
					<source src="<?php echo esc_url( $slide['video'] ); ?>" type="video/mp4">
				</video>
			<?php endif; ?>
			<div class="sc-hero-content <?php echo ($i == 2 ? 'sc-align-right' : ''); ?>">
				<!--span class="sc-eyebrow"><?php esc_html_e( 'New Formulation', 'skincare-clean' ); ?></span-->
				<h1><?php echo esc_html( $slide['title'] ); ?></h1>
				<?php if ( $slide['subtitle'] ) : ?><p><?php echo esc_html( $slide['subtitle'] ); ?></p><?php endif; ?>
				<?php if ( $slide['btn_text'] ) : ?><a class="sc-btn" href="<?php echo esc_url( $slide['btn_url'] ); ?>"><?php echo esc_html( $slide['btn_text'] ); ?></a><?php endif; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php if ( count( $active_slides ) > 1 ) : ?>
		<button class="sc-hero-arrow prev" data-sc-hero-prev aria-label="<?php esc_attr_e( 'Previous slide', 'skincare-clean' ); ?>">&#8249;</button>
		<button class="sc-hero-arrow next" data-sc-hero-next aria-label="<?php esc_attr_e( 'Next slide', 'skincare-clean' ); ?>">&#8250;</button>
		<div class="sc-hero-dots" data-sc-hero-dots>
			<?php foreach ( $active_slides as $i => $slide ) : ?>
				<button class="<?php echo $i === 0 ? 'is-active' : ''; ?>" data-slide="<?php echo esc_attr( $i ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Go to slide %d', 'skincare-clean' ), $i + 1 ) ); ?>"></button>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</section>
<?php endif; ?>

<?php
// Trust strip (shown right below the hero banner)
$sc_trust = array(
	array( 'label' => 'Dermatologist<br>Tested', 'icon' => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 6h10M21 6v12L10 38a3 3 0 0 0 2.7 4.4h22.6A3 3 0 0 0 38 38L27 18V6"/><path d="M14.5 31h19"/><circle cx="21" cy="36" r="1.2"/><circle cx="27" cy="34" r="1"/></svg>' ),
	array( 'label' => 'Cruelty<br>Free', 'icon' => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 20c-4-6-4-14-1-14s5 8 5 13M30 20c4-6 4-14 1-14s-5 8-5 13"/><ellipse cx="24" cy="32" rx="12" ry="10"/><circle cx="20" cy="30" r="1"/><circle cx="28" cy="30" r="1"/><path d="M22.5 34.5h3"/></svg>' ),
	array( 'label' => 'Vegan', 'icon' => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="15"/><path d="M24 39c0-9 3-15 11-20M24 39c0-6-2-10-8-13M24 39V16"/><path d="M24 16c-3-2-5-4-5-7M24 16c3-2 5-4 5-7"/></svg>' ),
	array( 'label' => 'Clinically<br>Researched', 'icon' => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6l8 3-3 9-8-3z"/><path d="M22 17c-5 2-8 7-6 12 2 5 7 7 12 5"/><path d="M12 42h24M16 36h14"/><path d="M30 28c3 1 5 3 5 6"/></svg>' ),
	array( 'label' => 'Sulfate &amp; Paraben<br>Free', 'icon' => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10 38C8 22 18 10 38 8c1 20-9 31-28 30z"/><path d="M10 38C17 28 24 20 33 14"/></svg>' ),
);
//array( 'label' => '', 'icon' => 'https://klarandglo.com/wp-content/uploads/2026/10/360_F_358553091_9JZMwhhaRQyP5FDtXG7axSXpxEnL0N10.jpg' ),
//);
?>
<section class="sc-trust-strip" aria-label="<?php esc_attr_e( 'Why KLAR & GLO', 'skincare-clean' ); ?>">
	<div class="sc-trust-inner">
		<?php foreach ( $sc_trust as $t ) : ?>
			<div class="sc-trust-item">
				<span class="sc-trust-icon"><?php echo $t['icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<span class="sc-trust-label"><?php echo wp_kses( $t['label'], array( 'br' => array() ) ); ?></span>
			</div>
		<?php endforeach; ?>
		<div class="sc-trust-item">
				<span class="sc-trust-icon"><img src="https://klarandglo.com/wp-content/uploads/2026/10/Approved-FDA-Circular-Stamp.png"/></span>
				<span class="sc-trust-label">FDA Approved</span>
			</div>

	</div>
</section>

<section class="sc-section alt" id="bestsellers">
	<div class="container">
		<?php sc_render_bestsellers( 8, __( 'Bestsellers', 'skincare-clean' ), '#' ); ?>
	</div>
</section>

<section class="sc-section sc-formula-section">
	<div class="container">
		<div class="sc-formula" data-sc-formula>
			<div class="sc-formula-copy">
				<span class="sc-eyebrow"><?php // esc_html_e( 'The Science Behind KLAR & GLO', 'skincare-clean' ); ?></span>
				<h2><?php esc_html_e( 'Know Your Ingredients.', 'skincare-clean' ); ?></h2>
				<p><?php esc_html_e( 'Every ingredient in KLAR & GLO is selected based on efficacy, stability, and compatibility with Indian skin types.', 'skincare-clean' ); ?></p>
				<?php $sc_shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '#'; ?>
				<a class="sc-btn" href="<?php echo esc_url( $sc_shop_url ); ?>"><?php esc_html_e( 'Explore Ingredients', 'skincare-clean' ); ?></a>
			</div>

			<?php
			$key_ingredients = array(
				array( 'key' => 'niacinamide', 'name' => 'Niacinamide', 'desc' => 'A Vitamin B3 derivative known for brightening tone, refining the look of pores, and strengthening the skin barrier.' ),
				array( 'key' => 'centella-asiatica', 'name' => 'Centella Asiatica', 'desc' => 'A calming Korean botanical extract widely used to soothe irritation and support barrier repair.' ),
				array( 'key' => 'ginseng-exosome', 'name' => 'Ginseng Exosome', 'desc' => "A Korean-sourced active that supports the skin's natural renewal process and helps calm inflammation." ),
				array( 'key' => 'hyaluronic-acid', 'name' => 'Hyaluronic Acid', 'desc' => 'A powerful humectant that draws in and holds moisture for lasting hydration.' ),
				array( 'key' => 'ceramides', 'name' => 'Ceramides', 'desc' => 'Lipids that reinforce the skin barrier and help prevent moisture loss.' ),
				array( 'key' => 'retinol', 'name' => 'Retinol', 'desc' => 'A well-studied Vitamin A derivative known for improving the appearance of fine lines and uneven texture.' ),
			);
			?>

			<div class="sc-formula-visual">
				<?php foreach ( $key_ingredients as $i => $ing ) :
					$img_rel  = '/assets/img/ingredients/' . $ing['key'] . '.jpeg';
					$img_path = get_template_directory() . $img_rel;
					// The bundled PNGs are ~2 KB placeholder gradients. Show a large icon + name on top of them
					// until a real photo (anything over ~20 KB) replaces the file.
					$is_placeholder = ! file_exists( $img_path ) || filesize( $img_path ) < 20000;
					?>
					<div class="sc-formula-slide<?php echo 0 === $i ? ' is-active' : ''; ?>" data-ing="<?php echo esc_attr( $ing['key'] ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() . $img_rel ); ?>" alt="<?php echo esc_attr( $ing['name'] ); ?>" loading="lazy" />
						<?php if ( $is_placeholder ) : ?>
							<div class="sc-formula-placeholder">
								<?php //echo sc_ingredient_icon( $ing['key'] ); ?>
								<span><?php //echo esc_html( $ing['name'] ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>

			<ul class="sc-formula-list">
				<?php foreach ( $key_ingredients as $i => $ing ) : ?>
					<li>
						<button type="button" class="sc-formula-item<?php echo 0 === $i ? ' is-active' : ''; ?>" data-ing="<?php echo esc_attr( $ing['key'] ); ?>" aria-pressed="<?php echo 0 === $i ? 'true' : 'false'; ?>">
							<span class="sc-formula-radio" aria-hidden="true"></span>
							<span class="sc-formula-text">
								<span class="sc-formula-name"><?php echo esc_html( $ing['name'] ); ?></span>
								<span class="sc-formula-desc"><?php echo esc_html( $ing['desc'] ); ?></span>
							</span>
						</button>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>

<section class="sc-section alt" id="skin-concerns">
	<div class="container">
		<div class="sc-section-head" style="text-align:left; max-width:100%; margin-bottom:24px;">
			<!--span class="sc-eyebrow"><?php esc_html_e( 'Not Sure Where to Begin?', 'skincare-clean' ); ?></span-->
			<h2><?php esc_html_e( 'Shop by Concerns', 'skincare-clean' ); ?></h2>
		</div>
		<?php
		$concerns = array(
			'aging'       => __( 'Aging', 'skincare-clean' ),
			'congestion'    => __( 'Congestion', 'skincare-clean' ),
			'dryness'          => __( 'Dryness', 'skincare-clean' ),
			//'eye_care' => __( 'Eye Care', 'eye_care' ),
			'redness'       => __( 'Redness', 'redness' ),
			'texture'    => __( 'Texture', 'texture' ),
		);
		?>
		<div class="sc-concern-scroll-wrap" data-sc-concern-scroll>
			<div class="sc-concern-grid-big">
				<?php foreach ( $concerns as $key => $label ) : ?>
					<a class="sc-concern-photo" href="<?php echo esc_url( sc_concern_url( $key ) ); ?>">
						<div class="sc-concern-photo-visual" style="background-image:url('<?php echo esc_url( get_template_directory_uri() . '/assets/img/concerns/' . $key . '.jpeg' ); ?>');"></div>
						<span><?php echo esc_html( $label ); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
			<button class="sc-concern-scroll-arrow prev" data-sc-concern-prev aria-label="<?php esc_attr_e( 'Previous', 'skincare-clean' ); ?>">&#8249;</button>
			<button class="sc-concern-scroll-arrow next" data-sc-concern-next aria-label="<?php esc_attr_e( 'Next', 'skincare-clean' ); ?>">&#8250;</button>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="container">
		<div class="sc-section-head">
			<!--span class="sc-eyebrow"><?php esc_html_e( 'Skincare, Simplified', 'skincare-clean' ); ?></span-->
			<h2><?php esc_html_e( 'Build Your Regimen.', 'skincare-clean' ); ?></h2>
		</div>
		<?php
		$routines = array(
			'morning' => array(
				'label' => __( 'Morning Routine', 'skincare-clean' ),
				'steps' => array(
					array( 'step' => __( 'Cleanse', 'skincare-clean' ), 'slug' => 'klar-glo-hydrating-cleanser' ),
					array( 'step' => __( 'Tone', 'skincare-clean' ), 'slug' => 'klar-glo-skin-tonic' ),
					array( 'step' => __( 'Treat', 'skincare-clean' ), 'slug' => 'klar-glo-glow-serum' ),
					array( 'step' => __( 'Moisturize', 'skincare-clean' ), 'slug' => 'klar-glo-hydra-gel-cream' ),
					array( 'step' => __( 'Protect', 'skincare-clean' ), 'slug' => 'klar-glo-sunscreen' ),
				),
			),
			'evening' => array(
				'label' => __( 'Evening Routine', 'skincare-clean' ),
				'steps' => array(
					array( 'step' => __( 'Cleanse', 'skincare-clean' ), 'slug' => 'klar-glo-hydrating-cleanser' ),
					array( 'step' => __( 'Tone', 'skincare-clean' ), 'slug' => 'klar-glo-skin-tonic' ),
					array( 'step' => __( 'Treat', 'skincare-clean' ), 'slug' => 'klar-glo-glow-serum' ),
					array( 'step' => __( 'Repair', 'skincare-clean' ), 'slug' => 'klar-glo-night-cream' ),
				),
			),
		);
		foreach ( $routines as $key => $routine ) {
			echo '<div class="sc-routine-block">';
			echo '<h3 class="sc-routine-subhead">' . esc_html( $routine['label'] ) . '</h3>';
			echo '<div class="sc-routine-row">';
			foreach ( $routine['steps'] as $i => $s ) {
				$product = get_page_by_path( $s['slug'], OBJECT, 'product' );
				$title   = $product ? get_the_title( $product->ID ) : ucwords( str_replace( array( 'klar-glo-', '-' ), array( '', ' ' ), $s['slug'] ) );
				$link    = $product ? get_permalink( $product->ID ) : '#';
				$thumb   = $product ? sc_product_thumb_markup( $product->ID, $title ) : '';
				echo '<div class="sc-routine-step">';
			//	echo '<span class="sc-routine-num">' . esc_html( $i + 1 ) . '</span>';
				echo '<a href="' . esc_url( $link ) . '" class="sc-routine-thumb">' . $thumb . '</a>';
				echo '<span class="sc-routine-step-label">' . esc_html( $s['step'] ) . '</span>';
				echo '<a href="' . esc_url( $link ) . '" class="sc-routine-title">' . '' . '</a>';
				echo '</div>';
				if ( $i < count( $routine['steps'] ) - 1 ) {
					echo '<span class="sc-routine-arrow">&#8250;</span>';
				}
			}
			echo '</div>';
			echo '</div>';
		}
		?>
	</div>
</section>

<?php
// Promo tiles: Corporate Gift + Klar Glo Rewards (shown after "Build Your Regimen")
$sc_shop_link  = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
$sc_gift_page  = get_page_by_path( 'corporate-gift' );
$sc_rw_page    = get_page_by_path( 'klar-glo-rewards' );
$sc_promo_tiles = array(
	array(
		'key'      => 'gift',
		'title'    => get_theme_mod( 'sc_promo1_title', 'Corporate Gift' ),
		'sub'      => get_theme_mod( 'sc_promo1_sub', 'Premium skincare gift sets for teams & clients' ),
		'btn'      => get_theme_mod( 'sc_promo1_btn', 'Shop Now' ),
		'url'      => get_theme_mod( 'sc_promo1_url', '' ) ?: ( $sc_gift_page ? get_permalink( $sc_gift_page ) : home_url( '/corporate-gift/' ) ),
		'image'    => get_theme_mod( 'sc_promo1_image', '' ) ?: get_template_directory_uri() . '/assets/img/promo/corporate-gift.svg',
	),
	array(
		'key'      => 'rewards',
		'title'    => get_theme_mod( 'sc_promo2_title', 'Klar Glo Rewards' ),
		'sub'      => get_theme_mod( 'sc_promo2_sub', 'Earn points. Secure the Glo' ),
		'btn'      => get_theme_mod( 'sc_promo2_btn', 'Show more' ),
		'url'      => get_theme_mod( 'sc_promo2_url', '' ) ?: ( $sc_rw_page ? get_permalink( $sc_rw_page ) : home_url( '/klar-glo-rewards/' ) ),
		'image'    => get_theme_mod( 'sc_promo2_image', '' ) ?: get_template_directory_uri() . '/assets/img/promo/rewards.svg',
	),
);
?>
<section class="sc-section alt sc-promo-section" aria-label="<?php esc_attr_e( 'Corporate gifting and rewards', 'skincare-clean' ); ?>">
	<div class="container">
		<div class="sc-promo-grid">
			<?php foreach ( $sc_promo_tiles as $tile ) : ?>
				<div class="sc-promo-card sc-promo-<?php echo esc_attr( $tile['key'] ); ?>">
					<a class="sc-promo-media" href="<?php echo esc_url( $tile['url'] ); ?>" tabindex="-1" aria-hidden="true">
						<?php if ( $tile['image'] ) : ?>
							<img src="<?php echo esc_url( $tile['image'] ); ?>" alt="" loading="lazy" />
						<?php endif; ?>
					</a>
					<div class="sc-promo-body">
						<h3 class="sc-promo-title"><a href="<?php echo esc_url( $tile['url'] ); ?>"><?php echo esc_html( $tile['title'] ); ?></a></h3>
						<?php if ( $tile['sub'] ) : ?><p class="sc-promo-sub"><?php echo esc_html( $tile['sub'] ); ?></p><?php endif; ?>
						<a class="sc-promo-btn" href="<?php echo esc_url( $tile['url'] ); ?>"><?php echo esc_html( $tile['btn'] ); ?></a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJ386MST"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php get_footer(); ?>