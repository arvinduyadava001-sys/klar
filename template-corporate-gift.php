<?php
/**
 * Template Name: Corporate Gift
 * Description: Corporate gifting page - benefits, bulk enquiry form and Shop Now button.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ---------------------------------------------------------
 * Handle enquiry form (runs before any output)
 * --------------------------------------------------------- */
$sc_cg_status = isset( $_GET['cg'] ) ? sanitize_key( wp_unslash( $_GET['cg'] ) ) : '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['sc_cg_nonce'] ) ) {
	$back = get_permalink();
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sc_cg_nonce'] ) ), 'sc_cg_enquiry' ) ) {
		wp_safe_redirect( add_query_arg( 'cg', 'error', $back ) . '#gift-enquiry' );
		exit;
	}
	// Honeypot: bots fill this hidden field.
	if ( ! empty( $_POST['sc_cg_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'cg', 'sent', $back ) . '#gift-enquiry' );
		exit;
	}
	$name    = isset( $_POST['sc_cg_name'] ) ? sanitize_text_field( wp_unslash( $_POST['sc_cg_name'] ) ) : '';
	$company = isset( $_POST['sc_cg_company'] ) ? sanitize_text_field( wp_unslash( $_POST['sc_cg_company'] ) ) : '';
	$email   = isset( $_POST['sc_cg_email'] ) ? sanitize_email( wp_unslash( $_POST['sc_cg_email'] ) ) : '';
	$phone   = isset( $_POST['sc_cg_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['sc_cg_phone'] ) ) : '';
	$qty     = isset( $_POST['sc_cg_qty'] ) ? sanitize_text_field( wp_unslash( $_POST['sc_cg_qty'] ) ) : '';
	$message = isset( $_POST['sc_cg_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['sc_cg_message'] ) ) : '';

	if ( ! $name || ! is_email( $email ) || ! $phone ) {
		wp_safe_redirect( add_query_arg( 'cg', 'invalid', $back ) . '#gift-enquiry' );
		exit;
	}

	$to      = apply_filters( 'sc_corporate_gift_email', get_option( 'admin_email' ) );
	$subject = sprintf( '[%s] Corporate gift enquiry from %s', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ), $name );
	$body    = "Name: {$name}\nCompany: {$company}\nEmail: {$email}\nPhone: {$phone}\nApprox. quantity: {$qty}\n\nMessage:\n{$message}\n";
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
	$ok      = wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'cg', $ok ? 'sent' : 'error', $back ) . '#gift-enquiry' );
	exit;
}

get_header();

$sc_shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );

$sc_cg_benefits = array(
	array( 'title' => 'Curated Gift Sets', 'text' => 'Hand-picked KLAR & GLO combinations for clients, teams and celebrations.' ),
	array( 'title' => 'Bulk Order Pricing', 'text' => 'Special pricing for larger quantities. Tell us your requirement and we will get back to you.' ),
	array( 'title' => 'Personal Touch', 'text' => 'Ask us about custom gift notes and packaging options for your order.' ),
);
?>
<main class="sc-cg-page">

	<section class="sc-page-hero sc-cg-hero">
		<div class="container sc-page-hero-inner">
			<div class="sc-page-hero-copy">
				<span class="sc-eyebrow"><?php esc_html_e( 'KLAR & GLO', 'skincare-clean' ); ?></span>
				<h1><?php the_title(); ?></h1>
				<p><?php esc_html_e( 'Thoughtful, skin-friendly gifts for your clients, employees and partners — Korean-inspired skincare, beautifully simple.', 'skincare-clean' ); ?></p>
				<div class="sc-page-hero-actions">
					<a class="sc-btn" href="<?php echo esc_url( $sc_shop_url ); ?>"><?php esc_html_e( 'Shop Now', 'skincare-clean' ); ?></a>
					<a class="sc-btn outline" href="#gift-enquiry"><?php esc_html_e( 'Bulk Enquiry', 'skincare-clean' ); ?></a>
				</div>
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="sc-page-hero-media"><?php the_post_thumbnail( 'large' ); ?></div>
			<?php endif; ?>
		</div>
	</section>

	<section class="sc-section">
		<div class="container">
			<div class="sc-section-head">
				<h2><?php esc_html_e( 'Why Gift KLAR & GLO', 'skincare-clean' ); ?></h2>
			</div>
			<div class="sc-cg-benefits">
				<?php foreach ( $sc_cg_benefits as $i => $b ) : ?>
					<div class="sc-cg-benefit">
						<span class="sc-cg-num"><?php echo esc_html( $i + 1 ); ?></span>
						<h3><?php echo esc_html( $b['title'] ); ?></h3>
						<p><?php echo esc_html( $b['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
	// Anything added in the page editor shows here.
	while ( have_posts() ) : the_post();
		$extra = trim( get_the_content() );
		if ( $extra ) : ?>
			<section class="sc-section sc-cg-editor">
				<div class="container"><div class="sc-entry-content"><?php the_content(); ?></div></div>
			</section>
		<?php endif;
	endwhile;
	?>

	<section class="sc-section alt" id="gift-enquiry">
		<div class="container">
			<div class="sc-cg-form-wrap">
				<div class="sc-section-head">
					<h2><?php esc_html_e( 'Corporate Gifting Enquiry', 'skincare-clean' ); ?></h2>
					<p><?php esc_html_e( 'Share a few details and our team will get in touch with options and pricing.', 'skincare-clean' ); ?></p>
				</div>

				<?php if ( 'sent' === $sc_cg_status ) : ?>
					<div class="sc-form-notice is-success" role="status"><?php esc_html_e( 'Thank you! Your enquiry has been received. We will contact you shortly.', 'skincare-clean' ); ?></div>
				<?php elseif ( 'invalid' === $sc_cg_status ) : ?>
					<div class="sc-form-notice is-error" role="alert"><?php esc_html_e( 'Please fill in your name, a valid email and phone number.', 'skincare-clean' ); ?></div>
				<?php elseif ( 'error' === $sc_cg_status ) : ?>
					<div class="sc-form-notice is-error" role="alert"><?php esc_html_e( 'Sorry, something went wrong. Please try again.', 'skincare-clean' ); ?></div>
				<?php endif; ?>

				<?php if ( 'sent' !== $sc_cg_status ) : ?>
				<form class="sc-cg-form" method="post" action="<?php echo esc_url( get_permalink() . '#gift-enquiry' ); ?>">
					<?php wp_nonce_field( 'sc_cg_enquiry', 'sc_cg_nonce' ); ?>
					<div class="sc-cg-row">
						<label><span><?php esc_html_e( 'Name *', 'skincare-clean' ); ?></span><input type="text" name="sc_cg_name" required></label>
						<label><span><?php esc_html_e( 'Company', 'skincare-clean' ); ?></span><input type="text" name="sc_cg_company"></label>
					</div>
					<div class="sc-cg-row">
						<label><span><?php esc_html_e( 'Email *', 'skincare-clean' ); ?></span><input type="email" name="sc_cg_email" required></label>
						<label><span><?php esc_html_e( 'Phone *', 'skincare-clean' ); ?></span><input type="tel" name="sc_cg_phone" required></label>
					</div>
					<label><span><?php esc_html_e( 'Approximate quantity', 'skincare-clean' ); ?></span><input type="text" name="sc_cg_qty" placeholder="<?php esc_attr_e( 'e.g. 50 sets', 'skincare-clean' ); ?>"></label>
					<label><span><?php esc_html_e( 'Message', 'skincare-clean' ); ?></span><textarea name="sc_cg_message" rows="4"></textarea></label>
					<div class="sc-hp" aria-hidden="true"><label>Website <input type="text" name="sc_cg_website" tabindex="-1" autocomplete="off"></label></div>
					<button type="submit" class="sc-btn"><?php esc_html_e( 'Send Enquiry', 'skincare-clean' ); ?></button>
				</form>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="sc-section sc-center">
		<div class="container">
			<h2><?php esc_html_e( 'Ready to browse the range?', 'skincare-clean' ); ?></h2>
			<a class="sc-btn" href="<?php echo esc_url( $sc_shop_url ); ?>"><?php esc_html_e( 'Shop Now', 'skincare-clean' ); ?></a>
		</div>
	</section>

</main>
<?php get_footer(); ?>
