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

?>

<?php echo $main_color ?>;

<style>

    html,
    body {
        width: 100%;
        height: 100%;
    }

    body {
        font-family: Lato, Arial, sans-serif;
    }

    hr {
        max-width: 50px;
        border-color: <?php echo $main_color ?>;
        border-width: 3px;
    }

    hr.light {
        border-color: #fff;
    }

    a {
        color: <?php echo $main_color ?>;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    a:hover,
    a:focus {
        color: <?php echo $main_color ?>;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif;
    }

    p {
        margin-bottom: 20px;
        font-size: 16px;
        line-height: 1.5;
    }

    .bg-primary {
        background-color: <?php echo $main_bg_color ?>;
    }

    .bg-dark {
        color: #fff;
        background-color: #222;
    }

    .text-faded {
        color: rgba(255, 255, 255, .7);
    }

    section {
        padding: 100px 0;
    }

    aside {
        padding: 50px 0;
    }

    .no-padding {
        padding: 0;
    }

    .navbar-default {
        border-color: rgba(34, 34, 34, .05);
        font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif;
        background-color: #fff;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    .navbar-default .navbar-header .navbar-brand {
        text-transform: uppercase;
        font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif;
        font-weight: 700;
        color: #f05f40;
    }

    .navbar-default .navbar-header .navbar-brand:hover,
    .navbar-default .navbar-header .navbar-brand:focus {
        color: #eb3812;
    }

    .navbar-default .nav > li > a,
    .navbar-default .nav > li > a:focus {
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 700;
        color: #222;
    }

    .navbar-default .nav > li > a:hover,
    .navbar-default .nav > li > a:focus:hover {
        color: #f05f40;
    }

    .navbar-default .nav > li.active > a,
    .navbar-default .nav > li.active > a:focus {
        color: #f05f40 !important;
        background-color: transparent;
    }

    .navbar-default .nav > li.active > a:hover,
    .navbar-default .nav > li.active > a:focus:hover {
        background-color: transparent;
    }

    @media (min-width: 768px) {
        .navbar-default {
            border-color: rgba(255, 255, 255, .15);
            background-color: transparent;
        }

        .navbar-default .navbar-header .navbar-brand {
            color: rgba(255, 255, 255, .7);
        }

        .navbar-default .navbar-header .navbar-brand:hover,
        .navbar-default .navbar-header .navbar-brand:focus {
            color: #fff;
        }

        .navbar-default .nav > li > a,
        .navbar-default .nav > li > a:focus {
            color: rgba(255, 255, 255, .7);
        }

        .navbar-default .nav > li > a:hover,
        .navbar-default .nav > li > a:focus:hover {
            color: #fff;
        }

        .navbar-default.affix {
            border-color: rgba(34, 34, 34, .05);
            background-color: #fff;
        }

        .navbar-default.affix .navbar-header .navbar-brand {
            font-size: 14px;
            color: #f05f40;
        }

        .navbar-default.affix .navbar-header .navbar-brand:hover,
        .navbar-default.affix .navbar-header .navbar-brand:focus {
            color: #eb3812;
        }

        .navbar-default.affix .nav > li > a,
        .navbar-default.affix .nav > li > a:focus {
            color: #222;
        }

        .navbar-default.affix .nav > li > a:hover,
        .navbar-default.affix .nav > li > a:focus:hover {
            color: #f05f40;
        }
    }

    header {
        position: relative;
        width: 100%;
        min-height: auto;
        text-align: center;
        color: #fff;
        background-image: url(../img/header.jpg);
        background-position: center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
    }

    header .header-content {
        position: relative;
        width: 100%;
        padding: 100px 15px;
        text-align: center;
    }

    header .header-content .header-content-inner h1 {
        margin-top: 0;
        margin-bottom: 0;
        text-transform: uppercase;
        font-weight: 700;
    }

    header .header-content .header-content-inner hr {
        margin: 30px auto;
    }

    header .header-content .header-content-inner p {
        margin-bottom: 50px;
        font-size: 16px;
        font-weight: 300;
        color: rgba(255, 255, 255, .7);
    }

    @media (min-width: 768px) {
        header {
            min-height: 100%;
        }

        header .header-content {
            position: absolute;
            top: 50%;
            padding: 0 50px;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        header .header-content .header-content-inner {
            margin-right: auto;
            margin-left: auto;
            max-width: 1000px;
        }

        header .header-content .header-content-inner p {
            margin-right: auto;
            margin-left: auto;
            max-width: 80%;
            font-size: 18px;
        }
    }

    .section-heading {
        margin-top: 0;
    }

    .service-box {
        margin: 50px auto 0;
        max-width: 400px;
    }

    @media (min-width: 992px) {
        .service-box {
            margin: 20px auto 0;
        }
    }

    .service-box p {
        margin-bottom: 0;
    }

    .portfolio-box {
        display: block;
        position: relative;
        margin: 0 auto;
        max-width: 650px;
    }

    .portfolio-box .portfolio-box-caption {
        display: block;
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 100%;
        text-align: center;
        color: <?php echo $secondary_color ?>;
        opacity: 0;
        background: <?php echo $main_bg_color ?>;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    .portfolio-box .portfolio-box-caption .portfolio-box-caption-content {
        position: absolute;
        top: 50%;
        width: 100%;
        text-align: center;
        transform: translateY(-50%);
    }

    .portfolio-box .portfolio-box-caption .portfolio-box-caption-content .project-category,
    .portfolio-box .portfolio-box-caption .portfolio-box-caption-content .project-name {
        padding: 0 15px;
        font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif;
    }

    .portfolio-box .portfolio-box-caption .portfolio-box-caption-content .project-category {
        text-transform: uppercase;
        font-size: 14px;
        font-weight: 600;
    }

    .portfolio-box .portfolio-box-caption .portfolio-box-caption-content .project-name {
        font-size: 18px;
    }

    .portfolio-box:hover .portfolio-box-caption {
        opacity: 1;
    }

    @media (min-width: 768px) {
        .portfolio-box .portfolio-box-caption .portfolio-box-caption-content .project-category {
            font-size: 16px;
        }

        .portfolio-box .portfolio-box-caption .portfolio-box-caption-content .project-name {
            font-size: 22px;
        }
    }

    .call-to-action h2 {
        margin: 0 auto 20px;
    }

    .text-primary {
        color: <?php echo $main_color ?>;
    }

    .no-gutter > [class*=col-] {
        padding-right: 0;
        padding-left: 0;
    }

    .btn-default {
        border-color: #fff;
        color: #222;
        background-color: #fff;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    .btn-default:hover,
    .btn-default:focus,
    .btn-default.focus,
    .btn-default:active,
    .btn-default.active,
    .open > .dropdown-toggle.btn-default {
        border-color: #ededed;
        color: #222;
        background-color: #f2f2f2;
    }

    .btn-default:active,
    .btn-default.active,
    .open > .dropdown-toggle.btn-default {
        background-image: none;
    }

    .btn-default.disabled,
    .btn-default[disabled],
    fieldset[disabled] .btn-default,
    .btn-default.disabled:hover,
    .btn-default[disabled]:hover,
    fieldset[disabled] .btn-default:hover,
    .btn-default.disabled:focus,
    .btn-default[disabled]:focus,
    fieldset[disabled] .btn-default:focus,
    .btn-default.disabled.focus,
    .btn-default[disabled].focus,
    fieldset[disabled] .btn-default.focus,
    .btn-default.disabled:active,
    .btn-default[disabled]:active,
    fieldset[disabled] .btn-default:active,
    .btn-default.disabled.active,
    .btn-default[disabled].active,
    fieldset[disabled] .btn-default.active {
        border-color: #fff;
        background-color: #fff;
    }

    .btn-default .badge {
        color: #fff;
        background-color: #222;
    }

    .btn-primary {
        border-color: #f05f40;
        color: #fff;
        background-color: #f05f40;
        -webkit-transition: all .35s;
        -moz-transition: all .35s;
        transition: all .35s;
    }

    .btn-primary.btn-sm.active {
        border: 1px solid <?php echo $btn_bg_color ?> !important;
        color: <?php echo $btn_bg_color ?>;
        background-color: <?php echo $btn_hover_color ?>;
    }

    .btn-primary.btn-sm.active:hover {
        border: 1px solid <?php echo $btn_bg_color ?> !important;
        color: <?php echo $btn_hover_color ?> !important;
        background-color: <?php echo $btn_bg_color ?> !important;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary.focus,
    .btn-primary:active,
    .btn-primary.active,
    .open > .dropdown-toggle.btn-primary {
        border-color: #ed431f;
        color: #fff;
        background-color: #ee4b28;
    }

    .btn-primary:active,
    .btn-primary.active,
    .open > .dropdown-toggle.btn-primary {
        background-image: none;
    }

    .btn-primary.disabled,
    .btn-primary[disabled],
    fieldset[disabled] .btn-primary,
    .btn-primary.disabled:hover,
    .btn-primary[disabled]:hover,
    fieldset[disabled] .btn-primary:hover,
    .btn-primary.disabled:focus,
    .btn-primary[disabled]:focus,
    fieldset[disabled] .btn-primary:focus,
    .btn-primary.disabled.focus,
    .btn-primary[disabled].focus,
    fieldset[disabled] .btn-primary.focus,
    .btn-primary.disabled:active,
    .btn-primary[disabled]:active,
    fieldset[disabled] .btn-primary:active,
    .btn-primary.disabled.active,
    .btn-primary[disabled].active,
    fieldset[disabled] .btn-primary.active {
        border-color: #f05f40;
        background-color: #f05f40;
    }

    .btn-primary .badge {
        color: #f05f40;
        background-color: #fff;
    }

    .btn {
        border: 1px solid transparent !important;
        border-radius: 5px;
        text-transform: uppercase;
        font-family: Lato, Arial;
        font-weight: normal;
        background: <?php echo $btn_bg_color ?>;
        color: <?php echo $btn_hover_color ?> !important;
    }

    .btn-xl {
        padding: 15px 30px;
    }

    ::-moz-selection {
        text-shadow: none;
        color: <?php echo $btn_hover_color ?>;
        background: #222;
    }

    ::selection {
        text-shadow: none;
        color: <?php echo $btn_hover_color ?>;
        background: #222;
    }

    img::selection {
        color: <?php echo $btn_hover_color ?>;
        background: 0 0;
    }

    img::-moz-selection {
        color: <?php echo $btn_hover_color ?>;
        background: 0 0;
    }

    body {
        webkit-tap-highlight-color: #222;
    }
	

</style>