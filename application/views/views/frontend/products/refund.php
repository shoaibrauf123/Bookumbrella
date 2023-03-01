<script>
    function PopulateRefundAmount(){

    }
</script>
<?php
$product = $this->comman_model->get("products",array('product_id'=>$order[0]['product_id']));
//echo '<pre>';print_r($order);
?>
 <?php if (isset($errors)) { ?>
                        <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>
                        
                        
<div class="col-md-12">
                               
                               <div style="clear:both; height:20px;"></div>

                               <div class="col-sm-12"  style="border-bottom: 1px dashed #000; padding-bottom:20px; padding-left:0px;">
                               <div class="image col-sm-1" style="padding-left:0px;">
            <a href="<?php echo base_url("product_detail")."/"?><?php echo encode_url($product[0]['product_id'])?>">
            <img class="" style="width:94px; height:140px;" alt="product" src="<?php echo base_url()?><?php echo $product[0]['image']?>"> </a></div>
                                <div class="image col-sm-10">
                               <h4><?php echo $order[0]['book_title']?></h4>
                                <div class="clearfix"></div>
                                
                         
                         	   <form id="sell_item_form" action="<?php echo base_url('refund') ?>" method="post">
							   <?php
							   
								   
								   
								   ?>

                                   <div>
                                            
                                            <div class="col-xs-12 col-sm-6 col-md-12 no-padding">
                                               
                                                
                                                <div>
           
            
         
            
                <strong> ISBN-10:</strong><span><?php echo $order[0]['isbn']?></span><strong> ISBN-13:</strong><span><?php echo $order[0]['isbn13']?></span>
                <strong> SKU:</strong><span></span> <br>
                
                <strong> Quantity:</strong><span><?php echo $order[0]['qty']?></span> <strong> Author:</strong><span><?php echo $product[0]['author']?></span><br>
                <strong> Condition:</strong><span><?php echo $product[0]['book_condition']?></span> <strong> Type:</strong><span><?php echo $product[0]['book_type']?></span><br />


 <a href="javascript:;" id="<?php echo $order[0]['id']?>" onClick="ShowContactBuyerModal_<?php echo $order[0]['id']?>(<?php echo $order[0]['id']?>)">Contact Buyer</a> |
 <a href="javascript:;" onClick="ShowAddressDetailModal_<?php echo $order[0]['id']?>(<?php echo $order[0]['id']?>)">Click to view Shipping Address</a>


                                                    <script>
                                                        function ShowContactBuyerModal_<?php echo $order[0]['id']?>(id){
                                                            $('#ContactBuyerModal_'+id).modal('show');

                                                        }


                                                    </script>
                                                    <div id="ContactBuyerModal_<?php echo $order[0]['id']?>" class="modal fade" role="dialog" style="z-index:999999">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" style="color:#0C0; font-weight:bold;" >Send Message</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="product-filter product_mobile" style="border:0 none;">
                                                                        <div class="product-compare" style="color:#666; width:100%;">


                                                                            <div class="form-group">
                                                                                <label for="title">Subject</label>
                                                                                <input id="message_subject_<?php echo $order[0]["id"]?>" class="form-control" name="title" type="text">
                                                                            </div>



                                                                            <div class="form-group">
                                                                                <label for="message">Message</label>
                                                                                <textarea class="form-control" maxlength="500" name="message" id="body_message_<?php echo $order[0]["id"]?>"></textarea>
                                                                                <strong style="color:blue">(Maximum of 500 Charcters)</strong>
                                                                            </div>





                                                                            <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $order[0]["seller_id"]?>" />
                                                                            <input type="hidden" name="message_by" id="message_by" value="seller" />


                                                                            <input type="button" class="btn btn-primary" onClick="SendMessage(<?php echo $order[0]["user_id"]?>,<?php echo $order[0]["id"]?>)" name="submit" id="submit" value="Send" />
                                                                        </div>


                                                                    </div>



                                                                </div>




                                                            </div>

                                                        </div>
                                                    </div>



                                                    <script>
                                                        function ShowAddressDetailModal_<?php echo $order[0]['id']?>(id){
                                                            $('#AddressDetailModal_'+id).modal('show');

                                                        }

                                                    </script>
                                                    <div id="AddressDetailModal_<?php echo $order[0]['id']?>" class="modal fade" role="dialog" style="z-index:999999">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" style="color:#0C0; font-weight:bold;" >Buyer Address Details</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="product-filter product_mobile" style="border:0 none;">
                                                                        <div class="product-compare" style="color:#666;">
                                                                            <strong style="color:#000;">Country:</strong><?php echo $order[0]["address_country"];?><br>





                                                                            <strong style="color:#000;">Full Name:</strong>

                                                                            <?php echo $order[0]["address_name"];?><br>

                                                                            <strong style="color:#000;">Street Address:</strong>
                                                                            <?php echo $order[0]["address_street_address"];?><br>

                                                                            <strong style="color:#000;">City: </strong>
                                                                            <?php echo $order[0]["address_city"];?><br>

                                                                            <strong style="color:#000;">State/Province/Region:</strong>
                                                                            <?php echo $order[0]["address_state"];?><br>

                                                                            <strong style="color:#000;">Zip:</strong>
                                                                            <?php echo $order[0]["address_zip"];?><br>

                                                                            <strong style="color:#000;">Phone Number:</strong>
                                                                            <?php echo $order[0]["address_phone_number"];?>







                                                                        </div>
                                                                    </div>



                                                                </div>




                                                            </div>

                                                        </div>
                                                    </div>




                                                </div>

                                            </div>
                                            <div class="clearfix"></div>
                                            </div>
                                   
                                   
                                   
                                 
                                   </div>
								   </div>
                                   
                                   
                                   
                                   
								   
								   <div class="sell_item_container">
                                    
                                    <div class="clearfix"></div>
                                        <div class="col-xs-12 sell_item_detail no-padding">
                                            
                                            
                                                <div style="border-bottom: 1px dashed #000; padding:10px 0px;" >
                                                <div class="col-xs-12 no-padding">
                                                    <h3> <strong>Order Information:</strong></h3>
                                                </div>
                                                    <p style="color:blue; margin-bottom:0px; font-weight:bold;"><strong style="color:#000">Order Id:</strong> <?php echo $order[0]['order_id']?></p>
                                                    <p style="color:blue; margin-bottom:0px; font-weight:bold;"><strong style="color:#000">Product Price:</strong> US $<?php echo $order[0]['price']?></p>
                                                <p style="color:blue; margin-bottom:10px; font-weight:bold;"><strong style="color:#000">Product Shipping:</strong> US $<?php echo $order[0]['shipping_value']?></p>
                                                <p style="color:#ff9827;  font-weight:bold;"><strong style="color:#ff9827">Order Total:</strong> $<?php echo $order[0]['price']-$order[0]['shipping_value']?></p>
                                                <div class="col-xs-12 col-sm-6" style="padding-left:0px; margin-top:30px;">
                                                    
                                                        <div class="col-xs-12  no-padding">
                                                            <div class="col-xs-12 col-md-3" style="padding-left:0px;"><label>Refund Reason: </label></div>
                                                            <div class="col-xs-12 col-md-9">
                                                                <select type="text" name="refund_reason" class="form-control" required>
                                                                   <option value="" selected="selected">Select a refund reason</option>
<optgroup label="Full Refund">
<option value="Out of stock">Out of stock</option>
<option value="Pricing error">Pricing error</option>
<option value="Shipping address undeliverable">Shipping address undeliverable</option>
<option value="Can not ship the product">Can not ship the product</option>
<option value="Item never received">Item never received</option>
</optgroup>
<optgroup label="Partial Refund (Customer Keeps Item)">
<option value="Item took too long to arrive">Item took too long to arrive</option>
<option value="Item different than specified in comment">Item different than specified in comment</option>
</optgroup>
<optgroup label="Return">
<option value="Wrong item shipped">Wrong item shipped</option>
<option value="Item took too long to arrive">Item took too long to arrive</option>
<option value="Item damaged beyond use">Item damaged beyond use</option>
<option value="Item different than specified in comment">Item different than specified in comment</option>
<option value="Customer no longer needs item">Customer no longer needs item</option>
</optgroup>
                                                                       
                                                                </select>
                                                            </div>
                                                            <div class="clear5"></div>
<div class="col-xs-12 col-md-3" style="padding-left:0px;"><label>Refund Type: </label></div>
                                                            <div class="col-xs-12 col-md-9">
                                                                <select type="text"  id="refund_type" name="refund_type" class="form-control" required>
                                                                    <option value="iterm_refund_no_shipping">Item refund - No shipping</option>
                                                                    <option value="full_refund">Full Refund </option>
                                                                    <option value="partial_refund_enter_amount">Custom / Partial refund - Enter the amount</option>
                                                                   
                                                                </select>
                                                            </div>
                                                            <div class="clear5"></div>
                                                            <div class="col-xs-12 col-md-3" style="padding-left:0px;"><label>Refund Amount to Buyer: </label></div>
                                                            <div class="col-xs-12 col-md-9">$<input type="text" size="10" value="<?php echo $order[0]['price']?>"  onkeypress="return isDecimalValue(event)" id="refund_amount_to_buyer" name="refund_amount_to_buyer" class="form-control" required></div>
                                                            <div class="clear5"></div>

                                                           
                                                            <input type="hidden" name="shipping_value" id="shipping_value" value="<?php echo $order[0]['shipping_value']?>" />
                                                            <input type="hidden" name="price" id="price" value="<?php echo $order[0]['price']?>" />
                                                            <input type="hidden" name="full_refund_value" id="full_refund_value" value="<?php echo $order[0]['price']+$order[0]['shipping_value']?>" />
                                                            <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
                                                            <div class="clear5"></div>
                                                        </div>
                                                    
                                                </div>
                                                
                                                <div class="col-xs-12 col-sm-6 form-group"> 
                                                
                                                <?php 
													
				
												
												?>
                                                
                                                
                                                
                                                
                                <div class="box_rightblue" style="margin-top:30px;">
                               
                               
                               
                               <h4>Refunding for an Item:</h4>
                               <div style="clear:both; height:15px;"></div>

<p>Select a Resong for refund from dropdown.</p>
<p>Select the refund type.</p>	
<p>Enter the amount you want to refund to your buyer.</p>
<p>Enter the Message to the buyer for the refund.</p>
<p>Click Issue Refund.</p>


                               
                                   <div class="clearfix"></div>
                                
                                </div>
                              </div>
                                                
                                                <div class="col-xs-12 col-sm-6">
                                                    
                                                </div>
                                                <div class="clearfix"></div>
                                                
                                                <div style="padding:10px 0px;">
                                                <div class="col-xs-12 p0">
                                                   Message to Buyer
                                                </div>
                                                <div class="clear5"></div>
                                                <div class="col-xs-12 p0">
                                                    <textarea name="message_to_buyer" id="message_to_buyer" class="form-control"></textarea>
                                                   
                                                    <strong style="color:blue">(Maximum of 500 Charcters)</strong>
                                                </div>
                                                <div class="clear5"></div>
                                                <div class="col-xs-12">
                                                    
                                                </div>
                                                <div class="clearfix"></div>
                                                </div>
                                                <div id="saved_html">
                                            <input style="margin:10px;" type="submit" value="Issue Refund" class="btn " />    
                                            </div></div>

                                                
                                            
                                        </div>
                                        <div class="clearfix"></div>
                                </div>
								<div class="clearfix"></div><div class="clearfix"></div>   
								   <?php
								   
								   
								   
							   ?>
                               <div class="clearfix"></div>
                            
                               
                               </form>
                           
                                
                            </div>
                             <div class="clear20"></div>
                             
                             
                             <style>
                             .clear5
							 {
								 clear:both;
								 height:5px;
							 }
							 .box_rightblue
							 {
								 width:100%; float:left; background:#fff; color:blue;border: 1px solid blue;
							 }
							  .box_rightblue p
							 {
								margin:0px !important;
								padding-left:10px;
								color:blue !important; 
								line-height:20px;
							 }
							  .box_rightblue h4
							 {
								
								padding-left:10px !important;
								font-weight:bold;
								margin:0px !important;
							 }
							 .p0
							 {
								 padding:0px !important;
							 }
                             </style>
<script>
    $(function(){
        $("#refund_type").change(function(){
            
            var refund_type = $("#refund_type").val();
            var price = $("#price").val();
            var full_refund_value = $("#full_refund_value").val();
          //  alert(refund_type);
            if(refund_type == 'iterm_refund_no_shipping'){
                $("#refund_amount_to_buyer").val(price);
            }
            if(refund_type == 'partial_refund_enter_amount'){
                $("#refund_amount_to_buyer").val('0');
            }
            if(refund_type == 'full_refund'){
                $("#refund_amount_to_buyer").val(full_refund_value);
            }


        });
    });


    function SendMessage(buyer_id,id){

        var r = confirm("Are you sure you want to send message?");

        if (r == true) {
            var title = $("#message_subject_"+id).val();
            var category = $("#category_"+id).val();

            var message = $("#body_message_"+id).val();


            $.ajax({
                type: "POST",
                url: '<?php echo base_url("frontend/users/sendMessage");?>',
                data: {order_id: id,buyer_id:buyer_id,title:title,message:message,category:category,message_by:"Seller"},
                success: function(data){
                    alert(data);

                    if(data == 'success'){
                        alert("Message has been sent successfully.");
                        location.reload();
                    }


                }
            });

        }


    }

</script>