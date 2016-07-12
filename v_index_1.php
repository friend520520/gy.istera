<!doctype html>
<html>
        <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
                <meta name="format-detection" content="telephone=no">
                <meta name="robots" content="index,follow">
                <meta name="keywords" content="幫助網,幫助網,幫助網,幫助網,幫助網" />
                <meta name="description" content="幫助網幫助網幫助網幫助網幫助網幫助網幫助網幫助網幫助網幫助網" />
                <link rel='shortcut icon' href='images/favicon.ico' type='x-icon'>
                <title>首頁 | istera.com</title>
                <meta name="description" content="What you see what you get Enjoy to Interactive with living objects" >
                <link rel="stylesheet" href="css/all.css">
                <link href="template/css/mian.css" rel="stylesheet" type="text/css">
                <link href="template/css/info.css" rel="stylesheet" type="text/css">
                <link href="css/login.css" rel="stylesheet" type="text/css">

                <!-- jquery.dataTables -->
                <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
                
                <?php include( "js/all_js.php"); ?>
                
                <!--chart-->
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
                <script type="text/javascript" src="template_j/js/jquery.mousewheel.js"></script>

                <script src="https://code.highcharts.com/stock/highstock.js"></script>
                <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
                
                <script>
                    //Tab
                    $(function(){
                            var _showTab = 0;
                            $('ul.tabs li').eq(_showTab).addClass('active');
                            $('.tab_content').hide().eq(_showTab).show();
                            $('ul.tabs li').click(function() {
                                    var $this = $(this),
                                            _clickTab = $this.find('a').attr('href');
                                    $this.addClass('active').siblings('.active').removeClass('active');
                                    $(_clickTab).stop(false, true).fadeIn().siblings().hide();

                                    return false;
                            }).find('a').focus(function(){
                                    this.blur();
                            });
                    });
                </script>
        
                <script type="text/javascript">

                        $.highcharts_StockChart = [];
                        function allpoint( symbol , securityExchange , connurl , foucs , foucs_index ) {

                                $.ajax({
                                        type: 'Get',
                                        url: connurl + 'api/Stocks',
                                        dataType: "json",
                                        data: {
                                                symbol: symbol,
                                                securityExchange: securityExchange
                                        },
                                        async: false,
                                        success: function(data) {

                                                console.log(data);

                                                var data = data.Datas;

                                                // split the data set into ohlc and volume
                                                var ohlc = [],
                                                        volume = [],
                                                        dataLength = data.length,
                                                        // set the allowed units for data grouping
                                                        groupingUnits = [
                                                            ['minute',[1,5,15, 30]],  
                                                            ['hour',[1, 2,4]],  
                                                            ['day',[1]],  
                                                            ['week',[1]],  
                                                            ['month',[1]],  
                                                            ['year',[1]]  
                                                        ],

                                                        i = 0;

                                                for (i; i < dataLength; i += 1) {
                                                        var index = dataLength - i - 1 ;
                                                        ohlc.push([
                                                                new Date(data[index].MDEntryTime).getTime(), // the date
                                                                parseFloat(data[index].FirstPx), // open
                                                                parseFloat(data[index].HighPx), // high
                                                                parseFloat(data[index].LowPx), // low
                                                                parseFloat(data[index].Price), // close
                                                        ]);

                                                        volume.push([
                                                                new Date(data[index].MDEntryTime).getTime(), // the date
                                                                parseFloat(data[index].TotalVolumeTraded) // the volume
                                                        ]);
                                                }


                                                // create the chart
                                                $.highcharts_StockChart[ foucs_index ] = foucs.highcharts('StockChart', {
                                                        chart: {
                                                                events: {
                                                                        load: function() {

                                                                                /*
                                                                                // set up the updating of the chart each second
                                                                                var series = this.series[0];
                                                                                setInterval(function () {
                                                                                    var x = (new Date()).getTime(), // current time
                                                                                        y = Math.round(Math.random() * 1000000000);

                                                                                        console.log( [ x , 20.50 , 20.67 , 20.36 ,20.40 ,y] );
                                                                                        // console.log( [1246406400000,20.50,20.67,20.36,20.40,103568150] );
                                                                                        series.addPoint( [ x ,20.50,20.67,20.36,20.40,y], true, true);

                                                                                }, 1000);*/

                                                                                var tmp_focus_get = this.series[0].xAxis.getExtremes() ;
                                                                                var dMin = tmp_focus_get.dataMin;
                                                                                var dMax = tmp_focus_get.dataMax;
                                                                                var detla = parseInt( ( dMax - dMin ) / 2 );

                                                                                this.series[0].xAxis.setExtremes( dMax - detla , dMax );
                                                                                this.series[0].redraw();
                                                                                this.series[1].redraw();

                                                                        }
                                                                }
                                                        },

                                                        rangeSelector: {
                                                                selected: 1
                                                        },

                                                        title: {
                                                                text: symbol + ' ' + securityExchange
                                                        },

                                                        yAxis: [{
                                                                labels: {
                                                                        align: 'right',
                                                                        x: -3
                                                                },
                                                                title: {
                                                                        text: symbol
                                                                },
                                                                height: '80%',
                                                                lineWidth: 2,
                                                                plotLines: [{
                                                                    value: 3100,
                                                                    color: 'green',
                                                                    dashStyle: 'shortdash',
                                                                    width: 2,
                                                                    label: {
                                                                        text: 'Last quarter minimum'
                                                                    }
                                                                }, {
                                                                    value: 3060,
                                                                    color: 'red',
                                                                    dashStyle: 'shortdash',
                                                                    width: 2,
                                                                    label: {
                                                                        text: 'Last quarter maximum'
                                                                    }
                                                                }]
                                                        }, {
                                                                labels: {
                                                                        align: 'right',
                                                                        x: -3
                                                                },
                                                                title: {
                                                                        text: 'Volume'
                                                                },
                                                                top: '80%',
                                                                height: '20%',
                                                                offset: 0,
                                                                lineWidth: 2
                                                        }],

                                                        series: [{
                                                                type: 'candlestick',
                                                                name: symbol ,
                                                                data: ohlc,
                                                                dataGrouping: {
                                                                        units: groupingUnits
                                                                }
                                                        }, {
                                                                type: 'column',
                                                                name: 'Volume',
                                                                data: volume,
                                                                yAxis: 1,
                                                                dataGrouping: {
                                                                        units: groupingUnits
                                                                }
                                                        }]
                                                });

                                        },
                                        error: function() {
                                                alert("ERROR!!!");
                                        }
                                });

                        }

                        function gettick( symbol , securityExchange , connurl , foucs , foucs_index ) {

                                $.ajax({
                                        type: 'Get',
                                        url: connurl + 'api/Stocks',
                                        dataType: "json",
                                        data: {
                                                symbol: symbol,
                                                securityExchange: securityExchange
                                        },
                                        async: false,
                                        success: function(data) {

                                                console.log(data);

                                                var data = data.Datas;

                                                // split the data set into ohlc and volume
                                                var ohlc = [],
                                                        volume = [],
                                                        dataLength = data.length,
                                                        // set the allowed units for data grouping
                                                        groupingUnits = [
                                                            ['minute',[1,5,15, 30]],  
                                                            ['hour',[1, 2,4]],  
                                                            ['day',[1]],  
                                                            ['week',[1]],  
                                                            ['month',[1]],  
                                                            ['year',[1]]  
                                                        ],

                                                        i = 0;

                                                for (i; i < dataLength; i += 1) {
                                                        var index = dataLength - i - 1 ;
                                                        ohlc.push([
                                                                new Date(data[index].MDEntryTime).getTime(), // the date
                                                                parseFloat(data[index].FirstPx), // open
                                                                parseFloat(data[index].HighPx), // high
                                                                parseFloat(data[index].LowPx), // low
                                                                parseFloat(data[index].Price), // close
                                                        ]);

                                                        volume.push([
                                                                new Date(data[index].MDEntryTime).getTime(), // the date
                                                                parseFloat(data[index].TotalVolumeTraded) // the volume
                                                        ]);
                                                }


                                                // create the chart
                                                $.highcharts_StockChart[ foucs_index ] = foucs.highcharts('StockChart', {
                                                        chart: {
                                                                events: {
                                                                        load: function() {

                                                                                /*
                                                                                // set up the updating of the chart each second
                                                                                var series = this.series[0];
                                                                                setInterval(function () {
                                                                                    var x = (new Date()).getTime(), // current time
                                                                                        y = Math.round(Math.random() * 1000000000);

                                                                                        console.log( [ x , 20.50 , 20.67 , 20.36 ,20.40 ,y] );
                                                                                        // console.log( [1246406400000,20.50,20.67,20.36,20.40,103568150] );
                                                                                        series.addPoint( [ x ,20.50,20.67,20.36,20.40,y], true, true);

                                                                                }, 1000);*/

                                                                                var tmp_focus_get = this.series[0].xAxis.getExtremes() ;
                                                                                var dMin = tmp_focus_get.dataMin;
                                                                                var dMax = tmp_focus_get.dataMax;
                                                                                var detla = parseInt( ( dMax - dMin ) / 2 );

                                                                                this.series[0].xAxis.setExtremes( dMax - detla , dMax );
                                                                                this.series[0].redraw();
                                                                                this.series[1].redraw();

                                                                        }
                                                                }
                                                        },

                                                        rangeSelector: {
                                                                selected: 1
                                                        },

                                                        title: {
                                                                text: symbol + ' ' + securityExchange
                                                        },

                                                        yAxis: [{
                                                                labels: {
                                                                        align: 'right',
                                                                        x: -3
                                                                },
                                                                title: {
                                                                        text: symbol
                                                                },
                                                                height: '80%',
                                                                lineWidth: 2,
                                                                plotLines: [{
                                                                    value: 3100,
                                                                    color: 'green',
                                                                    dashStyle: 'shortdash',
                                                                    width: 2,
                                                                    label: {
                                                                        text: 'Last quarter minimum'
                                                                    }
                                                                }, {
                                                                    value: 3060,
                                                                    color: 'red',
                                                                    dashStyle: 'shortdash',
                                                                    width: 2,
                                                                    label: {
                                                                        text: 'Last quarter maximum'
                                                                    }
                                                                }]
                                                        }, {
                                                                labels: {
                                                                        align: 'right',
                                                                        x: -3
                                                                },
                                                                title: {
                                                                        text: 'Volume'
                                                                },
                                                                top: '80%',
                                                                height: '20%',
                                                                offset: 0,
                                                                lineWidth: 2
                                                        }],

                                                        series: [{
                                                                type: 'candlestick',
                                                                name: symbol ,
                                                                data: ohlc,
                                                                dataGrouping: {
                                                                        units: groupingUnits
                                                                }
                                                        }, {
                                                                type: 'column',
                                                                name: 'Volume',
                                                                data: volume,
                                                                yAxis: 1,
                                                                dataGrouping: {
                                                                        units: groupingUnits
                                                                }
                                                        }]
                                                });

                                        },
                                        error: function() {
                                                alert("ERROR!!!");
                                        }
                                });

                        }

                        function addpoint() {
                                var chart = $.highcharts_StockChart[1].highcharts().series;

                                var x = (new Date()).getTime(), // current time
                                        y = Math.round(Math.random() * 1000000000);

                                console.log([x, 20.50, 20.67, 20.36, 20.40, y]);
                                // console.log( [1246406400000,20.50,20.67,20.36,20.40,103568150] );
                                chart[0].addPoint([x, 520.50, 20.67, 20.36, 20.40, y], true, true);
                                chart[1].addPoint([x, 520.50, 20.67, 20.36, 20.40, y], true, true);


                                /*
                                 * 

                                var time = healthdata.t;
                                var i=0;
                                $.each( healthdata , function(index, value) {
                                        if( index != "t" ) {
                                                var series = chart.series[i];
                                                var obj = {
                                                        name: index,
                                                        x : time,
                                                        y : parseFloat(healthdata[index])
                                                };
                                                series.addPoint( obj , false, false);
                                                i++;
                                        }
                                });
                                 * 
                                 */
                        }


                        $(function() {

                                allpoint( 'SH000300' , 'SHSE' , "http://114.55.28.16:7845/" , $("#container") , 1 );

                                $("#container").mousewheel( function(objEvent, intDelta) {

                                            var tmp_focus_get = $.highcharts_StockChart[1].highcharts().series[0].xAxis.getExtremes() ;


                                            //var xMin = tmp_focus_get.userMin;    
                                            //var xMax = tmp_focus_get.userMax;
                                            var xMin = tmp_focus_get.min;
                                            var xMax = tmp_focus_get.max;

                                            var dMin = tmp_focus_get.dataMin;
                                            var dMax = tmp_focus_get.dataMax;

                                            if( $.delta == undefined || $.delta == 0 )
                                            {
                                            $.delta = parseInt( ( dMax - dMin ) / 1000 ) * 2 ;
                                            $.tmp_delta_level = 100 ; //Math.abs( intDelta ) ;
                                            }


                                            console.log( intDelta , $.delta );

                                            if( intDelta == 1 )
                                            {
                                                        var tmp_x1 = ( xMin + ( $.delta * $.tmp_delta_level / 20  ) ) ;
                                                        var tmp_x2 = ( xMax - ( $.delta * $.tmp_delta_level / 20 ) ) ;
                                                        console.log( tmp_x1 , tmp_x2 );
                                                        if( tmp_x1 < tmp_x2 )
                                                        {
                                                        $.highcharts_StockChart[1].highcharts().series[0].xAxis.setExtremes( tmp_x1 , tmp_x2 );
                                                        //$.highcharts_StockChart[1].highcharts().series[1].xAxis.setExtremes( xMin + $.delta , xMax - $.delta );

                                                        }

                                            }

                                            if( intDelta == -1 )
                                            {
                                                        if( dMin > xMin - $.delta * $.tmp_delta_level )
                                                        {
                                                                    var tmp_x1 = dMin ;
                                                        }else{
                                                                    var tmp_x1 = xMin - $.delta ;
                                                        }

                                                        if( dMax < xMax + $.delta * $.tmp_delta_level )
                                                        {
                                                                    var tmp_x2 = dMax ;
                                                        }else{
                                                                    var tmp_x2 = xMax + $.delta ;
                                                        }


                                                        $.highcharts_StockChart[1].highcharts().series[0].xAxis.setExtremes( tmp_x1 , tmp_x2  );
                                                        //$.highcharts_StockChart[1].highcharts().series[1].xAxis.setExtremes( tmp_x1 , tmp_x2  );
                                            }

                                                        /*
                                            if ($.swipe_queue)
                                            clearInterval($.swipe_queue);
                                            $.swipe_queue = setTimeout(function() {


                                            }, 100);*/

                                });
                        });

                </script>
                <script type="text/javascript">
                    $(function() {

                        $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function(data) {

                            // split the data set into ohlc and volume
                            var ohlc = [],
                                volume = [],
                                dataLength = data.length,
                                // set the allowed units for data grouping
                                groupingUnits = [
                                    [
                                        'week', // unit name
                                        [1] // allowed multiples
                                    ],
                                    [
                                        'month', [1, 2, 3, 4, 6]
                                    ]
                                ],

                                i = 0;

                            for (i; i < dataLength; i += 1) {
                                ohlc.push([
                                    data[i][0], // the date
                                    data[i][1], // open
                                    data[i][2], // high
                                    data[i][3], // low
                                    data[i][4] // close
                                ]);

                                volume.push([
                                    data[i][0], // the date
                                    data[i][5] // the volume
                                ]);
                            }


                            // create the chart
                            $('#container_1').highcharts('StockChart', {
                                chart : {
                                            events : {
                                                load : function () {

                                                    // set up the updating of the chart each second
                                                    var series = this.series[0];
                                                    setInterval(function () {
                                                        var x = (new Date()).getTime(), // current time
                                                            y = Math.round(Math.random() * 1000000000);

                                                            console.log( [ x , 20.50 , 20.67 , 20.36 ,20.40 ,y] );
                                                            // console.log( [1246406400000,20.50,20.67,20.36,20.40,103568150] );
                                                            series.addPoint( [ x ,20.50,20.67,20.36,20.40,y], true, true);

                                                    }, 1000);
                                                }
                                            }
                                        },

                                rangeSelector: {
                                    selected: 1
                                },

                                title: {
                                    text: 'AAPL Historical'
                                },

                                yAxis: [{
                                    labels: {
                                        align: 'right',
                                        x: -3
                                    },
                                    title: {
                                        text: 'OHLC'
                                    },
                                    height: '60%',
                                    lineWidth: 2
                                }, {
                                    labels: {
                                        align: 'right',
                                        x: -3
                                    },
                                    title: {
                                        text: 'Volume'
                                    },
                                    top: '65%',
                                    height: '35%',
                                    offset: 0,
                                    lineWidth: 2
                                }],

                                series: [{
                                    type: 'candlestick',
                                    name: 'AAPL',
                                    data: ohlc,
                                    dataGrouping: {
                                        units: groupingUnits
                                    }
                                }, {
                                    type: 'column',
                                    name: 'Volume',
                                    data: volume,
                                    yAxis: 1,
                                    dataGrouping: {
                                        units: groupingUnits
                                    }
                                }]
                            });

                        });
                    });
                </script>
                
                <style>
                    .container {
                        left: 0;
                        width: 100%;
                    }
                    .left_container {
                        width: 59%;
                        margin-right: 1%;
                    }
                    .right_container {
                        width: 40%; 
                    }
                    .left_content , .right_content {
                        min-height: 800px;margin: 5px;padding: 5px;
                    }
                    
                    
                    
                    
                    
                    /* RWD */
                    @media screen and (max-width:980px){
                        .content {
                            margin-top: 47px;
                            min-width: 99%;
                        }
                        .left_container,.right_container {
                            width: 100%; 
                        }
                    }
                    
                </style>
        </head>

        <body>
                <?php include 'html/loading.php'; ?> 
                <?php include( "html/header.php"); ?>

                <div class="content">
                    
                        <div class="container">
                            
                                <!--left-->
                                <div class="float-left left_container">
                                        <!-- top -->
                                        <div class="tab-wrap float-left" style="max-height:600px;">
                                                <ul class="tabs">
                                                        <li class="active"><a href="#tab1">自選</a></li>
                                                        <li><a href="#tab2">排行</a></li>
                                                        <li><a href="#tab3">多空</a></li>
                                                        <li><a href="#tab4">多空連續</a></li>
                                                        <li><a href="#tab5">多頭</a></li>
                                                        <li><a href="#tab6">多頭連續</a></li>
                                                </ul>
                                                <div class="tab_container">
                                                        <!--sample code-->
                                                        <div style="display:block;" id="tab1" class="tab_content">
                                                                <h2 class="set-title">自選報價
                                                                        <select name="example_length" aria-controls="example" class="">
                                                                                <option value="10">第一組</option>
                                                                                <option value="10">第二組</option>
                                                                                <option value="10">第三組</option>
                                                                                <option value="10">第四組</option>
                                                                                <option value="10">第五組</option>
                                                                        </select>
                                                                        <input type="button" class="button float-right" value="送出" id="search_btn">
                                                                </h2>
                                                            
                                                                <!--datatable-->
                                                                <div class="tablebox">
                                                                        <form action="" method="get">
                                                                                <!--AL 20160626 sample code-->
                                                                                <div class="tablebox">
                                                                                        <table id="example" class="dataTable" style="width: 100%">
                                                                                                <thead>
                                                                                                        <tr>
                                                                                                                <th>股票代號</th>
                                                                                                                <th>名稱</th>
                                                                                                                <th>時間</th>
                                                                                                                <th>買進</th>
                                                                                                                <th>賣出</th>
                                                                                                                <th>成交</th>
                                                                                                                <th>漲跌</th>
                                                                                                                <th>漲幅</th>
                                                                                                                <th>振幅</th>
                                                                                                                <th>單量</th>
                                                                                                                <th>總量</th>
                                                                                                                <th>委買</th>
                                                                                                                <th>委賣</th>
                                                                                                                <th>最高</th>
                                                                                                        </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                        <tr class="odd" role="row">
                                                                                                                <td class="center">2357</td>
                                                                                                                <td class="center">華碩</td>
                                                                                                                <td class="center">11:38:01</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">261.50</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">2.00</td>
                                                                                                                <td class="center">0.76%</td>
                                                                                                                <td class="center">1.71%</td>
                                                                                                                <td class="center">4</td>
                                                                                                                <td class="center">1469</td>
                                                                                                                <td class="center">7</td>
                                                                                                                <td class="center">38</td>
                                                                                                                <td class="center">265</td>
                                                                                                        </tr>
                                                                                                        <tr class="even" role="row">
                                                                                                                <td class="center">2330</td>
                                                                                                                <td class="center">台積電</td>
                                                                                                                <td class="center">11:38:02</td>
                                                                                                                <td class="center">75.20</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">0.70</td>
                                                                                                                <td class="center">0.94%</td>
                                                                                                                <td class="center">0.80%</td>
                                                                                                                <td class="center">17</td>
                                                                                                                <td class="center">33920</td>
                                                                                                                <td class="center">1060</td>
                                                                                                                <td class="center">22</td>
                                                                                                                <td class="center">75</td>
                                                                                                        </tr>
                                                                                                        <tr class="odd" role="row">
                                                                                                                <td class="center">2357</td>
                                                                                                                <td class="center">華碩</td>
                                                                                                                <td class="center">11:38:01</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">261.50</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">2.00</td>
                                                                                                                <td class="center">0.76%</td>
                                                                                                                <td class="center">1.71%</td>
                                                                                                                <td class="center">4</td>
                                                                                                                <td class="center">1469</td>
                                                                                                                <td class="center">7</td>
                                                                                                                <td class="center">38</td>
                                                                                                                <td class="center">265</td>
                                                                                                        </tr>
                                                                                                        <tr class="even" role="row">
                                                                                                                <td class="center">2330</td>
                                                                                                                <td class="center">台積電</td>
                                                                                                                <td class="center">11:38:02</td>
                                                                                                                <td class="center">75.20</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">0.70</td>
                                                                                                                <td class="center">0.94%</td>
                                                                                                                <td class="center">0.80%</td>
                                                                                                                <td class="center">17</td>
                                                                                                                <td class="center">33920</td>
                                                                                                                <td class="center">1060</td>
                                                                                                                <td class="center">22</td>
                                                                                                                <td class="center">75</td>
                                                                                                        </tr>
                                                                                                        <tr class="odd" role="row">
                                                                                                                <td class="center">2357</td>
                                                                                                                <td class="center">華碩</td>
                                                                                                                <td class="center">11:38:01</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">261.50</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">2.00</td>
                                                                                                                <td class="center">0.76%</td>
                                                                                                                <td class="center">1.71%</td>
                                                                                                                <td class="center">4</td>
                                                                                                                <td class="center">1469</td>
                                                                                                                <td class="center">7</td>
                                                                                                                <td class="center">38</td>
                                                                                                                <td class="center">265</td>
                                                                                                        </tr>
                                                                                                </tbody>
                                                                                        </table>
                                                                                </div>

                                                                                <!--pageNumber-->
                                                                                <ul class="page-number">
                                                                                        <li><a href="#">&laquo;</a></li>
                                                                                        <li><a href="#">&lsaquo;</a></li>
                                                                                        <li><a href="#" class="on">1</a></li>
                                                                                        <li><a href="#">2</a></li>
                                                                                        <li><a href="#">3</a></li>
                                                                                        <li><a href="#">4</a></li>
                                                                                        <li><a href="#">5</a></li>
                                                                                        <li><a href="#">&rsaquo;</a></li>
                                                                                        <li><a href="#">&raquo;</a></li>
                                                                                </ul>
                                                                        </form>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        
                                        <!-- bottom-left-->
                                        <div class="list float-left" style="overflow-x: hidden; width: 43%; margin-right: 1%;">
                                                <h2 class="set-title">2357 華碩
                                                        <select name="example_length" aria-controls="example" class="">
                                                                <option value="10">第一組</option>
                                                                <option value="10">第二組</option>
                                                                <option value="10">第三組</option>
                                                                <option value="10">第四組</option>
                                                                <option value="10">第五組</option>
                                                        </select>
                                                        <input type="button" class="button float-right" value="查詢" id="search_btn">
                                                </h2>
                                                <div id="container_1" style="height: 300px;"></div>
                                        </div>
                                        
                                        <!-- bottom-left-->
                                        <div class="tab-wrap float-left" style="width:50%;overflow-x: hidden;max-height:300px;">
                                                <ul class="tabs">
                                                        <li class="active"><a href="#tab12">五檔</a></li>
                                                        <li><a href="#tab13">分時</a></li>
                                                        <li><a href="#tab14">九宮格</a></li>
                                                        <li><a href="#tab15">指標</a></li>
                                                </ul>
                                                <div class="tab_container">
                                                        <!--sample code-->
                                                        <div style="display:block;" id="tab12" class="tab_content">
                                                            
                                                                <!--datatable-->
                                                                <div class="tablebox">
                                                                        <form action="" method="get">
                                                                                <!--AL 20160626 sample code-->
                                                                                <div class="tablebox">
                                                                                        <table id="example" class="dataTable" style="width: 100%">
                                                                                                <thead>
                                                                                                        <tr>
                                                                                                                <th>股票代號</th>
                                                                                                                <th>名稱</th>
                                                                                                                <th>時間</th>
                                                                                                                <th>買進</th>
                                                                                                                <th>賣出</th>
                                                                                                                <th>成交</th>
                                                                                                                <th>漲跌</th>
                                                                                                                <th>漲幅</th>
                                                                                                                <th>振幅</th>
                                                                                                                <th>單量</th>
                                                                                                                <th>總量</th>
                                                                                                                <th>委買</th>
                                                                                                                <th>委賣</th>
                                                                                                                <th>最高</th>
                                                                                                        </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                        <tr class="odd" role="row">
                                                                                                                <td class="center">2357</td>
                                                                                                                <td class="center">華碩</td>
                                                                                                                <td class="center">11:38:01</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">261.50</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">2.00</td>
                                                                                                                <td class="center">0.76%</td>
                                                                                                                <td class="center">1.71%</td>
                                                                                                                <td class="center">4</td>
                                                                                                                <td class="center">1469</td>
                                                                                                                <td class="center">7</td>
                                                                                                                <td class="center">38</td>
                                                                                                                <td class="center">265</td>
                                                                                                        </tr>
                                                                                                        <tr class="even" role="row">
                                                                                                                <td class="center">2330</td>
                                                                                                                <td class="center">台積電</td>
                                                                                                                <td class="center">11:38:02</td>
                                                                                                                <td class="center">75.20</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">0.70</td>
                                                                                                                <td class="center">0.94%</td>
                                                                                                                <td class="center">0.80%</td>
                                                                                                                <td class="center">17</td>
                                                                                                                <td class="center">33920</td>
                                                                                                                <td class="center">1060</td>
                                                                                                                <td class="center">22</td>
                                                                                                                <td class="center">75</td>
                                                                                                        </tr>
                                                                                                        <tr class="odd" role="row">
                                                                                                                <td class="center">2357</td>
                                                                                                                <td class="center">華碩</td>
                                                                                                                <td class="center">11:38:01</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">261.50</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">2.00</td>
                                                                                                                <td class="center">0.76%</td>
                                                                                                                <td class="center">1.71%</td>
                                                                                                                <td class="center">4</td>
                                                                                                                <td class="center">1469</td>
                                                                                                                <td class="center">7</td>
                                                                                                                <td class="center">38</td>
                                                                                                                <td class="center">265</td>
                                                                                                        </tr>
                                                                                                        <tr class="even" role="row">
                                                                                                                <td class="center">2330</td>
                                                                                                                <td class="center">台積電</td>
                                                                                                                <td class="center">11:38:02</td>
                                                                                                                <td class="center">75.20</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">0.70</td>
                                                                                                                <td class="center">0.94%</td>
                                                                                                                <td class="center">0.80%</td>
                                                                                                                <td class="center">17</td>
                                                                                                                <td class="center">33920</td>
                                                                                                                <td class="center">1060</td>
                                                                                                                <td class="center">22</td>
                                                                                                                <td class="center">75</td>
                                                                                                        </tr>
                                                                                                        <tr class="odd" role="row">
                                                                                                                <td class="center">2357</td>
                                                                                                                <td class="center">華碩</td>
                                                                                                                <td class="center">11:38:01</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">261.50</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">2.00</td>
                                                                                                                <td class="center">0.76%</td>
                                                                                                                <td class="center">1.71%</td>
                                                                                                                <td class="center">4</td>
                                                                                                                <td class="center">1469</td>
                                                                                                                <td class="center">7</td>
                                                                                                                <td class="center">38</td>
                                                                                                                <td class="center">265</td>
                                                                                                        </tr>
                                                                                                        <tr class="even" role="row">
                                                                                                                <td class="center">2330</td>
                                                                                                                <td class="center">台積電</td>
                                                                                                                <td class="center">11:38:02</td>
                                                                                                                <td class="center">75.20</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">0.70</td>
                                                                                                                <td class="center">0.94%</td>
                                                                                                                <td class="center">0.80%</td>
                                                                                                                <td class="center">17</td>
                                                                                                                <td class="center">33920</td>
                                                                                                                <td class="center">1060</td>
                                                                                                                <td class="center">22</td>
                                                                                                                <td class="center">75</td>
                                                                                                        </tr>
                                                                                                        <tr class="odd" role="row">
                                                                                                                <td class="center">2357</td>
                                                                                                                <td class="center">華碩</td>
                                                                                                                <td class="center">11:38:01</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">261.50</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">2.00</td>
                                                                                                                <td class="center">0.76%</td>
                                                                                                                <td class="center">1.71%</td>
                                                                                                                <td class="center">4</td>
                                                                                                                <td class="center">1469</td>
                                                                                                                <td class="center">7</td>
                                                                                                                <td class="center">38</td>
                                                                                                                <td class="center">265</td>
                                                                                                        </tr>
                                                                                                        <tr class="even" role="row">
                                                                                                                <td class="center">2330</td>
                                                                                                                <td class="center">台積電</td>
                                                                                                                <td class="center">11:38:02</td>
                                                                                                                <td class="center">75.20</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">0.70</td>
                                                                                                                <td class="center">0.94%</td>
                                                                                                                <td class="center">0.80%</td>
                                                                                                                <td class="center">17</td>
                                                                                                                <td class="center">33920</td>
                                                                                                                <td class="center">1060</td>
                                                                                                                <td class="center">22</td>
                                                                                                                <td class="center">75</td>
                                                                                                        </tr>
                                                                                                        <tr class="odd" role="row">
                                                                                                                <td class="center">2357</td>
                                                                                                                <td class="center">華碩</td>
                                                                                                                <td class="center">11:38:01</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">261.50</td>
                                                                                                                <td class="center">261.00</td>
                                                                                                                <td class="center">2.00</td>
                                                                                                                <td class="center">0.76%</td>
                                                                                                                <td class="center">1.71%</td>
                                                                                                                <td class="center">4</td>
                                                                                                                <td class="center">1469</td>
                                                                                                                <td class="center">7</td>
                                                                                                                <td class="center">38</td>
                                                                                                                <td class="center">265</td>
                                                                                                        </tr>
                                                                                                        <tr class="even" role="row">
                                                                                                                <td class="center">2330</td>
                                                                                                                <td class="center">台積電</td>
                                                                                                                <td class="center">11:38:02</td>
                                                                                                                <td class="center">75.20</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">75.30</td>
                                                                                                                <td class="center">0.70</td>
                                                                                                                <td class="center">0.94%</td>
                                                                                                                <td class="center">0.80%</td>
                                                                                                                <td class="center">17</td>
                                                                                                                <td class="center">33920</td>
                                                                                                                <td class="center">1060</td>
                                                                                                                <td class="center">22</td>
                                                                                                                <td class="center">75</td>
                                                                                                        </tr>
                                                                                                </tbody>
                                                                                        </table>
                                                                                </div>

                                                                                <!--pageNumber-->
                                                                                <ul class="page-number">
                                                                                        <li><a href="#">&laquo;</a></li>
                                                                                        <li><a href="#">&lsaquo;</a></li>
                                                                                        <li><a href="#" class="on">1</a></li>
                                                                                        <li><a href="#">2</a></li>
                                                                                        <li><a href="#">3</a></li>
                                                                                        <li><a href="#">4</a></li>
                                                                                        <li><a href="#">5</a></li>
                                                                                        <li><a href="#">&rsaquo;</a></li>
                                                                                        <li><a href="#">&raquo;</a></li>
                                                                                </ul>
                                                                        </form>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                
                                <!-- right -->
                                <div class="float-left right_container">
                                        <!-- top -->
                                        <div class="tab-wrap float-left">
                                                <ul class="tabs">
                                                        <li class="active"><a href="#tab7">上証指數</a></li>
                                                        <li><a href="#tab8">滬深300</a></li>
                                                        <li><a href="#tab9">綜合指數</a></li>
                                                        <li><a href="#tab10">商業指數</a></li>
                                                        <li><a href="#tab11">工業指數</a></li>
                                                </ul>
                                                <div class="tab_container">
                                                        <!--sample code-->
                                                        <div style="display:block;" id="tab7" class="tab_content">
                                                                <h2 class="set-title">類股
                                                                        <select name="example_length" aria-controls="example" class="">
                                                                                <option value="10">TSE加權指數</option>
                                                                        </select>
                                                                        <input type="button" class="button" value="查詢" id="search_btn">
                                                                </h2>
                                                            
                                                                <div id="container" style="height: 800px;"></div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                
                                
                                        
                        </div>
                </div>
            
                <?php include( "html/footer.php"); ?>
        </body>
        

        <script type="text/javascript">
                
                $("document").ready(function() {
                        
                        //init web ++
                        $(window).scrollTop( 0 );
                        $( "#loadingpage" ).css("height", $(document).height() + 50 + "px");
                        $("input[type=text][id!=cooperate_url_2]").val("");
                        $("textarea").val("");
                        $("select").val("");
                        //init web --
                        
                        $('form').submit(false);
                });
                
                function t_bind( pos , event ){
                    
                    pos.unbind("input").bind("input",function(){
                            eval( event+'($(this))' );
                    });
                    pos.trigger( "input" );
                    
                }
                
                function init(){
                        
                        $( "#accept" ).unbind('click').bind( "click" , function(e) {
                                
                                $(".alert").hide();
                                var bool = true;
                                var msg = "",pos,input_type;
                                $.each( $(".register input.necessary") , function( index , value ){
                                        input_type = $( value ).attr( "type" );
                                        if( input_type === "email" ){
                                                if( !email_event( $( value ) ) ){
                                                        bool = false;
                                                        pos = $( value );
                                                }
                                        }
                                        else if( input_type === "password" ){
                                                if( !password_event( $( value ) ) ){
                                                        bool = false;
                                                        pos = $( value );
                                                }
                                        }
                                        else{
                                                if( !input_event( $( value ) ) ){
                                                        bool = false;
                                                        pos = $( value );
                                                }
                                        }
                                
                                });
                                
                                if( $( "#account_pwd2" ).val() === "" ){
                                    bool = false;
                                    $( "#account_pwd2" ).parent().find(".alert.warning").show();
                                    $( "#account_pwd" ).val( "" );
                                    $( "#account_pwd2" ).val( "" );
                                    pos = $( "#account_pwd2" );
                                }
                                else if( $( "#account_pwd2" ).val() !== $( "#account_pwd" ).val() ) {
                                    bool = false;
                                    $( "#account_pwd2" ).parent().find(".alert.error").show();
                                    $( "#account_pwd" ).val( "" );
                                    $( "#account_pwd2" ).val( "" );
                                    pos = $( "#account_pwd2" );
                                }
                                else {
                                    $( "#account_pwd2" ).parent().find(".alert.error").hide();
                                }
                                
                                if( $( "#account_country" ).val() === null ) {
                                    bool = false;
                                    $( "#account_country" ).parent().find(".alert.error").show();
                                    pos = $( "#account_country" );
                                }
                                else{
                                    $( "#account_country" ).parent().find(".alert.error").hide();
                                }
                                if( $( "#input_captcha2" ).val() === "" ) {
                                    bool = false;
                                    msg += msg === "" ? "請" : "、";
                                    msg += "輸入驗證碼";
                                    pos = $( "#input_captcha2" );
                                }
                                if( !$( "#account_accept:checked" )[0] ) {
                                    bool = false;
                                    msg += msg === "" ? "請" : "、";
                                    msg += "閱讀並同意條款";
                                }
                                
                                if( bool ) {
                                    loading_ajax_show();
                                    var data = {
                                                a_icon:    $.upload_file.account_icon,
                                                a_email:      $( "#account_email" ).val(),
                                                a_password:   md5( $( "#account_pwd" ).val() ),
                                                a_nickname:       $( "#account_nickname" ).val(),
                                                a_country:     $( "#account_country" ).val(),
                                                a_eighteen:     $( "#account_eighteen" ).is( ":checked" ),
                                                captcha:     $( "#input_captcha2" ).val(),
                                                a_id:       getParameterByName( "id" )
                                    };
                                    var success_back = function( data ) {

                                            data = JSON.parse( data );
                                            console.log(data);
                                            loading_ajax_hide();
                                            if( data.Success ) {
                                                setCookie( "istera_cookie" , data.data, "", "/", ".ggyyggy.com");
                                                $( "#cooperate_form1" ).hide();
                                                $( "#cooperate_form3" ).show();
                                                setTimeout( function(){
                                                        location.href=website_memberhome_url;
                                                } , 3000 );
                                            }
                                            else {
                                                re_captcha();
                                                show_remind( data.ErrMsg , "error" );
                                                if( data.action === "email" ){
                                                        $( "#account_email" ).parent().find(".alert").hide();
                                                        $( "#account_email" ).parent().find(".alert.error2").show();
                                                        scrollto( $( "#account_email" ) );
                                                }
                                                else if( data.action === "captcha" ){
                                                        $( "#input_captcha2" ).parent().find(".alert").hide();
                                                        $( "#input_captcha2" ).parent().find(".alert.error").show();
                                                        scrollto( $( "#input_captcha2" ) );
                                                }
                                            }

                                    }
                                    var error_back = function( data ) {
                                            console.log(data);
                                    }
                                    $.Ajax( "POST" , "php/member.php?func=add" , data , "" , success_back , error_back);
                                    
                                }
                                else {
                                    re_captcha();
                                    show_remind( msg , "error" );
                                    scrollto( pos );
                                }
                                
                        });
                        
                        $( "#member_login" ).unbind('click').bind( "click" , function(e) {
                                
                                $(".alert").hide();
                                var bool = true;
                                var msg = "",pos,input_type;
                                $.each( $("#member-login .login input.necessary") , function( index , value ){
                                        input_type = $( value ).attr( "type" );
                                        if( input_type === "email" ){
                                                if( $( value ).val() === "" ) {
                                                        bool = false;
                                                        $( value ).parent().find(".alert.warning").show();
                                                        pos = $( value );
                                                }
                                                else if( !value.validity.valid ){
                                                        bool = false;
                                                        $( value ).parent().find(".alert.error").show();
                                                        pos = $( value );
                                                }
                                                else {
                                                        $( value ).parent().find(".alert").hide();
                                                        $( value ).parent().find(".alert.success").show();
                                                }
                                        }
                                        else{
                                                if( $( value ).val() === "" ) {
                                                        bool = false;
                                                        $( value ).parent().find(".alert.warning").show();
                                                        pos = $( value );
                                                }
                                                else {
                                                        $( value ).parent().find(".alert").hide();
                                                        $( value ).parent().find(".alert.success").show();
                                                }
                                        }
                                
                                });
                                
                                if( $( "#input_captcha1" ).val() === "" ) {
                                    bool = false;
                                    msg += msg === "" ? "請" : "、";
                                    msg += "輸入驗證碼";
                                    pos = $( "#input_captcha1" );
                                }
                                if( $( "#auto_login_time" ).val() === null ) {
                                    bool = false;
                                    msg += msg === "" ? "請" : "、";
                                    msg += "選擇自動登入時間";
                                    pos = $( "#auto_login_time" );
                                }
                                if( bool ) {
                                    loading_ajax_show();
                                    login_func( $( "#account_email1" ).val() , $( "#account_pwd1" ).val() , $('#input_captcha1').val() , $('#remember_account1').is( ":checked" ) , $("#auto_login_time").val() );
                                }
                                else {
                                    re_captcha();
                                    show_remind( msg , "error" );
                                    scrollto( pos );
                                }
                                
                        });
                        
                }
                
                function email_event( pos ){
                        
                        var bool = true;
                        pos.parent().find(".alert").hide();
                        if( pos.val() === "" ) {
                                bool = false;
                                pos.parent().find(".alert.warning").show();
                        }
                        else if( !pos[0].validity.valid ){
                                bool = false;
                                pos.parent().find(".alert.error:not(.error2)").show();
                        }
                        else {
                                pos.parent().find(".alert.success").show();
                        }
                        return bool;
                }
                function password_event( pos ){
                        
                        var bool = true;
                        pos.parent().find(".alert").hide();       
                        if( pos.val() === "" || !/^(?=.*\d)(?=.*[a-z]).{8,}$/.test( pos.val() ) ){
                                bool = false;
                                pos.parent().find(".alert.warning").show();
                        }
                        else {
                                pos.parent().find(".alert.success").show();
                        }
                        return bool;
                }
                function input_event( pos ){
                        
                        var bool = true;
                        pos.parent().find(".alert").hide();
                        if( pos.val() === "" ) {
                                bool = false;
                                pos.parent().find(".alert.warning").show();
                        }
                        else {
                                pos.parent().find(".alert.success").show();
                        }
                        return bool;
                }
                
                function unconnected_callback() {
                        init();
                };
                /*function connected_callback( member ) {
                        loading_ajax_hide();
                        show_remind( "已登入，三秒後轉跳到會員頁。" , "error"  );
                        setTimeout( function(){ location.href = website_memberhome_url }, 3000);
                };*/
                
        </script>
</html>
