<?php



header("Content-type: text/css; charset: UTF-8");



/* Layout styles from admin settings */



$main_color = isset($_GET['main_color']) ? $_GET['main_color'] : '#ff5b53';

$secondary_color = isset($_GET['secondary_color']) ? $_GET['secondary_color'] : '#ffffff';

$hover_color = isset($_GET['hover_color']) ? $_GET['hover_color'] : '#00a9e0';

$static_color = isset($_GET['static_color']) ? $_GET['static_color'] : '#00a9e0';



$main_bg_color = isset($_GET['main_bg_color']) ? $_GET['main_bg_color'] : '#ff5b53';

$secondary_bg_color = isset($_GET['secondary_bg_color']) ? $_GET['secondary_bg_color'] : '#f5f5f5';



$main_border_color = isset($_GET['main_border_color']) ? $_GET['main_border_color'] : '#e9e9e9';

$secondary_border_color = isset($_GET['secondary_border_color']) ? $_GET['secondary_border_color'] : '#eb3812';



$btn_bg_color = isset($_GET['btn_bg_color']) ? $_GET['btn_bg_color'] : '#ff5b53';

$btn_hover_color = isset($_GET['btn_hover_color']) ? $_GET['btn_hover_color'] : '#ffffff';



$header_top_text_color = isset($_GET['header_top_text_color']) ? $_GET['header_top_text_color'] : '#707070';

$header_top_lnks_color = isset($_GET['header_top_lnks_color']) ? $_GET['header_top_lnks_color'] : '#707070';

$header_menu_link_text_color = isset($_GET['header_menu_link_text_color']) ? $_GET['header_menu_link_text_color'] : '#ffffff';



$content_text_color = isset($_GET['content_text_color']) ? $_GET['content_text_color'] : '#000000';

$content_head_text_color = isset($_GET['content_head_text_color']) ? $_GET['content_head_text_color'] : '#000000';

$content_bolded_text_color = isset($_GET['content_bolded_text_color']) ? $_GET['content_bolded_text_color'] : '#000000';

$content_link_color = isset($_GET['content_link_color']) ? $_GET['content_link_color'] : '#ff5b53';



$footer_text_color = isset($_GET['footer_text_color']) ? $_GET['footer_text_color'] : '#686868';

$footer_head_text_color = isset($_GET['footer_head_text_color']) ? $_GET['footer_head_text_color'] : '#000000';

$footer_navigation_links_color = isset($_GET['footer_navigation_links_color']) ? $_GET['footer_navigation_links_color'] : '#686868';

$footer_bottom_text_color = isset($_GET['footer_bottom_text_color']) ? $_GET['footer_bottom_text_color'] : '#ffffff';

$footer_bottom_links_color = isset($_GET['footer_bottom_links_color']) ? $_GET['footer_bottom_links_color'] : '#ffffff';





?>

<?php echo $secondary_color ?>

;

