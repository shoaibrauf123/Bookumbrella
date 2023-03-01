<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">
                <label for="menu_label">Manage User Rights</label>
            </header>
            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">

                        <?php $this->load->view('errors'); ?>

                        <form action="<?php echo base_url('admin/users/access_rights').'/'.$this->uri->segment(4).'/'.encode_url($user_data['user_id']); ?>" id="edit_user" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <p class="margin-top-10 margin-bottom-30"><i>Mark as check/uncheck following options to allow/disallow modules for specified user !</i></p>
                                <?php foreach($modules_list as $module){ ?>
                                    <div class="module-block-disp margin-top-20">
                                        <span class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left padding0"><strong><?php echo $module['module']; ?></strong></span>
                                        <span class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left"><input type="checkbox" name="module_id[]" value="<?php echo $module['id']; ?>" <?php echo in_array($module['id'],$user_allowed_modules) ? 'checked':'' ; ?>></span>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update Rights">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </section>
    </section>
</section>