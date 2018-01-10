<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php if($monthnum||$year||$cat){?><?php if($cat){?><?php single_cat_title();?><?php }elseif($monthnum||$year){echo $year.'年';?><?php if($monthnum){echo $monthnum.'月';}}?><?php } ?>の記事一覧 | マイホームブログ | Web屋の芝生DIY</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="マイホームブログ<?php if($monthnum||$year||$cat){?><?php if($cat){?><?php single_cat_title();?><?php }elseif($monthnum||$year){echo $year.'年';?><?php if($monthnum){echo $monthnum.'月';}}?><?php } ?>の記事一覧を掲載しています。">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Web屋の芝生DIY">
<meta property="og:url" content="https://web-diy.jp">
<meta property="og:image" content="https://web-diy.jp/shared/images/ogp.png">
<meta property="og:title" content="<?php if($monthnum||$year||$cat){?><?php if($cat){?><?php single_cat_title();?><?php }elseif($monthnum||$year){echo $year.'年';?><?php if($monthnum){echo $monthnum.'月';}}?><?php } ?>の記事一覧">
<meta property="og:description" content="<?php if($monthnum||$year||$cat){?><?php if($cat){?><?php single_cat_title();?><?php }elseif($monthnum||$year){echo $year.'年';?><?php if($monthnum){echo $monthnum.'月';}}?><?php } ?>の記事一覧を掲載しています。">
<link rel="stylesheet" href="/shared/css/basic.css" media="all">
</head>
<body class="lyt-main-sub">
<?php get_header(); ?>
<div id="content">
<div id="breadcrumb">
<ul>
<li><a href="/">トップ</a></li>
<li><a href="/blog/">マイホームブログ</a></li>
<li><?php if($monthnum||$year||$cat){?><?php if($cat){?><?php single_cat_title();?><?php }elseif($monthnum||$year){echo $year.'年';?><?php if($monthnum){echo $monthnum.'月';}}?><?php } ?>の記事一覧</li>
</ul>
</div><!--/#breadcrumb"-->
<main>
<div id="main-inner">
<h1 class="hdg-l1-01"><?php if($monthnum||$year||$cat){?><?php if($cat){?><?php single_cat_title();?><?php }elseif($monthnum||$year){echo $year.'年';?><?php if($monthnum){echo $monthnum.'月';}}?><?php } ?>の記事一覧</h1>
<ul class="list-link-01">
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<li><p class="date"><span class="cat"><?php $category = get_the_category();echo $category[0]->cat_name;?></span><?php the_time('Y年n月j日'); ?></p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>
<?php else : ?>
<?php endif; ?>
<?php if (function_exists('responsive_pagination')) {responsive_pagination($additional_loop->max_num_pages);} ?>
<?php include( TEMPLATEPATH . '/ad-main-bottom.php' ); ?>
</div><!--/#main-inner"-->
</main>
<?php include( TEMPLATEPATH . '/sidebar-blog.php' ); ?>
</div><!--/#content-->
<?php get_footer(); ?>