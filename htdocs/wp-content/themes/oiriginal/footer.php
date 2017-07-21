<?php $myAmp = false; $string = $post->post_content;if($_GET['amp'] === '1' && strpos($string,'<script>') === false && is_single()){$myAmp = true;}?>
<p class="page_top"><a href="#">ページの先頭に戻る</a></p>
<footer>
<p>&copy;2016 Web屋の芝生DIY All rights reserved.</p>
</footer>
<?php if(!$myAmp): ?>
<script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="/shared/js/init.js"></script>
<script src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');ga('create', 'UA-83820519-1', 'auto');ga('send', 'pageview');
</script>
<?php endif; ?>
<?php if($myAmp): ?>
<amp-pixel src="//ssl.google-analytics.com/collect?v=1&amp;tid=UA-83820519-1&amp;t=pageview&amp;cid=$RANDOM&amp;dt=$TITLE&amp;dl=$CANONICAL_URL&amp;z=$RANDOM"></amp-pixel>
<?php endif; ?>
</body>
</html>