<?php

/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */

get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
    	<div class="header-container">
            <?php the_post_thumbnail( 'single-post-thumbnail', array( 'class' => 'single-post-thumbnail' ) ); ?>
            <header class="entry-header <?php if(has_post_thumbnail()){ echo 'has-featured'; }?> single-header" >
                <div class="black-overlay"></div>
                <div class="container">
					<?php
                        if ( is_single() ) {
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        } else {
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                        }
                    if ( 'post' === get_post_type() ) : ?>
                        <div class="entry-meta">
                            <?php the_dylan_posted_on(); ?>
                        </div><!-- .entry-meta -->
                        <?php
                    endif; ?>
                </div>
            </header><!-- .entry-header -->
        </div>
        
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="container">
                
                    <div class="white-bg inner-wrapper">
                        <div class="row">
                            <div class="col-md-8">
                            	<div class="breadcrumb-container">
									<?php the_dylan_breadcrumb(); ?>
                                </div>
                                <?php get_template_part( 'template-parts/content', 'single' ); ?>
                        
                                <?php
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if ( comments_open() || get_comments_number() ) :
                                        comments_template();
                                    endif;
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?php get_sidebar(); ?>
                            </div>
                        </div>
                    </div><!-- .white-bg -->
                    
                </div>
            </main><!-- #main -->
        </div><!-- #primary -->
    <?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>

