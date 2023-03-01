<?php
//    debug(getCurrentUserId(),1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="stepinnsolution">
    <meta name="keyword" content="admin, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="<?php echo base_url('assets/admin'); ?>/img/favicon.html">
    <title>Administrator</title>

    <link rel="icon" type="image/png" href="<?php echo getWebsiteFavicon(); ?>" />

    <!-- ************************************************************************ !-->
    <!-- *****                                                              ***** !-->
    <!-- *****       ï¿½ Designed and Developed by  StepInnSolution  ï¿½        ***** !-->
    <!-- *****               http://www.stepinnsolution.com                     ***** !-->
    <!-- *****                                                              ***** !-->
    <!-- ************************************************************************ !-->
    <!-- Bootstrap core CSS -->
    <script type="text/javascript"> var jqv_ajax_url = '<?php echo base_url(); ?>';</script>
    <link href="<?php echo base_url('assets/admin'); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin'); ?>/css/bootstrap-reset.css" rel="stylesheet">
    <!-- <link href="<?php //echo base_url('assets/admin'); ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--external css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend'); ?>/css/custom.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin'); ?>/css/custom-admin.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-fileupload/bootstrap-fileupload.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"/>

    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-datepicker/css/datepicker.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-timepicker/compiled/timepicker.css"/>
    <link rel="stylesheet" type="text/css"
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-datetimepicker/css/datetimepicker.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/admin'); ?>/assets/jquery-multi-select/css/multi-select.css"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/jquery.datetimepicker.css'); ?>">

    <link href="<?php echo base_url('assets/admin'); ?>/assets/jquery-file-upload/css/jquery.fileupload-ui.css"
          rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin'); ?>/css/style-responsive.css" rel="stylesheet"/>

    <script src="<?php echo base_url('assets/admin/js/jquery-1.11.1.js'); ?>" type="text/javascript"></script>
    <!-- FANCYBOX CSS -->
    <link href="<?php echo base_url('assets/admin/fancybox/source/jquery.fancybox.css'); ?>" rel="stylesheet"/>

    <!-- For menu sorting-->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/nestable'); ?>/jquery.nestable.css"/>

    <!-- For color picker-->

    <!--For uploader-->
    <script src="<?php echo base_url('assets/admin/upload_js'); ?>/jquery.uploadify.min.js"
            type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/upload_js'); ?>/uploadify.css">

    <!--For Events-Calendar-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/eventcalendar/css/eventCalendar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/eventcalendar/css/eventCalendar_theme_responsive.css">
    <script src="<?php echo base_url(); ?>assets/admin/eventcalendar/js/jquery.eventCalendar.js" type="text/javascript"></script>

    <!-- FANCYBOX JS -->
    <script src="<?php echo base_url('assets/admin/fancybox/source/jquery.fancybox.js'); ?>"></script>
    <script src="http://jwpsrv.com/library/SML16CF4EeSERCIACyaB8g.js"></script>
    <script src="<?php echo base_url('assets/admin/js/jquery.datetimepicker.js'); ?>" type="text/javascript"
            charset="utf-8"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/admin/js/html5shiv.js"></script>
    <script src="assets/admin/js/respond.min.js"></script>
    <![endif]-->

    <script src="//cdn.ckeditor.com/4.5.4/standard/ckeditor.js"></script>
    <!-- <script src="//cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script> -->

</head>

<body>

<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">

        <div class="sidebar-toggle-box">
            <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
        </div>

        <!--logo start-->
        <a href="<?php echo base_url('admin/dashboard'); ?>" class="logo"><img width="200" src="<?php echo getWebsiteLogo(); ?>"><span> <!--Admin--></span></a>
        <!--logo end-->

        <div class="top-nav ">
            <ul class="nav pull-right top-menu">

                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img style="margin-right: 5px;" alt="Profile Image" width="30"
                             src="<?php echo get_admin_avatar(); ?>"/>
                        <span class="username"> <?php print_r($this->session->userdata('admin_username')); ?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li><a href="<?php echo base_url('admin/profile'); ?>"><i class=" fa fa-user"></i>Profile</a>
                        </li>
                        <li><a href="<?php echo base_url('admin/settings'); ?>"><i
                                    class=" fa fa-wrench"></i>Settings</a></li>
                        <li><a href="<?php echo base_url(); ?>" target="_blank"><i
                                    class=" fa fa-mail-forward"></i>Website</a></li>
                        <li><a href="<?php echo base_url('admin/admin_logout'); ?>"><i class="fa fa-key"></i> Log
                                Out</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
        </div>
    </header>
    <!--header end-->