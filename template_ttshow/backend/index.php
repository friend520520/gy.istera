<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name = "viewport" content="width=device-width, initial-scale=1, maximum-scale = 1.0, user-scalable = 0" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="app-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="apple-touch-fullscreen" content="yes" />

        <title version="v1.09" > 文章編輯器 </title>
        
        <link href="css/all.css" rel="stylesheet">
        
           <link rel="stylesheet" href="../template/assets/css/font-awesome.css" />
        <link rel="stylesheet" href="../template/assets/css/jquery-ui.css" />
        <link rel="stylesheet" href="../template/assets/css/ace-fonts.css" />
        <style>
            .navbar {
                margin: 0;
                padding-left: 0;
                padding-right: 0;
                border-width: 0;
                border-radius: 0;
                -webkit-box-shadow: none;
                box-shadow: none;
                min-height: 45px;
                background: #438eb9;
            }
            @media only screen and (min-width: 992px) {
              .navbar-container {
                padding-left: 10px;
                padding-right: 10px;
              }
            }
            @media only screen and (min-width: 768px) and (max-width: 991px) {
              .navbar.navbar-collapse .navbar-container {
                background-color: #438eb9;
              }
            }
.ace-nav {
  height: auto;
  margin: 0 !important;
}

.ace-nav > li:first-child {
  border-left-width: 0;
}
.ace-nav > li {
  line-height: 45px;
  height: 45px;
  border-left: 1px solid #E1E1E1;
  padding: 0;
  position: relative;
  float: left;
}
.ace-nav > li > b {
  color: #FFF;
  display: block;
  line-height: inherit;
  text-align: center;
  height: 100%;
  width: auto;
  min-width: 50px;
  padding: 0 8px;
  position: relative;
  cursor: pointer;
  margin-top: 1px;
}
.bg_center {
    background-position: 50% 0%;
    background-size: cover;
    /*position: absolute;*/
    height: 100%;
    width: 100%;
}
.ace-icon {
  text-align: center;
}
.nav-search {
  /*position: absolute;*/
  /*right: 22px;*/
  line-height: 24px;
  margin: 8px 8px 4px 6px;
}
.nav-search .form-search {
  margin-bottom: 0;
}
.input-icon {
  position: relative;
}
span.input-icon {
  display: inline-block;
}
.nav-search .nav-search-input {
  /*border: 1px solid #6fb3e0; bohan0531--*/
  width: 380px; /* AL edit 0428*/
  height: 28px !important;
  padding-top: 2px;
  padding-bottom: 2px;
  border-radius: 5px !important;/* AL edit 0428*/
  font-size: 13px;
  line-height: 1.3;
  color: #666666 !important;
  z-index: 11;
  -webkit-transition: width ease .15s;
  -o-transition: width ease .15s;
  transition: width ease .15s;
}
.input-icon > input {
  padding-left: 24px;
  padding-right: 6px;
}
textarea,
input[type="text"],
input[type="password"],
input[type="datetime"],
input[type="datetime-local"],
input[type="date"],
input[type="month"],
input[type="time"],
input[type="week"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="search"],
input[type="tel"],
input[type="color"] {
  border-radius: 0 !important;
  color: #858585;
  background-color: #ffffff;
  border: 1px solid #d5d5d5;
  padding: 5px 4px 6px;
  font-size: 14px;
  /*font-family: inherit; bohan*/
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  -webkit-transition-duration: 0.1s;
  transition-duration: 0.1s;
}
input::-moz-placeholder,
.form-control::-moz-placeholder {
  color: #c0c0c0;
  opacity: 1;
}
.input-icon > .ace-icon {
  padding: 0 3px;
  z-index: 2;
  position: absolute;
  top: 1px;
  bottom: 1px;
  left: 3px;
  line-height: 30px;
  display: inline-block;
  color: #909090;
  font-size: 16px;
}
.main-content-inner {
  float: left;
  width: 100%;
}
.page-content {
  background-color: #ffffff;
  position: relative;
  margin: 0;
  padding: 0 0 0px;/* 0 0 24px; AL 0409*/ /* jack 0415 */
}
.ui-tabs .ui-tabs-nav {
  padding: 0;/*AL 0409*/
}
.ui-tabs .ui-tabs-nav li.ui-tabs-active > a {
  -moz-border-bottom-colors: none;/*AL 0409*/
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #fff;
  border-bottom: 4px solid #4c8fbd;
  border-top:0px;
  border-left:0px;
  border-right:0px;
  color: #4c8fbd;
  position: relative;
  top: 2px;/*AL 0409*/
}
.ui-tabs .ui-tabs-nav li.ui-state-default > a {
  background-color: #F9F9F9;/*AL 0409*/
  border-bottom-width: 0;
  /*color: #999; bohan 0422*/
  font-size: 18px;/*bohan 0531*/
  color: #555;
  line-height: 18px;
  margin-right: -1px;
  z-index: 11;
  padding: 8px 12px;
  position: relative;
  top: 2px;
}


.menu-icon {
    margin: 12px 25px !important; 
}
.status_login {
    padding : 0px;
}
body {
    font-family: "Helvetica Neue",Helvetica,Arial,"微軟正黑體",sans-serif !important;
}
.nav-search-icon {
    font-size: 15pt !important;
    top: -1px !important;
}
        </style>
        
        <script type="text/javascript" src="js/kernel/jquery-2.0.0.min.js"></script>
        <script type="text/javascript" src="js/fb-login.js"></script>
       
        <script type="text/javascript" src="js/use/app.js"></script>
        <script type="text/javascript" src="js/view_shelldata.js"></script>
        <script type="text/javascript" src="js/all_s.js"></script>
        <script type="text/javascript" src="js/ajaxq.js"></script>
        <script type="text/javascript" src="js/jquery.htmlClean.js"></script>
        <script type="text/javascript" src="js/all_ypcloud_layer_fliper.js"></script>
        <script type="text/javascript" src="js/view_tabs.js"></script>
        <script type="text/javascript" src="js/view_create_app.js"></script>
        <script type="text/javascript" src="js/use/process_media_youtube.js"></script>
        <script type="text/javascript" src="js/use/process_iframe.js"></script>
        <script type="text/javascript" src="js/view_sidebar.jack.js"></script>
        <script src="js/codemirror.js" charset="utf-8"></script>
        <script language="JavaScript">

        function DynamicFunction()
        {
                    // jPWSCDS.DIR('\\jbox\\Media\\TPEHOC\\Daily\\', 'any', '10', '1', myFunc );

                    console.log( $( '#DyFunction' ).val() + "(" + $( '#DyParams' ).val() + " myFunc );" );
                    eval( $( '#DyFunction' ).val() + "(" + $( '#DyParams' ).val() + " myFunc );" );
        }
        
        /* a bin ++ 2014.0424.1200  delete function */   
		
        function  Discovery()
        {

                    var jsonData = eval( '[' + $( "#TextOut" ).html() + ']' )[0].Record ;
                    
                    var tmp_key = Object.keys( jsonData[0] );
                    var tmp_html = "" ;
                    $.each( tmp_key , function(index, value) {
                                tmp_html += '<option value="' + value + '" >' + value + '</option>'
                    });
                    
                    
                    $( "#datasource_pie_id" ).html( "test1" );
                    $( "#datasource_pie_ds" ).html( "\\jack\\Media\\a.mp4\\" );
                    
                    $( "#datasource_pie_name" ).html( tmp_html );
                    $( "#datasource_pie_value" ).html( tmp_html );
                    
        }
        
        function  DS_view()
        {
                    $( "#datasource_el" ).highcharts().series[0].setData( 
                                [
                                            ['Chrome',   12.8],
                                            ['Safari',    8.5],
                                            ['Opera',     6.2],
                                            ['Others',    0.7]
                                ]
                    );
        }
        
        function loadjscssfile( filename, filetype )
        {
                    if (filetype=="js"){ //if filename is a external JavaScript file
                                var fileref=document.createElement('script');
                                fileref.setAttribute("type","text/javascript");
                                fileref.setAttribute("src", filename);
                    }
                    else if (filetype=="css"){ //if filename is an external CSS file
                                var fileref=document.createElement("link");
                                fileref.setAttribute("rel", "stylesheet");
                                fileref.setAttribute("type", "text/css");
                                fileref.setAttribute("href", filename);
                    }
                    if (typeof fileref!="undefined")
                                document.getElementsByTagName("head")[0].appendChild(fileref);
        }

        function removejscssfile(filename, filetype)
        {
                    var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none" //determine element type to create nodelist from
                    var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none" //determine corresponding attribute to test for
                    var allsuspects=document.getElementsByTagName(targetelement)
                    for (var i=allsuspects.length; i>=0; i--)
                    {
                                //search backwards within nodelist for matching elements to remove
                                if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1)
                                 allsuspects[i].parentNode.removeChild(allsuspects[i]) //remove element by calling parentNode.removeChild()
                    }
        }

        </script>	

        <script type="text/javascript" src="js/scripts.js"></script>
        
        <script type="text/javascript" >
                    function validate(evt) {
                                var theEvent = evt || window.event;
                                var key = theEvent.keyCode || theEvent.which;
                                key = String.fromCharCode( key );
                                var regex = /[0-9]|\./;
                                if( !regex.test(key) ) {
                                            theEvent.returnValue = false;
                                            if(theEvent.preventDefault) theEvent.preventDefault();
                                }
                    }
        </script>
        
        <script type="text/javascript">
                     //v9.0
                    function FontSizeChange( objId , x , theProp , theValue ) 
                    {
                                var obj = null; 
                                with (document)
                                {
                                            if ( getElementById )
                                            obj = getElementById(objId); 
                                }
                                if (obj)
                                {
                                            if (theValue == true || theValue == false)
                                                        eval("obj.style." + theProp + "=" + theValue);
                                            else 
                                                        eval("obj.style." + theProp + "='" + theValue + "'");
                                }
                    }
        </script>
        
        
        <script type="text/javascript">
                    var userLang = navigator.language || navigator.userLanguage; 
                    console.log( userLang );
        </script>
        
        <script type="text/javascript" src="../js/view_upload_img.js"></script>
        
        <script type="text/javascript">
                jQuery(function($) {

                        //jquery tabs
                        if( $( "#tabs" ).length )
                        $( "#tabs" ).tabs().show();

                });
        </script>
        
        <script type="text/javascript" src="js/document_ready.js"></script>
        <script type="text/javascript" src="forttshow/js/ttshow_document_ready.js"></script>
        <script type="text/javascript" src="../js/fb-login.js"></script>
