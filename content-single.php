<?php
/**
 * @package mf2_bootstrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('h-entry'); ?>>
	
	<?php get_template_part( 'entry', 'header' ); ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content e-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mf2_bootstrap' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mf2_bootstrap' ),
				'after'  => '</div>',
			) );
	
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	
	<?php get_template_part( 'entry', 'footer' ); ?>
	
	<div class="comment-display">
	<?php
           if (is_single())
              {
	         // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || '0' != get_comments_number() ) :
                                        comments_template();
                                endif;
	      }
	
 ?>
          
      
     
	</div><!-- .comment display -->
</article><!-- #post-## -->
