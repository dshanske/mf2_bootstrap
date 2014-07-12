<?php 

// Add Header Widget

function header_widget_init() {

	register_sidebar( array(
		'name' => 'Header Widget',
		'id' => 'headerwidget',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span>',
		'after_title' => '</span>',
	) );
}
add_action( 'widgets_init', 'header_widget_init' );

function footer_widget_init() {

        register_sidebar( array(
                'name' => 'Footer Widget',
                'id' => 'footer-widget',
                'before_widget' => '<div id="%1$s" class="widget col-md-12 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<span>',
                'after_title' => '</span>',
        ) );
	register_sidebar( array(
                'name' => 'Footer Left Widget',
                'id' => 'footer-left',
                'before_widget' => '<div id="%1$s" class="widget col-lg-3 col-md-2 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<span>',
                'after_title' => '</span>',
        ) );
        register_sidebar( array(
                'name' => 'Footer Middle Widget',
                'id' => 'footer-middle',
                'before_widget' => '<div  id="%1$s" class="widget col-lg-3 col-md-2  %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<span>',
                'after_title' => '</span>',
        ) );
        register_sidebar( array(
                'name' => 'Footer Right Widget',
                'id' => 'footer-right',
                'before_widget' => '<div id="%1$s" class="widget col-lg-3 col-md-2 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<span>',
                'after_title' => '</span>',
        ) );


}
add_action( 'widgets_init', 'footer_widget_init' );




?>
