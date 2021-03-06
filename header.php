<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<!-- <link rel='stylesheet'  href='<?php // echo get_stylesheet_directory_uri(); ?>/reset/modern-css-reset.css' media='all' /> -->


<!-- **************** GET HEADER********************* -->

  <?php wp_head(); ?>

<!--**************** END HEADER*********************** -->

</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
  
<!--- HEADER STARTS HERE ----->
<header>

    <?php get_search_form(); ?>

    <div class="site-title">
        <a href="<?php echo esc_url( home_url() ); ?>">
          <?php bloginfo('name'); ?>
        </a>
    </div>

    <div class="description">
        <a href="<?php echo esc_url( home_url() ); ?>">
          <?php bloginfo('description'); ?>
          <?php // This is the WP site tagline, not the meta description tag ?>
        </a>
    </div>

    <nav>
        <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'primary-nav' ) ); ?>
    </nav>

</header> 
<!--- HEADER ENDS HERE -----> 