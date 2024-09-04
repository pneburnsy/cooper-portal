<?php
/**
 * General functions used to integrate this theme with WooCommerce.
 *
 * @package Hub
 */

/**
 * Custom heading for loop product
 * @return string
 */
if ( ! function_exists( 'liquid_woocommerce_template_loop_product_title' ) ) {
	function liquid_woocommerce_template_loop_product_title() {
		echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
	}
}

if ( !function_exists( 'liquid_custom_label_sale_flash' ) ) {

	function liquid_custom_label_sale_flash() {
		
		global $product;
		
		$custom_label = get_post_meta( $product->get_id(), '_custom_label', true );

		if( !empty( $custom_label ) ) {
			echo '<span class="lqd-sp-label">' . esc_html( $custom_label ) . '</span>';
		}
		
	}

}

if ( ! function_exists( 'liquid_woocommerce_template_loop_product_link' ) ) {
    /**
     * Insert the opening anchor tag for products in the loop.
     */
    function liquid_woocommerce_template_loop_product_link() {
        global $product;

        $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

        echo '<a href="' . esc_url( $link ) . '" class="lqd-overlay liquid-overlay-link woocommerce-LoopProduct-link woocommerce-loop-product__link"></a>';
    }
}

/**
 * Liquid Get Seconday Image
 * @return string
 */
if ( !function_exists( 'liquid_get_secondary_product_image' ) ) {
	function liquid_get_secondary_product_image() {
		
		global $product;
	
		$hover_img = '';
		$hover_img_id = get_post_meta( $product->get_id(), 'product_product-secondary-image_thumbnail_id', true );

		if( ! empty( $hover_img_id ) ) {
			
			$image = wp_get_attachment_image( $hover_img_id, 'full', false );

			echo '<figure class="ld-sp-img-hover mt-0 mb-0 lqd-overlay"><a href="' . get_permalink() . '">' . $image . '</a></figure>';
		
		}
	
	}
}

if ( ! function_exists( 'liquid_woocommerce_template_loop_product_gallery' ) ) {

    /**
     * Get the product thumbnail for the loop.
     */
    function liquid_woocommerce_template_loop_product_gallery() {
		
		global $product;
		
		$attachment_ids = $product->get_gallery_image_ids();
		
		if ( $attachment_ids && $product->get_image_id() ) {
			
			echo '<div class="ld-sp-img-gallery">';
			
			foreach ( $attachment_ids as $attachment_id ) {
				
				echo '<a href="' . get_permalink() . '" class="ld-sp-img-gal-trigger"></a>';
				echo '<figure>';
				echo wp_get_attachment_image( $attachment_id, 'full', false, array( 'alt' => esc_attr( $product->get_title() ) ) );
				echo '</figure>';
				
			}
			
			echo '</div>';
		}
		
    }
}



/**
 * Custom Single Product Nav
 * @return string
 */
if ( !function_exists( 'liquid_woocommerce_single_product_nav' ) ) {
	function liquid_woocommerce_single_product_nav() {
		
		global $product;
		
		$previous = get_previous_post_link( '%link', '<span><i class="lqd-icn-ess icon-ion-ios-arrow-back"></i></span>' );
		$next = get_next_post_link( '%link', '<span><i class="lqd-icn-ess icon-ion-ios-arrow-forward"></i></span>' );
		$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
		
		echo '<div class="lqd-woo-pagination">
				' . $previous . '
				<a href="' . $shop_page_url . '" class="lqd-woo-pagination-all">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="#000">
						<rect width="7" height="7" x=".5" y=".5"/>
						<rect width="7" height="7" x="10.5" y=".5"/>
						<rect width="7" height="7" x=".5" y="10.5"/>
						<rect width="7" height="7" x="10.5" y="10.5"/>
					</svg>
				</a>
				' . $next . '
			</div>';

	}
}

function liquid_get_product_category() {
	
	global $post;
	$terms = get_the_terms( $post->ID, 'product_cat' );

	// check if the post has a category assigned to it
	if ( empty( $terms ) ){ 
		return;
	}

	$term_slug = $terms[0]->slug;
		
	echo '<a class="product-category" href="' . get_term_link( $term_slug, 'product_cat' ) . '"><span>' . $terms[0]->name . '</span></a>';
	
}

function get_shop_content() {
	
	$shop_page_id = wc_get_page_id( 'shop' );
	

	if( !empty( $shop_page_id ) && is_shop() ) {
		$shop_content = get_post( $shop_page_id );
		echo do_shortcode( $shop_content->post_content );
	}
	elseif( is_product_taxonomy() || is_product_category() ) {
		$term_id = get_queried_object_id();
		$content_id = get_term_meta( $term_id, 'liquid_page_id_content_to_cat' , true );

		if ( defined( 'ELEMENTOR_VERSION' ) ) :

        	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $content_id );

   		else :
		
			if( !empty( $content_id ) ) {
				$_content = get_post_field( 'post_content', $content_id );
				echo do_shortcode( $_content );
			}

		endif;
	}
}


