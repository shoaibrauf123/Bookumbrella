
<?php
    $user_id = decode_uri($this->uri->segment(2));
?>

<div class="add-payment-method-cont col-xs-12">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 co-md-12 col-sm-12">

                <?php if (isset($errors)) { ?>
                    <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                
                <?php
                if($email_notifications){
				?>
				
                <div>


                    <h3>Update Email Notifications</h3>
                    
                 
                        

                        <form method="post" action="<?php echo base_url('email_notifications')?>" method="post" >
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
                                        <div class="form-group">
                                            <label for="account_notification">Account Notification Email*</label>
                                            <input id="account_notification" class="form-control" name="account_notification" value="<?php echo $email_notifications[0]['account_notification']; ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="inventory_load_confirmation">Inventory Load Confirmation *</label>
                                            <input id="inventory_load_confirmation" value="<?php echo $email_notifications[0]['inventory_load_confirmation']; ?>" class="form-control" name="inventory_load_confirmation" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="seller_questions">Seller Questions Email *</label>
                                            <input id="seller_questions" class="form-control"  value="<?php echo $email_notifications[0]['seller_questions']; ?>"  name="seller_questions" required>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="billing_notifications">Billing Notification Email *</label>
                                            <input id="billing_notifications" class="form-control"  value="<?php echo $email_notifications[0]['billing_notifications']; ?>"  name="billing_notifications" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="order_notification">Order Notification Email *</label>
                                            <input id="order_notification" class="form-control"  value="<?php echo $email_notifications[0]['order_notification']; ?>"  name="order_notification" required>
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        <div class="form-group text-right">
                                            <input name="update" value="yes" type="hidden">
                                            
                                            <input name="id" value="<?php echo $email_notifications[0]['id']; ?>" type="hidden">
                                            
                                            
                                            <input class="btn btn-primary" type="submit" value="Update" style="background:#bb9870 !important;">
                                        </div>
                                    </div>
                                </form>
                                
                                
                    
                    <div>
                        
                    </div>
                    
                    
                    


                </div>
				
				<?php
				
				}else{
				?>
                
                <div>


                    <h3>Add Email Notifications</h3>
                    

                 
                        

                        <form method="post" action="<?php echo base_url('email_notifications')?>" method="post" >
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
                                        <div class="form-group">
                                            <label for="account_notification">Account Notification Email*</label>
                                            <input id="account_notification" class="form-control" name="account_notification" value="<?php echo $this->session->userdata('email'); ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="inventory_load_confirmation">Inventory Load Confirmation *</label>
                                            <input id="inventory_load_confirmation" value="<?php echo $this->session->userdata('email'); ?>" class="form-control" name="inventory_load_confirmation" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="seller_questions">Seller Questions Email *</label>
                                            <input id="seller_questions" class="form-control"  value="<?php echo $this->session->userdata('email'); ?>"  name="seller_questions" required>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="billing_notifications">Billing Notification Email *</label>
                                            <input id="billing_notifications" class="form-control"  value="<?php echo $this->session->userdata('email'); ?>"  name="billing_notifications" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="order_notification">Order Notification Email *</label>
                                            <input id="order_notification" class="form-control"  value="<?php echo $this->session->userdata('email'); ?>"  name="order_notification" required>
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        <div class="form-group text-right">
                                            <input name="add" value="yes" type="hidden">
                                            
                                            
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                                
                                
                    
                    <div>
                        
                    </div>
                    
                    
                    


                </div>
                
                
                <?php
				}
				?>
                
                
                
                
                
            </div>
        </div>
    </div>
</div>
<script>
function confirmDelte(account_type,id){
	

	var r = confirm("Are you sure you want to delete?");
	if (r == true) {
		
		location.href="<?php echo base_url("payment_method");?>/delete/"+account_type+"/"+id;
		
	} else {
		
	}
}

</script>