<?php

/**
* Protect direct access
*/
if ( ! defined( 'ABSPATH' ) ) die( EDDPCS_HACK_MSG );

/**
* Registers Shortcode
*/

function eddpcs_product_carousel_shortcode($atts, $content = null) {

ob_start();

	$atts = shortcode_atts(
		array(
			'id' => "",

			), $atts);

wp_enqueue_style( 'eddpcs-custom-style' );
wp_enqueue_style( 'eddpcs-owl-carousel-style' );
wp_enqueue_style( 'eddpcs-owl-theme-style' );
wp_enqueue_style( 'eddpcs-owl-transitions' );
wp_enqueue_style( 'eddpcs-font-awesome' );
wp_enqueue_script( 'eddpcs-owl-carousel-js' );
	
$post_id = $atts['id'];

$random_carousel_wrapper_id = rand();
$random_next_prev_id = rand();

$eddpcs_display_header = get_post_meta( $post_id, 'eddpcs_display_header', true );
$eddpcs_display_navigation_arrows = get_post_meta( $post_id, 'eddpcs_display_navigation_arrows', true );
$eddpcs_title = get_post_meta( $post_id, 'eddpcs_title', true );
$eddpcs_total_products = get_post_meta( $post_id, 'eddpcs_total_products', true );
$eddpcs_img_crop = get_post_meta( $post_id, 'eddpcs_img_crop', true );
$eddpcs_crop_image_width = get_post_meta( $post_id, 'eddpcs_crop_image_width', true );
$eddpcs_crop_image_height = get_post_meta( $post_id, 'eddpcs_crop_image_height', true );

$eddpcs_auto_play = get_post_meta( $post_id, 'eddpcs_auto_play', true );
$eddpcs_stop_on_hover = get_post_meta( $post_id, 'eddpcs_stop_on_hover', true );
$eddpcs_slide_speed = get_post_meta( $post_id, 'eddpcs_slide_speed', true );
$eddpcs_items = get_post_meta( $post_id, 'eddpcs_items', true );
$eddpcs_pagination = get_post_meta( $post_id, 'eddpcs_pagination', true );

$eddpcs_header_title_font_size = get_post_meta( $post_id, 'eddpcs_header_title_font_size', true );
$eddpcs_header_title_font_color = get_post_meta( $post_id, 'eddpcs_header_title_font_color', true );
$eddpcs_header1_title_bg_color = get_post_meta( $post_id, 'eddpcs_header1_title_bg_color', true );
$eddpcs_nav_arrow_color = get_post_meta( $post_id, 'eddpcs_nav_arrow_color', true );
$eddpcs_nav_arrow_bg_color = get_post_meta( $post_id, 'eddpcs_nav_arrow_bg_color', true );
$eddpcs_nav_arrow_hover_color = get_post_meta( $post_id, 'eddpcs_nav_arrow_hover_color', true );
$eddpcs_nav_arrow_bg_hover_color = get_post_meta( $post_id, 'eddpcs_nav_arrow_bg_hover_color', true );
$eddpcs_category_font_size = get_post_meta( $post_id, 'eddpcs_category_font_size', true );
$eddpcs_category_font_color = get_post_meta( $post_id, 'eddpcs_category_font_color', true );
$eddpcs_category_hover_font_color = get_post_meta( $post_id, 'eddpcs_category_hover_font_color', true );
$eddpcs_title_font_size = get_post_meta( $post_id, 'eddpcs_title_font_size', true );
$eddpcs_title_font_color = get_post_meta( $post_id, 'eddpcs_title_font_color', true );
$eddpcs_display_cart = get_post_meta( $post_id, 'eddpcs_display_cart', true );
$eddpcs_title_hover_font_color = get_post_meta( $post_id, 'eddpcs_title_hover_font_color', true );
$eddpcs_cart_font_size = get_post_meta( $post_id, 'eddpcs_cart_font_size', true );
$eddpcs_cart_font_color = get_post_meta( $post_id, 'eddpcs_cart_font_color', true );
$eddpcs_cart_bg_color = get_post_meta( $post_id, 'eddpcs_cart_bg_color', true );
$eddpcs_cart_button_hover_color = get_post_meta( $post_id, 'eddpcs_cart_button_hover_color', true );
$eddpcs_cart_button_hover_font_color  = get_post_meta( $post_id, 'eddpcs_cart_button_hover_font_color ', true );

	$args = array(
		'post_type'      => 'download', 
		'posts_per_page' => $eddpcs_total_products, 
		'post_status'    => 'publish'
	);

    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ): ?>
    
    <div class="eddpcs_product_carousel_slider">

	<style type="text/css">

		.eddpcs_carousel_header i.prev-<?php echo $random_next_prev_id; ?>, .eddpcs_carousel_header i.next-<?php echo $random_next_prev_id; ?> {
		    background-color: <?php echo $eddpcs_nav_arrow_bg_color; ?>;
		    color: <?php echo $eddpcs_nav_arrow_color; ?>;
		}

		.eddpcs_carousel_header i.fa-angle-left.prev-<?php echo $random_next_prev_id; ?>:hover, .eddpcs_carousel_header i.fa-angle-right.next-<?php echo $random_next_prev_id; ?>:hover {
		    background-color: <?php echo $eddpcs_nav_arrow_bg_hover_color; ?>;
		    color: <?php echo $eddpcs_nav_arrow_hover_color; ?>;
		}

	    #eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?> .owl-item .item .product_category { 
			color: <?php echo $eddpcs_category_font_color; ?>;  
		}

		#eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?> .owl-item .item .product_category a { 
			font-size: <?php echo $eddpcs_category_font_size; ?>;
			color: <?php echo $eddpcs_category_font_color; ?>;  
		}

		#eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?> .owl-item .item .product_category a:hover { 
			color: <?php echo $eddpcs_category_hover_font_color; ?>;  
		}
	
		#eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?> .owl-item .item h4.product_name { 
			font-size: <?php echo $eddpcs_title_font_size; ?>; 
		}
		#eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?> .owl-item .item h4.product_name a { 
			color: <?php echo $eddpcs_title_font_color; ?>; 
		}
		#eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?> .owl-item .item h4.product_name a:hover {
	    	color: <?php echo $eddpcs_title_hover_font_color; ?>;
		}
		#eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?> .owl-item .item .cart .AddToCartButton span, #eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?> .owl-item .item .cart a.edd_go_to_checkout.AddToCartButton {
		    color: <?php echo $eddpcs_cart_font_color; ?>;
		    background-color: <?php echo $eddpcs_cart_bg_color; ?>;
		    border-color: <?php echo $eddpcs_cart_bg_color; ?>;
		    font-size: <?php echo $eddpcs_cart_font_size; ?>;
		}
		#eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?> .owl-item .item .cart .AddToCartButton span:hover, #eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?> .owl-item .item .cart a.edd_go_to_checkout.AddToCartButton:hover {
		    background-color: <?php echo $eddpcs_cart_button_hover_color; ?>;
		    border-color: <?php echo $eddpcs_cart_button_hover_color; ?>;
		    color: <?php echo $eddpcs_cart_button_hover_font_color; ?>;
		}

	</style>

    <?php
    if($eddpcs_display_header == "yes") { ?>
			<div class="eddpcs_carousel_header">
				<div class="title" style="font-size: <?php echo $eddpcs_header_title_font_size; ?>; color: <?php echo $eddpcs_header_title_font_color; ?>;"><?php echo $eddpcs_title; ?></div>
				<?php if ($eddpcs_display_navigation_arrows == 'yes') { ?>
					<i class="fa fa-angle-left prev-<?php echo $random_next_prev_id; ?>"></i>
					<i class="fa fa-angle-right next-<?php echo $random_next_prev_id; ?>"></i>
				<?php } ?>
			</div>
        <?php 
    }

	else { ?>
		<div class="eddpcs_carousel_header">
				<?php if ($eddpcs_display_navigation_arrows == 'yes') { ?>
					<i class="fa fa-angle-left prev-<?php echo $random_next_prev_id; ?>"></i>
					<i class="fa fa-angle-right next-<?php echo $random_next_prev_id; ?>"></i>
				<?php } ?>
		</div>
    <?php } ?>

	    <div id="eddpcs-product-carousel-wrapper-<?php echo $random_carousel_wrapper_id; ?>" class="owl-carousel">
	    <?php while ( $loop->have_posts() ) : $loop->the_post(); global $post ?>
	        <div class="item">
	        <?php 
			$eddpcs_thumb = get_post_thumbnail_id();
			$eddpcs_img_url = wp_get_attachment_url( $eddpcs_thumb,'full' );
			$eddpcs_img = aq_resize( $eddpcs_img_url, $eddpcs_crop_image_width, $eddpcs_crop_image_height, true );		        	
	    	?>
	        	<div class="product_container">
	        		<div class="product_image_container">
			            <a id="id-<?php the_id(); ?>" class="product_thumb_link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			            	<?php
				            	if($eddpcs_img_crop == 'yes') {
				            	    if (has_post_thumbnail( $loop->post->ID )) { echo '<img src="'.$eddpcs_img.'" class="eddpcs-thum" />'; }
								} else {
									if (has_post_thumbnail( $loop->post->ID )) { echo get_the_post_thumbnail($loop->post->ID, 'eddpcs-thum'); }
								}
			            	?>
			            </a>
		        	</div>
		            <div class="caption">
		            	<div class="product_category"><?php echo get_the_term_list( $post->ID, 'download_category', '', ', ', '' ); ?></div>			               
			            <h4 class="product_name"><a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
			            <div class="cart"><?php echo do_shortcode( '[purchase_link id="'.$post->ID.'" class="AddToCartButton" text="Add To Cart"]' ); ?></div>
		            </div>
	            </div> 

	        </div>
	    <?php endwhile; wp_reset_postdata(); ?>
	    </div> <!-- End eddpcs-product-carousel-wrapper -->
	    <?php else: 
		_e('No products found', 'product-carousel-slider-for-easy-digital-downloads');
	    endif; ?>
    </div> <!-- End eddpcs_product_carousel_slider -->

	<?php echo '<script type="text/javascript"> 
		jQuery(document).ready(function($) {

		 		var owl = $("#eddpcs-product-carousel-wrapper-'.$random_carousel_wrapper_id.'");

				owl.owlCarousel({
				      autoPlay : '.$eddpcs_auto_play.',
				      items : '.$eddpcs_items.',
				      itemsDesktop : [1199,'.$eddpcs_items.'],
				      slideSpeed : '.$eddpcs_slide_speed.',
				      stopOnHover: '.$eddpcs_stop_on_hover.',					   
      	              pagination : '.$eddpcs_pagination.'
				});

				$(".next-'.$random_next_prev_id.'").click(function(){
				  owl.trigger("owl.next");
				});

				$(".prev-'.$random_next_prev_id.'").click(function(){
				  owl.trigger("owl.prev");
				});

		});
	</script>';

$carousel_content = ob_get_clean();
return $carousel_content;

	}

add_shortcode("eddpcs", "eddpcs_product_carousel_shortcode");
