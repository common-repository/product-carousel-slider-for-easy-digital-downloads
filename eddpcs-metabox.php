<?php

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( EDDPCS_HACK_MSG );

/**
 * Registers Easy Digital Downloads product carousel slider post type.
 */
function eddpcs_init() {
    $labels = array(
        'name'               => _x( 'Easy Digital Downloads Products Carousel Sliders', 'product-carousel-slider-for-easy-digital-downloads' ),
        'singular_name'      => _x( 'Easy Digital Downloads Products Carousel Slider', 'product-carousel-slider-for-easy-digital-downloads' ),
        'menu_name'          => _x( 'Edd Carousel', 'product-carousel-slider-for-easy-digital-downloads' ),
        'name_admin_bar'     => _x( 'Edd Carousel', 'product-carousel-slider-for-easy-digital-downloads' ),
        'add_new'            => _x( 'Add New', 'product-carousel-slider-for-easy-digital-downloads' ),
        'add_new_item'       => __( 'Add New Carousel Slider', 'product-carousel-slider-for-easy-digital-downloads' ),
        'new_item'           => __( 'New Carousel Slider', 'product-carousel-slider-for-easy-digital-downloads' ),
        'edit_item'          => __( 'Edit Carousel Slider', 'product-carousel-slider-for-easy-digital-downloads' ),
        'view_item'          => __( 'View Carousel Slider', 'product-carousel-slider-for-easy-digital-downloads' ),
        'search_items'       => __( 'Search Carousel Slider', 'product-carousel-slider-for-easy-digital-downloads' ),
        'parent_item_colon'  => __( 'Parent Carousel Sliders:', 'product-carousel-slider-for-easy-digital-downloads' ),
        'not_found'          => __( 'No carousel slider found.', 'product-carousel-slider-for-easy-digital-downloads' ),
        'not_found_in_trash' => __( 'No carousel slider found in Trash.', 'product-carousel-slider-for-easy-digital-downloads' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title' ),
        'menu_icon' => 'dashicons-images-alt2'
    );

    register_post_type( 'eddcarousel', $args );
}
add_action( 'init', 'eddpcs_init' );

/**
 * Adds a box to the main column on the Easy Digital Downloads product carousel slider post type edit screens.
 */
function eddpcs_add_meta_box() {
                add_meta_box(
                    'eddpcs_metabox',
                    __( 'Settings & Shortcode Generator','product-carousel-slider-for-easy-digital-downloads' ),
                    'eddpcs_meta_box_content_output', 
                    'eddcarousel',
                    'normal'
                    );
    }
add_action( 'add_meta_boxes', 'eddpcs_add_meta_box' );

/**
 * Prints the box content.
 */
function eddpcs_meta_box_content_output( $post ) {
    
    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'eddpcs_save_meta_box_data', 'eddpcs_meta_box_nonce' );
    
    $eddpcs_display_header = get_post_meta( $post->ID, 'eddpcs_display_header', true );
    $eddpcs_display_navigation_arrows = get_post_meta( $post->ID, 'eddpcs_display_navigation_arrows', true );
    $eddpcs_title = get_post_meta( $post->ID, 'eddpcs_title', true );
    $eddpcs_total_products = get_post_meta( $post->ID, 'eddpcs_total_products', true );
    $eddpcs_img_crop = get_post_meta( $post->ID, 'eddpcs_img_crop', true );
    $eddpcs_crop_image_width = get_post_meta( $post->ID, 'eddpcs_crop_image_width', true );
    $eddpcs_crop_image_height = get_post_meta( $post->ID, 'eddpcs_crop_image_height', true );

    $eddpcs_auto_play = get_post_meta( $post->ID, 'eddpcs_auto_play', true );
    $eddpcs_stop_on_hover = get_post_meta( $post->ID, 'eddpcs_stop_on_hover', true );
    $eddpcs_slide_speed = get_post_meta( $post->ID, 'eddpcs_slide_speed', true );
    $eddpcs_items = get_post_meta( $post->ID, 'eddpcs_items', true );
    $eddpcs_pagination = get_post_meta( $post->ID, 'eddpcs_pagination', true );

    $eddpcs_header_title_font_size = get_post_meta( $post->ID, 'eddpcs_header_title_font_size', true );
    $eddpcs_header_title_font_color = get_post_meta( $post->ID, 'eddpcs_header_title_font_color', true );
    $eddpcs_nav_arrow_color = get_post_meta( $post->ID, 'eddpcs_nav_arrow_color', true );
    $eddpcs_nav_arrow_bg_color = get_post_meta( $post->ID, 'eddpcs_nav_arrow_bg_color', true );
    $eddpcs_nav_arrow_hover_color = get_post_meta( $post->ID, 'eddpcs_nav_arrow_hover_color', true );
    $eddpcs_nav_arrow_bg_hover_color = get_post_meta( $post->ID, 'eddpcs_nav_arrow_bg_hover_color', true );
    $eddpcs_category_font_size = get_post_meta( $post->ID, 'eddpcs_category_font_size', true );
    $eddpcs_category_font_color = get_post_meta( $post->ID, 'eddpcs_category_font_color', true );
    $eddpcs_category_hover_font_color = get_post_meta( $post->ID, 'eddpcs_category_hover_font_color', true );
    $eddpcs_title_font_size = get_post_meta( $post->ID, 'eddpcs_title_font_size', true );
    $eddpcs_title_font_color = get_post_meta( $post->ID, 'eddpcs_title_font_color', true );
    $eddpcs_title_hover_font_color = get_post_meta( $post->ID, 'eddpcs_title_hover_font_color', true );
    $eddpcs_cart_font_size = get_post_meta( $post->ID, 'eddpcs_cart_font_size', true );
    $eddpcs_cart_font_color = get_post_meta( $post->ID, 'eddpcs_cart_font_color', true );
    $eddpcs_cart_bg_color = get_post_meta( $post->ID, 'eddpcs_cart_bg_color', true );
    $eddpcs_cart_button_hover_color = get_post_meta( $post->ID, 'eddpcs_cart_button_hover_color', true );
    $eddpcs_cart_button_hover_font_color  = get_post_meta( $post->ID, 'eddpcs_cart_button_hover_font_color ', true );

    ?>
    <div id="tabs-container">

        <ul class="tabs-menu">
            <li class="current"><a href="#tab-1"><?php _e('General Settings', 'product-carousel-slider-for-easy-digital-downloads'); ?></a></li>
            <li><a href="#tab-2"><?php _e('Slider Settings', 'product-carousel-slider-for-easy-digital-downloads'); ?></a></li>
            <li><a href="#tab-3"><?php _e('Style Settings', 'product-carousel-slider-for-easy-digital-downloads'); ?></a></li>
        </ul>

        <div class="tab">

            <div id="tab-1" class="tab-content">
                <div class="cmb2-wrap form-table">
                    <div id="cmb2-metabox" class="cmb2-metabox cmb-field-list">


                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="eddpcs_display_header"><?php _e('Display Header', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">  
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_display_header" id="eddpcs_display_header1" value="yes" <?php if($eddpcs_display_header=="yes") {echo "checked"; } else { echo "checked"; } ?>> <label for="eddpcs_display_header1"><?php _e('Yes', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_display_header" id="eddpcs_display_header2" value="no" <?php if($eddpcs_display_header=="no") {echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_display_header2"><?php _e('No', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                </ul>
                            <p class="cmb2-metabox-description"><?php _e('Display carousel slider header or not', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="eddpcs_display_header"><?php _e('Display Navigation Arrows', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">  
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_display_navigation_arrows" id="eddpcs_display_navigation_arrows" value="yes" <?php if( $eddpcs_display_navigation_arrows == "yes" ) {echo "checked"; } else { echo "checked"; } ?>> <label for="eddpcs_display_navigation_arrows"><?php _e('Yes', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_display_navigation_arrows" id="eddpcs_display_navigation_arrows2" value="no" <?php if ($eddpcs_display_navigation_arrows == "no" ) {echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_display_navigation_arrows2"><?php _e('No', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                </ul>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="eddpcs_title"><?php _e('Title', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-medium" name="eddpcs_title" id="eddpcs_title" value="<?php if(empty($eddpcs_title)) { _e('LATEST PRODUCTS', 'product-carousel-slider-for-easy-digital-downloads'); } else { echo $eddpcs_title; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('Carousel slider title', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div> 


                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="eddpcs_total_products"><?php _e('Total Products', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_total_products" id="eddpcs_total_products" value="<?php if(empty($eddpcs_total_products)) { echo 12; } else { echo $eddpcs_total_products; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('How many products to display in the carousel slider', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-multicheck">
                            <div class="cmb-th">
                                <label for="eddpcs_products_type"><?php _e('Products Type', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">

                                    <li><input type="radio" class="cmb2-option" name="eddpcs_products_type" id="eddpcs_products_type" value="latest" checked> <label for="eddpcs_products_type"><?php _e('Latest Products', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                    
                                    <p style="font-size: 14px; margin: 22px 0 5px 0; font-style: italic;">Following options available in <a href="http://adlplugins.com/plugin/easy-digital-downloads-product-carousel-slider-pro" target="_blank">Pro Version</a>:</p>

                                    <li><input disabled type="radio" class="cmb2-option" name="eddpcs_products_type" id="eddpcs_products_type9" value="older" <?php if($eddpcs_products_type == "older") {echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_products_type9"><?php _e('Older Products', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                              
                                    <li><input disabled type="radio" class="cmb2-option" name="eddpcs_products_type" id="eddpcs_products_type3" value="featured" <?php if($eddpcs_products_type == "featured") {echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_products_type3"><?php _e('Featured Products', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>

                                     <li><input disabled type="radio" class="cmb2-option" name="eddpcs_products_type" id="eddpcs_products_type10" value="category" <?php if($eddpcs_products_type == "category") {echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_products_type10"><?php _e('Category Products', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>

                                    <li class="productsbyidw"><input disabled type="radio" class="cmb2-option" name="eddpcs_products_type" id="eddpcs_products_type4" value="productsbyid" <?php if($eddpcs_products_type == "productsbyid") {echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_products_type4"><?php _e('Products by ID', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>                                        

                                    <li><input disabled type="radio" class="cmb2-option" name="eddpcs_products_type" id="eddpcs_products_type6" value="productsbytag" <?php if($eddpcs_products_type == "productsbytag") {echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_products_type6"><?php _e('Products by Tags', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>

                                    <li><input disabled type="radio" class="cmb2-option" name="eddpcs_products_type" id="eddpcs_products_type7" value="productsbyyear" <?php if($eddpcs_products_type == "productsbyyear") {echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_products_type7"><?php _e('Products by Year', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>

                                    <li><input disabled type="radio" class="cmb2-option" name="eddpcs_products_type" id="eddpcs_products_type8" value="productsbymonth" <?php if($eddpcs_products_type == "productsbymonth") {echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_products_type8"><?php _e('Products by Month', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>

                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('What type of products to display in the carousel slider', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="eddpcs_img_crop"><?php _e('Image Resize & Crop', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">  
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_img_crop" id="eddpcs_img_crop1" value="yes" <?php if($eddpcs_img_crop=="yes")  { echo "checked"; } else { echo "checked"; } ?>> <label for="eddpcs_img_crop1"><?php _e('Yes', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_img_crop" id="eddpcs_img_crop2" value="no" <?php if($eddpcs_img_crop=="no") { echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_img_crop2"><?php _e('No', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                </ul>
                            <p class="cmb2-metabox-description"><?php _e('Images auto resize and crop', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="eddpcs_crop_image_width"><?php _e('Image Width', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_crop_image_width" id="eddpcs_crop_image_width" value="<?php if(empty($eddpcs_crop_image_width)) { echo 300; } else { echo $eddpcs_crop_image_width; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('Image cropping width', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="eddpcs_crop_image_height"><?php _e('Image Height', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_crop_image_height" id="eddpcs_crop_image_height" value="<?php if(empty($eddpcs_crop_image_height)) { echo 300; } else { echo $eddpcs_crop_image_height; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('Image cropping height', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div>                   

                </div>
            </div>
        </div>


            <div id="tab-2" class="tab-content">

                <div class="cmb2-wrap form-table">
                    <div id="cmb2-metabox" class="cmb2-metabox cmb-field-list">

                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="eddpcs_auto_play"><?php _e('Auto Play', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">  
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_auto_play" id="eddpcs_auto_play1" value="true" <?php if($eddpcs_auto_play=="true")  { echo "checked"; } else { echo "checked"; } ?>> <label for="eddpcs_auto_play1"><?php _e('Yes', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_auto_play" id="eddpcs_auto_play2" value="false" <?php if($eddpcs_auto_play=="false") { echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_auto_play2"><?php _e('No', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                </ul>
                            <p class="cmb2-metabox-description"><?php _e('Slider would automatically play or not', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div>



                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="eddpcs_stop_on_hover"><?php _e('Stop on Hover', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">  
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_stop_on_hover" id="eddpcs_stop_on_hover1" value="true" <?php if($eddpcs_stop_on_hover=="true")  { echo "checked"; } else { echo "checked"; } ?>> <label for="eddpcs_stop_on_hover1"><?php _e('Yes', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_stop_on_hover" id="eddpcs_stop_on_hover2" value="false" <?php if($eddpcs_stop_on_hover=="false") { echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_stop_on_hover2"><?php _e('No', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                </ul>
                            <p class="cmb2-metabox-description"><?php _e('Stop autoplay on mouse hover or not', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div>
            

                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="eddpcs_slide_speed"><?php _e('Slide Speed', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_slide_speed" id="eddpcs_slide_speed" value="<?php if(!empty($eddpcs_slide_speed)) { echo $eddpcs_slide_speed; } else { echo 900; } ?>">
                            </div>
                        </div> 


                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="eddpcs_items"><?php _e('Items', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_items" id="eddpcs_items" value="<?php if(!empty($eddpcs_items)) { echo $eddpcs_items; } else { echo 4; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('Maximum amount of items to display at a time with the widest browser width.', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="eddpcs_pagination"><?php _e('Pagination', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">  
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_pagination" id="eddpcs_pagination1" value="false" <?php if($eddpcs_pagination == "false") { echo "checked"; } else { echo "checked"; } ?>> <label for="eddpcs_pagination1"><?php _e('No', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                    <li><input type="radio" class="cmb2-option" name="eddpcs_pagination" id="eddpcs_pagination2" value="true" <?php if($eddpcs_pagination == "true") { echo "checked"; } else { echo ""; } ?>> <label for="eddpcs_pagination2"><?php _e('Yes', 'product-carousel-slider-for-easy-digital-downloads'); ?></label></li>
                                </ul>
                            <p class="cmb2-metabox-description"><?php _e('Show pagination or not', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




            <div id="tab-3" class="tab-content">
                <div class="cmb2-wrap form-table">
                    <div id="cmb2-metabox" class="cmb2-metabox cmb-field-list">

                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="eddpcs_header_title_font_size"><?php _e('Title Font Size', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_header_title_font_size" id="eddpcs_header_title_font_size" value="<?php if(!empty($eddpcs_header_title_font_size)) { echo $eddpcs_header_title_font_size; } ?>" placeholder="e.g. 20px">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_header_title_font_color"><?php _e('Title Font Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_header_title_font_color" id="eddpcs_header_title_font_color" value="<?php if(!empty($eddpcs_header_title_font_color)) { echo $eddpcs_header_title_font_color; } else { echo "#303030"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_nav_arrow_color"><?php _e('Navigational Arrow Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_nav_arrow_color" id="eddpcs_nav_arrow_color" value="<?php if(!empty($eddpcs_nav_arrow_color)) { echo $eddpcs_nav_arrow_color; } else { echo "#FFFFFF"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_nav_arrow_bg_color"><?php _e('Navigational Arrow Background Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_nav_arrow_bg_color" id="eddpcs_nav_arrow_bg_color" value="<?php if(!empty($eddpcs_nav_arrow_bg_color)) { echo $eddpcs_nav_arrow_bg_color; } else { echo "#BBBBBB"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_nav_arrow_hover_color"><?php _e('Navigational Arrow Hover Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_nav_arrow_hover_color" id="eddpcs_nav_arrow_hover_color" value="<?php if(!empty($eddpcs_nav_arrow_hover_color)) { echo $eddpcs_nav_arrow_hover_color; } else { echo "#FFFFFF"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_nav_arrow_bg_hover_color"><?php _e('Navigational Arrow Background Hover Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_nav_arrow_bg_hover_color" id="eddpcs_nav_arrow_bg_hover_color" value="<?php if(!empty($eddpcs_nav_arrow_bg_hover_color)) { echo $eddpcs_nav_arrow_bg_hover_color; } else { echo "#9A9A9A"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="eddpcs_category_font_size"><?php _e('Product Category Font Size', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_category_font_size" id="eddpcs_category_font_size" value="<?php if(!empty($eddpcs_category_font_size)) { echo $eddpcs_category_font_size; } else { echo "12px"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_category_font_color"><?php _e('Product Category Font Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_category_font_color" id="eddpcs_category_font_color" value="<?php if(!empty($eddpcs_category_font_color)) { echo $eddpcs_category_font_color; } else { echo "#BBBBBB"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_category_hover_font_color"><?php _e('Product Category Hover Font Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_category_hover_font_color" id="eddpcs_category_hover_font_color" value="<?php if(!empty($eddpcs_category_hover_font_color)) { echo $eddpcs_category_hover_font_color; } else { echo "#000000"; } ?>">
                            </div>
                        </div> 


                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="eddpcs_title_font_size"><?php _e('Product Title Font Size', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_title_font_size" id="eddpcs_title_font_size" value="<?php if(!empty($eddpcs_title_font_size)) { echo $eddpcs_title_font_size; } else { echo "16px"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_title_font_color"><?php _e('Product Title Font Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_title_font_color" id="eddpcs_title_font_color" value="<?php if(!empty($eddpcs_title_font_color)) { echo $eddpcs_title_font_color; } else { echo "#444444"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_title_hover_font_color"><?php _e('Product Title Hover Font Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_title_hover_font_color" id="eddpcs_title_hover_font_color" value="<?php if(!empty($eddpcs_title_hover_font_color)) { echo $eddpcs_title_hover_font_color; } else { echo "#9A9A9A"; } ?>">
                            </div>
                        </div> 


                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="eddpcs_cart_font_size"><?php _e('"Add to Cart" Button Font Size', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_cart_font_size" id="eddpcs_cart_font_size" value="<?php if(!empty($eddpcs_cart_font_size)) { echo $eddpcs_cart_font_size; } else { echo "14px"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_cart_font_color"><?php _e('"Add to Cart" Font Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_cart_font_color" id="eddpcs_cart_font_color" value="<?php if(!empty($eddpcs_cart_font_color)) { echo $eddpcs_cart_font_color; } else { echo "#ffffff"; } ?>">
                            </div>
                        </div> 


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_cart_bg_color"><?php _e('"Add to Cart" Button Background Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_cart_bg_color" id="eddpcs_cart_bg_color" value="<?php if(!empty($eddpcs_cart_bg_color)) { echo $eddpcs_cart_bg_color; } else { echo "#BBBBBB"; } ?>">
                            </div>
                        </div> 


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_cart_button_hover_color"><?php _e('"Add to Cart" Button Hover Background Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_cart_button_hover_color" id="eddpcs_cart_button_hover_color" value="<?php if(!empty($eddpcs_cart_button_hover_color)) { echo $eddpcs_cart_button_hover_color; } else { echo "#9A9A9A"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="eddpcs_cart_button_hover_font_color"><?php _e('"Add to Cart" Hover Font Color', 'product-carousel-slider-for-easy-digital-downloads'); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="eddpcs_cart_button_hover_font_color" id="eddpcs_cart_button_hover_font_color" value="<?php if(!empty($eddpcs_cart_button_hover_font_color)) { echo $eddpcs_cart_button_hover_font_color; } else { echo "#ffffff"; } ?>">
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div> <!-- end tab -->
    </div> <!-- end tabs-container -->

<div class="eddpcs_shortcode">
    <h2><?php _e('Shortcode', 'product-carousel-slider-for-easy-digital-downloads'); ?> </h2> 
    <p><?php _e('Use following shortcode to display the Carousel Slider anywhere:', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
    <textarea cols="25" rows="1" onClick="this.select();" >[eddpcs <?php echo 'id="'.$post->ID.'"';?>]</textarea> <br />

    <p><?php _e('If you need to put the shortcode in code/theme file, use this:', 'product-carousel-slider-for-easy-digital-downloads'); ?></p>
    <textarea cols="54" rows="1" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[eddpcs id='; echo "'".$post->ID."']"; echo '"); ?>'; ?></textarea> </p>
</div>
<?php }

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function eddpcs_save_meta_box_data( $post_id ) {
/*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['eddpcs_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['eddpcs_meta_box_nonce'], 'eddpcs_save_meta_box_data' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    $eddpcs_display_header_value = "";
    $eddpcs_display_navigation_arrows_value = "";
    $eddpcs_title_value = "";
    $eddpcs_total_products_value = "";
    $eddpcs_img_crop_value = "";
    $eddpcs_crop_image_width_value = "";
    $eddpcs_crop_image_height_value = "";
    $eddpcs_auto_play_value  = "";
    $eddpcs_stop_on_hover_value  = "";
    $eddpcs_slide_speed_value  = "";
    $eddpcs_items_value  = "";
    $eddpcs_pagination_value  = "";
    $eddpcs_header_title_font_size_value = "";
    $eddpcs_header_title_font_color_value = "";
    $eddpcs_nav_arrow_color_value = "";
    $eddpcs_nav_arrow_bg_color_value = "";
    $eddpcs_nav_arrow_hover_color_value = "";
    $eddpcs_nav_arrow_bg_hover_color_value = "";
    $eddpcs_category_font_size_value = "";
    $eddpcs_category_font_color_value = "";
    $eddpcs_category_hover_font_color_value = "";
    $eddpcs_title_font_size_value = "";
    $eddpcs_title_font_color_value = "";
    $eddpcs_title_hover_font_color_value = "";
    $eddpcs_cart_font_size_value = "";
    $eddpcs_cart_font_color_value = "";
    $eddpcs_cart_bg_color_value = "";
    $eddpcs_cart_button_hover_color_value = "";
    $eddpcs_cart_button_hover_font_color_value = "";
    $eddpcs_header1_title_bg_color_value = "";
    $themeB_border_color_value = "";
    $themeB_border_hover_color_value = "";
    $themeC_border_hover_color_value = "";


    if(isset($_POST["eddpcs_display_header"]))
    {
        $eddpcs_display_header_value = sanitize_text_field( $_POST["eddpcs_display_header"] );
    }   
    update_post_meta($post_id, "eddpcs_display_header", $eddpcs_display_header_value);


    if(isset($_POST["eddpcs_display_navigation_arrows"]))
    {
        $eddpcs_display_navigation_arrows_value = sanitize_text_field( $_POST["eddpcs_display_navigation_arrows"] );
    }   
    update_post_meta($post_id, "eddpcs_display_navigation_arrows", $eddpcs_display_navigation_arrows_value);


    if(isset($_POST["eddpcs_title"]))
    {
        $eddpcs_title_value = sanitize_text_field( $_POST["eddpcs_title"] );
    }   
    update_post_meta($post_id, "eddpcs_title", $eddpcs_title_value);


    if(isset($_POST["eddpcs_total_products"]))
    {
        $eddpcs_total_products_value = sanitize_text_field( $_POST["eddpcs_total_products"] );
    }   
    update_post_meta($post_id, "eddpcs_total_products", $eddpcs_total_products_value);


    if(isset($_POST["eddpcs_img_crop"]))
    {
        $eddpcs_img_crop_value = sanitize_text_field( $_POST["eddpcs_img_crop"] );
    }   
    update_post_meta($post_id, "eddpcs_img_crop", $eddpcs_img_crop_value);


    if(isset($_POST["eddpcs_crop_image_width"]))
    {
        $eddpcs_crop_image_width_value = sanitize_text_field( $_POST["eddpcs_crop_image_width"] );
    }   
    update_post_meta($post_id, "eddpcs_crop_image_width", $eddpcs_crop_image_width_value);


    if(isset($_POST["eddpcs_crop_image_height"]))
    {
        $eddpcs_crop_image_height_value = sanitize_text_field( $_POST["eddpcs_crop_image_height"] );
    }   
    update_post_meta($post_id, "eddpcs_crop_image_height", $eddpcs_crop_image_height_value);


    if(isset($_POST["eddpcs_auto_play"]))
    {
        $eddpcs_auto_play_value = sanitize_text_field( $_POST["eddpcs_auto_play"] );
    }   
    update_post_meta($post_id, "eddpcs_auto_play", $eddpcs_auto_play_value);


    if(isset($_POST["eddpcs_stop_on_hover"]))
    {
        $eddpcs_stop_on_hover_value = sanitize_text_field( $_POST["eddpcs_stop_on_hover"] );
    }   
    update_post_meta($post_id, "eddpcs_stop_on_hover", $eddpcs_stop_on_hover_value);


    if(isset($_POST["eddpcs_slide_speed"]))
    {
        $eddpcs_slide_speed_value = sanitize_text_field( $_POST["eddpcs_slide_speed"] );
    }   
    update_post_meta($post_id, "eddpcs_slide_speed", $eddpcs_slide_speed_value);


    if(isset($_POST["eddpcs_items"]))
    {
        $eddpcs_items_value = sanitize_text_field( $_POST["eddpcs_items"] );
    }   
    update_post_meta($post_id, "eddpcs_items", $eddpcs_items_value);


    if(isset($_POST["eddpcs_pagination"]))
    {
        $eddpcs_pagination_value = sanitize_text_field( $_POST["eddpcs_pagination"] );
    }   
    update_post_meta($post_id, "eddpcs_pagination", $eddpcs_pagination_value);


    if(isset($_POST["eddpcs_header_title_font_size"]))
    {
        $eddpcs_header_title_font_size_value = sanitize_text_field( $_POST["eddpcs_header_title_font_size"] );
    }   
    update_post_meta($post_id, "eddpcs_header_title_font_size", $eddpcs_header_title_font_size_value);


    if(isset($_POST["eddpcs_header_title_font_color"]))
    {
        $eddpcs_header_title_font_color_value = sanitize_text_field( $_POST["eddpcs_header_title_font_color"] );
    }   
    update_post_meta($post_id, "eddpcs_header_title_font_color", $eddpcs_header_title_font_color_value);


    if(isset($_POST["eddpcs_nav_arrow_color"]))
    {
        $eddpcs_nav_arrow_color_value = sanitize_text_field( $_POST["eddpcs_nav_arrow_color"] );
    }   
    update_post_meta($post_id, "eddpcs_nav_arrow_color", $eddpcs_nav_arrow_color_value);


    if(isset($_POST["eddpcs_nav_arrow_bg_color"]))
    {
        $eddpcs_nav_arrow_bg_color_value = sanitize_text_field( $_POST["eddpcs_nav_arrow_bg_color"] );
    }   
    update_post_meta($post_id, "eddpcs_nav_arrow_bg_color", $eddpcs_nav_arrow_bg_color_value);


    if(isset($_POST["eddpcs_nav_arrow_hover_color"]))
    {
        $eddpcs_nav_arrow_hover_color_value = sanitize_text_field( $_POST["eddpcs_nav_arrow_hover_color"] );
    }   
    update_post_meta($post_id, "eddpcs_nav_arrow_hover_color", $eddpcs_nav_arrow_hover_color_value);


    if(isset($_POST["eddpcs_nav_arrow_bg_hover_color"]))
    {
        $eddpcs_nav_arrow_bg_hover_color_value = sanitize_text_field( $_POST["eddpcs_nav_arrow_bg_hover_color"] );
    }   
    update_post_meta($post_id, "eddpcs_nav_arrow_bg_hover_color", $eddpcs_nav_arrow_bg_hover_color_value);


    if(isset($_POST["eddpcs_title_font_size"]))
    {
        $eddpcs_title_font_size_value = sanitize_text_field( $_POST["eddpcs_title_font_size"] );
    }   
    update_post_meta($post_id, "eddpcs_title_font_size", $eddpcs_title_font_size_value);


    if(isset($_POST["eddpcs_title_font_color"]))
    {
        $eddpcs_title_font_color_value = sanitize_text_field( $_POST["eddpcs_title_font_color"] );
    }   
    update_post_meta($post_id, "eddpcs_title_font_color", $eddpcs_title_font_color_value);


    if(isset($_POST["eddpcs_title_hover_font_color"]))
    {
        $eddpcs_title_hover_font_color_value = sanitize_text_field( $_POST["eddpcs_title_hover_font_color"] );
    }   
    update_post_meta($post_id, "eddpcs_title_hover_font_color", $eddpcs_title_hover_font_color_value);


    if(isset($_POST["eddpcs_category_font_size"]))
    {
        $eddpcs_category_font_size_value = sanitize_text_field( $_POST["eddpcs_category_font_size"] );
    }   
    update_post_meta($post_id, "eddpcs_category_font_size", $eddpcs_category_font_size_value);


    if(isset($_POST["eddpcs_category_font_color"]))
    {
        $eddpcs_category_font_color_value = sanitize_text_field( $_POST["eddpcs_category_font_color"] );
    }   
    update_post_meta($post_id, "eddpcs_category_font_color", $eddpcs_category_font_color_value);


    if(isset($_POST["eddpcs_category_hover_font_color"]))
    {
        $eddpcs_category_hover_font_color_value = sanitize_text_field( $_POST["eddpcs_category_hover_font_color"] );
    }   
    update_post_meta($post_id, "eddpcs_category_hover_font_color", $eddpcs_category_hover_font_color_value);


    if(isset($_POST["eddpcs_cart_font_size"]))
    {
        $eddpcs_cart_font_size_value = sanitize_text_field( $_POST["eddpcs_cart_font_size"] );
    }   
    update_post_meta($post_id, "eddpcs_cart_font_size", $eddpcs_cart_font_size_value);


    if(isset($_POST["eddpcs_cart_font_color"]))
    {
        $eddpcs_cart_font_color_value = sanitize_text_field( $_POST["eddpcs_cart_font_color"] );
    }   
    update_post_meta($post_id, "eddpcs_cart_font_color", $eddpcs_cart_font_color_value);


    if(isset($_POST["eddpcs_cart_bg_color"]))
    {
        $eddpcs_cart_bg_color_value = sanitize_text_field( $_POST["eddpcs_cart_bg_color"] );
    }   
    update_post_meta($post_id, "eddpcs_cart_bg_color", $eddpcs_cart_bg_color_value);


    if(isset($_POST["eddpcs_cart_button_hover_color"]))
    {
        $eddpcs_cart_button_hover_color_value = sanitize_text_field( $_POST["eddpcs_cart_button_hover_color"] );
    }   
    update_post_meta($post_id, "eddpcs_cart_button_hover_color", $eddpcs_cart_button_hover_color_value);


    if(isset($_POST["eddpcs_cart_button_hover_font_color"]))
    {
        $eddpcs_cart_button_hover_font_color_value = sanitize_text_field( $_POST["eddpcs_cart_button_hover_font_color"] );
    }   
    update_post_meta($post_id, "eddpcs_cart_button_hover_font_color", $eddpcs_cart_button_hover_font_color_value);


    if(isset($_POST["eddpcs_header1_title_bg_color"]))
    {
        $eddpcs_header1_title_bg_color_value = sanitize_text_field( $_POST["eddpcs_header1_title_bg_color"] );
    }   
    update_post_meta($post_id, "eddpcs_header1_title_bg_color", $eddpcs_header1_title_bg_color_value);


    if(isset($_POST["themeB_border_color"]))
    {
        $themeB_border_color_value = sanitize_text_field( $_POST["themeB_border_color"] );
    }   
    update_post_meta($post_id, "themeB_border_color", $themeB_border_color_value);


    if(isset($_POST["themeB_border_hover_color"]))
    {
        $themeB_border_hover_color_value = sanitize_text_field( $_POST["themeB_border_hover_color"] );
    }   
    update_post_meta($post_id, "themeB_border_hover_color", $themeB_border_hover_color_value);


    if(isset($_POST["themeC_border_hover_color"]))
    {
        $themeC_border_hover_color_value = sanitize_text_field( $_POST["themeC_border_hover_color"] );
    }   
    update_post_meta($post_id, "themeC_border_hover_color", $themeC_border_hover_color_value);

}
add_action( 'save_post', 'eddpcs_save_meta_box_data' );