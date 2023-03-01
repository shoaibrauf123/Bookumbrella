<style>
.footer
{
	padding-left:30px;
    background-color: #ffff;

}

.footer_1 {
    padding: 0px 15px;
}
.footer_1 a {
 color:#000;
}
.footer_bottom {
    background: #fff !important;
    border-top: 2.5px solid #ebebeb; 
}
</style>



</div>

<div class="footer-container">
    <div class="col-xs-12 no-padding footer">
        <div class="container"style="border-top: 2.5px solid #ebebeb;padding-top:20px !important;" >
            <div class="row no-padding">

                <div class="footer_1">
                    <h2 title="My Account"><?php echo getlanguage('my-account');?></h2>
                    <div class="clear10"></div>

                    <?php if($this->session->userdata('logged_in')) { ?>
                        <a href="<?php echo base_url('my_account'); ?>" title="Dashboard"><i class="glyphicon glyphicon-menu-right"></i><?php echo getlanguage('my-account');?></a>
                        
                        
                    <?php } else {?>
                        <a href="<?php echo base_url('login'); ?>" title="Login"><i class="glyphicon glyphicon-menu-right"></i><?php echo getlanguage('login');?></a>
                    <?php } ?>

                    <a href="<?php echo base_url('contact_us');?>" title="contact us"><i class="glyphicon glyphicon-menu-right"></i><?php echo getlanguage('contact-us');?> </a>
                </div>

                <div class="footer_1" >
                    <h2 title="Short links"><?php echo getlanguage('short_links');?></h2>
                    <div class="clear10"></div>
                    <?php
                    $all_pages = get('static_page',array('status'=>1));
                    $total = count($all_pages);
                    if($total >0){
                        for($i=0; $i< $total; $i++){ ?>
                            <a href="<?php echo base_url('pages').'/'.$all_pages[$i]['slug'];?>"><i class="glyphicon glyphicon-menu-right"></i><?php echo $all_pages[$i]['title'];?></a>
                        <?php }
                    }
                    ?>
                </div>

                

                <div class="footer_1">
                    <h2 title="Customer Services"><?php echo getlanguage('customer_service');?></h2>

                    <div class="clear10"></div>
                    <?php if($this->session->userdata('logged_in')) { ?>
                    <a href="<?php echo base_url('my_account'); ?>" title="Dashboard"><i class="glyphicon glyphicon-menu-right"></i><?php echo getlanguage('my-account');?></a>
                       
                    <?php } else {?>
                        <a href="<?php echo base_url('frontend/users/Buyer_login'); ?>" title="Login"><i class="glyphicon glyphicon-menu-right"></i><?php echo getlanguage('login');?></a>
                    <?php } ?>
                    <a href="#" title="Order Tracking"><i class="glyphicon glyphicon-menu-right"></i><?php echo getlanguage('order-tracking');?></a>
                   
                    <a href="<?php echo base_url('contact_us');?>" title="Contact Us"><i class="glyphicon glyphicon-menu-right"></i><?php echo getlanguage('contact-us');?></a>
                </div>

                <div class="footer_right">
                    <h2 Contact us><?php echo getlanguage('contact-us');?></h2>

                    <div class="clear10"></div>
                    <div class="col-sm-4 p-0" title="Address"> <?php echo getlanguage('address');?>: </div>
                    <div class="col-sm-8" title="Admin address"><?php echo getSettingValue('admin_address'); ?></div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4"  title="Phone number"> <?php echo getlanguage('phone-number'); ?>: </div>
                    <div class="col-sm-8" title="Admin Contact"><?php echo getSettingValue('admin_contact'); ?></div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4" title="Fax"></i> <?php echo getlanguage('fax');?>: </div>
                    <div class="col-sm-8"><?php echo getSettingValue('admin_fax'); ?></div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4" title="Email"> <?php echo getlanguage('email');?>: </div>
                    <div class="col-sm-8"><?php echo getSettingValue('info_email'); ?></div>

                </div>

                <div class="clear20"></div>

                


                <div class="clear20"></div>


            </div>
        </div>
    </div>

    <div class="col-xs-12 no-padding footer_bottom">
        <div class="container">
            <div class="row no-padding">


                <div class="col-lg-8  no-padding">
                    <!-- <div class="clear10"></div> -->
                    <a href="<?php echo base_url('home');?>" title="Home"><?php echo getlanguage('home');?></a> | <a href="#" title="term of use"><?php echo getlanguage('terms-of-use'); ?></a> | <a href="#" title="Privacy terms and conditions"><?php echo getlanguage('privacy-terms-and-conditions');?></a>| <a href="#" title="Terms of use"><?php echo getlanguage('terms-of-use'); ?></a> | <a href="#" title="Alliance"><?php echo getlanguage('alliance'); ?></a></div>

                <div class="col-lg-4  footer_copy_right" style="text-transform:none !important; " title="Copyright 2016 bookumbrella.com">
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
<script src="<?php echo base_url('assets/frontend'); ?>/rateit/src/jquery.rateit.js" type="text/javascript"></script>

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

