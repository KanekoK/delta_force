<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */

get_header(); ?>
	<div class="header-container">
        <header class="entry-header <?php if(has_post_thumbnail()){ echo 'has-featured'; }?> single-header" >
            <div class="black-overlay"></div>
            <div class="container">
                <h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'the-dylan' ); ?></h1>
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
                
                            <section class="error-404 not-found">
                                <div class="page-content">
                                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'the-dylan' ); ?></p>
             
                                    <?php get_search_form(); ?>
            
                                    <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
            
                                    <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
                
                                </div><!-- .page-content -->
                            </section><!-- .error-404 -->
                		</div>
                        <div class="col-md-4">
                        	<?php  get_sidebar(); ?>
                        </div>
                	</div>
                </div>
                
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

