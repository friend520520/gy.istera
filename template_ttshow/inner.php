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
        
        <?php
                
                include("php/config.php");
                include 'php/global.php';
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );

                if (mysqli_connect_errno()) {

                }
                else {

                        $page = get_sql( $con , "page" , "page_id=" . $_REQUEST['page_id'] , array( 'title' , 'page_id' , 'article_icon' , 'describe' , "channel_id" ) );

                        echo '<title>' . $page[0]['title'] . ' | 最強創作者聯盟 | 最強自媒體創作平台</title>';
                        echo '<meta property="og:title" content="' . $page[0]['title'] . '"/>';
                        echo '<meta property="og:type" content="article"/>';
                        echo '<meta property="og:image" content="' . $user_image_path . $_REQUEST['page_id'] . "/ThumbnailM/" . $page[0]['article_icon'] . '"/>';
                        echo '<meta property="og:description" content="' . $page[0]['describe'] . '"/>';
                        
                        $channel = get_sql( $con , "channel" , "channel_id=" . $page[0]['channel_id'] , array( "ch_name" , "facebook_url" , "youtube_url" , "instagram_url" , "line_url" , "pixnet_url" , "other_url" ) );
                        
                        $callback = array(  "channel_info" => array( "id" => $ch ,
                                                                    "name" => $channel[0]['ch_name'] ) ,
                                            "channel_community" => array( "facebook" => json_decode( $channel[0]['facebook_url'] , true ) ,
                                                                        "youtube" => json_decode( $channel[0]['youtube_url'] , true ) ,
                                                                        "instagram" => json_decode( $channel[0]['instagram_url'] , true ) ,
                                                                        "line" => json_decode( $channel[0]['line_url'] , true ) ,
                                                                        "pixnet" => json_decode( $channel[0]['pixnet_url'] , true ) ,
                                                                        "other" => json_decode( $channel[0]['other_url'] , true ) ) );

                        mysqli_close($con);

                }

        ?>
        
	<link href="template_new/css/bootstrap.min.css" rel="stylesheet">
	<link href="template_new/css/owl.carousel.css" rel="stylesheet">
	<link href="template_new/css/swiper.min.css" rel="stylesheet">
	<link href="template_new/css/jquery.growl.css" rel="stylesheet" type="text/css" />
	<link href="template_new/css/layout.css" rel="stylesheet" type="text/css">
	<link href="template_new/css/inner.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        
	<link href="css/all.css" rel="stylesheet" type="text/css">
        <style>
            .youtobe_video {
                left: 0px;
                right: 0px;
                margin: auto;
                max-width: 100%;
            }
            @media (max-width: 1023px) {
                #pageabout > .list:nth-child(7) {
                    display: none;
                }
                #pageabout > .list:nth-child(8) {
                    display: none;
                }
            }
            /*@media (min-width: 1024px) {   
                #content .list {
                  width: 23.8%
                }
            }*/
            
         
        </style>
        
        <script src="template_new/js/jquery-1.11.1.min.js"></script><!-- other -->
        
        <script src="js/device.js"></script>
        <script src="js/create.js"></script>
        
        <script src="template_new/js/owl.carousel.js"></script><!-- other -->
        <script src="template_new/js/swiper.min.js"></script><!-- other -->
        <script src="template_new/js/bootstrap.min.js"></script><!-- other -->
        
        <script src="js/md5.js"></script>
        <script src="js/ajaxq.js"></script>
        
        <script src="js/inner.js"></script>
        
        <script src="template_new/js/clamp.min.js"></script>
        <script src="template_new/js/fastclick.js"></script>
        <script src="template_new/js/jquery.growl.js"></script>
        <script src="template_new/js/main.js"></script>
        <script src="template_new/js/inner.js"></script>
        
        <script src="js/tmp.js"></script>
        
        <script src="js/apps.js"></script>
        
        <script src="https://apis.google.com/js/platform.js"></script>
        
        <script>
            var fbhtml_url = "http://ttshow.tw/new/inner.php" + location.search;
        </script>
