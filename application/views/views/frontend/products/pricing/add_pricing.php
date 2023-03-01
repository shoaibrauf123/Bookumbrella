<?php
    $user_id = decode_uri($this->uri->segment(2));
?>



<style>
a.btn.btn-primary {
color: white;
background: #bb9870 !important;
border: 1px solid #bb9870 !important;
transition:0.2s;
}
a.btn.btn-primary:hover {
color: white;
border: 1px solid #323232 !important;
background  : #323232 !important;
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

<?php if($pricing_rule){ ?>
                    <h3> Update your Auto-Repricing Rule</h3>
                    
                            <div class="inner-content">
                                <form method="post" action="<?php echo base_url('pricing_rules')?>/<?php echo $this->uri->segment(2)?>">
                                    <div class="col-sm-6 margin-top-20">
                                        <div class="form-group">
                                            <label for="name" style="color:">Name </label>
                                            <input id="name" class="form-control" value="<?php echo $pricing_rule[0]['name'];?>" name="name" type="text" required>
                                        </div>
                                          
                
                
                 <div class="form-group">
                    <label>Method to Charge <span class="text-danger"></span></label>
                    
                    <select class="form-control" onChange="ShuffleAmountType(this.value)" name="pricing_amount_type">
                     <option <?php if($pricing_rule[0]['pricing_amount_type'] == 'percentage') {?> selected <?php } ?> value="percentage">Percentage</option>   
                    <option <?php if($pricing_rule[0]['pricing_amount_type'] == 'fixed') {?> selected <?php } ?>  value="fixed" >Fixed</option>   
                    
                    </select>
                </div> 
                
                
                 
                                        
                                        
                                        
                                        
                                        
                  
                                        
                                                                
                <div class="form-group">
                
                <label for="status">Select Status  </label>
                    
                                    <select class="form-control" name="status">
                     <option <?php if($pricing_rule[0]['status'] == 'active') {?> selected <?php } ?> value="active">Active</option>   
                    <option <?php if($pricing_rule[0]['status'] == 'In-Active') {?> selected <?php } ?>  value="In-Active">In-Active</option>   
                    
                    </select>
                    
                </div>    
                <div class="form-group">
                                            <label for="amount">Amount </label>
                                            <input id="amount" class="form-control" value="<?php echo $pricing_rule[0]['amount'];?>" name="amount" type="text" required>
                                        </div>
                
                
<br>
<br>
<br>
                
                
                                        <div class="form-group text-right">
                                            <input name="id" value="<?php echo $pricing_rule[0]['id'];?>" type="hidden">
                                            
                                            <input class="btn btn-primary" type="submit" value="Update">
                                        </div>
                                    </div>
                                </form>
                                
                                
                                
                                
                            </div>
                            
<?php }else{ ?>
             <h3> Add your Auto-Repricing Rule</h3>
                    
                            <div class="inner-content">
                                <form method="post" action="<?php echo base_url('pricing_rules')?>">
                                    <div class="col-sm-6 margin-top-20">
                                        <div class="form-group">
                                            <label for="name" style="color:#000">Name </label>
                                            <input id="name" class="form-control" name="name" type="text" required>
                                        </div>
                                          
                
                
                 <div class="form-group">
                    <label style="color:#000">Method to charge <span class="text-danger"></span></label>
                    
                    <select class="form-control" onChange="ShuffleAmountType(this.value)" name="pricing_amount_type">
                     <option value="percentage">Percentage</option>   
                    <option value="fixed" selected>Fixed</option>   
                    
                    </select>
                </div> 
                
                 
                                        
                                        
                                        
                                        
               <div class="form-group">
                                            <label for="amount" style="color:#000">Amount </label>
                                            <input id="amount" class="form-control" value="" name="amount" type="text" required>
                                        </div>                          
                  
                                        
                                                                
                
                
<br>
<br>
<br>
                
                
                                        <div class="form-group text-right">
                                            <input name="pm" value="pricing" type="hidden">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                                
                                
                                
                                
                            </div>
       
<?php } ?>                            
                            
                            
                                                   <div class="clearfix"></div>
                                                   <div class="clearfix"></div><div class="clearfix"></div><br>
<br>


                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h3 style="margin-left:20px;">Repricing Rule Details<?php //echo getlanguage('cash_outs'); ?></h3>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0" style="color:#000;">
                                                   
                                                    
                                                    <tr>
                                                        <td width="25%" style="border-top:0px; border-bottom:solid 2px #ddd;"><strong>Name</strong></td>
                                                        
                                                      <td width="25%" style="border-top:0px; border-bottom:solid 2px #ddd;"><strong>Amount</strong></td>
                                                     <td width="25%" style="border-top:0px; border-bottom:solid 2px #ddd;"><strong>Status</strong></td>
                                                         <td width="25%" style="border-top:0px; border-bottom:solid 2px #ddd;"><strong>Action</strong></td>
                                                    </tr>
                                                    
                                                    
                                               
                                                </table>
                                                <?php if($pricing_rules) { 
												$i=0;
												?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                            <tbody>
                                                                <?php foreach ($pricing_rules as $row) {
																	
																	$pricing_action = $this->comman_model->get('pricing_actions',array('id'=>$row['pricing_actions_id']));				
																	$i++;
																	
																	 ?>
                                                                 <tr>
<td width="25%"><?php echo $row['name']; ?></td>


<td width="25%"><?php echo $row['amount']; ?></td>
<td width="25%"><?php echo $row['status']; ?></td>                                                                               
                                                                                <td width="25%">
                                                                                    <?php /*?><a href="javascript:;" onClick="confirmDelte('pm_paypal','<?php echo $row['id']; ?>')">Delete</a><?php */?>
                                                                                    
                                                                                    <a href="<?php echo base_url("pricing_rules")."/"; ?><?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                                                                    &nbsp;&nbsp;
                                                                                    <a href="<?php echo base_url("assign_pricing")."/"; ?><?php echo $row['id']; ?>" class="btn btn-primary">Apply this Rule</a>
                                                                                    
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
                            
                            
                            




                    
                    <div>
                        
                    </div>
                    
                    
                    


                </div>
            </div>
        </div>
    </div>
</div>
<script>


function ShuffleAmountType(value){
	
	if(value == 'percentage'){
			$("#percentage").show();
			$("#fixed").hide();
		}
	if(value == 'fixed'){
			$("#percentage").hide();
			$("#fixed").show();
		
		}		
	
	}
function confirmDelte(account_type,id){
	

	var r = confirm("Are you sure you want to delete?");
	if (r == true) {
		
		location.href="<?php echo base_url("payment_method");?>/delete/"+account_type+"/"+id;
		
	} else {
		
	}
}

</script>