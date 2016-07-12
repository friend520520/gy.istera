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
                            $.View.view_sidebar().options().click_img.attr("src" , src );
                            $("#change_img_select_modal").modal("hide");
                    }
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
                    display_loading_page();
                    if( $.getData.state == "modify" ) {
                            ttsho_modify_publish();
                    } else if( $.getData.state == "edit" ) {
                            ttsho_edit_publish();
                    }
            });
            //page publish --
});

var ttshow_init_model = function( FilePath ) {
        $.ajax({type: "GET",
                //url: "backend/ForTTShow/edit_file/edit.php",
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
         });
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
                        var model = "backend/ForTTShow/edit_file/edit_1.php";
                        var i = 0;
                        ttshow_init_model( model );
                        $("#ttshow_publish_page").html("發布文章");
                        
                        $("#ttshow_channel_select").html("");
                        $("#ttshow_class_select").html("");
                        $("#ttshow_tag_space").html("");
                        $("#ttshow_tag_space").append('<div class="clearfix"></div>');
                        
                        for(i=0;i<data.channel.length;i++) {
                                var opt = document.createElement('option');
                                opt.value = data.channel[i].id;
                                opt.innerHTML = data.channel[i].name;
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
                        $.View.view_shelldata()._SetOpts({ putdata : data.page.file });
                        $.View.view_shelldata().putFile();
                        
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
        var callback = function(data) { console.log(data); disable_loading_page(); };
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
            try {
                console.log(JSON.parse( data ));
            } catch(e) {
                console.log(e);
            }
            disable_loading_page();
        };
        errorback = function( data ){
            console.log(data);
        };
        $.CGI_proxy( "POST" , "php/backend_publish_page.php" , data , "" , callback , errorback );
}

var process_publish_data = function() {
        downloadLayoutSrc();
        var Copy = $( "#main_container"  ).clone();
        var process = $("#download-layout").clone();
                    
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
                html : $("#publishModal").data( "tmp_html" ) ,
                edit : Copy.html() ,
                content : process.html() ,
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
                        $.each( data , function(index, value) {
                                var clone = $("#ttshow_img_list_example_model_2").clone();
                                var clone_div = $("#ttshow_img_list_example_model").clone();
                                clone.removeAttr("id");
                                clone_div.removeAttr("id");
                                //clone.attr("src", url + value );
                                clone.attr("img", url + value);
                                clone_div.attr("img", url + value);
                                $("#ttshow_img_list_space").append( clone );
                                $("#ttshow_img_list_space").append( clone_div );
                        });
                        var div = $("#ttshow_img_list_space img[img]").eq(0);
                        div.attr("src", div.attr("img") );
                        div.removeAttr("img");
                        
                        var div2 = $("#ttshow_img_list_space img[img]").eq(0);
                        div2.css("background-image","url(" + div2.attr("img") + ")");
                        div2.removeAttr("img");
                        $.ttshow_change_img_event = function(e) {
                                $("#ttshow_img_list_space div").css("border" , "1px solid black" );
                                $("#ttshow_img_list_space div").removeAttr("target");
                                $( e.target ).css("border" , "5px solid gray" );
                                $( e.target ).attr("target","");
                        }
                        var change = function() {
                                if( $("#ttshow_img_list_space img[img]").length != 0 ) {
                                        var div = $("#ttshow_img_list_space img[img]").eq(0);
                                        div.attr("src", div.attr("img") );
                                        div.removeAttr("img");
                                        div.load( change );
                                        div.error( change );
                                        
                                        var div2 = $("#ttshow_img_list_space div[img]").eq(0);
                                        div2.css("background-image","url(" + div2.attr("img") + ")");
                                        div2.css("display","block");
                                        div2.removeAttr("img");
                                        div2.unbind('click').bind( 'click' , $.ttshow_change_img_event );
                                }
                                console.log( $("#ttshow_img_list_space img[img]").length );
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
        $(document).ready(function() {
                ttshow_login_event( data );
        });
}

function FB_unconnected_callback_init( data ) {
    console.log( data );
}

