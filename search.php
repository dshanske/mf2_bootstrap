<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package mf2_bootstrap
 */

get_header(); ?>

 <div id="primary" class="content-area col-md-8 col-xs-12">
                <main id="main" class="site-main" role="main">

            <?php if (have_posts()) : // Results Found ?>

                <h1><?php _e('Search Results'); ?></h1>
                <?php while (have_posts()) : the_post(); ?>

                <article <?php post_class(); ?>>
                    <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                    <div class="entry">
                        <p><?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?></p>
                    </div>
                </article>
                <hr />

                <?php endwhile; ?>

                <ul class="pager">
                    <li><?php next_posts_link('<i class="icon-chevron-left"></i>&nbsp; Older Results') ?></li>
                    <li><?php previous_posts_link('Newer Results &nbsp;<i class="icon-chevron-right"></i>') ?></li>
                </ul>

            <?php else : // No Results ?>

                <p><?php _e('Sorry. We couldn&rsquo;t find anything for that search. View one of our site&rsquo;s pages or a recent article below.'); ?></p>
                <div class="row">
                    <div class="col-md-6 posts">
                        <h3><?php _e('Recent Articles'); ?></h3>
                        <ul>
                            <?php
                                $args = array(
                                    'numberposts' => '10',
                                    'post_status' => 'publish'
                                );
                                $recent_posts = wp_get_recent_posts( $args );
                                foreach( $recent_posts as $recent ) {
                                    echo '<li><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"] . '</a></li>';
                                }
                            ?>
                        </ul>
                    </div> <!-- .posts -->
                    <div class="col-md-6 pages">
                        <h3><?php _e('Page Sitemap'); ?></h3>
                        <ul>
                            <?php wp_list_pages('title_li=&sort_column=menu_order'); ?>
                        </ul>
                    </div> <!-- .pages -->

            <?php endif; ?>
    </main>
</div><!-- .content-area -->
<?php get_sidebar(); 
      get_footer();
?>
