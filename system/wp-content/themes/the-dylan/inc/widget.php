<?php
// Register 'The Dylan Recent Posts' widget
add_action( 'widgets_init', 'the_dylan_init_recent_posts' );

function the_dylan_init_recent_posts() { return register_widget('the_dylan_recent_posts'); }

class the_dylan_recent_posts extends WP_Widget {
	/** constructor */
	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, __( 'The Dylan Recent Post', 'the-dylan' ) );
	}
	
	// Widget	
	function widget( $args, $instance ) {
		global $post;
		extract($args);

		// Widget options
		$title 	 = apply_filters('widget_title', $instance['title'] ); // Title	
		$title 	 = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'The Dylan Recent Post', 'the-dylan' ) : $instance['title'], $instance, $this->id_base ); // Title	
		/*$cpt 	 = $instance['types'];*/ // Post type(s) 		
	    $types   = 'post';
		$number	 = absint($instance['number']); // Number of posts to show
		
        // Output
		echo $before_widget;
		
	    if ( $title ) echo $before_title . $title . $after_title;
			
		$fzq = new WP_Query(array( 'post_type' => $types, 'showposts' => $number ));
		if( $fzq->have_posts() ) : 
		?>
		<ul id="the_dylan_recent_posts">
		<?php while($fzq->have_posts()) : $fzq->the_post(); ?>
		<li class="clearfix">
        	<?php if ( $instance['display_featured_image'] && has_post_thumbnail() ) {?>
                <div class="the_dylan_post_recent post-image">
                        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                    <?php
                        the_post_thumbnail('the-dylan-widget-post-thumb', array('class' => 'alignleft'));
                    ?>
                        </a>
                </div>
            <?php } ?>
            <div class="the_dylan_post_recent">
                <h5><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></h5>
                <div class="meta-info">
                    <span class="meta-info-date"><?php the_time('F j, Y');  ?></span> 
                    <?php 
					if( comments_open() ) {?>
						<a href="<?php comments_link(); ?>" class="meta-info-comment"><i class="fa fa-comments"></i> <?php _e( 'Leave a Comment', 'the-dylan' ); ?></a>
                        <?php } 
					else {?>
						<span class="meta-info-comment"><i class="fa fa-comments"></i> <?php _e( 'Comment is Closed', 'the-dylan' ); ?></a></span>
					<?php } ?>
                </div>
            </div>
        </li>
		<?php wp_reset_postdata(); 
		endwhile; ?>
		</ul>
			
		<?php endif; ?>			
		<?php
		// echo widget closing tag
		echo $after_widget;
	}

	/** Widget control update */
	function update( $new_instance, $old_instance ) {
		$instance    = $old_instance;	
		
		//Let's turn that array into something the Wordpress database can store
		$instance['title']  = esc_html( $new_instance['title'] );
		$instance['types'] = ( in_array( $new['types'], array( 'posts', 'pages' ) ) ) ? $new['types'] : 'posts';
		$instance['number'] = absint( $new_instance['number'] );
		$instance['display_featured_image'] = (bool) $new_instance['display_featured_image'];
		return $instance;
	}
	
	
	// Widget settings	
	function form( $instance ) {	
			$number = 5;
			$display_featured_image = 0;
		    // instance exist? if not set defaults
		    if ( $instance ) {
				$title  = $instance['title'];
		        $types  = $instance['types'];
		        $number = absint($instance['number']);
				$display_featured_image = (bool) $instance['display_featured_image'];
		    } 
			
			//Let's turn $types into an array
			$types = 'post';
			// The widget form
			?>
			<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e( 'Title:', 'the-dylan' ); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)) { echo $title; } ?>" class="widefat" />
			</p>
			<p>
            	<input type="checkbox" name="<?php echo $this->get_field_name('display_featured_image'); ?>"  <?php checked( $display_featured_image, 1 ); ?> value="1" /> 			
                <label for="<?php echo $this->get_field_id('display_featured_image'); ?>"><?php _e( 'Display Thumbnail', 'the-dylan' ); ?></label>
            </p>
			<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"> <?php _e( 'Number of posts to show:', 'the-dylan' ); ?></label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
			</p>
	<?php 
	}
	

} // class rcp_recent_posts
?>
