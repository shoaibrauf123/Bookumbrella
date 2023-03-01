<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Create Page</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>
                        <form action="<?php echo base_url('admin/pages/add'); ?>" id="create_page" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <label for="menu_label">Page Title *</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title'); ?>" required/>
                                <span class="error_signup"><?php echo form_error('title'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="single-page-editor">Description *</label>
                                <textarea class="form-control"  name="description" id="single-page-editor" rows="10" placeholder="Type your page content here..." required><?php echo set_value('description'); ?></textarea>
                                <span class="error_signup"><?php echo form_error('description'); ?></span>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Create Page">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>