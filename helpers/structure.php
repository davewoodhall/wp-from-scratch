<?php

	/**
	 * This file adds important elements to the theme.
	 */

	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.

	if( !function_exists('jacgwd_create_sidebars') ) {
		/**
		 * Create a sidebar area.
		 *
		 * This allows to call the "primary_sidebar" sidebar in sidebar.php
		 */
		function jacgwd_create_sidebars(){
			/**
			 * Repeat this for any number of
			 * dynamic areas you wish to add.
			 */
			register_sidebar( array(
				'name' => __( 'Main Sidebar', 'wp-from-scratch' ), // Used in theme
				'id' => 'primary_sidebar',
				'description' => __( 'The content for the main sidebar.', 'wp-from-scratch' ),
				'before_widget' => '', 
				'after_widget' => '',
				'before_title' => '',
				'after_title' => '', 
			) );
		}
	}
	add_action( 'widgets_init', 'jacgwd_create_sidebars' );
	
	