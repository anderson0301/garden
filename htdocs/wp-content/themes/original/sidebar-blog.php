<div id="nav-sidebar">
<div id="nav-sidebar-inner">
<p class="title-blog"><span>カテゴリー</span></p>
<ul class="category">
<?php $cat_info = get_categories('');
foreach ($cat_info as $category) { if($category->count != 0) : ?>
<li class="cat-<?php echo $category->category_nicename; ?>"><a href="/category/<?php echo $category->category_nicename; ?>/"><?php echo $category->cat_name; ?></a></li>
<?php endif; };?>
</ul>
<p class="title-blog"><span>最新の記事</span></p>
<ul class="whatsnew">
<?php $posts=get_posts('numberposts=10 & category=0'); ?>
<?php if ( $posts ) : foreach($posts as $post) : setup_postdata($post); ?>
<li><a href="<?php the_permalink();?>"><?php if ( has_post_thumbnail() ) : ?><?php $img_id = get_post_thumbnail_id();$img_thumbnail = wp_get_attachment_image_src( $img_id , 'thum300' );echo '<img width="80" height="80" src="'.$img_thumbnail[0].'" alt="">';?><?php else: ?><?php endif; ?><span class="txt"><?php the_title(); ?></span><p><span class="cat"><?php $category = get_the_category();echo $category[0]->cat_name;?></span><?php the_time('Y年n月j日'); ?></p></a></li>
<?php endforeach; endif; ?></ul>
<p class="more"><a href="#">さらに見る</a></p>
<p class="title-blog"><span>記事を書いている人</span></p>
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
<p class="title-blog"><span>人気の記事</span></p>
<ol class="rank">
<?php $posts = get_posts(array('posts_per_page' => 10,'meta_key' => 'views','orderby' => 'meta_value_num',)); ?>
<?php foreach($posts as $post) : ?>
<li><a href="<?php the_permalink();?>"><?php if (has_post_thumbnail()):?><?php $img_id = get_post_thumbnail_id();$img_thumbnail = wp_get_attachment_image_src( $img_id , 'thum300' );echo '<img width="80" height="80" src="'.$img_thumbnail[0].'" alt="">';?><?php else: ?><?php endif; ?><span class="txt"><?php the_title(); ?></span><p><span class="cat"><?php $category = get_the_category();echo $category[0]->cat_name;?></span><?php the_time('Y年n月j日'); ?></p></a></li>
<?php endforeach;wp_reset_postdata(); ?>
</ol>
<p class="more"><a href="#">さらに見る</a></p>
<p class="title-blog"><span>過去の記事</span></p>
<dl class="archive">
<?php
    $htmlMonthly = wp_get_archives('type=monthly&format=custom&after=|&echo=0');
    $arr = explode("|", $htmlMonthly);
    $lastyear = substr(trim(strip_tags($arr[0])), 0, 4);
    $firstyear = substr(trim(strip_tags($arr[count($arr)-2])), 0, 4);
    $cnt = 0;
    $wrapper = null;

    for($year=$lastyear;$year>=$firstyear;$year--){
		$wrapper .= "<dt><a href='"."/{$year}/'>{$year}年</a></dt>\n<dd>\n<ul>\n";
        $item = '';
        for($month=12;$month>0;$month--){
            if(!preg_match("/年".$month."月/u", $arr[$cnt])){}
            else{
                $item = "<li>".preg_replace("/\d{4}年/u", "", trim($arr[$cnt]))."</li>\n" . $item;
                $cnt++;
            }
        }
        $wrapper .= $item . "</ul>\n</dd>\n";
    }

    echo $wrapper;
?>
</dl>
</div><!--/#nav-sidebar-inner-->
</div><!--/#nav-sidebar-->
