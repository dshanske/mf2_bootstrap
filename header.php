<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package mf2_bootstrap
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class("container-fluid" ); ?>>
<div id="page" class="site row">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'mf2_bootstrap' ); ?></a>

	<header id="masthead" class="site-header row" role="banner">
		<div class="site-branding">
		    <?php if ( get_header_image() ) { ?>
                        	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        	<img src="<?php header_image(); ?>" class="aligncenter col-md-12" alt=""></a>
                     <?php } // End header image check. 
	            else {
		           if ( get_theme_mod( 'mf2_logo' ) ) { ?> // if Logo Display
				<div class="col-md-3 col-xs-4">
    					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="site-logo" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img class="logo" src="<?php echo get_theme_mod( 'mf2_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
				} // end if logo display		    
			   else { ?> if no logo and no header
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
			      <?php  } ?>
			    </div>
			<div class="col-md-8 col-lg-8 col-xs-12 header-widget hidden-xs hidden-sm pull-left">
	     			<?php if ( dynamic_sidebar('headerwidget') ) : else : endif; ?>
			</div>
		  <?php } ?>
		</div> <?php // end site-branding? ?>
<nav class="navbar navbar-default <?php navbar_class(); ?> row" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo ('name' ); ?></a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'top_menu',
            'depth' => 2,
            'container' => false,
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'wp_page_menu',
            //Process nav menu using our custom nav walker
            'walker' => new wp_bootstrap_navwalker())
        );
        ?>
	  <?php get_template_part( 'menu', 'social' ); ?>

    </div><!-- /.navbar-collapse --> 
<div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="searchmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title" id="searchLabel">Search This Site</h4>
            </div>
            <div class="modal-body">
                <?php get_search_form(); ?>
            </div>
    </div>
  </div>
</div>

</nav>

	</header><!-- #masthead -->
	
	<div id="content" class="site-content container">
