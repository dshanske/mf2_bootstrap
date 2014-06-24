<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package mf2_bootstrap
 */

if ( ! function_exists( 'mf2_bootstrap_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function mf2_bootstrap_paging_nav($pages = '', $range = 2) {

$showitems = ($range * 2)+1;

global $paged;
if(empty($paged)) $paged = 1;

if($pages == '')
{
global $wp_query;
$pages = $wp_query->max_num_pages;
if(!$pages)
{
$pages = 1;
}
}

if(1 != $pages)
{
echo "<ul class='pagination pagination-md'>";
if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

for ($i=1; $i <= $pages; $i++)
{
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
{
echo ($paged == $i)? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
}
}

if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
echo "</ul>\n";
}
}

endif;


if ( ! function_exists( 'mf2_bootstrap_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function mf2_bootstrap_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'mf2_bootstrap' ); ?></h1>
		<ul class="nav-links pager">
			<?php
				previous_post_link( '<li class="nav-previous previous">%link</li>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'mf2_bootstrap' ) );
				next_post_link(     '<li class="nav-next next">%link</li>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'mf2_bootstrap' ) );
			?>
		</ul><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

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
                esc_attr( get_the_date( 'c' ) ),
                esc_html( get_the_date( 'F j, Y g:i a') ),
                esc_attr( get_the_modified_date( 'c' ) ),
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
        $c = sprintf( '<span class="p-author h-card"><a class="url fn n" href="%1$s" rel="author">%2$s</a></span>',
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
        $tags_list = get_the_tag_list( '', __( ', ', 'mf2_bootstrap' ) );
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
       $number = get_comments_number(); 
       if ( ! post_password_required() && ( comments_open() && $number != '0' ) ) {
                $c .= '<span class="comments-link">';
		$c .= '<a title="Responses" href="' . get_comments_link() . '">' . $number . '</a>';
		$c .= '</span>';

	        }
		return $c;
	}
endif;

if ( ! function_exists( 'mf2_bootstrap_post_format' ) ) :
/**
 * Return HTML for the post format of the current post.
 */
function mf2_bootstrap_post_format () {
	$c = "";
	$format = get_post_format();
	if (false!=$format)
		{
			$c .= '<span class="entry-format"><a class="' . strtolower(get_post_format_string($format)) . '" ';
			$c .= 'href="' . get_post_format_link( $format ) . ' ">';
			$c .= get_post_format_string( $format ) .  '</a></span>';
        	}
	else {
			$c .= '<span class="entry-format"><a class="standard" href="' . home_url() . '">ARTICLE</a></span>';
	     }
	return $c;
	}
endif;


?>
