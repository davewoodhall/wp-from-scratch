<?php

	/**
	 * This file adds some filters to allow to expand
	 * the defaults and help the development process.
	 */

	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
	
	if(!function_exists('jacgwd_getTemplateName')) {
		/**
		 * Adds the page template for the current post to the <body> classes.
		 *
		 * Adding the current template file to the <body>
		 * helps find the proper template file if we want to
		 * expand on it.
		 *
		 * @param
		 * @global object $post The WordPress object of the current post
		 * @return array $classes Classes to be added
		 * 
		 * @author Dave Woodhall <info@davewoodhall.com>
		 */
		function jacgwd_getTemplateName($classes) {
			global $post;
			
			/**
			 * If the current page is the page for posts
			 */
			if( is_home() ) {
				$classes[] = 'page-template-home';
			}
			
			/**
			 * If the current page is the page on fron
			 */
			else if ( is_front_page() ) {
				$classes[] = 'page-template-front-page';
			}
			
			/**
			 * If there is a unique page ID, get it's page template.
			 *
			 * The page template is saved as "page-template.php"
			 */
			else if ( get_the_ID() ) {
				$tmp =	str_replace('.php', '', get_post_meta(get_the_ID(), '_wp_page_template', true) );
				if($tmp) {
					$classes[] = $tmp;
				}
			}
			
			/**
			 * Add our classes to the array
			 */
			return $classes;
		}
	}
	add_filter('body_class', 'jacgwd_getTemplateName');
	
	if(!function_exists('jacgwd_body_classes')) {
		/**
		 * Adds some classes to the <body> element to help for debugging.
		 *
		 * @param array $classes Array (list) of classes
		 * @global boolean $is_iphone Global WordPress variable which detects if the current device is an iPhone
		 * @global boolean $is_chrome Global WordPress variable which detects if the current browser is Chrome
		 * @global boolean $is_safari Global WordPress variable which detects if the current browser is Safari
		 * @global boolean $is_IE Global WordPress variable which detects if the current browser is Internet Explorer
		 * @global boolean $is_IE$is_edgeGlobal WordPress variable which detects if the current device is Microsoft Edge
		 */
		function jacgwd_body_classes($classes){
			global $is_iphone, $is_chrome, $is_safari, $is_IE, $is_edge;
			
			/**
			 * Detects the HTTP_USER_AGENT for mobile keywords.
			 *
			 * Keywords:
			 * - Android
			 * - Silk/
			 * - Kindle
			 * - BlackBerry
			 * - Opera Mini
			 * - Opera Mobi
			 */
			if( wp_is_mobile() ) // smart phone, tablet, etc.
				$classes[] = "is-mobile";
			
			/**
			 * Add the browser name to the classes.
			 */
			if($is_iphone) {
				$classes[] = "browser-iphone";
			}
			if($is_chrome) {
				$classes[] = "browser-chrome";
			}
			if($is_safari) {
				$classes[] = "browser-safari";
			}
			if($is_IE) {
				$classes[] = "browser-ie";
			}
			if($is_edge) {
				$classes[] = "browser-edge";
			}

			return $classes;
		}
	}
	add_filter('body_class', 'jacgwd_body_classes');
	
	