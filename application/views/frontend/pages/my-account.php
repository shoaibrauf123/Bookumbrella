<?php
    $currentUserData = getUserData(getCurrentUserId());
    $countries = $this->comman_model->get('countries');
//    echo "<pre>";print_r($this->session->all_userdata());exit;
?>

<style>

	.importdbookstbl{
	
    padding: 9px !important;
    text-align: left !important;
    text-indent: 4px;
    vertical-align: middle !important;
    width: 180px;	
	}
	.myacuntblock{
	
    margin: 0 2px 10px;
    min-height: 250px;
    padding: 0 0 8px;
	    border: 1px solid #eee;
		min-height:339px;
	}
	.my-account-tab-btns
	{
		margin-top:20px;
		margin-bottom:20px;
	}
	.my-account-tab-btns ul h2 {
  background:#fff;
    color: #000 !important;
    font-size: 20px;
    font-weight: 600;
    margin:0 0 2px;
    padding: 20px 0;
    text-align: center;
    text-shadow:one;
	font-weight:bold;
	}
.my-account-tab-btns ul li {

    padding: 2px 0;
    
}
.my-account-tab-btns ul li a {
 background: #fff none repeat scroll 0 0;
    border-radius: 0;
    color: #857d7d !important;
    padding: 10px 15px;
    text-shadow:none;
	 

}
.my-account-tab-btns ul li i {

display: inline-block;
    float: left;
    font-size: 33px;
    text-align: left;
    
}
.my-account-tab-btns ul li h3 {
   display: inline-block;
    font-size: 13px;
    margin: 12px 5px 3px 0;
    text-align: left;
	line-height:20px;
    
}
.box_myaccount1
{
	width:25%;
	float:left;
}
.box_you_order
{
	border-radius:5px;
	border:solid 1px #dddddd;
	padding:10px;
	color:#000;
	font-size:16px;
}
.box_you_order:hover
{	
border:solid 1px #bb9870;
}
.box_you_order h2
{

	color:#000;
	font-size:24px;
	margin-top:0px;
}
.hght_icon
{
	height:40px;
}

@media (min-width: 320px) and (max-width: 800px) {
.box_myaccount1
{
	width:100%;
}	
	
}
</style>

