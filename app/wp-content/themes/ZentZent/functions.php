<?php 

// We need a way to enable use of session globally
add_action('init', 'myStartSession', 1);
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}


// Sometimes it is mandatory to have a special version of jQuery. This should be avoided. And allowed only outside admin panel.
function deregisterJQuery() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ( get_template_directory_uri() . "/js/jquery-2.2.4.min.js"), false, '2.2.4');
    wp_enqueue_script('jquery');
}
if (!is_admin()) {
    add_action('wp_enqueue_scripts', 'deregisterJQuery');
}



function custom_styles() {
    // Register the style first so that WP knows what we are working with:
    wp_register_style( 'core-css', get_template_directory_uri() . '/css/style.css' );
    wp_register_style( 'print-css', get_template_directory_uri() . '/css/print.css' );
 
    // Then we need to enqueue them one by one to the theme:
    wp_enqueue_style( 'core-css' );
    wp_enqueue_style( 'print-css' );
}
add_action( 'wp_enqueue_scripts', 'custom_styles' );

function custom_scripts() {
    // Register the scripts first so that WP knows what we are working with:
    // Parameters: Slug, url, dependencies, version, in_footer
    wp_register_script( 'footnote', get_template_directory_uri() . '/js/footnote.js', ['jquery'], '1.0', true );
    wp_register_script( 'delegate', get_template_directory_uri() . '/js/delegate.js', ['jquery'], '1.0', true );
    wp_register_script( 'mobile_menu', get_template_directory_uri() . '/js/mobile-menu.js', ['jquery'], '1.0', true );
	wp_register_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv-printshiv.min.js', ['jquery'], '3.7.3', true );
	wp_register_script( 'elipsis', get_template_directory_uri() . '/js/elipsis.js', ['jquery'], '1.0', true );

    // Then we need to enqueue them one by one to the theme:
    wp_enqueue_script( 'footnote' );
    wp_enqueue_script( 'delegate' );
    wp_enqueue_script( 'mobile_menu' );
	wp_enqueue_script( 'html5shiv' );
	wp_enqueue_script( 'elipsis' );
}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );

// This function is used to register navigation positions within the theme.
// Usage: https://codex.wordpress.org/Function_Reference/register_nav_menus

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' ),
      'lang-menu' => __( 'Language Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


// We can add predefined image sizes that wordpress will automatically create while uploading.
// Usage: https://developer.wordpress.org/reference/functions/add_image_size/

add_image_size( 'Big_hero', 730, 730, false ); // Big hero slika u vrhu svakog posta
add_image_size( 'sidebar_thumb2x', 150, 150, true ); 
add_image_size( 'sidebar_thumb', 74, 74, true ); 
add_image_size( 'casopis', 200, 270, true ); 
add_image_size( 'casopis2x', 400, 540, true ); 

// There are a few unneeded tags within our <head>. It looks messy. We can disable/unmount them here/

remove_action('wp_head', 'rsd_link'); // Weblog client legacy support (editing via custom-made Apps)
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer Manifest
remove_action('wp_head', 'wp_generator'); // Built-in Meta generator (if we want to use custom meta tags)

// Gets and echoes the properly formatted srcset value od image
function the_srcset($slika, $slug) {
    $slika = $slika['sizes'];
    $slugW = $slug . '-width';
    echo $slika[$slug] . ' ' . $slika[$slugW] . 'w, ';
}



// Shortcode for fusnotes
function fusnotaHandler( $atts, $content = null ) {
    return '<span class="footnote jailed"><span class="footnote-number">*</span><span class="footnote-body">'.$content.'</span></span>';
}

add_shortcode( 'fusnota', 'fusnotaHandler' );


// Disable galleries support
add_action( 'admin_head_media_upload_gallery_form', 'mfields_remove_gallery_setting_div' );
if( !function_exists( 'mfields_remove_gallery_setting_div' ) ) {
   function mfields_remove_gallery_setting_div() {
        print '
        <style type="text/css">
     #gallery-settings *{
           display:none;
       }
    </style>';
    }
}



function filter_ptags_on_images($content){
 return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

function override_mce_options($initArray) {
  $opts = '*[*]';
  $initArray['valid_elements'] = $opts;
  $initArray['extended_valid_elements'] = $opts;
  return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options'); 





// Localization Support
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('zentzent', get_template_directory() . '/languages');
}





// OPEN GRAPH
add_action('wp_head', 'fb_opengraph_meta');
function fb_opengraph_meta() {
  global $post;
  if (is_single()) {
    $image = get_field('hero_slika')['url'];
  } else {
    $image = 'http://www.zentmagazine.com/wp-content/uploads/2016/06/zent.jpg';
  }

  $description = my_excerpt( $post->post_content, $post->post_excerpt );
  $description = strip_tags($description);
  $description = str_replace("\"", "'", $description);

  $output = '<meta property="og:title" content="'.get_the_title().'" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="'.$image.'" />
  <meta property="og:url" content="'.get_the_permalink().'" />
  <meta property="og:description" content="'.$description.'" />
  <meta property="og:site_name" content="'.get_bloginfo('name').'" />';

echo $output;

}

// Clean up HTML from string to get an excerpt
function excerpt($text, $length = 256) {
	$text = wp_strip_all_tags($text);
	$text = trim(preg_replace('/\s+/', ' ', $text)); // Remove new lines
	$text = substr($text, 0, $length);
	return $text;
}

function my_excerpt($text, $excerpt){
 if ($excerpt) return $excerpt;
 $text = strip_shortcodes( $text );
 $text = apply_filters('the_content', $text);
 $text = str_replace(']]>', ']]&gt;', $text);
 $text = strip_tags($text);
 $excerpt_length = apply_filters('excerpt_length', 60);
 $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
 $words = preg_split("/[\n]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
 if ( count($words) > $excerpt_length ) {
   array_pop($words);
   $text = implode(' ', $words);
   $text = $text . $excerpt_more;
 } else {
   $text = implode(' ', $words);
 }
 return apply_filters('wp_trim_excerpt', $text, $excerpt);
}




?>
