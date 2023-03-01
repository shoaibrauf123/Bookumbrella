<?php //echo $productsDataSize."--------------------";?>
<input type="hidden" name="current_product_id" id="current_product_id" value="" />
<script>
    function isDecimalValue(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
        } else {
            return true;
        }
    }
function ShowAddForm(id){
	
	$("#add_form_"+id).toggle();
    $(".sell_item_container").hide();
    $("#sell_item_container_"+id).show();
	//$("#toggle_product_id"+id).val(id);
		return false;
	}

	
	
function SellThisItem(product_id){
	
		$("#current_product_id").val(product_id);
		var book_condition = $("#book_condition_"+product_id).val();
	    var book_type = $("#book_type_"+product_id).val();
		var quantity = $("#quantity_"+product_id).val();
		var price = $("#price_"+product_id).val();
		var sku = $("#sku_"+product_id).val();
		var comments = $("#comments_"+product_id).val();



if(quantity == "")//day
{

 $("#quantity_"+product_id).css({"border-color": "red"});
  return false;
}
else
{

$("#quantity_"+product_id).css({"border-color": "#ccc"});
}



if(sku == "")//day
{

 $("#sku_"+product_id).css({"border-color": "red"});
  return false;
}
else
{

   $("#sku_"+product_id).css({"border-color": "#ccc"});
}




if(price == "")//day
{


 $("#price_"+product_id).css({"border-color": "red"});
  return false;
}
else
{

   $("#price_"+product_id).css({"border-color": "#ccc"});
}









	var dataString = "book_condition=" + book_condition+"&book_type=" + book_type+"&quantity=" + quantity+"&price=" + price+"&sku=" + sku+"&comments=" + comments+"&product_id=" + product_id; 
 
 //alert(dataString);
 
 
    $.ajax({
        type: "POST",
		
        url: "<?php echo base_url('ajax_add_seller_product');?>",
        data: dataString,
        success: function (data) {
			var product_id = $("#current_product_id").val();
			
			if(data =='Your item is listed successfully.'){
				
			$("#saved_html_"+product_id).html(data);
			$("#saved_html_"+product_id).css({"color": "#ff5b53 "});
			sleep(1).then(() => {
    location.reload();
});
			
			}else{
				alert(data);
				}
			
        }
    });



	
	
	
	}
    
    


	
	
</script>

<style>

    .sell_item_header {
    background-color: #323232;
    color:#fff;
    font-size: 18px;
    font-weight: bold;
    padding: 10px 10px !important;
    padding-left: 35px;
    }

    .col-xs-12.col-sm-6.col-md-2 {
    padding-left: 15px !important;
    }

    img.img-responsive.sell_img {
    height:235px;
    width:100%;
    border-radius: 2px;
    box-shadow: inset 0px 0px 2px 2px #ccc, 3px 3px 5px 0px #eee;
    padding: 8px;
    display: table-cell;
    text-align: center;
    vertical-align: middle;
   }

    .col-xs-12.col-sm-6.col-md-10 {
        padding-left:15px !important;
}


.heading_sell
{
	font-size:27px !important;
	 font-family: Open Sans, Arial, sans-serif !important;
	 margin-bottom:0px;
}
.label_sell_bottom
{
	font-size:19px !important;
	font-family: Lato,Arial,sans-serif !important;
}

.label_sell_bottom strong{
padding: 0px !important;
margin-top: 11px;
font-size: 19px !important;
font-family: Lato, Arial, sans-serif !important;

}

.label_sell_bottom span{
 font-family: Lato, Arial, sans-serif !important;
font-size: 18px !important;
}


input.btn.list-this {
 background-color: #bb9870 !important;
 border:1px solid #bb9870 !important;
 font-weight:600;
 font-size:16px;
 color:#ffff;
 transition:0.2s;
}

input.btn.list-this:hover {
 background-color: #323232 !important;
 border:1px solid #bb9870 !important;
}

div#add_form_235 {
padding: 20px !important;
}

a.btn.btn-cart {
 background: #bb9870;
 padding: 6px 16px;
 font-weight: bold;
 font-size: 18px;
 color: #fff;
 border-radius: 2px;
}


@media (min-width: 320px) and (max-width 768px) {
.p0_res
{
	padding:0px;
}

}
</style>



