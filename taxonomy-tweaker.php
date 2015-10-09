<?php
/*
Plugin Name: Taxonomy Tweaker
Plugin URI: http://grabania.pl/taxonomy-tweaker
Description: Simply and powerful taxonomy tweaker. Allows change default taxonomy behaviour and add or edit created taxonomies.
Version: 1.0
Author: Krzysztof Grabania
Author URI: http://grabania.pl
*/

$taxonomies_tweaker = new TaxonomyTweaker();

class Taxonomyweaker {
	public function __construct() {
		add_action('admin_menu', array($this, 'tt_admin_menu'));
		add_action('admin_enqueue_scripts', array($this, 'tt_scripts'));
		add_filter('wp_terms_checklist_args', array($this, 'tt_taxonomy_list_args'));
	}
	
	// Menu page
	public function tt_admin_menu() {
		add_menu_page(
				__('Taxonomies Tweaker', 'taxonomy-tweaker'),
				__('Taxonomies Tweaker', 'taxonomy-tweaker'),
				'manage_options',
				'taxonomy-tweaker',
				array($this, 'tt_options'),
				'dashicons-hammer',
				31
		);
		
		add_submenu_page(
				'taxonomy-tweaker',
				__('Add New Taxonomy', 'taxonomy-tweaker'),
				__('Add New Taxonomy', 'taxonomy-tweaker'),
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
}