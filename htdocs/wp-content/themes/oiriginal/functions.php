<?php

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :

function twentysixteen_setup() {

	load_theme_textdomain( 'twentysixteen', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
	) );
	
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );


	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'twentysixteen_setup' );
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :

function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;
}
endif;



function twentysixteen_scripts() {
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160412' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160412' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160412' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160412', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160412' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160412', true );
	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );


function twentysixteen_body_classes( $classes ) {
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';

function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}
	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );


function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

/*====================================================
title
=====================================================*/
function hierarchical_title( $separateText ){
    $separate = ' ' . $separateText . ' ';
    global $wp_query;
 
    $front_page_text = 'トップ'; //If you have not set the front-page, then describe your text here.
    $front_page_ID = get_option('page_on_front') ;
    if ( $front_page_ID != 0 ) {
        $front_page_title = get_the_title( $front_page_ID );
    } else {
        $front_page_title = $front_page_text;
    }
 
    if ( is_single() )
    {
        echo the_title('','', FALSE) . $separate;
        echo  __('Category') . ": ";
        $categories = get_the_category();
        foreach ( $categories as $value ) {
            echo $value->cat_name . ' ';
        }
        echo  $separateText . ' ';
    }
    elseif ( is_page() )
    {
        $post = $wp_query->get_queried_object();
        if ( $post->post_parent == 0 ){
            echo the_title('','', FALSE) . $separate;
        } else {
            $title = the_title('','', FALSE);
            $ancestors = get_post_ancestors( $post->ID );
            array_unshift($ancestors, $post->ID);
            foreach ( $ancestors as $ancestor ){
                echo get_the_title( $ancestor ) . $separate;
            }
        }
    }
    elseif ( is_category() )
    {
        $catTitle = single_cat_title( "", false );
        echo __('Category') . ": " . $catTitle . $separate;
    }
    elseif ( is_tag() )
    {
        echo __('Tag') . ": ";
        single_tag_title();
        echo $separate;
    }
    elseif ( is_archive() && !is_category() )
    {
        echo __('Archives') . $separate;
    }
    elseif ( is_search() ) {
        echo __('Search Results') . $separate;
    }
    elseif ( is_404() )
    {
        echo __('Page not found') . $separate;
    }
    bloginfo( 'name' );
}

/*====================================================
ルートパスで生成
=====================================================*/
class relative_URI {
    function relative_URI() {
        add_action('get_header', array(&$this, 'get_header'), 1);
        add_action('wp_footer', array(&$this, 'wp_footer'), 99999);
    }
    function replace_relative_URI($content) {
        $home_url = trailingslashit(get_home_url('/'));
        return str_replace($home_url, '/', $content);
    }
    function get_header(){
        ob_start(array(&$this, 'replace_relative_URI'));
    }
    function wp_footer(){
        ob_end_flush();
    }
}
new relative_URI();

/*====================================================
パンくず（2カラム固定ページ用）
=====================================================*/
function breadcrumb(){
	global $post;
	$str ='';
	if(!is_home()&&!is_admin()){ 
		$str.= '<div id="breadcrumb">';
		$str.= '<ul>';
		$str.= '<li><a href="' . home_url('/') .'">トップ</a></li>';
		
		/* 投稿のページ */
		if(is_single()){
			$categories = get_the_category($post->ID);
			$cat = $categories[0];
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li><a href="'. get_category_link($ancestor).'">'. get_cat_name($ancestor). '</a></li>';
									}
			}
			$str.='<li><a href="'. get_category_link($cat -> term_id). '">'. $cat-> cat_name . '</a></li>';
			$str.= '<li>'. $post -> post_title .'</li>';
		} 
		
		/* 固定ページ */
		elseif(is_page()){
			if($post -> post_parent != 0 ){
				$ancestors = array_reverse(get_post_ancestors( $post->ID ));
				foreach($ancestors as $ancestor){
					$str.='<li><a href="'. get_permalink($ancestor).'">'. get_the_title($ancestor) .'</a></li>';
									}
			}
			$str.= '<li>'. $post -> post_title .'</li>';
		}
		
		/* カテゴリページ */	
		elseif(is_category()) {
			$cat = get_queried_object();
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li><a href="'. get_category_link($ancestor) .'">'. get_cat_name($ancestor) .'</a></li>';
				}
			}
			$str.='<li>'. $cat -> name . '</li>';
		}
		$str.='</ul>';
		$str.='</div>';
	}
	echo $str;
}

/*====================================================
wp_headの不要な出力を停止
=====================================================*/
remove_action('wp_head','_wp_render_title_tag',1);
remove_action('wp_head','wp_enqueue_scripts',1);
remove_action('wp_head','wp_resource_hints',2);
remove_action('wp_head','feed_links',2);
remove_action('wp_head','feed_links_extra',3);
remove_action('wp_head','rsd_link');
remove_action('wp_head','wlwmanifest_link');
remove_action('wp_head','adjacent_posts_rel_link_wp_head',10,0);
remove_action('wp_head','locale_stylesheet');
remove_action('wp_head','noindex',1);
remove_action('wp_head','print_emoji_detection_script',7);
remove_action('wp_head','wp_print_styles',8);
remove_action('wp_head','wp_print_head_scripts',9);
remove_action('wp_head','wp_generator');
remove_action('wp_head','rel_canonical');
remove_action('wp_head','wp_shortlink_wp_head',10,0);
remove_action('wp_head','wp_site_icon',99);
remove_action('wp_head','wp_no_robots');
remove_action('wp_head','wp_post_preview_js',1);
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');
remove_action('wp_head','rest_output_link_wp_head',10,0);
remove_action('wp_head','_custom_logo_header_styles');
//インラインスタイル除去
function remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head',array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'],'recent_comments_style'));
}
add_action('widgets_init','remove_recent_comments_style');

