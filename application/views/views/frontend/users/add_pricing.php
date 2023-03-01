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

<?php if($pricing_rule){ ?>
                    <h3> Update Pricing Rule</h3>
                    
                            <div class="inner-content">
                                <form method="post" action="<?php echo base_url('pricing_rules')?>/<?php echo $this->uri->segment(2)?>">
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
                                        <div class="form-group">
                                            <label for="name">Name *</label>
                                            <input id="name" class="form-control" value="<?php echo $pricing_rule[0]['name'];?>" name="name" type="text" required>
                                        </div>
                                         <div class="form-group">
                    <label>Pricing Action <span class="text-danger">*</span></label>
                    <?
                   // print_r($pricing_actions);
					?>
                    <select class="form-control" name="pricing_actions_id">
                    
                    <?php
					if($pricing_actions){
						foreach($pricing_actions as $row){
					 ?>
                        <option value="<?php echo $row['id'];?>" <?php if($pricing_rule[0]['pricing_actions_id']==$row['id']) { ?>  selected <?php } ?> ><?php echo $row['name'];?></option>
					<?php
						}
					}
					 ?>
                    
                    </select>
                </div> 
                
                
                 <div class="form-group">
                    <label>How to Charge <span class="text-danger">*</span></label>
                    
                    <select class="form-control" onChange="ShuffleAmountType(this.value)" name="pricing_amount_type">
                     <option <?php if($pricing_rule[0]['pricing_amount_type'] == 'percentage') {?> selected <?php } ?> value="percentage">Percentage</option>   
                    <option <?php if($pricing_rule[0]['pricing_amount_type'] == 'fixed') {?> selected <?php } ?>  value="fixed" >Fixed</option>   
                    
                    </select>
                </div> 
                
                <?php 
				$percent_display = 'style="display:none;"';
				$fixed_display = 'style="display:none;"';
				if($pricing_rule[0]['pricing_amount_type'] == 'percentage') {
					$percent_display = '';
					 }elseif($pricing_rule[0]['pricing_amount_type'] == 'fixed') {
					$fixed_display = '';
					 } ?> 
                
                
                 <div class="form-group">
                                            <label for="amount">Amount (<span <?php echo $percent_display;?> id="percentage">%</span><span <?php echo $fixed_display;?> id="fixed">$</span>) *</label>
                                            <input id="amount" class="form-control" value="<?php echo $pricing_rule[0]['amount'];?>" name="amount" type="text" required>
                                        </div>
                                        
                                        
                                        
                                        
                                        
                  <div class="form-group">
                                            <label for="min_price">Minimum Price  *</label>
                                            <input id="min_price" class="form-control" name="min_price" value="<?php echo $pricing_rule[0]['min_price'];?>" type="text" required>
                                        </div>
                                        
                  <div class="form-group">
                                            <label for="max_price">Maximum Price  *</label>
                                            <input id="max_price" class="form-control" name="max_price" value="<?php echo $pricing_rule[0]['max_price'];?>" type="text" required>
                                        </div>                                              
                <div class="form-group">
                
                <label for="status">Select Status  *</label>
                    
                                    <select class="form-control" name="status">
                     <option <?php if($pricing_rule[0]['status'] == 'active') {?> selected <?php } ?> value="active">Active</option>   
                    <option <?php if($pricing_rule[0]['status'] == 'In-Active') {?> selected <?php } ?>  value="In-Active">In-Active</option>   
                    
                    </select>
                    
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
             <h3> Add Pricing Rule</h3>
                    
                            <div class="inner-content">
                                <form method="post" action="<?php echo base_url('pricing_rules')?>">
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
                                        <div class="form-group">
                                            <label for="name">Name *</label>
                                            <input id="name" class="form-control" name="name" type="text" required>
                                        </div>
                                         <div class="form-group">
                    <label>Pricing Action <span class="text-danger">*</span></label>
                    <?
                   // print_r($pricing_actions);
					?>
                    <select class="form-control" name="pricing_actions_id">
                    
                    <?php
					if($pricing_actions){
						foreach($pricing_actions as $row){
					 ?>
                        <option value="<?php echo $row['id'];?>" ><?php echo $row['name'];?></option>
					<?php
						}
					}
					 ?>
                    
                    </select>
                </div> 
                
                
                 <div class="form-group">
                    <label>How to Charge <span class="text-danger">*</span></label>
                    
                    <select class="form-control" onChange="ShuffleAmountType(this.value)" name="pricing_amount_type">
                     <option value="percentage">Percentage</option>   
                    <option value="fixed" selected>Fixed</option>   
                    
                    </select>
                </div> 
                
                 <div class="form-group">
                                            <label for="amount">Amount (<span style="display:none;" id="percentage">%</span><span id="fixed">$</span>) *</label>
                                            <input id="amount" class="form-control" name="amount" type="text" required>
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
                                        <h2>Defined Pricing Rules<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="padding-right-20">
                                                    
                                                    <tr>
                                                        <th  class="col-xs-1 col-sm-1 col-md-1">Name</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Pricing Action</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Amount Type</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Amount</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Status</th>
                                                         <th class="col-xs-1 col-sm-1 col-md-1">Action</th>
                                                    </tr>
                                                    
                                                    
                                                    </thead>
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
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['name']; ?></td>

<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $pricing_action[0]['name']; ?></td>
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['pricing_amount_type']; ?></td>
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['amount']; ?></td>
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['status']; ?></td>                                                                               
                                                                                <td class="col-xs-1 col-sm-1 col-md-1">
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