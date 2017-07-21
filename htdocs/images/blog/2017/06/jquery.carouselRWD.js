/*-------------------------------------------------------------------------
jquery.carouselRWD.js
MIT-style license. 
version 1.0
2017 Masa 
http://web-diy.rdy.jp/
--------------------------------------------------------------------------*/
$(function(){

    $.fn.carouselRWD = function(options) {
        
        'use scrict';
        
		//グローバル変数
        var $speed,
            $interval,
            $indicatorFlag,
            $loopFlag,
            $currentNum = 1;
        
        //デフォルト値
        var $settings = $.extend( {
            $speed:500,
            $interval:3000,
            $indicatorFlag:true,
            $loopFlag:true
        }, options);
        
        return this.each(function() {
            
            //セレクタを変数に格納
            var $tgt = $(this),
                $view = $tgt.find('.carousel-view'),
                $viewContents = $view.find('.carousel-contents'),
                $viewContentsItem = $viewContents.find('.item'),
                $viewContentsItemImg = $viewContentsItem.find('img'),
                $indicator = $tgt.find('ul.list-indicator'),
                $btnPrev = $tgt.find('p.prev a'),
                $btnNext = $tgt.find('p.next a'),
                $viewContentsItemLength = $viewContentsItem.length,
                $viewContentsItemWidth = $viewContentsItem.width(),
                $viewContentsItemImgWidth = $viewContentsItemImg.width();
			
			//タイマー用変数を宣言
            var $resizeTimer = false,
                $autoTimer;

            //自動スライド関数
            var autoLoad = function(){
                $autoTimer = setInterval(function(){
                    rollNext();
                }, $settings.$interval);
            };
            
			//ループ有の場合は自動スライド実行
            if($settings.$loopFlag === true){
                autoLoad();
            }
            
            //DOM生成（2個以上）
            if($viewContentsItemLength > 1){
                
                //インジケーター表示
                if($settings.$indicatorFlag === true){
                    for(var i = 1;i <= $viewContentsItemLength;i++){
                        $indicator.append('<li><a href="#">'+ i +'枚目</a></li>');
                    }
                }
                $indicator.find('li').first().addClass("current");
                
                //ループ無対応
                if($settings.$loopFlag === false){
                    $btnPrev.parent().hide();
                }

                //スタイリング
                $viewContentsItem.css('width', $viewContentsItemImgWidth);
                $viewContentsItem.first().clone().addClass("clone-f").appendTo($viewContents);
                $viewContentsItem.last().clone().addClass("clone-l").prependTo($viewContents);
                $viewContents.find('.clone-l').next().addClass("current");
                $viewContents.css('width', $viewContentsItemWidth * ($viewContentsItemLength + 2));
                $viewContents.css('left', - $viewContentsItemWidth);
            }
            
            //DOM生成（1個）
            if($viewContentsItemLength === 1){
                $btnPrev.parent().remove();
                $btnNext.parent().remove();
                $indicator.remove();
            }
            
            //右回転
            var rollNext = function(){
                clearInterval($autoTimer);
                if(!$viewContents.is(":animated")){
                    $currentNum++;
                    $viewContents.find('.current').removeClass('current').next().addClass('current');
                    $indicator.find('.current').removeClass('current');
                    $indicator.find('li').eq($currentNum - 1).addClass('current');
                    if($currentNum > $viewContentsItemLength){
                        $indicator.find('li').eq(0).addClass('current');    
                    }
                    $viewContents.animate({ 'left': - $viewContentsItemWidth * $currentNum,
                    }, $settings.$speed, function() {
                        if($currentNum > $viewContentsItemLength){
                            $viewContents.find('.current').removeClass('current');
                            $viewContents.find('.clone-l').next().addClass("current");
                            $viewContents.css('left', - $viewContentsItemWidth);
                            $currentNum = 1;
                        }
                    });
                }
                
                //ループ無対応
                if($settings.$loopFlag === false){
                    if($currentNum === $viewContentsItemLength){
                        $btnNext.parent().hide();
                    }
                    if($currentNum !== 1){
                        $btnPrev.parent().show();
                    }
                }
                
                autoLoad();
            };
            
            //左回転
            var rollPrev = function(){
                clearInterval($autoTimer);
                if(!$viewContents.is(":animated")){
                    $currentNum--;
                    $viewContents.find('.current').removeClass('current').prev().addClass('current');
                    $indicator.find('.current').removeClass('current');
                    $indicator.find('li').eq($currentNum - 1).addClass('current');
                    if($currentNum > $viewContentsItemLength){
                        $indicator.find('li').eq(0).addClass('current');    
                    }
                    $viewContents.animate({ 'left': - $viewContentsItemWidth * $currentNum,
                    }, $settings.$speed, function() {
                        if($currentNum < 1){
                            $viewContents.find('.current').removeClass('current');
                            $viewContents.find('.clone-f').prev().addClass("current");
                            $viewContents.css('left', - $viewContentsItemWidth * $viewContentsItemLength);
                            $currentNum = $viewContentsItemLength;
                        }
                    });
                }
                
                //ループ無対応
                if($settings.$loopFlag === false){
                    if($currentNum === 1){
                        $btnPrev.parent().hide();
                    }
                    if($currentNum !== 1){
                        $btnNext.parent().show();
                    }
                }
            };
            
            //右クリック
            $btnNext.click(function(){
                rollNext();
                clearInterval($autoTimer);
                return false;
            });
            
            //左クリック
            $btnPrev.click(function(){
                rollPrev();
                return false;
            });
            
            //インジケータークリック
            $indicator.find('li a').click(function(){
                clearInterval($autoTimer);
                if(!$viewContents.is(":animated")){
                    var $indicatorIndex = $(this).parent().index() + 1;
                    $currentNum = $indicatorIndex;
                    $indicator.find('.current').removeClass('current');
                    $(this).parent().addClass('current');
                    $viewContents.find('.current').removeClass('current');
                    $viewContentsItem.eq($currentNum - 1).addClass('current');
                    $viewContents.animate({ 'left': - $viewContentsItemWidth * $currentNum,
                    }, $settings.$speed, function() {});
                }
                
                //ループ無対応
                if($settings.$loopFlag === false){
                    if($currentNum === 1){
                        $btnPrev.parent().hide();
                        $btnNext.parent().show();
                    }
                    if($currentNum === $viewContentsItemLength){
                        $btnNext.parent().hide();
                    }
                    if($currentNum > 1 && $currentNum < $viewContentsItemLength){
                        $btnPrev.parent().show();
                        $btnNext.parent().show();
                    }
                }
                
                return false;
                e.preventDefault();
            });
            
            //マウスオーバー時は自動スライド停止
            $view.hover(function(){
                clearInterval($autoTimer);
            }, function(){
                if($settings.$loopFlag === true){
                    autoLoad();
                }
            });
            $indicator.find('li a').hover(function(){
                clearInterval($autoTimer);
            }, function(){
                if($settings.$loopFlag === true){
                    autoLoad();
                }
            });
            
            //リサイズ処理
            $(window).resize(function() {
                if ($resizeTimer !== false) {
                    clearTimeout($resizeTimer);
                }
                $resizeTimer = setTimeout(function() {
                    $viewContents.find('div.item').css('width','auto');
                    $viewContents.css('width','auto').css('left','auto');
                    $viewContentsItemWidth = $viewContentsItem.width();
                    $viewContentsItemImgWidth = $viewContentsItemImg.width();
                    $viewContents.find('div.item').css('width', $viewContentsItemImgWidth);
                    $viewContents.css('width', $viewContentsItemWidth * ($viewContentsItemLength + 2));
                }, 100);
            });
            
            //フリック対応
            $viewContents.on({
                'touchstart': function(e) {
                    this.startX = e.originalEvent.changedTouches[0].pageX;
                    this.startY = e.originalEvent.changedTouches[0].pageY;
                    this.touchX = e.originalEvent.changedTouches[0].pageX;
                    this.slideX = $(this).position().left;
                },
                'touchmove': function(e) {
                    var $moveX = this.startX - e.originalEvent.changedTouches[0].pageX;
                    var $moveY = this.startY - e.originalEvent.changedTouches[0].pageY;
                    var $moveRate = $moveX / $moveY;
                    if($moveRate > Math.tan(15 * Math.PI/180)) {
                        e.originalEvent.preventDefault();
                    }
                    this.slideX = this.slideX - (this.touchX - e.originalEvent.changedTouches[0].pageX);
                    $(this).css({left:this.slideX});
                    this.touchX = e.originalEvent.changedTouches[0].pageX;
                },
                'touchend': function(e) {
                    var $diff = this.startX - this.touchX;
                    
                    //ループ無かつカウントが1かつ左フリックだったら位置を戻す
                    if($settings.$loopFlag === false && $currentNum === 1 && $diff < 0){
                        $(this).animate({left:this.slideX + $diff});
                    }
                    
                    //ループ無かつカウントが最上値かつ右フリックだったら位置を戻す
                    if($settings.$loopFlag === false && $currentNum === $viewContentsItemLength && $diff > 0){
                        $(this).animate({left:this.slideX + $diff});
                    }
                    
                    //左フリックが-50px以下だったらアニメーション
                    else if ($diff < -50) {
                        rollPrev();
                    }
                    
                    //右フリックが-50px以下だったらアニメーション
                    else if(50 < $diff){
                        rollNext();
                        
                        //ループフラグがfalseだったら自動再生は停止
                        if($settings.$loopFlag === false){
                            clearInterval($autoTimer);
                        }
                    }
                    
                    //上記以外は位置を戻す                    
                    else{
                        $(this).animate({left:this.slideX + $diff});
                    }
                }
            });
        });
    };
});