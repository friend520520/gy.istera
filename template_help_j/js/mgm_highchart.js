/**
 * @author: abin, arod
 * @createDate: 2016/3/14, 2016/3/23
 * 
 * 純hichart列表，由ajax向mgm_highchart.php拿資料
 * @event 點擊圖表時間點時，會呼叫的function -> mgm_managers_console.HighStockChartSeriesEventFun 
 * 將x座標時間點傳送至mgm_hichart_click.js至各資料表查詢，SQL依時間點。
 * */
$(document).ready(function() {
    /* highcharts 顯示語言設定*/
    Highcharts.setOptions({
          lang: {
                months: ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
                weekdays: ["星期天", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"],
                shortMonths: ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
            }
    });
    mgm_managers_console.HighStockChartSeriesEventFun = function(tag, e) {
        if( typeof $.statistics_table !== "undefined" )
            $.statistics_table(tag, e);
    }
    
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    today = mm+'/'+dd+'/'+yyyy;
    
    var firstDaythisYear = '1/1/'+yyyy;
    
    mgm_managers_console.getCntAccountByYear(formatDate(new Date(firstDaythisYear)), formatDate(new Date(today)));
    //mgm_managers_console.getCntAccountByYear(formatDate(new Date('2016/1/22')), formatDate(new Date('2016/4/30')));
});

var mgm_managers_console = {
    /**
     * HighStockChart折線圖，點擊圖表點時，會呼叫的function
     * @param obj tag bindevent的tag
     * @param clickEvent clickEvent 點擊的event值
     */
    HighStockChartSeriesEventFun: function(tagEvent, clickEvent) {
        console.log("HighStockChartSeriesEventFun");
        console.log(tagEvent);
        console.log(clickEvent);
    },
    
    /**
     * 取得一年內每日的會員成長數目
     * @param string startData 查詢起始日 ex:2015-01-01
     * @param string endDate 查詢結束日 ex:2015-01-31
     */
    getCntAccountByYear: function(startData, endDate) {
        
        var yUnitName,tmp,chart_title_eng,chart_title_chn,ajax_url_php,chart_title_setting;
        tmp = typeof $.global_date_statistics_column === "string" ? [$.global_date_statistics_column] : $.global_date_statistics_column;
        $.each( tmp , function( index , value ){
                
                switch( value ){ //table:date_statistics
                    case "income"://table:date_statistics > col:income ,etc
                        yUnitName = "支出";
                        chart_title_eng = "Cost";
                        chart_title_chn = '<span>網站成本<span><a href="mgm_supporting_income_statistics.php">(網站獎金支出)</a></span></span>';
                        ajax_url_php = "php/mgm_highchart.php";
                        chart_title_setting = '<span><a href="mgm_behavioral_event_set.php">行為事件設定</a></span>';
                        break;
                    case "click":
                        yUnitName = "次數";
                        chart_title_eng = "times";
                        chart_title_chn = '<span>文章點閱次數</span>';
                        ajax_url_php = "php/mgm_highchart.php";
                        chart_title_setting = '';
                        break;
                    case "vip":
                        yUnitName = "收入";
                        chart_title_eng = "Revenue";
                        chart_title_chn = '<span>網站收入<span>(<a href="mgm_vip_statistics.php">網站VIP收入</a>)</span></span>';
                        ajax_url_php = "php/mgm_highchart.php";
                        chart_title_setting = '<span><a href="mgm_sponsored_set_vip.php">贊助VIP設定</a></span>';
                        break;
                    case "page":
                        yUnitName = "篇數";
                        chart_title_eng = "pages";
                        chart_title_chn = '<span>網站新增文章</span>';
                        ajax_url_php = "php/mgm_highchart.php";
                        chart_title_setting = '';
                        break;
                    case "accessories":
                        yUnitName = "次數";
                        chart_title_eng = "times";
                        chart_title_chn = '<span>附件下載次數</span>';
                        ajax_url_php = "php/mgm_highchart.php";
                        chart_title_setting = '';
                        break;
                    case "accessories_size":
                        yUnitName = "bytes";
                        chart_title_eng = "Expense";
                        chart_title_chn = '<span>附件下載流量</span>';
                        ajax_url_php = "php/mgm_highchart.php";
                        chart_title_setting = '';
                        break;
                    case "both_pages_accessories_size":
                        yUnitName = "M";
                        chart_title_eng = "Expense";
                        chart_title_chn = '<span>預估網站費用(<span><a href="mgm_article_clickthrough_expense_statistics.php">文章點閱流量支出</a></span>、<span><a href="mgm_accessories_download_expense_statistics.php">附件下載流量支出</a></span>)</span>';
                        ajax_url_php = "php/mgm_highchart_page_accessory_expense.php";
                        chart_title_setting = '';
                        break;
                    case "gross_profit":
                        yUnitName = "損益";
                        chart_title_eng = "Gross Profit";
                        chart_title_chn = '<span>網站毛利( 網站收入 - 網站成本 )</span>';
                        ajax_url_php = "php/mgm_highchart_gross_profit.php";
                        chart_title_setting = '';
                        break;
                }

                var createLine = function(data) {
                    console.log(data);
                    var target = $("#chartList");

                    target.append('<div class="col-lg-12" style="margin-bottom: 50px;">\n\
                                        <h2 style="margin: 10px 0px; width: 50%; float: left;">[ '+this.data2+' '+this.data3+' ]'+this.data4+'</h2>'
                                        + select_range_input() +
                                        '<div id="'+value+'" style="height: 300px;"></div>\n\
                                   </div>');
                    var point = {
                        events: {
                            click: function (e) {
                                var callBackFnc = mgm_managers_console.HighStockChartSeriesEventFun;
                                if(typeof(callBackFnc) == "function") {
                                    callBackFnc(this, e);
                                } else {
                                    console.log("HighStockChartSeriesEventFun is not a function!!");
                                }
                            }
                        }
                    };
                    mgm_managers_console.initHighStockChart(value, [{
                        name : this.name,
                        data : data['value'],
                        marker : {
                            enabled : true,
                            radius : 3
                        },
                        shadow : true,
                        point: point
                    }]);
                    
                }
                $.ajax({
                            
                            type : "POST" ,
                            dataType: "json",
                            url : ajax_url_php,
                            async: true ,
                            data : {
                                startDate: startData
                                ,endDate: endDate
                                ,DateStatistics_Column: value
                            } ,
                            name : yUnitName,
                            data2 : chart_title_eng ,
                            data3 : chart_title_chn ,
                            data4 : chart_title_setting ,
                            success : createLine ,
                            error : function(e) {console.log(e)}
                });
                
        });
        
    },

    /**
     * 建置Highcharts的折線圖
     * @param string tagID tag的id
     * @param array xAxis x軸的資料
     * ex:[1213,1235,2342]
     * @param array data y軸的資料
     * ex[1213,1235,2342]
     */
    /*initHighcharts: function(tagID, xAxis, data) {
        if($('#'+tagID).highcharts() != undefined) {
            $('#'+tagID).highcharts().destroy();
        }
        $('#'+tagID).html("");
        $('#'+tagID).highcharts({
            title: {
                text: 'a',
                style: {
                    visibility: 'hidden'
                }
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: xAxis
            },
            yAxis: {
                title: {
                    text: yUnitName,
                    rotation:360,
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }],
                labels: {
                    formatter: function () {
                        return Highcharts.numberFormat(this.value,0);
                    }
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0
            },
            series: [{
                name: yUnitName,
                data: data
            }],
            credits: {
                enabled: false
            },
        });
    },*/
    
    /**
     * 建置HighStockChart的折線圖
     * @param string tagID tag的id
     * @param array[array] data 折線圖的資料
     * ex:[[1236902400000,148],[1237161600000,359],[1237248000000,871],[1237334400000,954]]
     */
    initHighStockChart: function(tagID, data) {
        if($('#'+tagID).highcharts() != undefined) {
            $('#'+tagID).highcharts().destroy();
        }
        $('#'+tagID).html("");
        $('#'+tagID).highcharts('StockChart', {
            chart: {
                height: 300,
            },
            rangeSelector : {
                selected: 4,
                inputEnabled: false,
                buttonTheme: {
                    //visibility: 'hidden'
                },
                labelStyle: {
                    //visibility: 'hidden'
                }
            },

            title : {
                text : ''
            },
            xAxis: {
                events: {
                    setExtremes: function (e) {
                        if ( e.DOMEvent && e.DOMEvent.type == 'mouseup'
                            || typeof(e.rangeSelectorButton)!== 'undefined'
                            || e.trigger == 'rangeSelectorInput') {
                            var min = Highcharts.dateFormat(null, e.min);
                            var max = Highcharts.dateFormat(null, e.max);
                            console.log("min: "+ e.min + " , max: " + e.max);
                            console.log("min: "+ min + " , max: " + max);
                            $("#startTime").val(min.split(" ")[0]);
                            $("#endTime").val(max.split(" ")[0]);
			    
                            initHighStockChart_cb( parseInt( e.min ) , parseInt( e.max ) );
                            
                        }
                    }
                }
            },
            yAxis: {
                allowDecimals: false,
            },
            series : data,
            credits: {
                enabled: false
            }
        },function(chart){
            // apply the date pickers
            setTimeout(function(){
                var max = chart.xAxis[0].max;
                var min = chart.xAxis[0].min;
                var datepicker_object = {
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function(dateText) {
                        console.log("min: "+ $("#startTime" ).val() + " , max: " + $("#endTime" ).val());
                        $("#startTime" ).datepicker( "getDate" ).getTime()
                        $("#vip").highcharts().xAxis[0].setExtremes(
                                $("#startTime" ).datepicker( "getDate" ).getTime() 
                                ,$("#endTime" ).datepicker( "getDate" ).getTime()
                        );

                        initHighStockChart_cb( $("#startTime" ).datepicker( "getDate" ).getTime()  , $("#endTime" ).datepicker( "getDate" ).getTime() );
                
                    },
                    dateFormat: 'yy-mm-dd',
                    minDate: new Date(chart.xAxis[0].min - (24*3600*1000)),
                    maxDate: new Date(chart.xAxis[0].max - (24*3600*1000))
                };
                //時間需減一日　- (24*3600*1000)
                datepicker_object.defaultDate = new Date(chart.xAxis[0].min - (24*3600*1000));
                $("#startTime").datepicker(datepicker_object);
                $("#startTime").val(numberToyyyyMMdd(chart.xAxis[0].min - (24*3600*1000) ));
                
                datepicker_object.defaultDate = new Date(chart.xAxis[0].max - (24*3600*1000));
                $("#endTime").datepicker(datepicker_object);
                $("#endTime").val(numberToyyyyMMdd(chart.xAxis[0].max - (24*3600*1000)));
            },0)
        });
    },
};

var select_range_input = function() {
    var html = '<div style="float: right; margin-top: 20px;">\n\
                    <input id="startTime" style="width: 100px; border: 1px solid black; text-align: center;"> ~ \n\
                    <input id="endTime" style="width: 100px; border: 1px solid black; text-align: center;">\n\
                </div>'
    return html;
}

/**
 * 日期轉字串 yyyy-MM-dd
 * @param date date 時間
 */
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

/**
 * 數字轉yyyyMMdd 1451664000000 => 2016-01-01
 * @param int(long) number 數字
 */
function numberToyyyyMMdd(number) {
    var date = new Date(number);
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth()+1).toString(); // getMonth() is zero-based
    var dd  = date.getDate().toString();
    return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" +(dd[1]?dd:"0"+dd[0]); // padding
}
