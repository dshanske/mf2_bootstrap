<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package mf2_bootstrap
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer container-fluid" role="contentinfo">
		    <?php if ( dynamic_sidebar('footer-left') ) : else : endif; ?>
	             <?php if ( dynamic_sidebar('footer-middle') ) : else : endif; ?>
        	     <?php if ( dynamic_sidebar('footer-right') ) : else : endif; ?>
             <?php if ( dynamic_sidebar('footer-widget') ) : else : endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
