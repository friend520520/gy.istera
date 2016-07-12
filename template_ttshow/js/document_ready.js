
$(document).ready(function() {
        $( "body" ).bind( 'init_ready_check_list' , function() {
                $("#page_list").html("");
                var callback = function(data) {
                    if( data != "false" ) {
                        var msg = eval(data);
                        var html_modal = "html_obj";
                        $.each( msg , function(index, value) {
                                html_modal = $("#check_model_example").clone();
                                html_modal.removeAttr("id");
                                html_modal.css( "display" , "block" );
                                
                                if( value.article_icon != "undefined") {
                                        html_modal.find("[id=page_image]").attr("src", value.article_icon );
                                        html_modal.find("[id=page_image]").css("width","360px");
                                        html_modal.find("[id=page_image]").css("height","270px")
                                }
                                html_modal.find("[id=page_name]").html( decodeURI(value.name) );
                                html_modal.find("[id=editor_name]").html( value.user );
                                html_modal.find("[id=editor_describe]").html( decodeURI(value.describe) );
                                html_modal.find("[id=editor_class]").html( decodeURI(value.class) );
                                /*
                                html_modal.find("[id=editor_class]").html( 
                                    $("#CheckProject_class").find("option[value=" + value.class + "]").html()    
                                );
                                html_modal.find("[id=editor_special_tag]").html( 
                                    $("#CheckProject_specialtag").find("option[value=" + value.special_tag + "]").html()    
                                );
                                html_modal.find("[id=editor_tag]").html( decodeURI(value.tag) );
                                */
                                html_modal.find("[id=editor_time]").html( value.time );
                                html_modal.attr("index", value.index );
                                
                                html_modal.find("[id=preview]").attr( "link" , value.path );
                                $("#page_list").append( html_modal );
                        });
                        $("#page_list div[index]").unbind('click').bind( 'click' , function(e) {
                                if( $(e.target).attr("id") == "check_yes" ) {
                                        $("#myModalCheckProjectSuccess").attr("index", $(this).attr("index") );
                                        $("#myModalCheckProjectSuccess_Name").html( $(this).find("[id=page_name]").html());
                                        $("#myModalCheckProjectSuccess_Message").html("");
                                        var html_obj = $(this).clone();
                                        html_obj.find("button[id^=check_]").remove();
                                        html_obj.find("button[id=preview]").unbind('click').bind( 'click' , function(e) {
                                            window.open( $(this).attr("link") );
                                        });
                                        $("#myModalCheckProjectSuccess_Message").append( html_obj );
                                        $("#myModalCheckProjectSuccess").modal("show");
                                } else if( $(e.target).attr("id") == "check_no" ) {
                                        $("#myModalCheckProjectFail").attr("index", $(this).attr("index") );
                                        $("#myModalCheckProjectFail_Name").html( $(this).find("[id=page_name]").html());

                                        $("#myModalCheckProjectFail_Message").html("");
                                        var html_obj = $(this).clone();
                                        html_obj.find("button[id=preview]").unbind('click').bind( 'click' , function(e) {
                                            window.open( $(this).attr("link") );
                                        });
                                        $("#myModalCheckProjectFail_Message").append( html_obj );
                                        html_obj.find("button[id^=check_]").remove();
                                        
                                        $("#myModalCheckProjectFail").modal("show");
                                } else if( $(e.target).attr("id") == "preview" ) {
                                        window.open( $(e.target).attr("link") );
                                }
                                e.preventDefault();
                        });
                    }
                };                
                $.Ajax( "POST" , "php/pagecheck_list_project.php" , { user_mail : $.UserMsg.email } , {} , callback , "" );
        });
        
        $( "body" ).bind( 'init_draft_list' , function() {
                $("#page_list").html("");
                var callback = function(data) {  
                    if( data != "false" ) {
                        var msg = JSON.parse( data );
                        console.log(msg);
                        var html_modal = "html_obj";
                        $.each( msg , function(index, value) {
                                if( value.type == "folder" ) {
                                        html_modal = $("#editor_model_example").clone();
                                        html_modal.removeAttr("id");
                                        html_modal.css( "display" , "block" );
                                        html_modal.find("[id=page_name]").html( decodeURI(value.name) );
                                        html_modal.find("[id=page_name]").css("margin-bottom" ,"10px");
                                        html_modal.attr("draft", value.draft );
                                        html_modal.attr("state", value.state );
                                        html_modal.attr("class_name", value.class );
                                        if( value.state == "uncheck" ) {
                                                html_modal.find("[id=check_state]").html("未審核");
                                        } else if( value.state == "check_fail" ) {
                                                html_modal.find("[id=check_state]").html("審核失敗");
                                                html_modal.find("[id=check_state]").attr("class","label label-danger arrowed-in arrowed-in-right col-xs-12");
                                                html_modal.find("[id=check_state]").attr("style","width: 90px; margin-left: 22%;");
                                        } else if( value.state == "check_ing" ) {
                                                html_modal.find("[id=check_state]").html("審核中");
                                                //html_modal.find("[id=check_state]").css("background-color","rgba(255, 127, 39, 0.9)");
                                                html_modal.find("[id=check_state]").attr("class","label label-danger arrowed-in arrowed-in-right arrowed-in-orange arrowed-in-orange-right");
                                                html_modal.find("[id=check_state]").attr("style","background: orange;width: 90px; margin-left: 22%;");
                                                
                                                html_modal.find("[id=page_delete]").attr("class","");
                                                html_modal.find("[id=page_delete]").attr("style","float: left; color: gray; margin: 15px 10px 10px 0px; border: 1px solid gray; background-color: white; padding: 7px 14px; font-size: 10pt;");
                                                html_modal.find("[id=page_edit]").attr("class","");
                                                html_modal.find("[id=page_edit]").attr("style","float: left; color: gray; margin: 15px 10px 10px 0px; border: 1px solid gray; background-color: white; padding: 7px 14px; font-size: 10pt;");
                                                html_modal.find("[id=page_check]").attr("class","");
                                                html_modal.find("[id=page_check]").attr("style","float: left; color: gray; margin: 15px 10px 10px 0px; border: 1px solid gray; background-color: white; padding: 7px 14px; font-size: 10pt;");
                                                
                                        }
                                        $("#page_list").append( html_modal );
                                }
                        });
                        $("div[draft]").unbind('click').bind( 'click' , function(e) {
                                if( $(this).attr("state") != "check_ing" ) {
                                        if( $(e.target).attr("id") == "page_delete" ) {
                                                $("#myModalDeleteProject_Name").html( $(this).find("[id=page_name]").html() );
                                                $("#myModalDeleteProject").attr("draft", $(this).attr("draft") );
                                                $("#myModalDeleteProject").modal('show');
                                        } else if( $(e.target).attr("id") == "page_edit" ) {
                                                window.open( "backend/index.html?" + $(this).attr("draft") );
                                        } else if( $(e.target).attr("id") == "page_check" ) {
                                                $("#myModalCheckProject_Name").html( $(this).find("[id=page_name]").html() );
                                                $("#myModalCheckProject_Class").html( $(this).attr("class_name") );
                                                $("#myModalCheckProject").attr("draft", $(this).attr("draft") );
                                                $("#myModalCheckProject").modal('show');
                                        }
                                }
                                e.preventDefault();
                        });
                        console.log(msg);
                    }
                };                
                $.Ajax( "POST" , "php/pageedit_list_project.php" , { user_mail : $.UserMsg.email } , {} , callback , "" );
        });

        $( "body" ).bind( 'init_page_list' , function() {
                $("#page_list").html("");
                var callback = function(data) {  
                    if( data != "false" ) {
                        var data = JSON.parse( data );
                        console.log(data);
                        var html_modal = "html_obj";
                        $.each( data , function(index, value) {
                                html_modal = $("#check_model_example").clone();
                                html_modal.removeAttr("id");
                                html_modal.css( "display" , "block" );
                                if( value.icon_path != "undefined") {
                                    html_modal.find("[id=page_image]").attr("src",value.icon_path);
                                    html_modal.find("[id=page_image]").css("width","360px");
                                    html_modal.find("[id=page_image]").css("height","270px")
                                }
                                html_modal.find("[id=editor_class]").html( decodeURI(value.class) );
                                
                                html_modal.find("[id=page_name]").html( decodeURI(value.title) );
                                html_modal.find("[id=editor_describe]").html( decodeURI(value.describe) );
                                html_modal.find("[id=editor_time]").html( value.time );
                                $("#page_list").append( html_modal );
                                html_modal.find("[id=editor_special_tag]").parent().remove();
                                html_modal.find("[id=editor_name]").parent().remove();
                                html_modal.find("[id=editor_tag]").parent().remove();
                                html_modal.find("[id=check_yes]").remove();
                                html_modal.find("[id=check_no]").remove();
                                html_modal.find("[id=preview]").remove();
                        });
                    }
                };                
                $.Ajax( "POST" , "php/page_list_project.php" , { user_mail : $.UserMsg.email } , {} , callback , "" );
        });
      
        $( "#page_add" ).unbind('click').bind( 'click' , function() {
                var ProjectName = $("#page_create_name").val();
                if( ProjectName == "" ) {
                    alert("請輸入文章名稱");
                } else {
                    if( $.InputCheack( "ProjectName" , ProjectName ) ) {
                        alert( "請勿輸入特殊自符(~!@#$%^&*()_+-/\\)" );
                    }
                    else {
                        var callback = function(data) {  
                            if( data == "false" ) {
                                alert( "文章名稱重複" );
                            } else if( data == "true" ) {
                                $( "body" ).trigger( "init_draft_list" );
                            }
                        };
                        var data = {
                            user_mail : $.UserMsg.email ,
                            project : encodeURI( ProjectName ) ,
                            html : "" ,
                            edit : ""                    
                        };
                        $.Ajax( "POST" , "php/pageedit_create_project.php" , data , {} , callback , "" );       
                    }
                }
        });
        //Delete Project ++
        $("#myModalDeleteProject_Yes").unbind('click').bind( 'click' , function() {
                var callback = function(data) {  
                    console.log( data );
                    if( data == "true") {
                            $( "body" ).trigger( "init_draft_list" );
                            $("#myModalDeleteProject").modal('hide');
                    } else {
                            console.log( data );
                            $( "body" ).trigger( "init_draft_list" );
                    }
                };
                var data = {
                    user_mail : $.UserMsg.email ,
                    draft : $("#myModalDeleteProject").attr("draft"),
                    project : encodeURI( $("#myModalDeleteProject_Name").html() ) ,
                };
                $.Ajax( "POST" , "php/pageedit_delete_project.php" , data , {} , callback , "" );
        });

        $('#myModalDeleteProject')
        .on('show.bs.modal', function (e) {
        })
        .on('hidden.bs.modal', function (e) {
                $("#myModalDeleteProject_Name").html("");
                $("#myModalDeleteProject").attr("draft" , "");
        });
        //Delete Project --

        //Check Project ++
        $("#myModalCheckProject_Yes").unbind('click').bind( 'click' , function() {
                //copy file
                var callback = function(data) { 
                    console.log( data );
                    if( data == "true") {
                            $( "body" ).trigger( "init_draft_list" );
                            $("#myModalCheckProject").modal('hide');
                    } else {
                            console.log( data );
                            $( "body" ).trigger( "init_draft_list" );
                    }
                };
                var data_target = $("#myModalCheckProject .modal-body");
                var article_icon = "";
                if ( $("#CheckProject_drop_img_c").attr("src") == "" ) {
                        article_icon = "undefined";
                } else {
                        article_icon = $("#CheckProject_drop_img_c").attr("src");
                }
                var dialog_data = {
                        article_icon : article_icon ,
                        title : data_target.find("[data-input=title]").val() ,
                        describe : data_target.find("[data-input=describe]").val() ,
                };
                var data = {
                    user_mail : $.UserMsg.email ,
                    draft : $("#myModalCheckProject").attr("draft"),
                    project : encodeURI( $("#myModalCheckProject_Name").html() ) ,
                    data : JSON.stringify( dialog_data )
                };
                $.Ajax( "POST" , "php/pageedit_publish_project.php" , data , {} , callback , "" );
        });

        $('#myModalCheckProject')
        .on('show.bs.modal', function (e) {
        })
        .on('hidden.bs.modal', function (e) {
                $("#myModalCheckProject_Name").html("");
                $("#CheckProject_drop_img_o").css("display","block");
                $("#CheckProject_drop_img_c").css("display","none");
                $("#CheckProject_drop_img_c").attr("src","");
        });
        //Check Project --
        
        //Check Project Fail++
        $("#myModalCheckProjectFail_Yes").unbind('click').bind( 'click' , function() {
                var callback = function(data) {  
                    console.log( data );
                    if( data == "true") {
                            $( "body" ).trigger( "init_ready_check_list" );
                            $("#myModalCheckProjectFail").modal('hide');
                    } else {
                            console.log( data );
                            $( "body" ).trigger( "init_ready_check_list" );
                    }
                };
                var data = {
                    index : $("#myModalCheckProjectFail").attr("index") ,
                };
                $.Ajax( "POST" , "php/pagecheck_delete_project.php" , data , {} , callback , "" );
        });

        $('#myModalCheckProjectFail')
        .on('show.bs.modal', function (e) {
        })
        .on('hidden.bs.modal', function (e) {
                $("#myModalCheckProjectFail").attr("index" , "");
        });
        //Check Project Fail--
        
        //Check Project Success++
        $("#myModalCheckProjectSuccess_Yes").unbind('click').bind( 'click' , function() {
                var callback = function(data) {  
                    console.log( data );
                    if( data == "true") {
                            $( "body" ).trigger( "init_ready_check_list" );
                            $("#myModalCheckProjectSuccess").modal('hide');
                    } else {
                            console.log( data );
                            $( "body" ).trigger( "init_ready_check_list" );
                    }
                };
                var data = {
                    user_mail : $.UserMsg.email ,
                    index : $("#myModalCheckProjectSuccess").attr("index") ,
                    special_tag : $("#myModalCheckProjectSuccess [id=CheckProject_specialtag] select").val() ,
                };
                console.log( data );
                try {
                        var val = $("#myModalCheckProjectSuccess [data-input=tag]").val();
                        if( val != "" ) {
                                var obj = { val : [] };
                                val = val.replace(/,/g,"").split("#");                        
                                for(var i=0; i<val.length; i++) {
                                    if( val[i] != "" && val[i] != " " ) {
                                        obj.val[obj.val.length] = val[i];
                                    }
                                }
                                var tag = JSON.stringify( obj );
                                tag = tag.replace( "{\"val\":" , "").replace( "}" , "");
                                data.tag = tag;
                                eval(tag);
                                console.log( tag );
                                $.Ajax( "POST" , "php/pagecheck_publish_project.php" , data , {} , callback , "" );
                        }
                        else {
                                data.tag = "[]";
                                eval(data.tag);
                                $.Ajax( "POST" , "php/pagecheck_publish_project.php" , data , {} , callback , "" );                                
                        }
                }catch(e) {
                        alert("輸入格式錯誤\n輸入範例: #娛樂圈#藝人");
                        console.log(e);
                }
        });

        $('#myModalCheckProjectSuccess')
        .on('show.bs.modal', function (e) {
        })
        .on('hidden.bs.modal', function (e) {
                $("#myModalCheckProjectSuccess").attr("index" , "");
        });
        //Check Project Success--
        
        $("#get_ready_check").unbind('click').bind( 'click' , function() {
                $( "body" ).trigger( "init_ready_check_list" );            
                $("#page_add_layout").css("display","none");
        });
        $("#get_my_draft").unbind('click').bind( 'click' , function() {
                $( "body" ).trigger( "init_draft_list" );
                $("#page_add_layout").css("display","block");
        });

        $("#get_my_page").unbind('click').bind( 'click' , function() {
                $( "body" ).trigger( "init_page_list" );          
                $("#page_add_layout").css("display","none");
        });
        function init_CheckProject_Dailog() {
                var callback = function(data) {  
                    console.log( data );
                    var data = JSON.parse( data );
                    var class_html = "";
                    var specialtag_html = "";
                    $.each( data.class , function(index, value) {
                            class_html += '<option value="' + index + '">' + decodeURI(value) + '</option>'
                    });
                    $.each( data.specialtag , function(index, value) {
                            specialtag_html += '<option value="' + index + '">' + decodeURI(value) + '</option>'
                    });
                    $("#CheckProject_specialtag").append("<select>" + specialtag_html + "</select>");
                    $("#CheckProject_class").append("<select>" + class_html + "</select>");
                };
                $.Ajax( "POST" , "php/get_class_specialtag_list.php" , {} , {} , callback , "" );
        }
        init_CheckProject_Dailog();
/*        
        $("#get_draft_check_ing").unbind('click').bind( 'click' , function() {
                $( "body" ).trigger( "init_page_list_check_ing" );
                $("#page_add_layout").css("display","none");
        });
*/
        
        //specialtag        





// apply account for member.php  &  signup.php  ++

        $("#apply_account_sensible").unbind('click').bind( 'click' , function() {
                var bir = $("#apply_channel_form").find("#birthday_y").val() + "/" + $("#apply_channel_form").find("#birthday_m").val() + "/" + $("#apply_channel_form").find("#birthday_d").val();
                if( bir != "//") {
                    var time = new Date(bir);
                    bir = time.getTime();
                } else {
                    bir = "null";
                }
                var usertype = "";
                if( $.UserMsg.DB.usertype == "" && $("#channel_form_1").css("display") == "block") {
                    usertype = "uneditor";
                } else {
                    usertype = $.UserMsg.DB.usertype;
                }
                var data = {
                        user_mail : $.UserMsg.email,
                        user_data : {
                                usericon : $("#apply_channel_form").find("#user_uploadIcon_c").attr("src"),
                                cover_photo : $("#user_uploadCover_photo_c").attr("src"),
                                usertype : usertype,
                                email : $("#apply_channel_form").find("#email").val(),
                                nickname : $("#apply_channel_form").find("#nickname").val(),
                                birthday : bir,
                                sex : $("#apply_channel_form").find("input[name=sex]:checked").val() ,
                                residence : $("#apply_channel_form").find("#residence").val(),
                                phone : $("#apply_channel_form").find("#phone").val(),
                                channel_name : $("#apply_channel_form").find("#channel_name").val(),
                                identification : $("#apply_channel_form").find("#identification").val(),
                                channel_introduce : $("#apply_channel_form").find("#channel_introduce").val(),
                                channel_url : $("#apply_channel_form").find("#channel_url").val(),
                                fb_club_name : $("#apply_channel_form").find("#fb_club_name").val(),
                                fb_club_url : $("#apply_channel_form").find("#fb_club_url").val(),
                                fb_club_number : $("#apply_channel_form").find("#fb_club_number").val(),
                                fb_user_url : $("#apply_channel_form").find("#fb_user_url").val(),
                                fb_follow_number : $("#apply_channel_form").find("#fb_follow_number").val(),
                                yt_name : $("#apply_channel_form").find("#yt_name").val(),
                                yt_url : $("#apply_channel_form").find("#yt_url").val(),
                                yt_subscribe : $("#apply_channel_form").find("#yt_subscribe").val(),
                                yt_view : $("#apply_channel_form").find("#yt_view").val(),
                                ig_id : $("#apply_channel_form").find("#ig_id").val(),
                                ig_number : $("#apply_channel_form").find("#ig_number").val(),
                                other_association : $("#apply_channel_form").find("#other_association").val(),
                        }
                };
                var callback = function(data) {  
                        console.log( data );
                        $("#myModalApplySuccess").modal('show');
                };
                $.Ajax( "POST" , "php/apply_account_general.php" , data , {} , callback , "" );
        });
        
        $('#myModalApplySuccess')
        .on('show.bs.modal', function (e) {
        })
        .on('hidden.bs.modal', function (e) {
                if( $("#channel_form_1").css("display") == "block" ) {
                    location.href = "apply_account.php?modify_account";
                } else {
                    location.href = "apply_account.php?apply_channel";
                }
        });

        $("#apply_channel").unbind('click').bind( 'click' , function() {
                //display & ajax get data to input
                $("#modify_account").click();
                $.ajax({
                        type: "POST",
                        url: "php/member.php?func=loginbyFB",
                        data: {
                            email : $.UserMsg.email ,
                            id    : $.UserMsg.id ,
                            name    : $.UserMsg.name
                        },
                        success: function(data) {
                            console.log(data);
                            data = JSON.parse( data );
                            $.UserMsg.DB = data;
                            if( $.UserMsg.DB.usertype == "" ) {
                                    $("#apply_channel_form").css("display","block");
                                    $("#form_title").html("申請合作頻道資料/達人");
                                    $.each( $.UserMsg.DB , function(index, value) {
                                            if( index == "sex" && (value == "man" || value == "woman" ) ) {
                                                $("#apply_channel_form").find("input[name=sex][value=" + value + "]")[0].checked = true;
                                            } else if( index == "usericon" ) {
                                                if( value.search("http") != -1 ) {
                                                    $("#apply_channel_form").find("#user_uploadIcon_o").css("display","none");
                                                    $("#apply_channel_form").find("#user_uploadIcon_c").css("display","block");
                                                    $("#apply_channel_form").find("#user_uploadIcon_c").attr( "src" , value );
                                                }
                                            } else if( index == "cover_photo" ) {
                                                if( value.search("http") != -1 ) {
                                                    $("#user_uploadCover_photo_o").css("display","none");
                                                    $("#user_uploadCover_photo_c").css("display","block");
                                                    $("#user_uploadCover_photo_c").attr( "src" , value );
                                                }
                                            }  
                                            else if( index == "birthday") {
                                                    var s = value.split("-");
                                                    $("#apply_channel_form").find("#birthday_y").val( parseInt(s[0]) );
                                                    $("#apply_channel_form").find("#birthday_m").val( parseInt(s[1]) );
                                                    $("#apply_channel_form").find("#birthday_d").val( parseInt(s[2]) );
                                            } else if( index == "identification" ) {
                                                    $("#apply_channel_form").find("#identification").val( value );
                                            } else {
                                                $("#apply_channel_form").find("#"+index).val( value );
                                            }
                                    });
                                    $("#channel_form_1 , #channel_form_2").css("display","block");
                            }
                        }
                });
        });

        $("#modify_account").unbind('click').bind( 'click' , function() {
                $.ajax({
                        type: "POST",
                        url: "php/member.php?func=loginbyFB",
                        data: {
                            email : $.UserMsg.email ,
                            id    : $.UserMsg.id ,
                            name    : $.UserMsg.name
                        },
                        success: function(data) {
                            console.log(data);
                            data = JSON.parse( data );
                            $.UserMsg.DB = data;
                            if( $.UserMsg.DB.usertype == "uneditor" ) {
                                    $("#apply_channel_form").css("display","none");
                                    $("#apply_member_form").css("display","none");
                                    $("#form_title").html("審核中");
                                    $("#form_title").css("color","red");
                            } else {
                                    $("#apply_channel_form").css("display","block"); 
                                    $("#form_title").html("修改會員資料");
                                    if( $.UserMsg.DB.usertype == "" ) {
                                            $("#channel_form_1 , #channel_form_2").css("display","none");
                                    } else {
                                            $("#channel_form_1 , #channel_form_2").css("display","block");
                                    }
                                    
                                    $.each( $.UserMsg.DB , function(index, value) {
                                            if( index == "sex" && (value == "man" || value == "woman" ) ) {
                                                $("#apply_channel_form").find("input[name=sex][value=" + value + "]")[0].checked = true;
                                            } else if( index == "usericon" ) {
                                                if( value.search("http") != -1 ) {
                                                    $("#apply_channel_form").find("#user_uploadIcon_o").css("display","none");
                                                    $("#apply_channel_form").find("#user_uploadIcon_c").css("display","block");
                                                    $("#apply_channel_form").find("#user_uploadIcon_c").attr( "src" , value );
                                                }
                                            } else if( index == "birthday") {
                                                    var s = value.split("-");
                                                    $("#apply_channel_form").find("#birthday_y").val( parseInt(s[0]) );
                                                    $("#apply_channel_form").find("#birthday_m").val( parseInt(s[1]) );
                                                    $("#apply_channel_form").find("#birthday_d").val( parseInt(s[2]) );
                                            } else if( index == "cover_photo" ) {
                                                if( value.search("http") != -1 ) {
                                                    $("#user_uploadCover_photo_o").css("display","none");
                                                    $("#user_uploadCover_photo_c").css("display","block");
                                                    $("#user_uploadCover_photo_c").attr( "src" , value );
                                                }
                                            } else if( index == "identification" ) {
                                                    $("#apply_channel_form").find("#identification").val( value );
                                            } else {
                                                $("#apply_channel_form").find("#"+index).val( value );
                                            }
                                    });
                            }
                        }
                });
        });
        //sidebar --

// apply account for member.php  &  signup.php  --





        

});

