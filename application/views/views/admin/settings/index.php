<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">

                    <?php $this->load->view('errors'); ?>

                    <header class="panel-heading">
                        <label for="menu_label">Manage Settings</label>
                    </header>

                    <div class="panel-body">

                        <?php $settingGroups = get('setting_groups',false,'*',array('sort_order'=>'asc')); ?>

                        <div class="admin-settings-cont">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <?php $i=0; foreach($settingGroups as $sGroup){ ?>
                                    <li role="presentation" class="<?php echo $i==0 ? 'active':''; ?>"><a href="#<?php echo $sGroup['slug']; ?>" aria-controls="<?php echo $sGroup['slug']; ?>" role="tab" data-toggle="tab"><?php echo $sGroup['title']; ?></a></li>
                                <?php $i++; } ?>
                            </ul>

                            <!-- Tab panes -->
                            <form class="cmxform form-horizontal" method="post" action="<?php echo base_url('admin/settings'); ?>" enctype="multipart/form-data">
                                <div class="tab-content admin-settings-panel">
                                    <?php $x=0; foreach($settingGroups as $sGroup){ ?>
                                        <div role="tabpanel" class="tab-pane <?php echo $x==0 ? 'active':''; ?>" id="<?php echo $sGroup['slug']; ?>">
                                            <?php $settings_data = get('setting',array('group_id'=>$sGroup['id'],'user_id'=>$this->session->userdata('admin_user_id')),'*',array('sort_order'=>'asc')); ?>
                                            <?php if(count($settings_data) > 0){ ?>
                                                <?php foreach($settings_data as $setting){ ?>
                                                    <div class="form-group ">
                                                        <label for="field-<?php echo $setting['slug']; ?>" class="control-label col-lg-2"><?php echo ucwords($setting['title']); ?></label>
                                                        <div class="col-lg-6">
                                                            <?php if($setting['type'] == 'txt'){ ?>
                                                                <input id="field-<?php echo $setting['slug']; ?>" class="form-control" name="<?php echo $setting['slug']; ?>" type="text" value="<?php echo $setting['value']; ?>"/>
                                                                <span class="error_signup"><?php echo form_error($setting['slug']); ?></span>
                                                            <?php }else if($setting['type'] == 'file'){ ?>
                                                                <input id="field-<?php echo $setting['slug']; ?>" class="form-control" name="<?php echo $setting['slug']; ?>" type="file"/>
                                                                <span class="error_signup"><?php echo form_error($setting['slug']); ?></span>
                                                            <?php }
															else if($setting['type'] == 'dropdown'){ ?>
                                                                <?php if($setting['slug'] == 'active_layout'){ ?>
                                                                    <select id="field-<?php echo $setting['slug']; ?>" class="form-control" name="<?php echo $setting['slug']; ?>">
                                                                        <option value="">-- Select <?php echo $setting['title']; ?> --</option>
                                                                        <?php foreach($layouts as $layout){ ?>
                                                                            <option value="<?php echo $layout['id']; ?>" <?php echo $setting['value'] == $layout['id'] ? 'selected' :''; ?>><?php echo $layout['title']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                 <?php } ?>
                                                                <span class="error_signup"><?php echo form_error($setting['slug']); ?></span>
                                                            <?php }
															else if($setting['type'] == 'color'){ ?>
                                                                <input id="field-<?php echo $setting['slug']; ?>" class="form-control color-picker" name="<?php echo $setting['slug']; ?>" type="text" value="<?php echo $setting['value']; ?>""/>
                                                                <span class="error_signup"><?php echo form_error($setting['slug']); ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    <?php $x++; } ?>
                                    <hr>
                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">Save Changes</button>
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
