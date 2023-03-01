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
                Manage Coupans
            </header>
            <?php $this->load->view('errors'); ?>
         
                
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-2 col-sm-1 col-md-1">Sr #</th>
                            <th class="col-xs-2 col-sm-2 col-md-2">Coupon Code</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Discount %</th>
                            <th class="col-xs-4 col-sm-2 col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count =1; foreach ($results as $row) {  ?>
                            <tr>
                                <td class="col-xs-2 col-sm-1 col-md-1"><?php echo $count; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['coupon']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['percentage']; ?></td>
                                  
                                <td class="col-xs-4 col-sm-2 col-md-2">
                                
                                    <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('admin/coupon/edit').'/'.$uri . "/" .encode_url($row['coupon_id']); ?>';"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo base_url('admin/coupon/delete').'/'.$uri.'/'.encode_url($row['coupon_id']); ?>');"><i class="fa fa-trash-o "></i></button>
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