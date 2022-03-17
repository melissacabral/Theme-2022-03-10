<!DOCTYPE html>
<html lang="en-us">
<head>
  <?php wp_head(); //HOOK. required for the admin bar and plugins to work ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body <?php body_class() ?>>
	<div class="site">
		<header class="header header-first">
			<div class="branding">			
				<h1 class="site-title">
					<a href="<?php echo home_url(); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<h2><?php bloginfo( 'description' ); ?></h2>
			</div>
			<div class="navigation">
				<?php 
				//display one registered menu area
				wp_nav_menu( array(
					'theme_location' 	=> 'main_navigation', //registered in functions.php
					'container'				=> 'nav', //div or nav or false
					'container_class' => 'main-navigation', // <nav class="main-navigation">
					'fallback_cb' 		=> false,
				) ); ?>
			</div>
			<div class="utilities">
				<!-- Utility menu will go here -->
			</div>
			<?php get_search_form(); ?>

			
		</header>