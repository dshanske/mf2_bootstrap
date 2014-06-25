<?php 
// Entry Header for a Standard Format
?>


        <header class="entry-header">
                <?php 
			$format = get_post_format();
			if (false===$format)
				{
			the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
				}
			 ?>
                <div class="entry-meta">
                        <?php
				$top = "";
				if (false===$format)
				   {
				$top .= mf2_bootstrap_comment_number();
                                $top .= mf2_bootstrap_posted_on();
                                $top .= mf2_bootstrap_posted_by();
				$top .= mf2_bootstrap_post_format();
				if (!is_single())
				     {
                                       $top .= mf2_bootstrap_post_categories();
                               	 	$top .= mf2_bootstrap_post_tags();
				     }
				  }
                                echo apply_filters( 'header_entry_meta' , $top);
                        ?>
                </div>
        </header><!-- .entry-header -->
	

