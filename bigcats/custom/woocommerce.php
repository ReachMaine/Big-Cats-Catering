<?php 
/* woocommerce hooks & filters here */

	/***************************** 
	* things in this function are called after flatsome is setup, if want to use flatsome values OR calls OR
	to overwrite flatsome specific things.  they need to go here, everytning else can just go in the file.
	**********************/
	function reach_woo_setup() {
		// flatsome uses it's own actions for ordering & filtering
		// remove "showing all 10 results" & default sorting
		remove_action( 'ux_woocommerce_navigate_products', 'woocommerce_result_count', 20 );
 		remove_action( 'ux_woocommerce_navigate_products', 'woocommerce_catalog_ordering', 30 );

	}

	// remove sku from product details.
	add_filter( 'wc_product_sku_enabled', '__return_false' );


	// remove additional information tab
	add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
	function woo_remove_product_tabs( $tabs ) {

		unset( $tabs['additional_information'] );  	// Remove the additional information tab
		return $tabs;

	}

	// hide count from category 
	add_filter( 'woocommerce_subcategory_count_html', 'woo_remove_category_products_count' );
	function woo_remove_category_products_count() {
		return;
	}

	// single product, move price farther down the page (not 2nd)
 	//woocommerce_template_single_price	
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );


    /* change the add to cart text.... */
	// for single products 
	add_filter( 'woocommerce_product_single_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' ); // product
	function custom_woocommerce_product_add_to_cart_text() {
		global $product;
	
		$product_type = $product->product_type;
		switch ( $product_type ) {
			case 'variable':
				return __( 'Register','woocommerce' ); // was 'add to cart'
				break;
			default: 
				return __( 'Add to Cart','woocommerce' ); // was 'add to cart'
				break;
		}
	}

	// for add to cart text in loops 
	add_filter ('addons_add_to_cart_text', 'custom_woocommerce_loop_add_to_cart_text');
	add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_loop_add_to_cart_text' );  // product loops
	function custom_woocommerce_loop_add_to_cart_text() {
			global $product;
	
			$product_type = $product->product_type;
			switch ( $product_type ) {
				case 'external':
					$retstring  = 'Buy product';
					break;
				case 'addons': 
					$retstring = "Learn More"; // was select options
					break;
				case 'grouped':
					$retstring  ='View products';
					break;
				case 'simple':
					$retstring  ='Add to Cart'; // was add to cart
					break;
				case 'variable':
					$retstring  ='Learn More'; // was select options
					break;
				default:
					$retstring  ='Learn more';
			}
			return __( $retstring, 'woocommerce' ); 
			//return __($retstring.' '.$product_type);
	}

	/**
	 * Changes the redirect URL for the Return To Shop button in the cart.
	 *
	 * @return string
	 */
	function wc_empty_cart_redirect_url() {
		return 'http://reachvtmarketing.com/penobscot.us/';
	}
	add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );

	// Remove prices from loop
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

	// add custom field/desc in product loop 
	add_action('woocommerce_after_shop_loop_item_title', 'penob_custom_info', 10);
	function penob_custom_info() {
		global $product;
		$product_byline = get_post_meta($product->id, 'product_byline', true);
		if ($product_byline) {
			echo do_shortcode($product_byline);
		} else {
			//echo "nada.";
		} 
	}
	
