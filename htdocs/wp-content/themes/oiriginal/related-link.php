<?php $categories = get_the_category($post->ID);$category_ID = array();foreach($categories as $category):array_push( $category_ID, $category -> cat_ID);endforeach ;
$args = array('post__not_in' => array($post -> ID),'posts_per_page'=> 6,'category__in' => $category_ID,'orderby' => 'rand',);
$query = new WP_Query($args); ?>
<h2 class="hdg-l2-01">この記事を読んでいる方にオススメの記事</h2>
<ul class="list-link-thum">
<?php if( $query -> have_posts() ): ?>
<?php while ($query -> have_posts()) : $query -> the_post(); ?>
<li><a href="<?php the_permalink(); ?>"><span class="cat"><?php $category = get_the_category();echo $category[0]->cat_name;?></span><span class="txt"><?php the_title(); ?></span><?php if ( has_post_thumbnail() ) : ?><?php $img_id = get_post_thumbnail_id();$img_thumbnail = wp_get_attachment_image_src( $img_id , 'thum300' );echo '<img width="80" height="80" src="'.$img_thumbnail[0].'" alt="">';?><?php else: ?><?php endif; ?></a></li>
<?php endwhile;?>
<?php else:?>
<?php endif;wp_reset_postdata();?>
</ul>
