<?php
    $user_id = decode_uri($this->uri->segment(2));
?>

<div class="add-payment-method-cont col-xs-12">
    <div class="container">
        <div class="row">

            <div class="co-md-4 col-sm-4 col-sm-offset-4">

                <?php if (isset($errors)) { ?>
                    <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                
                <?php
                if($mystore){
				?>
				
                <div>


                    <h3>Update store</h3>
                    
                 
                        

                        <form method="post" action="<?php echo base_url('add_store')?>" method="post" enctype="multipart/form-data">
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20 padding0">
                                        <div class="form-group">
                                            <label for="account-no">Store Name *</label>
                                            <input id="name-id" class="form-control" name="name" value="<?php echo $mystore[0]['name']; ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="account-no">Store Address </label>
                                            <input id="address-id" class="form-control" name="address" value="<?php echo $mystore[0]['address']; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="account-title">Display Image *</label>
                                           
                                          
                                          
                                                <input name="image" type="file" class="default" style=" border: 1px solid #eee; padding: 5px; width: 100%;">
                                            
                                            
                                            <?php if($mystore[0]['image_url'] !=''){
                            $img = base_url('uploads/img_gallery/store_images').'/'.$mystore[0]['image_url'];
                        } else {
                            $img = base_url('uploads/img_gallery/store_images/default-store-350x350.jpg');
                        }?>

                        <div class="pdg_15 align_img"><img alt="Store" src="<?php echo $img; ?>"></div>
                                            
                                        </div>

                                        
                                        
                                        <div class="form-group text-right">
                                            <input name="update" value="yes" type="hidden">
                                            
                                            <input name="store_id" value="<?php echo $mystore[0]['store_id']; ?>" type="hidden">
                                            
                                            
                                            <input class="btn btn-primary" type="submit" value="Update">
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


                    <h3>Add your store</h3>
                    <p>You can setup your own store and after this setup you will be able to sell your items online.</p>

                 
                        

                        <form method="post" action="<?php echo base_url('add_store')?>" method="post" enctype="multipart/form-data">
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
                                        <div class="form-group">
                                            <label for="account-no">Store Name *</label>
                                            <input id="name-id" class="form-control" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="account-no">Store Address </label>
                                            <input id="address-id" class="form-control" name="address" value="<?php echo $mystore[0]['address']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="account-title">Display Image *</label>
                                           
                                          
                                          
                                                <input name="image" type="file" class="default" style=" border: 1px solid #eee; padding: 5px; width: 100%;">
                                            
                                            
                                           
                                            
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
<div class="clear20"></div>
<script>
function confirmDelte(account_type,id){
	

	var r = confirm("Are you sure you want to delete?");
	if (r == true) {
		
		location.href="<?php echo base_url("payment_method");?>/delete/"+account_type+"/"+id;
		
	} else {
		
	}
}

</script>