function ShowCardModal(){	
$('#CardModal').modal('show');

}
function SaveCard(){
	
	var title = $("#title").val();
	var card_no = $("#card_no").val();
	var ccv = $("#ccv").val();
	var expiry_month = $("#expiry_month").val();
	var expiry_year = $("#expiry_year").val();
	
	
	if(title == '' || card_no == '' || ccv == '' || expiry_month == '' || expiry_month == '' ){
		
		alert("Please fill the data.");return false;
		
		}
	
	jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('ajax_card'); ?>',
            data: {'title': title,'card_no':card_no,'ccv': ccv,'expiry_month':expiry_month,'expiry_year': expiry_year},
			
            success: function (response) {
				//alert(response);
				if(response=='success'){
				    alert("Card added successfully.");
				    location.reload();
				}else{
				    alert("There is some error. Please try later.");	
				}
				
				
				
				}
        });
		
		
	}	
	
	
	
	
function ShowAddressModal(){	
$('#AddressModal').modal('show');

}
function SaveAddress(){
	
	var country = $("#country").val();
	var name = $("#name").val();
	var street_address = $("#street_address").val();
	var city = $("#city").val();
	var state = $("#state").val();
	var zip = $("#zip").val();
	var phone_number = $("#phone_number").val();
	
	if(country == '' || name == '' || street_address == '' || city == '' || state == '' || zip == '' || phone_number == ''){
		
		alert("Please fill the data.");return false;
		
		}
	
	jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('ajax_addresses'); ?>',
            data: {'country': country,'name':name,'street_address': street_address,'city':city,'state': state,'zip':zip,'phone_number':phone_number},
			
            success: function (response) {
				//alert(response);
				if(response=='success'){
				alert("Address added successfully.");
				location.reload();
				}else{
				alert("There is some error. Please try later.");	
					
					}
				
				
				
				}
        });
		
		
	}	
function SelectedCheckoutCard(selected_card_id){
	
	$("#selected_card_id").val(selected_card_id);
	
	}

    var tooltipvalues = ['Poor', 'Fair', 'Average', 'Good', 'Excellent'];
    $(".rateit").bind('over', function (event, value) { $(this).attr('title', tooltipvalues[value-1]); });
</script>

<!-- Modal -->
<div id="cartModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#0C0; font-weight:bold;" >Item is added to cart</h4>
      </div>
      <div class="modal-body">
      <div class="product-filter product_mobile" style="border:0 none;">
        <div class="product-compare" style="color:#666;">
            You have <span id="totalitems"><?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('totalCartItems') : 0; ?></span>
         <p>   
         
           items for a total of <span style="color:#06F;">$</span><span id="total" style="color:#06F;"><?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('total') : 0; ?></span> in your basket.</p>
        </div>
        </div>
        
        
       <a href="<?php echo base_url("product/checkout");?>"><button class="btn btn-primary" id="popup_checkout"  >Checkout</button></a>
       <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="continue_shopping">Continue Shopping</button>
        
      </div>
      
      
      
   
    </div>

  </div>
