(function(){

/* ==================================
** 高さ揃え
** =================================*/
$(function(){
  $('.grid-3').find('.col').find('.bd-type-01').matchHeight();
  $('.grid-2').find('.col').find('.bd-type-01').matchHeight();
  $('.grid-3 > .col').matchHeight();
  $('.grid-2 > .col').matchHeight();
  $('ul.list-link-thum').find('li').matchHeight();
});

/* ==================================
** サイドバートグル
** =================================*/
$(function(){
  $('p.more').on('click','a',function(event){
    event.preventDefault();
    var $className = 'open';
    var $moreContents = $(this).parent().prev().find("li:gt(4)");
    if($(this).hasClass($className)){
      $(this).removeClass($className).text("さらに見る").parent().prev().find("li:eq(4)").removeClass("child-05");
      $moreContents.stop().slideUp('fast');
    }else{
      $(this).addClass($className).text("閉じる").parent().prev().find("li:eq(4)").addClass("child-05");
      $moreContents.stop().slideDown('fast');
    }
  });
});

/* ==================================
** サイドバー固定
** =================================*/
$(window).on("load scroll resize",function(){

  var sidebarFix = function(){

    //スクロールバー込みの画面幅
    var w = window.innerWidth;

    //サイドバー有無の境界幅
    var x = 851;

    //対象のサイドバー
    var $tgt = $('#nav-sidebar-inner.js-fix');

    if(w >= x){

      //各要素の高さを取得 
      var $winH = $(window).height();//ウィンドウの高さ
      var $pageH = $('body').height();//bodyの高さ
      var $headerH = $('header').outerHeight(true);//ヘッダーの高さ
      var $mainH = $('#main-inner').outerHeight(true);//メインカラムの高さ
      var $sideH = $tgt.outerHeight(true);//サイドバーの高さ
      var $footerH = $('footer').outerHeight(true);//フッターの高さ
      var $paddingH = $('#content').outerHeight(true) - $('#content').height();//余白の高さ

      //サイドバーの固定と解除条件を計算 
      var $fixedSide = ($headerH + $paddingH + $sideH) - $winH;//サイドバーを固定するスクロール高さ
      var $scrollBtm = $pageH - $winH - $footerH ;//フッターが画面に表示されるスクロール高さ

      //スクロール値を取得
      var $scrollTop = $(this).scrollTop();

      //記事がサイドバーより長い場合実行
      if($mainH > $sideH){

        //サイドバー下端までスクロールしたらサイドバー下端で追従
        if($scrollTop > $fixedSide){

          //サイドバー固定のクラス付与
          $tgt.addClass('fixed-side').css('bottom',0);

          //サイドバー固定時のサイドバー幅を計算
          var $sidebarW = $('#nav-sidebar').width();

          //計算したサイドバー幅を付与
          $tgt.css("width",$sidebarW);

        //条件から外れたら固定クラスを削除し幅をリセット
        }else{

          //サイドバー固定のクラス削除
          $tgt.removeClass('fixed-side');

          //サイドバー幅リセット
          $tgt.css('width','auto');
        }
        //フッターまでスクロールしたらサイドバー下端をフッター上端に連結
        if($scrollTop > $scrollBtm){
          $tgt.removeClass('fixed-side').css('bottom',0);
          $tgt.addClass('bottom-side').css('bottom',$footerH);

        //条件から外れたらクラスを削除
        }else{
          $tgt.removeClass('bottom-side').css('bottom',0);
        }
      }

    //サイドバーがない場合に適用
    }else{
      $tgt.css('width','auto');
    }

  };sidebarFix();

});

/* ==================================
** ページスクロール
** =================================*/
$(function(){
  $("p.page_top").hide();
  $(window).on("scroll",function(){

    if($(this).scrollTop() > 100){
      $('p.page_top').fadeIn();
    }else{
      $('p.page_top').fadeOut();
    }

    var $scrollH = $(document).height(); 
    var $scrollPosition = $(window).height() + $(window).scrollTop(); 
    var $footerH = $("footer").innerHeight();
    if($scrollH - $scrollPosition <= $footerH){
      $("p.page_top").css({
        "position":"absolute",
        "bottom":$footerH + 20
      });
    }else{
      $("p.page_top").css({
        "position":"fixed",
        "bottom":"20px"
      });
    }
  });
  $('p.page_top a').click(function(){
    $('body,html').animate({
      scrollTop:0
    },500);
    $(this).removeClass('hover');
    return false;
  });

  $('p.page_top a').hover(function(){
    $(this).addClass('hover');
  },function(){
    $(this).removeClass('hover');
  });
});

/* ==================================
** グローバルナビカレント表示
** =================================*/
$(function(){
  var dir = location.href.split('/');
  if(dir&&dir[3]){
    $('body').addClass("g-"+dir[3]);
  }
});

/* ==================================
** サイドバーアーカイブリストカレント表示
** =================================*/
$(function(){
  var $pathName = location.pathname;
  $('dl.archive dd ul').find('li').find('a').each(function(){
    var $href = $(this).attr("href");
    if($pathName.indexOf($href) != -1){
      $(this).parent().addClass("current");
    }
  });
});

/* ==================================
** ハンバーガーメニュー
** =================================*/
$(function(){
  $('p#sp-utility-btn').one('click',function(){
    $("body").append('<div id="overlay"></div>');
  });
  $('p#sp-utility-btn').click(function(){
    $(this).toggleClass('open');
    $('#sp-drawer-utility').toggleClass('fadein');
    $('#overlay').toggleClass('fadein');
  });
});

/* ==================================
** クリックイベント計測
** =================================*/
$(function(){

  //さらに見る（最新記事）
  $('ul.whatsnew').next().find('a').click(function(){
    ga('send','event','whatsnew','click','more');
  });
  
  //さらに見る（人気記事）
  $('ol.rank').next().click(function(){
    ga('send','event','rank','click','more');
  });

});

})(jQuery);
/* ==================================
** Plugin
** =================================*/
//jquery-match-height master by @liabru
//http://brm.io/jquery-match-height/
//License: MIT
(function(a){if(typeof define==="function"&&define.amd){define(["jquery"],a)}else{if(typeof module!=="undefined"&&module.exports){module.exports=a(require("jquery"))}else{a(jQuery)}}})(function(h){var b=-1,g=-1;var e=function(i){return parseFloat(i)||0};var f=function(m){var i=1,k=h(m),j=null,l=[];k.each(function(){var n=h(this),p=n.offset().top-e(n.css("margin-top")),o=l.length>0?l[l.length-1]:null;if(o===null){l.push(n)}else{if(Math.floor(Math.abs(j-p))<=i){l[l.length-1]=o.add(n)}else{l.push(n)}}j=p});return l};var d=function(i){var j={byRow:true,property:"height",target:null,remove:false};if(typeof i==="object"){return h.extend(j,i)}if(typeof i==="boolean"){j.byRow=i}else{if(i==="remove"){j.remove=true}}return j};var a=h.fn.matchHeight=function(i){var k=d(i);if(k.remove){var j=this;this.css(k.property,"");h.each(a._groups,function(l,m){m.elements=m.elements.not(j)});return this}if(this.length<=1&&!k.target){return this}a._groups.push({elements:this,options:k});a._apply(this,k);return this};a.version="master";a._groups=[];a._throttle=80;a._maintainScroll=false;a._beforeUpdate=null;a._afterUpdate=null;a._rows=f;a._parse=e;a._parseOptions=d;a._apply=function(o,k){var m=d(k),l=h(o),n=[l];var p=h(window).scrollTop(),j=h("html").outerHeight(true);var i=l.parents().filter(":hidden");i.each(function(){var q=h(this);q.data("style-cache",q.attr("style"))});i.css("display","block");if(m.byRow&&!m.target){l.each(function(){var q=h(this),r=q.css("display");if(r!=="inline-block"&&r!=="flex"&&r!=="inline-flex"){r="block"}q.data("style-cache",q.attr("style"));q.css({display:r,"padding-top":"0","padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px",overflow:"hidden"})});n=f(l);l.each(function(){var q=h(this);q.attr("style",q.data("style-cache")||"")})}h.each(n,function(s,t){var r=h(t),q=0;if(!m.target){if(m.byRow&&r.length<=1){r.css(m.property,"");return}r.each(function(){var u=h(this),w=u.attr("style"),x=u.css("display");if(x!=="inline-block"&&x!=="flex"&&x!=="inline-flex"){x="block"}var v={display:x};v[m.property]="";u.css(v);if(u.outerHeight(false)>q){q=u.outerHeight(false)}if(w){u.attr("style",w)}else{u.css("display","")}})}else{q=m.target.outerHeight(false)}r.each(function(){var v=h(this),u=0;if(m.target&&v.is(m.target)){return}if(v.css("box-sizing")!=="border-box"){u+=e(v.css("border-top-width"))+e(v.css("border-bottom-width"));u+=e(v.css("padding-top"))+e(v.css("padding-bottom"))}v.css(m.property,(q-u)+"px")})});i.each(function(){var q=h(this);q.attr("style",q.data("style-cache")||null)});if(a._maintainScroll){h(window).scrollTop((p/j)*h("html").outerHeight(true))}return this};a._applyDataApi=function(){var i={};h("[data-match-height], [data-mh]").each(function(){var k=h(this),j=k.attr("data-mh")||k.attr("data-match-height");if(j in i){i[j]=i[j].add(k)}else{i[j]=k}});h.each(i,function(){this.matchHeight(true)})};var c=function(i){if(a._beforeUpdate){a._beforeUpdate(i,a._groups)}h.each(a._groups,function(){a._apply(this.elements,this.options)});if(a._afterUpdate){a._afterUpdate(i,a._groups)}};a._update=function(k,j){if(j&&j.type==="resize"){var i=h(window).width();if(i===b){return}b=i}if(!k){c(j)}else{if(g===-1){g=setTimeout(function(){c(j);g=-1},a._throttle)}}};h(a._applyDataApi);h(window).bind("load",function(i){a._update(false,i)});h(window).bind("resize orientationchange",function(i){a._update(true,i)})});