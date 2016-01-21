<?php
/**
 * Function: custom_woocommerce_cart_link - custom shopping cart link for WooCommerce
 * Author: JF
 * Date: May 29, 2014
 */
function custom_woocommerce_cart_link() {
	global $woocommerce;
	?>
	<li class="cart">
	<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', SITE_TEXT_DOMAIN); ?>" class="cart-parent">
		<span>
	<?php
	//echo $woocommerce->cart->get_cart_total();
	echo '<span class="contents">' . sprintf(_n('Cart (%d)', 'Cart (%d)', $woocommerce->cart->get_cart_contents_count(), SITE_TEXT_DOMAIN), $woocommerce->cart->get_cart_contents_count()) . '</span>';
	?>
	</span>
	</a>
	</li>
	<?php
}


//customize related product output to 3
/**
 * Function: woocommerce_output_related_products - overwrite original function for setting up number of related products
 * Author: JF
 * Date: May 29, 2014
 */
function woocommerce_output_related_products() {

	//woocommerce_related_products(3,1); // Display 4 products in rows of 2
	$args = array(
		'posts_per_page' => 3,
		'columns' => 3,
		'orderby' => 'rand'
	);

	woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
}

//customize category information with category image in output
/**
 * Function: woocommerce_category_image - grab product category image for product-category in archive-prouduct.php
 * Author: JF
 * Date: Dec 19, 2014
 */
//add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
//show woocommerce category image
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
	    if ( $image ) {
		    echo '<img class="site-product-category-image" src="' . $image . '" alt="" />';
		}
	}
}
?>