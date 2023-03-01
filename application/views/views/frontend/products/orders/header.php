<?php
//    debug(getLayoutBannerImg(),1);
?>


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
    <!-- *****           Designed and Developed by  StepInnSolution          ***** !-->
    <!-- *****               http://www.stepinnsolution.com                     ***** !-->
    <!-- *****                                                              ***** !-->
    <!-- ************************************************************************ !-->

    <?php $layoutStyles = getActiveLayoutStyles();
    $layoutStylesQuery = http_build_query($layoutStyles); ?>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

    <!-- Custom Fonts -->
    <link
        href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel='stylesheet' type='text/css'>
    <link
        href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/animate.min.css" type="text/css">

    <!-- Range Slider CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/range-slider/jslider.css"
          type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/range-slider/jslider.round.plastic.css"
          type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('assets/frontend'); ?>/css/creative.php?<?php echo $layoutStylesQuery; ?>"
          type="text/css">
    <link rel="stylesheet"
          href="<?php echo base_url('assets/frontend'); ?>/css/style.php?<?php echo $layoutStylesQuery; ?>"
          type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/custom.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/style_dashbord.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/multi-level-accordian-menu.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/accordian.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/active-search.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend'); ?>/css/loader_css.css" type="text/css">
    <!--- Ratings CSS -->
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/src/rateit.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/example/content/bigstars.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/example/content/antenna.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/example/content/svg.css" rel="stylesheet" type="text/css">
<!-- syntax highlighter -->
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/example/sh/shCore.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/example/sh/shCoreDefault.css" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <!--<link rel="icon" href="<?= base_url('assets/frontend/img/') ?>/favicon.ico" type="image/gif">-->
    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script src="http://twitter.github.io/typeahead.js/js/handlebars.js"></script>


    <script>
        $(document).ready(function () {
            var suggestion_url = '<?php echo base_url("suggestion-search-ajax") ?>';
            var sug_cat = '';
            $("#category").change(function() {
                if($(this).val() != ''){
                    sug_cat = 'cat='+$(this).val()+'&';
                    $('#suggestion-search-container').html('<input type="text" name="search" class="suggestion-search tt-query" autocomplete="off" spellcheck="false" placeholder="Search for books by keyword / title / author / ISBN">');
                    var source = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        remote: {
                            url: suggestion_url+'?'+sug_cat+'key=%QUERY',
                            wildcard: '%QUERY'
                        }
                    });

                    source.initialize();

                    $('input.suggestion-search').typeahead(null, {
                        name: 'search',
                        displayKey: 'name',
                        source: source.ttAdapter(),
                        templates: {
                            empty: ['<p class="tt-suggestion tt-selectable"><a href="javascript:void(0);">No result found !</a></p>'].join('\n'),
                            suggestion: Handlebars.compile('<p><a href="{{link}}">{{name}}</a></p>')
                        }
                    });

                }else{
                    sug_cat = '';
                    $('#suggestion-search-container').html('<input type="text" name="search" class="suggestion-search tt-query" autocomplete="off" spellcheck="false" placeholder="Search for books by keyword / title / author / ISBN">');
                    var source = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        remote: {
                            url: suggestion_url+'?'+sug_cat+'key=%QUERY',
                            wildcard: '%QUERY'
                        }
                    });

                    source.initialize();

                    $('input.suggestion-search').typeahead(null, {
                        name: 'search',
                        displayKey: 'name',
                        source: source.ttAdapter(),
                        templates: {
                            empty: ['<p class="tt-suggestion tt-selectable"><a href="javascript:void(0);">No result found !</a></p>'].join('\n'),
                            suggestion: Handlebars.compile('<p><a href="{{link}}">{{name}}</a></p>')
                        }
                    });
                }
            });
            

            var source = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: suggestion_url+'?'+sug_cat+'key=%QUERY',
                    wildcard: '%QUERY'
                }
            });

            source.initialize();

            $('input.suggestion-search').typeahead(null, {
                name: 'search',
                displayKey: 'name',
                source: source.ttAdapter(),
                templates: {
                    empty: ['<p class="tt-suggestion tt-selectable"><a href="javascript:void(0);">No result found !</a></p>'].join('\n'),
                    suggestion: Handlebars.compile('<p><a href="{{link}}">{{name}}</a></p>')
                }
            });
        });
		
