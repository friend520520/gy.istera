<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<link href="https://dl.dropboxusercontent.com/u/61856343/ttshow.ico" rel="shortcut icon">
	<title>台灣達人秀 | 最強自媒體聯播網</title>
	<meta property="og:title" content="台灣達人秀 │ 最強自媒體聯播網"/>
	<meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
	<meta name="keywords" content="達人秀,ttshow,新媒體創作行銷平台,新媒體人才媒合,新媒體社群行銷,新媒體影音製作,明星,藝人,插畫家,網路紅人,導演,編劇,熱門影片,Youtube排行,facebook排行,喜劇,搞笑,梗圖,音樂,寵物,有趣新聞,Youtube,網路直播,youtube,facebook,instagram"/>
	<link href="template_new/css/bootstrap.min.css" rel="stylesheet">
	<link href="template_new/css/owl.carousel.css" rel="stylesheet">
	<link href="template_new/css/swiper.min.css" rel="stylesheet">
	<link href="template_new/css/jquery.growl.css" rel="stylesheet" type="text/css" />
	<link href="template_new/css/layout.css" rel="stylesheet" type="text/css">
	<link href="template_new/css/index.css" rel="stylesheet" type="text/css">
	<link href="css/all.css" rel="stylesheet" type="text/css">
	
        <script src="template_new/js/jquery-1.11.1.min.js"></script><!-- other -->
        
        <script src="js/device.js"></script>
        <script src="js/create.js"></script>
        
        <script src="template_new/js/owl.carousel.js"></script><!-- other -->
        <script src="template_new/js/swiper.min.js"></script><!-- other -->
        <script src="template_new/js/clamp.min.js"></script><!-- other -->
        <script src="template_new/js/bootstrap.min.js"></script><!-- other -->
        <script src="template_new/js/fastclick.js"></script><!-- other -->
        <script src="template_new/js/jquery.growl.js"></script>
        <script src="template_new/js/main.js"></script><!-- other -->
                        
        <script src="js/tabs.js"></script>
        <script src="js/md5.js"></script>
        <script src="js/ajaxq.js"></script>
        
        <script src="js/tmp.js"></script>
        
        <script>
                        // 治標用
                        $(document).ready(function() {
                                    $( ".owl-buttons" ).remove();
                        });
        </script>
	
        

        
        
	<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->
	
</head>
<body>
	<div id="wrap">
            
                <?php include( "tmp.php"); ?>
            
                <main style="display: none;">
                        
			<?php include( "tmp_bottom.php"); ?>
                    
			<div class="slider">
				
			</div>
			<div class="slider-pc">
				<div class="slider-main">
				</div>
				<div class="slider-sub">	
				</div>
			</div>
                        <div id="content">
                            <div class="list" style="visibility: hidden;">
                                <a href="inner.php?page_id=2027">
                                    <div name="responsive_div">
                                        <div style="background-image: url('http://www.ooxxoox.com/ttshow/web/data/2027/ThumbnailM/pagicon.jpg'); "></div>
                                    </div>
                                    <div class="info">
                                        <h3>【Onion man】經典插畫(八)：九陰真經的厲害</h3>
                                        <p class="view">
                                            <img src="template_new/images/inner/view.png">
                                            <span>0</span>
                                        </p>
                                    </div>
                                    <div class="list-icon"></div>
                                </a>
                            </div>
                        </div>
		</main>
                <div class="pop-item">
                        <?php include( "tmp_mobile.php"); ?>
                </div>
		<div id="loading_icon" class="loading" name="load_img" style="visibility: hidden;"></div>
	</div>
        <script type="text/javascript">
                    
                    function FB_connected_callback_init( response )
                    {
                                $.member = response;

                                $( "main" ).show();
                                init_scroll();

                    };

                    function FB_unconnected_callback_init()
                    {
                                $.member = { facebook_mail : "" , email : "" };

                                $( "main" ).show();
                                init_scroll();

                    };

        </script>
        <script src="js/fb-login.js"></script>
</body>
</html>