<style>

    @font-face {

        font-family: 'fonts/Lato-Light';

        src: url('fonts/Lato-Light.eot'); /* IE9 Compat Modes */

        src: url('fonts/Lato-Light.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */ url('fonts/Lato-Light.woff2') format('woff2'), /* Super Modern Browsers */ url('fonts/Lato-Light.woff') format('woff'), /* Pretty Modern Browsers */ url('fonts/Lato-Light.ttf') format('truetype'), /* Safari, Android, iOS */ url('fonts/Lato-Light.svg#svgFontName') format('svg'); /* Legacy iOS */

    }



    @font-face {

        font-family: 'fonts/Lato-Bold';

        src: url('fonts/Lato-Bold.eot'); /* IE9 Compat Modes */

        src: url('fonts/Lato-Bold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */ url('fonts/Lato-Bold.woff2') format('woff2'), /* Super Modern Browsers */ url('fonts/Lato-Bold.woff') format('woff'), /* Pretty Modern Browsers */ url('fonts/Lato-Bold.ttf') format('truetype'), /* Safari, Android, iOS */ url('fonts/Lato-Bold.svg#svgFontName') format('svg'); /* Legacy iOS */

    }



    @font-face {

        font-family: 'fonts/Boogaloo';

        src: url('fonts/Boogaloo.eot'); /* IE9 Compat Modes */

        src: url('fonts/Boogaloo.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */ url('fonts/Boogaloo.woff2') format('woff2'), /* Super Modern Browsers */ url('fonts/Boogaloo.woff') format('woff'), /* Pretty Modern Browsers */ url('fonts/Boogaloo.ttf') format('truetype'), /* Safari, Android, iOS */ url('fonts/Boogaloo.svg#svgFontName') format('svg'); /* Legacy iOS */

    }

	

	    @font-face {

        font-family: 'fonts/Roboto-Bold';

        src: url('fonts/Roboto-Bold.eot'); /* IE9 Compat Modes */

        src: url('fonts/Roboto-Bold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */ url('fonts/Roboto-Bold.woff2') format('woff2'), /* Super Modern Browsers */ url('fonts/Roboto-Bold.woff') format('woff'), /* Pretty Modern Browsers */ url('fonts/Roboto-Bold.ttf') format('truetype'), /* Safari, Android, iOS */ url('fonts/Roboto-Bold.svg#svgFontName') format('svg'); /* Legacy iOS */

    }

	    @font-face {

        font-family: '../fonts/Roboto-Bold';

        src: url('../fonts/Roboto-Bold.eot'); /* IE9 Compat Modes */

        src: url('../fonts/Roboto-Bold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */ url('../fonts/Roboto-Bold.woff2') format('woff2'), /* Super Modern Browsers */ url('../fonts/Roboto-Bold.woff') format('woff'), /* Pretty Modern Browsers */ url('../fonts/Roboto-Bold.ttf') format('truetype'), /* Safari, Android, iOS */ url('../fonts/Roboto-Bold.svg#svgFontName') format('svg'); /* Legacy iOS */

    }



    .btn-success {

        font-family: lato, Arial;

        font-size: 13px;

        padding-left: 25px;

        padding-right: 25px;

    }



    .header-container .top_header {

        color: <?php echo $header_top_text_color ?>;

    }



    .header-container .top_header a {

        color: <?php echo $header_top_lnks_color ?>;

            color: #fff;

    line-height: 22px;

    }

    .header-container .top_header a i{

        color: #ff5b53;

    }

    .header-container .top_header a.btn{

        padding: 1px 10px;

        font-weight: normal;

        line-height: 18px;

    }

    .header-container .top_header a.btn i{ color: #fff; }

    .header-container .top_header a.btn:hover i{ color: #ff5b53; }

    .header-container .navbar .nav li a {

        color: <?php echo $header_menu_link_text_color ?>;

    }



    .main-content-cont,

    .main-content-cont p,

    .main-content-cont div,

    .main-content-cont .view_box_wt {

        color: <?php echo $content_text_color ?>;

    }



    .main-content-cont .dashbord_head,

    .main-content-cont .dashbord_head div {

        color: <?php echo $secondary_color ?> !important;

    }



    .main-content-cont a,

    .main-content-cont p a,

    .main-content-cont div a,

    .main-content-cont .view_box_wt a {

        color: <?php echo $content_link_color ?>;

    }



    .main-content-cont h1,

    .main-content-cont h2,

    .main-content-cont h3,

    .main-content-cont h4 {

        color: <?php echo $content_bolded_text_color ?> !important;

    }



    .footer-container .footer,

    .footer-container .footer p,

    .footer-container .footer div {

        color: <?php echo $footer_text_color ?>;

    }



    .footer-container .footer a,

    .footer-container .footer p a,

    .footer-container .footer div a {

        color: <?php echo $footer_navigation_links_color ?>;

    }



    .footer-container .footer h1,

    .footer-container .footer h2,

    .footer-container .footer h3,

    .footer-container .footer h4 {

        color: <?php echo $footer_head_text_color ?> !important;

    }



    .footer-container .footer_bottom,

    .footer-container .footer_bottom p,

    .footer-container .footer_bottom div {

        color: <?php echo $footer_bottom_text_color ?>;

    }



    .footer-container .footer_bottom a,

    .footer-container .footer_bottom p a,

    .footer-container .footer_bottom div a {

        color: <?php echo $footer_bottom_links_color ?>;

    }



    .btn:hover,

    .btn:focus,

    .btn-success:hover,

    .btn-success:focus,

    .btn-warning:hover,

    .btn-cart:hover {

        border: 1px solid <?php echo $btn_bg_color ?> !important;

        color: <?php echo $btn_bg_color ?> !important;

        background-color: <?php echo $btn_hover_color ?> !important;

    }



    .btn:active,

    .btn-success:active {

        border: 1px solid <?php echo $btn_bg_color; ?> !important;

        color: <?php echo  $btn_hover_color ?> !important;

        background-color: <?php echo $btn_bg_color  ?> !important;

    }



    .clear5 {

        clear: both;

        height: 5px;

    }

.price-tax {

    margin: 0 0 0 10px;

    text-align: left;

}

    .clear10 {

        clear: both;

        height: 10px;

    }



    .clear20 {

        clear: both;

        height: 20px;

    }

.clear-padding {

    padding: 0;

}

    .clear30 {

        clear: both;

        height: 30px;

    }



    .clear35 {

        clear: both;

        height: 35px;

    }



    a {

        outline: none !important;

    }

.toggle-btn{

	padding-left:20px;

	padding-right:53px;

}

    .top {

        background: <?php echo $secondary_bg_color ?>;

        background: #00489a;

        padding: 5px 0;

        /*border-bottom: solid 1px <?php echo $main_border_color ?>;*/

        /*font-family: Lato;*/

        color: #707070;

    }

    .top .phone-no{ font-family: Arial; margin: 0; line-height: 22px; font-size: 14px; color: #fff; }

    .top .phone-no i{ color: #ff5b53; }

    .top a {

        font-family: Lato, Arial;

        color: #707070;

    }



    .header {

        padding-top: 20px;

        padding-bottom: 20px;

        background: #00489a;

    }



    #custom-search-input {

        padding: 0px;

        /*border: solid 1px #e9e9e9;*/

        border-radius: 0px;

        background-color: #fff;

        font-size: 14px;

        border-radius: 5px !important;

        position: relative;

        margin-top: 6px;

    }

    #custom-search-input select{

        position: absolute;

        right: 52px;

        padding: 14px;

        border: solid 1px #e2e2e2;

        border-top: none;

        border-bottom: none;

    }

    #custom-search-input .btn_search {

        position: absolute;

        right: 0;

        top: 0;

        width: 52px;

        /*border-radius: 0 30px 30px 0;*/

    }

    #custom-search-input .btn_search:active, #custom-search-input .btn_search:focus {

        border-radius: 0;

    }



    #custom-search-input input {

        border: 0;

        box-shadow: none;

        font-size: 13px;

        font-family: Arial, Helvetica, sans-serif;

        color: <?php echo $main_color ?>;

        padding: 13px 18px;

            /*border-radius: 30px 30px 30px 30px;*/

    border:none !important;

        background-color:transparent !important;

    }



    .btn_search {

        background: <?php echo $static_color ?>;

        background: #3b0348;

    }

    .header-advance-search{

        margin-top: 11px;

        text-transform: none;

    }

    #custom-search-input button {

        background: none;

        box-shadow: none;

        border: 0;

        color: #fff;

        margin: 0;

        padding: 8px 15px;

    margin: 0;

    border-radius: 0 21px 21px 0;

    }



    #custom-search-input button:hover {

        border: none !important;

        box-shadow: none;

        border-radius: 0 !important;

        /*border-radius: 0 30px 30px 0;*/

    }



    #custom-search-input .glyphicon-search {

        font-size: 22px;

    }



    .favourite_icon {

        background: #3c3c3c;

        border-radius: 50%;

        width: 46px;

        height: 46px;

        margin-top: 5px;

    }



    .favourite_icon span {

        font-size: 23px;

        margin-left: 11px;

        margin-top: 12px;

        color: #fff;

    }



    .navbar-default .nav > li > a:hover, .navbar-default .nav > li > a:focus:hover {

        background: <?php echo $hover_color ?>;

        background: #fff;

    }



    .navbar {

        border-radius: 0px;

    }



    .navi_top {

        background: <?php echo $main_bg_color; ?>;

        background: #4b2354;

    box-shadow: none;

    }



    .navi_top li a {

        padding-right: 30px;

        padding-left: 30px;

        color: <?php echo $header_menu_link_text_color; ?> !important;

        font-family: Lato, Arial;

        font-weight: normal !important;

    }

    .navi_top li a:hover { color: #ff5b53 !important; }



    .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:hover {

        background: <?php echo $hover_color ?>;

        color: <?php echo $secondary_color ?> !important;

    }



    .dropdown-menu {

        background: <?php echo $main_bg_color ?>;

    }



    .dropdown-menu li {

        background: <?php echo $main_bg_color ?>;

    }



    .nav_mobile {

        display: none !important;

    }



    .dropdown-menu li a {

        color: #fff;

        padding: 10px !important;

    }



    .dropdown-menu li a:hover {

        color: <?php echo $main_bg_color ?> !important;

        background-color: <?php echo $hover_color ?> !important;

    }



    .divider {

        margin: 0px !important;

    }



    .carousel-control.left {

        background: none;

    }



    .icon-prev {

        left: 0 !important;

        margin-left: 0px !important;

    }



    .icon-next {

        right: 0 !important;

        margin-right: 0px !important;

    }



    .carousel-control.right {

        background: none;

    }



    .carousel-control .icon-prev::before {

        content: inherit !important;

    }



    .carousel-control .icon-next::before {

        content: inherit !important;

    }



    .carousel-control .icon-next::before {

        content: inherit !important;

    }



    .carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right, .carousel-control .icon-next, .carousel-control .icon-prev {

        font-size: 0;

    }



    .icon-next img {

        margin-left: -6px;

    }



    .signup_bonus {

        position: absolute;

        top: 0;

        text-align: center;

        font-family: lato, Arial;

        font-size: 35px;

        color: #000;

        width: 100%;

        text-transform: uppercase;

    }



    .signup_bonus2 {

        font-family: Boogaloo, Arial;

        font-size: 51px !important;

        color: #fff;

        width: 100%;

        text-transform: uppercase;

        margin: 0;

        padding: 0;

    }



    .latest_offer {

        font-family: Boogaloo, Arial;

        font-size: 31px !important;

        color: #fff;

        width: 100%;

        text-transform: uppercase;

        margin: 0;

        padding: 0;

        position: absolute;

        top: 0;

        text-align: left;

        padding-left: 10px;

        width: 100% !important;

        padding-top: 8px;

    }



    .hdg_bg {

        font-family: Boogaloo, Arial;

        font-size: 24px;

        color: #ff5b53;

        width: 100%;

        text-transform: uppercase;

        padding: 6px;

        width: 100%;

        background: #fff;

        border-bottom: solid 1px <?php echo $main_border_color ?>;

    }



    .hdg_bg span {

        color: <?php echo $content_head_text_color ?>;

    }



    .box_1 {

        background: #eff8ff;

        border: solid 1px #b2dafc;

        font-family: Arial;

        color: #000;

        font-family: 14px;

        padding: 10px;

        margin-bottom: 10px;

    }



    .box_1 h2 {

        color: #000;

        font-family: 24px;

        font-family: Lato, Arial;

        font-weight: bold;

        text-transform: uppercase;

        margin: 10px;

        margin-left: 0;

    }



    .box_1 h3 {

        color: #e75456;

        font-family: 18px;

        font-family: Arial;

        font-weight: bold;

        text-transform: uppercase;

        width: auto;

        float: left;

        margin: 0;

    }



    .box_1 h4 {

        color: #45484a;

        font-family: 14px;

        font-family: Arial;

        font-weight: bold;

        text-transform: uppercase;

        width: auto;

        float: left;

        margin: 0;

        margin-left: 15px;

        margin-top: 3px;

        text-decoration: line-through;

    }



    .pdg_leftnone {

        padding-left: 0px;

    }



    .pdg_rightnone {

        padding-right: 0px;

    }



    .pdg_box {

        padding: 0px;

    }



    .box_2 {

        background: #fff3f2;

        border: solid 1px #ffc7c4;

        font-family: Arial;

        color: #000;

        font-family: 14px;

        padding: 10px;

        margin-bottom: 10px;

    }



    .box_2 h2 {

        color: #000;

        font-family: 24px;

        font-family: Lato, Arial;

        font-weight: bold;

        text-transform: uppercase;

        margin: 10px;

        margin-left: 0;

    }



    .box_2 h3 {

        color: #e75456;

        font-family: 18px;

        font-family: Arial;

        font-weight: bold;

        text-transform: uppercase;

        width: auto;

        float: left;

        margin: 0;

    }



    .box_2 h4 {

        color: #45484a;

        font-family: 14px;

        font-family: Arial;

        font-weight: bold;

        text-transform: uppercase;

        width: auto;

        float: left;

        margin: 0;

        margin-left: 15px;

        margin-top: 3px;

        text-decoration: line-through;

    }



    .box_3 {

        background: #f2f2f2;

        border: solid 1px #dfdfdf;

        font-family: Arial;

        color: #000;

        font-family: 14px;

        padding: 10px;

        margin-bottom: 10px;

    }



    .box_3 h2 {

        color: #000;

        font-family: 24px;

        font-family: Lato, Arial;

        font-weight: bold;

        text-transform: uppercase;

        margin: 10px;

        margin-left: 0;

    }



    .box_3 h3 {

        color: #e75456;

        font-family: 18px;

        font-family: Arial;

        font-weight: bold;

        text-transform: uppercase;

        width: auto;

        float: left;

        margin: 0;

    }



    .box_3 h4 {

        color: #45484a;

        font-family: 14px;

        font-family: Arial;

        font-weight: bold;

        text-transform: uppercase;

        width: auto;

        float: left;

        margin: 0;

        margin-left: 15px;

        margin-top: 3px;

        text-decoration: line-through;

    }



    .view_box {

        border: solid 1px <?php echo $main_border_color ?>;

        background: #f8f8f8;

        font-family: Lato, Arial;

        color: #6e6e6e;

        width: 214px;

        text-align: center;

        float: left;

        margin-left: 25px;

        margin-bottom: 25px;

    }



    .view_box:first-child {

        margin-left: 0 !important

    }



    .view_box_wt {

        background: #fff;

        padding: 15px;

        font-family: Lato, Arial;

        color: #6e6e6e;

    }



    .pdg_15 img {

        width: 130px;

        height: 140px;

    }



    .view_box_wt h2 {



        color: <?php echo $content_bolded_text_color ?>;

        font-size: 16px;

        margin: 0px;

    }



    .shop_now {

        background: #ff5b53;

        border-radius: 20%;

        text-align: center;

        color: #fff;

        padding: 10px;

        width: 120px;

        height: 32px;

        display: block;

    }



    .mrg_left25 {

        margin-left: 0px;

    }



    .crl_red {

        color: #ff5b53;

    }



    .pdg_15 {

        padding: 15px;

    }



    .gurnate_box {

        border: solid 1px <?php echo $main_border_color ?>;

        background: #fff;

        font-family: Lato, Arial;

        color: #6e6e6e;

        text-align: left;

        padding: 20px;

        margin-bottom: 10px;

    }



    .gurnate_box h2 {



        font-family: Lato, Arial;

        color: #525252;

        font-weight: normal;

        font-size: 40px;

        margin: 0px;



    }



    .gurnate_box h3 {



        font-family: Lato, Arial;

        color: #333333;

        font-weight: bold;

        font-size: 35px;

        margin: 0px;



    }



    .info_box {

        background: <?php echo $static_color ?>;

        font-family: Lato, Arial;

        color: #fff;

        text-align: left;

        padding: 10px;

        width: 218px;

        border-radius: 5px;

        border: none;

        font-size: 16px;

        text-transform: uppercase;

        margin-left: 19px;

        float: left;

        margin-bottom: 20px;

        height: 58px;

        color: <?php echo $secondary_color ?> !important;

    }

.hght_slider

{

	height:300px;

}

#myCarousel .carousel-inner .item img

{

	width:100%;

	height:300px;

}





.carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right, .carousel-control .icon-next, .carousel-control .icon-prev

{

	margin-top:-50px;

}

.img_height

{

	width:94px !important;

	height:140px !important;

}

 

.image.col-sm-12.image_product

{

	background-color:transparent !important;

}

.product-col.list.product_col_sepration .caption h4

{

	font-size:1.4rem;

	 font-family:  Roboto, Arial;

	 font-weight:bold;

    white-space: normal !important;

    height: 31px !important;

}

.caption .author

{

		font-size:1.4rem;

		 font-family: Roboto, Arial;

		 	 font-weight:normal;



}

.product-col.list.product_col_sepration .price-tax span

{

		font-size:1.7rem !important;

		 font-family: Roboto, Arial;

		 font-weight:normal;

		 border:none !important;

}





 body {

      font-family: 'Roboto', sans-serif;

    }

    .info_box span {

        float: right;

        margin-top: 8px;

        text-align: left;

        width: 74%;



    }



    .mrg_left19 {

        margin-left: 0px;

    }



    .footer {

        background: <?php echo $secondary_bg_color ?>;

        border-top: solid 1px <?php echo $main_border_color ?>;

    }



    .footer_1 {



        float: left;

        font-family: Lato, Arial;

        color: #686868;

        text-align: left;

        width: 260px;

        margin-bottom: 10px;

    }



    .footer_1 h2 {



        float: left;

        font-family: Lato, Arial;

        color: #000000;

        text-align: left;

        font-size: 16px;

        text-transform: uppercase;

    }



    .footer_1 a {



        float: left;

        font-family: Lato, Arial;

        color: #686868;

        text-align: left;

        font-size: 12px;

        text-transform: uppercase;

        clear: both;

        line-height: 25px;

    }



    .footer_right {



        float: left;

        font-family: Lato, Arial;

        color: #686868;

        text-align: left;

    }



    .footer_right h2 {



        float: left;

        font-family: Lato, Arial;

        color: #000000;

        text-align: left;

        font-size: 16px;

        text-transform: uppercase;

        margin-bottom: 10px;

    }



    .footer_social {

        border-bottom: solid 1px <?php echo $main_border_color ?>;

        border-top: solid 1px <?php echo $main_border_color ?>;

        padding-top: 17px;

        padding-bottom: 17px;

        font-family: Lato, Arial;

        color: #000000;

        font-size: 16px;

        text-transform: uppercase;

    }



    /* footer social icons */

    ul.social-network {

        list-style: none;

        display: inline;

        margin-left: 0 !important;

        padding: 0;

    }



    ul.social-network li {

        display: inline;

        margin: 0 5px;

    }



    /* footer social icons */

    .social-network a.icoFacebook:hover {

        background-color: #448ccb;

    }



    .social-network a.icoTwitter:hover {

        background-color: #33ccff;

    }



    .social-network a.icoGoogle:hover {

        background-color: #BD3518;

    }



    .social-network a.icoVimeo:hover {

        background-color: #0590B8;

    }



    .social-network a.icoLinkedin:hover {

        background-color: #ff5b53;

    }



    .social-network a.icoRss:hover i, .social-network a.icoFacebook:hover i, .social-network a.icoTwitter:hover i,

    .social-network a.icoGoogle:hover i, .social-network a.icoVimeo:hover i, .social-network a.icoLinkedin:hover i {

        color: #fff;

    }



    a.socialIcon:hover, .socialHoverClass {

        color: #44BCDD;

    }



    .social-circle li a {

        display: inline-block;

        position: relative;

        margin: 0 auto 0 auto;

        -moz-border-radius: 50%;

        -webkit-border-radius: 50%;

        border-radius: 0%;

        text-align: center;

        width: 35px;

        height: 35px;

        font-size: 20px;

    }



    .social-circle li i {

        margin: 0;

        line-height: 35px;

        text-align: center;

    }



    .social-circle li a:hover i, .triggeredHover {

        -moz-transform: rotate(360deg);

        -webkit-transform: rotate(360deg);

        -ms--transform: rotate(360deg);

        transform: rotate(360deg);

        -webkit-transition: all 0.2s;

        -moz-transition: all 0.2s;

        -o-transition: all 0.2s;

        -ms-transition: all 0.2s;

        transition: all 0.2s;

    }



    .social-circle i {

        color: #fff;

        -webkit-transition: all 0.8s;

        -moz-transition: all 0.8s;

        -o-transition: all 0.8s;

        -ms-transition: all 0.8s;

        transition: all 0.8s;

    }



    .iconf {

        background: #448ccb;

    }



    .icong {

        background: #ed1c24;

    }



    .iconin {

        background: #7da7d9;

    }



    .icony {

        background: #cc181e;

    }



    .icont {

        background: #00bff3;

    }



    .footer_bottom {

        background: <?php echo $main_bg_color ?>;

        font-family: Lato, Arial;

        color: <?php echo $secondary_color ?>;

        text-align: left;

        font-size: 14px;

        text-transform: uppercase;

        padding: 15px;

        background: #00489a;

    }



    .footer_bottom a {

        font-family: Lato, Arial;

        color: <?php echo $secondary_color ?>;

        text-align: left;

        font-size: 14px;

        text-transform: uppercase;

        padding: 15px;

    }



    .product-filter {

        margin-bottom: 15px;

        overflow: auto;

        padding: 10px 0;

        border-top: dotted 1px <?php echo $main_border_color ?>;

        border-bottom: dotted 1px <?php echo $main_border_color ?>;

    }



    .product-compare {

        float: left;

        font-weight: bold;

        margin-top: 4px;

        padding-left: 15px;

    }



    .product-filter .limit {

        float: right;

        margin-left: 15px;

        margin-top: 2px;

    }



    select {

        background: #ffffff none repeat scroll 0 0;

        border-color: #dfdfdf #efefef #efefef #dfdfdf;

        border-radius: 2px;

        border-style: solid;

        border-width: 1px;

        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) inset;

        height: auto;

        padding: 3px;

        width: auto;

    }



    .product-col.list .image {



        padding: 0px;

        text-align: center;

    }



    .product-col.list .image img {

/*        min-height: 140px;*/

        min-height: 57px;

        max-height: 140px;

        display: inline-block;

    }



    .store-col .caption {

        padding: 0px 0;

    }



    .product-col.product_col_sepration {

        border: 1px dotted #e9e9e9;

        margin-bottom: 25px;

        margin-right: 5px;

        padding: 5px 5px 20px;

        width: 24%;

        box-shadow: -1px 13px 20px -22px #000000;

    }



    .home-prod-data-cont .product-col.product_col_sepration {

        margin: 0 2px 25px 3px;

        padding: 5px 5px 20px;

        width: 13.9%;

    }



    .product_col_sepration.product-col .price, .product_col_sepration.product-col .cart-button {

        text-align: center;

        font-family: Lato, Arial;

    }



    .product_col_sepration .caption .limit-prod-thumb-desc {

        text-align: center;

        font-family: Lato, Arial;

    }



    .image.col-sm-12.image_product {

        background-color: #f6f6f6;

        float: left;

        padding: 10px !important;

    }



    .product-col.list.clearfix.col-sm-3.product_col_sepration:hover {

        background: #f7f7f7 none repeat scroll 0 0;

        transition: all .3s ease-out;

        box-shadow: 0 2px 10px 0 #B7B5B5;



    }



    .image_product .img-responsive {

        max-height: auto !important;

        min-height: 200px !important;

    }



    .product-col.list.product_col_sepration .caption h4 {

     font-family: Lato,Arial;

    font-size: 14px;

    font-weight: bold;

    margin: 10px 0 0 10px;

    overflow: hidden;

	text-align:center; 

    text-overflow: ellipsis;

    white-space: nowrap;

    }



    .product-col.list.product_col_sepration .price-tax span {

        border-top: 1px solid #ddd;

        font-weight: 100;

        padding-top: 7px;

        font-family: Lato, Arial;

    }



    .product-col .caption h4 {

        margin-top: 0;

        text-overflow: ellipsis;

        white-space: nowrap;

        overflow: hidden;

    }



    .product-listing-cont .product-col .caption h4 {

        text-align: center;

    }



    .limit-product-title-to-single-line {

        margin-top: 0;

        text-overflow: ellipsis;

        white-space: nowrap;

        overflow: hidden;

        min-height: 20px;

    }



    .product-col .caption .description {

        margin-bottom: 3px;

    }



    .product-col .price {

        padding: 14px 0;

    }



    .product-col .cart-button {

        padding-top: 3px;

    }



    .product-col.list .image {

        float: left;

        padding: 0 20px 10px 0;

    }



    .product-col.list .image img {

        /*min-height: 140px;*/

        min-height: 57px;

        max-height: 140px;

    }



    .product-col .caption {

        padding: 0;

        min-height: 9.4vh;

    }



    .product-col .caption h4 {

        margin-top: 0;

        text-overflow: ellipsis;

        white-space: nowrap;

        overflow: hidden;

    }



    .product-col .caption .description {

        margin-bottom: 3px;

    }



    .product-col .price {

        padding: 14px 0;

    }



    .product-col .cart-button {

        padding-top: 3px;

    }



    .listing-block-separator {

        border-bottom: dotted 1px <?php echo $main_border_color ?>;

        margin: 35px 0;

        clear: both;

        height: 25px;

    }



    .price-tax {

        color: <?php echo $main_color ?> !important;

    }



    .nav-border-left {

        padding: 0px 10px 0 10px;

        border-left: 1px solid <?php echo $main_border_color ?>;

        border-left: solid 1px #2b1430;

    }



    .frontend-dashboard-cont .cashback-block .history-table thead {

        background-color: <?php echo $main_bg_color ?>;

        color: <?php echo $secondary_color ?>;

    }



    .banner_img {

        margin-left: 24px;

    }



    .banner_img > img {

        display: inline-block;

        height: 52px;

        width: 100%;

    }



    .listing_header span {

        color: #ff5b53;

        padding: 4px;

    }



    .listing_header {

        text-align: center;

    }



    .listing_header h2 {

        margin-top: 0;

    }



    .listing_header a:hover {

        color: #CCC;

        text-decoration: none;

    }



    .bottom-note-txt {

        font-size: 13px;

    }



    .main-content-cont {

        min-height: 25vh;

    }



    .add-payment-method-cont button.accordion {

        background-color: <?php echo $secondary_color ?>;

        border: 1px solid <?php echo $main_color ?>;

        color: <?php echo $main_color ?>;

        padding: 10px 20px;

    }



    .add-payment-method-cont button.accordion:hover,

    .add-payment-method-cont button.accordion:active,

    .add-payment-method-cont button.accordion.active {

        background-color: <?php echo $main_color ?> !important;

        color: <?php echo $secondary_color ?> !important;

    }



    .add-payment-method-cont div.panel {

        border-top: 0;

        border-color: <?php echo $main_color ?>;

        margin-bottom: 10px !important;

        border-radius: 0 !important;

    }



    .pdg_15.align_img {

        display: table-cell;

        height: 200px;

        text-align: center;

        vertical-align: middle;

        width: 212px;

        padding: 5px;

    }



    .pdg_15.align_img img {

        text-align: center;

        width: 70%;

        height: auto;

    }

    .cd-accordion-menu ul li label,.cd-accordion-menu ul li a{

        color: #3A3A3A !important;

    }



    .alpha-filter-cont ul{

        list-style: none;

        padding-left: 0;

    }

    .alpha-filter-cont ul li{

        display: inline-block;

        padding: 3px 7px;

        font-size: 12px;

        background-color: <?php echo $main_bg_color;?>;

        color: <?php echo $secondary_color;?>;

        border-radius: 4px;

        border: 1px solid <?php echo $main_bg_color;?> ;

        cursor: pointer;

        margin-bottom: 7px;

    }

    .alpha-filter-cont ul li a{

        color: inherit;

        text-decoration: none;

    }

    .alpha-filter-cont ul li:hover, .alpha-filter-cont ul li.active{

        background-color: <?php echo $secondary_color; ?>;

        color: <?php echo $main_bg_color;?> ;

        border-color: <?php echo $main_bg_color;?> ;

    }



    .scrollable-table-head thead{

         display: table-caption;

        border-bottom: 2px solid #ddd;

     }

    .scrollable-table-head thead tr th{

        border-bottom: 0 !important;

    }

    .scrollable-table-thead thead tr th:last-child{

        padding-right: 17px;

    }

    .scrollable-table-body-cont{

        max-height: 300px;

        overflow: auto;

        /*display: inline-block;*/

    }

    .scrollable-table-body tbody tr{

        /*display: inline-table;*/

        /*width: 100%;*/

    }





    @media (min-width: 768px) and (max-width: 1090px) {

        .img_signup {

            width: 204px;

        }



        .signup_bonus2 {

            font-size: 25px;

        }



        .signup_bonus2 {

            font-size: 26px !important;

        }



        .latest_offer {

            height: 90px;

            width: 202px;

            padding: 0px;

        }



        .latest_offer {

            font-size: 21px !important;



        }



        .gurnate_box h3 {

            font-size: 25px;

        }



        .gurnate_box h2 {

            font-size: 30px;



        }



        .view_box {

            background: #f8f8f8 none repeat scroll 0 0;

            border: 1px solid <?php echo $main_border_color ?> color: #6e6e6e;

            float: left;

            font-family: Lato, Arial;

            margin-bottom: 25px;

            margin-left: 10px;

            text-align: center;

            width: 175px;

        }



    }



    @media (min-width: 300px) and (max-width: 767px) {

		.social logo

		{

			margin-top:10px;

		}

        .mrg_left19 {

            margin-left: 19px;

        }



        .pdg_leftnone {

            padding-left: 15px;

        }



        .pdg_rightnone {

            padding-right: 15px;

        }



        .pdg_box {

            padding-left: 15px;

            padding-right: 15px;

        }



        .mrg_left25 {

            margin-left: 25px;

        }



        .view_box {

            border: solid 1px <?php echo $main_border_color ?> background: #f8f8f8;

            font-family: Lato, Arial;

            color: #6e6e6e;

            width: 94%;

            text-align: center;

            float: left;

            margin-left: 25px;

            margin-bottom: 25px;

        }



        .signup_bonus {

            text-align: left;

        }



        .img_signup {

            width: 204px;

        }



        .signup_bonus2 {

            font-size: 25px;

        }



        .signup_bonus2 {

            font-size: 26px !important;

        }



        .latest_offer {

            height: 148px;

            width: 202px;

            padding: 0px;

        }



        .latest_offer {

            font-size: 21px !important;



        }



        .display_none {

            display: none;

        }



        .mrg_left25 {

            margin-left: 9px;

        }



        .view_box {

            margin-left: 9px;

        }



        .mrg_res_top10 {

            margin-top: 10px;

        }



        #custom-search-input {

            margin-top: 10px;

        }



        .social {

            margin-top: 10px;
            text-align: center; 

        }
        .nav>li{
            text-align: center;
        }


        .icon-next img {

            margin-left: -17px;

        }



        .footer_right {

            width: 300px;

        }



        .container-fluid > .navbar-collapse, .container-fluid > .navbar-header, .container > .navbar-collapse, .container > .navbar-header {

            margin: 0px;

        }



        .social_header {

            right: 0 !important;

        }



        .product-col.product_col_sepration {

            width: 100%;

        }



        .cd-accordion-menu ul label::before {

            display: none;

            left: 8px;

        }



        .cd-accordion-menu label::before {

            top: 31px !important;

        }



        .pdg_15.align_img {

            display: inline-block;

            height: auto;

        }



        .pdg_15.align_img img {

            height: auto;

            text-align: center;

            width: 100%;

        }



        .product-col.list ,.product-col.list .image {

            width:100% !important;

        }

		 .btn-cart { 

    width: 100% !important;

}

.navbar-default .navbar-toggle .icon-bar {

    background-color: #ffffff !important;

}

.store_listing .product-col .caption {

    float: left !important;

    width: 100% !important;

} 

 .limit-store-thumb-desc { 

    min-height: auto !important; 

}

 .panel-footer { 

    padding: 10px 0 !important;

}

 .main-header { 

    text-align: center !important;

}

.main-content-cont, .main-content-cont p, .main-content-cont div, .main-content-cont .view_box_wt {

    color: #000000;

    text-align: center !important;

	width: 100% !important;

}		

.cart-button.button-group.pull-right > span {

    text-align: center !important;

    width: 100% !important;

}

.product-detail-heading {

    text-align: center !important;

    width: 100% !important;

}

.label_price {

    float: left !important;

    text-align: center !important;

    width: 100% !important;

}		

span label:first-child {

    text-align: center !important;

    width: 100% !important;

}		

.product-detail-page .nav-tabs { 

    width: 100% !important;

}		

.add-to-cart-btn {

    font-size: 15.5px !important;

}		

.form-control {

    margin-bottom: 5px !important;

    width: 100% !important;

}		

.cd-accordion-menu li {

    text-align: left !important;

}		

		

		

		

		

    }



    @media (min-width: 300px) and (max-width: 630px) {

        .social_header .pull-right {

            float: none !important;

        }



        .header-container .top_header {

            color: #707070;

            padding-bottom: 10px;

        }



        .product_mobile > .input-group {

            position: relative;

            top: 26px;

        }

    }



    /*24-02-2016*/

    .navbar-default .nav > li > a.active {

        background-color: <?php echo $hover_color ?>;

        background-color: #fff;

        color: #ff5b53 !important;

    }



    .footer_copy_right {

        /*margin-top: 9px;*/

    }



    .login_form {

        margin: 20px auto 30px;

        width: 600px;

    }



    .contact_body {

        margin-bottom: 40px;

    }



    footer.footer_contact {

        border: 1px solid #ddd;

        display: inline-block;

        width: 100%;

    }



    .reset_pass {

        border: 1px solid #ddd;

        display: inline-block;

    }



    .reset_pass {

        border: 1px solid #ddd;

        display: table;

        margin: 0 auto 30px;

        width: 600px;

    }



    .reset_pass .form-group, .reset_pass h2 {

        margin-left: 10px;

        margin-right: 10px;

    }



    footer.reset_btn {

        border-bottom: 0 none;

        bottom: -6px;

        position: relative;

    }



    .cd-accordion-menu-cont .section-title {

        background-color: <?php echo $main_bg_color ?> !important;

    }



    .store_listing .product-col{

        padding: 10px;

    }



    .store_listing .product-col:hover{

        background-color: #fff;

        transition: all .3s ease-out;

        box-shadow: 0 2px 10px 0 #fff;

    }



    .store_listing .listing-block-separator{

        margin: 15px 0 !important;

        height: 5px !important;

    }



    .store_listing .product-col .image{

        width: 18%;

    }



    .store_listing .product-col .caption{

        width: 82%;

        float: left;

    }



    @media (min-width: 991px) and (max-width: 1200px) {

        .navi_top li a {

            padding: 15px 25px;



        }



        .mrg_left19 {

            margin-left: 19px;

        }



        .deal_images .no-padding > img {

            width: 100%;

        }



        .login_form {

            margin-left: 22%;

            width: 600px;

        }



    }



    @media (min-width: 767px) and (max-width: 991px) {

		.input-group

		{

			width:100%;

		}

        .navi_top li a {

            padding: 15px 16px;



        }



        .pull-right.no-padding.social {

            padding: 0 10px 0;

        }



        .mrg_left19 {

            margin-left: 19px;

        }



        .product-col.list .image {

            padding: 0 3px 5px 2px;

            width: 100%;

        }



        .product-col .caption {

            padding: 0 3px 5px 2px;

            width: 100%;

        }



        .store_listing .product-col.list .image {

            padding: 0 3px 5px 2px;

            width: 280px;

        }



        .store_listing .product-col.list .caption p {

            margin-bottom: 0px;

        }



        .login_form {

            margin-left: 9%;

            width: 600px;

        }



        .img-rounded {

            margin: auto;

        }



        .pull-right.sep_img > img {

            width: 20px !important;

        }



        .cd-accordion-menu label::before {

            top: 41px !important;

        }

    }



    @media (min-width: 768px) and (max-width: 875px) {

        .navi_top li a {

            padding: 15px 17px;

        }



    }



    @media (min-width: 300px) and (max-width: 767px) {

        .nav_mobile {

            color: #fff;

            cursor: pointer;

            display: block !important;

            font-size: 13px;

            font-weight: 700;

            margin-bottom: 0;

            padding-bottom: 11px;

            padding-left: 18px;

        }

		.input-group

		{

			width:100%;

		}

.hght_slider {

    height: auto;

}

       .author {

    float: left;

    width: 50%;

}  

.price-tax {

    margin: 0 0 0 10px;

    text-align: right;

}

        .navbar-collapse.in {

            overflow-y: visible;

        }



        .navbar-nav {

            margin: 0;

        }



        .navi_top li a {

            padding-left: 15px;

        }



        .nav.navbar-nav li.dropdown a.dropdown-toggle {

            display: none !important;

        }



        .top_header {

            height: 77px;

        }



        .social_right {

            position: relative;

            top: -30px;

        }



        .navbar-nav > li > .dropdown-menu {

            width: 100%;

            /*display:block;*/

            /*  position: static;*/

            box-shadow: none;

            border: 0px;

        }



        .navbar-nav > li > .dropdown-menu li.divider {

            display: none;

        }



        .dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover {

            background-color: transparent;

            color: #fff !important;

        }



        .dropdown-menu > li > a:focus, .dropdown-menu > li:hover {

            background-color: #00a9e0;

            color: #fff;



        }



        .dropdown-menu > li > a:focus, .dropdown-menu > li {

            padding-left: 65px;

            color: #fff;

        }



        .footer_1,.footer_right{

            padding-left: 20px;

            width: 96% !important;
            display: flex;
    flex-direction: column;
    align-items: center;

        }



        .footer_right {
            
            padding-left: 20px;

        }



        .footer_social img.pull-right {

            padding: 13px 13px 0 0;

        }



        .product_select {

            float: right;

            width: 100px;

        }



        .store_listing .product-col.list .image {

            text-align: center;

            width: 100%;

            padding-right: 10px;

        }



        .store_listing .product-col.list .image .img-responsive {

            margin: auto;

        }



        .product_responsive .product-col.list .image {

            float: none;

            padding: 0 0 10px;

            0;

            text-align: center;

        }



        .product_responsive .image .img-responsive {

            display: inline-block;

        }



        .product-col .caption {

            margin-bottom: 20px;

            text-align: center;

        }



        /*.product_responsive .product-col.list .image { text-align:center; width:100%; padding-right:10px;}

        .product_responsive .product-col.list .image .img-responsive {

            margin: auto;

        }

        .product_responsive .product-col.list { margin-bottom:20px;}*/

        .store_listing .product-col.list.clearfix {

            margin-bottom: 20px;

        }



        .img-rounded {

            margin: auto;

        }



        .footer_bottom {

            text-align: center;

        }



        .footer_copy_right {

            text-align: center !important;

        }



        .store_listing .product-filter .limit {

            margin-top: 0;

        }



        .login_form, .reset_pass {

            width: 100%;

        }

		.header-input {

    float: left;

    width: 100%;

}

	#custom-search-input input { 

    width: 49.4%;

}	

	.toggle-btn {

    padding: 0;

}	

