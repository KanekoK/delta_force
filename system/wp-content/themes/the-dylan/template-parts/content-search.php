<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="blog-post-container" >
    	<div class="container">
            <div class="row white-bg">
            	
				<?php if(has_post_thumbnail()){ ?>
                    <div class="col-md-6 the-dylan-push-6">
                        <div class="img-container">
                            <a href="<?php the_permalink('') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('nomad-featured-thumbnails'); ?></a>
                        </div>
                    </div>
                    
                    <div class="col-md-6 the-dylan-pull-6">
                        <div class="post-details">
                            <header class="entry-header">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        
                                <?php if ( 'post' === get_post_type() ) : ?>
                                <div class="entry-meta">
                                    <?php the_dylan_posted_on(); ?>
                                </div><!-- .entry-meta -->
                                <?php endif; ?>
                            </header><!-- .entry-header -->
        
                            <div class="entry-content">
                                <?php
                                    the_excerpt();
                                ?>
                                    <a href="<?php the_permalink('') ?>" class="read_more"><?php _e( 'Read More', 'the-dylan' ); ?></a>
                                <?php
                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-dylan' ),
                                        'after'  => '</div>',
                                    ) );
                                ?>
                            </div><!-- .entry-content -->
                        </div>
                    </div>
                 <?php } else{?>
                 	<div class="col-md-12 no-featured">
                        <div class="post-details">
                            <header class="entry-header">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        
                                <?php if ( 'post' === get_post_type() ) : ?>
                                <div class="entry-meta">
                                    <?php the_dylan_posted_on(); ?>
                                </div><!-- .entry-meta -->
                                <?php endif; ?>
                            </header><!-- .entry-header -->
                            <div class="entry-content">
                                <?php
                                    the_excerpt();
                                ?>
                                    <a href="<?php the_permalink('') ?>" class="read_more"><?php _e( 'Read More', 'the-dylan' ); ?></a>
                                <?php
                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-dylan' ),
                                        'after'  => '</div>',
                                    ) );
                                ?>
                            </div><!-- .entry-content -->
                        </div>
                    </div>
                 <?php } ?>
                
            </div>
        </div>
    </div>

</article><!-- #post-## -->

