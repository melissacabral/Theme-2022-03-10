<?php get_header(); //requires header.php ?>
		<main class="content">

			<?php //The Loop
			if( have_posts() ){	
				while( have_posts() ){	
					the_post();
			?>

			<div <?php post_class('clearfix'); ?>>
				<div class="overlay">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('large'); ?>
						<h2 class="entry-title">
								<?php the_title(); ?>
						</h2>
						<?php if( function_exists('the_field') ){ ?>
						<h3><?php the_field('sub_heading'); ?></h3>
						<?php } ?>

				<?php the_terms( $id, 'work_category', '<h4>', ', ', '</h4>' ) ?>
					</a>
				</div>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div>
			</div>
			<!-- end .post -->

			<?php 
				} //end while

			relax_pagination();

			}else{ ?>

				<h2>No Posts to show</h2>

			<?php } //end of The Loop ?>
			
		</main>
		<!-- end .content -->
			
<?php get_footer();  //require footer.php ?>