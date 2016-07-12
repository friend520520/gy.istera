
<?php include( "window_size.php"); ?>

<header>
        <div class="header-top">
                <a id="menuBtn" href="javascript:;">
                        <span></span>
                </a>
                <h1>
                        <a class="logo" href="index.php">
                                <span>台灣達人秀</span>
                        </a>
                        <a class="subpage" href="#">
                                <span></span>
                        </a>
                </h1>
                <ul class="info-header">
                        <li class="search">
                                <a href="javascript:;">
                                        <span class="info-icon"></span>
                                </a>
                        </li>
                        <li class="sort">
                                <a href="news.php">
                                        <span class="info-icon"></span>
                                        <span class="info-name">動態</span>
                                </a>
                        </li>
                        <li class="publication">
                                <a href="javascript:;">
                                        <span class="info-icon">
                                                <svg version="1.2" baseProfile="tiny" id="圖層_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" xml:space="preserve">
                                                        <g></g>
                                                        <path fill="#FFFFFF" d="M61.8,43.1c0-5.5-9.6-5.5-9.6,0v13.4h9.6V43.1z"/>
                                                        <circle fill="#FFFFFF" cx="56.9" cy="34.4" r="4"/>
                                                        <path fill="#FFFFFF" d="M52.8,42.8c0-4.7-8.2-4.7-8.2,0v11.4h8.2V42.8z"/>
                                                        <circle fill="#FFFFFF" cx="48.7" cy="35.4" r="3.3"/>
                                                        <path fill="#FFFFFF" d="M45.2,42.7c0-3.8-6.7-3.8-6.7,0V52h6.7V42.7z"/>
                                                        <circle fill="#FFFFFF" cx="41.9" cy="36.6" r="2.7"/>
                                                        <path fill="#FFFFFF" d="M23.3,12.4v11c0,1.2-1,2.3-2.3,2.3H5.7c-1.2,0-2.3-1-2.3-2.3V8c0-1.2,1-2.3,2.3-2.3h12.5l1.5-1.5H4.5c-1.4,0-2.6,1.2-2.6,2.6v17.7c0,1.4,1.2,2.6,2.6,2.6h17.7c1.4,0,2.6-1.2,2.6-2.6V10.8L23.3,12.4z"/>
                                                        <polygon fill="#FFFFFF" points="23.3,1.8 10.8,14.3 8.8,21 15.5,19.1 28.1,6.5 "/>
                                                </svg>
                                        </span>
                                </a>
                        </li>
                        
                        <li class="user status_login" style="display: none;">
                                <a href="javascript:;">
                                        <div class="bg_img" style="" id="header_user_icon"></div>
                                        <span id="header_user_name" class="user-name"></span>
                                        <span class="info-name">▾</span>
                                </a>
                                <ul>
                                        <li>
                                                <a href="author_page.php">會員中心</a>
                                        </li>
                                        <li>
                                                <a id="FB_logout_btn" href="javascript:;">登出</a>
                                        </li>
                                </ul>
                        </li>
                </ul>
        </div>
        <?php include( "tabs_new.php"); ?>
</header>