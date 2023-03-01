<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Edit Layout</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>
                        <form action="<?php echo base_url('admin/layouts/edit').'/'.$this->uri->segment(4).'/'.encode_url($layout_data['id']); ?>" id="edit_layout" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <label for="menu_label">Layout Title *</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $layout_data['title']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('title'); ?></span>
                            </div>

                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-3">
                                    <label for="menu_label">Main Color *</label>
                                    <input type="text" class="form-control color-picker" name="main_color" id="main_color" value="<?php echo $layout_data['main_color']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('main_color'); ?></span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="menu_label">Secondary Color *</label>
                                    <input type="text" class="form-control color-picker" name="secondary_color" id="secondary_color" value="<?php echo $layout_data['secondary_color']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('secondary_color'); ?></span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="menu_label">Hover Color *</label>
                                    <input type="text" class="form-control color-picker" name="hover_color" id="hover_color" value="<?php echo $layout_data['hover_color']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('hover_color'); ?></span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="menu_label">Static Color *</label>
                                    <input type="text" class="form-control color-picker" name="static_color" id="static_color" value="<?php echo $layout_data['static_color']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('static_color'); ?></span>
                                </div>
                            </div>

                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6">
                                    <label for="menu_label">Main Background Color *</label>
                                    <input type="text" class="form-control color-picker" name="main_bg_color" id="main_bg_color" value="<?php echo $layout_data['main_bg_color']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('main_bg_color'); ?></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="menu_label">Secondary Background Color *</label>
                                    <input type="text" class="form-control color-picker" name="secondary_bg_color" id="secondary_bg_color" value="<?php echo $layout_data['secondary_bg_color']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('secondary_bg_color'); ?></span>
                                </div>
                            </div>

                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6">
                                    <label for="menu_label">Main Border Color *</label>
                                    <input type="text" class="form-control color-picker" name="main_border_color" id="main_border_color" value="<?php echo $layout_data['main_border_color']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('main_border_color'); ?></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="menu_label">Secondary Border Color *</label>
                                    <input type="text" class="form-control color-picker" name="secondary_border_color" id="secondary_border_color" value="<?php echo $layout_data['secondary_border_color']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('secondary_border_color'); ?></span>
                                </div>
                            </div>

                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6">
                                    <label for="menu_label">Button Background Color *</label>
                                    <input type="text" class="form-control color-picker" name="btn_bg_color" id="btn_bg_color" value="<?php echo $layout_data['btn_bg_color']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('btn_bg_color'); ?></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="menu_label">Button Hover Color *</label>
                                    <input type="text" class="form-control color-picker" name="btn_hover_color" id="btn_hover_color" value="<?php echo $layout_data['btn_hover_color']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('btn_hover_color'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update Layout">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- page end-->
    </section>
</section>