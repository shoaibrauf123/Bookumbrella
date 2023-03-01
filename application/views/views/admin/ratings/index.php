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
                Manage Ratings
            </header>
            <?php $this->load->view('errors'); ?>
         
                
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                      
                            <th class="col-xs-2 col-sm-2 col-md-2">ISBN</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Title</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">User</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Seller</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Rating</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Comments</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Date</th>
                            <th class="col-xs-4 col-sm-2 col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count =1; foreach ($results as $row) {
							
							$product = $this->comman_model->get("products",array("product_id"=>$row['product_id']));
							$user = $this->comman_model->get("user",array("user_id"=>$row['user_id']));
							$seller = $this->comman_model->get("user",array("user_id"=>$row['seller_id']));
																  ?>
                            <tr>
                                <td class="col-xs-2 col-sm-1 col-md-1"><?php echo $product[0]['isbn']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $product[0]['title']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php
																				
																				 echo $user[0]['first_name']." ".$user[0]['last_name']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php
																				
																				 echo $seller[0]['first_name']." ".$seller[0]['last_name']; ?></td>
                                                                                 
                                 <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['no_stars']; ?></td>
                                 <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['comments']; ?></td>
                                 <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['date_created']; ?></td>
                                 
                                 
                                                                                   
                                <td class="col-xs-4 col-sm-2 col-md-2">
                                
                                    <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('admin/ratings/edit').'/'.$uri . "/" .encode_url($row['id']); ?>';"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo base_url('admin/ratings/delete').'/'.$uri.'/'.encode_url($row['id']); ?>');"><i class="fa fa-trash-o "></i></button>
                                </td>
                            </tr>
                        <?php $count++; } ?>
                    </tbody>
                </table>
                <?php echo $pagination; ?>
            <?php }else{
                adminRecordNotFoundMsg();
            } ?>
        </section>
    </section>
</section>