<?php $myAmp = false;$string = $post->post_content;if($_GET['amp'] === '1' && strpos($string,'<script>') === false && is_single()){$myAmp = true;}?>
<header>
<div id="header-inner">
<?php if($myAmp): ?>
<p id="logo"><a href="/"><amp-img src="/shared/images/logo.png" width="240" height="28"></amp-img></a></p>
<?php else: ?>
<p id="logo"><a href="/"><img src="/shared/images/logo.png" alt="Web屋の芝生DIY"></a></p> 
<?php endif; ?>
<p id="tagline">芝生やDIY等のライフハックやWeb制作情報を発信するメディア</p>
<?php if(!$myAmp): ?>
<p id="sp-search-btn">検索窓を開く</p>
<form method="get" action="<?php echo home_url('/'); ?>" >
<input id="text" type="text" value="" name="s" placeholder="キーワード">
<input id="btn" type="image" src="/shared/images/btn_search.png" alt="検索する">
</form>
<?php endif; ?>
<ul class="utility">
<li><a href="/about/">サイトについて</a></li>
<li><a href="/contact/">お問い合わせ</a></li>
<li><a href="/sitemap/">サイトマップ</a></li>
</ul>
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