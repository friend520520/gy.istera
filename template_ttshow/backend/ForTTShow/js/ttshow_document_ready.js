$(document).ready(function() {
        $(window).scrollTop( 0 );
            $('#change_img_select_modal')
            .on('show.bs.modal', function (e) {
                    if( $('#change_img_select_modal').attr("load") == "false" ) {
                            $('#change_img_select_modal').attr("load","true");
                            ttshow_get_user_img();
                    }
                    /*
                    callback = function( data ){
                        try {
                                var data = eval( data );
                                var str = "";
                                
                                var http = location.protocol;
                                var slashes = http.concat("//");
                                var host = slashes.concat(window.location.hostname);
                                
                                for(var i=0 ; i<data.length; i++ ) {
                                    str += '<img src="' + host + data[i].path + '" style="width: 150px; margin: 10px; border: 1px solid black; padding: 5px;" >';
                                }
                                var modal_body = $("#change_img_select_modal .modal-body");
                                modal_body.append( str );
                                
                                modal_body.find("img").unbind('click').bind( 'click' , function() {
                                        modal_body.find("img").removeAttr("target");
                                        modal_body.find("img").css( "background" , "" );
                                        $( this ).attr("target"," ");
                                        $( this ).css( "background" , "gray" );
                                });
                                //bohan0523++
                                modal_body.find("img").unbind('dblclick').bind( 'dblclick' , function() {
                                        $( "#change_img_select_modal_yes" ).trigger( "click" );
                                });
                                //bohan0523--
                        }catch(e) {
                                console.log(e);
                        }
                        console.log(data);
                    };
                    errorback = function( data ){
                        console.log(data);
                    };
                    $.CGI_proxy( "POST" , "backend/ForTTShow/pageedit_list_img.php" , { user_mail : $.member.user_id } , "" , callback , errorback );
                    */
            })
            .on('hidden.bs.modal', function (e) {                
                        $.View.view_sidebar().options().click_img = "";
            });
            $("#change_img_select_modal_yes").unbind('click').bind( 'click' , function() {
                    var src = $("#ttshow_img_list_space div[target]").css("background-image");
                    console.log(src);
                    src = src.replace("url(","").replace(")","").replace("\"","").replace("\"","");
                    console.log(src);
                    if( src != undefined ) { 
                            tinyMCE.execCommand('mceInsertContent', false, '<img style="max-width:100%;" data-pos="member" src="' + src + '" />');
                            //$.View.view_sidebar().options().click_img.attr("src" , src );
                            $("#change_img_select_modal").modal("hide");
                    }
            });
            $("#delete_img").unbind('click').bind( 'click' , function() {
                    var pos = $("#ttshow_img_list_space div[target]");
                    var src = pos.css("background-image");
                    console.log(src);
                    src = src.replace("url(","").replace(")","").replace("\"","").replace("\"","");
                    console.log(src);
                    var img = src.split( "/" )[src.split( "/" ).length-1];
                    var img_array = [ img ];
                    $.ajax({
                            type    : "POST",  
                            url     : "php/user_delete_image.php" ,
                            data    : {
                                        account : JSON.parse( getCookie( "ttshow" ) ).user_id ,
                                        img    : img_array
                            },
                            success: function(data) 
                            {
                                    if( data === "true" )
                                    {
                                            pos.remove();
                                            $( "#delete_img" ).hide();
                                    }
                                    
                            }
                    });
            });
          
            $.upload_file = {};
            $.upload_file.transient_file = "";
            $.upload_file.beforeunload = {};
            $("#picture_upload").unbind('click').bind( 'click' , function() {
                    $("#transient_file").click();
            });
            var delete_transient_file = function( filename ) {
                    $.ajax({
                                type: "POST",
                                url: "php/signup.php",
                                data : {
                                    cmd            : "transient_file" ,
                                    transient_file : filename ,
                                },
                                success: function( data ) { return null; } ,
                                error: function( data ) { console.log( data ); }
                    });
            }
            $(window).on('beforeunload', function(){
                    $.each( $.upload_file.beforeunload , function(index, value) {
                            delete_transient_file( value );
                    });
            });
            $(window).unload( function(){
                    $.each( $.upload_file.beforeunload , function(index, value) {
                            delete_transient_file( value );
                    });
            });
/*          
            $("#add_tag").unbind('click').bind( 'click' , function() {
                    var html_input = $("#tag_example_model").clone();
                    html_input.removeAttr("id");
                    html_input.css("display","block");
                    html_input.find("[id=delete]").unbind('click').bind( "click" , function(e) {
                            $(e.target).parent().parent().remove();
                    });
                    html_input.find("[id=tag_name]").html( $("#tag_modal").val() );
                    $("#tag_modal_space").append(html_input);
            });
    
            $( "body" ).bind( 'loginEvent' , function() {
                    var url = window.location.toString();
                    var json = {};
                    
                    if( url.search("\\?") != -1 ) {
                            var data = url.split("?")[1];
                            var UserData = data.split(","); 
                            $.ProjectName = UserData[0];
                            //open project ++
                            $.ajax({
                                        type : "POST",
                                        url : "ForTTShow/pageedit_open_project.php" ,
                                        async: true ,
                                        data : {
                                            user_mail : $.UserMsg.email ,
                                            project : $.ProjectName ,
                                        },
                                        success : function(data) { 
                                                console.log( data );
                                                if( data != "false" ) {
                                                        $.all_data_inEdit = {};
                                                        $.all_data_inEdit.img = [];
                                                        $.all_data_inEdit.movie = []; 
                                                        $("#menu_builder").css("display","block");
                                                        $.View.view_shelldata()._SetOpts({ putdata : data });
                                                        $.View.view_shelldata().putFile();
                                                } else {
                                                        //window.open('', '_self', ''); window.close();
                                                }
                                        } ,
                                        error : function(data) { console.log(data); }
                            });   
                    }
                    else {
                            console.log("get UserData error!!");
                    }
            });
            
            $("#channel_publish_modal_yes").unbind('click').bind( 'click' , function() {
                    downloadLayoutSrc();
                    var Copy = $( "#main_container"  ).clone();
                    var process = $("#download-layout").clone();
                    
                    var tag_space = $("#tag_modal_space").children();
                    var tag = [];
                    for(var i=0; i< tag_space.length ; i ++ ) {
                        tag[i] = tag_space.eq(i).find("[id=tag_name]").html();
                    }
                    tag = JSON.stringify( tag );
                    var data = {
                            user_mail : $.member.facebook_mail ,
                            icon : $.upload_file.transient_file,
                            project : $.ProjectName ,
                            html : $("#publishModal").data( "tmp_html" ) ,
                            edit : Copy.html() ,
                            content : process.html() ,
                            data : JSON.stringify( $.all_data_inEdit ) ,
                            tag : tag ,
                            class : $("#class_modal").val() ,
                            channel : $("#channel_modal").val() ,
                            title : $("#title_modal").val() ,
                    };
                    console.log( data );

                    $.ajax({
                            type : "POST",
                            url : "ForTTShow/pageedit_publish_channel.php" ,
                            async: true ,
                            data : data ,

                            success : function(data) { 
                                    $('#channel_publish_modal').modal("hide");
                                    $("#loadingpage").css("display","none");
                                    $("#save_file_success").modal("show");
                                    //window.open('', '_self', ''); window.close();
                            } ,
                            error : function(data) { console.log(data); }
                    });
                    $(window).scrollTop( 0 );
                    $("#loadingpage").css("display","block");
            });
           
            $('#channel_publish_modal')
            .on('show.bs.modal', function (e) {
                    $("#page_icon").css("background-image" , "");
                    $("#page_icon").attr("img","");
                    $("#title_modal").val("");
                    $("#tag_modal").val("");
                    $("#tag_modal_space").html("");
            })
            .on('hidden.bs.modal', function (e) {  
                    delete_transient_file( $.upload_file.transient_file );
            });
            $("#channel_publish").unbind('click').bind( 'click' , function() {
                    
                    callback = function( data ){
                        try {
                                var data = JSON.parse(data)

                                console.log(data );
                                $("#class_modal").html("");
                                $("#channel_modal").html("");
                                var i=0;
                                for( i=0; i< data.tab.length; i++ ) {
                                        $("#class_modal").append('<option value="' + data.tab[i].id + '">' + data.tab[i].name + '</option>');
                                }
                                for( i=0; i< data.channel.length; i++ ) {
                                        $("#channel_modal").append('<option value="' + data.channel[i].id + '">' + data.channel[i].name + '</option>');
                                }
                                $("#channel_publish_modal").modal("show");
                        }catch(e) {
                                console.log(e);
                                alert("please create channel.");
                        }
                    };
                    errorback = function( data ){
                        console.log(data);
                    };
                    $.CGI_proxy( "POST" , "ForTTShow/get_user_channel_class.php" , { user_mail : $.member.facebook_mail } , "" , callback , errorback );
            });
            //abin edit 2015/5/19 --
*/            
            $('body.edit .demo').on("click","[data-target=#myModalforFBmovie]",function(e) {
                    $("#myModalforFBmovie").data("target", $(this).parent().parent().find(".view") );
            });
            $("#myModalforFB_movieYes").unbind('click').bind( 'click' , function() {
                    var fb_link = $("#FB_movie_input").val();
                    if( fb_link.search("fb-video") !== -1 )
                    {
                          fb_link = fb_link.split("/script>")[1];
                    }
                    $("#myModalforFBmovie").data("target").html( fb_link );
                    window.fbAsyncInit();
            });

            $("#remove_cover_img").unbind('click').bind( 'click' , function() {
                    $("#upload_now").css("background-image","");
                    $("#upload_now").parent().css("background","none");
                    $.upload_file.transient_file = "empty_picture";
            });

            $("#upload_cloud_disk").unbind('click').bind( 'click' , function() {
                    $("#ttshow_cloud_disk").click();
                    console.log( "ttshow_cloud_disk" );
            });

            $("#upload_cover_img").unbind('click').bind( 'click' , function() {
                    $("#transient_file").click();
            });
            
            //page add tag ++
            $("#ttshow_tag_add").unbind('click').bind( 'click' , function() {
                    var tag = $("#ttshow_example_tag_model").clone();
                    tag.css("display","block");
                    tag.removeAttr("id");
                    tag.find("[id=text]").html( $("#ttshow_tag_name").val() );
                    tag.find("[id=delete]").unbind('click').bind( "click" , function(e) {
                            $(e.target).parent().remove();
                    });
                    $("#ttshow_tag_space").append( tag );
                    $("#ttshow_tag_space").append( $("#ttshow_tag_space .clearfix") );
            });
            //page add tag --
            
            //page publish ++
            $("#ttshow_publish_page").unbind('click').bind( 'click' , function() {
                    
                    var show_alert_msg = "";
                    var pass = true;
                    if( $( "#ttshow_page_name" ).val() === "" )
                    {
                            if( !pass )
                                show_alert_msg += "、";
                            pass = false;
                            show_alert_msg += "請輸入文章標題";
                    }
                    if( $( "#ttshow_channel_select" ).val() === null )
                    {
                            if( !pass )
                                show_alert_msg += "、";
                            pass = false;
                            show_alert_msg += "請選擇頻道";
                    }
                    if( $( "#ttshow_class_select" ).val() === null )
                    {
                            if( !pass )
                                show_alert_msg += "、";
                            pass = false;
                            show_alert_msg += "請選擇分類";
                    }
                    if( $( "#upload_now" ).css("background-image") === "none" )
                    {
                            if( !pass )
                                show_alert_msg += "、";
                            pass = false;
                            show_alert_msg += "請上傳封面圖片";
                    }
                    
                    if( pass )
                    {
                        display_loading_page();
                        if( $.getData.state == "modify" ) {
                                ttsho_modify_publish();
                        } else if( $.getData.state == "edit" ) {
                                ttsho_edit_publish();
                        }
                    }
                    else
                    {
                        alert( show_alert_msg );
                    }
                    
            });
            //page publish --
});

