<style>
  
  button#btn_update_qty{
    float: right;
    width: 65%;
    padding:9px 9px;
    color: #fff;
    border:none !important;
    background:#bb9870;
    border-radius: 2px !important;
  }
  button#btn_update_qty:hover{
   
    background: #323232;
    color:#fff;
    border:none !important;
  }
  button#continue_shopping {
     color: #fff;
    border:none !important;
    padding:9px 24px;
    background:#bb9870;
    border-radius: 2px !important;
}
 button#continue_shopping:hover{
    background: #323232;
    color:#fff;
    border:none !important;
}
a.btn.btn-cart.btn-block {
    background: #323232;
    color:#fff;
    width: 65%;
    padding:9px 9px;
    margin-left: auto;
    border-radius:2px !important;
}
a.btn.btn-cart.btn-block:hover{
   background:#bb9870;

}
a.btn.btn-cart.pull-left {
    background:#bb9870;
    color: #fff;
    border-radius:3px;
}
a.btn.btn-cart.pull-left:hover {
  background: #323232;

}
a.btn.btn-new-adr{
  background:#bb9870;
  color:#fff;
  font-weight:500;
  border-radius: 3px ;
}
a.btn.btn-new-adr:hover{
  background: #323232;
}
.btn-primary{
  background:#bb9870!important;
  color:#fff;
  font-weight:500 !important;
  padding:8px 14px;
  border:none !important;
  border-radius: 3px !important;
}
.btn-primary:hover{
  background: #323232 !important; 
}
td.wdth_td {
    font-weight: 600;
}
p span{
  color:#bb9870 !important;
}
</style>
<?php // print_r(get('store',  array('status'=>1))); ?>

