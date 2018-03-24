<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php hierarchical_title('|'); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="<?php echo get_the_excerpt(); ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Web屋の芝生DIY">
<meta property="og:url" content="<?php echo(empty($_SERVER['HTTPS']) ? 'https://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
<meta property="og:image" content="https://web-diy.jp/shared/images/ogp.png">
<meta property="og:title" content="<?php the_title(); ?> | Web屋の芝生DIY">
<meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
<link rel="stylesheet" href="/shared/css/basic.css" media="all">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="/apple-touch-icon.png" sizes="180x180">
</head>
<body class="lyt-main-sub">
<?php get_header(); ?>
<div id="content">
<?php breadcrumb(); ?>
<main>
<div id="main-inner">
<h1 class="hdg-l1-01"><span><?php the_title(); ?></span></h1>
<?php if (is_home()) query_posts('showposts=1');?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; ?>
<?php include( TEMPLATEPATH . '/ad-main-bottom.php' ); ?>
<p class="btn-01 mt20 mb30"><a href="/category/turf/">芝生のブログ記事を見る</a></p>
<?php include( TEMPLATEPATH . '/social.php' ); ?>
</div><!--/#main-inner"-->
</main>
<div id="nav-sidebar">
<div id="nav-sidebar-inner">
<nav>
<?php
if (is_page()){
    if($post->ancestors){
        foreach($post->ancestors as $post_anc_id){
        $post_id = $post_anc_id;
        }
    } else {
        $post_id = $post->ID;
    }
    if ($post_id) {
        $children = wp_list_pages("title_li=&child_of=".$post_id."&echo=0");
        if ($children) {
            $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
            array_push($ancestors, $post->ID);
            echo '<p class="title-page"><a href="'. get_permalink($ancestors[0]) .'">';
            echo get_the_title($ancestors[0]);
            echo '</a></p>';
            echo '<ul>';
            echo $children;
            echo '</ul>';
        }
    }
}?>
</nav>
<p class="btn-01"><a href="/category/turf/">芝生のブログ記事を読む</a></p>
<p class="title-blog mt30"><span>サイトを作っている人</span></p>
<p class="align-C"><img src="/shared/images/profile.png" alt=""></p>
<ul class="list-info">
<li class="tw"><a href="//twitter.com/webTurfDiy" target="_blank">フォローする</a></li>
<li class="rss"><a href="/feed/" target="_blank">RSSを購読する</a></li>
</ul>
<p>Webデザイナー／フロントエンド・エンジニアのMasaです。独学でWebデザインを勉強後Web業界へ就職し、今の会社に勤めて10年目になりました。<br>
2016年4月にマイホームを購入し、休日は芝生いじりと育児に励んでいます。</p>
<ul class="list-link-01 mb30">
<li><a href="/about/">さらに詳しく知りたい方はこちら</a></li>
</ul>
</div><!--/#nav-sidebar-inner-->
</div><!--/#nav-sidebar-->
</div><!--/#content-->
<?php get_footer(); ?>