</head>

<body style="min-height: 660px; cursor: auto;" class="edit">

        <?php include( "../header.php"); ?>
        
        <div style="position: fixed; width: 100%; left: 0px; padding: 0px 120px; z-index: 1000; top: 87px; background: white none repeat scroll 0% 0%; height: 45px;">
                <?php include( "../cooperate_tab.php"); ?>
        </div>
    
        <div class="clearfix"></div>

        <div id="main_view_small_img" src="" class="" style="height: 30px; position: absolute; top: 5px; left: 1%; opacity: 0.5; display: block; z-index: 10; width: 98%; display: none;"></div>
    
        <div class="container-full col-xs-9 col-sm-9 col-md-9 col-lg-9" style="display: none; padding: 15px; float: left; position: relative; top: 95px;" >
                <div class="row"><!-- jack -->
                        <div class="tool">

                                    <div class="sidebar-nav" layer_id="1" layer_html="layout" style="left:0; top: 135px;" >
                                                <ul class="nav nav-list accordion-group">
                                                            <li class="nav-header">
                                                                        <div class="row" style="">
                                                                                    <!--div class="col-xs-1 col-md-1"><h3 class="icon-prev"></h3></div-->
                                                                                    <div class="col-xs-8 col-md-8"><h3 class="text-center" style="font-size: 20px; line-height: 20px;" changelanguage="1" ><b>版面元件</b></h3></div>
                                                                                    <!--div class="col-xs-1 col-md-1"><h3 class="icon-next"></h3></div-->
                                                                        </div>
                                                            </li>
                                                </ul>
                    <!-------------------------------------------------------------------------------------------------------------------->
                    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!---- Layout ---------------------------------------------------------------------------------------------------------------------------------------------->
                    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------->


                            <ul class="nav nav-list accordion-group">
                                        <li class="nav-header">
                                          <i class="glyphicon glyphglyphicon glyphicon-th"></i>
                                          <b changelanguage="1" >區塊</b>
                                        </li>
                                        <li style="display: none;" class="rows" id="estRows">
                                                    <div class="lyrow ui-draggable">
                                                        <a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>
                                                        <span class="drag label label-default" style="margin-right: -10px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i> </span>
                                                        <span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>
                                                        <div class="preview"><input type="text" value="12" class="form-control"></div>
                                                        <div class="view">
                                                            <div class="row-fluid clearfix">
                                                                <div class="col-md-12 column"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="lyrow ui-draggable">
                                                        <a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>
                                                        <span class="drag label label-default" style="margin-right: -10px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i> </span>
                                                        <span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>
                                                        <div class="preview"><input type="text" value="6 6" class="form-control"></div>
                                                        <div class="view">
                                                            <div class="row-fluid clearfix">
                                                                <div class="col-md-6 col-sm-6 column"></div>
                                                                <div class="col-md-6 col-sm-6 column"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--div class="lyrow ui-draggable">
                                                        <a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>
                                                        <span class="drag label label-default" style="margin-right: -10px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i> </span>
                                                        <span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>
                                                        <div class="preview"><input type="text" value="8 4" class="form-control"></div>
                                                        <div class="view">
                                                            <div class="row-fluid clearfix">
                                                                <div class="col-md-8 col-sm-8 column"></div>
                                                                <div class="col-md-4 col-sm-4 column"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="lyrow ui-draggable">
                                                                <a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>
                                                                <span class="drag label label-default" style="margin-right: -10px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i> </span>
                                                                <span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>
                                                                <div class="preview"><input type="text" value="4 4 4" class="form-control"></div>
                                                                <div class="view">
                                                                            <div class="row-fluid clearfix">
                                                                                        <div class="col-md-4 col-sm-4 column"></div>
                                                                                        <div class="col-md-4 col-sm-4 column"></div>
                                                                                        <div class="col-md-4 col-sm-4 column"></div>
                                                                            </div>
                                                                </div>
                                                    </div>

                                                    <div class="lyrow ui-draggable">
                                                                <a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>
                                                                <span class="drag label label-default" style="margin-right: -10px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i> </span>
                                                                <span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>
                                                                <div class="preview"><input type="text" value="3 3 3 3" class="form-control"></div>
                                                                <div class="view">
                                                                            <div class="row-fluid clearfix">
                                                                                        <div class="col-md-3 col-sm-3 column"></div>
                                                                                        <div class="col-md-3 col-sm-3 column"></div>
                                                                                        <div class="col-md-3 col-sm-3 column"></div>
                                                                                        <div class="col-md-3 col-sm-3 column"></div>
                                                                            </div>
                                                                </div>
                                                    </div>

                                                    <div class="lyrow ui-draggable">
                                                        <a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>
                                                        <span class="drag label label-default" style="margin-right: -10px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i></span>
                                                        <span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>
                                                        <div class="preview"><input type="text" value="2 6 4" class="form-control"></div>
                                                        <div class="view">
                                                            <div class="row-fluid clearfix">
                                                                            <div class="col-md-2 col-sm-2 column"></div>
                                                                            <div class="col-md-6 col-sm-6 column"></div>
                                                                            <div class="col-md-4 col-sm-4 column"></div>
                                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="lyrow ui-draggable">
                                                        <a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>
                                                        <span class="drag label label-default" style="margin-right: -10px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i> </span>
                                                        <span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>
                                                        <div class="preview"><input type="text" value="3 9" class="form-control"></div>
                                                        <div class="view">
                                                            <div class="row-fluid clearfix">
                                                                <div class="col-md-3 col-sm-3 column"></div>
                                                                <div class="col-md-9 col-sm-9 column"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="lyrow ui-draggable">
                                                        <a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>
                                                        <span class="drag label label-default" style="margin-right: -10px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i> </span>
                                                        <span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>
                                                        <div class="preview"><input type="text" value="9 3" class="form-control"></div>
                                                        <div class="view">
                                                            <div class="row-fluid clearfix">
                                                                <div class="col-md-9 col-sm-9 column"></div>
                                                                <div class="col-md-3 col-sm-3 column"></div>
                                                            </div>
                                                        </div>
                                                    </div-->


                                        </li>
                            </ul>


                                    </div>

                                    <!--div class="sidebar-nav" layer_id="2" layer_html="widget"       style="left:0;" ></div>
                                    <div class="sidebar-nav" layer_id="3" layer_html="form"         style="left:0;" ></div>
                                    <div class="sidebar-nav" layer_id="4" layer_html="iot"          style="left:0;" ></div>
                                    <div class="sidebar-nav" layer_id="5" layer_html="dashboard"    style="left:0;" ></div>
                                    <div class="sidebar-nav" layer_id="6" layer_html="control"      style="left:0;" ></div-->
                        </div>

                        <div id="main_container" class="demo ui-sortable" style="width: 100%;" >
                                    <div class="lyrow ui-draggable" style="display: block;"> 
                                                    <a class="remove label label-danger" href="#close"><i class="glyphicon glyphicon-remove "></i></a> <span class="drag label label-default"><i class="glyphicon glyphicon-hand-right"></i></span>
                                                    <div class="preview">
                                                                <input type="text" value="12">
                                                    </div>
                                                    <div class="view">
                                                                <div class="row clearfix">
                                                                                <div class="col-md12 column ui-sortable">

                                                                                </div>
                                                                </div>
                                                    </div>
                                    </div>
                                    <div class="lyrow ui-draggable" style="display: block;"> <a class="remove label label-danger" href="#close"><i class="glyphicon glyphicon-remove "></i></a> <span class="drag label label-default"><i class="glyphicon glyphicon-hand-right"></i></span>
        <div class="preview">
          <input type="text" value="4 4 4">
        </div>
        <div class="view">
          <div class="row clearfix">
            <div class="col-md4 column ui-sortable"></div>
            <div class="col-md4 column ui-sortable"></div>
            <div class="col-md4 column ui-sortable"></div>
          </div>
        </div>
                                    </div>
                        </div>

                        <div id="download-layout">
                                      <!--div class="container-fluid"></div-->
                                      <div class="container-full"></div>
                                      <!--div class="container"></div-->
                        </div>
                </div>
        </div>
    
    
    
    
    
    
        <div style="padding-right: 35px; top: 125px;" class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div style="border-bottom: 1px solid rgb(229, 229, 229);" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <!--div style="margin-bottom: 7%;" class="col-xs-12">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 class="widget-title" style="font-weight: bold;">發表</h4>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div style="position: relative">
                                            <div style="text-align: left; float: left;">
                                                <i class="ace-icon fa fa-key"></i>
                                                <a href="#">狀態：</a>
                                            </div>
                                            <div style="text-align: left; float: left;">
                                                草稿
                                                <a href="#">編輯</a>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div style="position: relative">
                                            <div style="text-align: left; float: left;">
                                                <i class="ace-icon fa fa-eye"></i>
                                                <a href="#">可見度：</a>
                                            </div>
                                            <div style="text-align: left; float: left;">
                                                上架
                                                <a href="#">編輯</a>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div style="position: relative">
                                            <div style="text-align: left; float: left;">
                                                <i class="ace-icon fa fa-gift"></i>
                                                <a href="#">立刻發表：</a>
                                            </div>
                                            <div style="text-align: left; float: left;">
                                                <a href="#">編輯</a>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                    </div>
                                </div>
                            </div>
                    </div-->

                    <!--div class="col-xs-12" style="text-align: right; margin-bottom: 7%;">
                            <button class="btn btn-sm">預覽</button>
                            <button class="btn btn-sm btn-primary">儲存為草稿</button>
                    </div-->

                    <div class="col-xs-12" style=" margin-bottom: 7%;">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 style="font-weight: bold;" class="widget-title">新增文章</h4>


                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div>
                                            <input type="text" class="form-control" id="Inputiframe" value="" data-input="EVENT_Click" style="width:100%; " placeholder="請輸入標題">
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="col-xs-12" style=" margin-bottom: 7%;">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 style="font-weight: bold;" class="widget-title">選擇頻道</h4>                                                                    
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div>
                                            <select class="form-control" id="form-field-select-1">
                                                <option value="台灣達人秀">台灣達人秀</option>
                                                <option value="台灣達人秀">台灣達人秀</option>
                                                <option value="台灣達人秀">台灣達人秀</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>

                    <div style=" margin-bottom: 7%;" class="col-xs-12">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 class="widget-title" style="font-weight: bold;">分類</h4>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div>
                                            <select multiple="multiple" id="form-field-select-2" class="form-control">
                                                    <option value="惡搞有趣">惡搞有趣</option>
                                                    <option value="星座運勢">星座運勢</option>
                                                    <option value="即時焦點">即時焦點</option>
                                                    <option value="生活新知">生活新知</option>
                                                    <option value="情感">情感</option>
                                                    <option value="未分類">未分類</option>
                                                    <option value="精選網稿">精選網稿</option>
                                                    <option value="短文選集">短文選集</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="col-xs-12" style=" margin-bottom: 7%;">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 style="font-weight: bold;" class="widget-title">新增標籤</h4>


                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div>
                                            <input type="text" placeholder="請輸入標籤名稱" style="width: 80%; float: left;" data-input="EVENT_Click" value="" id="Inputiframe" class="form-control">
                                            <button class="btn btn-sm" style="float: left; margin-left: 5px; margin-top: 2px; border: 1px solid gray;">新增</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>

                    <div style=" margin-bottom: 7%;" class="col-xs-12">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 class="widget-title" style="font-weight: bold;">封面圖片</h4>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                            <div class="form-group">
                                                    <input id="transient_file" type="file" multiple="" target="upload_now" style="visibility: hidden;">
                                                    <div id="upload_cover_img" class="col-xs-12" style="height: 200px; width: 310px; border: 1px dashed black; padding: 0px;">
                                                            <div id="preinstall">
                                                                <img style="position: absolute; margin: auto; left: 0px; right: 0px; top: 0px; bottom: 40px;" src="template/assets/img/uplaod-01.png" alt="ttshow">
                                                                <div style="position: absolute; margin: auto; left: 0px; right: 0px; bottom: 40px; font-size: 12pt; width: 40px; height: 15px; top: 75px; text-align: center;">上傳</div>
                                                            </div>
                                                            <div id="upload_now" style="width: 100%; height: 100%; position: absolute; top: 0px; background-position: 50% 50%; background-size: cover;" img="">
                                                            </div>
                                                    </div>
                                            </div>
                                            <label style="margin-top: 2%; width: 100%;"><a href="#" style="">移除封面圖片</a></label>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="col-xs-12" style="text-align: right; margin-bottom: 7%;">
                            <button class="btn btn-sm btn-primary">發布文章</button>
                    </div>
            </div>
        </div>
    
    
    
    
    
    
    
    
