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

                <div>

                    <h3>Address</h3>
                   
                        <div class="inner-content">
                            <form method="post" action="<?php echo base_url('addresses').'/'.getCurrentUserId() ?>">
                                <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">         
                                    
                                    <div class="form-group">
                                        <label for="name">Full Name *</label>
                                        <input id="name" class="form-control" name="name" value="<?php echo $name?>" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="street_address">Street Address *</label>
                                        <input placeholder="Flat / House No. / Floor / Building" id="street_address" class="form-control" name="street_address" value="<?php echo $street_address?>" type="text" required>

                                        <br />
                                        <input placeholder="Colony / Street / Locality" id="street_address2" class="form-control" name="street_address2"  type="text" value="<?php echo $street_address2?>" required>

                                    </div>
                                    <div class="form-group">
                                        <label for="city">City *</label>
                                        <input id="city" class="form-control" name="city" value="<?php echo $city?>" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="state">State/Province/Region*</label>
                                        <input id="state" class="form-control" name="state" value="<?php echo $state?>" type="text" required>
                                    </div>                                        
                                    
                                    <div class="form-group">
                                        <label for="zip">Zip*</label>
                                        <input id="zip" class="form-control" name="zip" value="<?php echo $zip?>" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="country">Country *</label>
                                                      <?php
                                          $countries = $this->comman_model->get('countries');
                                          ?>

                                        
                                        <select id="" class="form-control" id="country" name="country">
                                            <option value="">Select Country</option>
                                                <?php if($countries){
                                                foreach ($countries as $country) {
                                                ?>
                                            <option <?php if($country == $country['country_name']){?>  selected <?php } ?> value="<?php echo $country['country_name'];?>"><?php echo $country['country_name'];?></option>
                                                <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>                                       
                                    
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number*</label>
                                        <input id="phone_number" class="form-control" name="phone_number" value="<?php echo $phone_number?>" type="text" required>
                                    </div> 
                                                                             
                                    
                                                                            
                                    
                                    <div class="form-group text-right">
                                        <input class="btn btn-primary" type="submit" value="Submit">
                                    </div>
                                </div>
                                <input type="hidden" name="edit_id" value="<?php echo $edit_id?>" />

                            </form>
                            
                            
                            
                            
                        </div>
                            
                                                   <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>Previous Addresses<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                
                                                <?php if($records) { 
												$i=0;
												?>
                                                
                                                
                                                
                                                    <div class="scrollable-table-body-cont margin-bottom-20" style="margin-top:10px;">
                                                            <?php foreach ($records as $row) {
																	$i++;
																	
																	 ?>
                                                        <div class="col-sm-4">
                                                
                                                <div class="box_you_order">
                                                
                                                  <h2><?php echo $row["name"]?></h2>
                                                  <br />
                                                   <?php echo $row["street_address"]?> 
                                                      <br />
                                                       <?php echo $row["zip"]?> - <?php echo $row["city"]?> <br />
                                                       <?php echo $row["state"]?>, <?php echo $row["country"]?><br />
                                                       Phone number: <?php echo $row["phone_number"]?>
                                                       <div style="clear:both; height:50px;"></div>
                                                       <a href="<?php echo base_url("addresses");?>/edit/<?php echo $row["id"];?>" class="edit_link">Edit</a>
                                                        <a href="javascript:;" onClick="confirmDelte('addresses','<?php echo $row['id']; ?>')" class="edit_link">Delete</a>
                                                         <a href="javascript:;"  class="edit_link" onClick="setDefault(<?php echo $row['id']; ?>)">Set as Default</a>
                                                         
                                                         <div class="clearfix"></div>


                                                </div>
                                                
                                                
                                                
                                                
                                                
                                              </div>           
                                                                   
                                                                <?php }?>
                                                            
                                                    </div>
                                                <?php } else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                                
                                                
                                                
                                                
                                              
                                                 <div style="clear:both; height:20px;"></div>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
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
		
		location.href="<?php echo base_url("addresses");?>/delete/"+account_type+"/"+id;
		
	} else {
		
	}
}
function setFields(){
    var region = $('#region').val();
	
	$('#country').val(region);
	
	$('.all').hide();
	$('#'+region).show();
    
}

function setDefault(id){
	
	var r = confirm("Are you sure you want to make it default address?");
	if (r == true) {
	
   
  alert("Address has been set as default.");return false;
        jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('frontend/users/setDefault'); ?>',
            data: {'id': id},
            success: function (response) {
        alert(response);return false;
        if (response.success) {
                    $('#totalCartItems').html('('+response.totalCartItems+')');
          
          $('#totalCartValue').html('('+response.total+')');
          $('#total').html('('+response.total+')');
                    $('#totalitems').html(response.totalCartItems+' item in cart.');
                    $('#cartModal').modal('show');
                }else{
                    alert('There is an error.Try Again');
                }
            }
        });//End ajax
    
	
	}
	
	
	}
</script>

<input type="hidden" id="country" value="" >	









<style>
.btn-primary{
background: #ab9271 !important;
color:#fff;
border-radius:2px !important;
padding:8px 25px;
font-size: 18px;
border:none !important;
}
.btn-primary:hover{
background: #323232 !important;
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
border:solid 2px #bb9870 ;
}
a.edit_link {
   
    background: #bb9870;
    color: #fff !important;
    padding: 2px 14px;
    color: #fff;
    border-radius:1px;
}
a.edit_link:hover {
   
    background: #323232;
   
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
.edit_link
{
	color:#0066c0 !important;
	font-size:16px;
	float:left;
	margin-left:10px;
}
.edit_link:hover
{
	color:#0066c0;
	font-size:16px;
	float:left;
	margin-left:10px;
}


</style>