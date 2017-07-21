<?php $myAmp = false; $string = $post->post_content;if($_GET['amp'] === '1' && strpos($string,'<script>') === false && is_single()){$myAmp = true;}?>
<!DOCTYPE html>
<?php if($myAmp):?>
<html amp>
<head>
<?php else:?>
<html lang="ja">
<head>
<?php endif; ?>
<meta charset="utf-8">
<title><?php the_title(); ?> | <?php $category = get_the_category();echo $category[0]->cat_name;?> | マイホームブログ | Web屋の芝生DIY</title>
<?php wp_head(); ?>
<?php if($myAmp): ?>
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<?php else: ?>
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php endif; ?>
<meta name="description" content="<?php echo get_the_excerpt(); ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Web屋の芝生DIY">
<meta property="og:url" content="<?php echo(empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
<meta property="og:image" content="<?php if (has_post_thumbnail()){$image_id = get_post_thumbnail_id ();$image_url = wp_get_attachment_image_src ($image_id, true);echo $image_url[0];}?>">
<meta property="og:title" content="<?php the_title(); ?>">
<meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
<?php if($myAmp):?>
<?php $canonical_url = get_permalink(); ?>
<link rel="canonical" href="<?php echo $canonical_url; ?>">
<?php endif;?>
<?php if(!$myAmp): ?>
<link rel="amphtml" href="<?php echo(empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>?amp=1">
<link rel="stylesheet" href="/shared/css/basic.css" media="all">
<?php endif; ?>
<?php if($myAmp): ?>
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
<?php include( TEMPLATEPATH . '/amp-style.php' ); ?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Article",
  "mainEntityOfPage":{
    "@type":"WebPage",
    "@id":"<?php the_permalink(); ?>"
  },
  "headline": "<?php the_title();?>",
  "image": {
    "@type": "ImageObject",
    "url": "http://web-diy.rdy.jp/shared/images/schema.png",
    "height": 420,
    "width": 800
  },
  "datePublished": "<?php the_time('c') ;?>",
  "dateModified": "<?php echo max( get_the_modified_time('c'), get_the_time('c') ); ?>",
  "author": {
    "@type": "Person",
    "name": "Masa"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Web屋の芝生DIY",
    "logo": {
      "@type": "ImageObject",
      "url": "http://web-diy.rdy.jp/shared/images/logo.png",
      "width": 240,
      "height": 28
    }
  },
  "description": "<?php echo get_the_excerpt(); ?>"
}
</script>
<?php endif; ?>
</head>
<body class="lyt-main-sub <?php $cat = get_the_category();$cat = $cat[0];?><?php echo $cat->category_nicename; ?>">
<?php get_header(); ?>
<div id="content">
<div id="breadcrumb">
<ul>
<li><a href="/">トップ</a></li>
<li><a href="/blog/">マイホームブログ</a></li>
<li><?php $category = get_the_category();if ($category[0]) {echo '<a href="'.get_category_link( $category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
<li><?php the_title(); ?></li>
</ul>
</div><!--/#breadcrumb"-->
<main>
<div id="main-inner">
<h1 class="hdg-l1-01"><span><?php the_title(); ?></span></h1>
<p class="mb20"><span class="cat"><?php $category = get_the_category();echo $category[0]->cat_name;?></span><?php the_time('Y年n月j日'); ?></p>
<?php if(!$myAmp): ?>
<p class="main-visual"><img src="<?php if (has_post_thumbnail()){$image_id = get_post_thumbnail_id ();$image_url = wp_get_attachment_image_src ($image_id, true);echo $image_url[0];}?>" alt=""></p>
<?php endif; ?>
<?php if (is_home()) query_posts('showposts=1');?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php if($myAmp): ?>
<?php
$content = apply_filters( 'the_content', get_the_content() );
$content = str_replace( ']]>', ']]&gt;', $content );
$pattern = '/<img/i';
    preg_match($pattern,$content,$matches);
    $append = $matches[0];
    $append = '<amp-img layout="responsive"';
    $result = preg_replace($pattern, $append, $content);
echo $result;
?>
<?php else: ?>
<?php the_content(); ?>
<?php endif;?>
<?php endwhile; ?>
<?php if(!$myAmp): ?>
<?php include( TEMPLATEPATH . '/ad-main-bottom.php' ); ?>
<ul class="list-prev-next">
<?php $prevpost = get_adjacent_post(true, '', true); if ($prevpost) : ?>
<li><a href="<?php echo get_permalink($prevpost->ID); ?>"><span><?php echo esc_attr($prevpost->post_title); ?></span><?php echo get_the_post_thumbnail($prevpost->ID, 'thum300'); ?></a></li>
<?php endif; ?>
<?php $nextpost = get_adjacent_post(true, '', false); if ($nextpost) : ?>
<li><a href="<?php echo get_permalink($nextpost->ID); ?>"><span><?php echo esc_attr($nextpost->post_title); ?></span><?php echo get_the_post_thumbnail($nextpost->ID, 'thum300'); ?></a></li>
<?php endif; ?>
</ul>
<?php include( TEMPLATEPATH . '/related-link.php' ); ?>
<p class="btn-01 mb40"><?php $category = get_the_category();if ($category[0]) {echo '<a href="'.get_category_link( $category[0]->term_id ).'">「'.$category[0]->cat_name.'」の他の記事を読む</a>';}?></p>
<?php include( TEMPLATEPATH . '/social.php' ); ?>
<?php comments_template(); ?>
<?php endif; ?>
<?php if($myAmp):?>
<?php include( TEMPLATEPATH . '/ad-main-bottom-amp.php' ); ?>
<?php endif;?>
</div><!--/#main-inner-->
</main>
<?php if(!$myAmp): ?>
<?php include( TEMPLATEPATH . '/sidebar-blog.php' ); ?>
<?php endif; ?>
</div><!--/#content-->
<?php get_footer(); ?>