<div class="col-md-12">
                                <h3 class="pull-left">SELL AN ITEM</h3>
                                <div class="clearfix"></div>
                                
                            <?php if($productData){?>    
                                <div class="sell_item_container" id="sell_item_container_<?php echo $productData['product_id']; ?>">
                                    <div class="col-xs-12 sell_item_header">Set The Condition, Quantity and Price</div>
                                    <div class="clearfix"></div>
                                        <div class="col-xs-12 sell_item_detail">
                                            <div style="border-bottom: 1px dashed #bb9870; padding:10px;">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <?php 
                                                    $product_image = base_url().'/assets/frontend/img/default-cart.jpg';
                                                    if($productData['image'] != ''){
                                                        $product_image = base_url('').$productData['image'];
                                                    }
                                                ?>
                                                <img class="img-responsive " alt="product" src="<?php echo $product_image; ?>">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-10">
                                                <p class="heading_sell"><strong><?php echo $productData['title'] ?></strong></p>
                                                
                                                <div class="label_sell_bottom">
           
            <strong style="color:#000"> Author:</strong>
            <span style="color:#bb9870">Joseph, Fleming</span>
           <br>
            <strong> ISBN:</strong><span><?php echo $productData['isbn']?></span>
             <br>
            <strong> SKU:</strong><span><?php echo $productData['sku']?></span>
             <br>
            <strong> Format:</strong><span><?php echo $productData['format']?></span> 
             <br>
             <strong> Author:</strong><span><?php echo $productData['author']?></span>
              <br>
<strong> Listed Price:</strong><span style="color:#ff5b53;">$<?php if($productData['buy_price']>0) { echo $productData['buy_price'];} else{ echo '0';}?></span> 

<?php
if($productData['pages']!=''){
?>
<strong> Pages:</strong><span><?php echo $productData['pages']?></span> <br>
<?php } ?>
<?php
if($productData['weight']!=''){
?>
<strong> Weight:</strong><span style="color:#ff5b53;"><?php echo $productData['weight'];?></span> 

<?php }if($productData['dimensions']!=''){ ?>

<strong> Dimensions:</strong><span><?php echo $productData['dimensions']?></span> <br>
<?php }?>

            
            </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            </div>
                                            <form id="sell_item_form" action="<?php echo base_url('add_seller_product') ?>" method="post">
                                                <div style="border-bottom: 1px dashed #000; padding:10px 0px;">
                                                <div class="col-xs-12">
                                                    <h3>Item Information</h3>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    
                                                        <div class="col-xs-12">
                                                            <div class="col-xs-12 col-md-3"><label>Condition: </label></div>
                                                            <div class="col-xs-12 col-md-9">
                                                                <select type="text" name="book_condition" class="form-control" required>
                                                                    <option value="New">New</option>
                                                                    <option value="Like New">Like New</option>
                                                                    <option value="Very Good">Very Good</option>
                                                                    <option value="Good">Good</option>
                                                                    <option value="Acceptable">Acceptable</option>
                                                                       
                                                                </select>
                                                            </div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>Quantity: </label></div>
                                                            <div class="col-xs-12 col-md-9"><input type="text" name="quantity" class="form-control" required></div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>Your price: </label></div>
                                                            <div class="col-xs-12 col-md-9"><input type="text" name="price" class="form-control" required></div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>SKU: </label></div>
                                                            <div class="col-xs-12 col-md-9"><input type="text" name="sku" class="form-control" required></div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>Type: </label></div>
                                                            <div class="col-xs-12 col-md-9">
                                                                <select type="text" name="book_type" class="form-control" required>
                                                                    <option value="Normal">Normal</option>
                                                                    <option value="Internation Edition">Internation Edition</option>
                                                                    <option value="Teachers Edition">Teachers Edition</option>
                                                                    <option value="Study Guide">Study Guide</option>
                                                                    <option value="Work Book">Work Book</option>
                                                                    <option value="Library Copy">Library Copy</option>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" name="product_id" value="<?php echo $productData['product_id'] ?>" />
                                                            <div class="clear5"></div>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-xs-12 col-sm-6 form-group"> 
                                                
                                                <?php 
														$min_new_price = $this->product_model->min_product_price("seller_products",array("New"),array('product_id'=>$productData['product_id']));
							//echo '<pre>';print_r();exit;
							$min_used_price = $this->product_model->min_product_price("seller_products",array("Like New","Very Good","Good","Acceptable"),array('product_id'=>$productData['product_id']));
				
												
												?>
                                                
                                                
                                                
                                                
                                <div style="width:100%; float:left; background:#09F; color:#FFF;     padding:15px;">
                                
                                <?php if($min_new_price[0]['price']>0) {?>
                                <label  style="font-size:18px !important;">  New Price-</label><p style="display:inline; font-size:18px;">$<?php echo $min_new_price[0]['price'] ?> + Shipping</p>
                                   <div class="clearfix"></div>
                                <?php }
								
								?>
                                <?php if($min_used_price[0]['price']>0) {?><label style="font-size:18px !important;">  Used Price-</label><p style="display:inline;  font-size:18px;">$<?php echo $min_used_price[0]['price'] ?>  + Shipping</p>
                                
                                <?php }
								
								?>
                                   <div class="clearfix"></div>
                                
                                </div>
                                
                                
                                
                              </div>
                              
                                                <div class="clearfix"></div>
                                                </div>

                                                <div style="padding:10px 0px;">
                                                <div class="col-xs-12">
                                                   <strong>Comments</strong> - Readable to the buyer on the product detail page.
                                                </div>
                                                <div class="col-xs-12">
                                                    <textarea name="comments" class="form-control"></textarea>
                                                </div>
                                                <div class="clear5"></div>
                                                <div class="col-xs-12">
                                                    <input type="submit" value="LIST THIS ITEM" class="btn list_this" />
                                                </div>
                                                <div class="clearfix"></div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="clearfix"></div>
                                </div>
                                
                            <?php }?>
                           <?php if($productsData){
							   ?>
							   <form id="sell_item_form" action="<?php echo base_url('add_seller_product') ?>" method="post">
							   <?php
							   foreach($productsData as $productData){
								   
								   
								   ?>
								   
								   
								   <div class="sell_item_container"  id="sell_item_container_<?php echo $productData['product_id']; ?>">
                                    <div class="col-xs-12 sell_item_header">Set The Condition, Quantity and Price</div>
                                    <div class="clearfix"></div>
                                        <div class="col-xs-12 sell_item_detail">
                                            <div style="border-bottom: 1px dashed #bb9870; padding:10px 10px;">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <?php 
                                                    $product_image = base_url().'/assets/frontend/img/default-cart.jpg';
                                                    if($productData['image'] != ''){
                                                        $product_image = base_url('').$productData['image'];
                                                    }
                                                ?>
                                                <img class="img-responsive sell_img" alt="product" src="<?php echo $product_image; ?>">
                                                
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-10">
                                                <p class="heading_sell"><strong><?php echo $productData['title'] ?></strong></p>
                                                
                                                <div class="label_sell_bottom">
                                                <strong style="color:#000"> Author:</strong>
            <span style="color:#bb9870">Joseph, Fleming</span>
           <br>
           
            
            <strong>  ISBN-10:</strong><span><?php echo $productData['isbn']?></span>
            <br>
            <strong> ISBN-13:</strong>
            <span><?php echo $productData['isbn13']?></span><br>
            <strong> Format:</strong><span><?php echo $productData['format']?></span> <br>
            <strong> Publisher:</strong><span><?php echo $productData['publisher']?></span> <br>
            <strong> Edition:</strong><span><?php echo $productData['edition']?></span> <br>
          
            
             
<strong> List Price:</strong><span style="font-size:16px; font-family:Open Sans;  color:#bb9870 !important; font-weight:bold;">$<?php if($productData['buy_price']>0) { echo $productData['buy_price'];} else{ echo '0';}?></span>

<?php
if($productData['pages']!=''){
?>
<strong> Pages:</strong><span><?php echo $productData['pages']?></span> <br>
<?php } ?>
<?php
if($productData['weight']!=''){
?>
<strong> Weight:</strong><span style="color:#bb9870;"><?php echo $productData['weight'];?></span> 

<?php }if($productData['dimensions']!=''){ ?>

<strong> Dimensions:</strong><span><?php echo $productData['dimensions']?></span> <br>
<?php }?>

  </div>

        <div class=" pull-right" style="text-align:right;">
            <div class="cart-button button-group"> 
             <a class="btn btn-cart" type="button" href="#" title="Add Book" onClick="ShowAddForm(<?php echo 
               $productData['product_id']?>)"> Click to add book 
             </a> 
            </div>
        </div>
            
        </div>
                                                                                  
        <div class="clearfix"></div>
    </div>
                                            
                                                <div style="border-bottom: 1px dashed #000; padding:10px 15px; display:none;" id="add_form_<?php echo $productData['product_id'];?>">
                                                <div class="col-xs-12">
                                                    <h3>Item Information</h3>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    
                                                        <div class="col-xs-12">
                                                            <div class="col-xs-12 col-md-3"><label>Condition: </label></div>
                                                            <div class="col-xs-12 col-md-9">
                                                                <select type="text" id="book_condition_<?php echo $productData['product_id']?>" name="book_condition_<?php echo $productData['product_id']?>" class="form-control" required>
                                                                    <option value="New">New</option>
                                                                    <option value="Like New">Like New</option>
                                                                    <option value="Very Good">Very Good</option>
                                                                    <option value="Good">Good</option>
                                                                    <option value="Acceptable">Acceptable</option>
                                                                       
                                                                </select>
                                                            </div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>Quantity: </label></div>
                                                            <div class="col-xs-12 col-md-9"><input type="text"  onkeypress="return isDecimalValue(event)" id="quantity_<?php echo $productData['product_id']?>" name="quantity_<?php echo $productData['product_id']?>" class="form-control" required></div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>Your price: </label></div>
                                                            <div class="col-xs-12 col-md-9"><input  onkeypress="return isDecimalValue(event)" type="text" name="price_<?php echo $productData['product_id']?>" id="price_<?php echo $productData['product_id']?>" class="form-control" required></div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>SKU: </label></div>
                                                            <div class="col-xs-12 col-md-9"><input type="text" name="sku_<?php echo $productData['product_id']?>" id="sku_<?php echo $productData['product_id']?>" class="form-control" required></div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>Type: </label></div>
                                                            <div class="col-xs-12 col-md-9">
                                                                <select type="text" id="book_type_<?php echo $productData['product_id']?>" name="book_type_<?php echo $productData['product_id']?>" class="form-control" required>
                                                                    <option value="Normal">Normal</option>
                                                                    <option value="Internation Edition">Internation Edition</option>
                                                                    <option value="Teachers Edition">Teachers Edition</option>
                                                                    <option value="Study Guide">Study Guide</option>
                                                                    <option value="Work Book">Work Book</option>
                                                                    <option value="Library Copy">Library Copy</option>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" name="product_id_<?php echo $productData['product_id']?>" id="product_id_<?php echo $productData['product_id']?>" value="<?php echo $productData['product_id'] ?>" />
                                                            <div class="clear5"></div>
                                                        </div>
                                                    
                                                </div>
                                                
                                                <div class="col-xs-12 col-sm-6 form-group" > 
                                                
                                                <?php 
														$min_new_price = $this->product_model->min_product_price("seller_products",array("New"),array('product_id'=>$productData['product_id']));
							//echo '<pre>';print_r();exit;
							$min_used_price = $this->product_model->min_product_price("seller_products",array("Like New","Very Good","Good","Acceptable"),array('product_id'=>$productData['product_id']));
				
												
												?>
                                                
                                                
                                                
                                                
                                <div style="width:100%; float:left;     padding:15px;">
                                <label style="font-size:18px !important;">  New Price-</label><p style="display:inline;  font-size:18px; font-family:Open Sans;  color:#bb9870 !important; font-weight:bold;">$<?php echo $min_new_price[0]['price'] ?> + Shipping</p>
                                   <div class="clearfix"></div>
                                <label style="font-size:18px !important;">  Used Price-</label><p style="display:inline;font-size: 18px;opx; font-family:Open Sans;  color:#bb9870 !important; font-weight:bold;">$<?php echo $min_used_price[0]['price'] ?>  + Shipping</p>

                                   <div class="clearfix"></div>
                                     
                                
                                </div>
                              </div>
                                                
                                                <div class="col-xs-12 col-sm-6">
                                                    
                                                </div>
                                                <div class="clearfix"></div>
                                                
                                                <div style="padding:10px 0px;">
                                                <div class="col-xs-12">
                                                   <strong>Comments</strong> - Readable to the buyer on the product detail page.
                                                </div>
                                                <div class="col-xs-12">
                                                    <textarea name="comments_<?php echo $productData['product_id']?>" id="comments_<?php echo $productData['product_id']?>" class="form-control"></textarea>
                                                </div>
                                                <div class="clear5"></div>
                                                <div class="col-xs-12">
                                                    
                                                </div>
                                                <div class="clearfix"></div>
                                                </div>
                                                <div id="saved_html_<?php echo $productData['product_id']?>">
                                            <input style="margin:10px;" type="button" onClick="SellThisItem(<?php echo $productData['product_id']?>)" value="LIST THIS ITEM" class="btn list-this" />
                                            </div></div>

                                                
                                            
                                        </div>
                                        <div class="clearfix"></div>
                                </div>
								<div class="clearfix"></div><div class="clearfix"></div>   
								   <?php
								   
								   
								   }
							   ?>
                               <div class="clearfix"></div>
                               <input type="hidden" name="items_multiple" value="save"  />
                               
                               </form>
                           <?php }else{
							   //echo $productsData;
							   }?>
                                
                            </div>