if ( ! function_exists( 'liquid_woocommerce_template_loop_product_thumbnail' ) ) {

    /**
     * Get the product thumbnail for the loop.
     */
    function liquid_woocommerce_template_loop_product_thumbnail() {
        echo liquid_woocommerce_get_product_thumbnail(); // WPCS: XSS ok.
    }
}
if ( ! function_exists( 'liquid_woocommerce_get_product_thumbnail' ) ) {

    /**
     * Get the product thumbnail, or the placeholder if not set.
     *
     * @param string $size (default: 'woocommerce_thumbnail').
     * @param int    $deprecated1 Deprecated since WooCommerce 2.0 (default: 0).
     * @param int    $deprecated2 Deprecated since WooCommerce 2.0 (default: 0).
     * @return string
     */
    function liquid_woocommerce_get_product_thumbnail( $size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0 ) {

		global $product;
        
		$post_thumbnail_id = $product->get_image_id();
		$attachment_ids = array();
		$gallery_ids = $product->get_gallery_image_ids();
		
		$attachment_ids[] = $post_thumbnail_id;
		$attachment_ids = array_merge( $attachment_ids, $gallery_ids );

		$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
		
		$hover_img = '';
		$hover_img_id = get_post_meta( $product->get_id(), 'product_product-secondary-image_thumbnail_id', true );

		if( ! empty( $hover_img_id ) ) {
			$hover_img = '<figure class="ld-sp-img-hover mt-0 mb-0 ld-overlay">' . wp_get_attachment_image( $hover_img_id, $image_size, false, array( 'class' => 'w-100 h-100 objfit-cover objfit-center', 'alt' => esc_attr( $product->get_title() ), 'class' => 'invisible' ) ) . '</figure>' ;
		}

		if( count( $attachment_ids ) > 1 && apply_filters( 'liquid_enable_woo_products_carousel', true )  ) {
			
			$carousel = '<div class="carousel-container carousel-nav-floated carousel-nav-center carousel-nav-middle">

						<div class="carousel-items row mx-0" data-lqd-flickity=\'{ "prevNextButtons": true, "navArrow": { "prev": "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"12\" height=\"32\" viewBox=\"0 0 12 32\" style=\"width: 1em; height: 1em;\"><path fill=\"currentColor\" d=\"M3.625 16l7.938 7.938c.562.562.562 1.562 0 2.125-.313.312-.688.437-1.063.437s-.75-.125-1.063-.438L.376 17c-.563-.563-.5-1.5.063-2.063l9-9c.562-.562 1.562-.562 2.124 0s.563 1.563 0 2.125z\"></path></svg>", "next": "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"12\" height=\"32\" viewBox=\"0 0 12 32\" style=\"width: 1em; height: 1em;\"><path fill=\"currentColor\" d=\"M8.375 16L.437 8.062C-.125 7.5-.125 6.5.438 5.938s1.563-.563 2.126 0l9 9c.562.562.624 1.5.062 2.062l-9.063 9.063c-.312.312-.687.437-1.062.437s-.75-.125-1.063-.438c-.562-.562-.562-1.562 0-2.125z\"></path></svg>" }, "navOffsets": { "prev": 10, "next": 10 } }\'>';
			
			
			foreach( $attachment_ids as $attachment_id ) {			

				$carousel .= '<div class="carousel-item col-xs-12 px-0"><figure class="my-0">';
				$carousel .= wp_get_attachment_image( $attachment_id, $image_size, false, array( 'alt' => esc_attr( $product->get_title() ) ) );
				$carousel .= '</figure></div>';

			};
			
			$carousel .= '</div>';
			
			$carousel .= '</div>';
	
			return $carousel;
		}

        return $product ? $product->get_image( $image_size ) . $hover_img : '';
    }
}

/**
 * Custom breadcrumb
 * @return string
 */
if ( !function_exists( 'liquid_woocommerce_breadcrumb_args' ) ) {
	function liquid_woocommerce_breadcrumb_args( $args ) {
		
		$args = array(

			'delimiter'   => '',
			'wrap_before' => '<div class="col-md-6 lqd-shop-topbar-breadcrumb"><nav class="woocommerce-breadcrumb mb-4 mb-md-0"><ul class="breadcrumb reset-ul inline-nav inline-ul">',
			'wrap_after'  => '</ul></nav></div>',
			'before'      => '<li>',
			'after'       => '</li>',
			'home'        => esc_html_x( 'Home', 'breadcrumb', 'hub' ),
				
		);

		return $args;

	}
}

function liquid_get_compare_button() {
	
	if( class_exists( 'YITH_Woocompare_Frontend' ) ) {
		update_option( 'yith_woocompare_compare_button_in_product_page', '' );
		echo do_shortcode( '[yith_compare_button]' );
	}
	
}

function liquid_start_shop_topbar_container() {
	
	echo '<div class="ld-shop-topbar pos-rel fullwidth"><div class="container"><div class="row">';
	
}
function liquid_end_shop_topbar_container() {

	echo '</div></div></div>';
}

function liquid_start_sorter_counter_container() {
	echo '<div class="col-md-3 lqd-shop-topbar-result-count d-flex justify-content-end align-items-center">';
}
function liquid_end_sorter_counter_container() {
	echo '</div>';
}

