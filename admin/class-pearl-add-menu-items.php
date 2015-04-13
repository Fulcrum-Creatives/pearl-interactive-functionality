<?php

/**
 * Add Custom Menu Items to the Admin
 *
 * @link       http://fulcrumcreatives.com/
 * @since      1.0.0
 *
 * @package    Pearl
 * @subpackage Pearl/admin
 */

/**
 * Add Custom Menu Items to the Admin
 *
 * @package    Pearl
 * @subpackage Pearl/admin
 * @author     Fulcrum Creatives <info@fulcrumcreatives.com>
 */
class Pearl_Add_Menu_Items {

	public function __construct() { }

	public static function add_theme_settings(){
	    if( function_exists( 'acf_add_options_page') ) {
			acf_add_options_page( array( 'page_title'  => 'Theme Settings' ) );
		}
	}
}