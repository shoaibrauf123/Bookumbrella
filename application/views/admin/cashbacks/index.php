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
                Manage Cashbacks
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-1 col-sm-1 col-md-1"></th>
                            <th class="col-xs-2 col-sm-2 col-md-2"><?php echo getlanguage('resource-name'); ?></th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Type</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Exit Id</th>
                            <th class="col-xs-2 col-sm-2 col-md-2"><?php echo getlanguage('user'); ?></th>
                            <th class="col-xs-1 col-sm-1 col-md-1"><?php echo getlanguage('cashback'); ?></th>
                            <th class="col-xs-1 col-sm-1 col-md-1 text-center"><?php echo getlanguage('status'); ?></th>
                            <th class="col-xs-1 col-sm-1 col-md-1"><?php echo getlanguage('date'); ?></th>
                            <th class="col-xs-1 col-sm-1 col-md-1"><?php echo getlanguage('update-status'); ?></th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) { ?>
                            <?php
                                $userData = getUserData($row['user_id']);

                                $resourceData = array();
                                $resourceName = '';
                                $resourceImage = '';

                                if($row['resource_type'] == 'product'){
                                    $productData = getSingleRecord('products',array('product_id'=>$row['resource_id']));
                                    $resourceImage = getProductImage($row['resource_id'],'thumbnail',$productData['image']);
                                    $resourceName = $productData['title'];

                                } else if($row['resource_type'] == 'store'){
                                    $storeData = getSingleRecord('store',array('store_id'=>$row['resource_id']));
                                    $resourceImage = getStoreImage($row['resource_id'],'thumbnail',$storeData['image_url']);
                                    $resourceName = $storeData['name'];

                                } else if($row['resource_type'] == 'referral'){
                                    $resourceImage = base_url('assets/frontend/img/avatar.png');
                                }
                            ?>
                            <tr>
                                <td class="col-xs-1 col-sm-1 col-md-1"><img class="product-list-thumb" src="<?php echo $resourceImage; ?>"></td>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $resourceName; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><strong><?php echo slugToTitle($row['resource_type']); ?></strong></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['exit_click_id']; ?></td>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $userData['email']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1">$<?php echo $row['cashback_value']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1 text-center"><strong><?php echo $row['updated_status']; ?></strong></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo date('M d, Y',strtotime($row['date_created'])); ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1 text-center">
                                    <?php if($row['updated_status'] == 'Confirmed' || $row['updated_status'] == 'Failed' || $row['updated_status'] == 'Pending'){ ?>
                                        <?php if($row['updated_status'] != 'Confirmed'){ ?>
                                            <button class="btn btn-success btn-xs" title="Update status to Confirmed" onclick="window.location = '<?php echo base_url('admin/cashbacks/update_status').'/'.$uri.'/'.encode_url($row['cashback_id']).'/'.encode_url('1'); ?>'"><?php echo getlanguage('confirmed'); ?></button>
                                        <?php } ?>
                                        <?php if($row['updated_status'] != 'Failed'){ ?>
                                            <button class="btn btn-danger btn-xs" title="Update status to Failed" onclick="window.location = '<?php echo base_url('admin/cashbacks/update_status').'/'.$uri.'/'.encode_url($row['cashback_id']).'/'.encode_url('2'); ?>'"><?php echo getlanguage('failed'); ?></button>
                                        <?php } ?>
                                        <?php if($row['updated_status'] != 'Pending'){ ?>
                                            <button class="btn btn-pending btn-xs" title="Update status to Pending" onclick="window.location = '<?php echo base_url('admin/cashbacks/update_status').'/'.$uri.'/'.encode_url($row['cashback_id']).'/'.encode_url('3'); ?>'"><?php echo getlanguage('pending'); ?></button>
                                        <?php } ?>
                                    <?php } else { ?>
                                        -
                                    <?php } ?>
                                </td>
                                <td class="col-xs-1 col-sm-1 col-md-1">
                                    <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo base_url('admin/cashbacks/delete').'/'.$uri.'/'.encode_url($row['cashback_id']); ?>');"><i class="fa fa-trash-o "></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php echo $pagination; ?>
            <?php }else{
                adminRecordNotFoundMsg();
            } ?>
        </section>
    </section>
</section>