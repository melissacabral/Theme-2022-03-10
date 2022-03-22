<?php
/**
 * Theme Setup
 */
add_action( 'after_setup_theme', 'relax_setup' );
function relax_setup(){
	//do all the theme setup stuff
	add_theme_support( 'title-tag' );	

	//better blog syndication
	add_theme_support('automatic-feed-links');

	//better markup on default output
	add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ));

	//add featured images to every post
	add_theme_support('post-thumbnails');

	add_theme_support('post-formats', array('gallery', 'image', 'video', 'audio', 
										'link', 'quote', 'aside', 'chat', 'status'));

	add_theme_support( 'custom-logo', array(
		'width' => 300,
		'height' => 300,
		'flex-height' => true,
	) );
	//adds custom body background
	add_theme_support( 'custom-background' );

	add_theme_support( 'custom-header' );
	//recommended by theme check
	add_theme_support( "wp-block-styles" );
	add_theme_support( "responsive-embeds" );
}

/**
 * Embed CSS for the custom header
 */
add_action('wp_head', 'relax_embed_css');
function relax_embed_css(){
	?>
	<style type="text/css">
		<?php if( has_custom_header() ){ ?>
		.header{
			background-image: url(<?php header_image() ?>);
			background-size: cover;
			background-position: center;
			color: #<?php header_textcolor(); ?>;
		}
		.header a{
			color: #<?php header_textcolor(); ?>;
		}
		<?php } ?>
	</style>
	<?php
}

/**
 * Attach any CSS or JS needed
 */
add_action( 'wp_enqueue_scripts', 'relax_scripts' );
function relax_scripts(){
	//all stylesheets and JS here
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'relax-bat-coffee-style', get_stylesheet_uri(), array(), $theme_version );
	//example scripts
	wp_enqueue_script( 'comment-reply' );
	//custom script
	$url = get_stylesheet_directory() . '/js/main.js';
	//					handle 			   url   deps        ver 		in_footer
	wp_enqueue_script( 'kittens-main-js', $url, array(), $theme_version, true );
}

/**
 * Improve excerpts
 */
add_filter( 'excerpt_length', 'relax_excerpt_length' );
function relax_excerpt_length(){
	//example of different lengths in different cases
	if( is_search() ){
		return 20;
	}else{
		return 100;
	}
}
add_filter( 'excerpt_more', 'relax_dotdotdot' );
function relax_dotdotdot(){
	return '&hellip; <a href="' . get_the_permalink() . '" class="button">Keep Reading</a>';
}

/**
 * Add support for menu areas
 */
add_action( 'init', 'relax_menus' );
function relax_menus(){
	register_nav_menus(array(
		'main_navigation' => 'Main Navigation',
		'footer_menu' => 'Footer Menu',
	));
}

add_action( 'init', 'relax_add_excerpts' );
function relax_add_excerpts() {
    add_post_type_support( 'page', 'excerpt' );
}

/**
 * Custom Pagination Function
 * put this after the loop in your templates that need pagination
 */
function relax_pagination(){
	//@TODO: Hide the empty div if pagination is not needed (tried is_paged())
		echo '<div class="pagination">';
		//check if this screen is singular or archive
		if( is_singular() ){
			//single post or page
			previous_post_link( '%link', '&larr; %title' );
			next_post_link( '%link', '%title &rarr;' );
		}elseif( wp_is_mobile() ){
			//archive on mobile - next/previous page buttons
			previous_posts_link('&larr; Previous Page');
			next_posts_link('Next Page &rarr;');
		}else{
			//archive on desktop - numbered pagination
			the_posts_pagination();
		}
		echo '</div>';
	
}


/**
 * Set up Widget Areas (Dynamic Sidebars)
 */
add_action('widgets_init', 'relax_widget_areas');
function relax_widget_areas(){
	register_sidebar( array(
		'name' 			=> 'Blog Sidebar',
		'id' 			=> 'blog_sidebar',
		'description' 	=> 'Stuff for the blog and archive pages',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
	) );
	register_sidebar( array(
		'name' 			=> 'Page Sidebar',
		'id' 			=> 'page_sidebar',
		'description' 	=> 'Stuff for the pages that have sidebars (custom template)',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
	) );
	register_sidebar( array(
		'name' 			=> 'Footer Area',
		'id' 			=> 'footer_area',
		'description' 	=> 'Appears at the bottom of every screen',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
	) );
}

/**
 * Hide pings from comment counts
 */
add_filter('get_comments_number', 'relax_comment_count');
function relax_comment_count(){
	global $id; //the post we're getting comments for
	$comments = get_approved_comments( $id );
	$count = 0;
	foreach( $comments AS $comment ){
		if( $comment->comment_type == 'comment' ){
			$count ++;
		}
	}
	return $count;
}

/**
 * Count just pings on any post
 */
function relax_pings_count(){
	global $id; //this post id
	$comments = get_approved_comments( $id );
	$count = 0;
	foreach( $comments AS $comment ){
		if( $comment->comment_type != 'comment' ){
			$count ++;
		}
	}
	return $count;
}

/**
 * Custom callback for each comment
 * this is optional - only use this if you put a 'callback' arg on wp_list_comments
 */
function relax_comment_markup($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
        <div class="comment-author vcard"><?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            } 
            printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'kittens-design-agency' ), get_comment_author_link() ); ?>
        </div><?php 
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kittens-design-agency' ); ?></em><br/><?php 
        } ?>
        <div class="comment-meta commentmetadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                /* translators: 1: date, 2: time */
                printf( 
                    __('%1$s at %2$s', 'kittens-design-agency'), 
                    get_comment_date(),  
                    get_comment_time() 
                ); ?>
            </a><?php 
            edit_comment_link( __( '(Edit)', 'kittens-design-agency' ), '  ', '' ); ?>
        </div>
 
        <?php comment_text(); ?>
 
        <div class="reply"><?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>
        </div><?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}

/**
 * Example of removing fields from the comment form
 */
add_filter('comment_form_default_fields', 'relax_comment_form');
function relax_comment_form( $fields ){
	unset( $fields['url'] );
	return $fields;
}
//no close php