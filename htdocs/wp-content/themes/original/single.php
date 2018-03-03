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
<meta property="og:url" content="<?php echo(empty($_SERVER['HTTPS']) ? 'https://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
<meta property="og:image" content="<?php the_post_thumbnail_url(); ?>">
<meta property="og:title" content="<?php the_title(); ?>">
<meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
<?php if($myAmp):?>
<?php $canonical_url = get_permalink(); ?>
<link rel="canonical" href="<?php echo $canonical_url; ?>">
<?php endif;?>
<?php if(!$myAmp): ?>
<link rel="amphtml" href="<?php echo(empty($_SERVER['HTTPS']) ? 'https://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>?amp=1">
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
    "url": "https://web-diy.jp/shared/images/schema.png",
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
      "url": "https://web-diy.jp/shared/images/logo.png",
      "width": 240,
      "height": 28
    }
  },
  "description": "<?php echo get_the_excerpt(); ?>"
}
</script>
<?php endif; ?>
<script type="application/ld+json">{"@context":"http://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"item":{"@id":"/","name":"Web屋の芝生DIY"}},{"@type":"ListItem","position":2,"item":{"@id":"/blog/","name":"マイホームブログ"}},{"@type":"ListItem","position":3,"item":{"@id":"<?php $category = get_the_category();if($category[0]){echo ''.get_category_link( $category[0]->term_id ).'';}?>","name":"<?php $category = get_the_category();echo $category[0]->cat_name;?>"}},{"@type":"ListItem","position":4,"item":{"@id":"<?php echo(empty($_SERVER['HTTPS']) ? 'https://':'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>","name":"<?php the_title();?>"}}]}</script>
</head>
<body class="lyt-main-sub <?php $cat = get_the_category();$cat = $cat[0];?><?php echo $cat->category_nicename; ?>">
<?php get_header(); ?>
<div id="content">
<div id="breadcrumb">
<ul>
<li><a href="/">トップ</a></li>
<li><a href="/blog/">マイホームブログ</a></li>
<li><?php $category = get_the_category();if ($category[0]) {echo '<a href="'.get_category_link( $category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
<li class="title"><?php the_title(); ?></li>
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
<li class="prev"><?php $prevpost = get_adjacent_post(true, '', true); if ($prevpost) : ?><a href="<?php echo get_permalink($prevpost->ID); ?>"><span><?php echo esc_attr($prevpost->post_title); ?></span><img src="<?php echo get_the_post_thumbnail_url($prevpost->ID,'thum300');?>" alt=""></a><?php endif; ?></li>
<li class="next"><?php $nextpost = get_adjacent_post(true, '', false); if ($nextpost) : ?><a href="<?php echo get_permalink($nextpost->ID); ?>"><span><?php echo esc_attr($nextpost->post_title); ?></span><img src="<?php echo get_the_post_thumbnail_url($nextpost->ID,'thum300');?>" alt=""></a><?php endif; ?></li>
</ul>
<?php include( TEMPLATEPATH . '/related-link.php' ); ?>
<p class="btn-01 mb40"><?php $category = get_the_category();if ($category[0]) {echo '<a href="'.get_category_link( $category[0]->term_id ).'">「'.$category[0]->cat_name.'」の他の記事を読む</a>';}?></p>
<?php include( TEMPLATEPATH . '/social.php' ); ?>
<?php comments_template(); ?>
<?php endif; ?>
<?php if($myAmp):?>
<?php include( TEMPLATEPATH . '/ad-main-bottom-amp.php' ); ?>
<ul class="list-prev-next">
<li class="prev"><?php $prevpost = get_adjacent_post(true, '', true); if ($prevpost) : ?><a href="<?php echo get_permalink($prevpost->ID); ?>"><span><?php echo esc_attr($prevpost->post_title); ?></span><amp-img src="<?php echo get_the_post_thumbnail_url($prevpost->ID,'thum300');?>" alt="" width="86" height="86" layout="responsive"></amp-img></a><?php endif; ?></li>
<li class="next"><?php $nextpost = get_adjacent_post(true, '', false); if ($nextpost) : ?><a href="<?php echo get_permalink($nextpost->ID); ?>"><span><?php echo esc_attr($nextpost->post_title); ?></span><amp-img src="<?php echo get_the_post_thumbnail_url($nextpost->ID,'thum300');?>" alt="" width="86" height="86" layout="responsive"></amp-img></a><?php endif; ?></li>
</ul>
<?php $categories = get_the_category($post->ID);$category_ID = array();foreach($categories as $category):array_push( $category_ID, $category -> cat_ID);endforeach ;
$args = array('post__not_in' => array($post -> ID),'posts_per_page'=> 6,'category__in' => $category_ID,'orderby' => 'rand',);
$query = new WP_Query($args); ?>
<h2 class="hdg-l2-01">この記事を読んでいる方にオススメの記事</h2>
<ul class="list-link-thum js-related">
<?php if( $query -> have_posts() ): ?>
<?php while ($query -> have_posts()) : $query -> the_post(); ?>
<li><a href="<?php the_permalink(); ?>"><span class="cat"><?php $category = get_the_category();echo $category[0]->cat_name;?></span><span class="txt"><?php the_title(); ?></span><?php if ( has_post_thumbnail() ) : ?><?php $img_id = get_post_thumbnail_id();$img_thumbnail = wp_get_attachment_image_src( $img_id , 'thum300' );echo '<amp-img width="80" height="80" src="'.$img_thumbnail[0].'" alt=""></amp-img>';?><?php else: ?><?php endif; ?></a></li>
<?php endwhile;?>
<?php else:?>
<?php endif;wp_reset_postdata();?>
</ul>
<p class="btn-01 mb40"><?php $category = get_the_category();if ($category[0]) {echo '<a href="'.get_category_link( $category[0]->term_id ).'">「'.$category[0]->cat_name.'」の他の記事を読む</a>';}?></p>
<?php endif;?>
</div><!--/#main-inner-->
</main>
<?php if(!$myAmp): ?>
<?php include( TEMPLATEPATH . '/sidebar-blog.php' ); ?>
<?php endif; ?>
<?php if($myAmp): ?>
<?php include( TEMPLATEPATH . '/sidebar-blog-amp.php' ); ?>
<?php endif; ?>
</div><!--/#content-->
<?php get_footer(); ?>
