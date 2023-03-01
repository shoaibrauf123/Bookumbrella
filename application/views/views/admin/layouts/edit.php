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

                            <div class="general-layout-settings">
                                <div class="form-group col-md-8 padding0">
                                    <h3>General</h3>
                                    <hr>
                                    <div class="form-group col-md-6">
                                        <label for="menu_label">Layout Title *</label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $layout_data['title']; ?>" required/>
                                        <span class="error_signup"><?php echo form_error('title'); ?></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="menu_label">Update Banner</label>
                                        <input class="form-control" name="banner_image" type="file"/>
                                        <span class="error_signup"><?php echo form_error('banner_image'); ?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-md-3">
                                        <label for="menu_label">Main Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="main_color" id="main_color" value="<?php echo $layout_data['main_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('main_color'); ?></span>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="menu_label">Secondary Color *</label>
                                        <div class="input-group color-picker">
                                            <input type="text" class="form-control" name="secondary_color" id="secondary_color" value="<?php echo $layout_data['secondary_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('secondary_color'); ?></span>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="menu_label">Hover Color *</label>
                                        <div class="input-group color-picker">
                                            <input type="text" class="form-control" name="hover_color" id="hover_color" value="<?php echo $layout_data['hover_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('hover_color'); ?></span>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="menu_label">Static Color *</label>
                                        <div class="input-group color-picker">
                                            <input type="text" class="form-control" name="static_color" id="static_color" value="<?php echo $layout_data['static_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('static_color'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group col-md-8 padding0">
                                    <div class="form-group col-md-6">
                                        <label for="menu_label">Main Background Color *</label>
                                        <div class="input-group color-picker">
                                            <input type="text" class="form-control" name="main_bg_color" id="main_bg_color" value="<?php echo $layout_data['main_bg_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('main_bg_color'); ?></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="menu_label">Secondary Background Color *</label>
                                        <div class="input-group color-picker">
                                            <input type="text" class="form-control" name="secondary_bg_color" id="secondary_bg_color" value="<?php echo $layout_data['secondary_bg_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('secondary_bg_color'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group col-md-8 padding0">
                                    <div class="form-group col-md-6">
                                        <label for="menu_label">Main Border Color *</label>
                                        <div class="input-group color-picker">
                                            <input type="text" class="form-control" name="main_border_color" id="main_border_color" value="<?php echo $layout_data['main_border_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('main_border_color'); ?></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="menu_label">Secondary Border Color *</label>
                                        <div class="input-group color-picker">
                                            <input type="text" class="form-control" name="secondary_border_color" id="secondary_border_color" value="<?php echo $layout_data['secondary_border_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('secondary_border_color'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group col-md-8 padding0">
                                    <div class="form-group col-md-6">
                                        <label for="menu_label">Button Background Color *</label>
                                        <div class="input-group color-picker">
                                            <input type="text" class="form-control" name="btn_bg_color" id="btn_bg_color" value="<?php echo $layout_data['btn_bg_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('btn_bg_color'); ?></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="menu_label">Button Hover Color *</label>
                                        <div class="input-group color-picker">
                                            <input type="text" class="form-control" name="btn_hover_color" id="btn_hover_color" value="<?php echo $layout_data['btn_hover_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('btn_hover_color'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="header-layout-settings">
                                <div class="form-group col-md-8 padding0">
                                    <h3>Header</h3>
                                    <hr>
                                    <div class="form-group col-md-4">
                                        <label for="header_top_text_color">Header Top Text Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="header_top_text_color" id="header_top_text_color" value="<?php echo $layout_data['header_top_text_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('header_top_text_color'); ?></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="header_top_lnks_color">Header Top Links Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="header_top_lnks_color" id="header_top_lnks_color" value="<?php echo $layout_data['header_top_lnks_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('header_top_lnks_color'); ?></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="header_menu_link_text_color">Header Menu Link Text Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="header_menu_link_text_color" id="header_menu_link_text_color" value="<?php echo $layout_data['header_menu_link_text_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('header_menu_link_text_color'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="content-layout-settings">
                                <div class="form-group col-md-8 padding0">
                                    <h3>Content Body</h3>
                                    <hr>
                                    <div class="form-group col-md-3">
                                        <label for="content_text_color">Content Text Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="content_text_color" id="content_text_color" value="<?php echo $layout_data['content_text_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('content_head_text_color'); ?></span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="content_head_text_color">Content Head Text Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="content_head_text_color" id="content_head_text_color" value="<?php echo $layout_data['content_head_text_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('content_head_text_color'); ?></span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="content_bolded_text_color">Content Text Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="content_bolded_text_color" id="content_bolded_text_color" value="<?php echo $layout_data['content_bolded_text_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('content_bolded_text_color'); ?></span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="content_link_color">Content Link Text Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="content_link_color" id="content_link_color" value="<?php echo $layout_data['content_link_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('content_link_color'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-layout-settings">
                                <div class="form-group col-md-8 padding0">
                                    <h3>Footer</h3>
                                    <hr>
                                    <div class="form-group col-md-4">
                                        <label for="content_head_text_color">Footer Text Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="footer_text_color" id="footer_text_color" value="<?php echo $layout_data['footer_text_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('footer_text_color'); ?></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="footer_head_text_color">Footer Head Text Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="footer_head_text_color" id="footer_head_text_color" value="<?php echo $layout_data['footer_head_text_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('footer_head_text_color'); ?></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="footer_navigation_links_color">Footer Link Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="footer_navigation_links_color" id="footer_navigation_links_color" value="<?php echo $layout_data['footer_navigation_links_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('footer_navigation_links_color'); ?></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="footer_bottom_text_color">Footer Bottom Text Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="footer_bottom_text_color" id="footer_bottom_text_color" value="<?php echo $layout_data['footer_bottom_text_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('footer_bottom_text_color'); ?></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="footer_bottom_links_color">Footer Bottom Link Color *</label>
                                        <div class="input-group color-picker">
                                            <input class="form-control" name="footer_bottom_links_color" id="footer_bottom_links_color" value="<?php echo $layout_data['footer_bottom_links_color']; ?>" required/>
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('footer_bottom_links_color'); ?></span>
                                    </div>
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