var ttshow_init_model = function( FilePath ) {
        /*$.ajax({type: "GET",
                url : FilePath,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function(data) {
                        $.all_data_inEdit = {};
                        $.all_data_inEdit.img = [];
                        $.all_data_inEdit.movie = []; 
                        $("#channel_publish").parent().css("display","block");
                        $.View.view_shelldata()._SetOpts({ putdata : data });
                        $.View.view_shelldata().putFile();
                },
                error: function(data) { 
                        $.all_data_inEdit = {};
                        $.all_data_inEdit.img = [];
                        $.all_data_inEdit.movie = []; 
                        $("#channel_publish").parent().css("display","block");
                        $.View.view_shelldata()._SetOpts({ putdata : data.responseText });
                        $.View.view_shelldata().putFile();
                }
         });*/
        $.all_data_inEdit = {};
        $.all_data_inEdit.img = [];
        $.all_data_inEdit.movie = []; 
        $("#channel_publish").parent().css("display","block");
}

var ttshow_login_event = function( data ) {
        $.member = data;
        $("#channel_publish_page").find("[id=text]").attr("style","border-top: 4px solid #428bca;background: white;margin: 0 -3px;color: #428bca;margin-bottom: 3px;");
        //get url data ++
        var url = window.location.toString();
        $.getData = {};
        if( url.search("\\?") != -1 && url.search("=") != -1 ) {
                var data = url.split("?")[1].split("&");
                for(var i=0;i<data.length;i++) {
                        $.getData[data[i].split("=")[0]] = data[i].split("=")[1];
                }
                $.getData.url = "false";
        }
        else {
                $.getData.ch  = url.split("?")[1];
                $.getData.url = "true";
        }
        console.log( $.getData );
        //get url data --

        // edit or modify ++
        if( $.getData.page != undefined ) {
                $.getData.state = "modify";
                check_user_identity();
        } else {
                $.getData.state = "edit";
                check_user_identity();
        }
        // edit or modify --
}

