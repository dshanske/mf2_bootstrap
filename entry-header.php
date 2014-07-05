<?php 
// Entry Header for a Standard Format
?>


        <header class="entry-header">
                <?php 
			$format = get_post_format();
			if ($format==false) {	$format = 'standard'; }
			the_title( sprintf( '<h1 class="p-name entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
				
			if ($format==='status') { echo mf2_bootstrap_posted_by_pic(); }
			else if ((has_post_thumbnail()) && ($format === 'standard') ) {	the_post_thumbnail('thumbnail', array('class' => 'thumbnail pull-left')); } 

			 ?>
                <div class="entry-meta">
                        <?php
				$top = "";
				switch ($format) {
				   case 'standard':
					$top .= mf2_bootstrap_comment_number();
                               		$top .= mf2_bootstrap_posted_on();
                             		$top .= mf2_bootstrap_posted_by();
					// $top .= mf2_bootstrap_post_format();
					if (!is_single())
					     {
                                       		$top .= mf2_bootstrap_post_categories();
                               		 	$top .= mf2_bootstrap_post_tags();
				     	     }
				   break;
				   default:
				}
                                echo apply_filters( 'header_entry_meta' , $top);
                        ?>
                </div>
        </header><!-- .entry-header -->
	

