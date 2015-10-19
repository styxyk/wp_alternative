<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'news', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'news' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'News Pro Theme', 'news' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/news/' );
define( 'CHILD_THEME_VERSION', '3.0.2' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'news_load_scripts' );
function news_load_scripts() { 
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Raleway:400,700|Pathway+Gothic+One|Lora|Oswald:400,300,700|Lato:300,400,700,900,400italic|Open+Sans+Condensed:300,300italic,700', array(), CHILD_THEME_VERSION );	
     if ( is_single() ) {	
    wp_enqueue_style( 'dashicons' );    
	}     
}


/** Load jQuery and jQuery-ui script  just before closing Body tag */
add_action('genesis_after_footer', 'newspro_script_add_body');
function newspro_script_add_body() {
	 wp_enqueue_script( 'news-responsive-menu',  get_stylesheet_directory_uri() .'/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );	  
	//  wp_enqueue_script( 'twitter', get_stylesheet_directory_uri() . '/js/twitter.js', array( 'jquery' ) );   
          wp_enqueue_script( 'jquery', get_stylesheet_directory_uri() . '/js/jquery.js', array( 'jquery' ), '', true );      

}

//* Add new image sizes
add_image_size( 'home-bottom', 200, 200, TRUE );
add_image_size( 'home-custom-thumb', 262, 175, TRUE);
add_image_size( 'home-custom-thumb-middle', 330, 220, TRUE );
add_image_size( 'home-middle', 348, 180, TRUE );
add_image_size( 'home-top', 740, 400, TRUE );
add_image_size( 'home-slider', 640, 359, TRUE );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'header_image'    => '',
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'height'          => 90,
	'width'           => 260,
) );

//* Add support for additional color style options
add_theme_support( 'genesis-style-selector', array(
	'news-pro-blue'   => __( 'News Pro Blue', 'news' ),
	'news-pro-green'  => __( 'News Pro Green', 'news' ),
	'news-pro-pink'   => __( 'News Pro Pink', 'news' ),
	'news-pro-orange' => __( 'News Pro Orange', 'news' ),
) );

//* Add support for 6-column footer widgets
add_theme_support( 'genesis-footer-widgets', 6 );

//* Reposition the secondary navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );

