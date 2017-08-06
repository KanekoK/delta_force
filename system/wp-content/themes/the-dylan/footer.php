<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    	<div class="container">
        	<div id="footer-widget">
                <div class="row">
                    <div class="col-md-4">                    
                        <?php dynamic_sidebar('footer-one-widget'); ?>
                    </div>
                    <div class="col-md-4">                    
                        <?php dynamic_sidebar('footer-two-widget'); ?>
                    </div>
                    <div class="col-md-4">                    
                        <?php dynamic_sidebar('footer-three-widget'); ?>
                    </div>
                </div>
            </div>		
        </div>
        <div class="site-info">
        	<div class="container">
            <?php wp_nav_menu( array( 'theme_location' => 'footer', 'depth'	=> 1, 'menu_id' => 'footer-menu' ) ); ?>
            <?php echo __('&copy; ', 'the-dylan') . esc_attr( get_bloginfo( 'name', 'the-dylan' ) );  ?>
            <?php if(is_home() && !is_paged()){?>            
                <?php _e('- Powered by ', 'the-dylan'); ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'the-dylan' ) ); ?>" title="<?php esc_attr_e( 'WordPress' ,'the-dylan' ); ?>"><?php _e('WordPress' ,'the-dylan'); ?></a>
                <?php _e(' and ', 'the-dylan'); ?><a href="<?php echo esc_url( __( 'https://www.electricwp.com/', 'the-dylan' ) ); ?>"><?php _e('Electric WP', 'the-dylan'); ?></a>
            <?php } ?>
        	</div>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

