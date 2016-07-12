// JavaScript Document

$(function(){
    var $win = $(window),
        $header = $('header'),
        $main = $('.wrapper'),
		_mainHeight = $main.outerHeight();
    
    $win.scroll(function(){
        var winScrollTop = $win.scrollTop();
        
        if(winScrollTop > 100){
			$header.css({position:'fixed', width:'100%', top:0, background:'rgba(255,255,255,.95)', boxShadow:'0 3px 3px rgba(0,0,0,.1)'});
			$('.gotop').show();
			$('.submenu').css({marginTop:'90px'});
        }else{
			$header.css({position:'relative', width:'auto', top:'auto', background:'rgba(255,255,255,1)', boxShadow:'0 0 0 rgba(0,0,0,0)'});
			$('.gotop').hide();
			$('.submenu').css({marginTop:''});
        }
		
		if(winScrollTop > 100 && $win.width() > 800){
			$main.find('h1 a').css({height:(_mainHeight)-30});	
			$main.css({height:(_mainHeight)-30});
		}else{
			$main.find('h1 a').css({height:_mainHeight});
			$main.css({height:_mainHeight});
		}

    });

});