<!--/.fluid-container--> 
<div class="modal fade" role="dialog" id="editorModal">
    <div class="modal-dialog modal-lg">
                <div class="modal-content">
                            <div class="modal-header">
                                        <a class="close" data-dismiss="modal">×</a>
                                        <h3>Edit</h3>
                                        <!--ul id="ChangeBox" class="nav nav-pills">
                                            <li class="active" val="HTML"><a href="#">HTML</a></li>
                                            <li val="CSS"><a href="#">CSS</a></li>
                                            <li val="JS"><a href="#">JS</a></li>
                                        </ul-->
                                        <script>
                                        /*
                                            $("#ChangeBox").children("li").unbind('click').bind( 'click' , function(e) {
                                                        $("#ChangeBox li").removeClass("active");
                                                        $(this).addClass("active");
                                                        if( $(this).attr("val") === "HTML"){
                                                                    $("#CssModal").hide();
                                                                    $("#JSModal").hide();
                                                                    $("#HtmlModal").show();
                                                        }
                                                        else if( $(this).attr("val") === "CSS"){
                                                                    $("#HtmlModal").hide();
                                                                    $("#JSModal").hide();
                                                                    $("#CssModal").show();
                                                        }
                                                        else if( $(this).attr("val") === "JS"){
                                                                    
                                                                    $.ajax({
                                                                                 type    : "POST",  
                                                                                 url     : "jsk/Upload2ClooudCmd.JSK?func=GetAppJS", 
                                                                                 data    : 
                                                                                 {
                                                                                             projectname : 'builder/' + $.focus_projectname                                         }, 
                                                                                 success: function(data) {
                                                                                             console.log(data);
                                                                                             $( "#JSModal textarea" ).val( data );
                                                                                 }
                                                                     });
                                                                    
                                                                    $("#HtmlModal").hide();
                                                                    $("#CssModal").hide();
                                                                    $("#JSModal").show();
                                                        }
                                            });
                                            */
                                        </script>
                            </div>
                            <div class="modal-body">
                                        <!--div id="JSModal">
                                            <textarea id="" name="area" style="height: 400px;"></textarea>
                                        </div-->
                                        <div id="HtmlModal">
                                                    <textarea id="elm1" name="area"></textarea>
                                        </div>
                                        <div id="CssModal" style="display: none;">
                                           <div class="container" style="width:100%">
                                                    <div class="row">
                                                            <div class="span12">
                                                                    <!--textarea id="raw" rows="22" autofocus="autofocus" spellcheck="false" onChange='$.View.CssBeautifier().format()' onKeyDown='$.View.CssBeautifier().format()'></textarea-->
                                                            </div>
                                                    </div>
                                            </div>

                                            <!-- Le Options -->
                                            <div class="fw-options">
                                                        <div class="container">
                                                                    <div class="row-fluid clearfix">
                                                                                <div class="col-md-1 ui-sortable"></div>
                                                                                <div class="col-md-3 ui-sortable">
                                                                                            <div class="row">
                                                                                                        <div class="span3">
                                                                                                                    <h3>Indent Options:</h3>
                                                                                                        </div>
                                                                                                        <div class="span3">
                                                                                                                    <label><input checked type="radio" name="indent" id="fourspaces" value="fourspaces" onChange='$.View.CssBeautifier().format()'>4 spaces</label>
                                                                                                        </div>
                                                                                                        <div class="span3">
                                                                                                                    <label><input type="radio" name="indent" id="twospaces" value="twospaces" onChange='$.View.CssBeautifier().format()'>2 spaces</label>
                                                                                                        </div>
                                                                                                        <div class="span3">
                                                                                                                    <label><input type="radio" name="indent" id="tab" value="tab" onChange='$.View.CssBeautifier().format()'>tab</label>
                                                                                                        </div>
                                                                                            </div>
                                                                                </div>
                                                                                <div class="col-md-8 ui-sortable">
                                                                                            <div class="row">
                                                                                                        <div class="span3">
                                                                                                                    <h3>Curly Brace Options:</h3>
                                                                                                        </div>
                                                                                                        <div class="span3">
                                                                                                                    <label><input checked type="radio" name="openbrace" id="openbrace-end-of-line" onChange='$.View.CssBeautifier().format()'>end of line</label>
                                                                                                        </div>
                                                                                                        <div class="span3">
                                                                                                                    <label><input type="radio" name="openbrace" id="openbrace-separate-line" onChange='$.View.CssBeautifier().format()'>separate line</label>
                                                                                                        </div>
                                                                                                        <div class="span3">
                                                                                                                    <label><input checked type="checkbox" name="autosemicolon" id="autosemicolon" onChange='$.View.CssBeautifier().format()'>Automatic semicolon</label>
                                                                                                        </div>
                                                                                            </div>
                                                                                </div>
                                                                  </div>

                                                        </div>
                                            </div>

                                            <!-- Le Beautified Input -->
                                            <div class="container" style="width:100%">
                                                        <div class="row">
                                                                    <div class="span12">
                                                                                <h2>Your <strong>Beautified</strong> CSS</h2>
                                                                    </div>
                                                        </div>
                                                        <div class="row">
                                                                    <div class="span12" id="beautifiedlocation">
                                                                                <textarea id="beautified" name="beautified" rows="22" readonly></textarea>
                                                                    </div>
                                                        </div>
                                            </div>
                                        </div>
                            </div>
                            <div class="modal-footer">
                                        <a id="savecontent" class="btn btn-info" data-dismiss="modal">Save</a> <a class="btn btn-default" data-dismiss="modal">Close</a> 
                            </div>
                </div>
    </div>            
</div>

