<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */

get_header(); ?>

	<div class="header-container">
        <header class="entry-header <?php if(has_post_thumbnail()){ echo 'has-featured'; }?> single-header" >
            <div class="black-overlay"></div>
            <div class="container">
                <h1 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'the-dylan' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            </div>
        </header><!-- .entry-header -->
    </div>
    
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
            <div class="container">
            	<?php 
					$count = 1;
				?>
				<?php if ( have_posts() ) : ?>
                    
                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="row">
                        	<div class="<?php if ($count % 2 == 0) { echo 'even'; }else{ echo 'odd'; } ?>">
								<?php
                                /**
                                 * Run the loop for the search to output the results.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-search.php and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content', 'search' );
                                $count++;
                                ?>
                            </div>
        				</div>
                    <?php endwhile; ?>
                    
                    <?php if (function_exists("the_dylan_pagination")) {
                        the_dylan_pagination();							
                    }?>
                    
                <?php else : ?>
                    <div class="white-bg inner-wrapper">
                    	<div class="row">
                            <div class="col-md-8">
                                <?php get_template_part( 'template-parts/content', 'none' ); ?>
                            </div>
                            <div class="col-md-4">
                                <?php get_sidebar(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php 
					the_posts_pagination( array(
						'mid_size' => 2,
						'prev_text' => __( '<span class="fa fa-chevron-left"></span>', 'the-dylan' ),
						'next_text' => __( '<span class="fa fa-chevron-right"></span>', 'the-dylan' ),
					) ); 	
				?>

			</div><!-- .container -->
            
		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
