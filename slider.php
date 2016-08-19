<?php

// Enqueue Flexslider Files

	function projectcharles_slider_scripts() {
		wp_enqueue_script( 'jquery' );
		//Check various preset colors choosen by the user and then load the corresponding slider styles 
		$change_colors= get_option('projectcharles_theme_colors');//fetched from the variables set in the options.php
		switch ($change_colors)  
        {  
            case "default":  
				wp_enqueue_style( 'flex-style', get_template_directory_uri() . '/inc/slider/css/flexslider.css' );            
                break;				
            
			case "Light Coral":  
			wp_enqueue_style( 'flex-style', get_template_directory_uri() . '/inc/slider/css/flexslider_lightcoral.css' );
                break;				
            
			case "Khaki":
			wp_enqueue_style( 'flex-style', get_template_directory_uri() . '/inc/slider/css/flexslider_khaki.css' );
            break;
			
			case "Lavender":
			wp_enqueue_style( 'flex-style', get_template_directory_uri() . '/inc/slider/css/flexslider_lavender.css' );
                break;
            
			case "Dark Slate Gray":
			wp_enqueue_style( 'flex-style', get_template_directory_uri() . '/inc/slider/css/flexslider_darkgrey.css' );			
                break; 				
        }    	
		wp_enqueue_script( 'flex-script', get_template_directory_uri() .  '/inc/slider/js/jquery.flexslider-min.js', array( 'jquery' ), false, true );
	}
	add_action( 'wp_enqueue_scripts', 'projectcharles_slider_scripts' );


// Initialize Slider
	
	function projectcharles_slider_init() { ?>
		<script type="text/javascript" charset="utf-8">
			jQuery(window).load(function() {
			  jQuery('.flexslider').flexslider({
    animation: "slide",
    animationLoop: true,
    itemWidth: 210,
    itemMargin: 10,
    minItems: 2,
    maxItems: 1,
	prevText: "&#8592;",
    nextText: "&#8594;"
			  });
			});
		</script>
	<?php }
	add_action( 'wp_head', 'projectcharles_slider_init' );
	
	
// Create Slider
	
	function projectcharles_slider_template() {
		
		// Query Arguments
		$args = array(
					'post_type' => 'slides',
					'posts_per_page'	=> 5
				);	
		
		// The Query
		$the_query = new WP_Query( $args );
		
		// Check if the Query returns any posts
		if ( $the_query->have_posts() ) {
		
		// Start the Slider ?>
		<div class="flexslider">
			<ul class="slides">
			
				<?php		
				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<li>
					
					<?php // Check if there's a Slide URL given and if so let's a link to it
					if ( get_post_meta( get_the_id(), 'wptuts_slideurl', true) != '' ) { ?>
						<a href="<?php echo esc_url( get_post_meta( get_the_id(), 'wptuts_slideurl', true ) ); ?>">
					<?php }
					
					// The Slide's Image
									echo the_post_thumbnail('full'); 
									echo get_post(get_post_thumbnail_id())->post_excerpt.'<br>';
									echo get_the_content();
					   
					// Close off the Slide's Link if there is one
					if ( get_post_meta( get_the_id(), 'wptuts_slideurl', true) != '' ) { ?>
						</a>
					<?php } ?>
					
				    </li>
				<?php endwhile; ?>
		
			</ul><!-- .slides -->
		</div><!-- .flexslider -->
		
		<?php }
		
		// Reset Post Data
		wp_reset_postdata();
	}

// Slider Shortcode

	function projectcharles_slider_shortcode() {
		ob_start();
		projectcharles_slider_template();
		$slider = ob_get_clean();
		return $slider;
	}
	add_shortcode( 'slider', 'projectcharles_slider_shortcode' );