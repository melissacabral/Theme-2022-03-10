<ul class="portfolio-menu">
	<?php if( is_tax() ){ ?>
	<li><a href="<?php echo get_post_type_archive_link( 'work' ); ?>">View All</a></li>
	<?php } ?>

	<?php wp_list_categories( array(
		'taxonomy' => 'work_category', //registered taxo
		'title_li' => '',
	) ); ?>
</ul>

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
				</a>
			</div>
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>
		</div>
		<!-- end .post -->

		<?php 
	} //end while

	relax_pagination();

}else{ ?>

	<h2>No Posts to show</h2>

	<?php } //end of The Loop ?>