function RelevantTerms(){
		var user_type = $("#user_type").val();
		alert(user_type);
		if(user_type=='Buyer'){
			$("#div_seller").hide();
			$("#div_buyer").show();
			}else{
			$("#div_seller").show();
			$("#div_buyer").hide();	
				
				}
	}		
    </script>

    <script>
        var base_url = '<?php echo base_url()?>';
    </script>
    <style type="text/css">
	.row
	{
		margin:0px !important;
	}

        .layout-slider {
            padding: 10px;
            background: #f5f5f5;
        }

        #slider-3 .ui-slider-range {
            background: #3d3d3d;
        }

        #slider .ui-slider-range {
            background: #3d3d3d;
        }

        #max_price, #max_value {
            float: right;
        }

        .price_range {
            font-weight: bold;
            font-size: 10px;
            padding-bottom: 5px;
        }

        .price_range > span {
            font-weight: bold;
            font-size: 12px;
        }
		#custom-search-input input
		{
			padding:8px 18px;
			    border-radius: 5px;
		}
		#custom-search-input select
		{
			padding: 8px;
			line-height: 30px !important;
			border-left:0px !important;
		}
		#custom-search-input button
		{
    padding: 2px 14px;
    border-radius: 5px !important;
    background: #febd69;
    border-top-left-radius: 0px !important;
    border-bottom-left-radius: 0px !important;
	font-size:14px !important;
	color:#fff !important;
	height: 34px !important;
	width:54px !important;
		}
		#custom-search-input button:hover
			{
    padding: 2px 14px !important;
    border-radius: 5px !important;
    background: #febd69 !important;
    border-top-left-radius: 0px !important;
    border-bottom-left-radius: 0px !important;
	font-size:14px !important;
	color:#fff !important;
	height: 34px !important;
	width:54px !important;
		}
		.navbar-brand, .navbar-nav>li>a
		{
			text-shadow:none !important;
		}
		.navi_top li a
		{
			padding-left:20px;
			padding-right:20px;
			color:#ccc !important;
		}
		.navbar-default .nav > li > a, .navbar-default .nav > li > a:focus
		{
			font-size:12px;
			text-transform:inherit;
		}
		.header {
    padding-top: 10px;
    padding-bottom: 10px;
}
.navi_top
{
	margin-bottom:0px !important;
}
.navi_top
{
	background:#00489a;
	    border: solid 1px #00489a;
}
.drop_down_login
{
    float: right;
    margin-right: 20px;
    background: transparent;
    border: 0px !important;
    font-family: arial;
    font-size: 12px;
    box-shadow: none;
    margin-top: 5px;
}
#custom-search-input .btn_search
{

    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
#custom-search-input button:hover
{

    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
#custom-search-input
{
	margin-top:0px;
}
.navbar-default .nav > li > a.active
{
	background-color:transparent !important;
	font-family:Arial,sans-seriff !important;
	font-size:13px !important;
	color:#ccc !important;
}
.navbar-default .nav > li > a, .navbar-default .nav > li > a:focus
{
	background-color:transparent !important;
	font-family:Arial,sans-seriff !important;
	font-size:13px !important;
	color:#ccc !important;
}
#custom-search-input .glyphicon-search {
    font-size: 20px;
}
.navbar-default .nav > li > a:hover, .navbar-default .nav > li > a:focus:hover
{
	text-decoration:underline;
}
.btnaddcart 
{
	background-color:transparent !important;
	font-weight:bold !important;
    border: none !important;
    color: #fff !important;
}
.btnaddcart:hover
{
	background-color:transparent !important;
	font-weight:bold !important;
	border:none !important;
    border: none !important;
    color: #ccc !important
}
.container
{
	width:auto !important;
	padding:0px;
}
select
{
	box-shadow:none !important;
}


    </style>
</head>
<body>
    <div class="loading">Loading&#8230;</div>
<div class="header-container">
    <div class="col-xs-12 top top_header" style="display:none;">
        <div class="container">
            <div class="no-padding">
                <?php $link = $this->uri->segment(1); ?>

                <div class="col-sm-4 col-xs-12 pull-left no-padding social social_left" title="Call us now">
                    <p class="phone-no"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo getlanguage('call-us-now'); ?> : <?php echo getSettingValue('admin_contact'); ?></p>
                </div>

                <div
                    class="col-sm-8 col-xs-12 pull-right no-padding social social_right social_header <?php if ($this->session->userdata('logged_in')) {
                        echo 'login_mobile';
                    } ?>">



                    <?php if ($this->session->userdata('logged_in')) { ?>
                        <a href="<?php echo base_url('logout'); ?>" title="Logout"
                           class="pull-right nav-border-left">
<i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo getlanguage('logout'); ?></a>
                        <a href="<?php echo base_url('my_account'); ?>" title="Dashboard"
                           class="pull-right nav-border-left"><i class="fa fa-user" aria-hidden="true"></i> <?php echo getlanguage('my-account'); ?></a>
                        			<?php
            if($this->session->userdata('user_type')=='Seller'){
			?>
                        <a href="<?php echo base_url('add_inventory'); ?>" title="Add Inventory"
                           class="pull-right nav-border-left"><i class="fa fa-plus" aria-hidden="true"></i> Add Inventory</a>
                        <a href="<?php echo base_url('edit_inventory'); ?>" title="Edit Inventory"
                           class="pull-right nav-border-left"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Inventory</a>
             			<?php
			}
			?> 
              
                        <a href="<?php echo base_url('my_orders'); ?>" title="My Orders"
                           class="pull-right nav-border-left"><i class="fa fa-sort" aria-hidden="true"></i> My Orders</a>

                    <?php } else { ?>
                        <a href="<?php echo base_url('login'); ?>" title="Login"
                           class="pull-right nav-border-left"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo getlanguage('login'); ?></a>
                        <a href="<?php echo base_url('registration'); ?>" title="Registration"
                           class="pull-right nav-border-left"><i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo getlanguage('registration'); ?></a>
                    <?php } ?>