/**
 * Add custom woocommerce template part for list loop
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_add_to_cart_list' ) ) {
	function liquid_woocommerce_add_to_cart_list() {
		wc_get_template( 'loop/add-to-cart-list.php' );
	}
}

/**
 * Add custom woocommerce template part for carousel loop
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_add_to_cart_carousel' ) ) {
	function liquid_woocommerce_add_to_cart_carousel() {
		wc_get_template( 'loop/add-to-cart-carousel.php' );
	}
}

/**
 * Add custom woocommerce template part for image grid
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_show_product_images_grid' ) ) {
	function liquid_woocommerce_show_product_images_grid() {
		wc_get_template( 'single-product/product-image-grid.php' );
	}
}

/**
 * Add custom woocommerce template part for image stick
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_show_product_images_stick' ) ) {
	function liquid_woocommerce_show_product_images_stick() {
		wc_get_template( 'single-product/product-image-stick.php' );
	}
}

/**
 * Add custom classnames to product content
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_get_template' ) ) {
	function liquid_woocommerce_get_template() {
		
		$style = liquid_helper()->get_option( 'wc-archive-product-style' );
		
		if( 'minimal' === $style || 'minimal-2' === $style ) {
			wc_get_template_part( 'content', 'product-minimal' );
			return;
		}
		elseif( 'minimal-hover-shadow' === $style ) {
			wc_get_template_part( 'content', 'product-minimal-hover-shadow' );
			return;
		}
		elseif( 'minimal-hover-shadow-2' === $style ) {
			wc_get_template_part( 'content', 'product-minimal-hover-shadow-2' );
			return;
		}
		elseif( 'classic' === $style || 'classic-alt' === $style ) {
			wc_get_template_part( 'content', 'product-classic' );
			return;
		}
		
		
	}
}


/**
 * Add custom classnames to product content
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_product_classnames' ) ) {
	function liquid_woocommerce_product_classnames() {
		
		$style = liquid_helper()->get_option( 'wc-archive-product-style' );
		
		if( 'classic' === $style ) {
			echo 'ld-sp-clsc pb-4 text-center';
		}		
		elseif( 'classic-alt' === $style ) {
			echo 'ld-sp-clsc ld-sp-clsc-alt pb-5 text-center';
		}		

		elseif( 'minimal' === $style ) {
			echo 'ld-sp-min-1';
		}
		elseif( 'minimal-2' === $style ) {
			echo 'ld-sp-min-2';			
		}
		elseif( 'minimal-hover-shadow' === $style ) {
			echo 'ld-sp-mhs-1';			
		}
		elseif( 'minimal-hover-shadow-2' === $style ) {
			echo 'ld-sp-mhs-2';			
		}
		
		
	}
}

function liquid_add_wishlist_button() {

	global $product;
	
/*
	if( $product->is_type( 'variable' ) ) {
		return'';
	}
*/

	//Check if the plugin is active and add icon add-to-wishlist
	if ( class_exists( 'YITH_WCWL' ) ):
	
		if( is_product() ) {
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');	
		}
		else {
			echo do_shortcode('[yith_wcwl_add_to_wishlist label="<i class=\'fa fa-heart\'></i>"]');	
		}
		
		
	endif;

}

function liquid_variable_add_wishlist_button() {

	global $product;
	
/*
	if( !$product->is_type( 'variable' ) ) {
		return'';
	}
*/

	//Check if the plugin is active and add icon add-to-wishlist
	if ( class_exists( 'YITH_WCWL' ) ):
		echo do_shortcode('[yith_wcwl_add_to_wishlist label="<i class=\'fa fa-heart\'></i>"]');
	endif;

}

function liquid_add_quickview_button() {

	global $product;
	
/*
	if( $product->is_type( 'variable' ) ) {
		return'';
	}
*/

	//Check if the plugin is active and add icon add-to-wishlist
	if ( class_exists( 'YITH_WCQV' ) ):
		echo do_shortcode('[yith_quick_view]');
	endif;

}



function liquid_start_summary_foot_container() {
	
	global $product;
	
	if( $product->is_type( 'variable' ) ) {
		return'';
	}
	
	if( $product->is_in_stock() ) {
		echo '<div class="ld-product-summary-foot d-flex flex-row align-items-center">';	
	}
	
}

function liquid_start_variable_summary_foot_container() {
	
	global $product;
	
	if( !$product->is_type( 'variable' ) ) {
		return'';
	}

	echo '<div class="ld-product-summary-foot d-flex flex-row align-items-center">';
	
}
function liquid_end_variable_summary_foot_container() {
	
	global $product;
	
	if( !$product->is_type( 'variable' ) ) {
		return'';
	}

	echo '</div>';
}
function liquid_end_summary_foot_container_no_stock() {

	global $product;
	
	if( $product->is_type( 'variable' ) ) {
		return'';
	}
	
	if( !$product->is_in_stock() ) {
		echo '<div class="ld-product-summary-foot d-flex flex-row align-items-center no-add-to-cart">';	
	}	
}
function liquid_end_summary_foot_container() {
	
	global $product;
	
	if( $product->is_type( 'variable' ) ) {
		return'';
	}

	echo '</div>';
}

/**
 * Add custom woocommerce template part for heading cart
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_header_cart' ) ) {
    function liquid_woocommerce_header_cart() {
        wc_get_template( 'cart/header-mini-cart.php' );
    }
}

/**
 * Enqueue theme-init js after woocommerce js
 * @return void
 */
if ( ! function_exists( 'liquid_theme_init_js' ) ) {
    function liquid_theme_init_js() {
		//Hook to enqueue woocommerce scripts bofore theme-init.js
		wp_dequeue_script( 'custom' );
		wp_enqueue_script( 'custom' );
    }
}

/**
 * Add heading to payment method
 * @return void
 */
if ( ! function_exists( 'liquid_heading_payment_method' ) ) {
	function liquid_heading_payment_method() {
		echo '<h3 class="order_review_heading">' . esc_html__( 'Payment', 'hub' ) . '</h3>';
	}
}

