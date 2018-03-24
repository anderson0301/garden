<?php
/*
Template Name:デモページテンプレート
*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php hierarchical_title('|'); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="<?php echo get_the_excerpt(); ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Web屋の芝生DIY">
<meta property="og:url" content="<?php the_permalink() ?>">
<meta property="og:image" content="https://web-diy.jp/shared/images/ogp.png">
<meta property="og:title" content="<?php the_title(); ?> | Web屋の芝生DIY">
<meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
<link rel="stylesheet" href="/shared/css/basic.css" media="all">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="/apple-touch-icon.png" sizes="180x180">
</head>
<body class="lyt-main">
<?php get_header(); ?>
<div id="content">
<?php breadcrumb(); ?>
<main>
<div id="main-inner">
<h1 class="hdg-l1-01"><span><?php the_title(); ?></span></h1>
<div class="demo mb20">

<?php if (is_home()) query_posts('showposts=1');?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; ?>

</div><!--/.demo-->
<?php include( TEMPLATEPATH . '/ad-col1-bottom.php' ); ?>
</div><!--/#main-inner-->
</main>
</div><!--/#content-->
<?php get_footer(); ?>