</div>
<div id="AddressModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#0C0; font-weight:bold;" >Add New Address</h4>
      </div>
      <div class="modal-body">
      <div class="product-filter product_mobile" style="border:0 none;">
        <div class="product-compare" style="color:#666;">
           <div class="form-group">
          <label for="country">Country *</label>
                                                          <?php
              $countries = $this->comman_model->get('countries');
			  ?>

                                            
                                                                            <select id="country" class="form-control" name="country">
                                                                                <option value="">Select Country</option>
                                                                                <?php if($countries){
                                                                                    foreach ($countries as $country) {
                                                                                        
                                                                                        ?>
																						<option  value="<?php echo $country['country_name'];?>"><?php echo $country['country_name'];?></option>
																						<?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
      </div>                                                                      
         
         
          <div class="form-group">
                                            <label for="name">Full Name *</label>
                                            <input id="name" class="form-control" name="name" value="<?php //echo $name?>" type="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="street_address">Street Address *</label>
                                            <input id="street_address" class="form-control" name="street_address" value="<?php //echo $street_address?>" type="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City *</label>
                                            <input id="city" class="form-control" name="city" value="<?php //echo $city?>" type="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="state">State/Province/Region*</label>
                                            <input id="state" class="form-control" name="state" value="<?php //echo $state?>" type="text" required>
                                        </div>                                        
                                        
                                        <div class="form-group">
                                            <label for="zip">Zip*</label>
                                            <input id="zip" class="form-control" name="zip" value="<?php //echo $zip?>" type="text" required>
                                        </div>                                        
                                        
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number*</label>
                                            <input id="phone_number" class="form-control" name="phone_number" value="<?php //echo $phone_number?>" type="text" required>
                                        </div>   
                                        
                                        
                          
         
         
         
                                                                            
                                                                            
        </div>
        </div>
        
        
       <a href="javascript:;"><button class="btn btn-primary" onClick="SaveAddress()"  >Save Address</button></a>
       
        
      </div>
      
      
      
   
    </div>

  </div>
</div>


<div id="CardModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#0C0; font-weight:bold;" >Add New Card</h4>
      </div>
      <div class="modal-body">
      <div class="product-filter product_mobile" style="border:0 none;">
        <div class="product-compare" style="color:#666;">
                                                                                 
         
         
         
         <div class="form-group">
                                            <label for="title">Name *</label>
                                            <input id="title" class="form-control" name="title" type="title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="card_no">Credit Card Number</label>
                                            <input id="card_no" class="form-control" name="card_no" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="ccv">CCV</label>
                                            <input id="ccv" class="form-control" name="ccv" type="text">
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="expiry_month">Expiry Month</label>
                                            <select name="expiry_month" id="expiry_month">
                                            	<?php for($m=12;$m>=1;$m--){
														?>
														<option value="<?php echo $m;?>"><?php echo $m;?></option>
														<?php
													}?>
                                            </select>
                                        </div>
                                        
                                       <div class="form-group">
                                            <label for="expiry_year">Expiry Year</label>
                                            
                                            
                                            <select name="expiry_year" id="expiry_year">
                                            	<?php for($y=2017;$y<=2050;$y++){
														?>
														<option value="<?php echo $y;?>"><?php echo $y;?></option>
														<?php
													}?>
                                            </select>
                                            
                                        </div> 
                                        
                                        
                          
         
         
         
                                                                            
                                                                            
        </div>
        </div>
        
        
       <a href="javascript:;"><button class="btn btn-primary" onClick="SaveCard()"  >Save Address</button></a>
       
        
      </div>
      
      
      
   
    </div>

  </div>
</div>








<!-- Rating Modal -->
<div id="ratingtModal" class="modal fade" role="dialog" style="z-index:99999999">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#0C0; font-weight:bold;" >Add Rating</h4>
      </div>
      <div class="modal-body">
        <div class="product-filter product_mobile" style="border:0 none;">
            <div class="form-group">
                <label>Number of Stars</label>
                <select class="form-control" name="no_stars" id="no_stars">
                    <option value="1" >1:Poor</option>
                    <option value="2" >2:Fair</option>
                    <option value="3" >3:Average</option>
                    <option value="4" >4:Good</option>
                    <option value="5" >5:Excellent</option>
                </select>
                <label>Comments(Max: 100 Characters)</label>
				<textarea name="comments" id="comments" maxlength="100" rows="2" cols="70" class="form-control"></textarea>
			
                
            </div> 
        </div>
        
        
       <a href="javascript:void(0)"><button class="btn btn-primary add-rating-btn" >Submit</button></a>
       <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
        
      </div>
      
      
      
   
    </div>

  </div>
</div>

</body>

</html>