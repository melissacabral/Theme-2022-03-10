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

	//adds custom body background
	add_theme_support( 'custom-background' );

	add_theme_support( 'custom-header' );

	add_theme_support( 'custom-logo', array(
		'width' => 300,
		'height' => 300,
		'flex-height' => true,
	) );
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


//no close php