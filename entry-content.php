<?php
        $content = "";
        $content .='<div class="entry-content e-content">';
        $content .= the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mf2_bootstrap' ) );
	$content .= '</div><!-- .entry-content -->';
	// entry_content allows data to be inserted above/below the content
	echo apply_filters ('entry_content', $content)
	// Pagination outside the content div
                        wp_link_pages( array(
                                'before' => '<div class="page-links">' . __( 'Pages:', 'mf2_bootstrap' ),
                                'after'  => '</div>',
                        ) );

?>