$.InputCheack = function( type , val ) {
        var data = {
            ProjectName : /[~!@#$%^&*()_+-/\\\s]/,
        }
        return data[type].test(val);
}

//unbind siderbar tag <a> link ++
$.init_sidebar = function() {
        var url = window.location.pathname;
        var filename = url.substring(url.lastIndexOf('/')+1);
        if( filename.indexOf("apply_account.php") != -1 ) {
                $("[href^='apply_account.php']").removeAttr("href");
                $("#apply_account ul").css("display","block");
                var url = window.location.toString();
                if( url.search("\\?") != -1 ) {
                        var page = url.split("?")[1];
                        if( page == "apply_channel" ) {
                                $("#apply_channel").click();
                        } else if( page == "modify_account" ) {
                                $("#modify_account").click();
                        }
                }
        } else if( filename.indexOf("listtext.php") != -1 ) {
                $("[href^='listtext.php']").removeAttr("href");
                var url = window.location.toString();
                if( url.search("\\?") != -1 ) {
                        var page = url.split("?")[1];
                        if( page == "draft" ) {
                                $("#get_my_editor ul").css("display","block");
                                $("#get_my_draft").click();
                        } else if( page == "page" ) {
                                $("#get_my_editor ul").css("display","block");
                                $("#get_my_page").click();
                        } else if( page == "check" ) {
                                $("#get_my_check ul").css("display","block");
                                $("#get_ready_check").click();
                        }
                }
        }
}
//unbind siderbar tag <a> link --
