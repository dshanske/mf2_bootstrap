<?php 

// Add Header Widget

function header_widget_init() {

	register_sidebar( array(
		'name' => 'Header Widget',
		'id' => 'headerwidget',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<span>',
		'after_title' => '</span>',
	) );
}
add_action( 'widgets_init', 'header_widget_init' );

function footer_widget_init() {

        register_sidebar( array(
                'name' => 'Footer Widget',
                'id' => 'footerwidget',
                'before_widget' => '<li>',
                'after_widget' => '</li>',
                'before_title' => '<span>',
                'after_title' => '</span>',
        ) );
}
add_action( 'widgets_init', 'footer_widget_init' );




?>
