<?php
/**
 * Change the default Posts Menu item
 *
 * @link       http://fulcrumcreatives.com/
 * @since      1.0.0
 *
 * @package    Pearl
 * @subpackage Pearl/admin
 */

class Pearl_Rename_Post {

	/**
	 * The new name for Posts
	 * 
	 * @var string
	 */
	public $name;
	
	/**
     * Plural Version of name
     *
     * @var string
     */
    public $plural;

	/**
	 * Initialize the class
	 */
	public function __construct( $name, $plural = '' ) {
		$this->name   = strtolower( str_replace( array( ' ', '-' ), '_', $name ) );
        $this->plural = ( !empty( $plural ) ? strtolower( str_replace( array( ' ', '-' ), '_', $plural ) ) : $this->name );
        
		add_action( 'admin_menu', array( $this, 'post_label' ) );
		add_action( 'init', array( $this, 'post_object' ) );
	}

	/**
	 * Change the name in the for the Posts labels
	 * @return [type] [description]
	 */
	public function post_label() {
	    global $menu;
	    global $submenu;
		$singular = ucwords( str_replace( '_', ' ', $this->name ) );
	    $menu[5][0] = $singular;
	    $submenu['edit.php'][5][0] = $singular;
	    $submenu['edit.php'][10][0] = 'Add ' . $singular;
	    $submenu['edit.php'][16][0] = $singular . ' Tags';
	    echo '';
	}

	/**
	 * Change the name for the Posts object
	 * @return [type] [description]
	 */
	public function post_object() {
	    global $wp_post_types;
	    $singular = ucwords( str_replace( '_', ' ', $this->name ) );
        $plural   = ucwords( str_replace( '_', ' ', $this->plural ) );
	    $labels = &$wp_post_types['post']->labels;
	    $labels->name = $singular;
	    $labels->singular_name = $singular;
	    $labels->add_new = 'Add ' . $singular;
	    $labels->add_new_item = 'Add ' . $singular;
	    $labels->edit_item = 'Edit ' . $singular;
	    $labels->new_item = $singular;
	    $labels->view_item = 'View ' . $singular;
	    $labels->search_items = 'Search ' . $plural;
	    $labels->not_found = 'No ' . $plural . ' found';
	    $labels->not_found_in_trash = 'No ' . $plural . ' found in Trash';
	    $labels->all_items = 'All ' . $plural;
	    $labels->menu_name = $plural;
	    $labels->name_admin_bar = $plural;
	}
}