var check_user_identity = function() {
        var callback = function(){};
        var data = {};
        if( $.getData.state == "modify" ) {
                data.cmd = "init_modify";
                data.url = $.getData.url;
                data.ch = $.getData.ch;
                data.page = $.getData.page;
                data.ttshow = getCookie( "ttshow" );
                console.log( data );
                callback = ttshow_modify_page;
        } else if( $.getData.state == "edit" ) {
                data.cmd = "init_edit";
                data.url = $.getData.url;
                data.ch = $.getData.ch;
                data.ttshow = getCookie( "ttshow" );
                callback = ttshow_edit_page;
        }
        
        errorback = function( data ){
            console.log(data);
        };
        $.CGI_proxy( "POST" , "php/backend_check_user_identity.php" , data , "" , callback , errorback );    
}

var ttshow_edit_page = function( data ) {
        try {
                var data = JSON.parse( data );
                console.log( data );
                if( data.success) {
                        //UI setting++
                        
                        var model = "backend/ForTTShow/edit_file/edit.php";
                        ttshow_init_model( model );
                        var i = 0;
                        $("#ttshow_publish_page").html("發布文章");
                        
                        $("#ttshow_channel_select").html("");
                        $("#ttshow_class_select").html("");
                        $("#ttshow_tag_space").html("");
                        $("#ttshow_tag_space").append('<div class="clearfix"></div>');
                        
                        for(i=0;i<data.channel.length;i++) {
                                var opt = document.createElement('option');
                                opt.value = data.channel[i].id;
                                opt.innerHTML = data.channel[i].name;
                                opt.style.color = data.channel[i].display === "none" ? "red" : "";
                                $("#ttshow_channel_select").append( opt );
                        }
                        
                        $.getData.ch = data.ch;
                        if( data.ch == undefined || data.ch == null ) {
                                $("#ttshow_channel_select").val( $("#ttshow_channel_select option").eq(0).val() );
                        } else {
                                $("#ttshow_channel_select").val(data.ch);
                        }
                        
                        for(i=0;i<data.tab.length;i++) {
                                var opt = document.createElement('option');
                                opt.value = data.tab[i].id;
                                opt.innerHTML = data.tab[i].name;
                                $("#ttshow_class_select").append( opt );
                        }
                        $("#ttshow_class_select").val( $("#ttshow_class_select option").eq(0).val() );
                        
                        disable_loading_page();
                        init_subTab_url();
                        //UI setting--
                } else {
                        console.log( data.msg ); alert(  data.msg );
                }
        }catch(e) {
                console.log(e);
        }
}