<div class="col-xs-12">
  <div class="container store_listing">
    <div class="row no-padding">
      <div class="col-sm-12 col-xs-12">
        <?php if(isset($errors)){?>
        <div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div>
        <?php }?>
        <?php if(isset($success)){?>
        <div class="alert alert-success" style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div>
        <?php }?>
        <div class="product-filter product_mobile">
          <div class="product-compare"> You have <span id="total_cart_items" style="color: rgb(187, 152, 112) !important;" ><?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('totalCartItems') : 0; ?></span><p>items for a total of <span  id="checkout_top_sub_total" style="color: #bb9870 !important;font-weight: bold;">US$ <?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('total') : 0; ?></span> in your basket<span style="color: rgb(187, 152, 112) !important;" ></p> (Excluding all shipping)</span>. </div>
        </div>
        <?php 
				//echo '<pre>';print_r($this->session->userdata('cartData'));exit;
				$cartData = $this->session->userdata("cartData");
				//echo '<pre>';print_r($cartData);
        if($cartData) { 
		          $standard_shipping = $this->comman_model->print_value("setting",array('slug'=>'standard_shipping'),'value');
							$expedited_shipping = $this->comman_model->print_value("setting",array('slug'=>'expedited_shipping'),'value');
							$second_day = $this->comman_model->print_value("setting",array('slug'=>'second_day'),'value');
							$next_day = $this->comman_model->print_value("setting",array('slug'=>'next_day'),'value');
									
            $total_shipping = 0;
			      $seller_id = '';
			      $item_sub_price = 0;
            $separater_check = 0;	
            $shipping_amount_total = 0;
            $shipping_amount_subtotal = 0;

            $total_price = 0;

			foreach ($cartData as $key => $value) {
			
        $num_sellers_inner = $this->comman_model->getSellerTotalProducts("cart_table",$inserted_ids,$value['seller_id']);
				$num_sellers_inner = 1;
			
				$sellerData = $this->comman_model->get("user",array("user_id"=>$value['seller_id']));
                $productData = get('products', array('product_id' => $value['product_id']));
            $product_image = base_url().'/assets/frontend/img/default-cart.jpg';
                                                    if($productData[0]['image'] != ''){
                                                        $product_image = base_url().$productData[0]['image'];
                                                    }
			
			
			
			//echo '<pre>';print_r($productData);exit;
			?>
        <div class="product-col list clearfix col-sm-12" style="padding:0;">
          <div class="image col-sm-1" style="padding:0;">
            <a href="<?php echo base_url('product/detail') . "/" . encode_url($productData[0]['product_id']); ?>">
            <img class="img-responsive" style="width:94px; height:140px;" alt="product" src="<?php echo $product_image; ?>"> 
            </a>
            </div>
          <div class="col-xs-12 col-sm-7">
			<div>
            <h4 style="margin-bottom:0px; font-weight:bold;"><?php echo $productData[0]['title']?></h4>
            <strong style="color: gray;"> Author:</strong><span style="color: rgb(187, 152, 112)"><?php echo $productData[0]['author']; ?></span> <br>
            <strong> Seller:</strong><span style="color: #bb9870;"><?php echo $sellerData[0]['username']; ?></span> <br>
            <strong> ISBN:</strong><span><?php echo $productData[0]['isbn']; ?></span> <br>
            <strong> ISBN-13:</strong><span><?php echo $productData[0]['isbn13']; ?></span> <br>
            <strong> Quantity:</strong><span><?php echo $value['qty']; ?></span> <br>
            <strong> Price:</strong><span style="color:#bb9870;font-weight: bold;">US$ <?php echo $value['price']; ?></span><br>
            <strong> Shipping:</strong>

<span>
 							<?php 
									
									 $seller_shippings = $this->comman_model->get('seller_shippings',array("seller_id"=>$value['seller_id'])); 
									 
								$total_shipping = $total_shipping + ($value['shipping_amount']*$value['qty']);
								
									 
   							if($seller_shippings[0]['expedited'] == 'active' || $seller_shippings[0]['second_day'] == 'active' || $seller_shippings[0]['next_day'] == 'active'){
								
								//echo '<pre>';print_r($seller_shippings);
								
							?>

 							<select name="shipping_aplied" id="shipping_aplied_<?php echo $value['cart_row_id']; ?>" >
                                
                                <option <?php if($value['shipping_type'] == 'standard') {?> selected <?php } ?>  value="standard-<?php echo $standard_shipping;?>">US$
                                    <?php echo $standard_shipping;?> <span style="color:#000">Standard</span> </option>
                                
                                
                                
                            <?php if($seller_shippings[0]['expedited'] == 'active'){ ?>
                            	<option <?php if($value['shipping_type'] == 'expedited_shipping') {?> selected <?php } ?>  value="expedited_shipping-<?php echo $expedited_shipping;?>">US$
                                    <?php echo $expedited_shipping;?> <span style="color:#000">Expedited</span> </option>
                                <?php 
								} ?>
                            <?php if($seller_shippings[0]['second_day'] == 'active'){ ?>
                            	<option <?php if($value['second_day'] == 'next_day') {?> selected <?php } ?>  value="second_day-<?php echo $second_day;?>">US$
                                    <?php echo $second_day;?> <span style="color:#000">Second day</span> </option>
                                <?php 
								} ?>
                                
                            <?php if($seller_shippings[0]['next_day'] == 'active'){ ?>
                                <option <?php if($value['shipping_type'] == 'next_day') {?> selected <?php } ?> value="next_day-<?php echo $next_day;?>">US$ <?php echo $next_day;?> <span style="color:#000">Next day</span></option>
                                <?php 
								} ?>
                                
                                
                            </select>
                            <?php }else {
   
   ?>
   <input type="hidden" name="shipping_aplied_<?php echo $value['cart_row_id']; ?>" id="shipping_aplied_<?php echo $value['cart_row_id']; ?>" value="standard-<?php echo $standard_shipping;?>" />
                                    <span style="color:#bb9870; float:left;">US$ <?php




                                        echo $standard_shipping;
                                        //$total_shipping = $total_shipping + $standard_shipping;

                                        ?></span>
                              
                            <?php } ?>*<?php echo $value['qty'];?>         
									
                            
                            
</span>
              <!-- <span style=" color:blue; margin-left:50px;">
                  <strong style="color:#000;">Sub Total:</strong>
                  <?php //echo $item_sub_price;?> Book Price + 6 Shipping = <span style="color:#000;font-weight: bold;">US$ <?php echo $shipping_amount_subtotal+ $item_sub_price;?></span>
              </span> -->

              <?php
              if($num_sellers_inner>0){
                  $prev_seller_id = $value['seller_id'];
                  $item_sub_price = $item_sub_price + ($value['price']*$value['qty']);

                  $total_price = $total_price + $item_sub_price;

                  $shipping_amount_subtotal = $shipping_amount_subtotal + ($value['shipping_amount']*$value['qty']);
                  $separater_check++;
                  if( $separater_check==$num_sellers_inner){

                      ?>
                      <span style=" color:gray; margin-left:50px;font-weight: bold;">
                          <strong style="color:#000;">SubTotal:</strong>
                          <?php echo $item_sub_price;?> Book Price + <?php echo $shipping_amount_subtotal; ?> Shipping = <span style="color:#bb9870;font-weight: bold;">US$ <?php echo $shipping_amount_subtotal+ $item_sub_price;?></span>
                      </span>




                      <span style="color:red; float:right; display:none;font-weight: bold;"><strong>SubTotal:</strong> <?php echo $item_sub_price;?>
                          Book Price + <?php echo $shipping_amount_subtotal;?>
                          Shipping = <span style="color:#bb9870;font-weight: bold;">US$ <?php echo $shipping_amount_subtotal+ $item_sub_price;?></span></span>
                      <?php

                      $num_sellers_inner =1;
                      $separater_check=0;
                      $item_sub_price = 0;
                      $shipping_amount_subtotal = 0;
                  }

              }


              ?>



 </div>
          
        </div>
          <div class="col-xs-12 col-sm-2 pull-right">
            <div class="cart-button button-group"> <a href="<?php echo base_url('cart/remove').'/'.$key; ?>" class="btn btn-cart btn-block"  type="button">Remove</a> <br>
            
            <div style="float: right; margin-top: 10px; margin-bottom: 10px;"> 
              <p style="line-height:31px; color:#999; display: inline;">Quantity</p>
              
              <?php if($value['qty']>=10){ ?>
              <input type="text"  class="form-control"  maxlength="5" size="3" name="new_qty" id="new_qty_<?php echo $value['cart_row_id']; ?>" value="<?php echo $value['qty']; ?>"  style="width:68px; margin-bottom:16px; float:right;" />
              <?php
			  }else{
				  ?>
				  
                  <select maxlength="5"  style="margin-bottom:5px;" id="new_qty_<?php echo $value['cart_row_id']; ?>">
                  	<?php
                    for($i=1;$i<=10;$i++){
						?>
						<option <?php if($i == $value['qty']) { ?> selected <?php  } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php
						}
					?>
                  </select>
                  
				  <?php
				  
				  }
			  ?>
               </div>
              <br>
             
              <button class="btn btn-cart btn-block" id="btn_update_qty"  onClick="UpdateProductQty(<?php echo $value['cart_row_id']; ?>,<?php echo $value['qty']; ?>)" >Update</button>
              <br>
            </div>
          </div>
       <?php
      if($num_sellers_inner>0){
					  $prev_seller_id = $value['seller_id'];
					  $item_sub_price = $item_sub_price + $value['price'];



					 $shipping_amount_subtotal = $shipping_amount_subtotal + ($value['shipping_amount']*$value['qty']);
					  $separater_check++;
				  if( $separater_check==$num_sellers_inner){

					 ?>
					 <span style="color:red; float:right; display:none;font-weight: bold;"><strong>SubTotal:</strong> <?php echo $item_sub_price;?> Book Price + <?php echo $shipping_amount_subtotal;?>
                         Shipping = <span style="color:#bb9870;font-weight: bold;">US$ <?php echo $shipping_amount_subtotal+ $item_sub_price;?></span></span>
					 <?php

					  $num_sellers_inner =1;
						$separater_check=0;
						$item_sub_price = 0;
					  $shipping_amount_subtotal = 0;
					}

				  }


	  ?>
      </div>
      
      
      
      <div class="listing-block-separator" style="border-bottom:2px solid #000;"></div>
      <?php 
	  
	  } 
	  $this->comman_model->deleteRecentinserted("cart_table",$inserted_ids);
	  
	  }else{ ?>
      <div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> Cart is empty!</div>
      <?php } ?>
      <div class="product-filter product_mobile"  style="border-top:0px;">
      	<?php
        $final_value_on_product = $this->comman_model->print_value("setting",array('slug'=>'final_value_on_product'),'value');
		
		if($this->session->userdata('totalCartItems')!=''){ ?>
      	<div class="col-xs-12 col-sm-9">
      
      		<div class="col-xs-12 col-sm-6 col-sm-offset-5">
      				<strong style="float: left; margin-top: 5px; margin-right: 5px;"> Coupon Code: </strong>
					<input type="text"  class="form-control" id="coupon_code" value="<?php echo $this->session->userdata("coupon_code"); ?>"  style="width:200px; float:left;" />
        			<?php if(!$this->session->userdata("coupon_code_valid") && $this->session->userdata("coupon_code")){ ?><span style="color:red; font-size:12px;">invalid coupon code</span><?php } ?>
      		<a href="javascript:void(0)" onclick="UpdateCoupon()" class="btn btn-cart pull-left" style="margin-left:5px;" type="button">Apply</a>
      		</div>
            
          <div class="col-xs-12 col-sm-4">  <?php if($this->session->userdata("coupon_code_valid")){ $discount = ($this->session->userdata('total')/100)* $this->session->userdata("discount"); }else{ $discount = 0; } ?></div>
        	
        </div>
        <div class="col-xs-12 col-sm-3 pull-right" style="padding:0px; margin-bottom:10px;">
        	<div class="col-xs-12 col-sm-9 pull-right" style="padding:0px;">
        	
                <?php if($discount){ ?>
        	<div class="col-xs-12 col-sm-6"><strong> Discount: </strong></div><div class="col-xs-12 col-sm-6 text-right"><span style="color:#bb9870; font-weight:bold;">-US$ <?php echo $discount; ?></span> </div>
        	<?php } ?>
        	<div class="col-xs-12 col-sm-6"><strong>Grand Total: </strong></div><div class="col-xs-12 col-sm-6 text-right"><span style="color:#bb9870; font-weight:bold;">US$ <?php echo ($total_price - $discount)  + $total_shipping; ?></span> </div>
        	</div>
        </div>
        
        
        
        
        
        <?php /*?><div class="product-compare  pull-right"> Admin Value: 
        
        <span style="color:#900">
        $<?php  
		
		 echo $final_value_on_product; 
		
		?> 
        </span>
        
        
        </div><?php */?>
        

      
      <div class="listing-block-separator"></div>
      
      <div class="col-sm-12 pull-right" style="padding: 10px; text-align: center; margin-top:-13px;">
     <?php
      $addresses = $this->comman_model->get("addresses",array("user_id"=>$this->session->userdata("user_id")));
	  ?>
          <select name="shipping_address" id="shipping_address" style="height:35px; margin-right:20px;">
              <option value="">Select Address</option>
          <?php
      if($addresses){
	 ?> 
    

      <?php
		  foreach($addresses as $row){
			  	?>
				<option value="<?php echo $row["id"]?>" <?php echo ($row["is_default"]=='yes')? 'selected':''; ?>>
                <?php echo $row["street_address"]?>,<?php echo $row["city"]?>,<?php echo $row["state"]?>,<?php echo $row["phone_number"]?>
                </option>
				<?php
		  }
	
	 ?>

        
       <?php
		  }
	   ?>
          </select>
          <a class="btn btn-new-adr" href="javascript:;" onClick="ShowAddressModal()">Add New Address?</a>
     
       
       </div>
     
      
  
      
      
      
      <?php

			
				?>
                <style>
                .wdth_td
				{
					width:16% !important;
				}
                
                </style>
                <div style="clear:both; height:10px;"></div>
                <div class="col-sm-12"> <strong style="font-size:20px;">Select your Credit Card </strong> <a href="javascript:;" onClick="ShowCardModal()">Add New Card?</a></div>
                <div style="clear:both; height:10px;"></div>
				  <table class="table history-table scrollable-table-head margin0" style="background:#eee;">

                                                    
                                                    <tr>
                                                        <th  class="wdth_td">Serial#</th>
                                                        <th class="wdth_td">Title</th>
                                                        <th class="wdth_td">Card Number</th>
                                                        <th class="wdth_td">Expiry Month</th>
                                                        <th class="wdth_td">Expiry Year</th>
                                                         <th class="wdth_td">Select</th>
                                                    </tr>
                                                    
                                                    
                                                    
          </table>
                                                <?php
												$selected_card_id = '';
												 if($card_accounts) { 
												$i=0;
												?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                           
                                                                <?php foreach ($card_accounts as $row) {
																	$i++;
																	
																	 ?>

                                                                 <tr>
<td class="wdth_td"><?php echo $i; ?></td>

 <td class="wdth_td"><?php echo $row['title']; ?></td>
  <td class="wdth_td"><?php echo "****".substr($row['card_no'], -4)  ?></td>
   <td class="wdth_td"><?php echo $row['expiry_month']; ?></td>
    <td class="wdth_td"><?php echo $row['expiry_year']; ?></td>
    
                                                                               
                                                       <td class="wdth_td">
                                                       <?php if($row['is_default'] == 'yes') {
														   $selected_card_id = $row["id"];
														   
														    }?>
                                                                                 <input type="radio" <?php if($row['is_default'] == 'yes') { ?>  checked="checked" <?php } ?> onClick="SelectedCheckoutCard(<?php echo $row['id']; ?>)" name="card_id" id="card_id" value="<?php echo $row['id']; ?>" />
                                                                                </td>
                                                                                
                                                              </tr>  
                                                                   
                                                                <?php }?>
                                                           
                                                        </table>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                                
                                                
                                                
				<?php
			
		
		?>
		
		<input type="hidden" name="selected_card_id" id="selected_card_id" value="<?php echo $selected_card_id;?>" />
      
       <div style="clear:both; height:10px;"></div>
          <div class="col-sm-12"> 
         
             <div class="col-sm-6  col-sm-offset-3 pull-left">
              <div class="col-sm-6"><input onClick="SelectedCheckoutCard('paypal')" name="card_id"  style="margin-top: 27px; margin-left: 7px;" type="radio" value="paypal" /> <a href="#" class="pull-left"><img src="<?php echo base_url('assets/frontend'); ?>/img/paypal.png" width="100%"  alt="" /></a>
               
              </div>
               <div class="col-sm-6"> <a href="#" class="pull-left"><img src="<?php echo base_url('assets/frontend'); ?>/img/amzin.png" width="100%"  alt="" /></a> 
                <input onClick="SelectedCheckoutCard('amazon')" name="card_id" type="radio"  style="margin-top: 27px; margin-left: 7px;" value="amazon" />
               </div>
            </div>
           
             
            <div style="clear:both; height:30px;"></div>
             
        <a href="javascript:void(0)" onclick="checkout();" class="btn btn-cart col-sm-offset-5" style="margin-top:-3px;" type="button">Checkout</a>  </div>
        
        
        
		<?php
		
		}
	  
	  
	  ?>
      
     
      </div>
      
      
      
      
      
      
      
    </div>
  </div>
</div>
</div>
<script type="text/javascript">

function UpdateCoupon(){
	var coupon_code = $("#coupon_code").val();
  if(coupon_code == ""){
    alert('Coupon Code is empty.');
    return false;
  }
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url('cart/update_coupon'); ?>",
            data: {"coupon_code": coupon_code},
            dataType: 'json',
            error: function (request, error) {
                alert('There is an error.Try Again');
            },
            success: function (response) {
				//alert(response);return false;
                if (response.success){
					location.reload();
				}else{
			        alert('There is an error.Try Again');
			    }
			}
		});//End ajax
}

