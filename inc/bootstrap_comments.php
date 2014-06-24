<?php

/**
 * Display template for pingbacks and trackbacks.
 *
 */

add_action('comment_form', 'mf2_bootstrap_comment_button' );
function mf2_bootstrap_comment_button() {
    echo '<button class="btn btn-primary" type="submit">' . __( 'Respond' ) . '</button>';
}


if (!function_exists('bootstrapwp_ping')) :
    function bootstrapwp_ping($comment, $args, $depth)
    {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );
	?>
	<div <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
		<div class="ping-body" id="div-ping-<?php comment_ID(); ?>">
 
			<div class="ping-author h-card vcard">
				<div class="ping-meta-wrapper">
					<span class="ping-meta">
						<?php
						printf(  '<cite class="fn u-url">%s</cite>', get_comment_author_link() );
						printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() );
						?>
					</span><!-- .ping-meta -->
				</div><!-- .ping-meta-wrapper -->
			</div><!-- .ping-author -->
 
			<div class="ping-text p-summary">
				<?php comment_text(); ?>
			</div><!-- .ping-text -->
 
		</div><!-- .ping-body -->
	</div><!-- #div-ping-<?php comment_ID(); ?>-->
	<?php               
    }
endif;

/**
 * Display template for comments.
 *
 */
if (!function_exists('bootstrapwp_comment')) :
    function bootstrapwp_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
                // Proceed with normal comments.
                global $post; ?>
                <li class="p-comment h-entry h-cite comment media" id="li-comment-<?php comment_ID(); ?>">
                        <a href="<?php echo $comment->comment_author_url;?>" class="pull-left">
                            <?php echo get_avatar($comment, 64); ?>
                        </a>
                        <div class="media-body">
			    <a href="" class="in-reply-to"></a>
                            <h4 class="media-heading comment-author p-author vcard h-card">
                                <?php
                                printf('<cite class="fn">%1$s %2$s</cite>',
                                    get_comment_author_link(),
                                    // If current post author is also comment author, make it known visually.
                                    ($comment->user_id === $post->post_author) ? '<span class="label"> ' . __(
                                        'Post author',
                                        'indieweb'
                                    ) . '</span> ' : ''); ?>
                            </h4>

                            <?php if ('0' == $comment->comment_approved) : ?>
                                <p class="comment-awaiting-moderation"><?php _e(
                                    'Your comment is awaiting moderation.',
                                    'indieweb'
                                ); ?></p>
                            <?php endif; ?>

                            <span class"p-summary"><?php comment_text(); ?></span>
                            <p class="meta">
                                <?php printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                            esc_url(get_comment_link($comment->comment_ID)),
                                            get_comment_time('c'),
                                            sprintf(
                                                __('%1$s at %2$s', 'indieweb'),
                                                get_comment_date(),
                                                get_comment_time()
                                            )
                                        ); ?>
                            </p>
                            <p class="reply">
                                <?php comment_reply_link( array_merge($args, array(
                                            'reply_text' => __('<span title="Reply" class="genericon genericon-reply"></span>', 'indieweb'),
                                            'depth'      => $depth,
                                            'max_depth'  => $args['max_depth']
                                        )
                                    )); ?>
                            </p>
                        </div>
                        <!--/.media-body -->
                <?php
    }
endif;

?>