<?php



?>

                    <?php /*?><div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 col-xs-12 pull-left top-select-layout-cont">
                        <select id="set-layout" class="form-control pull-left">
                            <option value="">-- Choose Layout --</option>
                            <?php $layouts = getLayouts(); ?>
                            <?php if ($layouts) { ?>
                                <?php foreach ($layouts as $layout) { ?>
                                    <?php $active_layout = getSelectedLayout(); ?>
                                    <option
                                        value="<?php echo $layout['id']; ?>" <?php echo $active_layout == $layout['id'] ? 'selected' : ''; ?>><?php echo $layout['title']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div><?php */?>

                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xs-12 header">
        <div class="">
            <div class="no-padding">
                <div class="col-sm-2 col-xs-12 pull-left social logo">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/frontend/img/logo.png" style="margin-left:50px;" 
                                                             alt=""></a>
                </div>

                <div class="col-sm-8 col-xs-10  no-padding">
                    <div id="custom-search-input">
                        <form action="<?php echo base_url('products'); ?>" method="get">
                            <div class="input-group col-md-12">
<!--                                <input type="text" name="search" class="form-control input-lg" placeholder="Enter ISBN"-->
<!--                                       value="--><?php //echo ($this->input->get('search')) ? $this->input->get('search') : ''; ?><!--"/>-->
<!--                                <input type="hidden" name="sort_by"-->
<!--                                       value="--><?php //echo ($this->input->get('sort_by')) ? $this->input->get('sort_by') : ''; ?><!--"/>-->
<!--                                <input type="hidden" name="count"-->
<!--                                       value="--><?php //echo ($this->input->get('count')) ? $this->input->get('count') : '15'; ?><!--"/>-->
<!--                                <input type="hidden" name="store"-->
<!--                                       value="--><?php //echo ($this->input->get('store')) ? $this->input->get('store') : ''; ?><!--"/>-->
<!--                                <input type="hidden" name="cat"-->
<!--                                       value="--><?php //echo ($this->input->get('cat')) ? $this->input->get('cat') : ''; ?><!--"/>-->
<!--                                <input type="hidden" name="color"-->
<!--                                       value="--><?php //echo ($this->input->get('color')) ? $this->input->get('color') : ''; ?><!--"/>-->
<!--                                <input type="hidden" name="title"-->
<!--                                       value="--><?php //echo ($this->input->get('title')) ? $this->input->get('title') : ''; ?><!--"/>-->
<!--                                <input type="hidden" name="price"-->
<!--                                       value="--><?php //echo ($this->input->get('price')) ? $this->input->get('price') : '1%2C6200'; ?><!--"/>-->
<!--                                <input type="hidden" name="mfg"-->
<!--                                       value="--><?php //echo ($this->input->get('mfg')) ? $this->input->get('mfg') : ''; ?><!--"/>-->
<!--                                <input type="hidden" name="isbn"-->
<!--                                       value="--><?php //echo ($this->input->get('isbn')) ? $this->input->get('isbn') : ''; ?><!--"/>-->

                                <span id="suggestion-search-container"><input type="text" name="search" class="suggestion-search tt-query" autocomplete="off" spellcheck="false" placeholder="Search for books by keyword / title / author / ISBN"></span>
                                <?php
                                $this->load->model("comman_model");
									$categories = $this->comman_model->get("category",array());
									//print_r($categories);exit;
									//$categories = $categories[0];
								?>
                                
                                    <select name="cat" id="category">
                                    
                                    <option value="keyword" selected>By Keyword</option>
                                    <option value="isbn">By ISBN</option>
                                    <option value="title">By Title</option>
                                    <option value="author">By Author</option>
                                    <option value="publisher">By Publisher</option>
                                    </select>
                                <span class="input-group-btn btn_search">
                                    <button class="btn btn-info btn-lg " type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                  <!--<div class="col-sm-2 col-xs-12 pull-left social logo">
                    <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>assets/frontend/img/logo.png" style="margin-left:50px;" 
                                                             alt="">
             </a>
                </div>-->

			<?php
            //echo '<pre>';
			//print_r($this->session->all_userdata());
			if($this->session->userdata('user_type')=='Buyer'){
			?>

                <div class="col-sm-2 col-xs-3 pull-right no-padding social">
                    <div class="pull-right">
<a class="btn btn-cart header-advance-search" type="button" href="<?php echo base_url("add_store");?>" title="Become a Seller">Become a Seller</a>
                    </div>
                </div>
                
                <?php
			}
				?>
                
                
            </div>
            <div class="col-xs-12 col-md-12">
                <div class="row">
                    <div class="search-ctrl-cont col-xs-12 col-md-6">
