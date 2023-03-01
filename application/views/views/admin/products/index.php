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
                Manage Books
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-1 col-sm-1 col-md-1"></th>
                            <th class="col-xs-2 col-sm-2 col-md-2">Title</th>
                            <th class="col-xs-4 col-sm-4 col-md-4">Description</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Status</th>
                            <th class="col-xs-4 col-sm-2 col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) {  ?>
                            <tr>
                                <td class="col-xs-1 col-sm-1 col-md-1"><img class="product-list-thumb" src="<?php echo base_url().$row['image']; ?>"></td>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $row['title']; ?></td>
                                <td class="col-xs-4 col-sm-4 col-md-4"><div class="limit-listing-desc"><?php echo $row['description']; ?></div></td>
                                <td class="col-xs-1 col-sm-1 col-md-1">
                                    <?php if ($row['status'] == 1) { ?>
                                        <span class="btn btn-success btn-xs cursor_default" title="Actived"><i class="fa fa-check"></i></span>
                                    <?php } else { ?>
                                        <span class="btn btn-danger btn-xs cursor_default" title="Deactived"><i class="fa fa-ban"></i></span>
                                    <?php } ?>
                                </td>
                                <td class="col-xs-4 col-sm-2 col-md-2">
                                    <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('admin/products/edit').'/'.$uri . "/" .encode_url($row['product_id']); ?>';"><i class="fa fa-pencil"></i></button>
                                    <?php if($row['status'] == 1){ ?>
                                        <button class="btn btn-danger btn-xs" title="Deactivate this page" onclick="window.location = '<?php echo base_url('admin/products/update_status').'/'.$uri.'/'.encode_url($row['product_id']).'/0'; ?>'"><i class="fa fa-ban "></i></button>
                                    <?php }else{ ?>
                                        <button class="btn btn-success btn-xs" title="Activate this page" onclick="window.location = '<?php echo base_url('admin/products/update_status').'/'.$uri.'/'.encode_url($row['product_id']).'/1'; ?>'"><i class="fa fa-check "></i></button>
                                    <?php } ?>
                                    <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo base_url('admin/products/delete').'/'.$uri.'/'.encode_url($row['product_id']); ?>');"><i class="fa fa-trash-o "></i></button>
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