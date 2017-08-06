<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */

get_header(); ?>
	<div class="header-container">
        <header class="entry-header <?php if(has_post_thumbnail()){ echo 'has-featured'; }?> single-header" >
            <div class="black-overlay"></div>
            <div class="container">
                <?php
					the_archive_title( '<h1 class="entry-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
            </div>
        </header><!-- .entry-header -->
    </div>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
			<?php 
				$count = 1;
			?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="<?php if ($count % 2 == 0) { echo 'even'; }else{ echo 'odd'; } ?>">
					<?php
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );
                         $count++;
                    ?>
                </div>

			<?php endwhile; ?>
			<?php 
				the_posts_pagination( array(
					'mid_size' => 2,
					'prev_text' => __( '<span class="fa fa-chevron-left"></span>', 'the-dylan' ),
					'next_text' => __( '<span class="fa fa-chevron-right"></span>', 'the-dylan' ),
				) ); 
			?>
		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