.navbar-nav {

    float: left;

    margin: 0;

    padding: 0 10px;

    width: 100%;

}

#myCarousel .carousel-inner .item img {

    height: auto;

    width: 100%;

}

 

.carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right, .carousel-control .icon-next, .carousel-control .icon-prev {

    margin-top: -25px;

}.carousel-control img {

    width: 25px;

}





		



    }



    @media (min-width: 630px) and (max-width: 767px) {

        .footer_img {

            position: relative;

            top: -10px;

        }



        .footer_top {

            height: 0;

        }



    }



    @media (min-width: 615px) and (max-width: 630px) {

        .social_right {

            float: none !important;

            position: relative;

            /*right: 36%;*/

            right: 0 !important;

            text-align: center;

            top: 0;

        }



        .social_left {

            float: none !important;

            text-align: center;

        }



        .top_header {

            height: auto;

        }



    }



    @media (max-width: 630px) and (min-width: 480px) {

        .social_right.login_mobile {

            right: 17%;

        }



        .pull-right.sep_img > img {

            width: 20px;

        }

    }



    @media (min-width: 300px) and (max-width: 615px) {

        /*.product-filter .pull-right {float:left !important;}*/

        .top_header {

            height: auto;

        }



        .social_right {

            float: none !important;

            position: relative;

            right: 36%;

            text-align: center;

            top: 0;

        }



        .social_left {

            float: none !important;

            text-align: center;

        }



        .product-compare {

            width: 200px;

        }



        .pull-right.no-padding.product_mobile {

            border-bottom: medium none !important;

            height: 125px !important;

            overflow: hidden;

        }



        .pull-right.product_check {

            float: left !important;

            position: relative;

            top: 55%;

            left: 0;

        }



        .product_check .control-label {

            padding-left: 0 !important;

            padding-right: 2px;

            font-weight: 500;

        }



        .check_btn {

            bottom: 0;

            float: right;

            position: relative;

            right: 37%;

            top: 75%;

        }



        .product-filter .limit {

            float: left;

            margin-right: 0;

            margin-left: 11px;

            margin-top: 2px;

            position: relative;

            width: 100%;

        }



        .sort.pull-right {

            float: left !important;

            left: 0;

            position: relative;

            top: 10px;

            width: 100%;

        }



        .sort.pull-right select, .product-filter .limit select {

            float: right;

            margin-right: 12px;

            width: 78%;

        }



        .footer_top {

            float: none !important;

            margin: auto;

            width: 342px;

        }



        .footer_img {

            float: none !important;

            margin: auto;

            width: 300px;

        }



        .product-filter.product_mobile {

            height: 111px;

            overflow: hidden;

        }

 

  

		

		

    }



    @media (max-width: 480px) {

        .nav_mobile {

            display: block !important;

            color: #fff;

            padding-left: 15px;

            margin-bottom: 0px;

            font-size: 13px;

            font-weight: 700;

        }



        .info_box {

            width: 91%;

        }



        ul.social-network li {

            margin: 0;

        }



        .footer_top {

            float: none !important;

            margin: auto;

            width: 300px;

        }



        .footer_img {

            float: none !important;

            margin: auto;

            width: 300px;

        }



        .gurnate_box h3 {

            font-size: 24px;

        }



        .social_right.login_mobile {

            font-size: 12px;

            right: 20%;

        }



        .pull-right.sep_img > img {

            width: 20px;

        }



        .profile_mobile {

            margin-bottom: 15px;

            width: 100%;

        }

    }



    @media (max-width: 440px) {

        .social_right.login_mobile {

            right: 15%;

        }



        .sort.pull-right select, .product-filter .limit select {

            float: right;

            margin-right: 12px;

            width: 78%;

        }



        .product-filter.product_mobile {

            height: 111px;

            overflow: hidden;

        }



    }



    @media (max-width: 360px) {

        .sort.pull-right select, .product-filter .limit select {

            float: right;

            margin-right: 12px;

            width: 78%;

        }



        .pull-right.no-padding.product_mobile {



            height: 185px !important;



        }



        .pull-right.product_check {

            top: 59%;

        }



        .product-filter.product_mobile {

            height: 111px;

            overflow: hidden;

        }



        .check_btn {

            bottom: 0;

            position: relative;

            right: 114px;

            top: 80%;



        }

    }



    @media (max-width: 340px) {

        .pull-right.product_check {

            left: 0;

        }



        .pull-right > img {

            width: 20px;

        }



        .social_right.login_mobile {

            right: 14%;

            font-size: 10px;

            left: -16px;

        }



        .social_right {

            right: 32%;

        }



        .check_btn {

            bottom: 0;

            position: relative;

            right: 100px;

            top: 83%;

        }



        .pull-right.product_check {

            top: 49%;

        }



        .pull-right.no-padding.product_mobile {

            height: 216px !important;

        }



    }



    @media (max-width: 320px) {

        .check_btn {

            top: 72%;

        }



    }



    /*11-3-2016*/

    .product_fillter {

        margin-top: -20px;

    }



    .product_fillter > h3 {

        background-color: #ff5b53;

        color: #fff;

        font-size: 20px;

        padding: 5px;

    }



    .product_fillter .panel-body > ul, .product_fillter > ul {

        padding-left: 0px;

    }



    .product_fillter > ul li, .product_fillter .panel-body > ul li {

        border-bottom: 1px solid #ddd;

        line-height: 30px;

        list-style: outside none none;

    }



    .product_fillter > ul li {

        border-bottom: 1px solid;

        line-height: 34px;

        list-style: outside none none;

        padding-left: 10px;

    }



    .product_fillter select {

        margin-top: 10px;

        width: 100%;

        margin-bottom: 25px;

    }



    .product_fillter hr {

        border-color: #eee;

        max-width: inherit;

        border: 1px;

    }



    .panel-body li {

        list-style: outside none none;

    }



    .panel-title .caret.pull-right {

        margin-top: 7px;

    }



    .panel_top.panel_show {

        display: block;

        transition: all 0.35s ease 0s;

    }



    .panel_top {

        display: none;

        transition: all 0.35s ease 0s;

        cursor: pointer;

    }



    .panel_bottom.panel_bottom_show {

        display: block;

        margin-top: 28px;

    }



    .panel_bottom {

        display: none;

    }



    .filter-toggler {

        cursor: pointer;

    }



    .filter-block {

        display: none;

    }



    .price-slider-cont {

        min-height: 10vh;

    }



    .filter-slider-control {

        display: block;

        margin-bottom: 15px;

    }

    .dashbord_inno_form{ border: 1px solid #000; padding: 20px;   margin: auto;}

    .dashbord_inno_form .form-group input[type=text]{ margin-top: 5px; }



    .dashbord_inno_form h3{ margin-top: 0; }



</style>

<style>

    .product-detail .main-header { margin: 15px 0; }

    .main-header { color: #093c5e !important; font-size: 20px; font-weight: 300; margin-bottom: 15px; }

    .pdppagetitle { color: #333333; font-family: Arial; font-size: 18px; font-weight: bold; line-height: 20px; }

    .PDP_itemList .PDP_col_deliveredBy { white-space: nowrap; width: 90px; }

    .PDP_itemList .PDP_col_sellerName { white-space: nowrap; width: 150px; }

    .PDP_itemList .PDP_col_sellerFeedback { width: 90px; }

    .PDP_itemList tr th { background-color: #ddd; border: medium none; font-size: 13px; font-weight: normal; height: 30px; text-align: left; }

	

    .PDP_itemList tr th, .PDP_itemList tr td { border-bottom: 1px solid #ddd; border-top: 1px solid #ddd; font-family: Tahoma, Geneva, sans-serif; font-size: 15px; height: 38px; padding: 10px 5px 10px 10px; }

	

	 .PDP_itemList tr th{  font-size: 16px; font-weight:bold;}

	 .finalprice{color:#600 !important; font-family: Arial; font-size: 18px; font-weight: bold; margin:0; margin-top:10px; }

	 .finalpricetshp{color: #000 !important; font-family: Arial; font-size: 14px; font-weight: bold;  margin:0;}

	

    .p-detail { color: #333333; font-family: Arial; font-size: 18px; font-weight: bold; line-height: 20px; }

    .pdplinks { color: #337ab7 !important; }

    section { padding: 0 15px !important; }

    .nav-tabs li a { color: #337ab7; }

    .nav-tabs li .active a { color: #555 !important; }

    .detail-page-right-column{ border: 1px solid #ddd; }

    .my-account-tab-btns{ border: solid 1px #f1f1f1; padding: 15px; clear: both; overflow: hidden; }

    .my-account-tab-btns ul{  padding: 0; margin: 0; }

    .my-account-tab-btns ul h2{ margin: 0 0 0 9px;

    font-size: 18px;

    text-align: center; }

    .my-account-tab-btns ul li{ float: left; list-style: none; width: 100%; padding: 8px; }

    .my-account-tab-btns ul li a{     background: #dd;

    float: left;

    width: 100%;

    border: 1px solid transparent !important;

    border-radius: 5px;

    text-transform: uppercase;

    font-family: Lato, Arial;

    background: #ddd;

    background: #ddd;

    color: #000 !important;

    padding: 5px 15px;

    text-align: center;

     }

     .my-account-tab-btns ul li a.active, .my-account-tab-btns ul li a:hover{ background: none; border: solid 1px #ff5b53 !important; color: #ff5b53 !important; text-decoration: none; }

     .pdplinks-p p{ margin-bottom: 5px; }

     .rec-wrapper-share-icons-row p{ margin: 5px 0 0 0; }

     .product-detail-page{ clear: both; overflow: hidden; }

     .product-detail-page .nav-tabs{ float: left; width: 150px; border: none;

        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f8f8f8+0,e6e6e6+100 */

        background: #f8f8f8; /* Old browsers */

        background: -moz-linear-gradient(left,  #f8f8f8 0%, #e6e6e6 100%); /* FF3.6-15 */

        background: -webkit-linear-gradient(left,  #f8f8f8 0%,#e6e6e6 100%); /* Chrome10-25,Safari5.1-6 */

        background: linear-gradient(to right,  #f8f8f8 0%,#e6e6e6 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */

        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#e6e6e6',GradientType=1 ); /* IE6-9 */

      }

     .product-detail-page .nav-tabs li{ float: left; width: 100%; }

     .product-detail-page .nav-tabs li a{ float: left; width: 100%; border: none; text-align: center; color: #3e79b3; padding: 20px 0; position: relative; }

     .product-detail-page .nav-tabs li a span{ display: none; }

     .product-detail-page .nav-tabs li.active a{ border: none; background: #d2d2d2;  }

     .product-detail-page .nav-tabs li.active a span{ display: block;/* background: url('../img/detail-arrow.png')*/; width: 52px; height: 60px; position: absolute; right: -52px; top: 0; }

     .product-detail-page .tab-content{ overflow: hidden;  /*border: solid 4px #d2d2d2; */padding: 20px 40px; }

     .detail-page-add-cart{ border: solid 1px #e2e2e2; padding: 25px; clear: both; overflow: hidden; }

     .detail-page-add-cart p{ float: left; margin: 0; font-size: 23px; }

     .detail-page-add-cart a{ float: right; }

     .clear{ clear: both;overflow: hidden; }

	 #custom-search-input .glyphicon-search {

    box-shadow: none !important;

    font-size: 20px;

    text-shadow: none !important;

}

</style>