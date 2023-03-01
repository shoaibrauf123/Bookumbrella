<?php // print_r(get('store',  array('status'=>1))); ?>
<div class="col-xs-12">
    <div class="container store_listing">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12">

                <?php if(isset($errors)){?><div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div><?php }?>
                <?php if(isset($success)){?><div class="alert alert-success" style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div><?php }?>

                

                
                <div class="product-filter product_mobile">
                        
                    <div class="product-compare">
                        You have <?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('totalCartItems') : 0; ?> items for a total of US$<?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('total') : 0; ?> in your basket.
                    </div>     
                </div>

                <?php 
				
				$cartData = $this->session->userdata("cartData");
				//echo '<pre>';print_r($cartData);exit;
        if($cartData) { 
            foreach ($cartData as $key => $value) {
				$sellerData = $this->comman_model->get("user",array("user_id"=>$value['seller_id']));
                $productData = get('products', array('product_id' => $value['product_id']));
            
			//echo '<pre>';print_r($productData);exit;
			?>
                 <div class="product-col list clearfix col-sm-12">

                    <div class="image col-sm-2">
                        <img class="img-responsive" alt="product" src="<?php echo getProductImage($productData[0]['isbn']); ?>">
                    </div>

                    <div class="caption col-sm-10">

                        <h4><?php echo $productData[0]['title']; ?></h4>
                        
                        <strong> Seller:</strong><span><?php echo $sellerData[0]['first_name']. " " . $sellerData[0]['last_name']; ?></span>
                            <br>	
                            <strong> ISBN-10:</strong><span><?php echo $productData[0]['isbn']; ?></span>
                            <br>
                            <strong> Quantity:</strong><span><?php echo $value['qty']; ?></span>
                             <br>
                            <strong> Price:</strong><span><?php echo $value['price']; ?></span>
                        <div class="cart-button button-group">
                        <a href="<?php echo base_url('cart/remove').'/'.$key; ?>" class="btn btn-cart" type="button">Remove</a>
						
                        <input type="text" maxlength="5" size="3" name="new_qty" id="new_qty_<?php echo $value['cart_row_id']; ?>" value="<?php echo $value['qty']; ?>" />
                        
                        <button class="btn btn-cart" id="btn_update_qty" onClick="UpdateProductQty(<?php echo $value['cart_row_id']; ?>,<?php echo $value['qty']; ?>)" >Update</button>
                        </div>

                    </div>

                </div>
        <div class="listing-block-separator"></div>
<?php } }else{ ?>
<div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> Cart is empty!</div>
<?php } ?>
                 
            
              <div class="product-filter product_mobile">
                        
                    <div class="product-compare  pull-right">
                        Total: US$<?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('total') : 0; ?>
                    </div>     
                </div>
                <div style="padding: 10px; text-align: center;">

                    <a href="<?php echo base_url('cart/purchase'); ?>" class="btn btn-cart" type="button">Paypal Checkout</a>
                </div>
            </div>

        </div> 

    </div>
</div>




<script type="text/javascript">

function UpdateProductQty(cart_row_id,org_qty){
	var new_qty = $("#new_qty_"+cart_row_id).val();
	 //alert(cart_row_id + "---" + org_qty + "---" + new_qty);
	
	 jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('cart/update-qty-product'); ?>',
            data: {'cart_row_id': cart_row_id,'org_qty':org_qty,'new_qty':new_qty},
            dataType: 'json',
            error: function (request, error) {
                alert('There is an error.Try Again');
                //jQuery('#eventError').html('There is an error.Try Again').show();
              },
            success: function (response) {
				//alert(response.total);return false;
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


</script>
