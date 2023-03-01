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
                Order Detail
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ ?>
                
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-3 col-sm-3 col-md-3">Image</th>
                            <th class="col-xs-2 col-sm-2 col-md-2">Product</th>
                            <th class="col-xs-2 col-sm-2 col-md-2">Seller</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Quantity</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Price</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Date</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Order Status</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$total_qty = 0;
						$total_price = 0;
						 foreach ($results as $row) {  
						$productData = get('products', array('product_id' => $row['product_id']));
						$sellerData = get('user', array('user_id' => $row['seller_id']));
						$buyerData = get('user', array('user_id' => $row['user_id']));
						
						?>
                            <tr>
                                <td class="col-xs-3 col-sm-3 col-md-3">
								
                                <img class="img-responsive" alt="product" src="<?php echo base_url(''); ?><?php echo $productData[0]['image'] ?>" /></td>
                                
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $productData[0]['title'] ?></td>
                                <td class="col-xs-2 col-sm-2 col-md-2"><div class="limit-listing-desc"><?php echo $sellerData[0]['first_name']. " " . $sellerData[0]['last_name']; ?></div></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['qty']?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['price']?></td>
                                
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['created_on']?></td>
                                
                               
                                
                                <td class="col-xs-1 col-sm-1 col-md-1">
                                    <?php echo $row['order_status']; ?>
                                </td>
                                <td class="col-xs-1 col-sm-1 col-md-1">
                                    <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('admin/orders/edit').'/'.$uri . "/" .encode_url($row['order_id']); ?>';"><i class="fa fa-pencil"></i></button>
                                    <?php if($row['order_status'] == 'Pending'){ ?>
                                      
                                    <?php }else{ ?>
                                       <?php /*?> <button class="btn btn-success btn-xs" title="Activate this page" onclick="window.location = '<?php echo base_url('admin/orders/update_status').'/'.$uri.'/'.encode_url($row['id']).'/1'; ?>'"><i class="fa fa-check "></i></button><?php */?>
                                    <?php } ?>
                                    <?php /*?><button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo base_url('admin/orders/delete').'/'.$uri.'/'.encode_url($row['id']); ?>');"><i class="fa fa-trash-o "></i></button><?php */?>
                                </td>
                            </tr>
                        <?php 
						$first_name = $buyerData[0]['first_name'];
						$last_name = $buyerData[0]['last_name'];
						$total_qty = $total_qty + $row['qty'];
						$total_price = $total_price + $row['price'];
						$order_status =  $row['order_status'];
						
						$tracking_id =  $row['tracking_id'];
						
						$payment_status =  $row['payment_status'];
						
						} ?>
                
                
					<tr>
                    <td colspan="8" align="center" width="100%">
                    	<table width="80%">
                        	<tr>
                            	<td align="left" style="width:18%"><strong>Order Id :</strong></td>
                                <td align="left"style="width:30%"><?php echo $order_id; ?></td>
                                <td align="center" style="width:10%"></td>
                                <td align="left" style="width:18%"><strong>Buyer :</strong></td>
                                <td align="left" style="width:24%"><?php echo $first_name. " " . $last_name; ?></td>
                                
                            </tr>
                            
                            <tr>
                            	<td align="left" style="width:18%"><strong>Order Quantity :</strong></td>
                                <td align="left" style="width:30%"><?php echo $total_qty; ?></td>
                                <td align="center" style="width:10%"></td>
                                <td align="left" style="width:18%"><strong>Order Price :</strong></td>
                                <td align="left" style="width:24%"><?php echo $total_price; ?></td>
                                
                            </tr>
                            <tr>
                            	<td align="left" style="width:18%"><strong>Order Status :</strong></td>
                                <td align="left" style="width:30%"><?php echo $order_status; ?></td>
                                <td align="center" style="width:10%"></td>
                                <td align="left" style="width:18%"><strong>Payment Status :</strong></td>
                                <td align="left" style="width:24%"><?php echo $payment_status; ?></td>
                                
                            </tr>
                            
                            
                            
                            
                        </table>
                         
                        
                        
                    </td>
                    </tr>  
                    
                    <tr>
                    	<td colspan="8">
                        	
                            <form name="orderStatusF" id="orderStatusF" method="post" >
                            <table width="80%">
                            	<tr>
									<td>Order Status</td>                              
                                	<td>
                                    	<select class="form-control" name="order_status" required>
                                        	<option <?php if($order_status == 'Pending') { ?> selected   <?php } ?> value="Pending">Pending</option>
                                            <option <?php if($order_status == 'Received') { ?> selected   <?php } ?>  value="Received">Received</option>
                                            <option <?php if($order_status == 'Delivered') { ?> selected   <?php } ?>  value="Delivered">Delivered</option>
                                            <option <?php if($order_status == 'Receiver Confirmed') { ?> selected   <?php } ?>  value="Receiver Confirmed">Receiver Confirmed</option>
                                            <option <?php if($order_status == 'Cancelled') { ?> selected   <?php } ?>  value="Cancelled">Cancelled</option>
                                        </select>
                                    </td>
                                   <td>Payment Status</td>                              
                                	<td>
                                    	<select class="form-control" name="payment_status" required>
                                        	<option <?php if($payment_status == 'Not Paid') { ?> selected   <?php } ?>  value="Not Paid">Not Paid</option>
                                            <option <?php if($payment_status == 'Client Paid') { ?> selected   <?php } ?>  value="Client Paid">Client Paid</option>
                                            <option <?php if($payment_status == 'Admin Confirmed') { ?> selected   <?php } ?>  value="Admin Confirmed">Admin Confirmed</option>
                                        </select>
                                    </td>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                </tr>
                                
                                <tr>
                                <td>Tracking Id</td>                              
                                	<td>
                                    <input type="text" name="tracking_id" id="tracking_id" value="<?php echo $tracking_id;?>" />
                                        </td>
                                
                                
                                
                                <td>Career</td>                              
                                	<td>
                                    <input type="text" name="career" id="career" value="<?php echo $career;?>" />
                                        </td>
                                
                                
                                </tr>
                                
                                
                                
                                
                            	<tr>
                                	<td colspan="4" align="center">
                                    <input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id;?>" />

                                    <input type="submit" class="btn btn-shadow btn-primary" value="Update Order">
                                    
                                    </td>	
                                </tr>
                                
                            </table>
                            
                            </form>
                        </td>
                    </tr>              
                
                    </tbody>
                </table>
                
                
                <?php //echo $pagination; ?>
            <?php }else{
                adminRecordNotFoundMsg();
            } ?>
        </section>
    </section>
</section>