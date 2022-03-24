<?php get_header(); //requires header.php ?>
		<main class="content">

			<h1 class="page-title"><?php post_type_archive_title(); ?></h1>

			<?php 
			//require content-portfolio.php
			get_template_part( 'content', 'portfolio' );  ?>
			
		</main>
		<!-- end .content -->
			
<?php get_footer();  //require footer.php ?>