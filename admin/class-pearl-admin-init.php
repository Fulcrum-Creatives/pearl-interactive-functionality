<?php
/**
 * 
 *
 * @package     Pearl
 * @subpackage  Pearl/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class Pearl_Admin_Init {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		$this->add_theme_settings();
	}

	/**
	 * Add theme settings page
	 */
	public function add_theme_settings() {
		Pearl_Add_Menu_Items::add_theme_settings();
	}
}