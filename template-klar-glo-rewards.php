<?php
/**
 * Template Name: Klar Glo Rewards
 * Description: Rewards programme page - how it works, ways to earn, FAQ and shop / account buttons.
 *
 * NOTE: All wording below is placeholder copy. Edit the arrays to match your actual rewards rules.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$sc_shop_url    = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
$sc_account_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url();

$sc_rw_steps = array(
	array( 'title' => 'Sign Up', 'text' => 'Create your KLAR & GLO account to join the rewards programme.' ),
	array( 'title' => 'Shop & Earn', 'text' => 'Earn rewards on every order you place with us.' ),
	array( 'title' => 'Redeem', 'text' => 'Use your rewards on your next purchase at checkout.' ),
);

$sc_rw_earn = array(
	array( 'title' => 'On Every Purchase', 'text' => 'Rewards are added to your account after each order.' ),
	array( 'title' => 'Reviews', 'text' => 'Share your experience with a product and earn bonus rewards.' ),
	array( 'title' => 'Refer a Friend', 'text' => 'Invite friends to KLAR & GLO and earn when they order.' ),
);

$sc_rw_faq = array(
	array( 'q' => 'How do I join Klar Glo Rewards?', 'a' => 'Create an account or log in at checkout — you are enrolled automatically.' ),
	array( 'q' => 'When are rewards credited?', 'a' => 'Rewards are credited to your account once your order is delivered.' ),
	array( 'q' => 'How do I redeem my rewards?', 'a' => 'Your available balance can be applied at checkout on your next order.' ),
	array( 'q' => 'Do rewards expire?', 'a' => 'Please see the terms shown in your account for the validity of your rewards.' ),
);
?>
<main class="sc-rw-page">

	<section class="sc-page-hero sc-rw-hero">
		<div class="container sc-page-hero-inner">
			<div class="sc-page-hero-copy">
				<span class="sc-eyebrow"><?php esc_html_e( 'Loyalty Programme', 'skincare-clean' ); ?></span>
				<h1><?php the_title(); ?></h1>
				<p><?php esc_html_e( 'Earn & redeem rewards on every purchase. The more you glow, the more you save.', 'skincare-clean' ); ?></p>
				<div class="sc-page-hero-actions">
					<a class="sc-btn" href="<?php echo esc_url( $sc_shop_url ); ?>"><?php esc_html_e( 'Shop Now', 'skincare-clean' ); ?></a>
					<a class="sc-btn outline" href="<?php echo esc_url( $sc_account_url ); ?>"><?php esc_html_e( is_user_logged_in() ? 'My Account' : 'Login / Sign Up', 'skincare-clean' ); ?></a>
				</div>
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="sc-page-hero-media"><?php the_post_thumbnail( 'large' ); ?></div>
			<?php endif; ?>
		</div>
	</section>

	<section class="sc-section">
		<div class="container">
			<div class="sc-section-head"><h2><?php esc_html_e( 'How It Works', 'skincare-clean' ); ?></h2></div>
			<div class="sc-cg-benefits">
				<?php foreach ( $sc_rw_steps as $i => $s ) : ?>
					<div class="sc-cg-benefit">
						<span class="sc-cg-num"><?php echo esc_html( $i + 1 ); ?></span>
						<h3><?php echo esc_html( $s['title'] ); ?></h3>
						<p><?php echo esc_html( $s['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="sc-section alt">
		<div class="container">
			<div class="sc-section-head"><h2><?php esc_html_e( 'Ways to Earn', 'skincare-clean' ); ?></h2></div>
			<div class="sc-cg-benefits">
				<?php foreach ( $sc_rw_earn as $e ) : ?>
					<div class="sc-cg-benefit">
						<h3><?php echo esc_html( $e['title'] ); ?></h3>
						<p><?php echo esc_html( $e['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
	while ( have_posts() ) : the_post();
		if ( trim( get_the_content() ) ) : ?>
			<section class="sc-section sc-cg-editor">
				<div class="container"><div class="sc-entry-content"><?php the_content(); ?></div></div>
			</section>
		<?php endif;
	endwhile;
	?>

	<section class="sc-section">
		<div class="container sc-rw-faq-wrap">
			<div class="sc-section-head"><h2><?php esc_html_e( 'Frequently Asked Questions', 'skincare-clean' ); ?></h2></div>
			<div class="sc-rw-faq">
				<?php foreach ( $sc_rw_faq as $f ) : ?>
					<details>
						<summary><?php echo esc_html( $f['q'] ); ?></summary>
						<p><?php echo esc_html( $f['a'] ); ?></p>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="sc-section alt sc-center">
		<div class="container">
			<h2><?php esc_html_e( 'Start earning today', 'skincare-clean' ); ?></h2>
			<a class="sc-btn" href="<?php echo esc_url( $sc_shop_url ); ?>"><?php esc_html_e( 'Shop Now', 'skincare-clean' ); ?></a>
		</div>
	</section>

</main>
<?php get_footer(); ?>