/**
 * Add custom woocommerce template part single product
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_template_single_cats' ) ) {
	function liquid_woocommerce_template_single_cats() {
		wc_get_template( 'single-product/cats-and-tags.php' );
	}
}

/**
 * Add custom woocommerce template part single product
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_variations_quantity_input' ) ) {
	function liquid_woocommerce_variations_quantity_input() {
		wc_get_template( 'single-product/add-to-cart/quantity-input.php' );
	}
}

/**
 * Add custom woocommerce template part single product
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_add_availability' ) ) {
	function liquid_woocommerce_add_availability() {
		wc_get_template( 'single-product/availability.php' );
	}
}

/**
 * Add 'woocommerce' class to the body tag
 * @param  array $classes
 * @return array $classes modified to include 'woocommerce' class
 */
if ( ! function_exists( 'liquid_woocommerce_body_class' ) ) {
	function liquid_woocommerce_body_class( $classes ) {
		
		if ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'page-templates/shop.php' ) {
	
			$classes[] = 'woocommerce';
		}
		
		$woo_product_style = liquid_helper()->get_theme_option( 'woo_single_style' );
		if( is_product() && 'alt' === $woo_product_style ) {
			$classes[] = 'single-product-alt';
		}
		
	
		return $classes;
	}
}

/**
 * Default loop columns on product archives
 * @return integer products per row
 * @since  1.0.0
 */
if ( ! function_exists( 'liquid_loop_columns' ) ) {
	function liquid_loop_columns() {
		$columns = liquid_helper()->get_option( 'ld_woo_columns', '3' );	
		if( empty( $columns ) ) {
			$columns = '3';
		}
		return $columns; // products per row
	}
}

/**
 * Default related loop columns on single product
 * @return integer columns per row
 * @since  1.0.0
 */
if ( ! function_exists( 'liquid_related_loop_columns' ) ) {
	function liquid_related_loop_columns() {
		$columns = liquid_helper()->get_option( 'ld_woo_related_columns', '4' );	
		if( empty( $columns ) ) {
			$columns = '4';
		}
		return $columns; // products per row
	}
}

/**
 * Default up-sell loop columns on single product
 * @return integer columns per row
 * @since  1.0.0
 */
if ( ! function_exists( 'liquid_upsell_loop_columns' ) ) {
	function liquid_upsell_loop_columns() {
		$columns = liquid_helper()->get_option( 'ld_woo_up_sell_columns', '4' );	
		if( empty( $columns ) ) {
			$columns = '4';
		}
		return $columns; // products per row
	}
}

/**
 * Default cross-sell loop columns
 * @return integer columns per row
 * @since  1.0.0
 */
if ( ! function_exists( 'liquid_cross_sell_loop_columns' ) ) {
	function liquid_cross_sell_loop_columns() {
		$columns = liquid_helper()->get_option( 'ld_woo_cross_sell_columns', '4' );	
		if( empty( $columns ) ) {
			$columns = '4';
		}
		return $columns; // products per row
	}
}

/**
 * Get default posts per page value
 * @return int
 */
function liquid_wc_get_current_posts_per_page_value( $force_value = null ) {	
	$posts_per_page = get_query_var( 'postsperpage' );
	if ( empty( $posts_per_page ) ) {

		if ( $force_value != null && intval( $force_value ) ) {
			$posts_per_page = $force_value;
		} else {
			$posts_per_page = liquid_helper()->get_option( 'ld_woo_products_per_page', '12' );
			if ( empty( $posts_per_page ) ) {
				$posts_per_page = get_option( 'posts_per_page' );
			}
		}
	}
	return intval( $posts_per_page );
}

/**
 * Limit post on products archive
 * @return type
 */
function liquid_wc_limit_archive_posts_per_page() {
	return liquid_wc_get_current_posts_per_page_value();
}

/**
 * Add postsperpage var to custom query
 * @param array $vars
 * @return string
 */
function liquid_wc_add_custom_query_var( $vars ){
  $vars[] = "postsperpage";
  return $vars;
}

/**
 * Get values to post per pages dropdown list
 * @return type
 */
function liquid_wc_get_posts_per_page_dropdown_values( $add_value = null ) {
  
	$current_value = liquid_wc_get_current_posts_per_page_value( $add_value );

	$values = array( 9, 12, 18, 24 );

	if ( ! in_array( $current_value, $values ) ) {
		$values[] = $current_value;
		sort( $values );
	}

	if ( ! in_array( $add_value, $values ) ) {
		$values[] = $add_value;
		sort( $values );
	}

	$defined_posts_per_page = intval( liquid_helper()->get_option( 'ld_woo_products_per_page' ) );
	if ( ! empty( $defined_posts_per_page ) &&  ! in_array( $defined_posts_per_page, $values ) ) {
		$values[] = liquid_helper()->get_option( 'ld_woo_products_per_page' );
		sort( $values );
	}

	return $values;
}

/**
 * Custom woocommerce order by array
 * @param array $sortby
 * @return array
 */

function liquid_woocommerce_catalog_orderby( $sortby ) {
	
	$sortby = array(
		'menu_order' => esc_html__( 'Default Order', 'hub' ),
		'popularity' => esc_html__( 'Popularity', 'hub' ),
		'rating'     => esc_html__( 'Rating', 'hub' ),
		'date'       => esc_html__( 'Newness', 'hub' ),
		'price'      => esc_html__( 'Lowest Price', 'hub' ),
		'price-desc' => esc_html__( 'Highest Price', 'hub' )
	);
	
	return $sortby;
}

/**
 * Define woocommerce image sizes
 */
