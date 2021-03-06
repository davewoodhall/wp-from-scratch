<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
      
/* Template Name: Highres Template */ 
/* The template for displaying single posts and pages. */
/* @link https://developer.wordpress.org/themes/basics/template-hierarchy/  */
?>


<?php get_header('highres'); ?>


<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

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
      
        <?php if (is_page_template('highres.php')){ eg_CAnav(false); } ?>

</main>



<aside>    
   <?php get_sidebar(); ?> 
</aside>
   


<?php get_footer(); ?>
      
  