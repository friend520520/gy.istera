<?php header("X-Frame-Options: DENY");?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale = 1.0, user-scalable = 0" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="app-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="apple-touch-fullscreen" content="yes" />
        <link rel='shortcut icon' href='template/images/favicon.ico' type='x-icon'>
        <title> 會員管理 | Funbook19.com </title>
        <meta name="description" content="What you see what you get Enjoy to Interactive with living objects">
	
        <link rel='shortcut icon' href='favicon.ico' type='x-icon'>
        <!--link href="template/css/style.css" rel="stylesheet" type="text/css">
        <link href="template/css/owl.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="template_ttshow/template/assets/css/bootstrap.css">
        <link rel="stylesheet" href="template_ttshow/template/assets/css/font-awesome.css">
        <link rel="stylesheet" href="template_ttshow/template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style"-->

        <link rel="stylesheet" href="template_help_j/css/all.css">
        <link href="template_help_j/template/css/mian.css" rel="stylesheet" type="text/css">
        <link href="template_help_j/template/css/info.css" rel="stylesheet" type="text/css">
        <link href="template_help_j/css/login.css" rel="stylesheet" type="text/css">
        <link href="template_help_j/css/bootstrap_al.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="http://www.ggyyggy.com/funbook19/template_ttshow/template/assets/css/font-awesome.css">

        <!-- jquery.dataTables -->
        <link rel="stylesheet" type="text/css" href="template_help_j/css/jquery.dataTables.css">

        <!--?php include( "js/all_js_h.php"); ?-->
        <?php include( "js/all_js.php"); ?>

        <script>
                $("document").ready(function() {

                        $("#mc").css({
                                color: "#2F8DCD"
                        });

                });
        </script>
                <script src="js/jquery.pagination.js"></script>
                <script src="js/arod/management_account.jquery.pagination.js"></script>
        <!--script src="js/search.js"></script-->
        <script src="js/batch.js"></script>

        <!-- include HIGHCHARTS-->
        <script src="js/highstock.js"></script>
        <script src="js/mgm_highchart_jack.js"></script>
        <script src="js/mgm_hichart_click_jack.js"></script>
        <!-- for arod edit function (點擊折線圖的點會呼叫的fun)-->

        <!-- datePicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <!-- jquery.dataTables -->
        <!--link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css"-->
        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="js/dataTablesPlugin.js"></script>

        <script>
                function initHighStockChart_cb(min, max) {

                        if (typeof $.datatable_table !== "undefined") {
                                var tmp_min = new Date(min).getTime();
                                var tmp_max = new Date(max).getTime();

                                // $.datatable_table.clear().draw();
                                $.datatable_table.destroy();

                                var column = ["時間", "會員", "上層會員", "付款選擇", "付費方式", "金額", "操作"];

                                $("#datatable").html("");
                                initSearchTable($("#datatable"), column);
                                initDataTable($("#datatable"), column);

                                // Array holding selected row IDs
                                var rows_selected = [];

                                //init 會員管理
                                $.datatable_table = $('#example').DataTable({
                                        //"ajax": 'examples/ajax/data/ids-arrays.txt' ,
                                        "ajax": 'php/json_mgm_vip_statistics.php?func=fn_hichart_zone_list_search&' +
                                                'startTime=' + tmp_min + '&' +
                                                'endTime=' + tmp_max + '&' +
                                                'operation_html=<button class="pink_btn edit" style="margin-right:5px;" id="pencil"><i class="ace-icon fa fa-pencil bigger-120"></i></button><button id="get_account" style="margin-right:5px;" class="pink_btn">查看會員</button>',
                                        'columnDefs': [{
                                                'targets': 0,
                                                'searchable': false,
                                                'orderable': false,
                                                'width': '1%',
                                                'className': 'dt-body-center',
                                                'render': function(data, type, full, meta) {
                                                        return '<input type="checkbox">';
                                                }
                                        }],
                                        'order': [
                                                [1, 'desc']
                                        ],
                                        'rowCallback': function(row, data, dataIndex) {
                                                // Get row ID
                                                var rowId = data[0];
                                                // console.log( rowId );
                                                // If row ID is in the list of selected row IDs
                                                if ($.inArray(rowId, rows_selected) !== -1) {
                                                        $(row).find('input[type="checkbox"]').prop('checked', true);
                                                        $(row).addClass('selected');
                                                }
                                        }
                                });
                        }

                }

                $.initDatatable_1 = function initDatatable_1() {

                        //destory dataTable
                        $("#example").DataTable().destroy();
                        $("#datatable").html("");

                        var column = ["信箱暱稱", "加盟商類別", "會員<br>種類", "上線會員", "下線<br>會員數<br>本月<br>新增<br>下線數", "本月點閱<br>累積點閱", "最後登入時間<br>註冊時間", "管理權限", "IP", "狀態", "操作"];

                        createSearchTable('#search_Datatable', '#example', column);

                        var ajax = 'php/json_mg_account.php?func=fn_btn_search_regex&' +
                                'operation_html_block=<div class="center" style="width:220px;"><button class="pink_btn edit" style="margin-right:5px;" id="pencil"><i class="ace-icon fa fa-pencil bigger-120"></i></button><button id="edit_franchisee" style="margin-right:5px;" class="pink_btn">加盟商</button><button id="pause_member" style="margin-right:5px;" class="pink_btn">暫停會員</button><button class="pink_btn edit page_delete" id="delete_member"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></div>&' +
                                'operation_html_blockade=<div class="center" style="width:220px;"><button class="pink_btn edit" style="margin-right:5px;" id="pencil"><i class="ace-icon fa fa-pencil bigger-120"></i></button><button id="edit_franchisee" style="margin-right:5px;" class="pink_btn">加盟商</button><button id="pause_member" style="margin-right:5px;" class="pink_btn orange_btn">恢復會員</button><button class="pink_btn edit page_delete" id="delete_member"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></div>';


                        var order = [
                                [1, 'desc']
                        ];

                        createTable('#datatable', '#example', column);
                        createDataTable('#example', ajax, order);
                        $('#example').data("rows_selected", []);
                        addEvent('#datatable', '#example');


                        //點擊查看
                        $('#example tbody').on('click', '[id=get_account]', function(e) {

                                var $row = $(this).closest('tr');
                                // Get row data
                                var data = $('#example').DataTable().row($row).data();
                                // Get row ID
                                //fn_list_management_account_single_dialogue();
                                //.api().ajax.url('newurl.php').load();
                                console.log(data);
                                // $.initDatatable_2( data[0] );
                                $.a_data = data;


                                $("#myModalEditNoticetitle").val("");
                                $("#myModalEditNoticecontent").val("");

                                var data = {
                                        token: getCookie("funbook_cookie")
                                };
                                var success_back = function(data) {

                                        data = JSON.parse(data);
                                        console.log(data);
                                        loading_ajax_hide();
                                        if (data.success) {

                                                var tmp_html = "";
                                                $.each(data.data, function(index, value) {
                                                        tmp_html += '<option a_id="' + value.a_id + '" value="' + value.a_nickname + '">' + value.a_nickname + '</option>';
                                                });
                                                $("#myModalEditNoticeClass").html(tmp_html);

                                                $("#myModalEditNoticeClass").val($.a_data[1]);
                                                $("#myModalEditNoticetitle").val($.a_data[2]);
                                                $("#myModalEditNoticecontent").val($.a_data[3]);


                                        } else {
                                                show_remind(data.msg, "error");
                                        }

                                }
                                var error_back = function(data) {
                                        console.log(data);
                                }
                                $.Ajax("POST", "/arod/funbook19/php/json_common_problem.php?func=fn_list_option_all_common_problem_class", data, "", success_back, error_back);

                                $("#myModalEditNotice").modal("show");

                                $("#myModalSetMessage").unbind("click").bind("click", function() {

                                        var data = {
                                                token: getCookie("funbook_cookie"),
                                                cp_id: $.a_data[0],
                                                //class       : $( "#myModalEditNoticeClass" ).val()      ,
                                                title: $("#myModalEditNoticetitle").val(),
                                                description: $("#myModalEditNoticecontent").val()
                                        };
                                        var success_back = function(data) {

                                                data = JSON.parse(data);
                                                console.log(data);
                                                loading_ajax_hide();
                                                if (data.success) {

                                                        $.initDatatable_1();
                                                        $("#myModalEditNotice").modal("hide");
                                                        show_remind("修改成功");

                                                } else {

                                                        show_remind(data.msg, "error");

                                                }

                                        }
                                        var error_back = function(data) {
                                                console.log(data);
                                        }
                                        $.Ajax("POST", "./php/json_common_problem.php?func=fn_put_common_problem", data, "", success_back, error_back);

                                });

                        });

                }

                $.initDatatable_2 = function initDatatable_2(select_date) {

                        //destory dataTable
                        $("#example2").DataTable().destroy();
                        $("#datatable2").html("");

                        var column = ["統計日期", "信箱暱稱", "會員種類", "上線會員", "加盟商類別", "付費方式", "金額", "幣別", "訂單筆數", "合計金額", "操作"];

                        createSearchTable('#search_Datatable2', '#example2', column);

                        var ajax = 'php/json_mgm_order_data_statistics.php?func=fn_hichart_zone_search_account&\n\
                                                search_account=' + select_date + '&\n\
                                                operation_html=<div style="width:110px;" class="center">\n\
                                                                        <button id="get_account_s" style="margin-right:5px;" class="pink_btn edit"><i class="ace-icon fa fa-pencil bigger-120"></i></button>\n\
                                                                </div>';
                        /*
                        var ajax = 'php/json_mgm_order_data_statistics.php?func=fn_hichart_zone_' + $("[name=date_type]:checked").val() + '&\n\
                                                startTime=' + $( "#condition_Datatable_starttime" ).datepicker( "getDate" ).getTime() + '&\n\
                                                endTime=' + $( "#condition_Datatable_endtime" ).datepicker( "getDate" ).getTime() + '&\n\
                                                pay_way=' + $("[name=pay_way]")[0].checked + '&\n\
                                                amount=' + $("[name=amount]")[0].checked + '&\n\
                                                operation_html=<div style="width:110px;" class="center">\n\
                                                                        <button id="get_account_s" style="margin-right:5px;" class="pink_btn edit"><i class="ace-icon fa fa-pencil bigger-120"></i></button>\n\
                                                                </div>';*/

                        var order = [
                                [1, 'desc']
                        ];

                        createTable('#datatable2', '#example2', column);
                        createDataTable('#example2', ajax, order);
                        $('#example2').data("rows_selected", []);
                        addEvent('#datatable2', '#example2');


                        //點擊查看
                        $('#example2 tbody').on('click', '[id=get_account_s]', function(e) {
                                // location.href = 'mgm_management_account.php' ;
                                window.open("mgm_management_account.php");
                        });

                }


                $(document).ready(function() {


                        $("#condition_Datatable_starttime").unbind('change').bind('change', function() {
                                $.initDatatable_1();
                        });
                        $("#condition_Datatable_starttime").datepicker();
                        $("#condition_Datatable_starttime").datepicker("setDate", "01/01/2016");
                        /*
                        datepicker_object.defaultDate = new Date(chart.xAxis[0].min - (24*3600*1000));
                        $("#startTime").datepicker(datepicker_object);*/

                        $("#condition_Datatable_endtime").unbind('change').bind('change', function() {
                                $.initDatatable_1();
                        });
                        $("#condition_Datatable_endtime").datepicker();
                        $("#condition_Datatable_endtime").datepicker("setDate", "05/01/2016");


                        //bohan++
                        get_category();
                        franchiss_save_event();

                        // --------------------------------------------------------------------------------------------------


                        $.initDatatable_1();

                        //修改會原獎金
                        $('#example tbody').on('click', '[id=edit_franchisee]', function(e) {
                                var $row = $(this).closest('tr');
                                // Get row data
                                var data = $('#example').DataTable().row($row).data();
                                // Get row ID
                                $.a_id = data[0];

                                get_this_member_franchiss_value();

                        });
                        //修改會員資料 click id=pencil 
                        $('#example tbody').on('click', '[id=pencil]', function(e) {
                                var $row = $(this).closest('tr');
                                // Get row data
                                var data = $('#example').DataTable().row($row).data();
                                // Get row ID
                                $.a_id = data[0];

                                fn_list_management_account_single_dialogue();
                        });
                        //暫停/恢復會員 click id=pause_member
                        $('#example tbody').on('click', '[id=pause_member]', function(e) {
                                var $row = $(this).closest('tr');
                                // Get row data
                                var data = $('#example').DataTable().row($row).data();
                                // Get row ID
                                $.a_id = data[0];

                                $.display = ($(this).hasClass('orange_btn')) ? 'block' : 'blockade';
                                fn_btn_pause_account();
                        });
                        //刪除(隱藏)/停權會員 click id=delete_member
                        $('#example tbody').on('click', '[id=delete_member]', function(e) {
                                var $row = $(this).closest('tr');
                                // Get row data
                                var data = $('#example').DataTable().row($row).data();
                                // Get row ID
                                $.a_id = data[0];

                                fn_btn_delete_account();
                        });

                        $("#btn_checkbox_block_new_account").unbind('click').bind('click', function() {
                                    console.log($('#example').data("rows_selected"));
                                    console.log( 'btn_checkbox_block_new_account' );

                                    var data = {
                                            token:   getCookie( "funbook_cookie" )
                                    };
                                    var success_back = function( data ) {

                                            data = JSON.parse( data );
                                            console.log(data);
                                            if( data.success ) {
                                                delete_cookie( "funbook_cookie" , "/" , ".ggyyggy.com" );

                                                show_remind("登出成功", "success");
                                                setTimeout( function(){ 
                                                            location.href = "v_registered.php" ;
                                                }, 3000);
                                                
                                            }
                                            else {
                                                show_remind( data.msg , "error" );
                                            }

                                    }
                                    var error_back = function( data ) {
                                            console.log(data);
                                    }
                                    $.Ajax( "GET" , "php/member.php?func=logout" , data , "" , success_back , error_back);
                                    
                                    
                        });

                        $("#btn_checkbox_block_email_account").unbind('click').bind('click', function() {
                                    console.log($('#example').data("rows_selected"));
                                    console.log( 'btn_checkbox_block_email_account' );
                                    
                                    $( "#dialogue_email_account_user" ).html( '注意：確定送出此 ' + $('#example').data("rows_selected").length + ' 位使用者' );
                                    
                                    $("#dialogue_email_account").modal("show");
                                    
                                    $("#dialogue_email_account_main_Yes").unbind('click').bind('click', function() {
                                        
                                                var data = {
                                                        a_id    : JSON.stringify( $('#example').data("rows_selected") ) ,
                                                        title   : $( "#dialogue_email_account_main" ).val() ,
                                                        content : $( "#dialogue_email_account_contnet" ).val() ,
                                                        token:   getCookie( "funbook_cookie" )
                                                };
                                                var success_back = function( data ) {

                                                        data = JSON.parse( data );
                                                        console.log(data);
                                                        if( data.success ) {

                                                                    show_remind("送出成功", "success");
                                                                        
                                                        }
                                                        else {
                                                                    show_remind( data.msg , "error" );
                                                        }

                                                }
                                                var error_back = function( data ) {
                                                        console.log(data);
                                                }
                                                $.Ajax( "GET" , "/arod/funbook19/php/json_mg_account.php?func=fn_btn_checkbox_send_account_letter" , data , "" , success_back , error_back);

                                        
                                    });
                                    
                        });
                        
                        $("#btn_checkbox_block_emailall_account").unbind('click').bind('click', function() {
                                    console.log($('#example').data("rows_selected"));
                                    console.log( 'btn_checkbox_block_emailall_account' );
                                    
                                    $( "#dialogue_email_account_user" ).html( '注意：為防止會員名單外洩，將用密件副本傳送，確定送出全部會員' );
                                    
                                    $("#dialogue_email_account").modal("show");
                                    
                                    $("#dialogue_email_account_main_Yes").unbind('click').bind('click', function() {
                                        
                                                var data = {
                                                        title   : $( "#dialogue_email_account_main" ).val() ,
                                                        content : $( "#dialogue_email_account_contnet" ).val() ,
                                                        token:   getCookie( "funbook_cookie" )
                                                };
                                                var success_back = function( data ) {

                                                        data = JSON.parse( data );
                                                        console.log(data);
                                                        if( data.success ) {

                                                                    show_remind("送出成功", "success");
                                                                        
                                                        }
                                                        else {
                                                                    show_remind( data.msg , "error" );
                                                        }

                                                }
                                                var error_back = function( data ) {
                                                        console.log(data);
                                                }
                                                $.Ajax( "GET" , "/arod/funbook19/php/json_mg_account.php?func=fn_btn_checkbox_send_account_letter_all" , data , "" , success_back , error_back);

                                        
                                    });
                                    
                        });
                        
                        

                        

                        //點擊暫停會員權限
                        $("#btn_checkbox_block_pause_account").unbind('click').bind('click', function() {
                                console.log($('#example').data("rows_selected"));
                                $.list = $('#example').data("rows_selected");

                                if ($.list.length > 0) {
                                        $(".myModalAddGroup_body span").html('此' + $.list.length + '位會員權限嗎');
                                        $("#dialogue_pause_account").modal("show");
                                } else {
                                        $(".myModalAddGroup_body span").html('全部會員權限嗎');
                                        $.each($("#hiddenresult input[type=checkbox]"), function(index, value) {
                                                $.list[$.list.length] = $(value).parents('[a_id]').attr('a_id');
                                        });
                                        $("#dialogue_pause_account").modal("show");
                                }
                        });
                        $("#checkbox_account_block_pause_yes").unbind("click").bind("click", function() {
                                fn_btn_checkbox_pause_account();
                        });

                        //點擊恢復會員權限
                        $("#btn_checkbox_block_continue_account").unbind("click").bind("click", function() {
                                console.log($('#example').data("rows_selected"));
                                $.list = $('#example').data("rows_selected");

                                if ($.list.length > 0) {
                                        $(".myModalAddGroup_body span").html('此' + $.list.length + '位會員權限嗎');
                                        $("#dialogue_continue_account").modal("show");
                                } else {
                                        $(".myModalAddGroup_body span").html('全部會員權限嗎');
                                        $.each($("#hiddenresult input[type=checkbox]"), function(index, value) {
                                                $.list[$.list.length] = $(value).parents('[a_id]').attr('a_id');
                                        });
                                        $("#dialogue_continue_account").modal("show");
                                }
                        });
                        $("#checkbox_account_block_continue_yes").unbind("click").bind("click", function() {
                                fn_btn_checkbox_continue_account();
                        });

                        $("#myModalEditAccount").delegate("#myModalEditAccount_Yes", "click", function() {
                                $.a_id = $("#myModalEditAccount_Yes").attr('a_id');
                                fn_btn_update_management_account_single_profile();
                        });

                        $("#btn_toggle").unbind("click").bind("click", function() {
                                $("#search_Datatable").attr("display", "block");
                                $("#search_Datatable").toggle();
                        });

                });


                function init() {}



                //暫停/恢復會員權限(單一)
                function fn_btn_delete_account() {
                        var data = {
                                token: getCookie("funbook_cookie"),
                                a_id: $.a_id,
                                display: $.display
                        };
                        var success_back = function(data) {
                                data = JSON.parse(data);
                                console.log(data);
                                if (data.success) {
                                        console.log(this);
                                        show_remind("更改成功");
                                        $('#example').DataTable().ajax.reload();

                                        location.href = "./";

                                } else {
                                        show_remind("更改失敗");
                                }
                        };
                        var error_back = function(data) {
                                console.log(data);
                        };
                        $.Ajax("POST", "php/json_mg_account.php?func=fn_btn_delete", data, "", success_back, error_back);
                }

                //暫停/恢復會員權限(單一)
                function fn_btn_pause_account() {
                        var data = {
                                token: getCookie("funbook_cookie"),
                                a_id: $.a_id,
                                display: $.display
                        };
                        var success_back = function(data) {
                                data = JSON.parse(data);
                                console.log(data);
                                if (data.success) {
                                        console.log(this);
                                        show_remind("更改成功");
                                        $('#example').DataTable().ajax.reload();
                                } else {
                                        show_remind("更改失敗");
                                }
                        };
                        var error_back = function(data) {
                                console.log(data);
                        };
                        $.Ajax("POST", "php/json_mg_account.php?func=fn_btn_pause_account", data, "", success_back, error_back);
                }

                //暫停會員權限(多個)
                function fn_btn_checkbox_pause_account() {
                        var list = $.list;
                        var data = {
                                token: getCookie("funbook_cookie"),
                                list: JSON.stringify(list)
                        };
                        var success_back = function(data) {
                                var tmp = "";
                                data = JSON.parse(data);
                                console.log(data);
                                if (data.success) {
                                        $.list = [];
                                        $('#example').DataTable().ajax.reload();
                                        $("#dialogue_pause_account").modal("hide");
                                        cancel_checkall();
                                        show_remind("更改成功");
                                } else {
                                        show_remind("更改失敗");
                                }
                        };
                        var error_back = function(data) {
                                console.log(data);
                        };
                        $.Ajax("POST", "php/json_mg_account.php?func=fn_btn_checkbox_pause_account", data, "", success_back, error_back);
                }

                //恢復會員權限(多個)
                function fn_btn_checkbox_continue_account() {
                        var list = $.list;
                        var data = {
                                token: getCookie("funbook_cookie"),
                                list: JSON.stringify(list)
                        };
                        var success_back = function(data) {
                                var tmp = "";
                                data = JSON.parse(data);
                                console.log(data);
                                if (data.success) {
                                        $.list = [];
                                        $('#example').DataTable().ajax.reload();
                                        $("#dialogue_continue_account").modal("hide");
                                        cancel_checkall();
                                        show_remind("更改成功");
                                } else {
                                        show_remind("更改失敗");
                                }
                        };
                        var error_back = function(data) {
                                console.log(data);
                        };
                        $.Ajax("POST", "php/json_mg_account.php?func=fn_btn_checkbox_continue_account", data, "", success_back, error_back);
                }
                

                //設定加盟商需要的category list
                function get_category() {

                        var data = {};
                        var success_back = function(data) {

                                data = JSON.parse(data);
                                console.log(data);
                                if (data.success) {

                                        var tmp="<option value='0'>未選擇</option>";
                                        $.each( data.data , function( k , v ){
                                                tmp += "<option value='"+v.cate_id+"'>"+v.cate_name+"</option>";
                                        });
                                        $.cate_html = tmp;

                                } else {
                                        show_remind(data.msg,"error");
                                }

                        };
                        var error_back = function(data) {
                                console.log(data);
                        };
                        $.Ajax("POST", "php/category.php?func=listbyid", data, "", success_back, error_back);

                }
                //會員加盟商
                function get_this_member_franchiss_value() {
                            
                            var data = {
                                    token: getCookie("funbook_cookie"),
                                    a_id: $.a_id
                            };
                            var success_back = function(data) {

                                    data = JSON.parse(data);
                                    console.log(data);
                                    if (data.success) {

                                            var tmp="",pos,arr,arr0,arr1,arr2,arr3,arr4,arr5,arr6,arr7,arr8,arr9,arr10,arr11,arr12,arr13,arra;
                                            $.each( data.data , function( k , v ){
                                                    //AL 20160411 新增刪除btn ui
                                                    //<button id="kind-delet" target="'+k+'" class="green_btn float-right"><i class="ace-icon fa fa-trash-o bigger-120"></i></button>
                                                    $( "#franchisee_name" ).html( v.a_franchisee );
                                                    pos = $( "#sample_kind" );
                                                    pos.find("select").html( $.cate_html );
                                                    arr = v["GROUP_CONCAT(ak.a_kind_id)"].split(",");
                                                    arr0 = v["GROUP_CONCAT(ak.a_kind_name)"].split(",");
                                                    arr1 = v["GROUP_CONCAT(ak.a_kind_click_bonus)"].split(",");
                                                    arr2 = v["GROUP_CONCAT(ak.a_kind_download_bonus)"].split(",");
                                                    arr3 = v["GROUP_CONCAT(ak.a_kind_first_child_income_percent)"].split(",");
                                                    arr4 = v["GROUP_CONCAT(ak.a_kind_second_child_income_percent)"].split(",");
                                                    arr5 = v["GROUP_CONCAT(ak.a_kind_moderator_special_bonus)"].split(",");
                                                    arr6 = v["GROUP_CONCAT(ak.a_kind_vip_income)"].split(",");
                                                    arr7 = v["GROUP_CONCAT(ak.a_kind_first_child_vip_income)"].split(",");
                                                    arr8 = v["GROUP_CONCAT(ak.a_kind_second_child_vip_income)"].split(",");
                                                    arr9 = v["GROUP_CONCAT(ak.a_kind_limit_click)"].split(",");
                                                    arr10 = v["GROUP_CONCAT(ak.a_kind_limit_page)"].split(",");
                                                    arr11 = v["GROUP_CONCAT(ak.a_kind_limit_page_file)"].split(",");
                                                    arr12 = v["GROUP_CONCAT(ak.a_kind_limit_child)"].split(",");
                                                    arr13 = v["GROUP_CONCAT(ak.a_kind_limit_child_income)"].split(",");
                                                    arra = v["GROUP_CONCAT(ak.a_kind_category)"].split(",");
                                                    $.each( pos.find("tbody tr") , function( k2 , v2 ){
                                                            $(v2).attr( "a_kind_id" , arr[k2] );
                                                            $(v2).find("input").eq(0).val( arr0[k2] ).attr("col","a_kind_name");
                                                            $(v2).find("input").eq(1).val( arr1[k2] ).attr("col","a_kind_click_bonus");
                                                            $(v2).find("input").eq(2).val( arr2[k2] ).attr("col","a_kind_download_bonus");
                                                            $(v2).find("input").eq(3).val( parseFloat(arr3[k2])*100 ).attr("col","a_kind_first_child_income_percent");
                                                            $(v2).find("input").eq(4).val( parseFloat(arr4[k2])*100 ).attr("col","a_kind_second_child_income_percent");
                                                            console.log( parseFloat(arr5[k2]) );
                                                            $(v2).find("input").eq(5).val( parseFloat(arr5[k2])*100 ).attr("col","a_kind_moderator_special_bonus");
                                                            $(v2).find("input").eq(6).val( parseFloat(arr6[k2])*100 ).attr("col","a_kind_vip_income");
                                                            $(v2).find("input").eq(7).val( parseFloat(arr7[k2])*100 ).attr("col","a_kind_first_child_vip_income");
                                                            $(v2).find("input").eq(8).val( parseFloat(arr8[k2])*100 ).attr("col","a_kind_second_child_vip_income");
                                                            $(v2).find("select").val( arra[k2] ).attr("col","a_kind_category");
                                                            if( k2 === 1 || k2 === 2 || k2 === 3 || k2 === 4 ){
                                                                $(v2).find("input").eq(9).val( arr9[k2] ).attr("col","a_kind_limit_click");
                                                                $(v2).find("input").eq(10).val( arr10[k2] ).attr("col","a_kind_limit_page");
                                                                $(v2).find("input").eq(11).val( arr11[k2] ).attr("col","a_kind_limit_page_file");
                                                                $(v2).find("input").eq(12).val( arr12[k2] ).attr("col","a_kind_limit_child");
                                                                $(v2).find("input").eq(13).val( arr13[k2] ).attr("col","a_kind_limit_child_income");
                                                            }
                                                    });
                                            });

                                            $( "#dialogue_franchisee" ).modal( "show" );

                                    } else {
                                            $("#myModalEditAccount").modal("hide");
                                    }

                            };
                            var error_back = function(data) {
                                    console.log(data);
                            };
                            $.Ajax("POST", "php/event.php?func=get_this_member_franchiss_value", data, "", success_back, error_back);

                }
                function franchiss_save_event() {

                        $( "#kind-setting" ).bind( "click" , function(){

                                loading_ajax_show();
                                var bool=true, pos, msg="", data_kind=[];

                                $.each( $( "#sample_kind" ).find( "tbody tr" ) , function( k , v ){

                                        data_kind[k] = {};
                                        data_kind[k]["a_kind_id"] = $(v).attr("a_kind_id");
                                        $.each( $(v).find("input") , function( k2 , v2 ){
                                                if( $(v2).val() === "" ){
                                                    bool = false;
                                                    pos = $(v2);
                                                    msg = "請填完整";
                                                    $(v2).parent().addClass( "has-error" );
                                                }
                                                else{
                                                    $(v2).parent().removeClass( "has-error" );
                                                    if( $(v2).hasClass("percent_input") ){
                                                        data_kind[k][$(v2).attr("col")] = parseInt( $(v2).val() )/100;
                                                    }
                                                    else{
                                                        data_kind[k][$(v2).attr("col")] = $(v2).val();
                                                    }
                                                }
                                        });

                                });

                                if( bool ){
                                        var data = {
                                                token: getCookie("funbook_cookie"),
                                                kind: data_kind,
                                                a_id: $.a_id
                                        };
                                        var success_back = function(data) {

                                                loading_ajax_hide();
                                                data = JSON.parse(data);
                                                console.log(data);
                                                if (data.success) {
                                                        show_remind("儲存成功");
                                                        $( "#dialogue_franchisee" ).modal( "hide" );
                                                } else {
                                                        show_remind(data.msg,"error");
                                                }

                                        };
                                        var error_back = function(data) {
                                                console.log(data);
                                        };
                                        $.Ajax("POST", "php/event.php?func=set_self_franchisee", data, "", success_back, error_back);

                                }
                                else{
                                        loading_ajax_hide();
                                        show_remind( msg,"error" );
                                        scrollto( pos );
                                }

                        });

                }
                
                //會員資訊Dialog
                function fn_list_management_account_single_dialogue() {

                        var data = {
                                token: getCookie("funbook_cookie"),
                                a_id: $.a_id
                        };
                        var success_back = function(data) {

                                console.log(data);
                                var tmp_franchisee = "";
                                var tmp_kind = "";
                                data = JSON.parse(data);
                                console.log(data);
                                if (data.success) {

                                        $("#myModalEditAccount_Yes").attr('a_id', data.data.a_id);

                                        $.franchisee_kind = data.data.franchisee_kind;
                                        tmp_franchisee = '<option value="' + $.franchisee_kind + '">' + $.franchisee_kind + ' (now)</option>';
                                        $("#change_a_franchisee").html(tmp_franchisee);

                                        $.account_kind = data.data.ak_a_kind;
                                        tmp_kind = '<option value="' + $.account_kind + '">' + data.data.account_kind + ' (now)</option>';
                                        $("#change_a_kind").html(tmp_kind);

                                        $("#Edit_a_admin").val(data.data.a_admin);
                                        $("#Edit_a_franchisee").val(data.data.a_franchisee);
                                        $("#Edit_a_parent").val(data.data.a_parent);
                                        $("#Edit_a_state").val(data.data.a_state);
                                        $("#Edit_a_name").val(data.data.a_name);
                                        $("#Edit_a_email").val(data.data.a_email);
                                        $("#Edit_a_password").val(data.data.a_password);
                                        
                                        if( data.data.a_icon == "" )
                                        $("#Edit_a_icon").html( 'no icon' );
                                        else
                                        $("#Edit_a_icon").css('background-image', 'url(' + data.data.a_icon + ')');
                                        
                                        $("#Edit_a_nickname").val(data.data.a_nickname);
                                        $("#Edit_a_country").val(data.data.a_country);
                                        $("#Edit_a_first_name").val(data.data.a_first_name);
                                        $("#Edit_a_last_name").val(data.data.a_last_name);
                                        $("#Edit_a_birthday").val(data.data.a_birthday);
                                        $("#Edit_a_address").val(data.data.a_address);
                                        $("#Edit_a_phone").val(data.data.a_phone);
                                        $("#Edit_a_payment_method").val(data.data.a_payment_method);
                                        $("#Edit_a_accept_email").val(data.data.a_accept_email);
                                        $("#Edit_a_accept_noti").val(data.data.a_accept_noti);
                                        $("#Edit_a_points").val(data.data.a_points);
                                        $("#Edit_a_178tube_franchisee_url").val(data.data.a_178tube_franchisee_url);
                                        $("#Edit_a_limit_publish").val(data.data.a_limit_publish);
                                        $("#Edit_a_value_coins").val(data.data.a_value_coins);
                                        $("#Edit_a_value_bonus").val(data.data.a_value_bonus);
                                        $("#Edit_a_limit_token").val(data.data.a_limit_token);
                                        $("#Edit_a_token").val(data.data.a_token);
                                        $("#Edit_a_forget_token").val(data.data.a_forget_token);
                                        $("#Edit_a_forget_token_time").val(data.data.a_forget_token_time);
                                        $("#Edit_a_email_confirm").val(data.data.a_email_confirm);
                                        $("#Edit_a_registration_time").val(data.data.a_registration_time);
                                        $("#Edit_a_last_login_time").val(data.data.a_last_login_time);
                                        $("#Edit_a_lastlogin_device").val(data.data.a_lastlogin_device);
                                        $("#Edit_a_lastlogin_browser").val(data.data.a_lastlogin_browser);
                                        $("#Edit_a_lastlogin_ip").val(data.data.a_lastlogin_ip);


                                        fn_list_account_kind_single_dialogue();

                                        $("#myModalEditAccount").modal("show");

                                } else {
                                        $("#myModalEditAccount").modal("hide");
                                }

                        };
                        var error_back = function(data) {
                                console.log(data);
                        };
                        $.Ajax("POST", "php/json_mg_account.php?func=fn_list_management_account_single_dialogue", data, "", success_back, error_back);

                }

                //取得會員種類資訊(Dialog select的資訊)
                function fn_list_account_kind_single_dialogue() {

                        var data = {
                                token: getCookie("funbook_cookie"),
                                a_id: $.a_id
                        };
                        var success_back = function(data) {

                                console.log(data);
                                var tmp_franchisee = "";
                                var tmp_kind = "";
                                data = JSON.parse(data);
                                console.log(data);
                                if (data.success) {
                                        $.each(data.data_franchisee, function(index, value) {
                                                if (value.a_franchisee == $.franchisee_kind) {
                                                        return;
                                                }
                                                tmp_franchisee += '<option value="' + value.a_franchisee + '">' + value.a_franchisee + '</option>';
                                        })
                                        $("#change_a_franchisee").append(tmp_franchisee);

                                        $.each(data.data_kind, function(index, value) {
                                                if (value.a_kind == $.account_kind) {
                                                        return;
                                                }
                                                tmp_kind += '<option value="' + value.a_kind + '">' + value.a_kind_name + '</option>';
                                        })
                                        $("#change_a_kind").append(tmp_kind);
                                } else {
                                        show_remind("fn_list_account_kind_single_dialogue error");
                                }

                                //$('#change_a_kind').val(data.a_kind);
                        };
                        var error_back = function(data) {
                                console.log(data);
                        };
                        $.Ajax("POST", "php/json_mg_account.php?func=fn_list_account_kind_single_dialogue", data, "", success_back, error_back);


                }

                //修改會員資料
                function fn_btn_update_management_account_single_profile() {

                        var data = {
                                token: getCookie("funbook_cookie"),
                                a_id: $.a_id,
                                a_admin: $("#Edit_a_admin").val(),
                                a_franchisee: $("#change_a_franchisee").val(),
                                a_kind: $("#change_a_kind").val(),

                                a_name: $("#Edit_a_name").val(),
                                a_email: $("#Edit_a_email").val(),
                                a_nickname: $("#Edit_a_nickname").val(),
                                a_country: $("#Edit_a_country").val(),
                                a_first_name: $("#Edit_a_first_name").val(),
                                a_last_name: $("#Edit_a_last_name").val(),
                                a_birthday: $("#Edit_a_birthday").val(),
                                a_address: $("#Edit_a_address").val(),
                                a_phone: $("#Edit_a_phone").val(),
                                a_limit_publish: $("#Edit_a_limit_publish").val(),
                                a_value_coins: $("#Edit_a_value_coins").val(),
                                a_value_bonus: $("#Edit_a_value_bonus").val()
                        };
                        var success_back = function(data) {
                                data = JSON.parse(data);
                                console.log(data);
                                if (data.success) {
                                        show_remind("更改成功");
                                        $('#example').DataTable().ajax.reload();
                                } else {
                                        alert("更新失敗");
                                }

                                $("#UpdateBoardTitle").html('');
                                $("#UpdateBoardContent").html('');

                        };
                        var error_back = function(data) {
                                console.log(data);
                        };
                        $.Ajax("POST", "php/json_mg_account.php?func=fn_btn_update_management_account_single_profile", data, "", success_back, error_back);
                }



                function unconnected_callback() {
                        loading_ajax_hide();
                        show_remind("未登入，三秒後轉跳到首頁。", "error");
                        // setTimeout( function(){ location.href = "v_index.php" }, 3000);
                };

                /* 管理者未登入則跳轉到首頁 */
                function connected_callback(member) {
                        if (member.a_admin !== "true") {
                                loading_ajax_hide();
                                show_remind("不是管理者，三秒後轉跳到首頁。", "error");
                                // setTimeout( function(){ location.href = "v_index.php" }, 3000);
                        } else {

                                init();

                                $(function() {
                                        $("#mc").css({
                                                color: "#2F8DCD"
                                        });
                                });
                        }
                };
        </script>