function liquid_woocommerce_setup() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}

	$catalog = array(
		'width'  => '250', // px
		'height' => '358', // px
		'crop'   => 1      // true
	);

	$single = array(
		'width'  => '500', // px
		'height' => '760', // px
		'crop'   => 1      // true
	);

	$thumbnail = array(
		'width'  => '50', // px
		'height' => '72', // px
		'crop'   => 1     // true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size',   $catalog );   // Product category thumbs
	update_option( 'shop_single_image_size',    $single );    // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
	update_option( 'yith_wcwl_button_position', 'shortcode' );
}

/**
 * Empty the cart
 * @global object $woocommerce
 */
function liquid_woocommerce_clear_cart_url() {
  global $woocommerce;
	
	if ( is_object( $woocommerce ) && isset( $_GET['empty-cart'] ) ) {
		$woocommerce->cart->empty_cart();
		$url = $woocommerce->cart->get_cart_url();
		if ( empty( $url ) ) {
			$url = get_permalink( wc_get_page_id( 'shop' ) );
		}
		wp_redirect( esc_url($url) );
	}
}

/**
* WP Core doens't let us change the sort direction for invidual orderby params - http://core.trac.wordpress.org/ticket/17065
*
* This lets us sort by meta value desc, and have a second orderby param.
*
* @param array $args
* @return array
*/
function liquid_woocommerce_order_by_popularity_post_clauses( $args ) {

	global $wpdb;
	$args['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";
	return $args;
}

/**
* order_by_rating_post_clauses function.
*
* @param array $args
* @return array
*/
function liquid_woocommerce_order_by_rating_post_clauses( $args ) {

	global $wpdb;
	$args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";
	$args['where'] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";
	$args['join'] .= "
	   LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
	   LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
	";
	$args['orderby'] = "average_rating DESC, $wpdb->posts.post_date DESC";
	$args['groupby'] = "$wpdb->posts.ID";

	return $args;
};

function liquid_get_woo_header_notice() {
	
	global $woocommerce, $post;
	
	$notice = get_post_meta( $post->ID, 'liquid_woo_header_notice', true );
	if( empty( $notice ) || ' ' == $notice ) {
		return '';
	}
	
	printf( '<div class="ld-shop-notice pos-rel fullwidth"><div class="container"><div class="row"><div class="col-md-12 text-center"><h3>%s</h3></div></div></div></div>', wp_kses_post( $notice ) );

}

/*
 * Tab
 */
add_filter( 'woocommerce_product_data_tabs', 'liquid_product_settings_tabs' );
function liquid_product_settings_tabs( $tabs ){
 
	//unset( $tabs['inventory'] );
 
	$tabs['header-note'] = array(
		'label'    => esc_html__( 'Header Note', 'hub' ),
		'target'   => 'liquid_product_data',
		'priority' => 21,
	);
	return $tabs;
}
/*
 * Tab content
 */
add_action( 'woocommerce_product_data_panels', 'liquid_product_panels' );
function liquid_product_panels(){
	
	global $woocommerce, $post;
 
	echo '<div id="liquid_product_data" class="panel woocommerce_options_panel hidden">';
 
	woocommerce_wp_textarea_input( array(
		'id'          => 'liquid_woo_header_notice',
		'value'       => get_post_meta( $post->ID, 'liquid_woo_header_notice', true ),
		'label'       => esc_html__( 'Notice', 'hub' ),
		'desc_tip'    => true,
		'description' => esc_html__( 'Add header notice in yellow box', 'hub' ),
	) );

	echo '</div>';

}
add_action( 'woocommerce_process_product_meta', 'liquid_add_header_notice_field_save' );
/**
 * Save values for custom field in woo product
 * @return void
 */
function liquid_add_header_notice_field_save( $post_id ){

	// Custom button label
	$woo_header_notice = wp_kses_post( $_POST['liquid_woo_header_notice'] );
	if( !empty( $woo_header_notice ) ) {
		update_post_meta( $post_id, 'liquid_woo_header_notice', $woo_header_notice );
	}
}
add_action( 'admin_head', 'liquid_css_icon' );
function liquid_css_icon(){
	echo '<style>
	#woocommerce-product-data ul.wc-tabs li.header-note_options.header-note_tab a:before{
		content: "\f534";
	}
	</style>';
}

//Product Cat Create page
function liquid_taxonomy_add_select_page_field() {

	if ( defined('ELEMENTOR_VERSION') ){
		$pages = get_posts( array(
			'post_type' => 'elementor_library',
			'posts_per_page' => -1,
			'meta_query'  => array(
				array(
					'key' => '_elementor_template_type',
					'value' => 'kit',
					'compare' => '!=',
				),
			),
		) );
	} else {
		$pages = get_pages();
	}
    
    ?>

    <div class="form-field">
        <label for="liquid_select_page"><?php esc_html_e( 'Select a page', 'hub' ); ?></label>
			<select id="liquid_select_page" name="liquid_page_id_content_to_cat">
				<option value='' ><?php esc_html_e( 'None', 'hub' ); ?></option>
				<?php foreach( $pages as $page ) { ?>
				<option value="<?php echo esc_attr( $page->ID ); ?>"><?php echo esc_html( $page->post_title ); ?></option>
				<?php } ?>
        </select>
		<p class="description"><?php esc_html_e( 'Select a page, the content will display above the top bar', 'hub' ); ?></p>
    </div>
    <?php
}

