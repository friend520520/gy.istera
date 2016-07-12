
$("document").ready(function() {
        
        //fb-comment
        $( ".fans-message" ).append( '<div class="fb-comments" data-href="' + location.href + '" data-width="100%" data-numposts="5"></div>' );
        
        //右邊分享box
        $( ".float-share" ).show();
        
        get_page_info();
        get_sidebar_this_week_hot();
        report_evnet();
        collect_evnet();
        track_evnet();
});


function get_page_info(){
        
        var data = {
                    token:      getCookie("help_cookie") ,
                    page : getParameterByName( "p" )
        };
        var success_back = function( data ) {

                data = JSON.parse( data );
                console.log(data);
                loading_ajax_hide();
                if( data.success ) {
                        $( ".icon3" ).attr( "href" , "v_hot-rank.php?ch=" + data.data.ch_id );
                        $( ".icon1" ).attr( "ch" , data.data.ch_id );
                        $( ".author dt .ch_icon" ).css( "background-image" , "url('" + data.data.ch_icon + "')" );
                        $( "#title > h1" ).html( data.data.p_title );
                        $( ".caption h2 > span" ).html( "觀看次數：" + data.data.p_click_num );
                        $( ".caption h2 > c" ).html( data.data.ch_name ).attr( "ch" , data.data.ch_id );
                        $( ".caption p b" ).html( "發表於 " + difference_now( data.data.p_date ) );
                        $( ".caption p span" ).html( data.data.p_date );
                        var html = data.data.p_pre_html ? data.data.p_pre_html : data.data.p_html;
                        $( "#editor > .word-info" ).html( html );
                        //推廣文章
                        if( data.data.ch_url ){
                                $( ".clipboard" ).attr( "data-clipboard-text" , data.data.ch_url + ".ggyyggy.com/funbook19/v_article_info.php?p=" + getParameterByName( "p" ) );
                                var client = new ZeroClipboard($(".clipboard"));
                                client.on('aftercopy', function(event) {  //套用 aftercopy 的 api
                                        show_remind( "已經複製到剪貼簿" );
                                });
                        }
                        else {
                                $( ".clipboard" ).bind( "click" , function(){
                                        remind_login();
                                });
                        }
                        //收藏
                        if( data.data.collect === "already" ){
                                $( '#collect_btn > h5' ).html( "取消收藏" );
                                $( '#collect_btn' ).attr( "action" , "cancel" );
                        }
                        else if( data.data.collect === "yet" ){
                                $( '#collect_btn > h5' ).html( "收藏" );
                                $( '#collect_btn' ).attr( "action" , "collect" );
                        }
                        else{
                                $( '#collect_btn > h5' ).html( "收藏" );
                                $( '#collect_btn' ).attr( "action" , "collect" );
                        }
                        //追蹤
                        if( data.data.track === "already" ){
                                $( '.icon1' ).html( "取消追蹤" );
                                $( '.icon1' ).attr( "action" , "cancel" );
                        }
                        else if( data.data.track === "yet" ){
                                $( '.icon1' ).html( "追蹤作者" );
                                $( '.icon1' ).attr( "action" , "track" );
                        }
                        else{
                                $( '.icon1' ).html( "追蹤作者" );
                                $( '.icon1' ).attr( "action" , "track" );
                        }
                        //process img path++
                        var src,tmp="";
                        $.each( $( "#editor > .word-info img" ) , function( index , value ){
                                src = $(value).attr("src");
                                src = "data/page/" + data.data.page_id + "/" + src;
                                $(value).attr("src",src);
                        });
                        //process img path--
                        //tag++
                        $.each( data.data.p_tag , function( index , value ){
                                tmp += '<a href="#"><li>' + value + '</li></a>';
                        });
                        $( ".info-category" ).html( tmp );
                        //tag--
                        //你也可能喜歡這些文章++
                        var ch_page_html1="",ch_page_html2="";
                        $.each( data.data.ch_page , function( index , value ){
                                tmp = '<li><a href="v_article_info.php?p=' + value.page_id + '">' + value.p_title + '</a></li>';
                                if( index%2 ){
                                    ch_page_html2 += tmp;
                                }
                                else{
                                    ch_page_html1 += tmp;
                                }
                        });
                        $( ".favorite-articles > ul:eq(0)" ).html( ch_page_html1 );
                        $( ".favorite-articles > ul:eq(1)" ).html( ch_page_html2 );
                        //你也可能喜歡這些文章--
                        //網友正在看++
                        tmp = "";
                        $.each( data.data.hot_page , function( index , value ){
                                tmp += '<div class="item">' +
                                            '<a href="v_article_info.php?p=' + value.page_id + '">' +
                                                '<div class="res_div">\n\
                                                        <div style="background-image:url(\'' + website_page_url+value.page_id+"/ThumbnailM/"+value.p_icon + '\')"></div>\n\
                                                </div>' +
                                                '<h5>' + value.p_title + '</h5>' +
                                            '</a>' +
                                        '</div>';
                        });
                        $( "#watching-turn" ).html( tmp );
                        $("#watching-turn").owlCarousel({
                                pagination:true,
                                navigation:false
                        });
                        //網友正在看--
                        //附件++
                        tmp = "";
                        $.each( data.data.page_file , function( index , value ){
                                
                                tmp += '<li file_id="' + value.pf_id + '">' +
                                            '文件描述:'+value.pf_des+'<br>' +
                                            '<a href="v_download.php?mod=attachment&&page='+data.data.page_id+'&file=' + value.pf_id + '" target="_blank" data-toggle="tooltip" title="' + value.pf_original_name + '">' + value.pf_original_name + '</a>' +
                                            '<em class="xg1"> (' + parseInt( value.pf_size/10.24 )/100 + ' KB, 下載次數: ' + value.pf_download_num + ') </em> 下載: G幣-5 ' +
                                        '</li>';
                                
                        });
                        $( "#file_download_place" ).html( tmp );
                        $('[data-toggle="tooltip"]').tooltip(); 
                        //附件--
                        $( "#left" ).css( "visibility" , "visible" );
                        $( "#right" ).css( "visibility" , "visible" );
                        
                }
                else {
                        loading_ajax_hide();
                        show_remind( data.msg , "error" );
                        // setTimeout( function(){ location.href = "v_index.php" }, 3000);
                }

        }
        var error_back = function( data ) {
                console.log(data);
        }
        $.Ajax( "POST" , "php/page.php?func=get_page_info" , data , "" , success_back , error_back);
        
}

