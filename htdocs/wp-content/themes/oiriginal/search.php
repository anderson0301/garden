<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php printf( __( 'Search Results for: %s', 'twentysixteen' ), '' . esc_html( get_search_query() ) . '' ); ?> | Web屋の芝生DIY</title>
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="芝生やDIY等のライフハックやWeb制作情報を発信するメディア">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Web屋の芝生DIY">
<meta property="og:url" content="http://web-diy.rdy.jp">
<meta property="og:image" content="http://web-diy.rdy.jp/shared/images/ogp.png">
<meta property="og:title" content="Web屋の芝生DIY">
<meta property="og:description" content="芝生やDIY等のライフハックやWeb制作情報を発信するメディア">
<link rel="stylesheet" href="/shared/css/basic.css" media="all">
</head>
<body class="lyt-main">
<?php get_header(); ?>
<div id="content">
<div id="breadcrumb">
<ul>
<li><a href="/">トップ</a></li>
<li><?php printf( __( 'Search Results for: %s', 'twentysixteen' ), '' . esc_html( get_search_query() ) . '' ); ?></li>
</ul>
</div><!--/#breadcrumb"-->
<main>
<div id="main-inner">
<h1 class="hdg-l1-01"><?php printf( __( 'Search Results for: %s', 'twentysixteen' ), '' . esc_html( get_search_query() ) . '' ); ?></h1>
<?php if ( have_posts() ) : ?>
<p><?php echo $wp_query->found_posts; ?>件のページが見つかりました。</p>
<?php query_posts($query_string.'&posts_per_page=20'); ?>
<?php
while ( have_posts() ) : the_post();
get_template_part( 'template-parts/content', 'search' );
endwhile;
else :
get_template_part( 'template-parts/content', 'none' );
endif;
?>
<?php if (function_exists('responsive_pagination')) {responsive_pagination($additional_loop->max_num_pages);} ?>
<?php include( TEMPLATEPATH . '/ad-col1-bottom.php' ); ?>
</div><!--/#main-inner"-->
</main>
</div><!--/#content-->
<?php get_footer(); ?>