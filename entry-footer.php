<?php

// Entry Footer

?>
	<footer class="entry-footer clearfix">
                <div class="entry-meta">
                        <?php 
				$bottom="";                                                                     if (function_exists ( 'get_post_kind'))
                            	    {
                                	$kind = get_post_kind($post->ID);
                            	    }
                        	else {
                                	if(!get_post_format())
                                   	   {
                                        	$kind = 'article';
                                   	   }
                                	else {
                                        	$kind = 'aside';
                                     	     }
                             	     }

                                if (!is_single()) $bottom .= mf2_bootstrap_comment_number();
                                
				switch ($kind) {
    					case 'article':
                                	break;
					case 'note':
                                              $bottom .= mf2_bootstrap_posted_on();
                                              $bottom .= mf2_bootstrap_post_tags();
					break;
					default:
                                                $bottom .= mf2_bootstrap_posted_on();
                                                $bottom .= mf2_bootstrap_posted_by();
						$bottom .= mf2_bootstrap_post_tags();
 //                                             $bottom .= mf2_bootstrap_post_kind();
	                                        
                                        }
				if (is_single())
				    { 
					$bottom .= mf2_bootstrap_post_categories();
		  		    }
				echo apply_filters( 'footer_entry_meta' , $bottom); 
			?>
                </div> <!-- .entry-meta -->
        </footer>

