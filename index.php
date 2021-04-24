<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
      
/* Template Name: Main template */ 
/* The template for displaying single posts and pages. */
/* @link https://developer.wordpress.org/themes/basics/template-hierarchy/  */
?> 

<?php get_header(); ?>


<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?> <?php // put inside main somewhere if you dont like it ?>

<main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php 
         if ( have_posts() ) : 
          while ( have_posts() ) : the_post();
              the_content();
          endwhile;
      else :
          _e( 'Sorry, no posts matched your criteria.', 'wp-from-scratch' );
      endif;
      ?>
</main>

<aside>    
   <?php get_sidebar(); ?> 
</aside>
   


<?php get_footer(); ?>
      
  