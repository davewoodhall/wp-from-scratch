<?php

	/**
	 * This file handles the theme's translation support.
	 */

	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.

	if(!function_exists('jacgwd_i18n')) {
		/**
		 * Add support for translation.
		 *
		 * @see https://developer.wordpress.org/reference/functions/load_theme_textdomain/
		 */
		function jacgwd_i18n(){
			/**
			 * load_theme_textdomain uses 2 parameters :
			 * 		1. The text domain (same as style.css header comments)
			 * 		2. Path to the translation folder
			 */
			load_theme_textdomain( 'wp-from-scratch', get_template_directory() . '/languages' );
			
			/*
			 * Creating the translations :
			 * 		1. Download Poedit (available for Windows, Mac and Linux)
			 * 		   https://poedit.net/download
			 * 		2. Open Poedit.
			 * 		3. In the "File" menu, select "New".
			 * 		4. Select the language that you used in your theme (probably English).
			 * 		5. In the "Catalog" menu, select "Properties".
			 * 		6. Enter the project information in the "Translation properties" tab.
			 * 		7. Go to the 3rd tab, "Sources keywords".
			 * 		8. Click on the "New item" button (2nd button) and enter a kewyord
			 * 		   and repeat this for each of your keywords.
			 * 		   Most common:
			 * 		   		__ (double underscore)
			 * 		   		_e
			 * 		   		esc_attr_e
			 * 		9. Click on the "OK" button at the bottom.
			 * 		10. In the "File" menu, select "Save As".
			 * 		11. Save the file as "yourthemename.pot" (use the same name as the text domain above)
			 * 		    in the "languages" folder in your theme directory (make sure you add the .pot extension
			 * 		    to the filename because by default it will save as .po).
			 * 		12. In the "Catalog" menu, select "Properties" again.
			 * 		13. Go to the 2nd tab "Sources paths".
			 * 		14. Set the value for "Base path" to "../" (the .pot file is saved in a subdirectory)
			 * 		    so this way you set the base to the parent directory, ie. your theme.
			 * 		15. Next to "Path", click on the "New item" button and enter ".".
			 * 		    This will make it scan your theme directory and its subdirectories.
			 * 		16. Click the "OK" at the bottom.
			 * 		17. In the project window, click on "Update" (2nd icon at the top).
			 * 		18. In the "File" menu, click "Save".
			 * 		19. Repeat for each language you wish you use.
			 */
		}
	}
	add_action('after_setup_theme', 'jacgwd_i18n');
	