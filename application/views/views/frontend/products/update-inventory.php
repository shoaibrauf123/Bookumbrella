<?php
    $cashback_data = $cashbacks;
    $currentUserData = getUserData(getCurrentUserId());
?>
<style type="text/css">
    .sell_item_container{
        border: 1px solid #000;
    }
    .sell_item_header{
        background-color: #eeeeee;
        font-size: 18px;
        font-weight: bold;
        padding: 10px;
    }
    .sell_item_detail{
        padding: 10px;
    }
</style>
<div class="col-xs-12">
    <div class="container frontend-dashboard-cont">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12">

                <section style="padding-bottom: 50px; padding-top: 50px;">

                    <?php if (isset($errors)) { ?>
                        <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                    <!--dashbord start-->
                    <div class="dashbord_inno">
                        <div class="container"> 
                            <h3 class="pull-left">Edit Book</h3>  
                            <div class="clearfix"></div>                            
                            
                            <div class="row">
                                <div class="col-md-12">
                                
                                <div class="clearfix"></div>
                                <div class="sell_item_container">
                                    
                                    <div class="clearfix"></div>
                                        <div class="col-xs-12 sell_item_detail">
                                            <div style="border-bottom: 1px dashed #000; padding-bottom:10px;">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <?php 
												
												$product_detail = $this->comman_model->get("products",array('product_id'=>$productData['product_id']));
												//print_r($product_detail);
                                                    $product_image = base_url().'/assets/frontend/img/default-cart.jpg';
                                                    if($product_detail[0]['image'] != ''){
                                                        $product_image = base_url().$product_detail[0]['image'];
                                                    }
													
                                                ?>
                                                
                                                <img class="img-responsive" alt="product" src="<?php echo $product_image; ?>">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-10">
                                                <p><strong><?php echo $productData['title'] ?></strong></p>
                                                <p><strong>ISBN:</strong> <?php echo $productData['isbn']; ?></p>
                                            </div>
                                            <div class="clearfix"></div>
                                            </div>
                                            <form id="sell_item_form" action="<?php echo base_url('add_seller_product').'/'.$productData['id']; ?>" method="post">
                                                <div style="border-bottom: 1px dashed #000; padding:10px 0px;">
                                                <div class="col-xs-12">
                                                    <h3>Item Information</h3>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    
                                                        <div class="col-xs-12">
                                                            <div class="col-xs-12 col-md-3"><label>Condition: </label></div>
                                                            <div class="col-xs-12 col-md-9">
                                                                <select type="text" name="book_condition" id="book_condition" class="form-control" required>
                                                                    <option value="New">New</option>
                                                                    <option value="Like New">Like New</option>
                                                                    <option value="Very Good">Very Good</option>
                                                                    <option value="Good">Good</option>
                                                                    <option value="Acceptable">Acceptable</option>
                                                                       
                                                                </select>
                                                            </div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>Quantity: </label></div>
                                                            <div class="col-xs-12 col-md-9"><input type="text" name="quantity" class="form-control" value="<?php echo $productData['quantity']; ?>" required></div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>Your price: </label></div>
                                                            <div class="col-xs-12 col-md-9"><input type="text" name="price" class="form-control" value="<?php echo $productData['price']; ?>" required></div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>SKU: </label></div>
                                                            <div class="col-xs-12 col-md-9"><input type="text" name="sku" class="form-control" value="<?php echo $productData['sku']; ?>" required></div>
                                                            <div class="clear5"></div>

                                                            <div class="col-xs-12 col-md-3"><label>Type: </label></div>
                                                            <div class="col-xs-12 col-md-9">
                                                                <select type="text" name="book_type" id="book_type" class="form-control" required>
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
                                                <div class="col-xs-12 col-sm-6">
                                                    
                                                </div>
                                                <div class="clearfix"></div>
                                                </div>

                                                <div style="padding:10px 0px;">
                                                <div class="col-xs-12">
                                                   <strong>Comments</strong> - viewable to the buyer on the marketpalce.
                                                </div>
                                                <div class="col-xs-12">
                                                    <textarea name="comments" class="form-control"><?php echo $productData['comments']; ?></textarea>
                                                </div>
                                                <div class="clear5"></div>
                                                <div class="col-xs-12">
                                                    <input type="submit" value="Update" class="btn " />
                                                </div>
                                                <div class="clearfix"></div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="clearfix"></div>
                                </div>
                            </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <!--dashbord end-->
                </section>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#book_condition').val('<?php echo $productData['book_condition']; ?>');
        $('#book_type').val('<?php echo $productData['book_type']; ?>');
    });
</script>
