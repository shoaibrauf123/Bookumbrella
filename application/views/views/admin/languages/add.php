<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Add Language Variables</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        
                        <form action="<?php echo base_url('admin/language_variables/add'); ?>" id="create_category" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <label for="menu_label">Variable Name *</label>
                                <input type="text" class="form-control" name="variable_name" id="title" value="<?php echo set_value('variable_name'); ?>" required/>
                                <span class="error_signup"><?php echo form_error('variable_name'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-8">
                                <label for="value">Value *</label>
                                <input type="text" class="form-control" name="value" id="title" value="<?php echo set_value('value'); ?>" required/>
                                <span class="error_signup"><?php 