var ttshow_modify_page = function( data ) {
        //UI setting++
        $("#ttshow_publish_page").html("儲存文章");
        //UI setting--
        try {
                var data = JSON.parse( data );
                console.log( data );
                if( data.success) {
                        var i = 0;
                        $("#ttshow_channel_select").html("");
                        $("#ttshow_class_select").html("");
                        $("#ttshow_tag_space").html("");
                        $("#ttshow_tag_space").append('<div class="clearfix"></div>');
                        
                        for(i=0;i<data.channel.length;i++) {
                                var opt = document.createElement('option');
                                opt.value = data.channel[i].id;
                                opt.innerHTML = data.channel[i].name;
                                opt.style.color = data.channel[i].display === "none" ? "red" : "";
                                $("#ttshow_channel_select").append( opt );
                        }
                        $.getData.ch = data.ch;
                        $("#ttshow_channel_select").val(data.ch);
                        
                        for(i=0;i<data.tab.length;i++) {
                                var opt = document.createElement('option');
                                opt.value = data.tab[i].id;
                                opt.innerHTML = data.tab[i].name;
                                $("#ttshow_class_select").append( opt );
                        }
                        $("#ttshow_class_select").val( data.page.class );
                        
                        $("#ttshow_page_publish_time").html( data.page.time );
                        $("#ttshow_page_name").val( data.page.title );
                        $("#upload_now").css("background-image","url(" + data.page.icon + ")");
                        var tag_data = eval( data.page.tag );
                        for(i=0;i<tag_data.length;i++) {
                                var tag = $("#ttshow_example_tag_model").clone();
                                tag.css("display","block");
                                tag.removeAttr("id");
                                tag.find("[id=text]").html( tag_data[i] );
                                tag.find("[id=delete]").unbind('click').bind( "click" , function(e) {
                                        $(e.target).parent().remove();
                                });
                                $("#ttshow_tag_space").append( tag );
                                $("#ttshow_tag_space").append( $("#ttshow_tag_space .clearfix") );
                        }
                        
                    
                        $.all_data_inEdit = {};
                        $.all_data_inEdit.img = [];
                        $.all_data_inEdit.movie = [];
                        $("#channel_publish").parent().css("display","block");
                        /////////////bohan ++ 0724
                        /*$( "#editor_place_hide" ).html( data.page.file );
                        $.each( $( "#editor_place_hide img" ) , function( index , value ){
                            
                                var src = $( value ).attr( "src" );
                                src = "http://ttshow.tw/ttshow/web/data/" + data.page.page + "/" + src;
                                $( value ).attr( "src" , src );
                                
                        });
                        var file = $( "#editor_place_hide" ).html();*/
                        //////////////
                        $( "#editor_place_hide" ).html( data.page.file );
                        console.log( $( "#editor_place_hide" ).html() );
                        //$.each( $( "#editor_place_hide" ).find( "img[data-pos=member]" ) , function( index , value ) {
                        $.each( $( "#editor_place_hide" ).find( "img:not([data-video=youtube]):not([data-pos=page])" ) , function( index , value ) {
                                $( value ).attr( "data-pos" , "page" );
                                $( value ).attr( "data-index" , $( value ).attr( "img_index" ) );
                                if( $( value ).attr( "src" ).search( "http" ) === -1 )
                                    $( value ).attr( "src" , "ttshow/web/data/" + data.page.page + "/" + $( value ).attr( "src" ) );
                        });
                        console.log( data.page.file );
                        console.log( $( "#editor_place_hide" ).html() );
                        $.View.view_shelldata()._SetOpts({ putdata : $( "#editor_place_hide" ).html() });
                        $.View.view_shelldata().putFile();
                        //////////////
                        
                        disable_loading_page();
                        init_subTab_url();
                } else {
                        console.log( data.msg ); alert(  data.msg );
                }
        }catch(e) {
                console.log(e);
        }
}

