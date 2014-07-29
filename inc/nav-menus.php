<?php

if (!function_exists('navbar_class') ) {
  function navbar_class()
    {
	echo '';
    }
}

add_action( 'init', 'social_register_nav_menus' );

function social_register_nav_menus() {
	register_nav_menu( 'social', __( 'Social', 'indieweb' ) );
}

function add_search_nav_item_to_social($items, $args) {
  if (!is_admin() && $args->theme_location == 'social') {
    $items .= '<li><a href="#" class="search-button" data-toggle="modal" data-target="#searchmodal"></a></li>';
  }
  return $items;
}
add_filter( 'wp_nav_menu_items', 'add_search_nav_item_to_social', 10, 2 );



?>
