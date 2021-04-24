<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
      
/* Template Name: Thumbnails Template */ 
/* The template for displaying single posts and pages. */
/* @link https://developer.wordpress.org/themes/basics/template-hierarchy/  */
?>


<?php get_header('thumbs'); ?>


<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

<main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php 
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					the_content();
				}
				
				if( function_exists('jacgwd_post_meta') ) {
					jacgwd_post_meta();
				}
			
				// Is the post split in multiple pages ?
				if( function_exists('jacgwd_pagination') ) {
					jacgwd_pagination();
				}
			}
			else {
				_e( 'Sorry, no posts matched your criteria.', 'wp-from-scratch' );
			}
			
			comments_template();
		
      ?>
      


</main>



<aside>    
   <?php get_sidebar(); ?> 
</aside>
   


<?php get_footer(); ?>
      
  