<div class="modal fade" role="dialog" id="publishModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
              <h3>Publish</h3>
            </div>
            <div class="modal-body">
                        <div class="row">
                                    <div class="col-md-1 col-xs-1"></div>
                                    <div class="col-md-5 col-xs-5" style='background-image: url("img/bg.jpg"); background-size: 100% auto; background-repeat: no-repeat; height: 1000px; background-position: 50% 25%;'>
                                                <div class="" style="float: left; width: 220px; height: 250px; word-wrap: break-word; margin-left: 0px;">

                                                            <div id="shareModal_qrcode" class="text-center"></div>
                                                            <h3 id="shareModal_title" class="text-center">tt</h3>

                                                            <!--h3 class="text-center" > URL </h3-->
                                                            <div id="shareModal_url" class="text-center"><a target="_blank" href="#"> http://myapps.ypcloud.com/886933516336/tt/index.html </a></div>
                                                </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                                <div class="row-fluid">
                                                            <div style="display: block;" div-target="MMS" hassortable="true" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <form role="form" class="form-horizontal">
                                                                                    <div class="form-group">
                                                                                                <label style="font-size: 12pt;font-weight : normal;" class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label control-label"><h3 class="text-center" id="shareModal_title" style="display: block;">Mail</h3></label>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                                <label style="font-size: 12pt;font-weight : normal;" class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label control-label">&nbsp;&nbsp;&nbsp;&nbsp;Target: </label>
                                                                                                <div class="col-lg-6 col-md-9 col-sm-8 col-xs-10">
                                                                                                            <input type="text" data-input="to" style="height: 30px;" class="form-control" placeholder="email address" name="textinput">
                                                                                                </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                                <label style="font-size: 12pt;font-weight : normal;" class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label control-label">&nbsp;&nbsp;&nbsp;&nbsp;Subject: </label>
                                                                                                <div class="col-lg-6 col-md-9 col-sm-8 col-xs-10">
                                                                                                            <input type="text" data-input="sub" style="height: 30px;" class="form-control" placeholder="" name="textinput">
                                                                                                </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                                <label style="font-size: 12pt;font-weight : normal;" for="inputPassword" class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label control-label">&nbsp;&nbsp;&nbsp;&nbsp;Message:</label>
                                                                                                <div class="col-lg-6 col-md-9 col-sm-8 col-xs-10">
                                                                                                            <textarea placeholder="http://myapps.ypcloud.com/886xxxxxxxx/mm.image.slider.4/index.html " data-input="body" style="resize: none;" class="form-control" rows="4"></textarea>
                                                                                                </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                                <label style="font-size: 12pt;" for="inputPassword" class="col-lg-6 col-md-3 col-sm-4 col-xs-2 control-label control-label"></label>
                                                                                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-10">
                                                                                                            <p class="pull-right">
                                                                                                                        <button data-target="reset" class="btn btn-info  " type="button">Reset</button>
                                                                                                                        <button data-target="submit" class="btn btn-info" type="button" data-loading-text="Send ..." >Submit</button>
                                                                                                            </p>
                                                                                                </div>
                                                                                    </div>
                                                                        </form>
                                                            </div>
                                                </div>

                                    </div>
                        </div>
                        <div class="row">
                                    <br>
                        </div>
            </div>
            <!--div class="modal-footer"> <a class="btn btn-default" data-dismiss="modal">Close</a> </div-->
</div>

<div class="modal fade" role="dialog" id="shareModal">
        <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
          <h3>Save</h3>
        </div>
        <div class="modal-body">
            
                                <div class="row">
<div class="" >
            <h3 class="text-center" > QRCode </h3>
            <!--div id="shareModal_qrcode"></div-->
</div>
<div class="" >

            <h3 class="text-center" > URL </h3>
            <!--div id="shareModal_url"></div-->
            
</div>
                                </div>
                                
        </div>
        <div class="modal-footer"> <a class="btn btn-default" data-dismiss="modal">Close</a> </div>
</div>
        </div>
    </div>      

<!-- Modal -->
<div class="modal fade" id="myModalaaa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <!-- a bin 2014.5.28 edit -->
            <div class="modal-dialog modal-lg">
            <!-- a bin 2014.5.28 edit -->
                        <div class="modal-content">
                                    <!--
                                    <div class="modal-header" style="height: 50px;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2 class="text-center" > DataSource </h2>
                                    </div>
                                    -->
                                    <!--div style="height: 50px;" class="modal-header">
    <div class="pull-right">
                                    <div class="btn-group"><button type="button" class="btn btn-info pull-right" data-dismiss="modal" data-target="#SaveChanges">Save changes</button></div>
                                    <div class="btn-group"><button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button></div>
                            </div>
    <h2 class="text-center"> DataSource </h2>
                                    </div-->

                                    <!--div class="modal-body" style="overflow: hidden; height: 600px;"-->
                                    <div class="modal-body" >
                                    </div>
                                    <!--
                                    <div class="modal-footer">

    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-info" data-dismiss="modal" data-target="#SaveChanges">Save changes</button>
                                    </div>
                                    -->
                                    <div class="modal-footer">
                                                <button onclick="location.href='http://myapps.ypcloud.com/886930854708/mms/index.html'" data-target="save" class="btn btn-info btn-default" type="button">Save</button>
                                    </div>
                        </div>
            </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModalProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                    <div class="modal-header" style="height: 50px;" >
                                        
                                                <h4 class="modal-title" > App Profile <anagement</h4>
                                                
                                    </div>

                                    <div class="modal-body" >
                                                <div class="row">

                                                            <div class="col-md-4" style="" >
                                                                        <h3 class="text-center" >ICON</h3>
                                                                        <br>
                                                                        <div class="btn-group pull-right">
                                                                                    <button class="btn btn-info" edit="true" type="button" id="myModalProjectDeleteIcon" ><i class=" glyphicon glyphicon-upload"></i><!-- Edit --></button>
                                                                        </div>
                                                                        <br>
                                                                        <br>
                                                                                    <div id="dragandrophandler_icon" style="display: none;">Drag &amp; Drop Files Here<input type="file" style="visibility: hidden;" multiple="multiple"></div>

                                                                                    <img id="myModalProjectIcon" style="width: 100%; height: auto;" src="">
                                                                        <br>
                                                                        <br>
                                                                        <br>

                                                            </div>
                                                            <div class="col-md-8">
                                                                        <div class="row">

                                                                                    <div class="col-md-1"></div>
                                                                                    <div class="col-md-10">
                                                                                                <h3 class="text-center" >HTML META</h3>
                                                                                                <p>
                                                                                                            <label for="to_putmsg"><h4>Project Name</h4></label>
                                                                                                            <input id="myModalProjectTitle" type="text" style="width: 100%;">
                                                                                                </p>
                                                                                                <p>
                                                                                                            <label for="app_putmsg"><h4>Charset</h4></label>
                                                                                                            
                                                                                                            <div id="myModalProjectCharsetID" >

                                                                                                            <div class="col-md-2">
                                                                                                            <label class="radio">
                                                                                                                        <input type="radio" name="myModalProjectCharset" value="none" checked="checked">
                                                                                                                        none
                                                                                                            </label>
                                                                                                                                            </div>   
                                                                                                                                            <div class="col-md-2">
                                                                                                            <label class="radio">
                                                                                                                        <input type="radio" name="myModalProjectCharset" value="utf-8" checked="checked">
                                                                                                                        UTF-8
                                                                                                            </label>
                                                                                                                                            </div>   
                                                                                                                                            <div class="col-md-2">
                                                                                                            <label class="radio">
                                                                                                                        <input type="radio" name="myModalProjectCharset" value="big5" checked="checked">
                                                                                                                        Big5
                                                                                                            </label>
                                                                                                                                            </div>   
                                                                                                                                            <div class="col-md-2">
                                                                                                            <label class="radio">
                                                                                                                        <input type="radio" name="myModalProjectCharset" value="euc-jp" checked="checked">
                                                                                                                        EUC-JP
                                                                                                            </label>
                                                                                                                                            </div>   
                                                                                                                                            <div class="col-md-2">
                                                                                                            <label class="radio">
                                                                                                                        <input type="radio" name="myModalProjectCharset" value="euc-kr" checked="checked">
                                                                                                                        EUC-KR
                                                                                                            </label>
                                                                                                                                            </div>   
                                                                                                                                            <div class="col-md-2">
                                                                                                            <label class="radio">
                                                                                                                        <input type="radio" name="myModalProjectCharset" value="iso-8859-1" checked="checked">
                                                                                                                        ISO-8859-1
                                                                                                            </label>

                                                                                                            </div>   

                                                                                                            </div>   

                                                                                                </p>
                                                                                                <br>
                                                                                                <br>
                                                                                                <p>
                                                                                                            <label for="cmd_putmsg"><h4>Keywords</h4></label>
                                                                                                            <input id="myModalProjectKeywords" type="text" style="width: 100%;">
                                                                                                </p>


                                                                                    </div>
                                                                                    <div class="col-md-1"></div>
                                                                        </div>
                                                            </div>
                                                </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                                <div class="btn-group"><button type="button" class="btn btn-info pull-right" data-dismiss="modal" data-target="#SaveChanges">Save</button></div>
                                                <div class="btn-group"><button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button></div>
                                                            
                                    </div>
                        </div>
            </div>
</div>


    



