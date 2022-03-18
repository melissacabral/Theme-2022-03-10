<aside class="sidebar">
	<?php 
	//if there are widgets, show them. if not, do our fallback stuff
	if( ! dynamic_sidebar( 'blog_sidebar' ) ){ ?>
		<section id="categories" class="widget">
			<h3 class="widget-title"> <?php _e( 'Categories', 'kittens-design-agency' ); ?> </h3>
			<ul>
				<?php 
				wp_list_categories( array(
					'title_li' 		=> '',
					'show_count' 	=> true,
				) ); 
				?>
			</ul>
		</section>
		<section id="archives" class="widget">
			<h3 class="widget-title"> <?php _e('Archives', 'kittens-design-agency'); ?> </h3>
			<ul>
				<?php wp_get_archives( array(
					'type' => 'monthly',
				) ); ?>
			</ul>
		</section>
		<section id="tags" class="widget">
			<h3 class="widget-title"> <?php _e( 'Tags', 'kittens-design-agency' ); ?> </h3>

			<?php wp_tag_cloud( array(
				'format' => 'list', //default flat
				'largest' => 1,
				'smallest'	=> 1,
				'unit' => 'em',
			) ); ?>
		</section>
		<section id="meta" class="widget">
			<h3 class="widget-title"> <?php _e( 'Meta', 'kittens-design-agency' ); ?> </h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
			</ul>
		</section>
	<?php } //end if no widgets?>
</aside>
<!-- end .sidebar -->