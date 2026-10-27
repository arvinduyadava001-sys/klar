<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<section class="sc-newsletter">
	<!--div class="container">
		<span class="sc-eyebrow"><?php esc_html_e( 'Newsletter', 'skincare-clean' ); ?></span>
		<h2><?php // esc_html_e( 'Stay In Touch.', 'skincare-clean' ); ?></h2>
		<form class="sc-newsletter-form" action="#" method="post">
			<input type="email" name="EMAIL" placeholder="<?php esc_attr_e( 'Email Address', 'skincare-clean' ); ?>" required>
			<button type="submit"><?php esc_html_e( 'Subscribe', 'skincare-clean' ); ?></button>
		</form>
		<small><?php esc_html_e( 'By subscribing you agree to receive marketing emails. You can unsubscribe at any time.', 'skincare-clean' ); ?></small>
	</div-->
</section>

<footer class="sc-footer">
	<div class="container">
		<div class="sc-footer-grid">
			<div class="sc-footer-col">
				<h4><?php esc_html_e( 'Company', 'skincare-clean' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer-1' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer-1', 'container' => false, 'items_wrap' => '<ul>%3$s</ul>' ) );
				} else {
					echo '<ul>
						<li><a href="' . esc_url( home_url( '/about-us/' ) ) . '">' . esc_html__( 'About Us', 'skincare-clean' ) . '</a></li>
						<li><a href="' . esc_url( home_url( '/contact-us/' ) ) . '">' . esc_html__( 'Contact Us', 'skincare-clean' ) . '</a></li>
					</ul>';
				}
				?>
			</div>
			<div class="sc-footer-col">
				<h4><?php esc_html_e( 'Our Commitments', 'skincare-clean' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer-2' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer-2', 'container' => false, 'items_wrap' => '<ul>%3$s</ul>' ) );
				} else {
					echo '<ul>
						<li><a href="' . esc_url( home_url( '/shipping-policy/' ) ) . '">' . esc_html__( 'Shipping Policy', 'skincare-clean' ) . '</a></li>
						<li><a href="' . esc_url( home_url( '/return-policy/' ) ) . '">' . esc_html__( 'Return & Refund Policy', 'skincare-clean' ) . '</a></li>
						<li><a href="' . esc_url( home_url( '/terms-conditions/' ) ) . '">' . esc_html__( 'Terms & Conditions', 'skincare-clean' ) . '</a></li>
						<li><a href="' . esc_url( home_url( '/privacy-policy/' ) ) . '">' . esc_html__( 'Privacy Policy', 'skincare-clean' ) . '</a></li>
					</ul>';
				}
				?>
			</div>
			<div class="sc-footer-col">
				<h4><?php esc_html_e( 'Customer Care', 'skincare-clean' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer-3' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer-3', 'container' => false, 'items_wrap' => '<ul>%3$s</ul>' ) );
				} else {
					echo '<ul>
						<li><a href="' . esc_url( home_url( '/faq/' ) ) . '">' . esc_html__( 'FAQ', 'skincare-clean' ) . '</a></li>
						<li><a href="' . esc_url( home_url( '/track-order/' ) ) . '">' . esc_html__( 'Track Order', 'skincare-clean' ) . '</a></li>
						<li><a href="' . esc_url( function_exists( 'wc_get_account_endpoint_url' ) ? wc_get_account_endpoint_url( 'dashboard' ) : home_url( '/my-account/' ) ) . '">' . esc_html__( 'My Account', 'skincare-clean' ) . '</a></li>
					</ul>';
				}
				?>
			</div>
			<div class="sc-footer-col">
				<h4><?php esc_html_e( 'Get In Touch', 'skincare-clean' ); ?></h4>
				<!--p><?php esc_html_e( 'Marketed by Three Springs, C121, Sec 41, Noida 201301', 'skincare-clean' ); ?></p>
				<p><?php esc_html_e( 'Manufactured by Dermat India, 696, Pace City-II, Sector-37, Gurugram, Haryana-122004 (ISO & GMP Certified)', 'skincare-clean' ); ?></p-->
				<p>
    <a href="mailto:<?php echo esc_attr( get_bloginfo( 'admin_email' ) ); ?>">
        <?php echo esc_html( get_bloginfo( 'admin_email' ) ); ?>
    </a>
