<?php

// Entry Footer for a Standard Format

?>
	<footer class="entry-footer">
                <div class="entry-meta">
                        <?php 
				$bottom="";
				$format = get_post_format();
                                if (!is_single()) $bottom .= mf2_bootstrap_comment_number();
                                if (false!=$format)
                                   {
                                $bottom .= mf2_bootstrap_posted_on();
                                $bottom .= mf2_bootstrap_posted_by();
				$bottom .= mf2_bootstrap_post_format();
                                if (!is_single())
                                     {
                                       $bottom .= mf2_bootstrap_post_categories();
                                        $bottom .= mf2_bootstrap_post_tags();
                                     }
                                  }
				else{
					if (is_single())
				    		{ 
					$bottom .= mf2_bootstrap_post_categories();
					$bottom .= mf2_bootstrap_post_tags();
		  				    }
				   }
				echo apply_filters( 'footer_entry_meta' , $bottom); 
			?>
                </div> <!-- .entry-meta -->
        </footer>