var ttsho_edit_publish = function() {
        var data = process_publish_data();
        data.cmd = "edit";
        data.ttshow = getCookie( "ttshow" );
        var callback = function(data) { 
            console.log(data); 
            disable_loading_page();
            data = JSON.parse( data );
            if( data.success === "true" )
                alert( "成功" );
            else
                alert( "失敗" );
        };
        errorback = function( data ){
            console.log(data);
        };
        $.CGI_proxy( "POST" , "php/backend_publish_page.php" , data , "" , callback , errorback ); 
}

var ttsho_modify_publish = function() {
        var data = process_publish_data();
        data.cmd = "modify";
        data.page = $.getData.page;
        data.ttshow = getCookie( "ttshow" );
        console.log( data );
        
        var callback = function(data) { 
            console.log(data); 
            disable_loading_page();
            try {
                console.log(JSON.parse( data ));
                data = JSON.parse( data );
                if( data.success === "true" )
                    alert( "成功" );
                else
                    alert( "失敗" );
            } catch(e) {
                console.log(e);
            }
        };
        errorback = function( data ){
            console.log(data);
        };
        $.CGI_proxy( "POST" , "php/backend_publish_page.php" , data , "" , callback , errorback );
}

var process_publish_data = function() {
        //downloadLayoutSrc();/*boahn0724*/
        var html = tinymce.activeEditor.getContent();
        /////////////bohan ++ 0724
        $( "#editor_place_hide" ).html( html );
        //////////////
        
        save_process();
                    
        var tag_space = $("#ttshow_tag_space").children();
        var tag = [];
        for(var i=0; i< tag_space.length ; i ++ ) {
            var name = tag_space.eq(i).find("[id=text]").html();
            if( name != null && name != "" && name != undefined ) {
                tag[i] = name;
            }
        }
        tag = JSON.stringify( tag );
        var data = {
                url : $.getData.url ,
                ch : $.getData.ch ,
            
                icon : $.upload_file.transient_file ,
                //project : $("#ttshow_page_name").val() ,
                html : html ,/*$("#publishModal").data( "tmp_html" )*//*boahn0724*/
                edit : $.edit ,/*Copy.html()*//*boahn0724*/
                content : $( "#editor_place_hide" ).html() ,/*process.html()*//*boahn0724*/
                data : JSON.stringify( $.all_data_inEdit ) ,
                tag : tag ,
                class : $("#ttshow_class_select").val()[0] ,
                channel : $("#ttshow_channel_select").val() ,
                title : $("#ttshow_page_name").val() ,
        };
        return data;
}



