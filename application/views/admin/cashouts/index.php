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
                Manage Cashouts
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-1 col-sm-1 col-md-1"><?php echo getlanguage('request-time'); ?></th>
                            <th class="col-xs-2 col-sm-2 col-md-2"><?php echo getlanguage('user'); ?></th>
                            <th class="col-xs-2 col-sm-2 col-md-2"><?php echo getlanguage('payment-method'); ?></th>
                            <th class="col-xs-1 col-sm-1 col-md-1"><?php echo getlanguage('cashback'); ?></th>
                            <th class="col-xs-1 col-sm-1 col-md-1"><?php echo getlanguage('status'); ?></th>
                            <th class="col-xs-1 col-sm-1 col-md-1 text-center"><?php echo getlanguage('update-status'); ?></th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) { ?>
                            <?php
                                $userData = getUserData($row['user_id']);
                                $payment_method_data = getSingleRecord('payment_method',array('user_id'=>$row['user_id']));
                            ?>
                            <tr>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo date('M d, Y',strtotime($row['request_datetime'])); ?></td>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $userData['email']; ?></td>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo slugToTitle($payment_method_data['selected_pm']); ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1">$<?php echo $row['cashback_value']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><strong><?php echo $row['status']; ?></strong></td>
                                <td class="col-xs-1 col-sm-1 col-md-1 text-center">
                                    <?php if($row['status'] != 'Paid'){ ?>
                                            <?php if($row['status'] != 'Approved'){ ?>
                                                <button class="btn btn-success btn-xs" title="Update status to Confirmed" onclick="window.location = '<?php echo base_url('admin/cashouts/status').'/'.$uri.'/'.encode_url($row['cashout_id']).'/'.encode_url('1'); ?>'"><?php echo getlanguage('approve'); ?></button>
                                            <?php } ?>
                                            <?php if($row['status'] != 'Approved'){ ?>
                                                <?php if($row['status'] != 'Failed'){ ?>
                                                    <button class="btn btn-danger btn-xs" title="Update status to Failed" onclick="window.location = '<?php echo base_url('admin/cashouts/status').'/'.$uri.'/'.encode_url($row['cashout_id']).'/'.encode_url('2'); ?>'"><?php echo getlanguage('failed'); ?></button>
                                                <?php } ?>
                                                <?php if($row['status'] != 'Pending'){ ?>
                                                    <button class="btn btn-pending btn-xs" title="Update status to Pending" onclick="window.location = '<?php echo base_url('admin/cashouts/status').'/'.$uri.'/'.encode_url($row['cashout_id']).'/'.encode_url('3'); ?>'"><?php echo getlanguage('pending'); ?></button>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php if($row['status'] == 'Approved'){ ?>
                                                <button class="btn btn-success btn-xs" title="Update status to Paid" onclick="window.location = '<?php echo base_url('admin/cashouts/status').'/'.$uri.'/'.encode_url($row['cashout_id']).'/'.encode_url('4'); ?>'"><?php echo getlanguage('paid'); ?></button>
                                            <?php } ?>
                                    <?php } else { ?>
                                        -
                                    <?php } ?>
                                </td>
                                <td class="col-xs-1 col-sm-1 col-md-1">
                                    <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo base_url('admin/cashouts/delete').'/'.$uri.'/'.encode_url($row['cashout_id']); ?>');"><i class="fa fa-trash-o "></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php echo $pagination; ?>
            <?php }else{ adminRecordNotFoundMsg(); } ?>
        </section>
    </section>
</section>