function UpdateProductQty(cart_row_id,org_qty){
	var new_qty = $("#new_qty_"+cart_row_id).val();
	var shipping = $("#shipping_aplied_"+cart_row_id).val();
	//alert(shipping);
	 //alert(cart_row_id + "---" + org_qty + "---" + new_qty);
	 jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('cart/update-qty-product'); ?>',
            data: {'cart_row_id': cart_row_id,'org_qty':org_qty,'new_qty':new_qty,'shipping':shipping},
            dataType: 'json',
            error: function (request, error) {
                alert('There is an error.Try Again');
                //jQuery('#eventError').html('There is an error.Try Again').show();
              },
            success: function (response) {
				//alert(response);return false;
                if (response.success) {
					
                    $('#totalCartItems').html('('+response.totalCartItems+')');
					$(".modal-title").html("Item quantity updated.");
					$("#continue_shopping").html("Close");
					$(".modal-body").css("height","165px");
					$("#popup_checkout").hide();
					
					$('#checkout_top_sub_total').html('$'+response.total+'');
					$('#checkout_bottom_sub_total').html('$'+response.total+'');					
					$('#totalCartValue').html('('+response.total+')');
					$('#total').html('('+response.total+')');
                    $('#totalitems').html(response.totalCartItems+' item in cart.');
                    $('#total_cart_items').html(response.totalCartItems+'');
					$('#cartModal').modal('show');
					
					$( "#continue_shopping" ).click(function() {
  location.reload();
	});

					
                	 
				}else{
                    alert('There is an error.Try Again');
                }
            }
        });//End ajax
	
	}

