(function () {

/* ==================================
** 高さ揃え
** =================================*/
$(function(){
  $('.grid-3').find('.col').find('.bd-type-01').matchHeight();
  $('.grid-2').find('.col').find('.bd-type-01').matchHeight();
  $('.grid-3 > .col').matchHeight();
  $('.grid-2 > .col').matchHeight();
  $('ul.list-link-thum').find('li').matchHeight();
  $('ul.list-prev-next').find('li').matchHeight();
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

    scrollHeight = $(document).height(); 
    scrollPosition = $(window).height() + $(window).scrollTop(); 
    footHeight = $("footer").innerHeight();
    if(scrollHeight - scrollPosition <= footHeight){
      $("p.page_top").css({
        "position":"absolute",
        "bottom": footHeight + 20
      });
    }else{
      $("p.page_top").css({
        "position":"fixed",
        "bottom":"20px"
      });
    }
  });
 
  $('p.page_top').find('a').click(function(){
    $('body,html').animate({
      scrollTop:0
    },500);
    return false;
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
    if ($pathName.indexOf($href) != -1) {
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
** サイドバートグルボタン
** =================================*/
$(function(){

  //新着情報、人気記事
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

  //アーカイブ
  $('p.more2').on('click','a',function(event){
    event.preventDefault();
    var $className = 'open';
    var $moreContentsTitle = $(this).parent().prev().find("dt:gt(0)");
    var $moreContentsArticle = $(this).parent().prev().find("dd:gt(0)");
    if($(this).hasClass($className)){
      $(this).removeClass($className).text("さらに見る");
      $moreContentsTitle.stop().slideUp('fast');
      $moreContentsArticle.stop().slideUp('fast');
    }else{
      $(this).addClass($className).text("閉じる");
      $moreContentsTitle.stop().slideDown('fast');
      $moreContentsArticle.stop().slideDown('fast');
    }
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