//Product Cat Edit page
function liquid_taxonomy_edit_select_page_field( $term ) {
	
	if ( defined('ELEMENTOR_VERSION') ){
		$pages = get_posts( array(
			'post_type' => 'elementor_library',
			'posts_per_page' => -1,
			'meta_query'  => array(
				array(
					'key' => '_elementor_template_type',
					'value' => 'kit',
					'compare' => '!=',
				),
			),
		) );
	} else {
		$pages = get_pages();
	}

    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field.
   $liquid_page_content_to_cat = get_term_meta( $term_id, 'liquid_page_id_content_to_cat', true );

    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="wh_meta_title"><?php esc_html_e( 'Select a page', 'hub' ); ?></label></th>
        <td>
	        <label for="liquid_select_page"><?php esc_html_e( 'Select a page', 'hub' ); ?></label>
			<select id="liquid_select_page" name="liquid_page_id_content_to_cat">
				<option value='' ><?php esc_html_e( 'None', 'hub' ); ?></option>
				<?php foreach( $pages as $page ) { ?>
				<option <?php selected(  $liquid_page_content_to_cat, $page->ID ); ?> value="<?php echo esc_attr( $page->ID ); ?>"><?php echo esc_html( $page->post_title ); ?></option>
				<?php } ?>
			</select>
			<p class="description"><?php esc_html_e( 'Select a page, the content will display above the top bar', 'hub' ); ?></p>
        </td>
    </tr>
    <?php
}

add_action( 'product_cat_add_form_fields', 'liquid_taxonomy_add_select_page_field', 10, 1 );
add_action( 'product_cat_edit_form_fields', 'liquid_taxonomy_edit_select_page_field', 10, 1 );
add_action( 'edited_product_cat', 'liquid_save_taxonomy_select_page_to_cat', 10, 1 );
add_action( 'create_product_cat', 'liquid_save_taxonomy_select_page_to_cat', 10, 1 );

// Save extra taxonomy fields callback function.
function liquid_save_taxonomy_select_page_to_cat( $term_id ) {

    $liquid_page_content_to_cat = filter_input( INPUT_POST, 'liquid_page_id_content_to_cat' );
    update_term_meta( $term_id, 'liquid_page_id_content_to_cat', $liquid_page_content_to_cat );
}

function liquid_taxonomy_add_fullwidth_product_cat( $taxonomy ) { ?>
    <div class="form-field term-group">
        <label for="fullwidth_product_cat">
          <?php esc_html_e( 'Fullwidth?', 'hub' ); ?> <input type="checkbox" id="fullwidth_product_cat" name="fullwidth_product_cat" value="yes" />
        </label>
        <p class="description"><?php esc_html_e( 'Makes the category layout fullwidth', 'hub' ); ?></p>
    </div><?php
}


// Edit term page
function liquid_taxonomy_edit_fullwidth_product_cat( $term, $taxonomy ) {

	    $fullwidth_product_cat = get_term_meta( $term->term_id, 'fullwidth_product_cat', true );
		$checked = $fullwidth_product_cat ? checked( $fullwidth_product_cat, 'yes' ) : '';

    ?>

    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="fullwidth_product_cat"><?php esc_html_e( 'Fullwidth?', 'hub' ); ?></label>
        </th>
        <td>
            <input type="checkbox" id="fullwidth_product_cat" name="fullwidth_product_cat" value="yes" <?php echo esc_attr( $checked ); ?>/>
            <p class="description"><?php esc_html_e( 'Makes the category layout fullwidth', 'hub' ); ?></p>
        </td>
    </tr><?php
}


// Save custom meta
function liquid_taxonomy_save_fullwidth_product_cat( $term_id, $tag_id ) {
    if ( isset( $_POST[ 'fullwidth_product_cat' ] ) ) {
        update_term_meta( $term_id, 'fullwidth_product_cat', 'yes' );
    } else {
        update_term_meta( $term_id, 'fullwidth_product_cat', '' );
    }
}


add_action( 'product_cat_add_form_fields', 'liquid_taxonomy_add_fullwidth_product_cat', 10, 2 );
add_action( 'product_cat_edit_form_fields', 'liquid_taxonomy_edit_fullwidth_product_cat', 10, 2 );

add_action( 'created_product_caty', 'liquid_taxonomy_save_fullwidth_product_cat', 10, 2 );
add_action( 'edited_product_cat', 'liquid_taxonomy_save_fullwidth_product_cat', 10, 2 );


// Size Guide
function liquid_product_size_guide_template( $post_id, $type ) {

	
	STATIC $status = false;

	if ( $status ) {
		return; // Blocked 2nd time render because of sticky add to cart option
	}

	if ( $type == 'modal' ) {
		?>
			<div id="<?php echo esc_attr( 'lqd-modal-product-size-guide' ); ?>" class="lqd-modal lity-hide" data-modal-type="default">
				<div class="lqd-modal-inner">
					<div class="lqd-modal-content">
						<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id ); ?>
					</div>
					<div class="lqd-modal-foot"></div>
				</div>
			</div>

			<?php $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' ); ?>

			<a class="elementor-button btn lqd-size-guide-button mb-4" href="#lqd-modal-product-size-guide" data-lity="#lqd-modal-product-size-guide">
				<?php
					$button_text = $page_settings_manager->get_model( $post_id )->get_settings( 'lqd_sizeguide_btn_text' );
					$button_icon = $page_settings_manager->get_model( $post_id )->get_settings( 'lqd_sizeguide_btn_icon' );
					\Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] );
					echo $button_text;
				?>
			</a>
		<?php
		$status = true;
	} else if ( $type == 'direct' ) {
		printf( '<div class="w-100 mb-4">%s</div>', Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id ) );
		$status = true;
	}

}

