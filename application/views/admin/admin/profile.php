<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">

                    <?php $this->load->view('errors'); ?>

                    <header class="panel-heading">
                        <label for="menu_label">Update Profile</label>
                    </header>

                    <div class="panel-body">
                        <div class=" form">
                            <form id="" class="cmxform form-horizontal tasi-form" method="post" action="<?php echo base_url('admin/profile'); ?>" enctype="multipart/form-data">
                                <div class="form-group ">
                                    <label for="admin_user_name" class="control-label col-lg-2">Username *</label>
                                    <div class="col-lg-6">
                                        <input id="admin_user_name" placeholder="Enter admin name" class=" form-control" name="admin_user_name" type="text" value="<?php echo $admin_data['username']; ?>" required />
                                        <span class="error_signup"><?php echo form_error('admin_user_name'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="admin_user_email" class="control-label col-lg-2">Email *</label>
                                    <div class="col-lg-6">
                                        <input id="admin_user_email" placeholder="Enter admin email" class="form-control" name="email" type="email" value="<?php echo $admin_data['email']; ?>" required />
                                        <span class="error_signup"><?php echo form_error('email'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="admin_image" class="control-label col-lg-2">Update Image</label>
                                    <div class="col-lg-6">
                                        <div name="admin_image" data-provides="fileupload" class="fileupload fileupload-new">
                                            <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input name="admin_image" type="file" class="default">
                                            </span>
                                            <span style="margin-left:5px;" class="fileupload-preview"></span>
                                            <a style="float: none; margin-left:5px;" data-dismiss="fileupload" class="close fileupload-exists" href="#"></a>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('admin_image'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="new_password" class="control-label col-lg-2">New Password</label>
                                    <div class="col-lg-6">
                                        <input id="new_password" class="form-control" name="new_password"  type="password"/>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="cnfrm_password" class="control-label col-lg-2">Confirm Password</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" name="confirm_password" type="password"/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-info" type="submit">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </section>
            </div>
        </div>

        <!-- page end-->
    </section>
</section>