<!-- Modal -->
<div class="modal fade" id="myModalforTemplate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lgg">
                        <div class="modal-content">
                                    <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel"> MyTemplate <anagement</h4>
    
                                    </div>
                                    <div class="modal-body" >
                                        
                                                <div class="row">
                                                            <div id="MyTemplateLeftSide">


                                                                        <div id="MyTemplate_Page_1" class="step" style="display: block;" style="width: 102%;">

                                                                                    <!--div class="borderTriangle">&nbsp;</div>
                                                                                    <div class="triangle">&nbsp;</div-->
                                                                                    <ul class="divFloatContainer" id="MyTemplate_Page_1_Project">

                                                                                    </ul>

                                                                        </div>
                                                                        <div id="MyTemplate_Page_2" class="step" style="display: none;" style="width: 102%;">

                                                                                    <!--div class="borderTriangle">&nbsp;</div>
                                                                                    <div class="triangle">&nbsp;</div-->
                                                                                    <ul class="divFloatContainer" id="MyTemplate_Page_2_Project">

                                                                                    </ul>

                                                                        </div>
                                                            </div>     

                                                </div>
                                        
                                    </div>
                        </div>
            </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalupload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                    <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Dropme <anagement</h4>
                                                <!--div class="btn-group pull-right">
                                                            <span type="button" class="btn btn-info"   >Open Project</span>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div-->
    
                                    </div>
                                    <div class="modal-body" >
                                                <div class="row">
                                                            <div id="DropMeLeftSide">

                                                                <div id="DropMe_Page_1" class="step" style="display: block;" style="width: 102%;">

                                                                            <!--div class="borderTriangle">&nbsp;</div>
                                                                            <div class="triangle">&nbsp;</div-->
                                                                            <ul class="divFloatContainer" id="DropMe_Page_1_Project">

                                                                            </ul>

                                                                </div>
                                                                <div id="DropMe_Page_2" class="step" style="display: none;" style="width: 102%;">

                                                                            <!--div class="borderTriangle">&nbsp;</div>
                                                                            <div class="triangle">&nbsp;</div-->
                                                                            <ul class="divFloatContainer" id="DropMe_Page_2_Project">

                                                                            </ul>

                                                                </div>
                                                                <!--div id="DropMe_Page_3" class="step" style="display: none;" style="width: 102%;">
                                                                            <ul class="divFloatContainer" id="DropMe_Page_3_Project">
                                                                            </ul>
                                                                </div-->
                                                                <!--div id="DropMe_Page_4" class="step" style="display: none;" style="width: 102%;">

                                                                            <ul class="divFloatContainer" id="DropMe_Page_4_Project">
                                                                            </ul>
                                                                </div-->
                                                            </div>     

                                                </div>
                                        
                                    </div>
                                    <div class="modal-footer">

    <!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <span type="button" class="btn btn-info"   >Save changes</span-->

                                    </div>
                        </div>
            </div>
</div>

<!-- abin 2014.8.4.edit ++   add  support-->
<!-- Modal -->
<div aria-hidden="false" style="display: none;" class="modal fade in" role="dialog" id="SupportModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a data-dismiss="modal" class="close">×</a>
                <center>
                    <h3>Support</h3>
                </center>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div style="font-size: 12pt;" class="col-md-12 col-xs-12">
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Welcome to our APPBuilder Support site, where you will be able in our Opening time to have live chat with our engineers and after working our to leave a 
                             massage which we will answer according your selected package of support.
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-7" hassortable="true">
                        <br><br>
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label control-label" style="font-size: 12pt;font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;Account:</label>
                                    <div class="col-lg-6 col-md-7 col-sm-8 col-xs-6"><div class="control-label" style="font-size: 12pt; text-align: left;" div-target="account">886930854708</div></div>
                            </div>
                            <div class="form-group">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label control-label" style="font-size: 12pt;font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;Message:</label>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><textarea rows="6" class="form-control" style="resize: none;" data-input="body"></textarea></div>
                            </div>
                            <div class="form-group">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label control-label" style="font-size: 12pt;"></label>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-9">
                                            <p class="pull-right">
                                                <button type="button" class="btn btn-info" data-target="submit">Submit</button>
                                            </p>
                                        </div>
                            </div>
                        </form>
                    </div>
                    <div style="" class="col-md-4">
                                <h3 class="text-center">Support</h3>
                                <br>
                                <div class="btn-group pull-right">
                                            <button id="SupportDelete" type="button" edit="true" class="btn btn-info"><i class=" glyphicon glyphicon-upload"></i><!-- Edit --></button>
                                </div>
                                <br>
                                <br>
                                            <div style="" id="SupportDrag">Drag &amp; Drop Files Here<input type="file" style="visibility: hidden;" multiple="multiple"></div>

                                            <!--img id="SupportImg" src="http://myapps.ypcloud.com/886975870602/GGC/appprofile/main.png" style="display: none; width: 100%; height: auto; background-image: url(&quot;http://myapps.ypcloud.com/886975870602/GGC/appprofile/main.png&quot;);"-->
                                <br>
                                <br>
                                <br>
                    </div>    
                </div>
            </div>
            <!--div class="modal-footer"> <a class="btn btn-default" data-dismiss="modal">Close</a> </div-->
        </div>
    </div>
</div>

                                   
                                                
<!-- abin 2014.8.4.edit --  -->

<!-- Modal -->
<div class="modal fade" id="myModalbackground" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                    <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h3 class="modal-title" id="myModalLabel"> Background Setting <anagement</h3>
    
                                    </div>
                                    <div class="modal-body" >
                                        
                                    <div class="row">
                                                <div class="col-md-12">
                                                            <div class="row">
                                                                        <div class="col-md-12">
                                                                                    <label class="checkbox" style="margin-top: 6px;"> This </label>
                                                                        </div>
                                                            </div>
                                                            <div class="row">
                                                                        <div class="col-md-1 col-xs-1"></div>
                                                                        <div class="col-md-3 col-xs-3">
                                                                                    <label class="checkbox" style="margin-top: 6px;"> Background Height (自動偵測請打auto)</label>
                                                                        </div>
                                                                        <div class="col-md-7 col-xs-7">
                                                                                    <input class="form-control" id="backgroundHeight" type="text"  value="" data-input="EVENT_Click" style="width:100%; " >
                                                                        </div>
                                                                        <div class="col-md-1 col-xs-1"></div>
                                                            </div>
                                                            <div class="row">
                                                                        <div class="col-md-1 col-xs-1"></div>
                                                                        <div class="col-md-3 col-xs-3">
                                                                                    <label class="checkbox" style="margin-top: 6px;"> Background Width (自動偵測請打auto)</label>
                                                                        </div>
                                                                        <div class="col-md-7 col-xs-7">
                                                                                    <input class="form-control" id="backgroundWidth" type="text"  value="" data-input="EVENT_Click" style="width:100%; " >
                                                                        </div>
                                                                        <div class="col-md-1 col-xs-1"></div>
                                                            </div>
                                                            <div class="row">
                                                                        <div class="col-md-1 col-xs-1"></div>
                                                                        <div class="col-md-3 col-xs-3">
                                                                                    <label class="checkbox" style="margin-top: 6px;"> Background Image </label>
                                                                        </div>
                                                                        <div class="col-md-7 col-xs-7">
                                                                                    <input class="form-control" id="backgroundImagethis" type="text"  value="" data-input="EVENT_Click" style="width:100%; " >
                                                                        </div>
                                                                        <div class="col-md-1 col-xs-1">
                                                                        </div>
                                                            </div>
                                                            <div class="row">
                                                                        <div class="col-md-1 col-xs-1"></div>
                                                                        <div class="col-md-3 col-xs-3">
                                                                                    <label  style="margin-top: 6px;" class="checkbox"> Background Color </label>
                                                                        </div>
                                                                        <div class="col-md-7 col-xs-7">
                                                                                    <input class="form-control" id="backgroundColorthis" type="text" value="" data-input="EVENT_Click" style="width:100%; " >
                                                                        </div>
                                                                        <div class="col-md-1 col-xs-1">
                                                                        </div>
                                                            </div>
                                                            <div class="row">
                                                                        <div class="col-md-1 col-xs-1"></div>
                                                                        <div class="col-md-3 col-xs-3">
                                                                                    <label  style="margin-top: 6px;" class="checkbox"> Background-Repeat </label>
                                                                        </div>
                                                                        <div class="col-md-7 col-xs-7">
                                                                                    <input type="checkbox" name="checkboxes" id="backgroundRepeat" value="">
                                                                        </div>
                                                                        <div class="col-md-1 col-xs-1">
                                                                        </div>
                                                            </div>
                                                </div>
                                    </div>
                                        
        
                                    <div class="row">
                                                <div class="col-md-12">
                                                    
                                                            <div class="row">
                                                                        <div class="col-md-12">
                                                                                    <label class="checkbox" style="margin-top: 6px;"> Parent </label>
                                                                        </div>
                                                            </div>
                                                            <div class="row">
                                                                        <div class="col-md-1 col-xs-1"></div>
                                                                        <div class="col-md-3 col-xs-3">
                                                                                    <label class="checkbox" style="margin-top: 6px;"> Background Image of Parent </label>
                                                                        </div>
                                                                        <div class="col-md-7 col-xs-7">
                                                                                    <input class="form-control" id="backgroundImageParent" type="text"  value="" data-input="EVENT_Click" style="width:100%; " >
                                                                        </div>
                                                                        <div class="col-md-1 col-xs-1">
                                                                        </div>
                                                            </div>
                                                            <div class="row">
                                                                        <div class="col-md-1 col-xs-1"></div>
                                                                        <div class="col-md-3 col-xs-3">
                                                                                    <label style="margin-top: 6px;" class="checkbox"> Background Color of Parent </label>
                                                                        </div>
                                                                        <div class="col-md-7 col-xs-7">
                                                                                    <input class="form-control" id="backgroundColorParent" type="text" value="" data-input="EVENT_Click" style="width:100%; " >
                                                                        </div>
                                                                        <div class="col-md-1 col-xs-1">
                                                                        </div>
                                                            </div>
                                                    

                                                </div>
                                    </div>
        
                                        
                                    </div>
                                    <div class="modal-footer">

    <!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <span type="button" class="btn btn-info"   >Save changes</span-->

                                    </div>
                        </div>
            </div>
</div>
 
 

