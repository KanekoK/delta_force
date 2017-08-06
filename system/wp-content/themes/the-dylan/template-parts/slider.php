<?php
/**
 * Template part for displaying slider.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */
?>
<?php 
	$slider_display = get_theme_mod( 'the_dylan_display_slider_setting', 1);
	$slider_cat = get_theme_mod( 'the_dylan_category_setting'); 
	//query posts

		$args = array(
		'offset'           => 0,
		'category_name' => $slider_cat,
		'posts_per_page' => -1,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true
	);

	$counter = 1;
	$the_slides = new WP_Query( $args );
?>

<?php if($slider_display == 1){ ?> 
	<?php if ($the_slides->have_posts()) : ?>    	
        <section id="home-slider">    
            <div id="myCarousel" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php while ($the_slides->have_posts()) : $the_slides->the_post(); ?> 
                    	<div class="item bg bg<?php echo intval($counter); ?> <?php if($counter == 1) {echo "active";} ?>" >
                        <?php
                        if ( has_post_thumbnail() ) { 
                        ?>
                            	
                            <div class="carousel-content-bg">
                            	<?php the_post_thumbnail( 'full', array( 'class' => 'full-slide' ) ); ?>
                                <div class="container">
                                	<div class="slide-post-details">
                                        <h1><a class="more" href="<?php the_permalink('') ?>"><?php the_title(); ?></a></h1>
                                        <p><?php the_excerpt(); ?></p>        
                                    </div>      
                                </div>
                            </div>
                            <div class="color-overlay"></div>
                        
                         <?php $counter = $counter + 1; ?>
                        <?php } ?>
                        </div>
                    <?php endwhile; ?> 
                </div>

                <a id="jump_next" href="#content"><span class="glyphicon glyphicon-chevron-down"></span></a>
                
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </section>
    <?php endif; ?> 
<?php } ?> 
<?php wp_reset_query(); ?>