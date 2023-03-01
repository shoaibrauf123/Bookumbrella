<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>resources/img/favicon.html">

        <title>Forgot Password</title>

        <!-- ************************************************************************ !-->
        <!-- *****                                                              ***** !-->
        <!-- *****        Designed and Developed by  StepInnSolution          ***** !-->
        <!-- *****               http://www.stepinnsolution.com                     ***** !-->
        <!-- *****                                                              ***** !-->
        <!-- ************************************************************************ !-->

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin'); ?>/css/bootstrap-reset.css" rel="stylesheet">
        <!-- <link href="<?php //echo base_url('assets/admin'); ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet" /> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!--external css-->
        <!-- Custom styles for this template -->
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin'); ?>/css/style-responsive.css" rel="stylesheet"/>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-body">



        <div class="container">

            <?php $this->load->view('errors'); ?>

            <form id="forgotPassword" class="form-signin" action="<?php echo base_url('admin/confirm_password') ?>" method="post">
                <h2 class="form-signin-heading">Forgot Password ?</h2>
                <div class="login-wrap">
                    <input id="pass" type="password" class="form-control" name="pass" placeholder="Password" autofocus>
                    <input id="conf_pass" type="password" class="form-control" name="conf_pass" placeholder="Confirm Password">
                    <label class="checkbox">
                      <span class="pull-right">
                          <a href="<?php echo base_url('administrator'); ?>">Login?</a>
                        </span>
                    </label>
                    <button class="btn btn-lg btn-info btn-block" type="submit">Continue</button>
                </div>
            </form>

        </form>

    </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('assets/admin/js/jquery-1.11.1.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/bootstrap.min.js"></script>
    <!-- form validation script file -->
    <script type="text/javascript" src="<?php echo base_url('assets/admin'); ?>/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/admin'); ?>/js/form-validation-script.js"></script>

</body>

</html>
