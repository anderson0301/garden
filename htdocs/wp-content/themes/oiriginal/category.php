<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>カテゴリー「<?php $category = get_the_category();echo $category[0]->cat_name;?>」の記事一覧 | マイホームブログ | Web屋の芝生DIY</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="<? foreach((get_the_category()) as $cat) {echo $cat->category_description . '';} ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Web屋の芝生DIY">
<meta property="og:url" content="<?php echo(empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
<meta property="og:image" content="http://web-diy.rdy.jp/shared/images/ogp.png">
<meta property="og:title" content="カテゴリー「<?php $category = get_the_category();echo $category[0]->cat_name;?>」の記事一覧">
<meta property="og:description" content="<? foreach((get_the_category()) as $cat) {echo $cat->category_description . '';} ?>">
<link rel="stylesheet" href="/shared/css/basic.css" media="all">
</head>
<body class="lyt-main-sub <?php $cat = get_the_category();$cat = $cat[0];?><?php echo $cat->category_nicename; ?>">
<?php get_header(); ?>
<div id="content">
<div id="breadcrumb">
<ul>
<li><a href="/">トップ</a></li>
<li><a href="/blog/">マイホームブログ</a></li>
<li>カテゴリー「<?php $category = get_the_category();echo $category[0]->cat_name;?>」の記事一覧</li>
</ul>
</div><!--/#breadcrumb"-->
<main>
<div id="main-inner">
<h1 class="hdg-l1-01">カテゴリー「<?php $category = get_the_category();echo $category[0]->cat_name;?>」の記事一覧</h1>
<p><? foreach((get_the_category()) as $cat) {echo $cat->category_description . '';} ?></p>
<ul class="list-link-thum">
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink(); ?>"><span class="date"><?php the_time('Y年n月j日'); ?></span><span class="txt"><?php the_title(); ?></span><?php if ( has_post_thumbnail() ) : ?><?php $img_id = get_post_thumbnail_id();$img_thumbnail = wp_get_attachment_image_src( $img_id , 'thum300' );echo '<img width="80" height="80" src="'.$img_thumbnail[0].'" alt="">';?><?php else: ?><?php endif; ?></a></li>
<?php endwhile; ?>
</ul>
<?php else : ?>
<?php endif; ?>
<?php if (function_exists('responsive_pagination')) {responsive_pagination($additional_loop->max_num_pages);} ?>
<h2 class="hdg-l2-01"><span>カテゴリー「<?php $category = get_the_category();echo $category[0]->cat_name;?>」の人気記事</span></h2>
<ul class="list-link-thum">
<?php $cat = get_the_category();$catids = "";
	foreach( $cat as $catid){
		$catids .= $catid->cat_ID.",";
	};
$posts = get_posts(array(
'posts_per_page' => 6,
'meta_key' => 'views',
'orderby' => 'meta_value_num', 
'category' => $catids,
));?>
<?php foreach($posts as $post) : ?>
<li><a href="<?php the_permalink(); ?>"><span class="date"><?php the_time('Y年n月j日'); ?></span><span class="txt"><?php the_title(); ?></span><?php if ( has_post_thumbnail() ) : ?><?php $img_id = get_post_thumbnail_id();$img_thumbnail = wp_get_attachment_image_src( $img_id , 'thum300' );echo '<img width="80" height="80" src="'.$img_thumbnail[0].'" alt="">';?><?php else: ?><?php endif; ?></a></li>
<?php endforeach;wp_reset_postdata(); ?>
</ul>
<?php include( TEMPLATEPATH . '/ad-main-bottom.php' ); ?>
</div><!--/#main-inner-->
</main>
<?php include( TEMPLATEPATH . '/sidebar-blog.php' ); ?>
</div><!--/#content-->
<?php get_footer(); ?>