<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */


if ( ! function_exists( 'the_dylan_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */

function the_dylan_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	$posted_on = sprintf(
		wp_kses_post( __( '<a href="%1$s" rel="bookmark"><i class="fa fa-clock-o"></i>%2$s</a>', 'the-dylan' ) ), esc_url( get_permalink() ), $time_string );

	$byline = sprintf(
		wp_kses_post( __( '<span class="author vcard"><a class="url fn n" href="%1$s"><i class="fa fa-user"></i>%2$s</a></span>', 'the-dylan' ) ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) );


	echo '<span class="posted-on">' . $posted_on . '</span> <span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}
endif;

function the_dylan_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'the_dylan_excerpt_more');

//====================================Breadcrumbs=============================================================================================

function the_dylan_breadcrumb() {
    global $post;
    echo '<ul id="breadcrumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_home_url();
        echo '">';
        echo 'Home';
        echo '</a></li><li class="separator"> / </li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li class="separator"> / </li><li> ');
            if (is_single()) {
                echo '</li><li class="separator"> / </li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $the_dylan_act = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $the_dylan_act as $the_dylan_inherit ) {
                    $output = '<li><a href="'.get_permalink($the_dylan_inherit).'" title="'.get_the_title($the_dylan_inherit).'">'.get_the_title($the_dylan_inherit).'</a></li> <li class="separator">/</li>';
                }
                echo wp_kses_post($output);
                echo '<span title="'.wp_kses_post($title).'"> '.wp_kses_post($title).'</span>';
            } else {
                echo '<li>'.get_the_title().'</li>';
            }
        }
    }
    echo '</ul>';
}

function the_dylan_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'the_dylan_body_classes' );

function the_dylan_gallery_atts( $out, $pairs, $atts ) {
    $atts = shortcode_atts( array(
      'size' => 'medium',
    ), $atts );
 
    $out['size'] = $atts['size'];

    return $out;
 
}
add_filter( 'shortcode_atts_gallery', 'the_dylan_gallery_atts', 10, 3 );

if ( ! function_exists( 'the_dylan_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function the_dylan_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'the-dylan' ) );
		if ( $categories_list && the_dylan_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'the-dylan' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'the-dylan' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'the-dylan' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'the-dylan' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'the-dylan' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

?>
