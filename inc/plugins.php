<?php 

// Custom Functions for Installed Plugins

// If the Indieweb Taxonomy Plugin is installed, add its display function to the theme
if(function_exists('content_response_top')){
     add_filter( 'above_content', 'content_response_top', 20 );
   }


?>
