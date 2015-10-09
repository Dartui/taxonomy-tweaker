<?php
/*
Plugin Name: Taxonomies Tweaker
Plugin URI: http://grabania.pl/taxonomy-tweaker
Description: Simply and powerful taxonomy tweaker. Allows change default taxonomy behaviour and add or edit created taxonomies.
Version: 1.0
Author: Krzysztof Grabania
Author URI: http://grabania.pl
*/

$taxonomies_tweaker = new TaxonomiesTweaker();

class TaxonomiesTweaker {
	public function __construct() {
		add_action('admin_menu', array($this, 'tt_admin_menu'));
		add_action('admin_enqueue_scripts', array($this, 'tt_scripts'));
		add_filter('wp_terms_checklist_args', array($this, 'tt_taxonomy_list_args'));
		add_action('init', array($this, 'custom_taxonomy'), 0 );
	}
	
	// Menu page
	public function tt_admin_menu() {
		add_menu_page(
			__('Taxonomies Tweaker', 'taxonomies-tweaker'),
			__('Taxonomies Tweaker', 'taxonomies-tweaker'),
			'manage_options',
			'taxonomies-tweaker',
			array($this, 'tt_options'),
			'dashicons-hammer',
			31
		);
		
		add_submenu_page(
			'taxonomies-tweaker',
			__('Add New Taxonomy', 'taxonomies-tweaker'),
			__('Add New Taxonomy', 'taxonomies-tweaker'),
			'manage_options',
			'add-taxonomy',
			array($this, 'tt_add_taxonomy')
		);
	}
	
	public function tt_options() {
		if (!empty($_POST['tt'])) {
			update_option('taxonomies_tweaker', $_POST['tt']);
		}
		$options = get_option('taxonomies_tweaker');
		require_once plugin_dir_path(__FILE__).'views/admin/option.php';
	}
	
	public function tt_add_taxonomy() {
		require_once plugin_dir_path(__FILE__).'views/admin/add_taxonomy.php';
	}
	
	public function tt_scripts() {
		$options = get_option('taxonomies_tweaker');
		if ($options['children_with_parent'])
			wp_enqueue_script('tt_script', plugins_url('/assets/admin/js/children-with-parent.js' , __FILE__ ), array('jquery'));
	}

	public function tt_taxonomy_list_args($args) {
		$options = get_option('taxonomies_tweaker');
		if ($options['disable_checked_on_top'])
			$args['checked_ontop'] = false;
		return $args;
	}
	
	function custom_taxonomy() {
	
		$labels = array(
				'name'                       => _x( 'Taxonomies', 'Taxonomy General Name', 'text_domain' ),
				'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'text_domain' ),
				'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
				'all_items'                  => __( 'All Items', 'text_domain' ),
				'parent_item'                => __( 'Parent Item', 'text_domain' ),
				'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
				'new_item_name'              => __( 'New Item Name', 'text_domain' ),
				'add_new_item'               => __( 'Add New Item', 'text_domain' ),
				'edit_item'                  => __( 'Edit Item', 'text_domain' ),
				'update_item'                => __( 'Update Item', 'text_domain' ),
				'view_item'                  => __( 'View Item', 'text_domain' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
				'popular_items'              => __( 'Popular Items', 'text_domain' ),
				'search_items'               => __( 'Search Items', 'text_domain' ),
				'not_found'                  => __( 'Not Found', 'text_domain' ),
		);
		$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
		);
		register_taxonomy( 'taxonomy', array( 'post' ), $args );
	
	}
}