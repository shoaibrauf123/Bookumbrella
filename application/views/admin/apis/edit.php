<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- api start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Edit Api</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php // $this->load->view('errors'); ?>
                        <form action="<?php echo base_url('admin/api/edit').'/'.$this->uri->segment(4).'/'.encode_url($page_data['network_id']); ?>" id="create_page" role="form"
                              method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <label for="menu_label">Title *</label>
                                <input type="text" class="form-control" name="title" id="title"
                                       value="<?php echo $page_data['title']; ?>" required/>
                                <input type="hidden" name="id" value="<?php echo $page_data['network_id']; ?>" class="hidden"/>
                                <span class="error_signup"><?php echo form_error('title'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="single-page-editor">Secret Key *</label>
                                <input type="text" class="form-control" name="key" id="title"
                                       value="<?php echo $page_data['key']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('key'); ?></span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="single-page-editor">Website Id</label>
                                <input type="text" class="form-control" name="website_id" id="title"
                                       value="<?php echo $page_data['website_id']; ?>"/>
                                <span class="error_signup"><?php echo form_error('website_id'); ?></span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="single-page-editor">Cashback value</label>
                                <input type="text" class="form-control" name="cashback" id="title"
                                       value="<?php echo $page_data['cashback']; ?>"/>
                                <span class="error_signup"><?php echo form_error('cashback'); ?></span>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update Api">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>