<div class="col-xs-12">
    <div class="frontend-dashboard-cont">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12">

                <section style="padding-bottom: 50px; padding-top: 50px;">

                    <?php if (isset($errors)) { ?>
                        <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                    <!--dashbord start-->
                    <div class="dashbord_inno">
                        <div class="container">
                            

                            <div class="my-account-tab-btns">

<?php if($this->session->userdata('logged_in_as')=='i_am_buyer'){ ?>
<div id="buyer_panel">                                
                            
                            <h2 style="border-bottom: 1px solid rgb(238, 238, 238);
    clear: both;
    margin-bottom: 20px;
    margin-left: 20px;
    margin-top: 0;
    padding-bottom: 13px; width: 97%;">Buyer Panel</h2>
                            
           <div class="col-sm-6">
                            <a href="<?php echo base_url("orders_listing");?>">
                            <div class="box_you_order">
                            <div class="col-sm-2"><img src="<?php echo base_url("assets/frontend");?>/img/order-ixon.png" class="img-responsive" alt="" /></div>
                             <div class="col-sm-8">
                             <h2>My Order</h2>
                             View, Track, refund and cancel your orders<br>
                             Leave feedback for your items

                             </div>
                            
                             <div style="clear:both;"></div>
                            </div></a>
                            
                            </div>
                            <div class="col-sm-6">
                            <a href="<?php echo base_url("security_profile");?>">
                            <div class="box_you_order">
                            <div class="col-sm-2"><img src="<?php echo base_url("assets/frontend");?>/img/lock.png" class="img-responsive" alt="" /></div>
                             <div class="col-sm-8">
                             <h2>Sign in & Secuirty</h2>
                             Edit your password, Profile Picture
                             </div>
                            
                            <div style="clear:both;"></div>
                            </div></a>
                            
                            </div>
                            <div style="clear:both; height:20px;"></div>
                            
                            <div class="col-sm-6">
                            <a href="<?php echo base_url("addresses");?>">
                            <div class="box_you_order">
                            <div class="col-sm-2"><img src="<?php echo base_url("assets/frontend");?>/img/address_icon.png" class="img-responsive" alt="" /></div>
                             <div class="col-sm-8">
                             <h2>Address</h2>
                             View and edit your address detail
                             </div>
                            
                      <div style="clear:both;"></div>
                            </div>
                            </a>
                            </div>
                            
                            
                            
                            <div class="col-sm-6">
                            <a href="<?php echo base_url("payment_method");?>">
                            <div class="box_you_order">
                            <div class="col-sm-2"><img src="<?php echo base_url("assets/frontend");?>/img/credit_cardimg.png" class="img-responsive" alt="" /></div>
                             <div class="col-sm-8">
                             <h2>Payment</h2>
                             View and edit your payment detail
                             </div>
                            
                            <div style="clear:both;"></div>
                            </div>
                            </a>
                            </div>
                              <div style="clear:both; height:20px;"></div>
                            
                           <div class="col-sm-6">
                            <a href="<?php echo base_url("profile");?>">
                            <div class="box_you_order">
                            <div class="col-sm-2"><img src="<?php echo base_url("assets/frontend");?>/img/profile.jpg" class="img-responsive" alt="" /></div>
                             <div class="col-sm-8">
                             <h2>My Account</h2>
                             Update your profile
                             </div>
                            
                             <div style="clear:both;"></div>
                            </div></a>
                            
                            </div>
                             
                            
                           <div class="col-sm-6">
                            <a href="<?php echo base_url("frontend/users/messages");?>">
                            <div class="box_you_order">
                            <div class="col-sm-2"><img src="<?php echo base_url("assets/frontend");?>/img/inbox.jpg" class="img-responsive" alt="" /></div>
                             <div class="col-sm-8">
                             <h2>Inbox</h2>
                             View all your messages
                             </div>
                            
                      <div style="clear:both;"></div>
                            </div>
                            </a>
                            </div>
                            
                            
                            
            </div>
            <?php } ?>                
                            
                                      
                            <div style="clear:both; height:30px;"></div>
    
                        
                            
                           <?php
                           //echo $this->session->userdata('user_type').'----------';
            if($this->session->userdata('logged_in_as')=='i_am_seller'){
				 
			?>  
                            <h2 style="border-bottom: 1px solid rgb(238, 238, 238);
    clear: both;
    margin-bottom: 20px;
    margin-left: 20px;
    margin-top: 0;
    padding-bottom: 13px; width: 97%;">Seller Panel</h2>
     <div style="clear:both;"></div>
                            
               <?php  } ?>             
                            
          <div class="col-sm-12">
           <?php
            if($this->session->userdata('logged_in_as')=='i_am_seller'){
				 
			?>                     <ul class="box_myaccount1">
            						<div class=" myacuntblock">
                                    <h2>Marketplace Selling</h2>
                                    <li><a href="<?php echo base_url("add_inventory");?>">
                                     <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/sell_item.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3>Sell an Item</h3>
                                    </a>
                                    </li>
                                    <li><a href="<?php echo base_url("edit_inventory");?>">
                                    <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/edit_inventory.png" class="img-responsive hght_icon" alt="" /></i>
                                     <h3>Edit Inventory</h3>
                                    
                                    </a></li>
                                    <li><a href="<?php echo base_url("upload_inventory");?>">
                                      <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/upload_icon.png" class="img-responsive hght_icon" alt="" /></i>
                                     <h3> Upload Inventory</h3>
                                    
                                   </a></li>
                                   <li><a href="<?php echo base_url("export_inventory");?>">
                                     <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/export.png" class="img-responsive hght_icon" alt="" /></i>
                                     <h3> Export Inventory</h3>
                                    
                                   </a></li>
                                    <div class="clearfix"></div>
                                    </div>
                                </ul>
              
                                <ul class="box_myaccount1">
                                <div class=" myacuntblock">
                                    <h2>Selling Options</h2>
                                 
                                    <li>
                                    <a href="<?php echo base_url("frontend/products/selling_options");?>">
                                    <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/selling.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3>Selling Options</h3>
                                    </a>
                                    </li>
                                    <li><a href="<?php echo base_url("frontend/users/seller_information");?>">
                                       <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/seller-icon.jpg" class="img-responsive hght_icon" alt="" /></i>
                                    <h3>Seller Information</h3>
                                    
                                    </a>
                                    </li>
                                    <li><a href="<?php echo base_url("email_notifications");?>">
                                        <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/email_notif.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3>Email Notifications</h3>
                                    
                                    </a></li>
                                    <li><a href="<?php echo base_url("pricing_rules");?>">
                                         <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/auto_pricing.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3> Auto Repricing</h3>
                                    
                                    
                                   </a></li>
                                      <div class="clearfix"></div>
                                    </div>
                                </ul>
                                <ul class="box_myaccount1">
                                <div class=" myacuntblock">
                                    <h2>Seller Guides</h2>
                                    <li><a href="<?php echo base_url("pages/sell_user_guide");?>">
                           <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/user_guide.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3>  Sell User Guide</h3>
                                    
                                   </a></li>
                                    <li><a href="<?php echo base_url("pages/sell_user_guide");?>">
                                   <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/user_guide_icon2.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3>   Guide</h3>
                                    
                                    
                                  </a></li>
                                    <li><a href="<?php echo base_url("uploads/files/seller/samples/Demo book upload.xlsx");?>">
                                <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/sell_file.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3>  Sell Sample Inventory  File</h3>
                                    
                                    </a></li>
									
                                    
                                    
                                      <div class="clearfix"></div>
                                    </div>
                                    
                                
                                    
                                </ul>
                                
                                
                                <ul class="box_myaccount1">
                                <div class=" myacuntblock">
                                    <h2>Sales</h2>
                                    <li><a href="<?php echo base_url("fullFill_orders_pending");?>">
                               <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/order_pening.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3> Manage Orders</h3>
                                    
                                   </a></li>
                                    
                                    <li><a href="<?php echo base_url("ratings_and_feedbacks");?>">
                                      <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/feedback.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3> My Feedback And  Rating</h3>
                                    
                                    </a></li>
                                    
                                    
                                   <li><a href="<?php echo base_url("frontend/products/ViewPaymentSummary");?>">
                                          <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/payment_summery.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3> View Payment Summary</h3>
                                    
                                    </a></li> 
                                    
                                     <li><a href="<?php echo base_url("seller_payment_method");?>">
                                          <i class=""><img src="<?php echo base_url("assets/frontend");?>/img/payment_method.png" class="img-responsive hght_icon" alt="" /></i>
                                    <h3> Payment Method</h3>
                                    
                                    </a></li> 
                                      <div class="clearfix"></div>
                                    </div>
                                    
                                </ul>
                                </div>
                                
              <?php
			}
			?>
            
                            <?php /*?>    <ul class="box_myaccount1">
                                <div class=" myacuntblock">
                                    <h2>Sales</h2>
                                    <li><a href="<?php echo base_url("fullFill_orders_pending");?>">
                                             <i class="glyphicon glyphicon-level-up"></i>
                                    <h3> Fulfill Orders Pending</h3>
                                    
                                   </a></li>
                                    <li><a href="<?php echo base_url("view_sales_refunds");?>">
                                            <i class="glyphicon glyphicon-level-up"></i>
                                    <h3> View Sales and File  Refunds</h3>
                                    
                                    </a></li>
                                    
                                    
                                    <li></li>
                                      <div class="clearfix"></div>
                                    </div>
                                    
                                </ul>
                                 <ul class="box_myaccount1">
                                 <div class=" myacuntblock">
                                    <h2>Payments</h2>
                                    <li><a href="<?php echo base_url("my_account");?>">
                                       <i class="glyphicon glyphicon-level-up"></i>
                                    <h3>  Sign and Security</h3>
                                    
                                   </a></li>
                                    <li><a href="<?php echo base_url("addresses");?>">
                                      <i class="glyphicon glyphicon-level-up"></i>
                                    <h3> Addresses</h3>
                                    </a></li>
                                    <li><a href="<?php echo base_url("payment_method");?>">
                                      <i class="glyphicon glyphicon-level-up"></i>
                                    <h3> Payment Methods</h3>
                                    </a></li>
                                      <div class="clearfix"></div>
                                   </div>
                                    
                                    
                                </ul>
                                
                            <?php */?>    
                            </div>
                          
                            
                            
                            
                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12 cashback-block">
                                    
                                </div>
                            </div>

                            <div class="clearfix"></div>
          			<?php

			?>
                        </div>
                    </div>
                    <!--dashbord end-->
                </section>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    $('body').on('submit','#dashboard-update-profile',function(e){

        e.preventDefault();

        var actionUrl = '<?php echo base_url('update_user_profile');?>';
        var formData = $(this).serializeArray();
        var loaderObj = $('.profile-update-loader');
        var responseMsgCont = $('.update-prof-response-cont');

        resetProfileUpdateResponse();

        $.ajax({
            url:actionUrl,
            type:'post',
            data:formData,
            success:function(response){
//                console.log(response);return;

                var decodedResponse = $.parseJSON(response);
                var dialogueDisplayTime = 7000;

                loaderObj.hide();
                responseMsgCont.show();

                if(decodedResponse){
                    var respMsg = decodedResponse['msg'];
                    var respStatus = decodedResponse['status'];

                    responseMsgCont.show();
                    responseMsgCont.find('.alert').text(respMsg);

                    if(respStatus){
                        responseMsgCont.find('.alert').addClass('alert-success');
                        $('#dashboard-update-profile').find('input[name="current_password"]').val('');
                        $('#dashboard-update-profile').find('input[name="password"]').val('');
                        $('#dashboard-update-profile').find('input[name="password_confirm"]').val('');
                    } else {
                        responseMsgCont.find('.alert').addClass('alert-danger');
                    }

                    setTimeout(function(){
                        responseMsgCont.hide('medium');
                    }, dialogueDisplayTime);
                }
            }
        });
    });

    function resetProfileUpdateResponse(){
        var responseMsgCont = $('.update-prof-response-cont');
        var loaderObj = $('.profile-update-loader');

        loaderObj.show();
        responseMsgCont.hide();

        responseMsgCont.find('.alert').removeClass('alert-danger alert-success');
    }
</script>