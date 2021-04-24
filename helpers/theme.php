<?php

	/**
	 * This file adds important elements to the theme.
	 */

	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
	
	/**
	 * Set the maximum allowed width for any content in the theme,
	 * like oEmbeds and images added to posts.
	 *
	 * https://codex.wordpress.org/Content_Width
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 1170; // Bootstrap 3 widths
	}
	
	if( !function_exists('jacgwd_editor_styles') ) {
		function jacgwd_editor_styles(){
			add_editor_style();
		}
	}
	add_action('admin_init', 'jacgwd_editor_styles');

	if( !function_exists('jacgwd_theme_support') ) {
		/**
		 * Registers minimal required theme support for various feature.
		 *
		 * https://developer.wordpress.org/reference/functions/add_theme_support/
		 */
		function jacgwd_theme_support(){
			/**
			 * Required
			 */
			add_theme_support( 'automatic-feed-links' ); // https://codex.wordpress.org/Automatic_Feed_Links
			add_theme_support( 'custom-header' ); // https://developer.wordpress.org/themes/functionality/custom-headers/
			add_theme_support( 'custom-background' ); // https://codex.wordpress.org/Custom_Backgrounds
			
			/**
			 * Optional, but always nice
			 */
			add_theme_support( 'editor-styles' );
			add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) ); // https://codex.wordpress.org/Theme_Markup
			add_theme_support( 'post-thumbnails' ); // https://codex.wordpress.org/Post_Thumbnails
			add_theme_support( 'title-tag' ); // https://codex.wordpress.org/Title_Tag
			
			/**
			 * Third-party support
			 */
			add_theme_support( 'woocommerce' ); // https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/#section-5
		}
	}
	add_action( 'after_theme_setup', 'jacgwd_theme_support' );
	
	if( !function_exists('jacgwd_include_scripts') ) {
		/**
		 * Conditionally includes scripts 
		 */
		function jacgwd_include_scripts() {
			/**
			 * For single posts, include the comment reply script
			 */
			if ( is_singular() ) {
				wp_enqueue_script( "comment-reply" );
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'jacgwd_include_scripts' );
	
	if( !function_exists('jacgwd_pagination') ) {
		/**
		 * Handles post pagination
		 */
		function jacgwd_pagination(){
			global $wp_query;
			
			$paged = get_query_var('paged');
			
			$largerInt = 999999999; // need an unlikely integer
			
			$pages = paginate_links(array(
				'base'      => str_replace($largerInt, '%#%', esc_url(get_pagenum_link($largerInt))),
				'format'    => '?paged=%#%',
				'current'   => max(1, $paged),
				'total'     => $wp_query->max_num_pages,
				'type'      => 'array',
				'prev_next' => true,
				'prev_text' => sprintf(
									'%s <span>%s</span>',
									// an SVG arrow pointing left
									'<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20 13v-2H8l4-4-1-2-7 7 7 7 1-2-4-4z" fill="currentColor"/></svg>',
									__('Previous', 'wp-from-scratch')
								),
				'next_text' => sprintf(
									'<span>%s</span> %s',
									__('Next', 'wp-from-scratch'),
									// an SVG arrow pointing right
									'<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="m4 13v-2h12l-4-4 1-2 7 7-7 7-1-2 4-4z" fill="currentColor"/></svg>'
								),
			));
	
			if (is_array($pages)) {
				$paged = ($paged == 0) ? 1 : $paged;
				?>				
					<nav role="navigation" aria-label="<?php _e("Pagination", 'wp-from-scratch'); ?>">
						<ul class="pagination">
							<?php foreach ($pages as $page) { ?>
									<li><?php echo $page; ?></li>
							<?php } ?>
						</ul>
					</nav>
				<?php
			}
		}
	}
	
	if( !function_exists('jacgwd_post_meta') ) {
		/**
		 * Outputs post meta (date, author, tags, etc.)
		 *
		 * Based on twentytwentyone
		 */
		function jacgwd_post_meta() {
			// Early exit if not a post.
			if ( 'post' !== get_post_type() ) {
				return;
			}
			
			echo '<div class="posted-by">';
				// Posted on.
				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

				$time_string = sprintf(
					$time_string,
					esc_attr( get_the_date( DATE_W3C ) ),
					esc_html( get_the_date() )
				);
				echo '<span class="posted-on">';
					printf(
						/* translators: %s: publish date. */
						esc_html__( 'Published %s', 'wp-from-scratch' ),
						$time_string // phpcs:ignore WordPress.Security.EscapeOutput
					);
				echo '</span>';
				
				// Posted by.
				if ( ! get_the_author_meta( 'description' ) && post_type_supports( get_post_type(), 'author' ) ) {
					echo '<span class="byline">';
						printf(
							/* translators: %s author name. */
							esc_html__( 'By %s', 'wp-from-scratch' ),
							'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . esc_html( get_the_author() ) . '</a>'
						);
					echo '</span>';
				}
				
				// Edit post link.
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post. Only visible to screen readers. */
						esc_html__( 'Edit %s', 'wp-from-scratch' ),
						'<span class="screen-reader-text">' . get_the_title() . '</span>'
					),
					'<span class="edit-link">',
					'</span>'
				);
			echo '</div>';

			if ( has_category() || has_tag() ) {

				echo '<div class="post-taxonomies">';

				/* translators: used between list items, there is a space after the comma. */
				$categories_list = get_the_category_list( __( ', ', 'wp-from-scratch' ) );
				if ( $categories_list ) {
					printf(
						/* translators: %s: list of categories. */
						'<span class="cat-links">' . esc_html__( 'Categorized as %s', 'wp-from-scratch' ) . ' </span>',
						$categories_list // phpcs:ignore WordPress.Security.EscapeOutput
					);
				}

				/* translators: used between list items, there is a space after the comma. */
				$tags_list = get_the_tag_list( '', __( ', ', 'wp-from-scratch' ) );
				if ( $tags_list ) {
					printf(
						/* translators: %s: list of tags. */
						'<span class="tags-links">' . esc_html__( 'Tagged %s', 'wp-from-scratch' ) . '</span>',
						$tags_list // phpcs:ignore WordPress.Security.EscapeOutput
					);
				}
				echo '</div>';
			}
		}
	}