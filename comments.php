<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package mf2_bootstrap
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'mf2_bootstrap' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'mf2_bootstrap' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mf2_bootstrap' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mf2_bootstrap' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>
		<?php $comments_by_type = &separate_comments($comments); ?>
              <?php if (!empty($comments_by_type['webmention'])) { ?>
                <h3>Mentions</h3>
                <?php } ?>
                <ul class="webmention-list media-list">
                        <?php
                                wp_list_comments(
                                array(
                                        'type'       => 'webmention',
                                        'callback'   => 'bootstrapwp_comment',
                                        'avatar_size'=> 75
                                )
                        );
                        ?>
                </ul><!-- .webmention-list -->
 
		<?php if (!empty($comments_by_type['comment'])) { ?>
                <h3>Comments</h3>
                <?php } ?>

                <ul class="comment-list media-list">
                        <?php
                                wp_list_comments(
                                array(
                                        'type'       => 'comment',
                                        'callback'   => 'bootstrapwp_comment',
                                        'avatar_size'=> 100
                                )
                        );
                        ?>
                </ul><!-- .comment-list -->
                <?php if (!empty($comments_by_type['pingback'])) { ?>
               <h3>Pingbacks</h3>
                               <?php } ?>
               <ul class="ping-list media-list">
                        <?php
                                wp_list_comments(
                                array(
                                        'type'       => 'pings',
                                        'callback'   => 'bootstrapwp_ping',
                                        'avatar_size'=> 100
                                )
                        );
                        ?>
                </ul><!-- .ping-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'mf2_bootstrap' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mf2_bootstrap' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mf2_bootstrap' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'mf2_bootstrap' ); ?></p>
	<?php endif; ?>
	<?php 
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$comment_args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => __( 'Leave a Reply' ),
  'title_reply_to'    => __( 'Leave a Reply to %s' ),
  'cancel_reply_link' => __( 'Cancel Reply' ),
  'label_submit'      => __( 'Respond' ),

  'comment_field' =>  '<div class="comment-form-comment form-group"><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label><textarea id="comment" class="form-control" name="comment" placeholder="What do you think?" rows="10" aria-required="true">' .
    '</textarea></div>',

  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '<p class="comment-notes">' .
    __( 'Your email address will not be published.' ) .
    '</p>',

  'comment_notes_after' => ' ',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<div class="comment-form-author form-group">' .
      '<input id="author" name="author" class="form-control" type="text" placeholder="Name" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></div>',

    'email' =>
      '<div class="comment-form-email form-group">' .
      '<input id="email" name="email" class="form-control type="email" placeholder="E-Mail" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></div>',

    'url' =>
      '<div class="comment-form-url form-group">' .
      '<input id="url" name="url" type="url" class="form-control" placeholder="URL (Optional)" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></div>'
    )
  ),
);			
		comment_form($comment_args); 
	?>

</div><!-- #comments -->
