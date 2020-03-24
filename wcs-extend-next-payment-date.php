<?php
/*
 * Plugin Name: WooCommerce Subscriptions - Extend Next Payment Date
 * Plugin URI:  https://github.com/seb86/wcs-extend-next-payment-date
 * Description: Extends the next payment date of any new subscription defined by your `wp-config.php`. <strong>PHP v7+ required!</strong>
 * Author:      Sébastien Dumont
 * Author URI:  https://sebastiendumont.com
 * Version:     1.0.0
 *
 * License:     GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * GitHub Plugin URI: https://github.com/seb86/wcs-extend-next-payment-date
 */

/**
 * If any of these constants are already defined in your `wp-config.php` file 
 * then they will be used. Otherwise, the following default constants will 
 * be used instead.
 *
 ****************************************************************************
 * DO NOT EDIT CONSTANTS BELOW!!!
 ****************************************************************************
 */

if ( ! defined( 'WCS_EXTEND_PERIOD_BY' ) ) {
	define( 'WCS_EXTEND_PERIOD_BY', 'month' ); // options: day, week, month or year
}

if ( ! defined( 'WCS_EXTEND_LENGTH_BY' ) ) {
	define( 'WCS_EXTEND_LENGTH_BY', '2' ); // e.g. 2 x period by
}

// Specify a date if you wish to only extend subscriptions that were ordered before it.
if ( ! defined( 'WCS_EXTEND_UNTIL_DAY' ) ) {
	define( 'WCS_EXTEND_UNTIL_DAY', '31' ); // e.g. 31st of July
}
if ( ! defined( 'WCS_EXTEND_UNTIL_MONTH' ) ) {
	define( 'WCS_EXTEND_UNTIL_MONTH', '07' ); // options: 01, 02, 03, 04, 05, 06, 07, 08, 09, 10, 11, 12
}
if ( ! defined( 'WCS_EXTEND_UNTIL_YEAR' ) ) {
	define( 'WCS_EXTEND_UNTIL_YEAR', '2020' );
}

/**
 * List the product id's of the subscriptions that can be extended only!
 *
 * NOTE: Default is empty so any subscription is extended.
 */
if ( ! defined( 'WCS_EXTEND_PRODUCTS' ) ) {
	define( 'WCS_EXTEND_PRODUCTS', array(

	) ); 
}

add_filter( 'woocommerce_subscriptions_calculated_next_payment_date', 'extend_calculated_next_payment_date', 10, 5 );

/**
 * @param string  $next_payment - The original next payment date set.
 * @param mixed   $order        - A WC_Order object or the ID of the order which the subscription was purchased in.
 * @param int     $product_id   - The product/post ID of the subscription
 * @param string  $type         - The format for the Either 'mysql' or 'timestamp'.
 * @param mixed   $from_date    - A MySQL formatted date/time string from which to calculate the next payment date.
 * @return string $next_payment - The extended next payment date.
 */
function extend_calculated_next_payment_date( $next_payment, $order, $product_id, $type, $from_date ) {
	// If the specific products are set and the product ID does not match any in the list then just return original $next_payment.
	if ( ! empty( WCS_EXTEND_PRODUCTS ) && in_array( $product_id, WCS_EXTEND_PRODUCTS ) ) {
		return $next_payment;
	}

	$today    = new DateTime('now');
	$due_date = new DateTime( WCS_EXTEND_UNTIL_YEAR . '-' . WCS_EXTEND_UNTIL_MONTH . '-' . WCS_EXTEND_UNTIL_DAY );

	// If we have reached the date we would extend subscriptions then just return the original next date.
	if ( strtotime( $today ) > strtotime( $due_date ) ) {
		return $next_payment;
	}

	// Original next payment date.
	$date = new DateTime( $next_payment );

	// Extend date.
	$date->modify( '+' . WCS_EXTEND_LENGTH_BY . ' ' . WCS_EXTEND_PERIOD_BY );

	// Return new next payment date.
	$next_payment = $date->format('Y-m-d h:i:s');

	return $next_payment;
}