/*
 * 
 */
$.statistics_table = function(tag, e) {
        console.log(tag);
        console.log(e);

        var timepoint = tag.x;
        timepoint = timepoint-(1000*60*60*24);
        
        var data = {
                token: $.global_getcookie,
                timepoint: timepoint
        };
        var success_back = function(data) {

                console.log(data);
                var tmp = "";
                data = JSON.parse(data);
                console.log(data);
                if (data.success) 
                {
                        var select_colname = [] , str;
                        $.each( $("#selece-search-table thead th") , function(index, value) {
                          //if( $.inArray( select_colname , $( value ).val() ) === -1 )
                          select_colname[select_colname.length] = $(value).attr("title");
                        })

                        console.log(select_colname);
                        $.each( data.data, function(index, value) {

                                tmp += '<tr style="height: 120px;" class="showing odd child-middle" role="row"'+ $.global_AI_id +'="' + value[$.global_AI_id]+ '">';

                                console.log(value);
                                for (var i = 0; i < select_colname.length ; i++ )
                                {
                                        if (value && value[select_colname[i]]) 
                                        {
                                                str = String( value[select_colname[i]] );
                                                if (    str.search(".jpg") !== -1 ||
                                                        str.search(".jpeg") !== -1 ||
                                                        str.search(".png") !== -1 ||
                                                        str.search(".gif") !== -1) 
                                                {
                                                        tmp += '<td class="center">' +
                                                                '<a>' +
                                                                '<div style="background-image: url(\'' + value[select_colname[i]] + '\'); cursor: pointer; width: 100px; height: 100px; margin: 0px; left: 7%;" class="bg_top"></div>' +
                                                                '</a>' +
                                                                '</td>';
                                                }
                                                else 
                                                {
                                                        if (value[select_colname[i]].length > 30) {
                                                                tmp += '<td class="center">' + value[select_colname[i]].substr(0, 30) + '...' + '</td>';
                                                        } else {
                                                                tmp += '<td class="center">' + value[select_colname[i]] + '</td>';
                                                        }
                                                }
                                        } else {
                                                tmp += '<td class="center"></td>';
                                        }
                                }

                                tmp += '</tr>';
                        });

                        //$( "#selece-search-table tbody" ).html( tmp );
                        $("#hiddenresult").html(tmp);
                        
                        var click_date = new Date();
                        click_date.setTime(timepoint);
                        var click_date_tostring = click_date.getFullYear()+'-'+ (click_date.getMonth()+1)+'-'+click_date.getDate();
                        $("#click_date").html(click_date_tostring);
                        
                        init_page_switch();


                } else {
                        $("#page-switch").html('');
                        $("#hiddenresult").html('');
                        $("#showresult").html('');
                        show_remind( "找不到符合搜尋字詞的會員" );
                }

        };
        var error_back = function(data) 
        {
                console.log(data);
        };
        $.Ajax( "POST" , "php/" + $.global_php + "?func=fn_hichart_click_list_search" , data, "" , success_back, error_back);
}

function init_page_switch(){

        $.View.view_getOptionsFromForm().destroy();
        $.View.view_getOptionsFromForm()._SetOpts({
                focus: $(".padding-content"),
                focus_2: $("#showresult"),
                focus_3: $("#page-switch"),
                hiddenresult : $( "#hiddenresult" ),
                cancel_checkbox_func: function(){
                    if( $( "#checkall" ).is( ":checked" ) ) {
                        $( "#checkall" ).click();
                    }
                }
        });
        $.View.view_getOptionsFromForm().init();

}