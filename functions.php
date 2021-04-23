<?php
/*
 * Proper way to enqueue scripts and styles.
 */
function mycustomtheme_scripts() {
    wp_enqueue_style( 'style-name', get_stylesheet_uri() );

    /*
    If you have javascripts, uncomment the line below (remove the //)
    */

    // wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/combined-scripts.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'mycustomtheme_scripts' );

/*
  // ADD THE MENU SYSTEM
  */
  function register_my_menus() {
      register_nav_menus(
        array(
          'header-menu' => __( 'Header Menu' ),
          'footer-menu' => __( 'Footer Menu' ),
          'social-menu' => __( 'Social Menu' ),
        )
      );
    }
  add_action( 'init', 'register_my_menus' ); 

  /*
// ADD ADDITIONAL FEATURES TO THE SITE
*/

// ADD FEATURES TO THE THEME
function mycustomtheme_init(){

    add_theme_support('post-thumbnails');
    // Enable featured images and post thumbnails
    
    add_theme_support('title-tag');
    // Adds a custom <title> tag in the <head>
    
    add_theme_support('html5',
    array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'figure', 'figcaption', 'nav', 'section')
    // Forces WP to use semantic HTML 5 tags such as <figure> and <figcaption>
    );
    }
    
    // ADDS THESE FEATURES TO WP
    add_action('after_setup_theme', 'mycustomtheme_init'); 

    // Add this code inside the PHP tags of the functions.php file in your theme.


// Adds the previous/next pagination navigation list

if (!function_exists('eg_CAnav')){
// Make sure that function name does not already exist

    function eg_CAnav($loop=false){ // Set the looping from last item next to first and from first item back to last. Default is false (no wrapping around the end).
    // Define the function

        global $post; // The currently loaded page
        $pagelist = get_pages("child_of=".$post->post_parent."&parent=".$post->post_parent."&sort_column=title&sort_order=asc");
        if (empty ($pagelist)) {
        return; } // If empty stop here

        $pages = array();
        foreach ($pagelist as $page) {
            $pages[] += $page->ID; // Fetch only the IDs of the pages, not all other data
        }

        $current = array_search($post->ID, $pages); // Get index of results, starting at zero (not one)
        if ($loop) { // If you want pagination to go from Last to First and vice-versa, this part applies
            $first=$pages[0];
            $count=count($pages);
            $last = $count - 1;
            $prevID = ($current==0)?$pages[$last]:$pages[$current-1];
            // Previous ID is either Last Page or Current Page -1
            $nextID = ($current==$last)?$first:$pages[$current+1];
            // Next ID is either First Page or Current Page +1
        } 
        
        else { // If you disable the looping navigation
            $prevID = ($current==0)?false:$pages[$current-1];
            $count=count($pages);
            $last = $count - 1;
            $nextID = ($current==$last)?false:$pages[$current+1];
        }
        ?>
            <ul class="pagination">
                <?php if (!empty ($prevID)) { ?>
                <li class="previous-page">
                <a href="<?php echo get_permalink($prevID); ?>" title="<?php echo get_the_title($prevID); ?>"><?php echo get_the_title($prevID); ?></a>
                </li>
                <?php } ?>

                <li class="up-to-CA-gallery"><a class="page-link" href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a></li>  
                
                <?php
                if (!empty($nextID)) { ?>
                <li class="next-page">
                <a href="<?php echo get_permalink($nextID); ?>" title="<?php echo get_the_title($nextID); ?>"><?php echo get_the_title($nextID); ?></a>
                </li>
                
                <?php } ?>
            </ul>
        <?php
    }
}
