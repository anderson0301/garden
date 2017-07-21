<div class="comment">
<?php
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) {
if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
?>
<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'kubrick'); ?></p>
<?php
return;
}
}
$oddcomment = '';
?>
<?php if ($comments) : ?>
	<?php $user_id = get_the_author_meta( 'id' ); ?>

<?php foreach ($comments as $comment) : ?>
<div class="<?php if ($comment->comment_author_email == get_option('admin_email')) {echo 'admin';} else {echo 'guest';}?>">
<p class="date"><?php echo $oddcomment; ?>
<p class="user"><?php printf(__('%s ', 'kubrick'), get_comment_author_link()); ?>さん</p>
<div class="balloon">
<div class="balloon-inner">
<div class="content">
<span class="date"><?php printf(__('%2$s', 'kubrick'), get_comment_date(__('F jS, Y', 'kubrick')), get_comment_time('Y年n月j日')); ?></span>
<div class="txt">
<?php comment_text() ?>
</div>
</div>
</div>
</div>
</div>
<?php endforeach; ?>
<?php else :?>
<?php if ('open' == $post->comment_status) : ?>
<?php else :?>
<p class="nocomments"><?php _e('Comments are closed.', 'kubrick'); ?></p>
<?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<?php else : ?>
<p class="title"><span>この記事にコメントする</span></p>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
<?php else : ?>
<dl>
<dt><label for="author"><?php _e('お名前', 'kubrick'); ?> <?php if ($req) _e("", "kubrick"); ?></label><span class="require">必須</span></dt>
<dd><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /></dd>
<dt><label for="email"><?php _e('メールアドレス', 'kubrick'); ?> <?php if ($req) _e("", "kubrick"); ?></label><span class="require">必須</span></dt>
<dd><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" /></dd>
</dl>
<?php endif;?>
<dl>
<dt>本文<span class="require">必須</span></dt>
<dd><textarea name="comment" id="comment" cols="" rows=""></textarea></dd>
</dl>
<p class="btn-submit"><input name="submit" type="submit" id="submit" value="<?php _e('コメントを送信', 'kubrick'); ?>" /></p>
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif;?>
<?php endif;?>
</div>
<ul class="list-notice-01">
<li><span>※</span>承認制のため、即時には反映されません。</li>
</ul>