var init_subTab_url = function() {
        var href = "";
        if( $.getData.url == "true" ) {
            href = "?" + window.location.toString().split("?")[1];
        } else {
            if( $.getData.ch != null && $.getData.ch != undefined ) {
                href = "?ch=" + $.getData.ch;
            } else {
                href = "";
            }
        }
        $("#channel_homepage").attr( "href" , $("#channel_homepage").attr("href") + href );
        $("#channel_publish_page").attr( "href" , $("#channel_publish_page").attr("href") + href );
        $("#channel_list_page").attr( "href" , $("#channel_list_page").attr("href") + href );
        $("#channel_setting").attr( "href" , $("#channel_setting").attr("href") + href );
}

var display_loading_page = function() {
        $(window).scrollTop( 0 );
        $("#loadingpage").css("display","block");
        $("body").css("overflow","hidden");
}

var disable_loading_page = function() {
        $("#loadingpage").css("display","none");
        $("body").css("overflow","auto");
}


var ttshow_get_user_img = function() {
        var data = {
            cmd : "list",
            ttshow : getCookie( "ttshow" )
        };
        callback = function( data ){
                try {
                        var data = JSON.parse( data );
                        var url = data.url;
                        delete data.url;
                        $.each( data , function(index, value) {
                                var clone = $("#ttshow_img_list_example_model_2").clone();
                                var clone_div = $("#ttshow_img_list_example_model").clone();
                                clone.removeAttr("id");
                                clone_div.removeAttr("id");
                                //clone.attr("src", url + value );
                                clone.attr("img", url + value);
                                clone_div.attr("img", url + value);
                                $("#ttshow_img_list_space").prepend( clone_div );
                                $("#ttshow_img_list_space").prepend( clone );
                        });
                        console.log( data );
                        var div = $("#ttshow_img_list_space img[img]").eq(0);
                        div.attr("src", div.attr("img") );
                        div.removeAttr("img");
                        
                        $.ttshow_change_img_event = function(e) {
                                $("#ttshow_img_list_space div").css("border" , "1px solid black" );
                                $("#ttshow_img_list_space div").removeAttr("target");
                                $( e.target ).css("border" , "5px solid gray" );
                                $( e.target ).attr("target","");
                                $( "#delete_img" ).show();
                        }
                        var change = function() {
                                //if( $("#ttshow_img_list_space img[img]").length != 0 ) {
                                        console.log( $("#ttshow_img_list_space img[img]").length );
                                        var div2 = $("#ttshow_img_list_space div[img]").eq(0);
                                        div2.css("background-image","url(" + div2.attr("img") + ")");
                                        div2.css("display","block");
                                        div2.removeAttr("img");
                                        div2.unbind('click').bind( 'click' , $.ttshow_change_img_event );
                                        
                                        if( $("#ttshow_img_list_space img[img]").length != 0 ) {
                                            var div = $("#ttshow_img_list_space img[img]").eq(0);
                                            div.attr("src", div.attr("img") );
                                            div.removeAttr("img");
                                            div.load( change );
                                            div.error( change );
                                        }
                                //}
                        };
                        div.load( change );
                }catch(e) {
                        console.log(e);
                }
                console.log(data);
        };
        errorback = function( data ){
            console.log(data);
        };
        $.CGI_proxy( "POST" , "php/backend_manage_img.php" , data , "" , callback , errorback );
}