function report_evnet(){
        
        // 檢舉浮出表單	
        $('#cover, #report').hide();


      
        $('#report-btn').click(function() {
                if( getCookie("help_cookie") ){
                        $('body').css('overflow-y','hidden');
                        console.log( 'hidden' );
                        $('#cover, #report, #cancel').fadeIn();
                }
                else{
                        show_remind( "請登入" );
                        if( $('#mobi-rbtn').css( "display" ) === "block" ){
                                $('#mobi-rbtn').click();
                        }
                        else if( $('.top > ul > li.login').css( "display" ) === "block" ){
                                $('.top > ul > li.login').trigger( "mouseenter" );
                        }
                }
        });
        
        $('#cancel').click(function() {
                $(this).hide();
                $('#cover, #report').hide();
                $('body').css('overflow-y','auto');
        });
        
        $( "#report [id=send]" ).bind( "click" , function(){
                
                var bool = true;
                var msg = "";
                
                if( !$( "#report_reason" ).val() ){
                        bool = false;
                        msg += msg === "" ? "請" : "、";
                        msg += "輸入原因";
                }
                
                if( $( "#report_input" ).val() ) {
                        $( "#report_input" ).parent().removeClass( "has-error" );
                }
                else {
                        bool = false;
                        $( "#report_input" ).parent().addClass( "has-error" );
                        msg += msg === "" ? "請" : "、";
                        msg += "輸入說明原因";
                }
                
                if( bool ){
                    
                        var data = {
                                    token: getCookie("help_cookie") ,
                                    page : getParameterByName( "p" ) ,
                                    r_reason : $( "#report_reason" ).val() ,
                                    r_explanation : $( "#report_input" ).val()
                        };
                        var success_back = function( data ) {

                                data = JSON.parse( data );
                                console.log(data);
                                loading_ajax_hide();
                                if( data.success ) {
                                        $('#cancel').click();
                                        $( "#report_input" ).val( "" );
                                        $( "#report_reason" ).val( "1" );
                                        if( data.data === "blockade" ){
                                            show_remind( "此文章被檢舉太多次，暫時關閉文章，三秒後轉跳到首頁。" );
                                            // setTimeout( function(){ location.href = "v_index.php" }, 3000);
                                        }
                                        else{
                                            show_remind( "檢舉成功" );
                                        }
                                }
                                else {
                                        show_remind( data.msg , "error" );
                                }

                        }
                        var error_back = function( data ) {
                                console.log(data);
                        }
                        $.Ajax( "POST" , "php/report.php?func=report" , data , "" , success_back , error_back);

                }
                else{
                        show_remind( msg , "error" );
                }
        });
        
}

