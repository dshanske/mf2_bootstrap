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

function top_widget_init() {

        register_sidebar( array(
                'name' => 'Top Widget',
                'id' => 'topwidget',
                'before_widget' => '<div>',
                'after_widget' => '</div>',
                'before_title' => '<span>',
                'after_title' => '</span>',
        ) );
}
// add_action( 'widgets_init', 'top_widget_init' );




?>