function FB_connected_callback_init( data ) {
    
            $.member = data;
            
            tinymce.init({"theme":"modern",
                    "height" : "480px" ,
                    "skin":"lightgray",
                    "language":"en",
                    "formats":{"alignleft":[{"selector":"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li","styles":{"textAlign":"left"},"deep":false,"remove":"none"},{"selector":"img,table,dl.wp-caption","classes":["alignleft"],"deep":false,"remove":"none"}],"aligncenter":[{"selector":"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li","styles":{"textAlign":"center"},"deep":false,"remove":"none"},{"selector":"img,table,dl.wp-caption","classes":["aligncenter"],"deep":false,"remove":"none"}],"alignright":[{"selector":"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li","styles":{"textAlign":"right"},"deep":false,"remove":"none"},{"selector":"img,table,dl.wp-caption","classes":["alignright"],"deep":false,"remove":"none"}],"strikethrough":{"inline":"del","deep":true,"split":true}},
                    "fontsize_formats": "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
                    "relative_urls":false,
                    "remove_script_host":false,
                    "convert_urls":false,
                    "browser_spellcheck":true,
                    "fix_list_elements":true,
                    "entities":"38,amp,60,lt,62,gt",
                    "entity_encoding":"raw",
                    "extended_valid_elements" : "iframe[src|title|width|height|allowfullscreen|frameborder]",
                    "keep_styles":false,
                    "cache_suffix":"wp-mce-4109-20150505",
                    "preview_styles":"font-family font-size font-weight font-style text-decoration text-transform",
                    "end_container_on_empty_block":true,
                    "wpeditimage_disable_captions":false,
                    "wpeditimage_html5_captions":true,
                    "plugins":"charmap,colorpicker,code,hr,link,autolink,lists,media,paste,tabfocus,textcolor,fullscreen,wpautoresize,wpemoji,wpgallery,wpdialogs,wpview,youtube",
                    //"content_css":"http://www.ooxxoox.com/arod/wordpress/wp-includes/css/dashicons.min.css?ver=4.2.2,http://www.ooxxoox.com/arod/wordpress/wp-includes/js/tinymce/skins/wordpress/wp-content.css?ver=4.2.2,//fonts.googleapis.com/css?family=Noto+Sans%3A400italic%2C700italic%2C400%2C700%7CNoto+Serif%3A400italic%2C700italic%2C400%2C700%7CInconsolata%3A400%2C700&subset=latin%2Clatin-ext,http://www.ooxxoox.com/arod/wordpress/wp-content/themes/twentyfifteen/css/editor-style.css,http://www.ooxxoox.com/arod/wordpress/wp-content/themes/twentyfifteen/genericons/genericons.css",
                    "content_css":"http://" + location.host + "/template/assets/css/ace.css",
                    "selector":"#editor_place",
                    "resize":false,
                    "menubar":false,
                    "wpautop":true,
                    "indent":false,
                    "toolbar1":"bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,wplink",
                    "toolbar2":"formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,youtube",
                    "toolbar3":"fontsizeselect,code,wp_more,spellchecker,dfw,wp_adv,advlink,link,unlink",
                    "tabfocus_elements":"content-html,save-post",
                    "body_class":"content post-type-post post-status-auto-draft post-format-standard locale-zh-tw",
                    "wp_autoresize_on":true,
                    "add_unload_trigger":false,
                    "init_instance_callback":editor_init});
            
}

function FB_unconnected_callback_init( data ) {
    console.log( data );
}

