<?php
/**
 * Skincare Clean theme functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SC_THEME_VERSION', '1.0.2-' . time() );

/** ---------------------------------------------------------
 * Theme setup
 * --------------------------------------------------------- */
function sc_setup() {
	load_theme_textdomain( 'skincare-clean', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 220,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' ); // WooCommerce compatibility, matches storefront-style layout

	register_nav_menus( array(
		'top-bar' => __( 'Top Announcement Bar', 'skincare-clean' ),
		'primary' => __( 'Primary Navigation', 'skincare-clean' ),
		'footer-1' => __( 'Footer Column 1', 'skincare-clean' ),
		'footer-2' => __( 'Footer Column 2', 'skincare-clean' ),
		'footer-3' => __( 'Footer Column 3', 'skincare-clean' ),
	) );
}
add_action( 'after_setup_theme', 'sc_setup' );

/** ---------------------------------------------------------
 * Enqueue styles & scripts
 * --------------------------------------------------------- */
function sc_scripts() {
	wp_enqueue_style( 'skincare-clean-style', get_stylesheet_uri(), array(), SC_THEME_VERSION );
	wp_enqueue_script( 'skincare-clean-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), SC_THEME_VERSION, true );

	wp_localize_script( 'skincare-clean-main', 'scTheme', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
	) );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sc_scripts' );

/** ---------------------------------------------------------
 * Widgets
 * --------------------------------------------------------- */
function sc_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'skincare-clean' ),
		'id'            => 'shop-sidebar',
		'before_widget' => '<div class="sc-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'sc_widgets_init' );

/** ---------------------------------------------------------
 * Excerpt length / more
 * --------------------------------------------------------- */
add_filter( 'excerpt_length', function( $length ) { return 22; } );
add_filter( 'excerpt_more', function( $more ) { return '&hellip;'; } );

/** ---------------------------------------------------------
 * Includes
 * --------------------------------------------------------- */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/product-details.php';
require get_template_directory() . '/inc/checkout.php';
require get_template_directory() . '/inc/offers.php';
require get_template_directory() . '/inc/otp-login.php';

/** ---------------------------------------------------------
 * WooCommerce theme support tweaks
 * --------------------------------------------------------- */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

function sc_woocommerce_loop_columns() {
	return 4;
}
add_filter( 'loop_shop_columns', 'sc_woocommerce_loop_columns' );

/** ---------------------------------------------------------
 * Move the product Description out of the tabs and place it
 * wherever you like on the single product page.
 * --------------------------------------------------------- */

// 1) Remove "Description" from the default tabs (Additional Info / Reviews stay).
add_filter( 'woocommerce_product_tabs', function( $tabs ) {
	unset( $tabs['description'] );
	return $tabs;
} );

// The subtitle, feature checkmarks, and "Key Actives & Benefits" / "How to Use" /
// "Full Ingredients" accordions (see inc/product-details.php) now cover what the
// short description AND the old full-width Description block used to show —
// so both are disabled below to avoid repeating the same copy twice.
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

/** ---------------------------------------------------------
 * "Buy It Now" button — add to cart then jump straight to
 * checkout instead of staying on the cart/product page.
 * The button (in our add-to-cart templates) submits the
 * normal cart form with an extra hidden field: buy_now=1.
 * --------------------------------------------------------- */
add_filter( 'woocommerce_add_to_cart_redirect', function( $url ) {
	if ( ! empty( $_REQUEST['buy_now'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return wc_get_checkout_url();
	}
	return $url;
} );
function sc_render_product_volume() {
	echo '<div class="sc-product-volume">30 ML</div>';
}
add_action( 'woocommerce_single_product_summary', 'sc_render_product_volume', 11 );

/** ---------------------------------------------------------
 * Single product: remove the "Related products" block.
 * (Hooked late on 'wp' so WooCommerce has already registered its
 * template hooks; the filter + CSS in style.css are extra safety.)
 * --------------------------------------------------------- */
function sc_remove_related_products() {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}
add_action( 'wp', 'sc_remove_related_products', 20 );
add_filter( 'woocommerce_related_products', '__return_empty_array', 99 );

// ---- KLAR & GLO Contact Form ----
function klar_contact_form_shortcode() {
    $status = isset($_GET['contact']) ? sanitize_key($_GET['contact']) : '';
    ob_start(); ?>
    <div class="klar-contact-wrap">
        <?php if ($status === 'success') : ?>
            <div class="klar-msg klar-success">Thank you! Aapka message mil gaya hai, hum jaldi reply karenge.</div>
        <?php elseif ($status === 'error') : ?>
            <div class="klar-msg klar-error">Kuch galat ho gaya. Kripya sabhi fields sahi se bharein aur dobara try karein.</div>
        <?php endif; ?>

        <form class="klar-contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="klar_contact">
            <?php wp_nonce_field('klar_contact', 'klar_contact_nonce'); ?>

            <!-- honeypot (bots ke liye) -->
            <div style="position:absolute;left:-9999px;" aria-hidden="true">
                <input type="text" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="klar-row">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="klar-row">
                <input type="tel" name="phone" placeholder="Phone Number (optional)">
                <input type="text" name="subject" placeholder="Subject">
            </div>
            <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('klar_contact_form', 'klar_contact_form_shortcode');

// ---- Enquiries: custom post type (admin list) ----
function klar_register_enquiry_cpt() {
    register_post_type('klar_enquiry', [
        'labels' => [
            'name'          => 'Enquiries',
            'singular_name' => 'Enquiry',
            'menu_name'     => 'Enquiries',
            'all_items'     => 'All Enquiries',
            'edit_item'     => 'View Enquiry',
            'search_items'  => 'Search Enquiries',
            'not_found'     => 'Abhi tak koi enquiry nahi aayi.',
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-email-alt',
        'menu_position' => 26,
        'supports'      => [],
        'capability_type' => 'post',
        'capabilities'  => ['create_posts' => 'do_not_allow'], // admin me "Add New" band
        'map_meta_cap'  => true,
    ]);
}
add_action('init', 'klar_register_enquiry_cpt');

// ---- Form handler: save + email ----
function klar_handle_contact_form() {
    $redirect = wp_get_referer() ? remove_query_arg('contact', wp_get_referer()) : home_url('/');

    if (!isset($_POST['klar_contact_nonce']) || !wp_verify_nonce($_POST['klar_contact_nonce'], 'klar_contact')) {
        wp_safe_redirect(add_query_arg('contact', 'error', $redirect)); exit;
    }
    // honeypot
    if (!empty($_POST['website'])) {
        wp_safe_redirect(add_query_arg('contact', 'success', $redirect)); exit;
    }

    $name    = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $email   = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $phone   = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
    $subject = sanitize_text_field(wp_unslash($_POST['subject'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));

    if (!$name || !is_email($email) || !$message) {
        wp_safe_redirect(add_query_arg('contact', 'error', $redirect)); exit;
    }

    // 1) Admin list me save
    $post_id = wp_insert_post([
        'post_type'   => 'klar_enquiry',
        'post_status' => 'publish',
        'post_title'  => $name . ' - ' . ($subject ?: 'New enquiry'),
    ]);
    if ($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, '_klar_name', $name);
        update_post_meta($post_id, '_klar_email', $email);
        update_post_meta($post_id, '_klar_phone', $phone);
        update_post_meta($post_id, '_klar_subject', $subject);
        update_post_meta($post_id, '_klar_message', $message);
    }

    // 2) Email notification
    $to           = get_option('admin_email'); // ya apni email likh do
    $mail_subject = 'KLAR & GLO Contact: ' . ($subject ?: 'New enquiry');
    $body         = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
    $headers      = ['Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>'];
    wp_mail($to, $mail_subject, $body, $headers);

    // Enquiry save ho gayi to user ko success dikhao (mail fail ho tab bhi)
    $saved = ($post_id && !is_wp_error($post_id));
    wp_safe_redirect(add_query_arg('contact', $saved ? 'success' : 'error', $redirect));
    exit;
}

// ---- Admin list columns ----
function klar_enquiry_columns($cols) {
    return [
        'cb'      => $cols['cb'],
        'name'    => 'Name',
        'email'   => 'Email',
        'phone'   => 'Phone',
        'subject' => 'Subject',
        'date'    => 'Date',
    ];
}
add_filter('manage_klar_enquiry_posts_columns', 'klar_enquiry_columns');

function klar_enquiry_column_content($col, $post_id) {
    $get = function($k) use ($post_id) { return get_post_meta($post_id, $k, true); };
    switch ($col) {
        case 'name':
            echo '<strong><a href="' . esc_url(get_edit_post_link($post_id)) . '">' . esc_html($get('_klar_name')) . '</a></strong>';
            break;
        case 'email':
            echo '<a href="mailto:' . esc_attr($get('_klar_email')) . '">' . esc_html($get('_klar_email')) . '</a>';
            break;
        case 'phone':
            echo esc_html($get('_klar_phone') ?: '-');
            break;
        case 'subject':
            echo esc_html($get('_klar_subject') ?: '-');
            break;
    }
}
add_action('manage_klar_enquiry_posts_custom_column', 'klar_enquiry_column_content', 10, 2);

// ---- Enquiry detail (message dekhne ke liye) ----
function klar_enquiry_metabox() {
    add_meta_box('klar_enquiry_details', 'Enquiry Details', function($post) {
        $g = function($k) use ($post) { return get_post_meta($post->ID, $k, true); };
        echo '<table class="form-table"><tbody>';
        echo '<tr><th>Name</th><td>' . esc_html($g('_klar_name')) . '</td></tr>';
        echo '<tr><th>Email</th><td><a href="mailto:' . esc_attr($g('_klar_email')) . '">' . esc_html($g('_klar_email')) . '</a></td></tr>';
        echo '<tr><th>Phone</th><td>' . esc_html($g('_klar_phone') ?: '-') . '</td></tr>';
        echo '<tr><th>Subject</th><td>' . esc_html($g('_klar_subject') ?: '-') . '</td></tr>';
        echo '<tr><th>Message</th><td>' . nl2br(esc_html($g('_klar_message'))) . '</td></tr>';
        echo '<tr><th>Received</th><td>' . esc_html(get_the_date('d M Y, h:i A', $post)) . '</td></tr>';
        echo '</tbody></table>';
        echo '<p><a class="button button-primary" href="mailto:' . esc_attr($g('_klar_email')) . '?subject=' . rawurlencode('Re: ' . $g('_klar_subject')) . '">Reply by email</a></p>';
    }, 'klar_enquiry', 'normal', 'high');
}
add_action('add_meta_boxes', 'klar_enquiry_metabox');
add_action('admin_post_nopriv_klar_contact', 'klar_handle_contact_form');
add_action('admin_post_klar_contact', 'klar_handle_contact_form');


/** ---------------------------------------------------------
 * Cart page: "Proceed to checkout" + "Continue shopping"
 * --------------------------------------------------------- */
function sc_cart_action_buttons() {
	$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
	echo '<div class="sc-cart-actions">';
	echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="checkout-button button alt wc-forward sc-cart-checkout">' . esc_html__( 'Proceed to checkout', 'skincare-clean' ) . '</a>';
	echo '<a href="' . esc_url( $shop ) . '" class="button sc-cart-continue">' . esc_html__( 'Continue shopping', 'skincare-clean' ) . '</a>';
	echo '</div>';
}
add_action( 'wp', function () {
	remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
	add_action( 'woocommerce_proceed_to_checkout', 'sc_cart_action_buttons', 20 );
}, 30 );

// Block-based cart (newer WooCommerce): "Continue shopping" button directly UNDER "Proceed to Checkout".
add_filter( 'render_block_woocommerce/proceed-to-checkout-block', function ( $html ) {
	$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
	return $html . '<div class="wc-block-cart__submit-container sc-cart-continue-block"><a href="' . esc_url( $shop ) . '" class="wc-block-components-button wp-element-button wc-block-cart__submit-button contained sc-cart-continue"><span class="wc-block-components-button__text">' . esc_html__( 'Continue shopping', 'skincare-clean' ) . '</span></a></div>';
} );

add_filter( 'sc_corporate_gift_email', function () {
    return 'contactus@klarandglo.com'; // your address
} );