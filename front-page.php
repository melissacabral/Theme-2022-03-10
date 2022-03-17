<?php get_header('first'); //requires header-first.php ?>
		<main class="content">
			<?php //The Loop
			if( have_posts() ){	
				while( have_posts() ){	
					the_post();
			?>
				<div <?php post_class(); ?>>
					<?php the_content(); ?>
				</div>
			<?php
				} //end while
			}else{ 
			?>

				<h2>No Posts to show</h2>

			<?php } //end of The Loop ?>
			
		</main>
		<!-- end .content -->
	
<?php get_footer();  //require footer.php ?>