<?php
/* Template Name: Blog */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php hierarchical_title('|'); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="マイホームブログでは芝生やDIY等のライフハックに加え、フロントエンドを中心としたWeb制作に関する記事を掲載しています。">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Web屋の芝生DIY">
<meta property="og:url" content="https://web-diy.jp/blog/">
<meta property="og:image" content="https://web-diy.jp/shared/images/ogp.png">
<meta property="og:title" content="<?php the_title(); ?> | Web屋の芝生DIY">
<meta property="og:description" content="マイホームブログでは芝生やDIY等のライフハックに加え、フロントエンドを中心としたWeb制作に関する記事を掲載しています。">
<link rel="stylesheet" href="/shared/css/basic.css" media="all">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="/apple-touch-icon.png" sizes="180x180">
</head>
<body class="lyt-main-sub">
<?php get_header(); ?>
<div id="content">
<div id="breadcrumb">
<ul>
<li><a href="/">トップ</a></li>
<li>マイホームブログ</li>
</ul>
</div><!--/#breadcrumb"-->
<main>
<div id="main-inner">
<h1 class="hdg-l1-01"><span><?php the_title(); ?></span></h1>
<p>マイホームブログでは芝生やDIY等のライフハックに加え、フロントエンドを中心としたWeb制作に関する記事を掲載しています。</p>
<h2 class="hdg-l2-01"><span>最新の記事</span></h2>
<ul class="list-link-thum">
<?php $postslist = get_posts('numberposts=1');foreach ($postslist as $post) : setup_postdata($post);?>
<li class="single"><a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'');?>" alt=""><span class="date"><?php the_time('Y年n月j日'); ?></span><span class="cat double"><?php $category = get_the_category();echo $category[0]->cat_name;?></span><span class="txt"><?php the_title(); ?></span></a></li>
<?php endforeach; ?>
<?php $postslist = get_posts('numberposts=10&offset=1');foreach ($postslist as $post) : setup_postdata($post);?>
<li><a href="<?php the_permalink(); ?>"><span class="date"><?php the_time('Y年n月j日'); ?></span><span class="cat double"><?php $category = get_the_category();echo $category[0]->cat_name;?></span><span class="txt"><?php the_title(); ?></span><img width="80" height="80" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thum300');?>" alt=""></a></li>
<?php endforeach; ?>
</ul>
<?php include( TEMPLATEPATH . '/ad-main-bottom.php' ); ?>
<h2 class="hdg-l2-01"><span>人気の記事</span></h2>
<ul class="list-link-thum">
<?php $posts = get_posts(array('posts_per_page' => 12,'meta_key' => 'views','orderby' => 'meta_value_num')); ?>
<?php foreach($posts as $post) : ?>
<li><a href="<?php the_permalink(); ?>"><span class="date"><?php the_time('Y年n月j日'); ?></span><span class="cat double"><?php $category = get_the_category();echo $category[0]->cat_name;?></span><span class="txt"><?php the_title(); ?></span><img width="80" height="80" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thum300');?>" alt=""></a></li>
<?php endforeach;wp_reset_postdata(); ?>
</ul>
</div><!--/#main-inner"-->
</main>
<?php include( TEMPLATEPATH . '/sidebar-blog.php' ); ?>
</div><!--/#content-->
<?php get_footer(); ?>