<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>芝生やDIY等のライフハックやWeb制作情報を発信するメディア | Web屋の芝生DIY</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="芝生やDIY等のライフハックやWeb制作情報を発信するメディア">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Web屋の芝生DIY">
<meta property="og:url" content="https://web-diy.jp/">
<meta property="og:image" content="https://web-diy.jp/shared/images/ogp.png">
<meta property="og:title" content="芝生やDIY等のライフハックやWeb制作情報を発信するメディア | Web屋の芝生DIY">
<meta property="og:description" content="芝生やDIY等のライフハックやWeb制作情報を発信するメディア">
<link rel="stylesheet" href="/shared/css/basic.css" media="all">
</head>
<body>
<header>
<div id="header-inner">
<h1 id="logo"><a href="/"><img src="/shared/images/logo.png" alt="Web屋の芝生DIY"></a></h1>
<p id="tagline">芝生やDIY等のライフハックやWeb制作情報を発信するメディア</p>
<p id="sp-utility-btn">メニューを開く</p>
<div id="sp-drawer-utility">
<div id="sp-drawer-utility-inner">
<form method="get" action="https://web-diy.jp/" >
<input id="text" type="text" value="" name="s" placeholder="キーワード">
<input id="btn" type="image" src="/shared/images/btn_search.png" alt="検索する">
</form>
<ul class="utility">
<li><a href="/about/">サイトについて</a></li>
<li><a href="/contact/">お問い合わせ</a></li>
<li><a href="/sitemap/">サイトマップ</a></li>
</ul>
</div>
</div>
</div>
<nav>
<ul>
<li class="select"><a href="/select/">芝生の選び方</a></li>
<li class="buy"><a href="/buy/">芝生の購入</a></li>
<li class="plant"><a href="/plant/">芝生の張り方</a></li>
<li class="maintenance"><a href="/maintenance/">芝生の手入れ</a></li>
<li class="tool"><a href="/tool/">芝生の道具</a></li>
<li class="blog"><a href="/blog/">マイホームブログ</a></li>
</ul>
</nav>
</header>
<div id="content">
<h2 class="hdg-l2-top mt30"><span>最新の記事を読む</span></h2>
<div id="news">
<div class="grid-2">
<?php
global $post;
$args = array( 'posts_per_page' => 6 );
$myposts = get_posts( $args );
foreach( $myposts as $post ) {
setup_postdata($post);
?>
<div class="col">
<div class="bd-type-01">
<p class="img"><a href="<?php the_permalink() ?>"><img src="<?php if (has_post_thumbnail()){$image_id = get_post_thumbnail_id ();$image_url = wp_get_attachment_image_src ($image_id, true);echo $image_url[0];}?>" alt=""></a></p>
<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
<p class="meta"><span class="cat"><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></span><?php the_time('Y年n月j日'); ?></p>
</div>
<?php $days = 7;$today = date_i18n('U');$entry = get_the_time('U');$kiji = date('U',($today - $entry)) / 86400 ;if( $days > $kiji ){echo '<p class="new"><span>New</span></p>';}?>
</div>
<?php
}
wp_reset_postdata();
?>
</div>
</div><!--/#news-->
<p class="btn-01"><a href="/blog/">他の記事を読む</a></p>
<?php include( TEMPLATEPATH . '/ad-toppage-middle.php' ); ?>
<h2 class="hdg-l2-top"><span>芝生について勉強する</span></h2>
<div class="grid-3">
<div class="col">
<div class="bd-type-01">
<h2><a href="/select/"><img src="/images/index_fig_01.png" alt=""><span>芝生の選び方</span></a></h2>
<ul>
<li><a href="/select/summer_winter/">夏芝と冬芝</a></li>
<li><a href="/select/ja_eu/">日本芝と西洋芝</a></li>
<li><a href="/select/fit/">趣向にあった芝生を選ぶ</a></li>
</ul>
</div>
</div>
<div class="col">
<div class="bd-type-01">
<h2><a href="/buy/"><img src="/images/index_fig_02.png" alt=""><span>芝生の購入</span></a></h2>
<ul>
<li><a href="/buy/homecenter/">ホームセンターで購入する</a></li>
<li><a href="/buy/internet/">インターネットで購入する</a></li>
</ul>
</div>
</div>
<div class="col">
<div class="bd-type-01">
<h2><a href="/plant/"><img src="/images/index_fig_03.png" alt=""><span>芝生の張り方</span></a></h2>
<ul>
<li><a href="/plant/season/">芝生植栽に適した時期</a></li>
<li><a href="/plant/level/">整地作業</a></li>
<li><a href="/plant/type/">張り方の種類</a></li>
<li><a href="/plant/put/">芝生を張る</a></li>
<li><a href="/plant/cure/">芝張り後の養生について</a></li>
</ul>
</div>
</div>
<div class="col">
<div class="bd-type-01">
<h2><a href="/maintenance/"><img src="/images/index_fig_04.png" alt=""><span>芝生の手入れ</span></a></h2>
<ul>
<li><a href="/maintenance/water/">水やり</a></li>
<li><a href="/maintenance/lawn/">芝刈り</a></li>
<li><a href="/maintenance/soil/">目土を入れる</a></li>
<li><a href="/maintenance/weed/">除草作業</a></li>
<li><a href="/maintenance/hole/">エアレーション</a></li>
<li><a href="/maintenance/clean/">サッチング</a></li>
</ul>
</div>
</div>
<div class="col">
<div class="bd-type-01">
<h2><a href="/tool/"><img src="/images/index_fig_05.png" alt=""><span>芝生の道具</span></a></h2>
<ul>
<li><a href="/tool/scoop/">スコップ</a></li>
<li><a href="/tool/lawn/">芝刈り機</a></li>
<li><a href="/tool/hose/">散水ホース</a></li>
<li><a href="/tool/plate/">転圧版</a></li>
<li><a href="/tool/sieve/">ふるい</a></li>
<li><a href="/tool/lake/">レーキ</a></li>
<li><a href="/tool/scissors/">園芸用ハサミ</a></li>
</ul>
</div>
</div>
<div class="col">
<div class="bd-type-01">
<h2><a href="/blog/"><img src="/images/index_fig_06.png" alt=""><span>マイホームブログ</span></a></h2>
<ul>
<li><a href="/category/turf/">芝生</a></li>
<li><a href="/category/web/">Web</a></li>
<li><a href="/category/wp/">WordPress</a></li>
<li><a href="/category/diy/">DIY</a></li>
<li><a href="/category/loan/">住宅ローン</a></li>
</ul>
</div>
</div>
</div><!--/.grid-3-->
<?php include( TEMPLATEPATH . '/ad-toppage-bottom.php' ); ?>
<h2 class="hdg-l2-top"><span>おすすめの記事を読む</span></h2>
<div id="recommend">
<div class="grid-2">
<?php $posts = get_posts(array(
    'posts_per_page' => 6,
    'meta_key' => 'views',
    'orderby' => 'meta_value_num',
)); ?>
<?php foreach($posts as $post) : ?>
<div class="col">
<div class="bd-type-01">
<p class="img"><a href="<?php the_permalink() ?>"><img src="<?php if (has_post_thumbnail()){$image_id = get_post_thumbnail_id ();$image_url = wp_get_attachment_image_src ($image_id, true);echo $image_url[0];}?>" alt=""></a></p>
<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
<p class="meta"><span class="cat"><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></span><?php the_time('Y年n月j日'); ?></p>
</div>
</div>
<?php endforeach;wp_reset_postdata(); ?>
</div>
</div><!--/#recommend-->
<p class="btn-01"><a href="/blog/">他の記事を読む</a></p>
</div><!--/#content-->
<?php get_footer(); ?>