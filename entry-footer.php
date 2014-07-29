<?php

// Entry Footer

?>
	<footer class="entry-footer clearfix">
                <div class="entry-meta">
                        <?php 
				$bottom="";
				$format = get_post_format();
                                if (!is_single()) $bottom .= mf2_bootstrap_comment_number();
                                if (false===$format)
                                   {
					$format = 'standard';
				   }
				switch ($format) {
    					case 'standard':
                                	break;
					case 'status':
                                              $bottom .= mf2_bootstrap_posted_on();
                                              $bottom .= mf2_bootstrap_post_tags();
					break;
					default:
                                                $bottom .= mf2_bootstrap_posted_on();
                                                $bottom .= mf2_bootstrap_posted_by();
						$bottom .= mf2_bootstrap_post_tags();
                                                $bottom .= mf2_bootstrap_post_format();
                                     }
				if (is_single())
				    { 
					$bottom .= mf2_bootstrap_post_categories();
		  		    }
				echo apply_filters( 'footer_entry_meta' , $bottom); 
			?>
                </div> <!-- .entry-meta -->
        </footer>