function editor_init(inst) {
        
        console.log( $( "#editor_place_ifr" ).height() );
        console.log( "editor_init" );
        tinymce.activeEditor.on('ObjectResizeStart', function(e) {
            console.log( e.target.nodeName );
            if (e.target.nodeName == 'IMG') {
                // Prevent resize
                e.preventDefault();
            }
        });

        tinymce.activeEditor.on('ObjectResized', function(e) {
            console.log( $( e.target ) );
            $( e.target ).attr( "height" , "100%" );
        });
        
        $(document).ready(function() {
                ttshow_login_event( $.member );
        });
}

function save_process() {
            
            var html = $( "#editor_place_hide" );
            
            $.all_data_inEdit.img = {};
            $.all_data_inEdit.movie = {};
            var img_index = 0;
            var ifame_index = 0;
            var exist_index = [];
            $.each( html.find( "img[data-pos=page]" ) , function( index , value ) {
                    exist_index[ exist_index.length ] = parseInt( $( value ).attr( "data-index" ) );
            });
            $.each( html.find( "img[data-pos=member]" ) , function( index , value ) {
                
                        console.log( img_index )
                        console.log( exist_index )
                        while(1) {
                            if( $.inArray( img_index , exist_index ) === -1 ) {
                                break;
                            }
                            else {
                                img_index++;
                            }
                        }
                        
                        var tag = $( value );
                        var src = tag.attr("src");
                        src = src.substr(src.lastIndexOf("/")+1,src.length);
                        var src_type = src.split(".")[1];///bohan++
                        tag.attr("img_index", img_index );

                        var tag_count = 0;
                        var tag_src = "";
                        var tag_http = "";
                        var get_ = function( src , count ) {
                            if( src.indexOf("../") != -1 ) {
                                src = src.replace("../","");
                                count++;
                                get_( src , count );
                            } else {
                                tag_src = src;
                                tag_count = count;
                                return 0;
                            }
                        };
                        var release_get_ = function( src , count ) {
                            if( count != -1 ) {
                                src = src.substr( 0 , src.lastIndexOf("/") );
                                count--;
                                release_get_( src , count );
                            } else {
                                tag_http = src + "/";
                                return 0;
                            }
                        }
                        if( tag.attr("src").indexOf("../") != -1 ) {
                            var img_src = get_( tag.attr("src") , 0 );
                            var http = release_get_( window.location.href  , tag_count );
                            tag_src = tag_http + tag_src;
                            console.log("!!!");
                            console.log( tag_src );
                        } else {
                            tag_src = tag.attr("src");
                        }
                        
                        $.all_data_inEdit.img[img_index] = tag_src;
                        //tag.attr("src" , "image_" + img_index );
                        tag.attr("src" , "image_" + img_index + "." + src_type );//bohan++
                        tag.css("max-width","100%");
                        //tag.attr( "data-pos" , "page" );
                        img_index++;
            });
            $.edit = $( "#editor_place_hide" ).html();
            
            $.each( html.find( "img[data-video=youtube]" ) , function( index , value ) {
                        var tag = $( value );
                        
                        var iframe_html = '<div class="youtobe_video" style="">' +
                                            '<div style="max-width: 100%; width:' + tag.attr( "width" ) + 'px; position: relative; float: none" name="u2_player">' +/*text-align: center; margin-right: auto; margin-left: auto; */
                                                    '<iframe src="//www.youtube.com/embed/' + tag.attr( "data-id" ) + '" mmtype="[\'youtube\']" key="video" mmid="1" style="border: none; margin-left: auto; margin-right: auto; height: 100%; width:100%;"></iframe>' +
                                            '</div>' +
                                        '</div>';
                        
                        /*var iframe_html = '<div class="youtobe_video">' +
                                                '<iframe style="max-width:100%;" width="' + tag.attr( "width" ) + '" height="' + tag.attr( "height" ) + '" src="https://www.youtube.com/embed/' + tag.attr( "data-id" ) + '" frameborder="0" allowfullscreen></iframe>' +
                                            '</div>';*/
                        $.all_data_inEdit.movie[ifame_index] = 'https://www.youtube.com/embed/' + tag.attr( "data-id" );
                        tag.after( iframe_html );
                        ifame_index++;
            });
            html.find( "img[data-video=youtube]" ).remove();
            
            console.log( $.all_data_inEdit );
            
}
            