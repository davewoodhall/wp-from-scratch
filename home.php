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
					the_post_thumbnail();
					
              the_content();
          endwhile;
			 
			 wp_link_pages(
				array(
					'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'wp-from-scratch' ) . '">',
					'after'    => '</nav>',
					/* translators: %: page number. */
					'pagelink' => esc_html__( 'Page %', 'wp-from-scratch' ),
				)
			);
      else :
          _e( 'Sorry, no posts matched your criteria.', 'wp-from-scratch' );
      endif;
      ?>
</main>

<aside>    
   <?php get_sidebar(); ?> 
</aside>
   


<?php get_footer(); ?>
      
  