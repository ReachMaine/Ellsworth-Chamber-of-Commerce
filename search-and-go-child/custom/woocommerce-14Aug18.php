<?php
/* woocommerce customizations
*/
// to remove sku from everywhere....
add_filter( 'wc_product_sku_enabled', '__return_false' );

// remove the Additional_information tab
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

	function woo_remove_product_tabs( $tabs ) {

		unset( $tabs['additional_information'] );  	// Remove the additional information tab

		return $tabs;

	}
  // remove categories printed at bottom of single product page.
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

    /*
  Disable Variable Product Price Range completely:
  */

  add_filter( 'woocommerce_variable_sale_price_html', 'my_remove_variation_price', 10, 2 );
  add_filter( 'woocommerce_variable_price_html', 'my_remove_variation_price', 10, 2 );

  function my_remove_variation_price( $price ) {
      $price = '';
      return $price;
    }

/* Woocommerce Emails */
add_action( 'woocommerce_email_before_order_table', 'bbloomer_add_content_specific_email', 20, 4 );
function bbloomer_add_content_specific_email( $order, $sent_to_admin, $plain_text, $email ) {
    if ( $email->id == 'customer_processing_order' ) {
        echo '<p class="email-ticketsell">If your purchase includes tickets, your printable ticket(s) will be attached as a pdf to this email.</p>';
    }
}
?>
