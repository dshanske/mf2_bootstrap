<?php
/**
 * The Template for displaying all single posts.
 *
 * @package mf2_bootstrap
 */

get_header(); ?>

	<div id="primary" class="content-area col-xs-12 col-sm-6 col-md-8">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

		 <?php // Include the post format-specific template for the content.
			$format = get_post_format();
			if ( false === $format ) {
				$format = 'standard';
			  }
			get_template_part( 'content', $format );
                 ?>


			<?php mf2_bootstrap_post_nav(); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
