<?php
/**
 * Bootstrap Navigation Elements
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

?>
