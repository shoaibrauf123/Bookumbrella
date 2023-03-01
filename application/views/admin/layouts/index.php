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
                Manage Layouts
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-2 col-sm-2 col-md-2">Title</th>
                            <th class="col-xs-4 col-sm-2 col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) { ?>
                            <tr>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $row['title']; ?></td>
                                <td class="col-xs-4 col-sm-2 col-md-2">
                                    <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('admin/layouts/edit').'/'.$uri . "/" .encode_url($row['id']); ?>';"><i class="fa fa-pencil"></i></button>
                                    <?php if($row['id'] != 1){ ?>
                                        <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo base_url('admin/layouts/delete').'/'.$uri.'/'.encode_url($row['id']); ?>');"><i class="fa fa-trash-o "></i></button>
                                    <?php } ?>
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