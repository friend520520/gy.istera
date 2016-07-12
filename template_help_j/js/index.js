
$("document").ready(function() {
        
        
        
        
        get_page_info();
        more_event();
        
	$('.week-author a').eq(0).click(function(e) {
		$(this).addClass('active');
		$('.week-author a').eq(1).removeClass('active');
                $('ul.hot-rank').eq(1).show();
                $('ul.hot-rank').eq(0).hide();
        });
	$('.week-author a').eq(1).click(function(e) {
		$(this).addClass('active');
		$('.week-author a').eq(0).removeClass('active');
                $('ul.hot-rank').eq(0).show();
                $('ul.hot-rank').eq(1).hide();
        });
        
});


function get_page_info(){
        
        var data = { };
        var success_back = function( data ) {

                data = JSON.parse( data );
                console.log(data);
                loading_ajax_hide();
                if( data.success ) {
                        //最新發表++
                        var tmp="", tmp2="", length, title;
                        console.log( $( "#tab1" ).width() );
                        $.each( data.data.new_page , function( index , value ){
                                length = parseInt( $( "#tab1" ).width() - 20 - 16*value.cate_name.length - 4*2 - 5 ) / 15*2;
                                title = getStrLength(value.p_title) <= length ? value.p_title : getInterceptedStr( value.p_title , length-3 ) + "...";
                                tmp += '<li>\n\
                                            <span style="background-color:' + value.cate_color + '">' + value.cate_name + '</span>\n\
                                            <a title="' + value.p_title + '" href="v_article_info.php?p=' + value.page_id + '">\n\
                                            ' + title + '\n\
                                            </a>\n\
                                        </li>';
                                //var title = getStrLength(data.title) <= length ? data.title : getInterceptedStr( data.title , length-3 ) + "...";
                                tmp2 += '<div class="item">\n\
                                            <a href="v_article_info.php?p=' + value.page_id + '">\n\
                                                <div class="res_div2">\n\
                                                    <div style="background-image:url(\''+website_page_url+value.page_id+'/ThumbnailM/'+value.p_icon+'\')"></div>\n\
                                                </div>\n\
                                                <b>' + value.p_title + '</b></a>' +
					'	<hr>' +
					'	<div>' +
					'	<p>' + value.p_pre_html + '</p>' +
					'	</div>' +
					'</div>';
                        });
                        $( "#tab1>.news-list" ).html( tmp );
                        $( "#left-banner-turn" ).html( tmp2 );
                        //左邊圖片輪播
                        var owl=$("#left-banner-turn");
                        owl.owlCarousel({
                                //autoPlay:6000,
                                slideSpeed:800,
                                pagination:true,
                                navigation:false,
                                singleItem:true,
                                transitionStyle:"fade"
                        });
                        
                        $( "#left-banner-turn .owl-item > .item > div" ).height( parseInt(( $( "#left-banner-turn" ).height() - $( ".owl-item > .item > a" ).height() - 9 - 20 - 5 )/23)*23 + 5 );
                        //最新發表--
                        //昨日熱門++
                        tmp = "";
                        $.each( data.data.last_hot_page , function( index , value ){
                                length = parseInt( $( "#tab1" ).width() - 20 - 16*value.cate_name.length - 4*2 - 5 ) / 15*2;
                                title = getStrLength(value.p_title) <= length ? value.p_title : getInterceptedStr( value.p_title , length-3 ) + "...";
                                tmp += '<li>\n\
                                            <span style="background-color:' + value.cate_color + '">' + value.cate_name + '</span>\n\
                                            <a title="' + value.p_title + '" href="v_article_info.php?p=' + value.page_id + '">\n\
                                                ' + title + '\n\
                                            </a>\n\
                                        </li>';
                        });
                        $( "#tab2>.news-list" ).html( tmp );
                        //昨日熱門--
                        //本周熱門++
                        tmp = "";
                        $.each( data.data.this_week_hot_page , function( index , value ){
                                length = parseInt( $( "#tab1" ).width() - 20 - 16*value.cate_name.length - 4*2 - 5 ) / 15*2;
                                title = getStrLength(value.p_title) <= length ? value.p_title : getInterceptedStr( value.p_title , length-3 ) + "...";
                                tmp += '<li>\n\
                                            <span style="background-color:' + value.cate_color + '">' + value.cate_name + '</span>\n\
                                            <a title="' + value.p_title + '" href="v_article_info.php?p=' + value.page_id + '">\n\
                                                ' + title + '\n\
                                            </a>\n\
                                        </li>';
                        });
                        $( "#tab3>.news-list" ).html( tmp );
                        //本周熱門--
                        //本周人氣++
                        tmp = "";
                        $.each( data.data.this_week_hot_ch , function( index , value ){
                                tmp2 = index <= 2 ? " class='medal-" + (index+1) + "'" : "";
                                tmp += '<li>' +
                                        '    <a href="v_hot-rank.php?ch=' + value.ch_id + '">' +
                                        '        <div class="bg_middle" style="background-image:url(\'' +website_channel_url+value.ch_id+"/"+value.ch_icon+ '\')"></div>' +
                                        '        <p><span' + tmp2 + '>' + (index+1) + '</span>' + value.ch_name + '</p>' +
                                        '        <p class="click">' + value.ch_cliw_click_num + ' 點閱</p>' +
                                        '    </a>' +
                                        '</li>';
                        });
                        $( ".hot-rank:eq(0)" ).html( tmp );
                        //本周人氣--
                        //本周活耀++
                        tmp = "";
                        $.each( data.data.this_week_activity_ch , function( index , value ){
                                tmp2 = index <= 2 ? " class='medal-" + (index+1) + "'" : "";
                                tmp += '<li>' +
                                        '    <a href="v_hot-rank.php?ch=' + value.ch_id + '">' +
                                        '        <div class="bg_middle" style="background-image:url(\'' +website_channel_url+value.ch_id+"/"+value.ch_icon+ '\')"></div>' +
                                        '        <p><span' + tmp2 + '>' + (index+1) + '</span>' + value.ch_name + '</p>' +
                                        '        <p class="click">' + value.ch_postw_num + ' 篇發文</p>' +
                                        '    </a>' +
                                        '</li>';
                        });
                        $( ".hot-rank:eq(1)" ).html( tmp );
                        //本周活耀--
                        //原創文章++
                        tmp = "";
                        length = parseInt( $( ".video > ul > li" ).width()/13 ) * 2*2;
                        $.each( data.data.originality_page , function( index , value ){
                                tmp2 = getStrLength(value.p_title) <= length ? value.p_title : getInterceptedStr( value.p_title , length-3 ) + "...";
                                tmp += '<li>' +
                                        '    <a href="v_article_info.php?p=' + value.page_id + '">' +
                                        '        <div class="bg_middle" style="background-image:url(\''+website_page_url+value.page_id+'/ThumbnailM/'+value.p_icon+'\')"></div>' +
                                        '    </a>' +
                                        '    <a href="v_article_info.php?p=' + value.page_id + '">' +
                                            '    <div class="title" title="'+value.p_title+'">' + tmp2 + '</div>' +
                                        '    </a>' +
                                        '</li>';
                        });
                        $( ".video > ul" ).html( tmp );
                        //原創文章--
                        //所有頻道依頻道分類顯示++
                        $.each( data.data.channel , function( index , value ){
                                
                                tmp = "";
                                $.each( value , function( index2 , value2 ){
                                        tmp += '<li>' +
                                               '     <a href="v_hot-rank.php?ch=' + value2.ch_id + '">' +
                                                        '<div alt="Owl Image" class="res_div3">\n\
                                                            <div style="background-image:url(\'' +website_channel_url+value2.ch_id+"/"+value2.ch_icon+ '\')"></div>\n\
                                                        </div>\n\
                                                        <p>' + value2.ch_name + '</p>' +
                                               '     </a>' +
                                               '</li>';
                                });
                                $( ".type-wrap > .type-content > .item > ul" ).eq( index ).html( tmp );
                        });
                        middle_eight_channel_category_effect();
                        //所有頻道依頻道分類顯示--
                        //$( "#left" ).css( "visibility" , "visible" );
                        //$( "#right" ).css( "visibility" , "visible" );
                        
                }
                else {
                        show_remind( data.msg , "error" );
                }

        }
        var error_back = function( data ) {
                console.log(data);
        }
        $.Ajax( "POST" , "php/index.php?func=get_homepage" , data , "" , success_back , error_back);
        
}