</head>
<body>
    
        <?php include( "template_help_j/html/loading.php"); ?>
        <?php include( "template_help_j/html/header.php"); ?>

        <div id="container" class="container_bk">
                <?php include( "template_help_j/html/sidebar_setting.php"); ?>

                <div class="main-content">
                        <div class="path">
                                <a href="#">首頁</a> &gt; <a href="#">會員管理</a>
                        </div>
                        <div class="list">

                                <h2>會員管理</h2>

                                <div class="dataTable_function_btn_box">
                                        <!--div class="float-left">操作結果訊息顯示</div-->
                                        <button type="button" class="float-right" id="btn_checkbox_block_emailall_account">Email All User</button>
                                        <button type="button" class="float-right" id="btn_checkbox_block_email_account">Email Selected User</button>
                                        <button type="button" class="float-right" id="btn_checkbox_block_continue_account">恢復會員權限</button>
                                        <button type="button" class="float-right" id="btn_checkbox_block_pause_account">暫停會員權限</button>
                                        <button type="button" class="float-right" id="btn_checkbox_block_new_account">新增會員</button>
                                </div>


                                <!--button class="green_btn float-right" type="button" id="btn_toggle">搜尋欄位</button>
                                <div class="clearfix"></div>
                                <br-->

                                <div style="display: none;" id="search_Datatable">
                                        <table cellspacing="0" cellpadding="3" border="0" style="width: 50%; margin: 2em auto; " id="example_search">
                                                <tbody>
                                                        <tr data-column="1" id="filter_col2">
                                                                <td>信箱暱稱</td>
                                                                <td align="left">
                                                                        <input type="text" id="col1_filter" class="column_filter">
                                                                </td>
                                                        </tr>
                                                        <tr></tr>
                                                        <tr data-column="2" id="filter_col3">
                                                                <td>會員種類</td>
                                                                <td align="left">
                                                                        <input type="text" id="col2_filter" class="column_filter">
                                                                </td>
                                                        </tr>
                                                        <tr></tr>
                                                        <tr data-column="3" id="filter_col4">
                                                                <td>上線會員</td>
                                                                <td align="left">
                                                                        <input type="text" id="col3_filter" class="column_filter">
                                                                </td>
                                                        </tr>
                                                        <tr></tr>
                                                        <tr data-column="4" id="filter_col5">
                                                                <td>下線會員數本月新增下線數</td>
                                                                <td align="left">
                                                                        <input type="text" id="col4_filter" class="column_filter">
                                                                </td>
                                                        </tr>
                                                        <tr></tr>
                                                        <tr data-column="5" id="filter_col6">
                                                                <td>最後登入時間註冊時間</td>
                                                                <td align="left">
                                                                        <input type="text" id="col5_filter" class="column_filter">
                                                                </td>
                                                        </tr>
                                                        <tr></tr>
                                                        <tr data-column="6" id="filter_col7">
                                                                <td>管理權限</td>
                                                                <td align="left">
                                                                        <input type="text" id="col6_filter" class="column_filter">
                                                                </td>
                                                        </tr>
                                                        <tr></tr>
                                                        <tr data-column="7" id="filter_col8">
                                                                <td>IP</td>
                                                                <td align="left">
                                                                        <input type="text" id="col7_filter" class="column_filter">
                                                                </td>
                                                        </tr>
                                                        <tr></tr>
                                                        <tr data-column="8" id="filter_col9">
                                                                <td>狀態</td>
                                                                <td align="left">
                                                                        <input type="text" id="col8_filter" class="column_filter">
                                                                </td>
                                                        </tr>
                                                        <tr></tr>
                                                </tbody>
                                        </table>
                                </div>

                                <div id="datatable"></div>
                                
                        </div>

                </div>
        </div>

        <?php include( "template_help_j/html/footer.php"); ?>

        <!--修改會員資料-->
        <div aria-hidden="false" id="myModalEditAccount" style="display: none;" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div id="dialog-msg">
                                        <dl>
                                                <dt class="message">
                                                        <p class="title">修改會員資料</p>
                                                        <a data-dismiss="modal" class="close">X</a>
                                                </dt>
                                                <dd>
                                                        <form role="form">
                                                                <ul>
                                                                        <li>
                                                                                <span>加盟商種類 </span>
                                                                                <select id="change_a_franchisee"></select>
                                                                        </li>
                                                                        <li>
                                                                                <span>會員種類 </span>
                                                                                <select id="change_a_kind"></select>
                                                                        </li>
                                                                        <li>
                                                                                <span>管理權限 </span>
                                                                                <select id="Edit_a_admin">
                                                                                    <option value="true">是</option>
                                                                                    <option value="false">否</option>
                                                                                </select>
                                                                        </li>
                                                                        <hr>
                                                                        <li>
                                                                                <span>大頭貼 </span>
                                                                                <a>
                                                                                        <div id="Edit_a_icon" class="bg_top" style="background-image: url(''); cursor: pointer; width: 100px; height: 100px; margin-left: 50%;"></div>
                                                                                </a>
                                                                        </li>
                                                                        <li>
                                                                                <span>姓名 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_name" placeholder="姓名" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>狀態 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_state" placeholder="狀態" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>管理權限 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_admin" placeholder="管理權限" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>加盟商 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_franchisee" placeholder="加盟商" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>上線 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_parent" placeholder="上線" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>信箱 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_email" placeholder="信箱" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>密碼 </span>
                                                                                <input type="password" data-input="title" id="Edit_a_password" placeholder="密碼" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>暱稱 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_nickname" placeholder="暱稱" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>國家 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_country" placeholder="國家" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>名字 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_first_name" placeholder="名字" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>姓氏 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_last_name" placeholder="姓氏" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>生日 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_birthday" placeholder="生日" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>地址 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_address" placeholder="地址" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>手機 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_phone" placeholder="手機" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>付款方式 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_payment_method" placeholder="付款方式" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>付款認證信箱 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_accept_email" placeholder="付款認證信箱" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>付款推播 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_accept_noti" placeholder="付款推播" value="" readonly="readonly">
                                                                        </li>
                                                                        <li style="display: none">
                                                                                <span>活力值 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_points" placeholder="活力值" value="" readonly="readonly">
                                                                        </li>
                                                                        <li style="display: none">
                                                                                <span>178tube加盟商url </span>
                                                                                <input type="text" data-input="title" id="Edit_a_178tube_franchisee_url" placeholder="178tube加盟商url" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>會員每日發文限制數 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_limit_publish" placeholder="會員每日發文限制數" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>G幣 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_value_coins" placeholder="G幣" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>獎金 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_value_bonus" placeholder="G幣" value="">
                                                                        </li>
                                                                        <li>
                                                                                <span>會員金鑰上限數 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_limit_token" placeholder="會員金鑰上限數" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>會員金鑰 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_token" placeholder="會員金鑰" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>忘記密碼會員金鑰 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_forget_token" placeholder="忘記密碼會員金鑰" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>忘記密碼時間 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_forget_token_time" placeholder="忘記密碼時間" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>信箱認證 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_email_confirm" placeholder="信箱認證" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>註冊時間 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_registration_time" placeholder="註冊時間" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>上次登入時間 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_last_login_time" placeholder="上次登入時間" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>上次登入裝置 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_lastlogin_device" placeholder="上次登入裝置" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>上次登入瀏覽器 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_lastlogin_browser" placeholder="上次登入瀏覽器" value="" readonly="readonly">
                                                                        </li>
                                                                        <li>
                                                                                <span>上次登入IP位址 </span>
                                                                                <input type="text" data-input="title" id="Edit_a_lastlogin_ip" placeholder="上次登入IP位址" value="" readonly="readonly">
                                                                        </li>

                                                                        <a id="myModalEditAccount_Yes" data-dismiss="modal" href="#">確定</a>
                                                                        <a data-dismiss="modal" href="#" class="delet">取消</a>
                                                                </ul>
                                                        </form>
                                                </dd>
                                        </dl>
                                </div>
                        </div>
                </div>
        </div>

        <!--修改加盟商-->
        <div aria-hidden="false" id="dialogue_franchisee" class="modal fade">
                <div class="modal-dialog" style=" width: 90%;" >
                        <div class="modal-content">
                                <div id="dialog-msg">
                                        <dl>
                                                <dt><a data-dismiss="modal" class="close">X</a></dt>
                                                <dd>
                                                        <p id="franchisee_name"></p>
                                                        <table cellspacing="0" cellpadding="0" border="0" style="display: table;" id="sample_kind" target="0">
                                                                <thead>
                                                                        <tr>
                                                                                <td>會員種類</td>
                                                                                <td>500點閱/收益</td>
                                                                                <td>100附件下載/收益</td>
                                                                                <td>夥伴收益獎金</td>
                                                                                <td>版主特別獎金</td>
                                                                                <td>版主特別獎金的分類版</td>
                                                                                <td>VIP贊助獎金</td>
                                                                                <td>夥伴VIP贊助獎金</td>
                                                                                <td style="width: 550px">升級條件</td>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                        <tr a_kind_id="1">
                                                                                <td><input type="text" placeholder="名稱1" col="a_kind_name"></td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_click_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_download_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_income_percent">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_income_percent">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" disabled="" onkeypress="return isNumberKey(event)" col="a_kind_moderator_special_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_vip_income">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>無</td>
                                                                        </tr>

                                                                        <tr a_kind_id="2">
                                                                                <td><input type="text" placeholder="名稱2" col="a_kind_name"></td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_click_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_download_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_income_percent">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_income_percent">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" disabled="" onkeypress="return isNumberKey(event)" col="a_kind_moderator_special_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_vip_income">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <span>累積</span><input type="number" style="width: 100px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_click">
                                                                                        <span>點閱，發表</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_page">
                                                                                        <span>篇文章，上傳</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_page_file">
                                                                                        <span>附件，並擁有</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_child">
                                                                                        <span>位收益</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_child_income">
                                                                                        <span>位收益</span>
                                                                                </td>
                                                                        </tr>

                                                                        <tr a_kind_id="3">
                                                                                <td><input type="text" placeholder="名稱3" col="a_kind_name"></td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_click_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_download_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_income_percent">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_income_percent">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" disabled="" onkeypress="return isNumberKey(event)" col="a_kind_moderator_special_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_vip_income">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <span>累積</span><input type="number" style="width: 100px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_click">
                                                                                        <span>點閱，發表</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_page">
                                                                                        <span>篇文章，上傳</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_page_file">
                                                                                        <span>附件，並擁有</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_child">
                                                                                        <span>位收益</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_child_income">
                                                                                        <span>位收益</span>
                                                                                </td>
                                                                        </tr>

                                                                        <tr a_kind_id="4">
                                                                                <td><input type="text" placeholder="名稱2" col="a_kind_name"></td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_click_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_download_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_income_percent">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_income_percent">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" disabled="" onkeypress="return isNumberKey(event)" col="a_kind_moderator_special_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_vip_income">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <span>累積</span><input type="number" style="width: 100px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_click">
                                                                                        <span>點閱，發表</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_page">
                                                                                        <span>篇文章，上傳</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_page_file">
                                                                                        <span>附件，並擁有</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_child">
                                                                                        <span>位收益</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_child_income">
                                                                                        <span>位收益</span>
                                                                                </td>
                                                                        </tr>

                                                                        <tr a_kind_id="5">
                                                                                <td><input type="text" placeholder="名稱2" col="a_kind_name"></td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_click_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_download_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_income_percent">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_income_percent">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" disabled="" onkeypress="return isNumberKey(event)" col="a_kind_moderator_special_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_vip_income">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <span>累積</span><input type="number" style="width: 100px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_click">
                                                                                        <span>點閱，發表</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_page">
                                                                                        <span>篇文章，上傳</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_page_file">
                                                                                        <span>附件，並擁有</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_child">
                                                                                        <span>位收益</span><input type="number" style="width: 60px;" onkeypress="return isNumberKey(event)" col="a_kind_limit_child_income">
                                                                                        <span>位收益</span>
                                                                                </td>
                                                                        </tr>

                                                                        <tr a_kind_id="6">
                                                                                <td><input type="text" placeholder="名稱1" col="a_kind_name"></td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_click_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_download_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_income_percent">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_income_percent">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" disabled="" onkeypress="return isNumberKey(event)" col="a_kind_moderator_special_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td><select col="a_kind_category"><option value="0">未選擇</option><option value="70">宅經濟</option><option value="59">順時鐘</option><option value="58">逆時鐘</option><option value="57">娛樂</option><option value="56">時事</option><option value="72">Dcard</option><option value="71">宅行動</option><option value="63">宅宅</option><option value="68">正妹</option><option value="69">運動美女</option><option value="73">言情</option><option value="114">VIP板塊</option><option value="79">新玩具2</option><option value="78">男女</option><option value="83">運動</option><option value="86">知識</option><option value="123">新增分類2</option><option value="124">賺錢寶典</option></select></td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_vip_income">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>管理員審核升級</td>
                                                                        </tr>

                                                                        <tr a_kind_id="7">
                                                                                <td><input type="text" placeholder="名稱1" col="a_kind_name"></td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_click_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" onkeypress="return isNumberKey(event)" col="a_kind_download_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_income_percent">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_income_percent">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="yen">
                                                                                                <input type="number" disabled="" onkeypress="return isNumberKey(event)" col="a_kind_moderator_special_bonus">
                                                                                        </div>
                                                                                </td>
                                                                                <td><select col="a_kind_category"><option value="0">未選擇</option><option value="70">宅經濟</option><option value="59">順時鐘</option><option value="58">逆時鐘</option><option value="57">娛樂</option><option value="56">時事</option><option value="72">Dcard</option><option value="71">宅行動</option><option value="63">宅宅</option><option value="68">正妹</option><option value="69">運動美女</option><option value="73">言情</option><option value="114">VIP板塊</option><option value="79">新玩具2</option><option value="78">男女</option><option value="83">運動</option><option value="86">知識</option><option value="123">新增分類2</option><option value="124">賺錢寶典</option></select></td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_first_child_vip_income">
                                                                                        </div>
                                                                                        <div class="bouns">
                                                                                                <input type="number" class="percent_input" onkeypress="return isNumberKey(event)" col="a_kind_second_child_vip_income">
                                                                                        </div>
                                                                                </td>
                                                                                <td>管理員審核升級</td>
                                                                        </tr>
                                                                </tbody>
                                                        </table>
                                                        <a id="kind-setting" href="#">儲存成個人加盟商</a> 
                                                        <a data-dismiss="modal" href="#" class="delet">取消</a> 
                                                </dd>
                                        </dl>
                                </div>
                        </div>
                </div>
        </div>

        <!--恢復會員權限-->
        <div aria-hidden="false" id="dialogue_continue_account" class="modal fade">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div id="dialog-msg">
                                        <dl>
                                                <dt><a data-dismiss="modal" class="close">X</a></dt>
                                                <dd>
                                                        <p class="title">恢復會員權限</p>
                                                        <p>注意：確定恢復</p>
                                                        <a id="checkbox_account_block_continue_yes" href="#">確定</a>
                                                        <a data-dismiss="modal" href="#" class="delet">取消</a>
                                                </dd>
                                        </dl>
                                </div>
                        </div>
                </div>
        </div>

        <!-- email selected account-->
        <div aria-hidden="false" id="dialogue_email_account" class="modal fade">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div id="dialog-msg">
                                    <dl>
                                                <dt class="message">
                                                        <p class="title">Email Selected User</p>
                                                        <a class="close" data-dismiss="modal">X</a>
                                                </dt>
                                                <dd>
                                                        <p id="dialogue_email_account_user" >注意：確定送出</p>
                                                        <form role="form">
                                                                <ul>
                                                                        <li>
                                                                                <span>主旨</span>
                                                                                <input type="text" data-input="title" id="dialogue_email_account_main" placeholder="主旨">
                                                                        </li>
                                                                        <li>
                                                                                <span>內容</span>
                                                                                <textarea type="text" placeholder="內容" id="dialogue_email_account_contnet" data-input="title" style="width: 400px; height: 300px;"></textarea>
                                                                        </li>
                                                                        <a href="#" data-dismiss="modal" id="dialogue_email_account_main_Yes" a_id="R88WLMPIEXAUH41APNDZ">確定</a>
                                                                        <a class="delet" href="#" data-dismiss="modal">取消</a>
                                                                </ul>
                                                        </form>
                                                </dd>
                                        </dl>
                                </div>
                        </div>
                </div>
        </div>


</body>

</html>