//wp-adminbar削除
function mytheme_kill_admin_bar(){
    return false;
}
//show_admin_barにフィルターする。最後に処理してもらいたいので、1,000番目に登録。
add_filter( 'show_admin_bar', 'mytheme_kill_admin_bar' , 1000 );

/*====================================================
ページャー
=====================================================*/
function responsive_pagination($pages = '', $range = 4){
  $showitems = ($range * 2)+1;
 
  global $paged;
  if(empty($paged)) $paged = 1;
 
  //ページ情報の取得
  if($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages){
      $pages = 1;
    }
  }
 
  if(1 != $pages) {
    echo '<ul class="list-pagenation" role="menubar" aria-label="Pagination">';
    //先頭へ
    echo '<li class="first"><a href="'.get_pagenum_link(1).'"><span>&laquo;</span></a></li>';
    //1つ戻る
    echo '<li class="prev"><a href="'.get_pagenum_link($paged - 1).'"><span>&lsaquo;</span></a></li>';
    //番号つきページ送りボタン
    for ($i=1; $i <= $pages; $i++)     {
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))       {
        echo ($paged == $i)? '<li class="current"><a>'.$i.'</a></li>':'<li><a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a></li>';
      }
    }
    //1つ進む
    echo '<li class="next"><a href="'.get_pagenum_link($paged + 1).'"><span>&rsaquo;</span></a></li>';
    //最後尾へ
    echo '<li class="last"><a href="'.get_pagenum_link($pages).'"><span>&raquo;</span></a></li>';
    echo '</ul>';
  }
}

/*====================================================
投稿記事内の文字列変換をオフ
=====================================================*/
remove_filter('the_content', 'wptexturize');	
remove_filter('the_content', 'convert_chars');
remove_filter('the_content', 'wpautop');

/*====================================================
アイキャッチを300×300にトリミング
=====================================================*/
add_image_size('thum300',300,300,true);

/*====================================================
固定ページの「抜粋」有効化
=====================================================*/
add_post_type_support( 'page', 'excerpt' );

/*====================================================
Adsenseショートコード
=====================================================*/
function is_mobile(){
    $useragents = array(
        'iPhone',
        'iPod',
        'Android.*Mobile',
        'Windows.*Phone',
        'dream',
        'CUPCAKE',
        'blackberry9500',
        'blackberry9530',
        'blackberry9520',
        'blackberry9550',
        'blackberry9800',
        'webOS',
        'incognito',
        'webmate'
    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

//記事上段
function showads_top(){
  if(is_single() && $_GET['amp'] === '1'){
    $is_amp = true;
    return '<div class="ad-main-top mb20"><amp-ad layout="responsive" type="adsense" width="300" height="250" data-ad-client="ca-pub-2374938888047560" data-ad-slot="3241284094"></amp-ad></div>';
  }
  else if(is_mobile()){
  	return '<div class="ad-main-top mb20"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2374938888047560" data-ad-slot="3241284094" data-ad-format="rectangle"></ins><script>(adsbygoogle = window.adsbygoogle||[]).push({});</script></div>';
  }
  else{
  	return '<div class="ad-main-top"><div class="grid-2"><div class="col"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2374938888047560" data-ad-slot="3241284094" data-ad-format="rectangle"></ins><script>(adsbygoogle = window.adsbygoogle||[]).push({});</script></div><div class="col"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2374938888047560" data-ad-slot="3241284094" data-ad-format="rectangle"></ins><script>(adsbygoogle = window.adsbygoogle||[]).push({});</script></div></div></div>';
  }
}
add_shortcode('adsense_top', 'showads_top');

//記事中段
function showads_middle(){
  if(is_single() && $_GET['amp'] === '1'){
    $is_amp = true;
    return '<div class="ad-main-middle mb20"><amp-ad layout="responsive" type="adsense" width="300" height="250" data-ad-client="ca-pub-2374938888047560" data-ad-slot="7671483694"></amp-ad></div>';
  }
  else if(is_mobile()){
  	return '<div class="ad-main-middle mb20"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2374938888047560" data-ad-slot="7671483694" data-ad-format="rectangle"></ins><script>(adsbygoogle = window.adsbygoogle||[]).push({});</script></div>';
  }
  else{
  	return '<div class="ad-main-middle"><div class="grid-2"><div class="col"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2374938888047560" data-ad-slot="7671483694" data-ad-format="rectangle"></ins><script>(adsbygoogle = window.adsbygoogle||[]).push({});</script></div><div class="col"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2374938888047560" data-ad-slot="7671483694" data-ad-format="rectangle"></ins><script>(adsbygoogle = window.adsbygoogle||[]).push({});</script></div></div></div>';
  }
}
add_shortcode('adsense_middle', 'showads_middle');

//1カラムページ上段
function showads_top_1col(){
  if(is_mobile()){
  	return '<div class="ad-col1-top mb20"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2374938888047560" data-ad-slot="3332232091" data-ad-format="rectangle"></ins><script>(adsbygoogle = window.adsbygoogle||[]).push({});</script></div>';
  }
  else{
  	return '<div class="ad-col1-top"><div class="grid-2"><div class="col"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2374938888047560" data-ad-slot="7671483694" data-ad-format="auto"></ins><script>(adsbygoogle = window.adsbygoogle||[]).push({});</script></div><div class="col"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2374938888047560" data-ad-slot="7671483694" data-ad-format="auto"></ins><script>(adsbygoogle = window.adsbygoogle||[]).push({});</script></div></div></div>';
  }
}
add_shortcode('adsense_top_1col', 'showads_top_1col');