</div>

<div class="footer-container">
    <div class="col-xs-12 no-padding footer">
        <div class="container">
            <div class="row no-padding">

                <div class="footer_1">
                    <h2 title="My Account"><?php echo getlanguage('my-account');?></h2>
                    <div class="clear10"></div>

                    <?php if($this->session->userdata('logged_in')) { ?>
                        <a href="<?php echo base_url('my_account'); ?>" title="Dashboard"><span class="glyphicon glyphicon-menu-right"></span><?php echo getlanguage('my-account');?></a>
                        
                        
                    <?php } else {?>
                        <a href="<?php echo base_url('login'); ?>" title="Login"><span class="glyphicon glyphicon-menu-right"></span><?php echo getlanguage('login');?></a>
                    <?php } ?>

                    <a href="<?php echo base_url('contact_us');?>" title="contact us"><span class="glyphicon glyphicon-menu-right"></span><?php echo getlanguage('contact-us');?> </a>
                </div>

                <div class="footer_1" >
                    <h2 title="Short links"><?php echo getlanguage('short_links');?></h2>
                    <div class="clear10"></div>
                    <?php
                    $all_pages = get('static_page',array('status'=>1));
                    $total = count($all_pages);
                    if($total >0){
                        for($i=0; $i< $total; $i++){ ?>
                            <a href="<?php echo base_url('pages').'/'.$all_pages[$i]['slug'];?>"><span class="glyphicon glyphicon-menu-right"></span><?php echo $all_pages[$i]['title'];?></a>
                        <?php }
                    }
                    ?>
                </div>

                

                <div class="footer_1">
                    <h2 title="Customer Services"><?php echo getlanguage('customer_service');?></h2>

                    <div class="clear10"></div>
                    <?php if($this->session->userdata('logged_in')) { ?>
                    <a href="<?php echo base_url('my_account'); ?>" title="Dashboard"><span class="glyphicon glyphicon-menu-right"></span><?php echo getlanguage('my-account');?></a>
                       
                    <?php } else {?>
                        <a href="<?php echo base_url('login'); ?>" title="Login"><span class="glyphicon glyphicon-menu-right"></span><?php echo getlanguage('login');?></a>
                    <?php } ?>
                    <a href="#" title="Order Tracking"><span class="glyphicon glyphicon-menu-right"></span><?php echo getlanguage('order-tracking');?></a>
                   
                    <a href="<?php echo base_url('contact_us');?>" title="Contact Us"><span class="glyphicon glyphicon-menu-right"></span><?php echo getlanguage('contact-us');?></a>
                </div>

                <div class="footer_right">
                    <h2 Contact us><?php echo getlanguage('contact-us');?></h2>

                    <div class="clear10"></div>
                    <div class="col-sm-3" title="Address"> <?php echo getlanguage('address');?>: </div>
                    <div class="col-sm-9" title="Admin address"><?php echo getSettingValue('admin_address'); ?></div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3"  title="Phone number"><?php echo getlanguage('phone-number'); ?>: </div>
                    <div class="col-sm-9" title="Admin Contact"><?php echo getSettingValue('admin_contact'); ?></div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" title="Fax"> <?php echo getlanguage('fax');?>: </div>
                    <div class="col-sm-9"><?php echo getSettingValue('admin_fax'); ?></div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" title="Email"> <?php echo getlanguage('email');?>: </div>
                    <div class="col-sm-9"><?php echo getSettingValue('info_email'); ?></div>

                </div>

                <div class="clear20"></div>

                


                <div class="clear20"></div>


            </div>
        </div>
    </div>

    <div class="col-xs-12 no-padding footer_bottom">
        <div class="container">
            <div class="row no-padding">


                <div class="col-sm-8 col-xs-12 no-padding">
                    <!-- <div class="clear10"></div> -->
                    <a href="<?php echo base_url('home');?>" title="Home"><?php echo getlanguage('home');?></a> | <a href="#" title="term of use"><?php echo getlanguage('terms-of-use'); ?></a> | <a href="#" title="Privacy terms and conditions"><?php echo getlanguage('privacy-terms-and-conditions');?></a>| <a href="#" title="Terms of use"><?php echo getlanguage('terms-of-use'); ?></a> | <a href="#" title="Alliance"><?php echo getlanguage('alliance'); ?></a></div>

                <div class="col-sm-4 col-xs-12 footer_copy_right" style="text-transform:none !important; text-align:right;" title="Copyright 2016 bookumbrella.com">
                    <?php echo getlanguage('copyright_2016_innostart.com')?><br>

                    <!-- <span style="font-size:11px; text-transform:none !important;"> Designed & Developed by
                     <a href="http://stepinnsolution.com/" target="_blank"
                        style="font-size:11px !important; text-transform:none; padding:0px !important;">StepInnSolution</a></span>
                          -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Plugin JavaScript -->
<script src="<?php echo base_url('assets/frontend'); ?>/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url('assets/frontend'); ?>/js/jquery.fittext.js"></script>
<script src="<?php echo base_url('assets/frontend'); ?>/js/wow.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('assets/frontend'); ?>/js/creative.js"></script>
<script src="<?php echo base_url('assets/frontend'); ?>/js/modernizr.js"></script>
<script src="<?php echo base_url('assets/frontend'); ?>/js/main.js"></script>
<script src="<?php echo base_url('assets/frontend'); ?>/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url('assets/frontend'); ?>/js/jquery.uploadfile.min.js"></script>
<script src="<?php echo base_url('assets/frontend'); ?>/js/function.js"></script>

<script src="<?php echo base_url('assets/frontend'); ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>


<script type="text/javascript">

    $('body').on('change','#set-layout',function(){

        var selectionVal = $(this).val();

        if(selectionVal){
            var actionUrl = '<?php echo base_url() ?>set_layout/'+selectionVal;
            window.location.replace(actionUrl);
        }
    });
    $('body').on('click','.accordian-cont .accordion',function(){

        var objCtrl = $(this);
        var objCtrlPanel = $(this).next();

        $('.accordian-cont .accordion').not(this).removeClass('active');
        $('.accordian-cont .panel').not(objCtrlPanel.get()).removeClass('show');

        objCtrl.toggleClass('active');
        objCtrlPanel.toggleClass('show');
    });
</script>
<script>
    (function($){
        $(window).load(function(){

            $(".innoCustomScrollBar").mCustomScrollbar({
                theme:"inset-dark",
                axis:"y",
                autoHideScrollbar:false
            });

        });
    })(jQuery);
</script>

<!-- Modal -->
<div id="cartModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cart Items</h4>
      </div>
      <div class="modal-body">
      <div class="product-filter product_mobile">
        <div class="product-compare">
            You have <span id="totalitems"><?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('totalCartItems') : 0; ?></span> items for a total of US$<span id="total"><?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('total') : 0; ?></span> in your basket.
        </div>
        </div>
      </div>
      
      
      <a href="<?php echo base_url("product/checkout");?>"><button class="btn btn-primary add-to-cart-btn"  >Checkout</button></a>
      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>

</html>