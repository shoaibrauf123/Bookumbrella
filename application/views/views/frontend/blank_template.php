<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo getSettingValue('website_title'); ?></title>

        <link rel="icon" type="image/png" href="<?php echo getWebsiteFavicon(); ?>"/>

        <!-- ************************************************************************ !-->
        <!-- *****                                                              ***** !-->
        <!-- *****        Designed and Developed by  StepInnSolution         ***** !-->
        <!-- *****               http://www.stepinnsolution.com                     ***** !-->
        <!-- *****                                                              ***** !-->
        <!-- ************************************************************************ !-->

        <?php $layoutStyles = getActiveLayoutStyles();
        $layoutStylesQuery = http_build_query($layoutStyles); ?>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/bootstrap.min.css" type="text/css">

        <!-- Custom Fonts -->
        <link
            href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
            rel='stylesheet' type='text/css'>
        <link
            href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic'
            rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/font-awesome/css/font-awesome.min.css"
              type="text/css">

        <!-- Plugin CSS -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/animate.min.css" type="text/css">

        <!-- Custom CSS -->
        <link rel="stylesheet"
              href="<?php echo base_url('assets/frontend'); ?>/css/creative.php?<?php echo $layoutStylesQuery; ?>"
              type="text/css">
        <link rel="stylesheet"
              href="<?php echo base_url('assets/frontend'); ?>/css/style.php?<?php echo $layoutStylesQuery; ?>"
              type="text/css">
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/custom.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/style_dashbord.css" type="text/css">

        <!-- Range Slider CSS -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/range-slider/jslider.css"
              type="text/css">
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/range-slider/jslider.round.plastic.css"
              type="text/css">

        <!-- jQuery -->
        <script src="<?php echo base_url('assets/frontend'); ?>/js/jquery.js"></script>

    </head>
    <body>

        <?php $this->load->view($main_content); ?>


        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('assets/frontend'); ?>/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="<?php echo base_url('assets/frontend'); ?>/js/jquery.easing.min.js"></script>
        <script src="<?php echo base_url('assets/frontend'); ?>/js/jquery.fittext.js"></script>
        <script src="<?php echo base_url('assets/frontend'); ?>/js/wow.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url('assets/frontend'); ?>/js/creative.js"></script>

        <script type="text/javascript">

        </script>


    </body>

</html>