</head>
<body>
	<!--div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.4";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script-->
	<div id="wrap">
            
                <?php include( "tmp.php"); ?>
                
		<main>
                        <?php include( "tmp_bottom.php"); ?>
                    
			<div id="content" style="visibility: hidden;">
				<article>
                                        <div class="viewers" style="height: 46px;">
						<div class="number">
							點閱 <span id="pagenum" ></span>
						</div>
                                                <a>
                                                    <img id="pagespecialtag">
                                                </a>
						<div class="fb-like" data-href="https://www.facebook.com/TaiwanTalentShow" data-layout="button_count"></div>
					</div>
					<div id="pagehead" class="title"></div>
					<div class="date">
						<span id="pagechannel" ></span>
					</div>
					<div class="date">
						<img src="template_new/images/inner/time.png">
						<span id="pagedate" ></span>
					</div>
					<div class="report">
						<img src="template_new/images/inner/Report.png">
						<span>檢舉</span>
					</div>
                                        <ul class="association">
						<li class="fb">
							<a onclick="share_event()" style="cursor: pointer;">
								<i class="fa fa-facebook"></i>
							</a>
						</li>
						<li class="google">
							<a onclick="window.open('https://plus.google.com/share?url=' + fbhtml_url );return false;" style="cursor: pointer;">
								<i class="fa fa-google-plus"></i>
							</a>
						</li>
						<li class="line">
							<a href="javascript:;" onclick="window.open('http://line.naver.jp/R/msg/text/?'+fbhtml_url);return false;">
								<img src="template_new/images/inner/association/line.png">
							</a>
						</li>
						<li class="sina">
							<a href="javascript:;" onclick="window.open('http://v.t.sina.com.cn/share/share.php?title=' + fbhtml_url + '&url='+fbhtml_url);return false;" >
								<img src="template_new/images/inner/association/sina.png">
							</a>
						</li>
						<li class="plus">
							<a href="javascript:;">
								<i class="fa fa-plus"></i>
							</a>
						</li>
						<!--li class="line">
							<a onclick="window.open('http://line.naver.jp/R/msg/text/?'+fbhtml_url);return false;" style="cursor: pointer;">
								<img src="template_new/images/inner/association/line.png">
							</a>
						</li>
						<li id="get_collect" class="love">
                                                        <a style="cursor: pointer;">
								<img src="template_new/images/inner/association/love.png">
								<span>收藏</span>
							</a>
						</li-->
					</ul>
                                        <div class="ad">
						<div class="desktop">
							<script async src="//pagead2.googlesyndication.com/pagead /js/adsbygoogle.js"></script>
							<!-- [PC] 內頁_標題下_320x100 -->
							<ins class="adsbygoogle"
							style="display:inline- block;width:320px;height:100px" data-ad-region="content"; data-ad-client="ca-pub-4339897644150893"
							data-ad-slot="8055973766"></ins> <script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
						<div class="mobile">
							<script async src="//pagead2.googlesyndication.com/pag ead/js/adsbygoogle.js"></script>
							<!-- [M] 內頁_內文上_320x100 -->
							<ins class="adsbygoogle"
							style="display:inline- block;width:320px;height:100px"
							data-ad-region="content"; data-ad-client="ca-pub- 4339897644150893"
							data-ad-slot="4683704967"></ins> <script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
					</div>
					<div id="pagecontent" class="info"></div>
                                        
                                        <div class="ad">
                                                <div class="desktop">
                                                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoo gle.js"></script>
                                                        <!-- [PC] 內頁_內文中(2)_300x250 -->
                                                        <ins class="adsbygoogle"
                                                        style="display:inline-block;width:300px;height:250px" data-ad-region="content"; data-ad-client="ca-pub-4339897644150893"
                                                        data-ad-slot="4823305768"></ins> <script>
                                                        (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                                                </div>
                                                <div class="mobile">
                                                        <script async src="//pagead2.googlesyndication.com/pag ead/js/adsbygoogle.js"></script>
                                                        <!-- [M] 內頁_內文下_300x250 -->
                                                        <ins class="adsbygoogle"
                                                        style="display:inline- block;width:300px;height:250px"
                                                        data-ad-region="content"; data-ad-client="ca-pub- 4339897644150893"
                                                        data-ad-slot="1590637760"></ins> <script>
                                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                                        </script>
                                                </div>
                                        </div>
                                        
                                        <div class="tag-message" style="margin-bottom: 5px;">
						<ul id="pagetag" class="tag">
						</ul>
						<div class="message" style="width: 100%; text-align: center; margin-top: 13px;">
							<a>留言 (共 <c></c> 則留言</a>
						</div>
					</div>
				</article>
                                
                                <script>
                                
                                    //if( getParameterByName( "page_id" ) === "1806" )
                                    //{
                                            $( ".tag-message" ).after( '<div class="fb-comments" data-href="http://ttshow.tw/page-inner.php?page_id=' + getParameterByName( "page_id" ) + '" data-width="100%" data-numposts="5"></div>' );
                                            
                                    //}                         
                                    $( ".message > a" ).bind( "click" , function(){
                                            
                                            var pos = $( ".fb-comments" );
                                            if( pos.css( "display" ) === "inline" ) {
                                                pos.css( "display" , "none" );
                                            }
                                            else if( pos.css( "display" ) === "none" ) {
                                                pos.css( "display" , "inline" );
                                            }
                                            
                                    });
                                    
                                    $.ajax({
                                        type: "GET",
                                        url: "https://graph.facebook.com/v2.4/",
                                        data: {
                                                    fields        : 'share{comment_count}' ,
                                                    id        : 'http://ttshow.tw/page-inner.php?page_id=' + getParameterByName("page_id")
                                        },
                                        success:function(data) {
                                                $( ".message c" ).html( data.share.comment_count );
                                        }
                                    });
                                    
                                </script>
                                
                                <div class="ad">
					<div class="desktop">
						<script async <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoo gle.js"></script>
						<!-- [PC] 內頁_內文下(左)_300x250 -->
						<ins class="adsbygoogle"
						style="display:inline-block;width:300px;height:250px" data-ad-region="content"; data-ad-client="ca-pub-4339897644150893"
						data-ad-slot="7776772167"></ins> <script>
						(adsbygoogle = window.adsbygoogle || []).push({}); </script>
					</div>

					<div class="desktop">
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoo gle.js"></script>
						<!-- [PC] 內頁_內文下(右)_300x250 -->
						<ins class="adsbygoogle"
						style="display:inline-block;width:300px;height:250px" data-ad-region="content"; data-ad-client="ca-pub-4339897644150893" data-ad-slot="9253505361"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({}); </script>
					</div>
				</div>
                                
				<div class="share">
					<div class="share-title">
						分享是對創作者最棒的支持
					</div>
					<ul class="share-icon">
						<li class="fb">
							<div class="fb-content">
								<a onclick="share_event()" style="cursor: pointer;">
									<img src="template_new/images/inner/association/fb.png">
									<span>立即分享</span>
								</a>
							</div>
						</li>
						<li class="line">
							<div class="line-content">
								<a href="javascript:;" onclick="window.open('http://line.naver.jp/R/msg/text/?'+fbhtml_url);return false;">
									<img src="template_new/images/inner/association/line.png">
									<span>立即分享</span>
								</a>
							</div>
						</li>
					</ul>
					<div class="like">
						<div class="like-icon">
							<ul class="like-icon-left">
								<li class="left-icon">
									<a href="javascript:;">
										<img src="template_new/images/inner/like/blue.png">
										<span>10k</span>
									</a>
								</li>
								<li class="right-icon">
									<a href="javascript:;">
										<img src="template_new/images/inner/like/green.png">
										<span>20k</span>
									</a>
								</li>
							</ul>
							<ul class="like-icon-right">
								<li class="left-icon">
									<a href="javascript:;">
										<img src="template_new/images/inner/like/yellow.png">
										<span>50k</span>
									</a>
								</li>
								<li class="right-icon">
									<a href="javascript:;">
										<img src="template_new/images/inner/like/red.png">
										<span>100k</span>
									</a>
								</li>
							</ul>
						</div>
                                                <div class="like-number1">
                                                    <div class="rainbow"></div>
                                                    <div class="cover"></div>
                                                    <div class="word">
                                                        讚力指數 <p now="share_count" style="display: inline;"></p>
                                                    </div>
                                                </div>
						<div class="like-explain">
							分享可累積讚力指數，就有機會登上熱門
						</div>
					</div>
				</div>
                                
				<div class="ad">
					<div class="desktop">
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoo gle.js"></script>
						<!-- [PC] 內頁_讚力指數下_728x90 -->
						<ins class="adsbygoogle"
						style="display:inline-block;width:728px;height:90px"
						data-ad-region="content"; data-ad-client="ca-pub-4339897644150893"
						data-ad-slot="1730238566"></ins> <script>
						(adsbygoogle = window.adsbygoogle || []).push({}); </script>
					</div>
					<div class="mobile">
						<script async src="//pagead2.googlesyndication.com/pagead/js/ adsbygoogle.js"></script>
						<!-- [M] 內頁_讚力指數下_300x250 -->
						<ins class="adsbygoogle"
						style="display:inline- block;width:300px;height:250px"
						data-ad-region="content"; data-ad-client="ca-pub-4339897644150893"
						data-ad-slot="7497570566"></ins> <script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
					</div>
				</div>
                                
				<div class="author-info">
					<div class="author-info-icon">
                                                <div class="bg_img"></div>
						<span class="author-info-name"></span>
					</div>
					<div class="author-info-intro">
						<p></p>
					</div>
					<ul class="author-info-link">
						<li>
							<a href="javascript:;">
								<img src="template_new/images/inner/author_info_icon/FB.png">
							</a>
						</li>
						<li>
							<a href="javascript:;">
								<img src="template_new/images/inner/author_info_icon/YOUBE.png">
							</a>
						</li>
						<li>
							<a href="javascript:;">
								<img src="template_new/images/inner/author_info_icon/G.png">
							</a>
						</li>
						<li>
							<a href="javascript:;">
								<img src="template_new/images/inner/author_info_icon/TW.png">
							</a>
						</li>
						<li>
							<a href="javascript:;">
								<img src="template_new/images/inner/author_info_icon/share.png">
							</a>
						</li>
					</ul>
				</div>
                                
                                <div id="board" class="widget-box" style="display:none;">
                                    <div class="widget-header">
                                        <h4 class="widget-title lighter smaller">
                                                <i class="ace-icon fa fa-comment blue"></i>
                                                Conversation
                                        </h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <div class="dialogs">

                                            </div>
                                            <div class="form-actions">
                                                <div class="input-group">
                                                    <input id="board_text" type="text" placeholder="Type your message here ..." class="form-control" name="message">
                                                    <span class="input-group-btn">
                                                            <button id="board_send" class="btn btn-sm btn-info no-radius" type="button">
                                                                    <i class="ace-icon fa fa-share"></i>
                                                                    Send
                                                            </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
				<div class="more">
                                        <div class="ad">
						<div class="mobile">
							<script async src="//pagead2.googlesyndication.com/pagead/js/a dsbygoogle.js"></script>
							<!-- [M] 內頁_文章列表(1)_300x250 --> <ins class="adsbygoogle"
							style="display:inline- block;width:300px;height:250px"
							data-ad-region="content"; data-ad-client="ca-pub-4339897644150893"
							data-ad-slot="2927770166"></ins> <script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
					</div>
					<div class="related more-list">
						<div class="more-list-title">相關</div>
                                                <div id="pageabout" class="more-list-content">
                                                    <div class="list" style="visibility: hidden;">
                                                        <a href="inner.php?page_id=1728">
                                                            <div name="responsive_div">
                                                                <div style="background-image: url('http://www.ooxxoox.com/ttshow/web/data/1728/ThumbnailM/pagicon.jpg'); "></div>
                                                            </div>
                                                            <div class="info">
                                                                <h3 title="催淚圖文創作「狗與鹿」 描繪寵物與主人的深刻情感">催淚圖文創作「狗與鹿」 描繪寵物與主人的深刻情感</h3>
                                                                <p class="view">
                                                                    <img src="template_new/images/inner/view.png">
                                                                    <span>353</span>
                                                                </p>
                                                            </div>
                                                            <div class="list-icon"></div>
                                                        </a>
                                                    </div>
                                                </div>
					</div>
                                        <div class="ad">
						<div class="mobile">
							<script async src="//pagead2.googlesyndication.com/pagead/js/a dsbygoogle.js"></script>
						<!-- [M] 內頁_文章列表(2)_300x250 --> <ins class="adsbygoogle"
						style="display:inline- block;width:300px;height:250px"
						data-ad-region="content"; data-ad-client="ca-pub-4339897644150893"
						data-ad-slot="4404503363"></ins> <script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
						</div>
					</div>
					<div class="hot more-list">
						<div class="more-list-title">熱門</div>
						<div id="pagehot" class="more-list-content">
                                                    
						</div>
					</div>
				</div>
                                <div id="loading_icon" class="loading" name="load_img" style="visibility: hidden;"></div>
			</div>
                        <div class="content-right">
				<div class="ad">
					<div class="desktop">
						<script async src="//pagead2.googlesyndication.com/pagead /js/adsbygoogle.js"></script>
						<!-- [PC] 內頁_內文右上_300x600 -->
						<ins class="adsbygoogle"
						style="display:inline- block;width:300px;height:600px" data-ad-region="content";
						data-ad-client="ca-pub- 4339897644150893"
						data-ad-slot="4962906561"></ins> <script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
					</div>
				</div>
                                <div class="place" style="float: left;">
				</div>
				<div class="ad">
					<div class="desktop">
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoo gle.js"></script>
						<!-- [PC] 內頁_內文右中_300x250 -->
						<ins class="adsbygoogle"
						style="display:inline-block;width:300px;height:250px" data-ad-region="content"; data-ad-client="ca-pub-4339897644150893"
						data-ad-slot="6300038964"></ins> <script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
					</div>
				</div>
                                <div class="fixed-area">
					<div class="fb-page" data-href="https://www.facebook.com/TaiwanTalentShow" data-width="351" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/TaiwanTalentShow"><a href="https://www.facebook.com/TaiwanTalentShow"></a></blockquote></div></div>
					<div class="ad-Bottom">
						<!-- <img src="template_new/images/inner/myad.png"> -->
						<div class="desktop">
							<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoo gle.js"></script>
							<!-- [PC] 內頁_內文右下_300x600 -->
							<ins class="adsbygoogle"
							style="display:inline-block;width:300px;height:600px"
							data-ad-region="content"; data-ad-client="ca-pub-4339897644150893"
							data-ad-slot="3206971766"></ins> <script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
					</div>
				</div>
                                
			</div>
		</main>
                <div class="pop-item">
                        <?php include( "tmp_mobile.php"); ?>
                        <div class="association-link-all">
                                <div class="association-link-all-content">
                                        <a class="association-link-closeBtn" href="javascript:;">
                                                <span></span>
                                        </a>
                                        <div class="link-content">
                                                <p class="link-content-title">分享這則創作</p>
                                                <ul class="link-content-icon">
                                                        <li class="fb">
                                                                <a onclick="share_event()" style="cursor: pointer;">
                                                                        <i class="fa fa-facebook"></i>
                                                                </a>
                                                        </li>
                                                        <li class="google">
                                                                <a onclick="window.open('https://plus.google.com/share?url=' + fbhtml_url );return false;" style="cursor: pointer;">
                                                                        <i class="fa fa-google-plus"></i>
                                                                </a>
                                                        </li>
                                                        <li class="line">
                                                                <a href="javascript:;" onclick="window.open('http://line.naver.jp/R/msg/text/?'+fbhtml_url);return false;">
                                                                        <img src="template_new/images/inner/association/line.png">
                                                                </a>
                                                        </li>
                                                        <li class="sina">
                                                                <a href="javascript:;" onclick="window.open('http://v.t.sina.com.cn/share/share.php?title=' + fbhtml_url + '&url='+fbhtml_url);return false;" >
                                                                        <img src="template_new/images/inner/association/sina.png">
                                                                </a>
                                                        </li>
                                                        <li class="whatsapp">
                                                                <a href="javascript:;" onclick="window.open('whatsapp://send?text='+fbhtml_url);return false;">
                                                                        <i class="fa fa-whatsapp"></i>
                                                                </a>
                                                        </li>
                                                        <li class="tumblr">
                                                                <a href="javascript:;" onclick="window.open('http://tumblr.com/widgets/share/tool?canonicalUrl='+fbhtml_url);return false;">
                                                                        <i class="fa fa-tumblr"></i>
                                                                </a>
                                                        </li>
                                                        <li class="twitter">
                                                                <a href="javascript:;" onclick="window.open('https://twitter.com/intent/tweet?source=webclient&amp;text='+fbhtml_url);return false;">
                                                                        <i class="fa fa-twitter"></i>
                                                                </a>
                                                        </li>
                                                        <li class="plurk">
                                                                <a href="javascript:;" onclick="window.open('http://www.plurk.com/?qualifier=shares&amp;status='+fbhtml_url);return false;">
                                                                        <img src="template_new/images/inner/association/plurk.png">
                                                                </a>
                                                        </li>
                                                        <li class="mail">
                                                                <a href="javascript:;" target="_blank" onclick="location.href = 'mailto:?body=' + $.page_data.title + '%0D%0A' + fbhtml_url ">
                                                                        <img src="template_new/images/inner/association/mail.png">
                                                                </a>
                                                        </li>
                                                        <li class="collaboration">
                                                                <a href="javascript:;">
                                                                        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" style="height: 40px; width: 23px;" id="copybutton" align="middle">
                                                                                <param name="movie" value="ClipboardButton-master/flash/copybutton.swf" />
                                                                                <param name="quality" value="high" />
                                                                                <param name="bgcolor" value="#ffffff" />
                                                                                <param name="play" value="true" />
                                                                                <param name="loop" value="true" />
                                                                                <param name="wmode" value="transparent" />
                                                                                <param name="scale" value="noscale" />
                                                                                <param name="menu" value="false" />
                                                                                <param name="devicefont" value="false" />
                                                                                <param name="salign" value="l" />
                                                                                <!-- This is the variable here in the Value parameter -->
                                                                                <param name="FlashVars" value="fvars=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" />
                                                                                <!-- Don't forget to change the one that isn't for IE -->
                                                                                <param name="allowScriptAccess" value="sameDomain" />
                                                                                <!--[if !IE]>-->
                                                                                <object type="application/x-shockwave-flash" data="ClipboardButton-master/flash/copybutton.swf" style="height: 40px; width: 23px;">
                                                                                        <param name="movie" value="ClipboardButton-master/flash/copybutton.swf" />
                                                                                        <param name="quality" value="high" />
                                                                                        <!-- Change the variable here also. -->
                                                                                        <param name="FlashVars" value="fvars=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" />
                                                                                        <!-- All set! -->
                                                                                        <param name="bgcolor" value="#ffffff" />
                                                                                        <param name="play" value="true" />
                                                                                        <param name="loop" value="true" />
                                                                                        <param name="wmode" value="transparent" />
                                                                                        <param name="scale" value="noscale" />
                                                                                        <param name="menu" value="false" />
                                                                                        <param name="devicefont" value="false" />
                                                                                        <param name="salign" value="l" />
                                                                                        <param name="allowScriptAccess" value="sameDomain" />
                                                                                <!--<![endif]-->
                                                                                        <a href="http://www.adobe.com/go/getflash">
                                                                                                <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
                                                                                        </a>
                                                                                <!--[if !IE]>-->
                                                                                </object>
                                                                                <!--<![endif]-->
                                                                        </object>
                                                                </a>
                                                        </li>
                                                </ul>
                                        </div>
                                        <a class="association-link-cancelBtn" href="javascript:;">
                                                取消
                                        </a>
                                </div>
                        </div>
                </div>
	</div>
        
        
        <script>
                
                $( "#myModalShare input" ).val( location.href );
                
                $( "#myModalReport .send" ).bind( "click" , function(){
                        
                        $.ajax({
                                    type: "POST",
                                    url: "php/report.php",
                                    data: {
                                            email       : $.member.email ,
                                            page        : getParameterByName("page_id") ,
                                            report      : $( "[name=report]:checked" ).val() ,
                                            text        : $( "#report_text" ).val()
                                    },
                                    success: function( data ) {
                                            
                                            console.log( data );
                                            if( data === "success" )
                                                alert( "success" );
                                            else if( data === "false" )
                                                alert( "false" );
                                            
                                            $( "#myModalReport" ).modal("toggle");
                                    }
                        });
                });
        </script>
        
        <!--script>!function(d,s,id){var js,ajs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://secure.assets.tumblr.com/share-button.js";ajs.parentNode.insertBefore(js,ajs);}}(document, "script", "tumblr-js");</script-->
        
        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>
        <script src="template/assets/js/bootstrap.js"></script>

        <script src="template/assets/js/jquery-ui.js"></script>
        <script src="template/assets/js/jquery.ui.touch-punch.js"></script>

        <!--link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" /-->
        <!--link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" /-->

        <!--script type="text/javascript">
                ace.vars['base'] = '..';
        </script-->
        
        <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>
        
        <script src="js/ajaxq.js"></script>

        <script type="text/javascript">
                jQuery(function($) {

                        //jquery tabs
                        $( "#tabs" ).tabs().show();
                });
        </script>
        
        <script type="text/javascript">
                
                $.ajax({
                            type: "POST",
                            url: "php/addone.php",
                            data: {
                                        article_id    : getParameterByName("page_id")
                            },
                            //dataType: "json",
                            success: function(data) {
                                    
                                    console.log( data );
                                    
                            }
                });
                
                $("document").ready(function() {
                    
                        //$( "#loadingpage" ).hide();
                        getbody();
                        
                });
                
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            
                            $.Scroll_Event = [];
                            
                            user_getbody();
                            
                            //use_gettab_author( "recommendation" );
                            $( "#tab3" ).children( ".tab" ).children( "button[type=recommendation]" ).trigger("click");
                            
                            console.log( $(".fb-share-button") );
                            
                            //abin edit 2015.4.27 ++ 
                            Add_History();
                            //abin edit 2015.4.27 --
                };
                
                function FB_unconnected_callback_init()
                {
                            console.log( "FB_unconnected_callback_init" );
                            $.member = { facebook_mail : "" , email : "" };
                            
                            $.Scroll_Event = [];
                            
                            user_getbody();
                            
                            //use_gettab_author( "recommendation" );
                            $( "#tab3" ).children( ".tab" ).children( "button[type=recommendation]" ).trigger("click");
                            
                            console.log( $(".fb-share-button") );
                            
                            
                };

        </script>
        <script src="js/fb-login.js"></script>
        
        <script type="text/javascript">
            function Add_History() {
                    if( $.member.email != "" ) {
                            var callback = function( data ) {
                                console.log( data );
                            };
                            $.ajax({
                                        type: "POST",
                                        url: "php/manage_history.php",
                                        data: {
                                                cmd         : "add" ,
                                                data : {
                                                    email        : $.member.email ,
                                                    page        : getParameterByName("page_id") ,
                                                }
                                        },
                                        success: callback ,
                                        error: callback
                            });
                    }
            }
        </script>
</body>

</html>