//* Hook after entry widget after the entry content
add_action( 'genesis_after_entry', 'news_after_entry', 5 );
function news_after_entry() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry" class="widget-area">',
			'after'  => '</div>',
		) );

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'news_remove_comment_form_allowed_tags' );
function news_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'news' ),
	'description' => __( 'This is the top section of the homepage.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle-left',
	'name'        => __( 'Home - Middle Left', 'news' ),
	'description' => __( 'This is the middle left section of the homepage.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle-right',
	'name'        => __( 'Home - Middle Right', 'news' ),
	'description' => __( 'This is the middle right section of the homepage.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Home - Bottom', 'news' ),
	'description' => __( 'This is the bottom section of the homepage.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-entry',
	'name'        => __( 'After Entry', 'news' ),
	'description' => __( 'This is the after entry section.', 'news' ),
) );

add_action('genesis_before_header',  'gt_toolbar_wrap_open'); 
function gt_toolbar_wrap_open() {
     echo '<div id="toolbar">';
     echo '<div id="toolbar-left">';
     echo '<p>Your Daily Source for Alternative Health News & Tips</p>';
     echo '</div>';
	 echo '<div id="toolbar-right">';
	 echo '<ul>';
	 echo '<li><a href="/">Home</a></li>';
	 echo '<li><a href="/contact/">Contact Us</a></li>';
	 echo '<li><a href="/write-for-us/">Write For Us</a></li>';
	 echo '<li><a href="/about/">About</a></li>';
	 echo '</ul>';
	 echo '<div id="search">';
	 echo '<form role="search" method="get" id="searchform" action="' . get_bloginfo("home") . '">';
	 echo '<input type="text" value="" placeholder="" name="s" id="s" />';
	 echo '<input type="submit" id="searchsubmit" value="Search" />';
	 echo '</form>';
	 echo '</div>';
	 echo '</div>';
         echo '<div class="clear"></div>';
         echo '</div>';
}


add_action('genesis_header_right',  'header_right_subscribe'); 
function header_right_subscribe() { 

echo '<div class="textwidget">';
echo '<div style="float:right" id="newsletter1"> ';
echo '<div id="newsletter-left"> ';
echo '<h2>Get Health Alerts</h2>'; 
echo '<ul> ';
echo '<li>Latest Alternative Health News</li> ';
echo '<li>19 Cleansing Superfoods eBook</li>'; 
echo '</ul>'; 
echo '</div> ';
echo '<div id="newsletter-right"> ';
echo '<h3>Sign up!</h3> ';
echo '<form action="http://app.maropost.com/accounts/75/forms/64/subscribe/8fd30334398dfa327ada7bd4e0a97c42580beb44" enctype="multipart/form-data" method="post">'; 
echo '<input type="email" aria-required="true" class="fsField fsFormatEmail fsRequired" value="" placeholder="email address" required="required" size="30" name="contact_fields[email]"> ';
echo '<div class="fsSubmit fsPagination" id="fsSubmit1404681"> ';
echo '<input type="image" value="Subscribe" style="display:block" src="/wp-content/themes/altdaily/images/button-go.gif?5f8d77" class="fsSubmitButton" id="mc-embedded-subscribe"> ';
echo '<div class="clear"></div> ';
echo '</div> ';
echo '</form> ';
echo '</div>'; 
echo '</div>';
echo '</div>';
	 
}


add_filter( 'excerpt_length', 'search_page_content_limit' );
function search_page_content_limit( $length ) {
if ( is_search() ):
return 200;
endif;
}
add_filter( 'get_the_content_more_link', 'search_page_read_more_link' );
function search_page_read_more_link() {
if ( is_search() ):
return '... <a class="more-link" href="' . get_permalink() . '">Continue reading </a>';
else:
return '... <a class="more-link2" href="' . get_permalink() . '">Keep Reading <span class="meta-nav"> → </span></a>';
endif;
}
function limit_search_results( $query ) {
if ( $query->is_search() && $query->is_main_query() ) {
$query->set( 'posts_per_page', '10' );
}
}
add_action( 'pre_get_posts', 'limit_search_results' ); 

// Use shortcodes in text widgets.
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

add_shortcode('post_share', 'post_share_shortcode');
function post_share_shortcode() {
if ( is_single() ) { ?> 
<div class="social-sharer">
<!-- Article Views Counter -->
<div class="share-views"><div class="share-text"><div class="dashicons dashicons-views"><img class="yuzo-views-icon" src="/wp-content/themes/news-pro/images/share-views.png" alt="views"></div><div class="longtext"> Views </div><?php echo do_shortcode( '[yuzo_views]' );?></div></div>
<!-- Facebook Like -->
<div class="facebook-button">
<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></div>
<!-- Twitter Share -->
<a style='text-decoration:none;' type="icon_link" onClick="window.open('http://twitter.com/home?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)"><div class="share-twitter">
<div class="share-text-twitter"><img class="tweet-icon" src="/wp-content/themes/news-pro/images/tweeter.png" alt="tweet"><div class="longtext"> Tweet</div> 
<?php echo twitter_get_tweets(get_permalink()); ?></div></div></a>
<!-- Google Plus Share -->
<a style='text-decoration:none;' type="icon_link" onClick="window.open('https://plus.google.com/share?url=<?php print(urlencode(get_permalink())); ?>','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)"><div class="share-google"><div class="share-text-google"><img class="gplus-icon" src="/wp-content/themes/news-pro/images/gplus.png" alt="gplus"><div class="longtext-google"> Share </div><?php echo google_get_plusones(get_permalink()); ?></div></div></a>
<!-- Pinterest Share -->
<a style='text-decoration:none;' type="icon_link" onClick="window.open('//www.pinterest.com/pin/create/button/?url=<?php print(urlencode(get_permalink())); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );$url = $thumb['0']; echo $url; ?>&description=<?php print(urlencode(the_title())); ?>','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)"><div class="share-pinterest"><div class="share-text"><div class="dashicons dashicons-pinterest"><div class="entry-socials"><img class="pin-icon" src="/wp-content/themes/news-pro/images/pinterest.png" alt="pinit"></div></div><div class="longtext"> Pin it</div> <?php echo pinterest_get_pins(get_permalink()); ?></div></div></a>
</div>
<?php }
}

add_shortcode('post_share2', 'post_share_shortcode2');
function post_share_shortcode2() {

$memcache_obj = new Memcache;
$memcache_obj->connect('localhost', 11211) or die ("Could not connect to Memcached server!");

$cacheTime = 60*60*12; // 12 hours

$pinterest_pins_count = $memcache_obj->get( 'pinterest_pins_count' );
if ( false === $pinterest_pins_count ) {
    $pinterest_pins_count = pinterest_get_pins(get_permalink());
    $memcache_obj->set( 'pinterest_pins_count', $pinterest_pins_count , 0, $cacheTime );
}

$twitter_tweets_count = $memcache_obj->get( '$twitter_tweets_count' );
if ( false === $twitter_tweets_count ) {
    $twitter_tweets_count = twitter_get_tweets(get_permalink());
    $memcache_obj->set( '$twitter_tweets_count', $twitter_tweets_count , 0, $cacheTime );
}

$google_plus_likes = $memcache_obj->get( 'google_plus_likes' );
if ( false === $google_plus_likes ) {
    $google_plus_likes = google_get_plusones(get_permalink());
    $memcache_obj->set( 'google_plus_likes', $google_plus_likes , 0, $cacheTime ); 
}

if ( is_single() ) { ?> 
<div class="social-sharer-bottom">
<!-- Article Views Counter -->
<div class="share-views"><div class="share-text"><div class="dashicons dashicons-views"><img class="yuzo-views-icon" src="/wp-content/themes/news-pro/images/share-views.png" alt="views"></div><div class="longtext"> Views </div><?php echo do_shortcode( '[yuzo_views]' );?></div></div>
<!-- Facebook Like -->
<div class="facebook-button">
<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></div>
<!-- Twitter Share -->
<a style='text-decoration:none;' type="icon_link" onClick="window.open('http://twitter.com/home?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)"><div class="share-twitter">
<div class="share-text-twitter"><img class="tweet-icon" src="/wp-content/themes/news-pro/images/tweeter.png" alt="tweet"><div class="longtext"> Tweet</div> 
<?php echo $twitter_tweets_count; ?></div></div></a>
<!-- Google Plus Share -->
<a style='text-decoration:none;' type="icon_link" onClick="window.open('https://plus.google.com/share?url=<?php print(urlencode(get_permalink())); ?>','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)"><div class="share-google"><div class="share-text-google"><img class="gplus-icon" src="/wp-content/themes/news-pro/images/gplus.png" alt="gplus"><div class="longtext-google"> Share </div><?php echo $google_plus_likes; ?></div></div></a>
<!-- Pinterest Share -->
<a style='text-decoration:none;' type="icon_link" onClick="window.open('//www.pinterest.com/pin/create/button/?url=<?php print(urlencode(get_permalink())); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );$url = $thumb['0']; echo $url; ?>&description=<?php print(urlencode(the_title())); ?>','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)"><div class="share-pinterest"><div class="share-text"><div class="dashicons dashicons-pinterest"><div class="entry-socials"><img class="pin-icon" src="/wp-content/themes/news-pro/images/pinterest.png" alt="pinit"></div></div><div class="longtext"> Pin it</div> <?php echo $pinterest_pins_count; ?></div></div></a>
</div>
<?php }
}

add_action('genesis_entry_content', 'post_share_shortcode_bottom');
function post_share_shortcode_bottom() {
// Conditinal Tag
// Display on single posts only
if ( is_single() ) { 
echo do_shortcode( '[post_share2]' );
 }
}

add_action('genesis_entry_content',  'post_share2_open_wrap'); 
function post_share2_open_wrap() { 
   if ( is_archive() || is_search() ) {
  echo '<script type="text/javascript"> $(".social-sharer-bottom" ).insertBefore($(".entry-footer"));</script>';
  echo '<div class="clear" style="clear:both;">&nbsp;</div>';
  echo do_shortcode('[post_share2]'); 

  }
}

function child_social_media_scripts() { ?>
<div id="fb-root"></div>
<script> (function(d, s, id){ var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk')); </script>
<?php } 

function twitter_get_tweets($url) {     
  $json_string = file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
  $json = json_decode($json_string, true);
  return intval( $json['count'] );
}


function google_get_plusones($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
  $curl_results = curl_exec ($curl);
  curl_close ($curl);
  $json = json_decode($curl_results, true);
  return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
}

function pinterest_get_pins($url){
$pincount = json_decode(preg_replace('/^receiveCount\((.*)\)$/', "\\1",file_get_contents('http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url='.$url)));
return $pincount->count;
}

function php_execute($html){
if(strpos($html,"<"."?php")!==false){ ob_start(); eval("?".">".$html);
$html=ob_get_contents();
ob_end_clean();
}
return $html;
}
add_filter('widget_text','php_execute',100);

//* Customize search form input button text
add_filter( 'genesis_search_button_text', 'modify_search_button_text' );
function modify_search_button_text( $text ) {
return esc_attr( 'Search' );
} 

add_filter( 'genesis_search_text', 'modify_search_text' );
function modify_search_text( $text ) {
return esc_attr( '' );
} 

function be_archive_featured_image_only( $output, $args, $post ) {
if( 'archive' == $args['context'] && !has_post_thumbnail( $post->ID ) )
$output = '';
return $output;
}
add_filter( 'genesis_pre_get_image', 'be_archive_featured_image_only', 10, 3 ); 

/*Change attachment page image size*/
add_filter('prepend_attachment', 'ag_prepend_attachment');
function ag_prepend_attachment($p) {
return '<p>'.wp_get_attachment_link(0, 'full', false).'</p>';
}

/*Attachment ID on Images**/
function be_attachment_id_on_images( $attr, $attachment ) {
if( !strpos( $attr['class'], 'wp-image-' . $attachment->ID ) )
$attr['class'] .= ' wp-image-' . $attachment->ID;
return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'be_attachment_id_on_images', 10, 2 ); 

remove_action('wp_head', 'genesis_load_favicon');

//* Register widget areas Google Ads home 
genesis_register_sidebar( array(
	'id' => 'google_ads',
	'name' => __( 'Google Ads Home Top Section', 'news' ),
	'description' => __( 'This is the Google Ads Home Top Section widget.', 'news' ),
) );

/** Add the Google ads section */
add_action( 'genesis_before_content_sidebar_wrap', 'widget_genesis_google_ads' );
function widget_genesis_google_ads() {
if ( is_home() && is_active_sidebar( 'google_ads' )  ) {
genesis_widget_area( 'google_ads', array(
'before' => '<div class="google_ads widget-area">',
'after' => '</div>',
) );
}
}



//* Register widget areas ticker text
genesis_register_sidebar( array(
	'id' => 'news_ticker',
	'name' => __( 'News Ticker Text', 'news' ),
	'description' => __( 'This is the News Ticker Text widget.', 'news' ),
) );

/** Add the ticker text section */
add_action( 'genesis_after_header', 'widget_genesis_after_header' );
function widget_genesis_after_header() {
if ( is_home() && is_active_sidebar( 'news_ticker' ) ) {
genesis_widget_area( 'news_ticker', array(
'before' => '<div class="news_ticker widget-area">',
'after' => '</div>',
) );
}
}

//* Register widget areas Home Slider text
genesis_register_sidebar( array(
'id' => 'home-slider',
'name' => __( 'Home Slider', 'news' ),
'description' => __( 'This is the slider widget area for your homepage.', 'news' ),
) );

add_action( 'genesis_before_content_sidebar_wrap', 'widget_before_content_sidebar_wrap');
function widget_before_content_sidebar_wrap() {
if ( is_paged() ) {
        unregister_sidebar( 'home-slider' );                
  }
if ( is_home() && is_active_sidebar( 'home-slider' ) ) {
genesis_widget_area( 'home-slider', array(
'before' => '<div class="home-slider" class="widget-area">',
'after' => '</div>',
) );
}
}

//Add in New Home Widget Areas

genesis_register_sidebar( array(
	'id' => 'custom-widget-top',
	'name' => __( 'Custom Widget Top', 'genesis' ),
	'description' => __( 'CW Top Area', 'news' ),
    'before_title'  => '<div id="latest-reports"><h4 class="custom-title">',        
) );
genesis_register_sidebar( array(
	'id' => 'custom-widget-bottom-top',
	'name' => __( 'CW Bottom-top', 'genesis' ),
	'description' => __( 'Custom Widget Bottom Top Area', 'news' ),
	'before_title'  => '<h4 class="custom-title">',
) );
genesis_register_sidebar( array(
	'id'          => 'custom-widget-top-left',
	'name'        => __( 'CW Top Left', 'news' ),
	'description' => __( 'This is the custom middle left section of the homepage.', 'news' ),
	'before_title'  => '<h4 class="custom-title">',
) );
genesis_register_sidebar( array(
	'id'          => 'custom-widget-top-right',
	'name'        => __( 'CW Top Right', 'news' ),
	'description' => __( 'This is the custom middle right section of the homepage.', 'news' ),
	'before_title'  => '<h4 class="custom-title">',
) );
genesis_register_sidebar( array(
	'id' => 'custom-widget-bottom-top-left',
	'name' => __( 'CW Bottom Top Left', 'genesis' ),
	'description' => __( 'Custom Widget Bottom Top left section of the homepage.', 'news' ),
	'before_title'  => '<h4 class="custom-title">',
) );
genesis_register_sidebar( array(
	'id' => 'custom-widget-bottom-top-right',
	'name' => __( 'CW Bottom Top Right', 'genesis' ),
	'description' => __( 'Custom Widget Bottom Top Right section of the homepage.', 'news' ),
	'before_title'  => '<h4 class="custom-title">',
) );
genesis_register_sidebar( array(
	'id' => 'custom-widget-bottom',
	'name' => __( 'CW Bottom', 'genesis' ),
	'description' => __( 'Custom Widget Bottom Area', 'news' ),
	'before_title'  => '<h4 class="custom-title">',
) );
genesis_register_sidebar( array(
	'id' => 'custom-widget-middlecontent',
	'name' => __( 'CW Middle Content List', 'genesis' ),
	'description' => __( 'Middle Content List Area', 'news' ),
) );
genesis_register_sidebar( array(
	'id' => 'custom-widget-bottomcontent',
	'name' => __( 'CW Bottom Content List', 'genesis' ),
	'description' => __( 'Bottom Content List Area', 'news' ),
) );
genesis_register_sidebar( array(
	'id' => 'custom-widget-randomcontentlist',
	'name' => __( 'CW Random Content List', 'genesis' ),
	'description' => __( 'Random Content List Area', 'news' ),
) );



add_action( 'genesis_before_loop', 'add_genesis_widget_area' );
function add_genesis_widget_area() {  
  if ( is_paged() ) {
        register_sidebar( 'custom-widget-top' );                
  }
 if ( is_home() ) {
                genesis_widget_area( 'custom-widget-top', array(
		'before' => '<div class="custom-widget-top widget-area">',
		'after'  => '</div>',
    ) );               
  } 
}
//add_action( 'genesis_before_loop', 'add_genesis_widget_area31' );
function add_genesis_widget_area31() {
  if ( is_paged() ) {
        unregister_sidebar( 'custom-widget-bottom-top' ); 
  } 
  if ( is_home() ) {
                genesis_widget_area( 'custom-widget-bottom-top', array(
		'before' => '<div class="custom-widget-bottom31 widget-area">',
		'after'  => '</div>',
    ) );               
  }
}
//add_action( 'genesis_before_loop', 'add_genesis_widget_area2' );
function add_genesis_widget_area2() {
  if ( is_paged() ) {
        unregister_sidebar( 'custom-widget-top-left' ); 
        unregister_sidebar( 'custom-widget-top-right' );  
        echo'<style>.home-middle {display:none;}</style>';		
  } 
 if ( is_home() ) {  
    echo '<div class="home-middle">';              
               genesis_widget_area( 'custom-widget-top-left', array(
		'before' => '<div class="custom-widget-top-left widget-area">',
		'after'  => '</div>',
    ) );
    genesis_widget_area( 'custom-widget-top-right', array(
		'before' => '<div class="custom-widget-top-right widget-area">',
		'after'  => '</div>',
    ) );
    echo '</div>'; 
    echo '<div class="clear" style="clear:both;"></div>';
  }   
}


//add_action( 'genesis_before_loop', 'add_genesis_widget_area3' );
function add_genesis_widget_area3() {
  if ( is_paged() ) {
        unregister_sidebar( 'custom-widget-bottom-top-left' ); 
        unregister_sidebar( 'custom-widget-bottom-top-right' );  
        echo'<style>.home-middle {display:none;}</style>';		
  } 
 if ( is_home() ) {  
    echo '<div class="home-middle-bottom">';              
               genesis_widget_area( 'custom-widget-bottom-top-left', array(
		'before' => '<div class="custom-widget-bottom-top-left widget-area">',
		'after'  => '</div>',
    ) );
    genesis_widget_area( 'custom-widget-bottom-top-right', array(
		'before' => '<div class="custom-widget-bottom-top-right widget-area">',
		'after'  => '</div>',
    ) );
    echo '</div>'; 
    echo '<div class="clear" style="clear:both;"></div>'; 
  }   
}

//add_action( 'genesis_before_loop', 'add_genesis_widget_area4' );
function add_genesis_widget_area4() {
  if ( is_home() ) {
                genesis_widget_area( 'custom-widget-bottom', array(
		'before' => '<div class="custom-widget-bottom widget-area">',
		'after'  => '</div>',
    ) );               
  }
}

add_action( 'genesis_after_entry', 'add_genesis_widget_area5' );
function add_genesis_widget_area5() {
  if ( is_single() || is_page_template('page_article.php')) {
                genesis_widget_area( 'custom-widget-middlecontent', array(
		'before' => '<div class="custom-widget-middlecontent widget-area">',
		'after'  => '</div>',
    ) );               
  }
}



add_action( 'genesis_after_entry_content', 'add_genesis_widget_area6' );
function add_genesis_widget_area6() {
  if ( is_single() ) {
                genesis_widget_area( 'custom-widget-randomcontentlist', array(
		'before' => '<div class="custom-widget-randomcontentlist widget-area">',
		'after'  => '</div>',
    ) );               
  }
}

function display_text_zoom_enqueue_scripts() {
    if( is_single()) {   
         wp_enqueue_script( 'jquery-213.min', get_stylesheet_directory_uri() . '/js/jquery-213.min.js', array( 'jquery' ), '', true );       
	wp_register_script( 'vic_textzoomprint', get_stylesheet_directory_uri() . '/js/vic_textzoomprint.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'vic_textzoomprint' );  	
	}
    if( is_home( ) || is_front_page() ) {
        wp_deregister_script( 'vic_textzoomprint');       
    }
}    

add_action( 'wp_enqueue_scripts', 'display_text_zoom_enqueue_scripts' );


function facebook_like_button() {
echo '<div class="facebook_like_button"><iframe src="http://www.facebook.com/plugins/like.php?href=' . 'https://www.facebook.com/TheAlternativeDaily' . '&amp;layout=standard&amp;data-action=like&amp;show_faces=false&amp;width=320&amp;height=40px
&amp;action=like&amp;font=trebuchet+ms&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:320px; height:40px"></iframe></div>';
}
add_action('genesis_header_right','facebook_like_button');

unregister_sidebar('sidebar');
unregister_sidebar('sidebar-alt');
genesis_register_sidebar(
 array(
'id' => 'sidebar',
'name'  => __( 'Primary Sidebar', 'genesis' ),
'description' => __( 'This is the primary sidebar if you are using a two or three column site layout option.', 'genesis' ),
'_genesis_builtin' => true,
'before_title'  => '<div id="exclusive-reports"><h4 class="custom-title01">', 
 )
);

genesis_register_sidebar(
array(
'id' => 'sidebar-alt',
'name' => __( 'Secondary Sidebar', 'genesis' ),
'description' => __( 'This is the secondary sidebar if you are using a three column site layout option.', 'genesis' ),
'_genesis_builtin' => true,
'before_title'  => '<h4 class="custom-title01">', 
)
);

genesis_register_sidebar( array(
	'id' => 'sidebar-mobile',
	'name' => __( 'Sidebar Mobile', 'genesis' ),
	'description' => __( 'Sidebar Mobile Section', 'news' ),
) );


add_action( 'genesis_before_sidebar_widget_area', 'add_genesis_mobile_sidebar' );
function add_genesis_mobile_sidebar() {
    if ( wp_is_mobile () ) {
        remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
        genesis_widget_area( 'sidebar-mobile', array(
		'before' => '<div class="sidebar-mobile widget-area">',
		'after'  => '</div>',
    ) );    

    }           

}

genesis_register_sidebar( array(
	'id' => 'sidebar-simple-post-no-ads',
	'name' => __( 'CW Simple Post No Ads Sidebar', 'genesis' ),
	'description' => __( 'Simple Post No Ads Sidebar Section', 'news' ),
) );

genesis_register_sidebar( array(
	'id' => 'sidebar-middle-post-ads',
	'name' => __( 'CW Desktop Top Ad Sidebar', 'genesis' ),
	'description' => __( 'Desktop Top Ad Sidebar Section', 'news' ),
) );

genesis_register_sidebar( array(
	'id' => 'sidebar-mobile-middle-post-ads',
	'name' => __( 'CW Mobile Top Ad Sidebar', 'genesis' ),
	'description' => __( 'Mobile Top Ad Sidebar Section', 'news' ),
) );


function genesis_do_filter_where( $query ) {
  if ( $query->is_search && $query->is_main_query() ) {
    $query->set( 'post__not_in', array( 25587,25595,25591 ) );
  }
}
add_filter( 'pre_get_posts', 'genesis_do_filter_where' );
add_filter( 'jpeg_quality', create_function( '', 'return 60;' ));