function checkout(){
   
    //alert($("#shipping_address").val());return false;
	//alert($("#selected_card_id").val());return false;
	var payment_method = $("#selected_card_id").val();
	var payment_method_string = 'Credit Card';
	var shipping_address = $("#shipping_address").val();
	if(shipping_address == ''){
		alert("Please select shipping address.");return false;
		}
		
	
	if(payment_method == 'paypal'){
		payment_method_string = 'Paypal';
		}
	if(payment_method == 'amazon'){
		payment_method_string = 'Amazon;';
		}
		
  $('#return_url').val("<?php echo base_url('cart/purchase'); ?>/"+shipping_address+"/"+payment_method);	
  
  var r = confirm("Are you sure you want to checkout with "+payment_method_string+"?");
	if (r == true) {
		
	if(payment_method == 'paypal'){		
    document.getElementById("paypal_form").submit();
    return false;
	}
	if(payment_method == 'amazon'){		
    window.location.href="https://www.amazon.com";
    return false;
	}
  var shipping_address = $("#shipping_address").val();
  $('.loading').show();
  setTimeout(function(){location.href="<?php echo base_url('cart/purchase'); ?>/"+shipping_address+"/"+payment_method+""} , 1000);
	
	}
}
</script> 

<?php
$paypal_email = 'amahmud.qa-facilitator@gmail.com';
$return_url = base_url("cart/purchase");
$cancel_url = base_url("product/checkout");