function liquid_product_size_guide() {

	if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {

		$posts = get_posts( array(
			'post_type' => 'ld-product-sizeguide',
			'posts_per_page' => -1,
		) );

		$terms = get_the_terms( get_the_ID(), 'product_cat' );
		$single_cats = array();
		foreach ( $terms as $term ) {
            $single_cats[] = $term->term_id;
        }

		$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

		foreach ( $posts as $post ) {

			$show_by = $page_settings_manager->get_model( $post->ID )->get_settings( 'lqd_sizeguide_show_by' );
			$type = $page_settings_manager->get_model( $post->ID )->get_settings( 'lqd_sizeguide_type' );

			if ( $show_by == 'cats' ) {
				$cats = $page_settings_manager->get_model( $post->ID )->get_settings( 'lqd_sizeguide_cats' );
				if ( !empty( array_intersect( $cats, $single_cats ) ) )
					return liquid_product_size_guide_template( $post->ID, $type );
			} else if ( $show_by == 'products' ) {
				$products = $page_settings_manager->get_model( $post->ID )->get_settings( 'lqd_sizeguide_products' );
				if ( !empty( $products ) && in_array( get_the_ID(), $products ) )
					return liquid_product_size_guide_template( $post->ID, $type );
			} else if ( $show_by == 'all' ) {
				return liquid_product_size_guide_template( $post->ID, $type );
			}

		}

	}

}

// Sticky Add to Cart

function liquid_product_sticky_atc_template( $post_id ) {

	printf(
		'<div class="lqd-sticky-atc-wrap"><div class="lqd-sticky-atc-sentinel w-100 pos-abs" style="height: 1px;left:0;" data-inview="true" data-inview-options=\'{"toggleBehavior": "toggleInView"}\'></div>%s<div id="lqd-sticky-atc" class="lqd-sticky-atc w-100" style="position:fixed;z-index:99;bottom:0;left:0">%s</div></div>',
		'<button data-ld-toggle="true" data-toggle="collapse" data-target="#lqd-sticky-atc" class="lqd-sticky-atc-mobile-toggle align-items-center justify-content-center pos-fix"><svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.46484 9.01758H10.9688C11.0664 9.01758 11.1504 8.98242 11.2207 8.91211C11.2949 8.8418 11.332 8.75195 11.332 8.64258C11.332 8.53711 11.2949 8.44727 11.2207 8.37305C11.1504 8.29883 11.0664 8.26172 10.9688 8.26172H4.55859C4.39844 8.26172 4.26758 8.21094 4.16602 8.10938C4.06836 8.00781 4.00391 7.86914 3.97266 7.69336L3.05273 1.44727C3.02539 1.25586 2.96484 1.11133 2.87109 1.01367C2.78125 0.912109 2.60547 0.861328 2.34375 0.861328H0.369141C0.271484 0.861328 0.185547 0.900391 0.111328 0.978516C0.0371094 1.05273 0 1.14062 0 1.24219C0 1.34766 0.0371094 1.4375 0.111328 1.51172C0.185547 1.58594 0.271484 1.62305 0.369141 1.62305H2.28516L3.1875 7.79883C3.24219 8.17773 3.37305 8.47656 3.58008 8.69531C3.78711 8.91016 4.08203 9.01758 4.46484 9.01758ZM2.96484 2.97656H8.58398C8.57227 2.86328 8.56836 2.73828 8.57227 2.60156C8.58008 2.46094 8.59375 2.33398 8.61328 2.2207H2.96484V2.97656ZM3.46289 7.05469H10.957C11.25 7.05469 11.4863 6.99219 11.666 6.86719C11.8496 6.73828 11.9902 6.54883 12.0879 6.29883C11.8809 6.29492 11.6758 6.27344 11.4727 6.23438C11.2734 6.19531 11.0801 6.13477 10.8926 6.05273C10.8535 6.13477 10.8027 6.19727 10.7402 6.24023C10.6816 6.2793 10.6035 6.29883 10.5059 6.29883H3.46289V7.05469ZM4.95703 11.7012C5.20312 11.7012 5.41211 11.6152 5.58398 11.4434C5.75586 11.2754 5.8418 11.0684 5.8418 10.8223C5.8418 10.5762 5.75586 10.3672 5.58398 10.1953C5.41211 10.0234 5.20312 9.9375 4.95703 9.9375C4.71094 9.9375 4.50195 10.0234 4.33008 10.1953C4.1582 10.3672 4.07227 10.5762 4.07227 10.8223C4.07227 11.0684 4.1582 11.2754 4.33008 11.4434C4.50195 11.6152 4.71094 11.7012 4.95703 11.7012ZM10.1074 11.7012C10.3535 11.7012 10.5605 11.6152 10.7285 11.4434C10.9004 11.2754 10.9863 11.0684 10.9863 10.8223C10.9863 10.5762 10.9004 10.3672 10.7285 10.1953C10.5605 10.0234 10.3535 9.9375 10.1074 9.9375C9.86133 9.9375 9.65039 10.0234 9.47461 10.1953C9.29883 10.3672 9.21094 10.5762 9.21094 10.8223C9.21094 11.0684 9.29883 11.2754 9.47461 11.4434C9.65039 11.6152 9.86133 11.7012 10.1074 11.7012ZM12.0762 5.58398C12.4512 5.58398 12.8066 5.51172 13.1426 5.36719C13.4785 5.21875 13.7754 5.01562 14.0332 4.75781C14.291 4.5 14.4922 4.20312 14.6367 3.86719C14.7852 3.53125 14.8594 3.17188 14.8594 2.78906C14.8594 2.28125 14.7324 1.81641 14.4785 1.39453C14.2285 0.972656 13.8906 0.634766 13.4648 0.380859C13.043 0.126953 12.5801 0 12.0762 0C11.5645 0 11.0977 0.126953 10.6758 0.380859C10.2539 0.634766 9.91602 0.972656 9.66211 1.39453C9.4082 1.81641 9.28125 2.28125 9.28125 2.78906C9.28125 3.17578 9.35352 3.53711 9.49805 3.87305C9.64258 4.20898 9.84375 4.50586 10.1016 4.76367C10.3594 5.02148 10.6562 5.22266 10.9922 5.36719C11.3281 5.51172 11.6895 5.58398 12.0762 5.58398ZM12.0762 4.54688C11.9785 4.54688 11.9004 4.51758 11.8418 4.45898C11.7832 4.40039 11.7539 4.32227 11.7539 4.22461V3.11133H10.6406C10.5469 3.11133 10.4688 3.08203 10.4062 3.02344C10.3477 2.96484 10.3184 2.88672 10.3184 2.78906C10.3184 2.69141 10.3477 2.61328 10.4062 2.55469C10.4688 2.49609 10.5469 2.4668 10.6406 2.4668H11.7539V1.35938C11.7539 1.26172 11.7832 1.18359 11.8418 1.125C11.9004 1.06641 11.9785 1.03711 12.0762 1.03711C12.1738 1.03711 12.252 1.06641 12.3105 1.125C12.3691 1.18359 12.3984 1.26172 12.3984 1.35938V2.4668H13.5059C13.6035 2.4668 13.6816 2.49609 13.7402 2.55469C13.7988 2.61328 13.8281 2.69141 13.8281 2.78906C13.8281 2.88672 13.7988 2.96484 13.7402 3.02344C13.6816 3.08203 13.6035 3.11133 13.5059 3.11133H12.3984V4.22461C12.3984 4.32227 12.3691 4.40039 12.3105 4.45898C12.252 4.51758 12.1738 4.54688 12.0762 4.54688Z" fill="currentColor"/> </svg></button>',
		Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id )
	);

}