function more_event(){
        
        $( "#tab1 .more" )
}

function middle_eight_channel_category_effect(){
        
        //中間8個種類頁籤效果
        var sync1 = $(".type-content");
        var sync2 = $(".type-tab");

        sync1.owlCarousel({
            singleItem:true,
            slideSpeed:1000,
            navigation:false,
            pagination:false,
            afterAction:syncPosition,
            responsiveRefreshRate:200,
        });

        sync2.owlCarousel({
            items:8,
            itemsDesktopSmall:[1024,8],
            itemsTablet      :[768,4],
            itemsMobile      :[480,2],
            pagination:false,
            responsiveRefreshRate:100,
            afterInit : function(el){
                el.find(".owl-item").eq(0).addClass("synced");
            }
        });

        $(".type-tab").on("click", ".owl-item", function(e){
            e.preventDefault();
            var number = $(this).data("owlItem");
            sync1.trigger("owl.goTo",number);
        });
        
}

function syncPosition(el){
    var current = this.currentItem;
    $(".type-tab")
        .find(".owl-item")
        .removeClass("synced")
        .eq(current)
        .addClass("synced")
    if($(".type-tab").data("owlCarousel") !== undefined){
        center(current)
    }
}

function center(number){
    var sync2 = $(".type-tab");
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
        if(num === sync2visible[i]){
            var found = true;
        }
    }

    if(found===false){
        if(num>sync2visible[sync2visible.length-1]){
            sync2.trigger("owl.goTo", num - sync2visible.length+2)
        }else{
            if(num - 1 === -1){
                num = 0;
            }
            sync2.trigger("owl.goTo", num);
        }
    } else if(num === sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
        sync2.trigger("owl.goTo", num-1)
    }

}