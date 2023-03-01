<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Edit Langugae Variable</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
              
                        <form action="<?php echo base_url('admin/language_variables/edit').'/'.$this->uri->segment(4).'/'.encode_url($language_data[0]['id']); ?>" id="edit_category" role="form" method="post" enctype="multipart/form-data">
                           <div class="form-group col-md-8">
                                <label for="menu_label">Variable Name *</label>
                                <input type="text" class="form-control" name="variable_name" id="title" value="<?php echo $language_data[0]['variable_name']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('variable_name'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-8">
                                <label for="value">Value *</label>
                                <input type="text" class="form-control" name="value" id="title" value="<?php echo $language_data[0]['value']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('value'); ?></span>
                            </div>
     
                            
                            <div class="form-group col-md-8">
                                <label for="menu_label">Language *</label>
                                <select class="form-control" name="language_id" required>
                                    <option value="">Select Language</option>
                                    <option <?php echo ($language_data[0]['language_id'] == '2')? 'selected="selected"' : ''; ?> value="2">Korean</option>
                                </select>
                                <span class="error_signup"><?php echo form_error('language_id'); ?></span>
                            </div>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update Language">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- page end-->
    </section>
</section>