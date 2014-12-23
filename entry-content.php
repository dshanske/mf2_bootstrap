<?php
        if (!has_post_format('standard')&&!is_search() ) {
        $entrycontent = "";
        $entrycontent .='<div class="entry-content e-content">';
       $entrycontent .= apply_filters( 'the_content', get_the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mf2_bootstrap' ) )); 
	$entrycontent .= '</div><!-- .entry-content -->';
	// entry_content allows data to be inserted above/below the content
	echo apply_filters ('entry_content', $entrycontent);
	// Pagination outside the content div
                        wp_link_pages( array(
                                'before' => '<div class="page-links">' . __( 'Pages:', 'mf2_bootstrap' ),
                                'after'  => '</div>',
                        ) );
	}
	else { // Display only the excerpt
	   echo '<div class="entry-summary">';
           the_excerpt();
           echo '</div><!-- .entry-summary -->';
             }
?>
