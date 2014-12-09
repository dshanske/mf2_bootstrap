<?php
/**
 * Entry meta data functions for this theme. These functions return formatted metadata
 *
 *
 * @package mf2_bootstrap
 */

if ( ! function_exists( 'mf2_bootstrap_posted_on' ) ) :
/**
 * returns HTML with meta information for the current post-date/time.
 */
function mf2_bootstrap_posted_on() {
        $time_string = '<time class="dt-published" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                $time_string .= '<time class="dt-updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
                esc_attr( get_the_date( DATE_W3C ) ),
                esc_html( get_the_date( 'F j, Y g:i a') ),
                esc_attr( get_the_modified_date( DATE_W3C ) ),
                esc_html( get_the_modified_date() )
        );

        $c = sprintf( __( '<span class="posted-on">%1$s</span>', 'mf2_bootstrap' ),
                sprintf( '<a href="%1$s" title="Date" class="u-url" rel="bookmark">%2$s</a>',
                        esc_url( get_permalink() ),
                        $time_string
                )
        );
	return $c;
}
endif;

if ( ! function_exists( 'mf2_bootstrap_posted_by' ) ) :
/**
 * Returns HTML with meta information for the current post-date/time and author.
 */
function mf2_bootstrap_posted_by() {
        $c = sprintf( '<span class="h-card vcard p-author"><a title="View all Posts by this Author" class="u-url url fn n" href="%1$s" rel="author">%2$s</a></span>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )),
                get_the_author()
        );
	return $c;
}
endif;

if ( ! function_exists( 'mf2_bootstrap_posted_by_pic' ) ) :
/**
 * Return HTML for picture for the current author.
 */
function mf2_bootstrap_posted_by_pic() {
        $c = sprintf( '<span class="p-author h-card vcard author-pic"><a class="url fn n" href="%1$s" rel="author">%2$s</a></span>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_avatar( get_the_author_meta( 'ID' ), 48 )
        );
	return $c; 
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function mf2_bootstrap_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mf2_bootstrap_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mf2_bootstrap_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mf2_bootstrap_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mf2_bootstrap_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mf2_bootstrap_categorized_blog.
 */
function mf2_bootstrap_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'mf2_bootstrap_categories' );
}
add_action( 'edit_category', 'mf2_bootstrap_category_transient_flusher' );
add_action( 'save_post',     'mf2_bootstrap_category_transient_flusher' );


if ( ! function_exists( 'mf2_bootstrap_post_tags' ) ) :
/**
 * Returns HTML for tags for the current post.
 */
function mf2_bootstrap_post_tags () {
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '<span class="p-category">', __( '</span> , <span class="p-category">', 'mf2_bootstrap' ), '</span>' );
	$c = "";
        if ( $tags_list ) 
              {               	
                   $c .= sprintf( __( '<span class="tags-links">%1$s</span>', 'mf2_bootstrap' ), $tags_list );                                       
              }
	return $c;
                                       
}
endif;

if ( ! function_exists( 'mf2_bootstrap_post_categories' ) ) :
/**
 * Return HTML for categories for the current post.
 */
function mf2_bootstrap_post_categories () {
	$cat ="";
	$c = ""; 
        // $categories_list = get_the_category_list( __( ', ', 'mf2_bootstrap' ) );
	 foreach((get_the_category()) as $category) {
 		   if ($category->cat_name != 'Uncategorized') {
    			$cat .= '<a class="p-category" href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ';
}
}	
	if ($cat != "")
	   {
		$c .= '<span class="cat-links">' . $cat . '</span>';
	   }
	return $c;
}
endif;

if ( ! function_exists( 'mf2_bootstrap_comment_number' ) ) :
/**
 * Return HTML if comments for the current post.
 */
function mf2_bootstrap_comment_number () {
       $c = "";
       $number = comment_count(); 
       if ( ! post_password_required() && ( comments_open() && $number != '0' ) ) {
                $c .= '<span class="comments-link">';
		$c .= '<a title="Comments" href="' . get_comments_link() . '">' . $number . '</a>';
		$c .= '</span>';
		$number = webmention_count();
		if ($number != '0')
		{
			$c .= '<span class="mentions-link">';
               		$c .= '<a title="Mentions" href="' . get_permalink() . '#mentions">' . $number . '</a>';
             		$c .= '</span>';
		}
	 }
		return $c;
	}
endif;

if ( ! function_exists( 'mf2_bootstrap_post_format' ) ) :
/**
 * Return HTML for the post format of the current post.
 */
function mf2_bootstrap_post_format ($nm = false) {
	$c = "";
	$format = get_post_format();
	if (false!=$format)
		{
			$c .= '<span class="entry-format"><a class="' . strtolower(get_post_format_string($format)) . '" ';
			$c .= 'href="' . get_post_format_link( $format ) . ' ">';
			if ($nm == true)
			   {
			$c .= get_post_format_string( $format );
		           } 
			$c .= '</a></span>';
        	}
	else {
			$c .= '<span class="entry-format"><a class="standard" href="' . home_url() . '/type/standard/">';
			if ($nm == true)
			   {
				$c .= 'ARTICLE';
			   }
			$c .= '</a></span>';
	     }
	return $c;
	}
endif;


/**
 * Don't count pingbacks or trackbacks when determining
 * the number of comments on a post.
 */
if (!function_exists('comment_count')) :
function comment_count( $count = "" ) {
	global $id;
	$comment_count = 0;
	$comments = get_approved_comments( $id );
	foreach ( $comments as $comment ) {
		if ( $comment->comment_type === '' ) {
			$comment_count++;
		}
	}
	return $comment_count;
}
endif;

/**
 * Count webmentions
 * 
 */
if (!function_exists('webmention_count')) :
function webmention_count( $count= "" ) {
	global $id;
	$comment_count = 0;
	$comments = get_approved_comments( $id );
	foreach ( $comments as $comment ) {
		if ( $comment->comment_type === 'webmention' ) {
			$comment_count++;
		}
	}
	return $comment_count;
}
endif;

/**
 * Only count pingbacks or trackbacks when determining
 * the number of comments on a post.
 */
if (!function_exists('ping_count')) :
function ping_count($count = "") {
	global $id;
	$comment_count = 0;
	$comments = get_approved_comments( $id );
	foreach ( $comments as $comment ) {
		if (( $comment->comment_type === 'trackback' )||( $comment->comment_type === 'pingback')) {
			$comment_count++;
		}
	}
	return $comment_count;
}
endif;

function new_excerpt_more( $more ) {
	return '... <span class="btn btn-default read-more"> <a href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a></span>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


?>
