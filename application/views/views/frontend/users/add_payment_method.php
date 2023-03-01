
<?php
    $user_id = decode_uri($this->uri->segment(2));
?>

<style>
    td.col-xs-1.col-sm-1.col-md-2 a {
    color: white;
    background: #bb9870;
    padding: 5px 10px;
    border-radius: 2px;
    text-decoration: none;
}
   td.col-xs-1.col-sm-1.col-md-2 a:hover {
    color: white;
    background: #323232;
   
}
</style>

<div class="add-payment-method-cont col-xs-12">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 co-md-12 col-sm-12">

                <?php if (isset($errors)) { ?>
                    <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                <div>

                    <h3>Payment Method</h3>
                    
              <p>Send payments by selecting any of given <strong>Payment Methods</strong>, just fill its required information and hit <i>submit</i>, and you are good to go !</p>       

                    <div class="accordian-cont margin-tb-40">
                    
                    
                    
                    
                        <button class="accordion" title="Paypal">Paypal</button>
                        <div class="panel">
                            <div class="inner-content">
                                <form method="post" action="<?php echo base_url('payment_method').'/'.getCurrentUserId() ?>">
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
                                        <div class="form-group">
                                            <label for="paypal-email">Paypal Email *</label>
                                            <input id="paypal-email" class="form-control" name="email" type="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="billing-address">Billing Address</label>
                                            <input id="billing-address" class="form-control" name="billing_address" type="text">
                                        </div>
                                        <div class="form-group text-right">
                                            <input name="pm" value="paypal" type="hidden">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                                
                                
                                
                                
                            </div>
                            
                                                   <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>Previous Paypal Accounts<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="">
                                                    
                                                    <tr>
                                                        <th  style="width:5%">Serial#</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-4">Email</th>
                                                         <th class="col-xs-1 col-sm-1 col-md-4" style="text-align:right;">Action</th>
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($paypal_accounts) { 
												$i=0;
												?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                            <tbody>
                                                                <?php foreach ($paypal_accounts as $row) {
																	$i++;
																	
																	 ?>
                                                                 <tr>
<td style="width:5%"><?php echo $i; ?></td>

<td class="col-xs-1 col-sm-1 col-md-4"><?php echo $row['email']; ?></td>
                                                                               
                                                                                <td class="col-xs-1 col-sm-1 col-md-4" style="padding-right:30px; text-align:right">
                                                                                    <a href="javascript:;" onClick="confirmDelte('pm_paypal','<?php echo $row['id']; ?>')">Delete</a>
                                                                                </td>
                                                                                
                                                                            </tr>  
                                                                   
                                                                <?php }?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                        </div>

<?php
            ?>
            
            <button class="accordion" title="Amazon">Amazon</button>
                        <div class="panel">
                            <div class="inner-content">
                                <form method="post" action="<?php echo base_url('payment_method').'/'.getCurrentUserId() ?>">
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
                                        <div class="form-group">
                                            <label for="username">Username *</label>
                                            <input id="username" class="form-control" name="username" type="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" class="form-control" name="password" type="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input id="confirm_password" class="form-control" name="confirm_password" type="password">
                                        </div>                                        
                                        <div class="form-group text-right">
                                            <input name="pm" value="amazon" type="hidden">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                                
                                
                                
                                
                            </div>
                            
                                                   <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>Previous Amazon Accounts<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="">
                                                    
                                                    <tr>
                                                        <th  style="width:5%">Serial#</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-4">Username</th>
                                                         <th class="col-xs-1 col-sm-1 col-md-4"  style="text-align:right">Action</th>
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($amazon_accounts) { 
												$i=0;
												?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                            <tbody>
                                                                <?php foreach ($amazon_accounts as $row) {
																	$i++;
																	
																	 ?>
                                                                 <tr>
<td  style="width:5%"><?php echo $i; ?></td>

<td class="col-xs-1 col-sm-1 col-md-4"><?php echo $row['username']; ?></td>
                                                                               
                                                                                <td class="col-xs-1 col-sm-1 col-md-4" align="right" style="padding-right:30px !important;">
                                                                                    <a href="javascript:;" onClick="confirmDelte('pm_amazon','<?php echo $row['id']; ?>')">Delete</a>
                                                                                </td>
                                                                                
                                                                            </tr>  
                                                                   
                                                                <?php }?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                        </div>
                        
            
            <button class="accordion" title="cc">Credit/Debit Card</button>
                        <div class="panel">
                            <div class="inner-content">
                                <form method="post" action="<?php echo base_url('payment_method').'/'.getCurrentUserId() ?>">
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
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
                                            <select name="expiry_month">
                                            	<?php for($m=12;$m>=1;$m--){
														?>
														<option value="<?php echo $m;?>"><?php echo $m;?></option>
														<?php
													}?>
                                            </select>
                                        </div>
                                        
                                       <div class="form-group">
                                            <label for="expiry_year">Expiry Year</label>
                                            
                                            
                                            <select name="expiry_year">
                                            	<?php for($y=2017;$y<=2050;$y++){
														?>
														<option value="<?php echo $y;?>"><?php echo $y;?></option>
														<?php
													}?>
                                            </select>
                                            
                                        </div>                                       
                                        <div class="form-group text-right">
                                            <input name="pm" value="cc" type="hidden">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                                
                                
                                
                                
                            </div>
                            
                                                   <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>Previous Credit/Debit Cards<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="" style="width:100%;">
                                                    
                                                    <tr>
                                                        <th  class="col-xs-1 col-sm-1">Serial#</th>
                                                        <th class="col-xs-1 col-sm-1">Title</th>
                                                        <th class="col-xs-1 col-sm-1">Card Number</th>
                                                        <th class="col-xs-1 col-sm-1">Expiry Month</th>
                                                        <th class="col-xs-1 col-sm-1">Expiry Year</th>
                                                         <th class="col-xs-1 col-sm-1">Action</th>
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($card_accounts) { 
												$i=0;
												?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                            <tbody>
                                                                <?php foreach ($card_accounts as $row) {
																	$i++;
																	
																	 ?>

                                                                 <tr>
<td class="col-xs-1 col-sm-1 col-md-2"><?php echo $i; ?></td>

 <td class="col-xs-1 col-sm-1 col-md-2"><?php echo $row['title']; ?></td>
  <td class="col-xs-1 col-sm-1 col-md-2"><?php echo "****".substr($row['card_no'], -4)  ?> </td>
   <td class="col-xs-1 col-sm-1 col-md-2"><?php echo $row['expiry_month']; ?></td>
    <td class="col-xs-1 col-sm-1 col-md-2"><?php echo $row['expiry_year']; ?></td>
    
                                                                               
                                                                                <td class="col-xs-1 col-sm-1 col-md-2">
                                                                                    <a href="javascript:;" onClick="confirmDelte('pm_card','<?php echo $row['id']; ?>')">Delete</a>
                                                                                </td>
                                                                                
                                                                            </tr>  
                                                                   
                                                                <?php }?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                        </div>             

			<?php
			
            if($this->session->userdata('user_type')=='Seller'){}
			?>              
                        
                        
                    </div>
                    <div>
                        <p class="bottom-note-txt"><i><strong>Note:</strong>&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, delectus dolor earum illum ipsum sunt veritatis! Architecto culpa cumque cupiditate delectus ea, eos fugit molestias, nam officia quas quidem reiciendis!</i></p>
                    </div>
                    
                    
                    


                </div>
            </div>
        </div>
    </div>
</div>
<script>
function SaveBank(){
	
	//alert($('#re_account_no').val());
	
	var form_name = $("#country").val();
	
	if($("#re_account_no").val() != $("#account_no").val()){
		alert("Account Number and Re-type must match.");return false;
		}
	if(form_name == ''){
		alert("Please select some country.");
		return false;
		}
			
	
	//alert(form_name);
	var formdata = jQuery("#"+form_name+"Form").serialize()+ "&country=" + form_name+ "&pm=bank";
	 jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('payment_method'); ?>',
            data: formdata,
			
            
            success: function (response) {
        
        
		if (response=='success') {
                    alert('Payment method saved successfully.');
					location.reload();
          }else{
                    $('.alert-success').html(response);
                }
            }
        });//End ajax
		
		
	
	
	}
function confirmDelte(account_type,id){
	

	var r = confirm("Are you sure you want to delete?");
	if (r == true) {
		
		location.href="<?php echo base_url("payment_method");?>/delete/"+account_type+"/"+id;
		
	} else {
		
	}
}
function setFields(){
    var region = $('#region').val();
	
	$('#country').val(region);
	
	$('.all').hide();
	$('#'+region).show();
    
}

</script>

<input type="hidden" id="country" value="" >	