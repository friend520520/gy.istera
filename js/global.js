

var website_ws_url        = "http://114.55.28.16:7878/" ;
//var website_ws_url_old    = "http://114.55.28.16:7845/" ;

var website_upload_transient_url        = "http://www.ggyyggy.com/help/transient/";
var website_data_url        = "http://www.ggyyggy.com/help/data/";
var website_account_url        = "http://www.ggyyggy.com/help/data/account/";
var website_channel_url        = "http://www.ggyyggy.com/help/data/channel/";
var website_page_url        = "http://www.ggyyggy.com/help/data/page/";
var website_homepage_url        = "http://www.ggyyggy.com/help/v_index.php";
var website_memberhome_url        = "http://www.ggyyggy.com/help/mgc_franchisee_console.php";

function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function setCookie(name, value, expires, path, domain, secure){
    document.cookie= name + "=" + escape(value) +
    ((expires) ? "; expires=" + expires.toGMTString() : "") +
    ((path) ? "; path=" + path : "") +       //you having wrong quote here
    ((domain) ? "; domain=" + domain : "") +
    ((secure) ? "; secure" : "");
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function delete_cookie( name, path, domain ) {
   if( getCookie( name ) ) {
     document.cookie = name + "=" +
       ((path) ? ";path="+path:"")+
       ((domain)?";domain="+domain:"") +
       ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
   }
}

$.Ajax = function ( type , url , data , data2 , back , error_back)
{
           if( error_back == "" ) {
                   error_back = function(e) { console.log(e); };
           }
           $.ajax({
                       type : type ,
                       url : url ,
                       async: true ,
                       data : data ,
                       data2 : data2 ,
                       success : back ,
                       error : error_back
           });
}

$.Ajaxq = function ( list , type , url , data , data2 , back , error_back) 
{
           if( error_back == "" ) {
                   error_back = function(e) { console.log(e); };
           }
           $.ajaxq( list , {
                       type : type ,
                       url : url ,
                       async: true ,
                       data : data ,
                       data2 : data2 ,
                       success : back ,
                       error : error_back
           });
}

function containsAllAscii(str) {
    return  /^[\000-\177]*$/.test(str) ;
}

function PutBT( num ){
    show_remind( num ) 
};

function getStrLength( str ) {

    return str.replace(/[^\x00-\xff]/g,"xx").length;

}

function getInterceptedStr(sSource, iLen)
{
    if(sSource.replace(/[^\x00-\xff]/g,"xx").length <= iLen)
    {
            return sSource;
    }

    var str = "";
    var l = 0;
    var schar;
    for(var i=0; schar=sSource.charAt(i); i++)
    {
            str += schar;
            l += (schar.match(/[^\x00-\xff]/) != null ? 2 : 1);
            if(l >= iLen)
            {
                break;
            }
    }

    return str;
}


function notification_cb( msg )
{
    //show_remind( "os="+msg.os+ " ,app="+msg.app+ " ,udid="+msg.udid+ " ,token="+msg.token );
    $.noti_token = msg.token;
    var data = {
                os:  msg.os ,
                app:  msg.app ,
                udid:  msg.udid ,
                token:  msg.token
    };
    var success_back = function( data ) {

            //show_remind( data );

    };
    var error_back = function( data ) {
            console.log(data);
    };
    $.Ajax( "GET" , "php/mobile_API/insertToken.php" , data , "" , success_back , error_back);
    
}

function loading_ajax_show()
{
        $( "#loading" ).css( "z-index" , "9999" );
        $( "body" ).css( "overflow" , "hidden" );
        $( "#loading" ).show();
}
function loading_ajax_hide()
{ 
        $( "#loading" ).css( "z-index" , "-999" );
        $( "body" ).css( "overflow" , "auto" );
        $( "#loading" ).hide();
}

function show_remind( msg , state ) {
        state = state || "success";
        if( window.Web2App ) {
            window.Web2App.ttt( msg );
        }
        else if( $.notify ) {
            if( state === "success" || state === "error" ){
                $.notify( msg , {  className: state, position:"middle center" });//bottom center
            }
            else
                $.notify( msg , {  className: "success", position:"middle center" });//bottom center
        }
        else {
            alert( msg );
        }
}

function difference_now( time ) {

        var callback;
        time = time.split(" ");
        var time1 = time[0].split( "-" );
        var time2 = time[1].split( ":" );
        var old_time = new Date( parseInt(time1[0]),parseInt(time1[1])-1,parseInt(time1[2]),parseInt(time2[0]),parseInt(time2[1]),parseInt(time2[2]) );
        var now_time = new Date();
        var difference = now_time.getTime() - old_time.getTime();
        var difference_sec = parseInt( difference/1000 );
        //callback["same_m"] = ( old_time.getMonth() === now_time.getMonth() && old_time.getFullYear() === now_time.getFullYear() ) ? true : old_time.getFullYear() + "-" + ( old_time.getMonth() + 1 );
        if( difference_sec < 60 ) {
            callback = difference_sec + " 秒前";
        }
        else if( difference_sec < 60*60 ) {
            callback = parseInt( difference_sec/60 ) + " 分前";
        }
        else if( difference_sec < 24*60*60 ) {
            callback = parseInt( difference_sec/60/60 ) + " 小時前";
        }
        else if( difference_sec < 30*24*60*60 ) {
            callback = parseInt( difference_sec/60/60/24 ) + " 天前";
        }
        else if( difference_sec < 12*30*24*60*60 ) {
            callback = parseInt( difference_sec/30/60/60/24 ) + " 個月前";
        }
        else{
            callback = parseInt( difference_sec/12/30/60/60/24 ) + " 年前";
        }
        return callback;
}

function create_page( value ){
        
        var p_tag = value.p_tag[0] ? "#"+value.p_tag[0] : "" ;
        return '<li class="showing">' +
                '        <dl>' +
                '                <dt>' +
                '                        <div class="category" cate="' + value.p_category_id + '">' + value.cate_name + '</div>' +
                '                        <a href="v_article_info.php?p=' + value.page_id + '">' +
                '                                <div class="res_div">' +
                '                                        <div style="background-image:url(\'' + value.p_icon + '\')"></div>' +
                '                                </div>' +
                '                        </a></dt>' +
                '                <dd>' +
                '                        <h5><a href="v_article_info.php?p=' + value.page_id + '">' + value.p_title + '</a></h5>' +
                '                        <p><b style="opacity: 1;">觀看次數 ' + value.p_click_num + ' / ' + difference_now( value.p_date ) + '</b><span style="display: none; opacity: 1;">' + value.p_date + '</span></p>' +
                '                        <nav ch="' + value.ch_id + '">' + value.ch_name + '</nav>' +
                '                        <div class="list-sub">' + p_tag + '</div>' +
                '                        <div class="fb" style="display: none; opacity: 1;"><a href="v_article_info.php"><img alt="" src="template/images/fb.png"></a></div>' +
                '                </dd>' +
                '        </dl>' +
                '</li>';
        
}

function clear_input(){
        
        $( "input:not([type=button])" ).val( "" );
        $( "textarea" ).val( "" );
        
}


function scrollto( pos , time ){
        time = time || 1000;
        $('html, body').animate({
            scrollTop: pos.offset().top - $(window).height()/2
        }, time);
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function GetDecimals( num , decimals , condi ){
        //floor => 無條件捨去,round => 四捨五入,ceil => 無條件進位
        condi = condi || "floor";
        var tmp = Math.pow(10,decimals);
        if( condi === "floor" )
        return Math.floor(parseFloat(num)*tmp)/tmp;
        else if( condi === "round" )
        return Math.round(parseFloat(num)*tmp)/tmp;
        else if( condi === "ceil" )
        return Math.ceil(parseFloat(num)*tmp)/tmp;
}

function IntParseString( num , length ){
        //無條件捨去
        var tmp = String( num );
        for( var i = tmp.length ; i < length ; i++ ){
            tmp = "0" + tmp;
        }
        return tmp;
}

function NumConverteChinese( num ){
    
    if( typeof num === "number" ){
            String( num ).length;
    }
    return false;
}

function NumGetDigit( num ){
    
    
}

function YearFunction(sel)
{
        var tmp = "";
        if( $("[type=month]").val() === "02" )
        {
                if( parseInt( $(sel).val() )%4 === 0 )
                    var days = 29;
                else
                    var days = 28;
                for( var i=1 ; i<=days ; i++ )
                {
                        if( i < 10 )
                            tmp += '<option value=0' + i + '>' + i + '日</option>';
                        else
                            tmp += '<option value=' + i + '>' + i + '日</option>';
                }
                $("[type=day]").html(tmp);
        }
}
function MonthFunction(sel)
{
        var tmp = "";
        switch( $(sel).val() )
        {
        case "01":
        case "03":
        case "05":
        case "07":
        case "08":
        case "10":
        case "12":
          var days = 31;
          break;
        case "04":
        case "06":
        case "09":
        case "11":
          var days = 30;
          break;
        case "02":
          if( parseInt( $("[type=year]").val() )%4 === 0 )
              var days = 29;
          else
              var days = 28;
          break;
        }
        for( var i=1 ; i<=days ; i++ )
        {
                if( i < 10)
                    tmp += '<option value=0' + i + '>' + i + '日</option>';
                else
                    tmp += '<option value=' + i + '>' + i + '日</option>';
        }
        $("[type=day]").html(tmp);
}

$("document").ready(function() {
        $("form").submit(false);
        
        ready_translate();
});

function ready_translate(){
        
        var help_language = getCookie( "help_language" );
        if( help_language !== "" ){
                $( "#choose_langauge" ).val( help_language );
                if( help_language !== "TraditionalChinese" )
                    $( "#choose_langauge [value='"+help_language+"']" ).click();
        }
        
}

function set_translate( langauge ){
        
        loading_ajax_show();
        console.log( langauge );
        
        if( $.langauge ){
                start_translate( langauge );
        }
        else{
                var data = {};
                var success_back = function( data ) {

                        data = JSON.parse( data );
                        console.log(data);
                        loading_ajax_hide();
                        if( data.Success ) {
                            $.langauge = data.data;
                            start_translate( langauge );
                        }
                        else {
                            show_remind( data.ErrMsg , "error" );
                        }

                }
                var error_back = function( data ) {
                        console.log(data);
                }
                $.Ajax( "POST" , "php/language.php?func=get_language" , data , "" , success_back , error_back);
                
        }
        
}

function start_translate( langauge )
{
        
        console.log( $.langauge );
        $.each( $.langauge , function( k , v ){
                
                console.log( v["TraditionalChinese"] );
                console.log( $( "body :contains('"+v["TraditionalChinese"]+"'):not(:has(*))" ) );
                $( ":contains('"+v["TraditionalChinese"]+"'):not(:has(*))" ).attr( "origin_value",v["TraditionalChinese"] ).html( v[langauge] );
                $( "[origin_value='"+v["TraditionalChinese"]+"']" ).attr( "origin_value",v["TraditionalChinese"] ).html( v[langauge] );
                
        });
        setCookie( "help_language" , langauge );
        loading_ajax_hide();
        
}