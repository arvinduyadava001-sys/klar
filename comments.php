<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( post_password_required() ) return;
?>
<div class="sc-comments">
	<?php if ( have_comments() ) : ?>
		<h3><?php comments_number( __( 'No Comments', 'skincare-clean' ), __( '1 Comment', 'skincare-clean' ), __( '% Comments', 'skincare-clean' ) ); ?></h3>
		<ol class="comment-list">
			<?php wp_list_comments( array( 'style' => 'ol', 'short_ping' => true ) ); ?>
		</ol>
		<?php the_comments_pagination(); ?>
	<?php endif; ?>

	<?php if ( comments_open() ) comment_form(); else : ?>
		<p><?php esc_html_e( 'Comments are closed.', 'skincare-clean' ); ?></p>
	<?php endif; ?>
</div>
