<?php 
/**
 * Comments Template
 * display this file by calling comments_template() in your singular template files
 */
//exit this file if the password hasn't been entered yet
if( post_password_required() ){
	return;
} 
?>
<section class="comments">
	<h3><?php comments_number('No comments', 'One comment', '% Comments'); ?> 
		<?php _e( 'on this post', 'kittens-design-agency') ?>

		<a href="#respond" class="button">Leave a Comment</a>
	</h3>

	<ol class="comments-list">
		<?php wp_list_comments( array(
			'type' => 'comment', //hide pingbacks and trackbacks
			'avatar_size'	=> 60,
			//'callback'		=> 'relax_comment_markup',
		) ); ?>
	</ol>
</section>

<?php if( get_option( 'page_comments' ) ){ ?>
<section class="pagination comment-pagination">
	<?php 
	previous_comments_link();
	next_comments_link();
	?>
</section>
<?php } //end if paged comments ?>

<section class="comment-form">
	<?php comment_form(); ?>
</section>

<?php 
$pings_count = relax_pings_count();
if( $pings_count ){
?>
<section class="mentions">
	<h3>
	<?php echo $pings_count == 1 ? 'One site mentions ' : "$pings_count Sites mention "  ?> this post
	</h3>
	<ol class="pings-list">
		<?php wp_list_comments(array(
			'type' 			=> 'pings', //both trackbacks and pingbacks
			'short_ping' 	=> true,
		)); ?>
	</ol>
</section>
<?php }//end if there are pings ?>