//$paypal_url ='https://www.paypal.com/cgi-bin/webscr';
$paypal_url ='https://www.sandbox.paypal.com/cgi-bin/webscr';
?>
<form id="paypal_form" action="<?php echo $paypal_url;?>" method="post"  accept-charset="utf-8">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="<?php echo $paypal_email; ?>">
  <input type="hidden" name="item_name" value="Memorex 256MB Memory Stick">
  <input type="hidden" name="item_number" value="MEM32507725">
  <input type="hidden" name="amount" value="<?php echo ($this->session->userdata('total') - $discount) + $total_shipping; ?>">
  <input type="hidden" name="currency_code" value="USD">

  <input type="hidden" name="return" id="return_url" value="<?php echo $return_url; ?>">
  <input type="hidden" name="cancel_return" value="<?php echo $cancel_url; ?>">

  <input type='hidden' name='rm' value='2'>
  <!-- Enable override of buyers's address stored with PayPal . -->
  <!-- <input type="hidden" name="address_override" value="1"> -->
  <!-- Set variables that override the address stored with PayPal. -->
  <!-- <input type="hidden" name="first_name" value="John">
  <input type="hidden" name="last_name" value="Doe">
  <input type="hidden" name="address1" value="345 Lark Ave">
  <input type="hidden" name="city" value="San Jose">
  <input type="hidden" name="state" value="CA">
  <input type="hidden" name="zip" value="95121">
  <input type="hidden" name="country" value="US"> -->
</form>

<?php /* ?>
<form id="paypal_form" action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="business" value="seller@designerfotos.com">
  <input type="hidden" name="item_name" value="hat">
  <input type="hidden" name="item_number" value="123">
  <input type="hidden" name="amount" value="<?php echo ($this->session->userdata('total') - $discount) + $final_value_on_product + $total_shipping; ?>">
  <input type="hidden" name="first_name" value="John">
  <input type="hidden" name="last_name" value="Doe">
  <input type="hidden" name="address1" value="9 Elm Street">
  <input type="hidden" name="address2" value="Apt 5">
  <input type="hidden" name="city" value="Berwyn">
  <input type="hidden" name="state" value="PA">
  <input type="hidden" name="zip" value="19312">
  <input type="hidden" name="night_phone_a" value="610">
  <input type="hidden" name="night_phone_b" value="555">
  <input type="hidden" name="night_phone_c" value="1234">
  <input type="hidden" name="email" value="<?php echo $this->session->userdata("email")?>">

</form>
<?php */ ?>