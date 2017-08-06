<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-dylan' ),
                'after'  => '</div>',
            ) );
        ?>

        <?php the_post_navigation(); ?>

	</div><!-- .entry-content -->
    
</article><!-- #post-## -->



