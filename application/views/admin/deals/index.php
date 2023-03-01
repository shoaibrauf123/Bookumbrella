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
                Upload vouchers via file
            </header>
            <?php $this->load->view('errors'); ?>
            <form action="<?php echo base_url('admin/vouchers'); ?>" id="create_user" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-8">
                      <div class="form-group col-md-6 margin-top-20 padding0">
                       <label for="name">Upload a csv file (.csv) *</label>
                        <div>
                            <div name="voucheR" data-provides="fileupload" class="fileupload fileupload-new">
                                <span class="btn btn-white btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select csv file (.csv)</span>
                                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Upload</span>
                                    <input name="vouchers" type="file" class="default" >
                                </span>
                                <span style="margin-left:5px;" class="fileupload-preview"></span>
                                <a style="float: none; margin-left:5px;" data-dismiss="fileupload" class="close fileupload-exists" href="#"></a>
                            </div>
                            <span class="error_signup"><?php echo form_error('vouchers'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <input type="submit" class="btn btn-shadow btn-primary" value="Upload">
                    <a href="<?php echo base_url('admin/export/vouchers');?>" class="btn btn-shadow btn-primary">Download</a>
                </div>
            </form>
                
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-2 col-sm-2 col-md-2">Link id</th>
                            <th class="col-xs-2 col-sm-2 col-md-2">Title</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Cat id</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Url</th>
                            <th class="col-xs-3 col-sm-3 col-md-3">Description</th>
                            <th class="col-xs-4 col-sm-2 col-md-2">Promotion Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) { ?>
                            <tr>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $row['link_id']; ?></td>
                                <td class="col-xs-3 col-sm-3 col-md-3"><div class="limit-listing-desc"><?php echo $row['title']; ?></div></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['cat_id']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['url']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['description']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['promotion_type']; ?></td>
                                  
                                <td class="col-xs-4 col-sm-2 col-md-2">
                                    <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo base_url('admin/vouchers/delete').'/'.$uri.'/'.encode_url($row['deal_id']); ?>');"><i class="fa fa-trash-o "></i></button>
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