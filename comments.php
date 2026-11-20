<?php
/**
 * Comments template.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			printf(
				/* translators: %s: number of comments. */
				esc_html( _n( '%s komentārs', '%s komentāri', $comment_count, 'latvijai-futura' ) ),
				esc_html( number_format_i18n( $comment_count ) )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
					'callback'    => 'latvijai_comment',
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation(
			array(
				'prev_text' => latvijai_icon( 'chevron-left' ) . esc_html__( 'Vecākie komentāri', 'latvijai-futura' ),
				'next_text' => esc_html__( 'Jaunākie komentāri', 'latvijai-futura' ) . latvijai_icon( 'chevron-right' ),
			)
		);
		?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Komentāri šeit ir slēgti.', 'latvijai-futura' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'        => __( 'Pievienot komentāru', 'latvijai-futura' ),
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'label_submit'       => __( 'Publicēt komentāru', 'latvijai-futura' ),
			'class_submit'       => 'submit',
			'comment_field'      => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Komentārs', 'latvijai-futura' ) . '</label><textarea id="comment" name="comment" cols="45" rows="6" required></textarea></p>',
			'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Tava e-pasta adrese netiks publicēta. Obligātie lauki ir atzīmēti ar *.', 'latvijai-futura' ) . '</p>',
		)
	);
	?>
</section>