<!-- delete Modal modal-lg -->
<div class="modal fade" id="myModalforAlarmBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                        <div class="modal-content">
                                    
                                    <div class="modal-header">
                                                <a class="close" data-dismiss="modal">×</a>
                                                <h3 id="myModalforAlarmBoxTitle" >Delete</h3>
                                    </div>
                            
                                    <!--div class="modal-body" id="myModalforAlarmBoxBody" >
                                                Are You Sure Delete This App ?
                                    </div-->
                                    
                                    <div class="modal-footer">
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalforAlarmBoxNo"  >No</a> 
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalforAlarmBoxYes" >Yes</a>
                                    </div>
                        </div>
            </div>
</div>


<!-- delete Modal modal-lg -->
<div class="modal fade" id="myModalforQRcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                    
                                    <div class="modal-header">
                                                <a class="close" data-dismiss="modal">×</a>
                                                <h3 id="myModalforQRcodeTitle" > QRcode </h3>
                                    </div>
                            
                                    <div class="modal-body" id="myModalforQRcodeBody" >
                                                <div class="row">
                                                            <div class="col-md-12">
                                                                        <div class="row">
                                                                                    <div class="col-md-4 col-xs-4">
                                                                                                <label style="margin-top: 6px;" class="checkbox"> Title </label>
                                                                                    </div>
                                                                                    <div class="col-md-7 col-xs-7">
                                                                                                <input type="text" style="width:100%; " data-input="EVENT_Click" value="" id="ImputQrcodeTitle" class="form-control">
                                                                                    </div>
                                                                                    <div class="col-md-1 col-xs-1"></div>
                                                                        </div>       
                                                                
                                                                        <div class="row">       
                                                                                    <div class="col-md-4 col-xs-4">
                                                                                                <label style="margin-top: 6px;" class="checkbox"> Prev Page Url </label>
                                                                                    </div>
                                                                                    <div class="col-md-7 col-xs-7">
                                                                                                <input type="text" style="width:100%; " data-input="EVENT_Click" value="" id="ImputQrcodeUrl" class="form-control">
                                                                                    </div>
                                                                                    <div class="col-md-1 col-xs-1"></div>
                                                                        </div>
                                                            </div>
                                                </div>
                                    </div>
                                    <div class="modal-footer">
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalforQRcodeNo"  >No</a> 
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalforQRcodeYes" >Yes</a>
                                    </div>
                        </div>
            </div>
</div>


<div class="modal fade" id="myModalforiframe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                    
                                    <div class="modal-header">
                                                <a class="close" data-dismiss="modal">×</a>
                                                <h3 id="myModalforiframeTitle" > IFRAME </h3>
                                    </div>
                            
                                    <div class="modal-body" id="myModalforiframeBody" >
                                                <div class="row">
                                                            <div class="col-md-12">
                                                                        <div class="row">
                                                                                    <div class="col-md-4">
                                                                                                <label style="margin-top: 6px;" class="checkbox"> IFrame Link Url </label> 
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                                <input placeholder="http://" type="text" style="width:100%; " data-input="EVENT_Click" value="" id="Inputiframe" class="form-control">
                                                                                    </div>
                                                                                    <div class="col-md-1"></div>
                                                                        </div>
                                                            </div>
                                                </div>
                                    </div>
                                    <div class="modal-footer">
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalforiframeNo"  >No</a> 
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalforiframeYes" >Yes</a>
                                    </div>
                        </div>
            </div>
</div>

<div class="modal fade" id="myModalforFBmovie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                    
                                    <div class="modal-header">
                                                <a class="close" data-dismiss="modal">×</a>
                                                <h3 id="myModalforiframeTitle" > FB movie </h3>
                                    </div>
                            
                                    <div class="modal-body" id="myModalforiframeBody" >
                                                <div class="row">
                                                            <div class="col-md-12">
                                                                        <div class="row">
                                                                                    <div class="col-md-4">
                                                                                                <label style="margin-top: 6px;" class="checkbox"> FB Link Url </label> 
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                                <input placeholder="http://" type="text" style="width:100%; " data-input="EVENT_Click" value="" id="FB_movie" class="form-control">
                                                                                    </div>
                                                                                    <div class="col-md-1"></div>
                                                                        </div>
                                                            </div>
                                                </div>
                                    </div>
                                    <div class="modal-footer">
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalforFB_movieNo"  >No</a> 
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalforFB_movieYes" >Yes</a>
                                    </div>
                        </div>
            </div>
</div>

<div class="modal fade" id="myModalNavbar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                    
                                    <div class="modal-header">
                                                <a class="close" data-dismiss="modal">×</a>
                                                <h3 id="" > Navbar </h3>
                                    </div>
                            
                                    <div class="modal-body" >
                                    </div>
                                    
                                    <div class="modal-footer">
                                            <a data-dismiss="modal" class="btn btn-info">Save</a>
                                    </div>
                        </div>
            </div>
</div>



<div class="modal fade" id="myModalFormCTT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                        <div class="modal-content">
                                    
                                    <div class="modal-header">
                                                <a class="close" data-dismiss="modal">×</a>
                                                <h3 id="" > Form </h3>
                                    </div>
                            
                                    <div class="modal-body" >
                                    </div>
                                    
                                    <div class="modal-footer">
                                            <a data-dismiss="modal" class="btn btn-info">Save</a>
                                    </div>
                        </div>
            </div>
</div>

<div class="modal fade" id="myModalTimelinerr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                            <h3 id="" class="modal-title"> Timeliner Content Setting </h3>
                                </div>
                                
                                <div class="modal-body" >
                                        <div type="title" class="row">
                                                <div class="col-md-1 col-xs-1">
                                                </div>
                                                <div class="col-md-3 col-xs-3">
                                                            <label class="checkbox" style="margin-top: 6px;"> PIN Code </label>
                                                </div>
                                                <div class="col-md-8 col-xs-8">
                                                            <input type="text" id="PINInput" name="textinput" placeholder="" class="form-control">
                                                </div>
                                        </div>
                                        <div type="title" class="row">
                                                <div class="col-md-1 col-xs-1">
                                                    <button class="btn btn-info" id="AddTimelinerButton">
                                                        <i class="glyphicon glyphicon-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-3 col-xs-3">
                                                    <label class="checkbox" style="margin-top: 6px;">Timeline Title</label>
                                                </div>
                                                <div class="col-md-8 col-xs-8">
                                                    <input type="text" id="TimelinerInput" name="textinput" placeholder="" class="form-control">
                                                </div>
                                        </div>
                                </div>
                            
                                <div class="modal-body" >
                                        <div class="dd" id="nestable_timeliner">

                                        </div>
                                </div>
                            
                                <div class="modal-footer" >
                                        <button class="btn btn-info" id="">Save</button>
                                </div>
                        </div>
            </div>
</div>

<div class="modal fade" id="myModalTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lgg">
                        <div class="modal-content">
                                <div class="modal-header">
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                            <h3 id="" class="modal-title"> Row and Column Setting </h3>
                                </div>
                                
                                <div class="modal-body" >
                                        <div type="title" class="row">
                                                <div class="col-md-1 col-xs-1">
                                                    <button class="btn btn-info pull-right" id="AddTableRow">
                                                        <i class="glyphicon glyphicon-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-2 col-xs-2">
                                                    <label class="checkbox pull-right" style="margin-top: 6px;">Add Row after Row:</label>
                                                </div>
                                                <div class="col-md-2 col-xs-2">
                                                    <select id='AddRowDrop' style="width: 75%; margin-left: 15px; text-align: right;" class="form-control" data-select="interval">
                                                        <option value="0">0</option>
                                                        <option selected="selected" value="5000">5</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1 col-xs-1">
                                                </div>
                                                <div class="col-md-1 col-xs-1">
                                                    <button class="btn btn-info pull-right" id="MinusTableRow">
                                                        <i class="glyphicon glyphicon-minus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-2 col-xs-2">
                                                    <label class="checkbox pull-right" style="margin-top: 6px;">Minus Row:</label>
                                                </div>
                                                <div class="col-md-2 col-xs-2">
                                                    <select id='MinusRowDrop' style="width: 75%; margin-left: 15px; text-align: right;" class="form-control" data-select="interval">
                                                        <option value="0">0</option>
                                                        <option selected="selected" value="5000">5</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1 col-xs-1">
                                                </div>
                                        </div>
                                        <div type="title" class="row">
                                                <div class="col-md-1 col-xs-1">
                                                    <button class="btn btn-info pull-right" id="AddTableColumn">
                                                        <i class="glyphicon glyphicon-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-2 col-xs-2">
                                                    <label class="checkbox pull-right" style="margin-top: 6px;">Add Column after Column:</label>
                                                </div>
                                                <div class="col-md-2 col-xs-2">
                                                    <select id='AddColumnDrop' style="width: 75%; margin-left: 15px; text-align: right;" class="form-control" data-select="interval">
                                                        <option value="0">0</option>
                                                        <option selected="selected" value="5000">5</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1 col-xs-1">
                                                </div>
                                                <div class="col-md-1 col-xs-1">
                                                    <button class="btn btn-info pull-right" id="MinusTableColumn">
                                                        <i class="glyphicon glyphicon-minus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-2 col-xs-2">
                                                    <label class="checkbox pull-right" style="margin-top: 6px;">Minus Column:</label>
                                                </div>
                                                <div class="col-md-2 col-xs-2">
                                                    <select id='MinusColumnDrop' style="width: 75%; margin-left: 15px; text-align: right;" class="form-control" data-select="interval">
                                                        <option value="0">0</option>
                                                        <option selected="selected" value="5000">5</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1 col-xs-1">
                                                </div>
                                        </div>
                                </div>
                            
                                <div class="modal-body" >
                                        <div id="dataTable_table">

                                        </div>
                                </div>
                            
                                <div class="modal-footer" >
                                        <a class="btn btn-info" data-dismiss="modal">Save</a>
                                </div>
                        </div>
            </div>
</div>

