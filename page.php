<?php get_header(); //requires header.php ?>
		<main class="content">

			<?php //The Loop
			if( have_posts() ){	
				while( have_posts() ){	
					the_post();
			?>

			<div <?php post_class('clearfix'); ?>>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
			<!-- end .post -->

			<?php comments_template(); ?>

			<?php 
				} //end while
			}else{ ?>

				<h2>No Posts to show</h2>

			<?php } //end of The Loop ?>
			
		</main>
		<!-- end .content -->
			
<?php get_footer();  //require footer.php ?>