function liquid_product_sticky_add_to_cart(){

	if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {

		$posts = get_posts( array(
			'post_type' => 'liquid-sticky-atc',
			'posts_per_page' => -1,
		) );

		$terms = get_the_terms( get_the_ID(), 'product_cat' );
		$single_cats = array();
		foreach ( $terms as $term ) {
            $single_cats[] = $term->term_id;
        }

		$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

		foreach ( $posts as $post ) {

			$show_by = $page_settings_manager->get_model( $post->ID )->get_settings( 'lqd_sticky_atc_show_by' );

			if ( $show_by == 'cats' ) {
				$cats = $page_settings_manager->get_model( $post->ID )->get_settings( 'lqd_sticky_atc_cats' );
				if ( !empty( array_intersect( $cats, $single_cats ) ) )
					return liquid_product_sticky_atc_template( $post->ID );
			} else if ( $show_by == 'products' ) {
				$products = $page_settings_manager->get_model( $post->ID )->get_settings( 'lqd_sticky_atc_products' );
				if ( !empty( $products ) && in_array( get_the_ID(), $products ) )
					return liquid_product_sticky_atc_template( $post->ID );
			} else if ( $show_by == 'all' ) {
				liquid_product_sticky_atc_template( $post->ID );
				return;
			}

		}

	}

}

add_action( 'woocommerce_after_single_product', 'liquid_product_sticky_add_to_cart', 10, 2 );


/**
 * Set a minimum order amount for checkout
 */
add_action( 'woocommerce_checkout_process', 'liquid_wc_order_amount' );
add_action( 'woocommerce_before_cart' , 'liquid_wc_order_amount' );

function liquid_wc_order_amount() {

	$minimum = liquid_helper()->get_option( 'wc_minimum_order_amount' );
    
	if ( !empty( $minimum ) && $minimum > 0 ) {

		if ( WC()->cart->total < $minimum ) {

			$minimum_text = liquid_helper()->get_option( 'wc_minimum_order_amount_text' );
	
			if( is_cart() ) {
	
				wc_print_notice( 
					sprintf( $minimum_text, 
						wc_price( WC()->cart->total ), 
						wc_price( $minimum )
					), 'error' 
				);
	
			} else {
	
				wc_add_notice( 
					sprintf( $minimum_text, 
						wc_price( WC()->cart->total ), 
						wc_price( $minimum )
					), 'error' 
				);
	
			}
		}

	}

	$maximum = liquid_helper()->get_option( 'wc_maximum_order_amount' );
    
	if ( !empty( $maximum ) && $maximum > 0 ) {

		if ( WC()->cart->total > $maximum ) {

			$maximum_text = liquid_helper()->get_option( 'wc_maximum_order_amount_text' );
	
			if( is_cart() ) {
	
				wc_print_notice( 
					sprintf( $maximum_text, 
						wc_price( WC()->cart->total ), 
						wc_price( $maximum )
					), 'error' 
				);
	
			} else {
	
				wc_add_notice( 
					sprintf( $maximum_text, 
						wc_price( WC()->cart->total ), 
						wc_price( $maximum )
					), 'error' 
				);
	
			}
		}

	}

}