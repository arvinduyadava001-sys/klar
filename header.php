<?php if ( ! defined( 'ABSPATH' ) ) exit; ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
<link rel="manifest" href="/site.webmanifest" />
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1768713077709876');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1768713077709876&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WJ386MST');</script>
<!-- End Google Tag Manager -->

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="sc-utility-bar">
	<div class="container">
		<a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'skincare-clean' ); ?></a>
		<a href="<?php echo esc_url( home_url( '/track-order/' ) ); ?>"><?php esc_html_e( 'Track Order', 'skincare-clean' ); ?></a>
		<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><?php esc_html_e( 'Log Out', 'skincare-clean' ); ?></a>
		<?php else : ?>
			<a href="#" data-sc-login-open><?php esc_html_e( 'Sign In', 'skincare-clean' ); ?></a>
		<?php endif; ?>
	</div>
</div>

<?php if ( function_exists( 'kg_render_announce_bar' ) ) : kg_render_announce_bar(); else : ?>
	<div class="sc-announce"><div class="sc-announce-track" data-sc-announce=""><span class="is-active" style="font-size:16px;">Free shipping </span></div></div>
<?php endif; ?>

<header class="sc-header">
	<div class="sc-header-inner">
		<button class="sc-menu-toggle" aria-label="<?php esc_attr_e( 'Toggle menu', 'skincare-clean' ); ?>" data-sc-menu-toggle>
			<span></span><span></span><span></span>
		</button>

		<div class="sc-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sc-logo-link" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/klar-glo-logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="sc-logo-img" /></a>
		</div>

		<nav class="sc-nav" data-sc-nav>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => 'sc_default_menu',
				'walker'         => new SC_Nav_Walker(),
			) );
			?>
		</nav>

		<div class="sc-header-icons">
			<button type="button" class="sc-icon-btn" data-sc-search-open aria-label="<?php esc_attr_e( 'Search', 'skincare-clean' ); ?>" aria-expanded="false" aria-controls="sc-search-panel" title="<?php esc_attr_e( 'Search', 'skincare-clean' ); ?>">
				<svg class="sc-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
				<span class="sc-label screen-reader-text"><?php esc_html_e( 'Search', 'skincare-clean' ); ?></span>
			</button>
			<?php if ( is_user_logged_in() && function_exists( 'wc_get_page_permalink' ) ) : ?>
			<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" aria-label="<?php esc_attr_e( 'My account', 'skincare-clean' ); ?>" title="<?php esc_attr_e( 'My account', 'skincare-clean' ); ?>">
			<?php else : ?>
			<a href="#" data-sc-login-open aria-label="<?php esc_attr_e( 'Login', 'skincare-clean' ); ?>" title="<?php esc_attr_e( 'Login', 'skincare-clean' ); ?>">
			<?php endif; ?>
				<svg class="sc-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
				<span class="sc-label screen-reader-text"><?php esc_html_e( 'Login', 'skincare-clean' ); ?></span>
			</a>
			<?php
			// GloCoin wallet: coin balance next to the account icon (only for logged-in customers, only when the GloCoin plugin is active).
			if ( is_user_logged_in() && class_exists( 'KGC_Ledger' ) && class_exists( 'KGC_Settings' ) && KGC_Settings::enabled() && function_exists( 'wc_get_endpoint_url' ) ) :
				$sc_coins = (int) KGC_Ledger::balance( get_current_user_id() );
				$sc_wallet_url = wc_get_endpoint_url( 'glocoin-wallet', '', wc_get_page_permalink( 'myaccount' ) );
				/* translators: %s = number of coins */
				$sc_wallet_title = sprintf( __( 'My GloCoin Wallet: %s coins', 'skincare-clean' ), number_format_i18n( $sc_coins ) );
			?>
			<a href="<?php echo esc_url( $sc_wallet_url ); ?>" class="sc-wallet-link" aria-label="<?php echo esc_attr( $sc_wallet_title ); ?>" title="<?php echo esc_attr( $sc_wallet_title ); ?>">
				<svg class="sc-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"></circle><path d="M15.5 9.5a4 4 0 1 0 0 5V12H12"></path></svg>
				<span class="sc-wallet-count"><?php echo esc_html( number_format_i18n( $sc_coins ) ); ?></span>
			</a>
			<?php endif; ?>
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="sc-cart-link" aria-label="<?php esc_attr_e( 'Cart', 'skincare-clean' ); ?>" title="<?php esc_attr_e( 'Cart', 'skincare-clean' ); ?>">
					<svg class="sc-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
					<span class="sc-label screen-reader-text"><?php esc_html_e( 'Cart', 'skincare-clean' ); ?></span>
					<span class="sc-cart-count"><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></span>
				</a>
			<?php else : ?>
				<a href="#" class="sc-cart-link" aria-label="<?php esc_attr_e( 'Cart', 'skincare-clean' ); ?>" title="<?php esc_attr_e( 'Cart', 'skincare-clean' ); ?>">
					<svg class="sc-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
					<span class="sc-label screen-reader-text"><?php esc_html_e( 'Cart', 'skincare-clean' ); ?></span> <span class="sc-cart-count">0</span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</header>

<div class="sc-search-panel" id="sc-search-panel" data-sc-search-panel hidden>
	<div class="sc-search-panel-inner">
		<form role="search" method="get" class="sc-search-panel-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<svg class="sc-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
			<input type="search" name="s" autocomplete="off" data-sc-search-input placeholder="<?php esc_attr_e( 'Search products, ingredients, blogs&hellip;', 'skincare-clean' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'skincare-clean' ); ?>">
			<button type="submit" class="sc-search-submit"><?php esc_html_e( 'Search', 'skincare-clean' ); ?></button>
			<button type="button" class="sc-search-close" data-sc-search-close aria-label="<?php esc_attr_e( 'Close search', 'skincare-clean' ); ?>">&times;</button>
		</form>
		<div class="sc-search-results" data-sc-search-results aria-live="polite"></div>
	</div>
</div>

<?php sc_render_otp_login_modal(); ?>

<?php
function sc_default_menu() {
	$home = home_url( '/' );

	// Blog link: use the site's actual "Posts page" if one is set in
	// Settings > Reading, otherwise fall back to /blog.
	$blog_page_id = (int) get_option( 'page_for_posts' );
	$blog_url     = $blog_page_id ? get_permalink( $blog_page_id ) : home_url( '/blog' );

	// About link: use a real "About" page if one exists on the site.
	$about_page = get_page_by_path( 'about' );
	if ( ! $about_page ) {
		$about_page = get_page_by_path( 'about-us' );
	}
	$about_url = $about_page ? get_permalink( $about_page ) : home_url( '/about' );

	echo '<ul><li><a href="' . esc_url( $home ) . '">' . esc_html__( 'Home', 'skincare-clean' ) . '</a></li>
	<li><a href="' . esc_url( home_url( '/shop' ) ) . '">' . esc_html__( 'Shop', 'skincare-clean' ) . '</a></li>
	<li><a href="' . esc_url( $home . '#corporate-gift' ) . '">' . esc_html__( 'Gifting', 'skincare-clean' ) . '</a></li>
	<li><a href="' . esc_url( $home . '#skin-concerns' ) . '">' . esc_html__( 'Skin concerns', 'skincare-clean' ) . '</a></li>
	<li><a href="' . esc_url( $blog_url ) . '">' . esc_html__( 'Blogs', 'skincare-clean' ) . '</a></li>
	<li><a href="' . esc_url( $about_url ) . '">' . esc_html__( 'About', 'skincare-clean' ) . '</a></li></ul>';
}