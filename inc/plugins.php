<?php 

// Custom Functions for Installed Plugins

// If the Indieweb Taxonomy Plugin is installed, add its display function to the theme
if (function_exists('get_response_display')) :
function indieweb_taxonomy_display($content)
    {
        $c = get_response_display() . $content;
        return $c;
    }
 add_filter( 'entry_content', 'indieweb_taxonomy_display', 20 );

endif;


?>
