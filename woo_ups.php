<?php
/*
Plugin Name: Woo Ups plugin
Plugin URI: https://github.com/binoy619/woocommerce-ups/
Description: woo ups method plugin
Version: 0.0.3
Author: binoy619
Author URI: https://github.com/binoy619/
*/
 
/**
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
	function woo_ups_method_init() {
		if ( ! class_exists( 'WC_woo_ups_Method' ) ) {
			class WC_woo_ups_Method extends WC_Shipping_Method {
				/**
				 * Constructor for woo_ups class
				 *
				 * @access public
				 * @return void
				 */
				public function __construct() {
					$this->id                 = 'woo_ups_method'; // Id for woo ups method. Should be uunique.
					$this->method_title       = __( 'woo ups Method' );  // Title shown in admin
					$this->method_description = __( 'Description of woo ups method' ); // Description shown in admin
 
					$this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled
					$this->title              = "My Shipping Method"; // This can be added as an setting but for this example its forced.
 
					$this->init();
				}
 
				/**
				 * Init your settings
				 *
				 * @access public
				 * @return void
				 */
				function init() {
					// Load the settings API
					$this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
					$this->init_settings(); // This is part of the settings API. Loads settings you previously init.
 
					// Save settings in admin if you have any defined
					add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
				}
 
				/**
				 * calculate_shipping function.
				 *
				 * @access public
				 * @param mixed $package
				 * @return void
				 */
				public function calculate_shipping( $package ) {
					$rate = array(
						'id' => $this->id,
						'label' => $this->title,
						'cost' => '10.99',
						'calc_tax' => 'per_item'
					);
 
					// Register the rate
					$this->add_rate( $rate );
				}
			}
		}
	}
 
	add_action( 'woocommerce_shipping_init', 'woo_ups_method_init' );
 
	function add_woo_ups_method( $methods ) {
		$methods[] = 'WC_woo_ups_Method';
		return $methods;
	}
 
	add_filter( 'woocommerce_shipping_methods', 'add_woo_ups_method' );
}
