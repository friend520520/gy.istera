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
                    <title>贊助資料統計 | Funbook19.com</title>
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

                                //init 會員清單
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

                            if ( $("[name=pay_way]")[0].checked && $("[name=amount]")[0].checked && $("[name=account]")[0].checked ) {
                                    var column = ["日期","會員 / 識別號","上層會員 / 上層會員識別號","付費方式",  "金額", "幣別", "訂單筆數", "合計金額", "操作"];
                            } else if ( !$("[name=pay_way]")[0].checked && $("[name=amount]")[0].checked && $("[name=account]")[0].checked ) {
                                    var column = ["日期", "會員", "金額", "幣別", "訂單筆數", "合計金額", "操作"];
                            } else if ( $("[name=pay_way]")[0].checked && !$("[name=amount]")[0].checked && $("[name=account]")[0].checked ) {
                                    var column = ["日期", "會員", "付費方式", "幣別", "訂單筆數", "合計金額", "操作"];
                            } else if ( $("[name=pay_way]")[0].checked && $("[name=amount]")[0].checked && !$("[name=account]")[0].checked ) {
                                    var column = ["日期", "付費方式", "金額", "幣別", "訂單筆數", "合計金額", "操作"];
                            } else if ( !$("[name=pay_way]")[0].checked && !$("[name=amount]")[0].checked && $("[name=account]")[0].checked ) {
                                    var column = ["日期", "會員", "幣別", "訂單筆數", "合計金額", "操作"];
                            } else if ( !$("[name=pay_way]")[0].checked && $("[name=amount]")[0].checked && !$("[name=account]")[0].checked ) {
                                    var column = ["日期", "金額", "幣別", "訂單筆數", "合計金額", "操作"];
                            } else if ( $("[name=pay_way]")[0].checked && !$("[name=amount]")[0].checked && !$("[name=account]")[0].checked ) {
                                    var column = ["日期", "付費方式", "幣別", "訂單筆數", "合計金額", "操作"];
                            } else if ( !$("[name=pay_way]")[0].checked && !$("[name=amount]")[0].checked && !$("[name=account]")[0].checked ) {
                                    var column = ["日期", "幣別", "訂單筆數", "合計金額", "操作"];
                            }

                            createSearchTable( '#search_Datatable' , '#example', column );

                            var ajax = '/arod/funbook19/php/json_mgm_order_data_statistics.php?func=fn_hichart_zone_' + $("[name=date_type]:checked").val() + '&\n\
                                                    startTime=' + $( "#condition_Datatable_starttime" ).datepicker( "getDate" ).getTime() + '&\n\
                                                    endTime=' + $( "#condition_Datatable_endtime" ).datepicker( "getDate" ).getTime() + '&\n\
                                                    pay_way=' + $("[name=pay_way]")[0].checked + '&\n\
                                                    amount=' + $("[name=amount]")[0].checked + '&\n\
                                                    account=' + $("[name=account]")[0].checked + '&\n\
                                                    operation_html=<div style="width:110px;" class="center">\n\
                                                                            <button class="pink_btn" style="margin-right:5px;" id="get_account">查看會員</button>\n\
                                                                    </div>';

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
                                    console.log( data );
                                    $.initDatatable_2( data[0] );

                                    $("#checkbox_account_block").modal("show");

                            });

                    }

                    $.initDatatable_2 = function initDatatable_2( select_date ) {

                            //destory dataTable
                            $("#example2").DataTable().destroy();
                            $("#datatable2").html("");

                            var column = [ "統計日期" , "信箱暱稱" , "會員種類" , "上線會員" , "加盟商類別" , "付費方式", "金額", "幣別", "訂單筆數", "合計金額", "操作"];

                            createSearchTable( '#search_Datatable2' , '#example2', column );

		                var ajax = 'php/json_mgm_order_data_statistics.php?func=fn_hichart_zone_search_account&\n\
		                            search_account=' + select_date + '&\n\
                            operation_html=<div style="width:110px;" class="center">\n\
                                                    <button id="get_account_s" style="margin-right:5px;" class="pink_btn edit"><i class="ace-icon fa fa-pencil bigger-120"></i></button>\n\
                                            </div>';


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


                                $("#condition_Datatable_starttime").datepicker();
                                $("#condition_Datatable_starttime").datepicker( "setDate", "01/01/" + ( new Date().getFullYear() ) );

                                $("#condition_Datatable_endtime").datepicker();
                                $("#condition_Datatable_endtime").datepicker( "setDate", ( new Date().getMonth() + 1 ) + "/" + ( new Date().getDate() ) + "/" + ( new Date().getFullYear() ) );
                                
                        	// --------------------------------------------------------------------------------------------------
                                // $.initDatatable_1();

                                $("#datatable").attr("display","block");

                                $("#btn_view_toggle").unbind("click").bind( "click" , function(){
                                            $("#datatable").toggle();

                                            if( $("#chartList").css("visibility") == "hidden" )
                                            $("#chartList").css( "visibility" , "visible" );
                                            else
                                            $("#chartList").css( "visibility" , "hidden" );
                                });       

                                $("#btn_Datatable").unbind('click').bind('click', function() {

                                            $.initDatatable_1();
                                });

                });

                </script>
                <script>
                        loading_ajax_show();

                        function init() {
                                //display_event();
                                //del_event();

                                $("#btn_default").unbind('click').bind('click', function() {
                                        fn_btn_default();
                                });

                                $("#showresult").delegate("[id='display_block']", "click", function() {
                                        $.page_id = $(this).parents('[page_id]').attr('page_id');
                                        $.display = ($(this).hasClass('green-button')) ? 'blockade' : 'block';

                                        fn_list_management_account_single_dialogue();
                                });

                                $("#btn_toggle").unbind("click").bind( "click" , function(){
                                                            $( "#search_Datatable" ).attr( "display" , "block" );
                                                            $( "#search_Datatable" ).toggle();
                                });
                        }

                        function fn_btn_default() {

                                $('#first_select').val('page_id');
                                $('#second_select').val('p_title');
                                $('#third_select').val('p_channel_id');
                                $('#forth_select').val('p_click_num');
                                $('#fifth_select').val('p_date');
                        }


                        function display_event(){

                                $( "#showresult" ).on( "click", ".page_display", function() {

                                        var pos = $(this);
                                        var tmp_page_id = pos.parents('[page_id]').attr( "page_id" );
                                        var display = pos.attr( "display" );
                                        var change_display;

                                        if( display === "block" ) {
                                                change_display = "none";
                                        }else if( display === "none" ){
                                                change_display = "block";
                                        }else if( display === "blockade" ){
                                                change_display = "block";
                                        }

                                        var data = {
                                                    token:      getCookie("funbook_cookie") ,
                                                    page_id : tmp_page_id ,
                                                    change_display : change_display
                                        };
                                        var success_back = function( data ) {

                                                data = JSON.parse( data );
                                                console.log(data);
                                                loading_ajax_hide();
                                                if( data.success ) {
                                                        if( change_display === "none" ){
                                                                pos.attr( "display" , change_display ).html( "下架中" ).removeClass( "green-button" ).addClass( "red-button" );
                                                        }
                                                        else if( change_display === "block" ){
                                                                pos.attr( "display" , change_display ).html( "上架中" ).removeClass( "red-button" ).addClass( "green-button" );
                                                        }
                                                }
                                                else {
                                                        show_remind( data.msg , "error" );
                                                }

                                        }
                                        var error_back = function( data ) {
                                                console.log(data);
                                        }
                                        $.Ajax( "POST" , "php/page.php?func=set_page_display" , data , "" , success_back , error_back);

                                });

                        }

                        function del_event(){
                                var delete_page_id = $.page_id;
                                var data = {
                                            token:      getCookie("funbook_cookie") ,
                                            page_id :   delete_page_id
                                };
                                var success_back = function( data ) {

                                        data = JSON.parse( data );
                                        console.log(data);
                                        loading_ajax_hide();
                                        if( data.success ) {
                                                $( "#my_page .child-middle[page=" + data.data + "]" ).remove();
                                                $( "#page_delete_modal" ).modal( "hide" );
                                        }
                                        else {
                                                show_remind( data.msg , "error" );
                                        }

                                }
                                var error_back = function( data ) {
                                        console.log(data);
                                }
                                $.Ajax( "POST" , "php/page.php?func=delete_page" , data , "" , success_back , error_back);
                        }

                        function connected_callback(member) {
                                if (member.a_admin !== "true") {
                                        loading_ajax_hide();
                                        show_remind("不是管理者，三秒後轉跳到首頁。", "error");
                                        setTimeout(function() {
                                                location.href = "v_index.php"
                                        }, 3000);
                                } else {
                                        $.View = $("body");
                                        $.View.view_getOptionsFromForm();

                                        init();

                                        $(function() {
                                                $("#mc").css({
                                                        color: "#0de1eb"
                                                });                                                
                                               $("#bk_hide").hide(); 
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
	                                <a href="#">首頁</a> &gt; <a href="#">贊助資料統計</a>
                        </div>

                        <div class="list">

                                <h2>贊助資料統計</h2>

                                <!--sample code-->
                                <!-- 查詢條件box -->
                                <div class="dataTable_search_box">
                                                <div id="condition_Datatable">

                                                            <table>
                                                                        <tbody>
                                                                                    <tr data-column="2" id="filter_col3">
                                                                                    <td>開始日期</td>
                                                                                    <td align="left">
                                                                                                <input class="column_filter" id="condition_Datatable_starttime" type="text">
                                                                                    </td>
                                                                                    <td>結束日期</td>
                                                                                    <td align="left">
                                                                                                <input class="column_filter" id="condition_Datatable_endtime" type="text">
                                                                                    </td>
                                                                        </tbody>
                                                            </table>
                                                </div>
                                        <!--input們-->
                                        <div id="statistics_Datatable">

                                                <div style="position: relative; height: 30px;">
                                                        <div id="display_checkbox">
                                                                <div style="float: left; margin-right: 15px;"><input type="radio" value="ym" name="date_type">日期-年/月</div>
                                                                <div style="float: left; margin-right: 15px;"><input type="radio" checked="checked" value="ymd" name="date_type" style="float: left;">日期-年/月/日</div>
                                                                <div style="float: left; margin-right: 15px;"><input type="checkbox" value="pay_way" name="pay_way">付款方式</div>
                                                                <div style="float: left; margin-right: 15px;"><input type="checkbox" value="amount" name="amount">金額</div>
                                                                <div style="float: left; margin-right: 15px;"><input type="checkbox" value="account" name="account">顯示會員</div>
                                                        </div>
                                                </div>
                                        </div>

                                        <button id="btn_Datatable" class="submit">查詢</button>
                                </div>
                                
                                <div class="dataTable_function_btn_box">
                                        <div class="float-left">操作結果訊息顯示</div>
                                </div>
                                <div id="datatable"></div>
                                
                        </div>
                        </div>

                </div>

	        <?php include( "template_help_j/html/footer.php"); ?>
                <!--查看統計資訊-->
                <div aria-hidden="false" id="checkbox_account_block" class="modal fade" style="dispaly:block;">
                        <div class="modal-dialog modal-lgg">
                                <div class="modal-content">
                                        <div id="dialog-msg">
                                                <dl>
                                                    <dt class="message">
                                                            <p class="title">查看統計資訊</p>
                                                            <a data-dismiss="modal" class="close">X</a>
                                                    </dt>
                                                    <dd>
                                                            <div id="datatable2"></div>

                                                    </dd>
                                                </dl>
                                        </div>
                                </div>
                        </div>
                </div>
        </body>

</html>
