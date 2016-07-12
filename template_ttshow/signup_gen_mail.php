<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                
                <title>ttshow-註冊表格</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">
                
                <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

                <!-- bootstrap & fontawesome -->
                <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->
                <!-- ace styles 4/9 AL 更換CSS路徑-->
                <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

                <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />

        
                <script src="template/assets/js/jquery.js"></script>
                <script src="js/device.js"></script>
                <script src="js/create.js"></script>
                <script src="template/assets/js/jquery-ui.js"></script>
                <script src="template/assets/js/bootstrap.js"></script>
                
                <script src="js/view_upload_img.js"></script>
                
                <script type="text/javascript">
                        jQuery(function($) {

                                //jquery tabs
                                if( $( "#tabs" ).length )
                                $( "#tabs" ).tabs().show();



                        });
                </script>
                
                
	</head>

	<body class="no-skin" style="background-color: #DDDDDD;">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay" style="width: 100%; height: 100%; display: none;">
                <div style="position: fixed; margin: auto; right: 0px; left: 0px; bottom: 0px; top: -30px; height: 0px;">
                        <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
                </div>
        </div>
        
        <?php include( "header_1.php"); ?>
        <div class="main-container" id="main-container" style="background-color: white;">
            <div style="max-width: 800px; position: absolute; margin: 110px auto auto; right: 0px; left: 0px; background: none repeat scroll 0% 0% white;">
                    <div style="position: relative; height: 200px; width: 100%; margin-top: 50px;">
                            <img style="position: absolute; margin: auto; right: 0px; left: 0px; height: 200px; width: 200px;" src="template/assets/img/success.png">
                    </div>

                    <div style="text-align: center; font-weight: bold; top: 20px; position: relative; height: 50px; line-height: 50px; margin-bottom: 40px; font-size: 28pt;">請至信箱認證</div>

                    <div style="position: relative; margin: auto; right: 0px; left: 0px; max-width: 400px; padding: 10px;">
                            <div style="position: relative; padding-bottom: 10px; padding-left: 5px; font-size: 18pt; border-bottom: 1px solid rgb(221, 221, 221);">
                                您現在可以
                            </div>


                            <ul style="font-size: 12pt; margin-bottom: 40px;">
                                    <li style="margin: 10px 0px;">
                                            觀看所有
                                            <u>
                                                <a href="index.php" style="color: #5e96d5;">
                                                    優質創作內容
                                                </a>
                                            </u>
                                    </li>
                                    <li style="margin: 10px 0px;">
                                            投稿個人創作，
                                            <u>
                                                <a href="#" style="color: #5e96d5;">
                                                    點此投稿您的第一個創作
                                                </a>
                                            </u>
                                    </li>
                                    <li style="margin: 10px 0px;">
                                            <u>
                                                訂閱
                                                <a href="#" style="color: #5e96d5;">
                                                    關注合作頻道
                                                </a>
                                            </u>
                                    </li>
                            </ul>

                            <div style="position: relative; margin-left: 10px; margin-bottom: 10px; margin-right: 10px; font-size: 13pt;">
                                    <div style="position: relative; padding-bottom: 10px; font-size: 18pt; border-bottom: 1px solid rgb(221, 221, 221);">
                                            下載台灣達人秀APP
                                    </div>
                                    <div style="position: relative; padding-bottom: 5px; margin-top: 10px; font-size: 14pt; line-height: 25px;">
                                        立刻下載，無論你走到哪裡都可以輕鬆觀看台灣達人秀
                                    </div>
                                    <img style="width: 100%; padding: 20px; margin-bottom: 100px;" src="template/assets/img/google_appstore.png">
                            </div>
                    </div> 
            </div>
        </div>


        </body>

</html>