<div class="modal fade" id="abin_TableData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">          
                                <div class="modal-body" >
                                        <div class="row">
                                                <div class="col-md-12">
                                                            <div class="row">
                                                                        <div class="col-md-4">
                                                                                    <label style="margin-top: 6px;" class="checkbox"> Project Name : </label>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                                    <input type="text" style="width:100%; " data-input="projectname" placeholder="HelloWorld" class="form-control">
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                        </div>
                                                            </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button role="button" class="btn btn-info pull-right" data-dismiss="modal" data-target="save" >Save</button>
                                </div>
                        </div>
            </div>
</div>


<!-- delete Modal modal-lg -->
<div class="modal fade" id="myModalforPageNextPrev" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                    
                                    <div class="modal-header">
                                                <a class="close" data-dismiss="modal">×</a>
                                                <h3 id="myModalforPageNextPrevTitle" > PageHandover </h3>
                                    </div>
                            
                                    <div class="modal-body" id="myModalforPageNextPrevBody" >
                                                <div class="row">
                                                            <div class="col-md-12">
                                                                        <div class="row">
                                                                                    <div class="col-md-4">
                                                                                                <label style="margin-top: 6px;" class="checkbox"> Prev Page Url </label>
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                                <input type="text" style="width:100%; " data-input="prevpage" placeholder="http://" class="form-control">
                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                    </div>
                                                                        </div>
                                                                        <div class="row">
                                                                                    <div class="col-md-4">
                                                                                                <label class="checkbox" style="margin-top: 6px;"> Next Page Url </label>
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                                <input type="text" style="width:100%; " data-input="nextpage" placeholder="http://" class="form-control">
                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                    </div>
                                                                        </div>
                                                            </div>
                                                </div>
                                    </div>
                                    <div class="modal-footer">
                                                <a data-dismiss="modal" class="btn btn-info" > Cancel </a> 
                                                <a data-dismiss="modal" class="btn btn-info" data-target="save"> Save </a>
                                    </div>
                        </div>
            </div>
</div>

<!-- bohan2014.6.27 -->
<div class="modal fade" id="myModalData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">          
                                <div class="modal-body" >
                                        <div class="row">
                                                <div class="col-md-12">
                                                            <div class="row">
                                                                        <div class="col-md-4">
                                                                                    <label style="margin-top: 6px;" class="checkbox"> NAME </label>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                                    <input type="text" style="width:100%; " data-target="name" class="form-control">
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                        </div>
                                                            </div>
                                                            <div class="row">
                                                                        <div class="col-md-4">
                                                                                    <label class="checkbox" style="margin-top: 6px;"> VALUE </label>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                                    <input type="text" style="width:100%; " data-target="value" class="form-control">
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                        </div>
                                                            </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button role="button" class="btn btn-info pull-right" data-dismiss="modal" data-target="save" >Save</button>
                                </div>
                        </div>
            </div>
</div>



<div class="modal fade" id="3Dbutton_URL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">          
                                <div class="modal-body" >
                                        <div class="row">
                                                <div class="col-md-12">
                                                            <div class="row">
                                                                        <div class="col-md-4">
                                                                                    <label style="margin-top: 6px;" class="checkbox"> URL </label>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                                    <input type="text" style="width:100%; " data-input="URL" placeholder="http://" class="form-control">
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                        </div>
                                                            </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button role="button" class="btn btn-info pull-right" data-dismiss="modal" data-target="save" >Save</button>
                                </div>
                        </div>
            </div>
</div>

<div class="modal fade" id="myModalBtEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                    <div class="modal-header"><h3>Event</h3>
                                    </div>
                                    <div class="modal-body">
                                                <div class="row">
                                                            <div class="col-md-4">
                                                                        <label class="radio">
                                                                            <input type="radio" value="Url" name="ButtonEventRadio"> Link Url 
                                                                        </label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                        <input type="text" style="width:100%; " data-input="Url" placeholder="http://" class="form-control">
                                                            </div>
                                                            <div class="col-md-1">
                                                            </div>
                                                </div>
                                                <div class="row">
                                                            <div class="col-md-4">
                                                                        <label class="radio">
                                                                            <input type="radio" value="NewUrl" name="ButtonEventRadio"> New Url Page 
                                                                        </label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                        <input type="text" style="width:100%; " data-input="NewUrl" placeholder="http://" class="form-control">
                                                            </div>
                                                            <div class="col-md-1">
                                                            </div>
                                                </div>
                                                <div class="row">
                                                            <div class="col-md-4">
                                                                        <label class="radio">
                                                                            <input type="radio" value="Alert" name="ButtonEventRadio"> Show alert 
                                                                        </label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                        <input type="text" style="width:100%; " data-input="Alert" placeholder="" class="form-control">
                                                            </div>
                                                            <div class="col-md-1">
                                                            </div>
                                                </div>
                                                <div class="row">
                                                            <div class="col-md-4">
                                                                        <label class="radio">
                                                                            <input type="radio" value="BackToTop" name="ButtonEventRadio"> Back To Top 
                                                                        </label>
                                                            </div>
                                                            <div class="col-md-8">
                                                            </div>
                                                </div>
                                                <div class="row">
                                                            <div class="col-md-4">
                                                                        <label class="radio">
                                                                            <input type="radio" value="None" name="ButtonEventRadio"> None 
                                                                        </label>
                                                            </div>
                                                            <div class="col-md-8">
                                                            </div>
                                                </div>
                                    </div>
                                    <div class="modal-footer">
                                                <a data-dismiss="modal" class="btn btn-info" id="">Save</a>
                                    </div>
                        </div>
            </div>
</div>

<!-- delete Modal modal-lg -->
<div class="modal fade" id="myModalforSaveSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                                    
                                    <div class="modal-body" >
                                                Save Success
                                    </div>
                        </div>
            </div>
</div>


<!-- delete Modal modal-lg -->
<div class="modal fade" id="myModalforIOT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                    
                                    <div class="modal-header">
                                                <div style="font-size: 24pt;">DataSource 
                                                </div>
                                                <!--a class="close" data-dismiss="modal">×</a>
                                                <h3 id="myModalforIOTTitle" > MMA </h3>
                                                <ul class="nav nav-pills">
                                                            <li id="MMA_ON" class="active" val="HTML"><a href="#">HTML</a></li>
                                                            <li id="MMA_OFF" val="CSS"><a href="#">CSS</a></li>
                                                </ul-->
                                    </div>
                            
                                    <div class="modal-body" id="myModalforIOTBody" >
                                            <div class="row">
                                                <div class="col-xs-12" hassortable="true">
                                                        <p style="font-size: 18pt;">MMS Command</p>
                                                        <form class="form-horizontal" role="form" >
                                                                    <div class="form-group">
                                                                                <label class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label" style="font-size: 12pt;font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;To:</label>
                                                                                <div class="col-lg-6 col-md-7 col-sm-8 col-xs-6"><input type="text" data-input="to" placeholder="dio@nettcp" class="form-control" ></div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                                <label class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label" style="font-size: 12pt; font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;On Message:</label>
                                                                                <div class="col-lg-6 col-md-7 col-sm-8 col-xs-6"><input type="text" data-input="on_message" class="form-control" placeholder="output 00100101 2 1" ></div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                                <label class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label" style="font-size: 12pt; font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;Off Message:</label>
                                                                                <div class="col-lg-6 col-md-7 col-sm-8 col-xs-6"><input type="text" data-input="off_message" class="form-control" placeholder="output 00100101 2 0" ></div>
                                                                    </div>
                                                        </form>

                                                </div>
                                            </div>
                                    </div>
                            
                                    <!--div class="modal-body" id="myModalforIOTBody" >
                                                <form style="display:none;" class="form-horizontal" role="form" >
                                                            <div class="form-group">
                                                                        <label class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label" style="font-size: 12pt;font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;To:</label>
                                                                        <div class="col-lg-6 col-md-7 col-sm-8 col-xs-6"><input type="text" data-input="on_to" placeholder="Please input cloumn" class="form-control"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                        <label class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label" for="inputPassword" style="font-size: 12pt; font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;Message:</label>
                                                                        <div class="col-lg-6 col-md-7 col-sm-8 col-xs-6"><input type="text" data-input="on_message" class="form-control" placeholder="Please input cloumn"></div>
                                                            </div>
                                                </form>
                                                <form style="display:none;" class="form-horizontal" role="form" >
                                                            <div class="form-group">
                                                                        <label class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label" style="font-size: 12pt;font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;To:</label>
                                                                        <div class="col-lg-6 col-md-7 col-sm-8 col-xs-6"><input type="text" data-input="off_to" placeholder="Please input cloumn" class="form-control"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                        <label class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label" for="inputPassword" style="font-size: 12pt; font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;Message:</label>
                                                                        <div class="col-lg-6 col-md-7 col-sm-8 col-xs-6"><input type="text" data-input="off_message" class="form-control" placeholder="Please input cloumn"></div>
                                                            </div>
                                                </form>
                                    </div-->
                            
                                    <div class="modal-footer">
                                                <a data-dismiss="modal" class="btn btn-default" id="myModalforIOTNo" > Cancel </a> 
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalforIOTYes" > Save </a>
                                    </div>
                        </div>
            </div>
</div>

