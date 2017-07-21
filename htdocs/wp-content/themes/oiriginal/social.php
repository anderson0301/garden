<?php
/*
Template Name:ソーシャル
*/
?>
<?php $url_encode=urlencode(get_permalink());$title_encode=urlencode(get_the_title());?>
<div class="social">
<dl>
<dt><span>このページをシェアする！</span></dt>
<dd>
<ul>
<li class="tw"><a href="http://twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&tw_p=tweetbutton" target="_blank"><i class="fa fa-twitter"></i>Twitter<span class="sns_count"><?php if(function_exists('get_scc_twitter')) echo get_scc_twitter(); ?></span></a></li>
<li class="fb"><a href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><i class="fa fa-facebook-square"></i>Facebook<span class="sns_count"><?php if(function_exists('get_scc_facebook')) echo get_scc_facebook(); ?></span></a></li>
<li class="go"><a href="https://plus.google.com/share?url=<?php echo $url_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=500');return false;"><i class="fa fa-google-plus"></i>Google+<span class="sns_count"><?php if(function_exists('get_scc_gplus')) echo get_scc_gplus(); ?></span></a></li>
<li class="ht"><a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $url_encode ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=510');return false;"><i class="fa fa-hatena"></i>はてブ<span class="sns_count"><?php if(function_exists('get_scc_hatebu')) echo (get_scc_hatebu()==0)?'0':get_scc_hatebu(); ?></span></a></li>
<li class="po"><a href="http://getpocket.com/edit?url=<?php echo $url_encode;?>&title=<?php echo $title_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">Pocket<span class="sns_count"><?php if(function_exists('scc_get_share_pocket')) echo (scc_get_share_pocket()==0)?'0':scc_get_share_pocket(); ?></span></a></li>
<li class="fe"><a href="http://feedly.com/index.html#subscription%2Ffeed%2Fhttp%3A%2F%2web-diy.rdy.jp%2Ffeed%2F" target="blank"><i class="fa fa-rss"></i>feedly<span class="sns_count"><?php if(function_exists('scc_get_follow_feedly')) echo (scc_get_follow_feedly()==0)?'0':scc_get_follow_feedly(); ?></span></a></li>
</ul>
</dd>
</dl>
</div>