function collect_evnet(){
        
        $('#collect_btn').click(function() {
                
                if( getCookie("help_cookie") ){
                        
                        var action = $('#collect_btn').attr( "action" );
                        var data = {
                                    token: getCookie("help_cookie") ,
                                    page : getParameterByName( "p" ) ,
                                    action : action
                        };
                        var success_back = function( data ) {

                                data = JSON.parse( data );
                                console.log(data);
                                loading_ajax_hide();
                                if( data.success ) {
                                        if( data.data === "already" ){
                                                show_remind( "已收藏" );
                                                $( '#collect_btn > h5' ).html( "取消收藏" );
                                                $( '#collect_btn' ).attr( "action" , "cancel" );
                                        }
                                        else if( data.data === "yet" ){
                                                show_remind( "已取消收藏" );
                                                $( '#collect_btn > h5' ).html( "收藏" );
                                                $( '#collect_btn' ).attr( "action" , "collect" );
                                        }
                                }
                                else {
                                        show_remind( data.msg , "error" );
                                }

                        }
                        var error_back = function( data ) {
                                console.log(data);
                        }
                        $.Ajax( "POST" , "php/collect.php?func=collect" , data , "" , success_back , error_back);

                }
                else{
                        show_remind( "請登入" );
                        if( $('#mobi-rbtn').css( "display" ) === "block" ){
                                $('#mobi-rbtn').click();
                        }
                        else if( $('.top > ul > li.login').css( "display" ) === "block" ){
                                $('.top > ul > li.login').trigger( "mouseenter" );
                        }
                }
        });
}

function track_evnet(){
        
        $('.icon1').click(function() {
                
                if( getCookie("help_cookie") ){
                        
                        var action = $('.icon1').attr( "action" );
                        var data = {
                                    token: getCookie("help_cookie") ,
                                    ch : $( this ).attr( "ch" ) ,
                                    action : action
                        };
                        var success_back = function( data ) {

                                data = JSON.parse( data );
                                console.log(data);
                                loading_ajax_hide();
                                if( data.success ) {
                                        if( data.data === "already" ){
                                                show_remind( "已追蹤" );
                                                $( '.icon1' ).html( "取消追蹤" );
                                                $( '.icon1' ).attr( "action" , "cancel" );
                                        }
                                        else if( data.data === "yet" ){
                                                show_remind( "已取消追蹤" );
                                                $( '.icon1' ).html( "追蹤作者" );
                                                $( '.icon1' ).attr( "action" , "track" );
                                        }
                                }
                                else {
                                        show_remind( data.msg , "error" );
                                }

                        }
                        var error_back = function( data ) {
                                console.log(data);
                        }
                        $.Ajax( "POST" , "php/track.php?func=track" , data , "" , success_back , error_back);

                }
                else{
                        show_remind( "請登入" );
                        if( $('#mobi-rbtn').css( "display" ) === "block" ){
                                $('#mobi-rbtn').click();
                        }
                        else if( $('.top > ul > li.login').css( "display" ) === "block" ){
                                $('.top > ul > li.login').trigger( "mouseenter" );
                        }
                }
        });
}

function get_sidebar_this_week_hot(){
        
        var data = {
                    page_num : 6
        };
        var success_back = function( data ) {

                data = JSON.parse( data );
                console.log(data);
                loading_ajax_hide();
                if( data.success ) {
                        
                        var tmp = "";
                        $.each( data.data , function( index , value ){
                                tmp += '<li>' +
                                        '    <a href="v_article_info.php?p=' + value.page_id + '">' +
                                                '<div class="res_div3">\n\
                                                        <div style="background-image:url(\'' + website_page_url+value.page_id+"/ThumbnailM/"+value.p_icon + '\')"></div>\n\
                                                </div>' +
                                        '        <p>' + value.p_title + '</p>' +
                                        '    </a>' +
                                        '</li>';
                        });
                        $( "#right-list > ul" ).html( tmp );
                        
                        
                }
                else {
                        show_remind( data.msg , "error" );
                }

        }
        var error_back = function( data ) {
                console.log(data);
        }
        $.Ajax( "POST" , "php/page.php?func=get_this_week_hot_page" , data , "" , success_back , error_back);
    
}

function share_event() {
        window.open('https://www.facebook.com/sharer/sharer.php?u='+"http://www.ggyyggy.com/funbook19/v_article_info.php" + location.search,'facebook-share-dialog','width=626,height=436');
}