</p>

				<div class="sc-social">
					<a class="sc-social-fb" href="https://www.facebook.com/profile.php?id=61578721906552" aria-label="Facebook" target="_blank" rel="noopener">
						<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M22 12.06C22 6.51 17.52 2 12 2S2 6.51 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.51 1.49-3.9 3.77-3.9 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.78-1.63 1.57v1.88h2.78l-.45 2.91h-2.33V22c4.78-.76 8.44-4.92 8.44-9.94z"></path></svg>
					</a>
					<a class="sc-social-ig" href="https://www.instagram.com/klarandglo/" aria-label="Instagram" target="_blank" rel="noopener">
						<svg viewBox="0 0 24 24" width="16" height="16" fill="url(#sc-ig-grad)"><defs><radialGradient id="sc-ig-grad" cx="30%" cy="107%" r="150%"><stop offset="0" stop-color="#FED576"/><stop offset=".26" stop-color="#F47133"/><stop offset=".61" stop-color="#BC3081"/><stop offset="1" stop-color="#4C63D2"/></radialGradient></defs><path d="M12 2c2.72 0 3.06.01 4.12.06 1.06.05 1.79.22 2.43.47.66.26 1.22.6 1.77 1.15.55.55.9 1.11 1.15 1.77.25.64.42 1.37.47 2.43.05 1.06.06 1.4.06 4.12s-.01 3.06-.06 4.12c-.05 1.06-.22 1.79-.47 2.43-.26.66-.6 1.22-1.15 1.77-.55.55-1.11.9-1.77 1.15-.64.25-1.37.42-2.43.47-1.06.05-1.4.06-4.12.06s-3.06-.01-4.12-.06c-1.06-.05-1.79-.22-2.43-.47-.66-.26-1.22-.6-1.77-1.15-.55-.55-.9-1.11-1.15-1.77-.25-.64-.42-1.37-.47-2.43C2.01 15.06 2 14.72 2 12s.01-3.06.06-4.12c.05-1.06.22-1.79.47-2.43.26-.66.6-1.22 1.15-1.77.55-.55 1.11-.9 1.77-1.15.64-.25 1.37-.42 2.43-.47C8.94 2.01 9.28 2 12 2zm0 1.8c-2.67 0-2.99.01-4.04.06-.87.04-1.34.18-1.65.3-.42.16-.72.36-1.03.67-.31.31-.51.61-.67 1.03-.12.31-.26.78-.3 1.65C4.27 7.75 4.26 8.07 4.26 10.74v.52c0 2.67.01 2.99.06 4.04.04.87.18 1.34.3 1.65.16.42.36.72.67 1.03.31.31.61.51 1.03.67.31.12.78.26 1.65.3 1.05.05 1.37.06 4.04.06h.52c2.67 0 2.99-.01 4.04-.06.87-.04 1.34-.18 1.65-.3.42-.16.72-.36 1.03-.67.31-.31.51-.61.67-1.03.12-.31.26-.78.3-1.65.05-1.05.06-1.37.06-4.04v-.52c0-2.67-.01-2.99-.06-4.04-.04-.87-.18-1.34-.3-1.65-.16-.42-.36-.72-.67-1.03-.31-.31-.61-.51-1.03-.67-.31-.12-.78-.26-1.65-.3-1.05-.05-1.37-.06-4.04-.06H12zm0 3.25a4.95 4.95 0 1 1 0 9.9 4.95 4.95 0 0 1 0-9.9zm0 1.8a3.15 3.15 0 1 0 0 6.3 3.15 3.15 0 0 0 0-6.3zm5.15-1.99a1.16 1.16 0 1 1-2.31 0 1.16 1.16 0 0 1 2.31 0z"></path></svg>
					</a>
					<a class="sc-social-yt" href="#" aria-label="YouTube" target="_blank" rel="noopener">
						<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.51 3.5 12 3.5 12 3.5s-7.51 0-9.38.55A3.02 3.02 0 0 0 .5 6.19 31.6 31.6 0 0 0 0 12c0 1.95.17 3.9.5 5.81a3.02 3.02 0 0 0 2.12 2.14C4.49 20.5 12 20.5 12 20.5s7.51 0 9.38-.55a3.02 3.02 0 0 0 2.12-2.14c.33-1.91.5-3.86.5-5.81 0-1.95-.17-3.9-.5-5.81zM9.6 15.6V8.4l6.27 3.6-6.27 3.6z"></path></svg>
					</a>
				</div>
				<br/>
			<div class="container1">
		<span class="sc-eyebrow"><?php esc_html_e( 'Newsletter', 'skincare-clean1' ); ?></span>
		<h2><?php // esc_html_e( 'Stay In Touch.', 'skincare-clean' ); ?></h2>
		<form class="sc-newsletter-form" action="#" method="post">
			<input type="email" name="EMAIL" placeholder="<?php esc_attr_e( 'Email Address', 'skincare-clean' ); ?>" required>
			<button type="submit"><?php esc_html_e( 'Subscribe', 'skincare-clean' ); ?></button>
		</form>
		<small><?php esc_html_e( 'By subscribing you agree to receive marketing emails. You can unsubscribe at any time.', 'skincare-clean' ); ?></small>
	</div>
			</div>
		</div>

		<div class="sc-footer-bottom">
			<span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'skincare-clean' ); ?></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>