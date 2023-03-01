
<div class="container">
            <?php
			//echo '<pre>';print_r($actual_product);exit;
			 //echo '<pre>'; print_r($sellerProductData); echo '</pre>'; ?>
            <div class="main-header" itemprop="name"><?php echo $actual_product['title']; ?>, <?php echo $actual_product['edition']; ?>:<?php echo $actual_product['format']; ?>
            <br>
           <p style="font-size:14px; color:#CCC;"> by <?php echo $actual_product['author'] ?> </p>
            </div>
            <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
                            <div class="row">

                                <?php $this->load->view('frontend/includes/product_sidebar'); ?>

                            </div>
                        </div>
            <div class="col-xs-12 col-md-3">
                <div class="row">

                    <img alt="book cover"  class="col-xs-5 col-md-12 img-responsive" src="<?php echo base_url(''); ?><?php echo $actual_product['image'] ?>">
                    <section class="col-md-12 col-xs-7">
                        <h2 class="hidden-md hidden-lg author-mobile weight-normal">

                            by <a itemprop="author" href="#"><u><?php echo $actual_product['author']?>
                           </u></a>

                        </h2>


                        <section class="hidden-xs hidden-sm col-md-12">


                            <!--<div class="rec-wrapper share-icons row rec-wrapper-share-icons-row">

                                <p class="font-size-large weight-normal">Recommend this!</p>
                                <p>Marketplace Prices</p>


                            </div>-->

                            

                        </section>
                    </section>
                </div>
				</div>
		    <div class="col-xs-12 col-md-2">
			  <div class="row">
			
			<span  style="font-size:14px;  line-hight:20px; ">
            <label>Price:</label> <p style="display:inline;"> $<?php echo $actual_product['buy_price']?>     </p> 
            <br>
			  <label>Format:</label><p style="display:inline; color:#C00;"> <?php echo $actual_product['format']?>        </p>
			 <br>
			 <label>Publisher:</label><p style="display:inline;"> <?php echo $actual_product['publisher']?> </p>
			 <br>
             <label>Grade:</label><p style="display:inline;"> <?php echo $actual_product['grade']?> </p>
			 <br>
             <label>Edition:</label><p style="display:inline;"> <?php echo $actual_product['edition']?> </p>
			 <br>             
             <label>Language:</label><p style="display:inline;"> <?php echo $actual_product['language']?> </p>
			 <br>             
			</span>
			 
			</div>
			</div>
            <div class="col-xs-12 col-md-5">
            <div class="row">
                 <div class="col-xs-12 col-md-12 form-group">
                    <div class="product-detail-page">
                       <!-- Nav tabs -->
                       <ul class="nav nav-tabs" role="tablist">
                         <li role="presentation" class="active">
                           <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                            Used $<?php echo $actual_product['used_price'] ?>
                            <span class="detail-arrow"></span>
                           </a>
                         </li>
                         <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Buy $<?php echo $actual_product['buy_price'] ?><span class="detail-arrow"></span></a></li>
                         <!--<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Alternate $17.65<span class="detail-arrow"></span></a></li>-->
                       </ul>
                       <!-- Tab panes -->
                       <div class="tab-content">
                         <div role="tabpanel" class="tab-pane active" id="home">
                         <div class="detail-page-add-cart">
                           <p style="font-size:20px;  font-family:Open Sans; display:block; line-height:20px;"><em>$</em><?php echo $actual_product['rent_price'] ?></p> 
                         

                           <br>

   <p style="font-size:14px; color:#CCC; display:block; margin-top:2px;">$<?php echo $this->comman_model->print_value("setting",array('slug'=>'expedite_shipping'),'value');?> Shipping</p>
   
   
                           <a href="javascript:;" class="btn btn-primary">Add to Cart</a>
                         
                         </div>
                         <br>
                         
                         
                         
                         
                         </div>
                         <div role="tabpanel" class="tab-pane" id="profile">
                         <div class="detail-page-add-cart">
                           <p style="font-size:20px;  font-family:Open Sans; display:block; line-height:20px;"><em>$</em><?php echo $actual_product['buy_price'] ?></p> 
                         

                           <br>

   <p style="font-size:14px; color:#CCC; display:block; margin-top:2px;">$<?php echo $this->comman_model->print_value("setting",array('slug'=>'expedite_shipping'),'value');?> Shipping</p>
   
   
                           <a href="javascript:;" class="btn btn-primary">Add to Cart</a>
                         
                         </div>
                         
                         
                         
                         </div>
                         <div role="tabpanel" class="tab-pane" id="messages">
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                         tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                         quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                         consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse..</p>
                         </div>
                       </div>
                     </div>

                <?php /* ?>
                <div class="pdppagetitle"><?php echo $actual_product['title'];?></div>
                <div class="pdplinks pdplinks-p">
                    <p>		(<?php echo $actual_product['format'];?>, <?php echo $actual_product['edition'];?>) 	</p>		
                    <p>		Author: 	</p>
                    <a href="#" class="pdplinks"><?php echo $actual_product['title'];?></a>
                    <a href="#" class="pdplinks">kernberg</a>
                </div>
                <span style="width:350px">
                    <?php echo $actual_product['description'];?>
                </span>
                <br>
                <a href="#" class="pdplinks btn btn-primary add-to-cart-btn" style="color: #fff !important;">More Details</a>
                <?php */ ?>
                 </div>
                 </div>
                <?php /* ?>
                 <div class="col-xs-12 col-md-4 form-group">
                    <div class="detail-page-right-column">

                    <ul class="nav nav-tabs" role="tablist" style="margin: -1px;">
                      <li class="active"><a href="#home" role="tab" data-toggle="tab">BUY $<?php echo $actual_product['buy_price'];?></a></li>
                      <li><a href="#profile" role="tab" data-toggle="tab">Rent $<?php echo $actual_product['rent_price'];?></a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" style="padding: 15px;">
                      <div class="tab-pane active" id="home">
                               <div class="col-xs-12 col-md-12 form-group">
                                   <div class="row">
                            <span> Format:</span><span>  <?php echo $actual_product['format']; ?></span>
                            <br>
                            <span> ISBN-10:</span><span>  <a class="pdplinks" href="#"> <?php echo $actual_product['isbn']; ?> </a></span>
                            <br>
                              <span> Format:</span><span>  <?php echo $actual_product['format']; ?></span>
                            <br>
                            <span> ISBN-10:</span><span>  <a class="pdplinks" href="#"> <?php echo $actual_product['isbn']; ?> </a></span>
                            
                            <br>
                            <span> Publisher:</span><span>  <a class="pdplinks" href="#"> <?php echo $actual_product['publisher_name']; ?> </a></span>
                            
                            <br>
                            <span> Grade:</span><span>  <a class="pdplinks" href="#"> <?php echo $actual_product['grade']; ?> </a></span>
                            <br>
                            <span> Edition:</span><span>  <a class="pdplinks" href="#"> <?php echo $actual_product['edition']; ?> </a></span>
                            <br>
                            <span> Language:</span><span>  <a class="pdplinks" href="#"> <?php echo $actual_product['language']; ?> </a></span>
                             </div>
                            
                        </div>
                            <button class="btn btn-primary add-to-cart-btn" id="<?=$sellerProductData['id']?>" >Add to cart</button>    
                      </div>
                      <div class="tab-pane" id="profile">
                      ..........
                      </div>
                    </div>

                </div>
                </div>
                <?php */ ?>
              
                
            </div>
            <div class="clear">
              
            </div>
            <br><br>
            

            <div class="col-xs-12 col-sm-12">

                <div class="well">
                    
                    
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="home">

                          
                            
                          
                                  
                                  <div class="col-xs-12 col-sm-12 form-group">
                                <div class="row">
                            <table width="100%"  class="PDP_itemList table-responsive table-hover" cellspacing="10" cellpadding="10">
                                <tbody><tr bgcolor="#DDDDDD">
                                        <th class="PDP_col_price" width="25%">Quantity</th>
                                        
                                        <th class="PDP_col_deliveredBy" width="25%">Condition</th>
                                        <th class="PDP_col_sellerName" width="25%">Seller Details</th>
                                        
                                        <th class="PDP_col_comments" width="25%">Price + Shipping</th>
                                    </tr>
                                <?php 
								$other_sellers = $this->comman_model->get("seller_products",array('product_id'=>$sellerProductData['product_id']));
								if($other_sellers){
									//echo '<pre>';print_r($sellerProductData);exit;
									foreach($other_sellers as $row){
									$seller_details = $this->comman_model->get("user",array("user_id"=>$row['user_id']));
									?>
                                <tr class="tr-border" bgcolor="#FFFFFF">
                                    <td><span class="PDP_itemPrice">In Stock: <?php echo $row["quantity"];?></span></td>
                                    <td><?php echo $row["book_condition"];?></td>
                                    <td>
                                    <strong>Seller:</strong> <?php echo $seller_details[0]['username'];?>
                                    <br>

                                    <strong>Email:</strong><?php echo $seller_details[0]['email'];?>
                                     <br>
                                        
                                        
                                     <label style=" color:#66F;">Comments:</label><p style="display:inline;color:#CCC;"> <?php echo $row['comments'];?> </p>
                                    
                                    </td>
                                            
                                    <td><button class="btn btn-primary add-to-cart-btn" id="<?=$row['id']?>" >Add to cart</button>
                                     <br>
                                     
                                     
									<p class="finalprice"> $<?php echo $row["price"];?></p>
									<p class="finalpricetshp">+ $<?php echo $this->comman_model->print_value("setting",array('slug'=>'expedite_shipping'),'value');?> shipping </p>
                                    </td>
                                </tr>
								<?php }}?>
                                </tbody></table>
                            </div>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="clear" style="clear:both; height: 10px;"></div>

                </div>


            </div>
            </div>		
        </div>
<script type="text/javascript">
$(document).ready(function () {
    $('.add-to-cart-btn').click(function(){
   
	var id = this.id;
        jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('cart/add-to-cart'); ?>',
            data: {'id': id},
            dataType: 'json',
            error: function (request, error) {
                alert('There is an error.Try Again');
                //jQuery('#eventError').html('There is an error.Try Again').show();
              },
            success: function (response) {
				//alert(response.);return false;
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
    })
});
</script>