<!--                        <input type="text" name="search" class="suggestion-search tt-query" autocomplete="off" spellcheck="false" placeholder="Search for books by keyword / title / author / ISBN">-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <nav class="navbar navbar-default navi_top" role="navigation">
        <div style="padding-left:20px; padding-right:20px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-slide-dropdown">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse no-padding" id="bs-slide-dropdown">
            
                <a class="btn btn-cart btnaddcart pull-right" type="button" href="<?php echo base_url("product/checkout"); ?>"
                       title="Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> US$&nbsp;<span id="totalCartValue"> <?php echo ($this->session->userdata('total') != '') ? $this->session->userdata('total') : '0.00'; ?></span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        <span id="totalCartItems"><?php echo ($this->session->userdata('totalCartItems') != '') ? $this->session->userdata('totalCartItems') : 0; ?></span> Items
                    </a>
                 

                <ul class="nav navbar-nav pull-right">
                    <li><a href="<?php echo base_url('home'); ?>"
                           class=" <?php if ($link == 'home' || $link == '') echo 'active'; ?>">Home</a></li>
                    <?php $top_categories = $this->comman_model->get('category', array('status' => 1, 'top_lavel' => 1));
                    if ($top_categories) {
                        foreach ($top_categories as $top_cat) { ?>
                            <li>
                                <a href="<?php echo base_url('products'); ?>?cat=<?php echo $top_cat['category_id']; ?>"
                                   class=""><?php echo ucwords($top_cat['title']); ?></a></li>
                        <?php }
                    }
                    ?>


                    <li><a href="<?php echo base_url('stores'); ?>"
                           class=" <?php if ($link == 'stores') echo 'active'; ?>"> Stores </a></li>


                    <?php
                    $all_pages = get('static_page', array('status' => 1));
                    $total = count($all_pages);
                    if ($total > 0) {
                        for ($i = 0; $i < $total; $i++) {
                            if ($i < 3) {
                                ?>
                                <li>
                                    <a href="<?php echo base_url('pages') . '/' . $all_pages[$i]['slug']; ?>"><?php echo $all_pages[$i]['title']; ?></a>
                                </li>
                            <?php }
                        }
                    }
                    ?>
<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user" aria-hidden="true"></i> 
        <?php
        if ($this->session->userdata('logged_in')) {
		echo $this->session->userdata('username');
		}else{
		?>
        Account
        <?php
		}
		?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu" style="z-index:999999;">
          
          <?php if ($this->session->userdata('logged_in')) { ?>
          <li><a href="<?php echo base_url('my_account'); ?>">Profile</a></li>
          <li><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
          <?php }else{
			  ?>
			  <li><a href="<?php echo base_url('login'); ?>">Login</a></li>
          <li><a href="<?php echo base_url('registration'); ?>">Signup</a></li>
			  <?php
			  } ?>
        </ul>
      </li>

                </ul>

         


            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="clearfix"></div>
</div>
<div class="main-content-cont">