<div class="modal fade" id="myModalFolderName" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                        <div class="modal-content">
                                    <!--
                                    <div class="modal-header" style="height: 50px;">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h2 class="text-center" > DataSource </h2>
                                    </div>
                                    -->
                                    <div style="" class="modal-header">
                                                <div class="pull-right">
                                                                                <div class="btn-group"><button type="button" class="btn btn-info pull-right" data-dismiss="modal" data-target="#SaveChanges"> Add </button></div>
                                                                                <div class="btn-group"><button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button></div>
                                                </div>
                                                <h2 class="text-center"> Add Folder Name </h2>
                                    </div>
                                    <div class="modal-body" >
                                                Folder Name:<input id="myModalFolderNameInputID" type="text" class="form-control"><!--span class="help-inline">Inline help text</span-->
                                        
                                    </div>
                        </div>
            </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalFormMMS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            
                                    <div class="modal-header">
                                                <div style="font-size: 24pt;">DataObject</div>
                                    </div>
                            
                                    <div class="modal-body" >
                                                <div class="row">
                                                            <div class="col-xs-12" hassortable="true">
                                                                        <form class="form-horizontal" role="form" >
                                                                                    <div class="form-group">
                                                                                                <label class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label" style="font-size: 12pt;font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;object name:</label>
                                                                                                <div class="col-lg-6 col-md-7 col-sm-8 col-xs-6"><input type="text" data-input="to" placeholder="DDN" class="form-control" ></div>
                                                                                    </div>
                                                                        </form>
                                                            </div>
                                                </div>
                                    </div>
                            
                            
                                    <div class="modal-footer">
                                                <a data-dismiss="modal" class="btn btn-default" id="myModalFormMMSCancel" > Cancel </a> 
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalFormMMSSave" > Save </a>
                                    </div>
                                    
                        </div>
            </div>
</div>





<!--div class="modal fade bs-example-modal-sm" id="menu_close_project" role="dialog" >
            <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            
                                    <div class="modal-header">
                                                <div style="font-size: 24pt;">確認是否儲存文章</div>
                                    </div>
                            
                                    <div class="modal-body" >
                                                <div class="row">
                                                            <div class="col-xs-12" hassortable="true">
                                                                        <form class="form-horizontal" role="form" >
                                                                                    <div class="form-group">
                                                                                                <label class="col-lg-3 col-md-3 col-sm-4 col-xs-2 control-label" style="font-size: 12pt;font-weight : normal;">&nbsp;&nbsp;&nbsp;&nbsp;object name:</label>
                                                                                                <div class="col-lg-6 col-md-7 col-sm-8 col-xs-6"><input type="text" data-input="to" placeholder="DDN" class="form-control" ></div>
                                                                                    </div>
                                                                        </form>
                                                            </div>
                                                </div>
                                    </div>

                                    <div class="modal-footer">
                                                <a data-dismiss="modal" class="btn btn-default" id="myModalFormMMSCancel" > Cancel </a> 
                                                <a data-dismiss="modal" class="btn btn-info" id="myModalFormMMSSave" > Save </a>
                                    </div>
                                    
                        </div>
            </div>
</div-->

<div id="menu_close_project" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
                <div class="modal-content">

                            <div class="modal-header">
                                        <div style="font-size: 24pt;">離開編輯</div>
                                        <button data-dismiss="modal" class="close" type="button" style="position: absolute; top: 0px; right: 0px; margin-top: 10px; margin-right: 10px;">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                            </div>

                            <div class="modal-body">
                                    <div style="font-size: 15pt;">是否儲存編輯檔案</div>
                            </div>

                            <div class="modal-footer">
                                        <a class="btn btn-info" id="menu_close_project_yes" > Save </a>
                                        <a class="btn btn-default" id="menu_close_project_no" data-dismiss="modal" > Cancel </a> 
                            </div>

                </div>
        </div>
</div>

<div id="change_img_select_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
                <div class="modal-content">

                            <div class="modal-header">
                                        <div style="font-size: 24pt;">選擇圖片</div>
                                        <button data-dismiss="modal" class="close" type="button" style="position: absolute; top: 0px; right: 0px; margin-top: 10px; margin-right: 10px;">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                            </div>

                            <div class="modal-body">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"></div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <div style="height: 200px; width: 310px; border: 1px dashed black; padding: 0px;" class="col-xs-12" id="upload_cover_img">
                                                            <div id="preinstall">
                                                                <img alt="ttshow" src="template/assets/img/uplaod-01.png" style="position: absolute; margin: auto; left: 0px; right: 0px; top: 0px; bottom: 40px;">
                                                                <div style="position: absolute; margin: auto; left: 0px; right: 0px; bottom: 40px; font-size: 12pt; width: 40px; height: 15px; top: 75px; text-align: center;">上傳</div>
                                                            </div>
                                                            <div style="width: 100%; height: 100%; position: absolute; top: 0px;">
                                                                <div img="" style="width: 100%; height: 100%; position: absolute; top: 0px; background-position: 50% 50%; background-size: cover; background-image: url(&quot;http://www.ooxxoox.com/ttshow/web/data/689/ThumbnailM/pagicon.jpg&quot;);" id="upload_now">
                                                                </div>
                                                            </div>
                                                    </div>
                                    </div>
                            </div>

                            <div class="modal-footer">
                                        <a class="btn btn-info" id="change_img_select_modal_yes" > Save </a>
                                        <a class="btn btn-default" id="change_img_select_modal_no" > Cancel </a> 
                            </div>

                </div>
        </div>
</div>

<div aria-hidden="false" aria-labelledby="mySmallModalLabel" role="dialog" tabindex="-1" class="modal fade bs-example-modal-sm in" id="channel_publish_modal">
        <div class="modal-dialog modal-lg" style="max-width: 1000px; position: absolute; right: 0px; left: 0px; margin-right: auto; margin-left: auto;">
                <div class="modal-content">

                            <div class="modal-header">
                                        <div style="font-size: 24pt;">發文</div>
                                        <button style="position: absolute; top: 0px; right: 0px; margin-top: 10px; margin-right: 10px;" type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                            </div>

                            <div class="modal-body">
                                    <div style="position: relative; margin: auto; width: 100%; height: 200px; max-width: 600px; border: 1px solid rgb(221, 221, 221);">
                                            <input id="transient_file" type="file" multiple="" target="page_icon" style="display: none;">
                                            <div id="page_icon" img="" style="position: absolute; height: 200px; width: 65%; left: 0px; background-size: cover; background-position: 50% 50%;"></div>
                                            <div id="picture_upload" style="position: absolute; right: 0px; width: 35%; background: rgb(221, 221, 221) none repeat scroll 0% 0%; height: 100%; border: 1px solid gray;">
                                                    <div style="margin: 40px auto auto; right: 0px; left: 0px; position: absolute; top: 0px; width: 100px; bottom: 0px;"><img alt="ttshow" src="forttshow/uplaod-01.png" style="width: 100px;"><div style="text-align: center; margin-top: 15px; font-size: 15pt;">上傳</div></div>
                                            </div>
                                    </div>
                                    <div style="position: relative; margin: auto; width: 100%; max-width: 600px; font-size: 13pt; line-height: 35px;">
                                            <div style="height: 40px; margin: 20px 20px 10px;">
                                                    <div style="float: left; width: 100px;">標題 : </div>
                                                    <input id="title_modal" type="text" data-input="tag" style="float: left; width: 50%;" class="form-control">
                                            </div>
                                            <div style="height: 40px; margin: 10px 20px;">
                                                    <div style="float: left; width: 100px;">分類 : </div>
                                                    <select id="class_modal" style="height: 30px; width: 50%;">
                                                    </select>
                                            </div>
                                            <div style="height: 40px; margin: 10px 20px;">
                                                    <div style="float: left; width: 100px;">頻道 : </div>
                                                    <select id="channel_modal" style="height: 30px; width: 50%;">
                                                    </select>
                                            </div>
                                            <div style="height: 40px; margin: 10px 20px;">
                                                    <div style="float: left; width: 100px;">標籤 : </div>
                                                    <input id="tag_modal" type="text" class="form-control" style="float: left; width: 50%;" data-input="tag">
                                                    <div id="add_tag" style="text-align: center; padding: 2px 0px; background: rgb(221, 221, 221) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); float: left; font-size: 10pt; height: 25px; width: 55px; line-height: 20px; margin-left: 5px; margin-top: 5px;" target="instagram">
                                                            +增加
                                                    </div>
                                            </div>
                                            <div id="tag_modal_space" style="height: 40px; margin: 10px 20px;">
                                            </div>
                                            <div id="tag_example_model" style="display: none; margin-bottom: 5px; margin-right: 10px; float: left; height: 25px; background: rgb(221, 221, 221) none repeat scroll 0% 0%; line-height: 25px; font-size: 11pt; padding: 0px 7px; border-radius: 5px;">
                                                <div style="background: rgb(204, 204, 204) none repeat scroll 0% 0%; border-radius: 6px;">
                                                    <div id="delete" style="float: left; margin-right: 10px; border-radius: 100%; border: 1px solid black; text-align: center; width: 17px; height: 17px; line-height: 17px; font-size: 9pt; margin-top: 4px;">X</div>
                                                    <div id="tag_name" style="float: left;">abcdefg</div>
                                                </div>
                                            </div>
                                    </div>
                            </div>

                            <div class="modal-footer">
                                        <a id="channel_publish_modal_yes" class="btn btn-info"> Save </a>
                                        <a data-dismiss="modal" id="menu_close_project_no" class="btn btn-default"> Cancel </a> 
                            </div>

                </div>
        </div>
</div>

<div id="save_file_success" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
                <div class="modal-content">

                            <div class="modal-header">
                                        <div style="font-size: 24pt;">發文完成</div>
                                        <button data-dismiss="modal" class="close" type="button" style="position: absolute; top: 0px; right: 0px; margin-top: 10px; margin-right: 10px;">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                            </div>
                </div>
        </div>
</div>

        <div id="loadingpage" style="display: none;">
                <div style="width: 100%; height: 100%; position: absolute; left: 0px; top: 0px; background: rgb(221, 221, 221) none repeat scroll 0% 0%; opacity: 0.5; z-index: 9999;"></div>
                <img src="forttshow/loading.gif" style="position: absolute; margin: auto; top: 0px; left: 0px; right: 0px; bottom: 0px; width: 100px; z-index: 10000;">
        </div>

</body>
</html>
