<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */

get_header(); ?>

	
    <div class="header-container">
		<?php the_post_thumbnail( 'single-post-thumbnail', array( 'class' => 'single-post-thumbnail' ) ); ?>
        <header class="entry-header <?php if(has_post_thumbnail()){ echo 'has-featured'; }?> single-header" >
            <div class="black-overlay"></div>
            <div class="container">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'template-parts/content', 'page' ); ?>
    
                                <?php
    
                                    // If comments are open or we have at least one comment, load up the comment template.
    
                                    if ( comments_open() || get_comments_number() ) :
                                        comments_template();
    
                                    endif;
                                ?>
    
                            <?php endwhile; // End of the loop. ?>
    
                        </div>
                        <div class="col-md-4">
                            <?php get_sidebar(); ?>
                        </div>
                    </div>
                </div><!-- .white-bg -->
                
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

