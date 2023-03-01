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
                Manage Language Variables
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-2 col-sm-2 col-md-2">Variable Name</th>
                            <th class="col-xs-3 col-sm-3 col-md-3">Value</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Language</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) { ?>
                            <tr>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $row['variable_name']; ?></td>
                                <td class="col-xs-3 col-sm-3 col-md-3"><div class="limit-listing-desc"><?php echo $row['value']; ?></div></td>
                                <td class="col-xs-3 col-sm-3 col-md-3"><div class="limit-listing-desc"><?php echo ($row['language_id']=='2')?'Korean' : 'English'; ?></div></td>
                       
                                <td class="col-xs-4 col-sm-2 col-md-2">
                                    <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('admin/language_variables/edit').'/'.$uri . "/" .encode_url($row['id']); ?>';"><i class="fa fa-pencil"></i></button>
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

