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

                    <h3> Add Products for pricing</h3>
                    

                    
                    
                    <div class="panel">
                            <div class="inner-content">
                                
                                
                                
                                
                                
                            </div>
                            
                                                   <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>Select the products to add to Pricing<?php //echo getlanguage('cash_outs'); ?></h2>
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
                                                                                    
                                                                                    <a href="<?php echo base_url("add_skus")."/"; ?><?php echo $row['id']; ?>" class="btn btn-primary">Choose SKUS</a>
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