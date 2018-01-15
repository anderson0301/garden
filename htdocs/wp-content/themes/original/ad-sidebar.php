<?php $myAmp = false; $string = $post->post_content;if($_GET['amp'] === '1' && strpos($string,'<script>') === false && is_single()){$myAmp = true;}?>
<?php if(!$myAmp): ?>
<div class="ad-sidebar"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2374938888047560" data-ad-slot="6999020497" data-ad-format="rectangle"></ins>
<script>(adsbygoogle = window.adsbygoogle||[]).push({});</script></div>
<?php endif; ?>