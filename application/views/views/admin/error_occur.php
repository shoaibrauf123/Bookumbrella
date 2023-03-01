<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>resources/img/favicon.html">

        <title>Error</title>

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



  <body class="body-404">

    <div class="container">

      <section class="error-wrapper">
          <i class="icon-404"></i>
            <?php
                if(isset($errors)){
                    echo $errors;
                }
            ?>
      </section>

    </div>


  </body>
</html>
