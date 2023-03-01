<?php
    $uri = 0;
    if($this->uri->segment(3) != ''){
        $uri = $this->uri->segment(3);
    }
?>
<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">
                Manage Orders
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ 
//echo '<pre>'; print_r($results); echo '</pre>';
                ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-3 col-sm-2">Image</th>
                            <th class="col-xs-2 col-sm-5">Detail</th>
                            <th class="col-xs-1 col-sm-5"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) {  
						//$productData = get('products', array('product_id' => $row['product_id']));
						//$sellerData = get('user', array('user_id' => $row['seller_id']));
						//$buyerData = get('user', array('user_id' => $row['user_id']));

                        $user = $this->comman_model->get('user',array('user_id'=>$row['user_id']));
                        $seller = $this->comman_model->get('user',array('user_id'=>$row['seller_id']));
                        $product = $this->comman_model->get('products',array('product_id'=>$row['product_id']));
                        $ratings = getRating($row['seller_products_id']);
						
						?>
                            <tr>
                                <td class="col-xs-3 col-sm-2"><img class="img-responsive" alt="product" src="<?php echo base_url()?><?php echo $product[0]['image']?>"></td>
                                <td class="col-xs-2 col-sm-5">
                                    <h4><?php echo $product[0]['title']?></h4>
                                    <strong> ISBN-10:</strong><span><?php echo $row['isbn']?></span><strong> ISBN-13:</strong><span><?php echo $row['isbn13']?></span><br>
                                    <strong> SKU:</strong><span><?php echo $row['sku']?></span> <br>
                                    <strong> Quantity:</strong><span><?php echo $row['qty']?></span> <strong> Author:</strong><span><?php echo $product[0]['format']?></span><br>
                                    <strong> Condition:</strong><span><?php echo $product[0]['book_condition']?></span> <strong> Type:</strong><span><?php echo $product[0]['book_type']?></span>
                                    <br>
                                    <strong>Seller: </strong><span><?php echo $seller[0]['username'];?></span>
                                    <br>
                                    <strong>Buyer: </strong><span><?php echo $user[0]['username'];?></span><br>
                                    <a href="javascript:;" onClick="ShowAddressDetailModal_<?php echo $row['id']?>(<?php echo $row['id']?>)">Click to view Shipping Address</a>
                                    <script>
                                    
                                        function ShowAddressDetailModal_<?php echo $row['id']?>(id){    
                                            $('#AddressDetailModal_'+id).modal('show');
                                        }
                                    </script>

                                    <div id="AddressDetailModal_<?php echo $row['id']?>" class="modal fade" role="dialog" style="z-index:999999">
                                      <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style=" font-weight:bold;" >Buyer Address Details</h4>
                                          </div>
                                          <div class="modal-body">
                                          <div class="product-filter product_mobile" style="border:0 none;">
                                            <div class="product-compare" style="color:#666;">
                                                <strong style="color:#000;">Country:</strong><?php echo $row["address_country"];?><br>
                                                <strong style="color:#000;">Full Name:</strong><?php echo $row["address_name"];?><br>
                                                <strong style="color:#000;">Street Address:</strong><?php echo $row["address_street_address"];?><br>
                                                <strong style="color:#000;">City: </strong><?php echo $row["address_city"];?><br>
                                                <strong style="color:#000;">State/Province/Region:</strong><?php echo $row["address_state"];?><br>
                                                <strong style="color:#000;">Zip:</strong><?php echo $row["address_zip"];?><br>
                                                <strong style="color:#000;">Phone Number:</strong><?php echo $row["address_phone_number"];?>                                                                                                                                                                                         
                                            </div>
                                            </div>
                                          </div>
                                       
                                        </div>

                                      </div>
                                    </div>
                                </td>
                                
                                <td class="col-xs-1 col-sm-5">
                                    <strong> Order Id: </strong><span><?php echo $row['unique_order_id']; ?></span><br>
                                    <strong> Order Date: </strong><span><?php echo $row['created_on']; ?></span> <br>
                                    <strong> Order Status: </strong><span><?php echo $row['order_status']; ?></span><br>  
                                    <?php if($row['order_status'] == 'Cancelled'){ ?>
                                        <strong> Cancel Reason: </strong><span><?php echo $row['reason_cancel']; ?></span></br>
                                    <?php   } ?>
                                    <strong> Product Price: </strong><span><?php echo $row['price']; ?></span>&nbsp;
                                    <strong> Shipping: </strong><span>$<?php echo $row['shipping_value']; ?>(<?php echo $row['shipping_type']; ?>)</span>&nbsp;
                                    <strong > Order Total: </strong><span><?php echo $row['price'] + $row['shipping_value']; ?></span>
                                    <br>
                                    <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('admin/orders/edit').'/'.$uri . "/" .$row['id']. "/" .$row['user_id']; ?>';"><i class="fa fa-pencil"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div><?php echo $pagination; ?></div>
            <?php }else{
                adminRecordNotFoundMsg();
            } ?>
        </section>
    </section>
</section>