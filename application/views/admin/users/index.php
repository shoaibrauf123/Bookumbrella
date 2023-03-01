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
                Manage Users
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-3 col-sm-3 col-md-3">Name</th>
                            <th class="col-xs-3 col-sm-3 col-md-3">Email</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Role</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Gender</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">User Type</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Status</th>
                            <th class="col-xs-3 col-sm-3 col-md-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) {

                            $selling_options = $this->comman_model->get("seller_shippings",array('seller_id'=>$row['user_id']));
                            ?>
                            <tr>
                                <td class="col-xs-3 col-sm-3 col-md-3"><?php echo ucwords($row['first_name']." ".$row['last_name']); ?></td>
                                <td class="col-xs-3 col-sm-3 col-md-3"><?php echo $row['email']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo getRoleName($row['role_id']); ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo ucfirst($row['gender']); ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1">
                                    <?php echo $row['user_type']; ?>
                                </td>
                                <td class="col-xs-1 col-sm-1 col-md-1">
                                    <?php if ($row['status'] == 1) { ?>
                                        <span class="btn btn-success btn-xs cursor_default" title="Actived"><i class="fa fa-check"></i></span>
                                    <?php } else { ?>
                                        <span class="btn btn-danger btn-xs cursor_default" title="Deactived"><i class="fa fa-ban"></i></span>
                                    <?php } ?>
                                </td>
                                <td class="col-xs-3 col-sm-3 col-md-3">
                                    <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('admin/users/edit').'/'.$uri . "/" .encode_url($row['user_id']); ?>';"><i class="fa fa-pencil"></i></button>
                                    <?php if($row['status'] == 1){ ?>
                                        <button class="btn btn-danger btn-xs" title="Deactivate this user" onclick="window.location = '<?php echo base_url('admin/users/update_status').'/'.$uri.'/'.encode_url($row['user_id']).'/0'; ?>'"><i class="fa fa-ban "></i></button>
                                    <?php }else{ ?>
                                        <button class="btn btn-success btn-xs" title="Activate this user" onclick="window.location = '<?php echo base_url('admin/users/update_status').'/'.$uri.'/'.encode_url($row['user_id']).'/1'; ?>'"><i class="fa fa-check "></i></button>
                                    <?php } ?>
									
									
									<?php
                                    if($selling_options[0]['pause_listing']=='no'){
                                    ?>
                                        <button class="btn btn-success btn-xs" title="Pause this Seller listing" onclick="window.location = '<?php echo base_url('admin/users/BlockSellerListing').'/'.$uri.'/'.encode_url($row['user_id']).'/block'; ?>'">Pause</button>

                                        <?php
                                    }else{

                                        ?>
                                        <button class="btn btn-success btn-xs" title="UnPause this Seller listing" onclick="window.location = '<?php echo base_url('admin/users/UnBlockSellerListing').'/'.$uri.'/'.encode_url($row['user_id']).'/unblock'; ?>'">UnPause</button>
                                        <?php
                                    }
                                    ?>


                                     &nbsp;

                                    <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo base_url('admin/users/delete').'/'.$uri.'/'.encode_url($row['user_id']); ?>');"><i class="fa fa-trash-o "></i></button>
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