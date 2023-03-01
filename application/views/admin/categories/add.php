<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Create Category</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>
                        <form action="<?php echo base_url('admin/categories/add'); ?>" id="create_category" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <label for="menu_label">Category Title *</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title'); ?>" required/>
                                <span class="error_signup"><?php echo form_error('title'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="menu_label">Parent Category</label>
                                <select class="form-control" name="parent_id" >
                                    <option value="0">Select Parent</option>
                                    <?php if($parent_categories){ foreach($parent_categories as $parents){ ?>
                                        <option <?php echo (set_value('parent_id') == $parents['category_id'])? 'selected="selected"' : ''; ?> value="<?php echo $parents['category_id']; ?>"><?php echo $parents['title']; ?></option>
                                    <?php } } ?>
                                </select>
                                <span class="error_signup"><?php echo form_error('parent_id'); ?></span>
                            </div>
                             
                            
                            
                            <div class="form-group col-md-8">
                                <label for="menu_label">Status *</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Select Status</option>
                                    <option <?php echo (set_value('status') == '1')? 'selected="selected"' : ''; ?> value="1">Active</option>
                                    <option <?php echo (set_value('status') == '0')? 'selected="selected"' : ''; ?> value="0">Deactive</option>
                                </select>
                                <span class="error_signup"><?php echo form_error('status'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                    <label class="top_lavel" for="top_lavel">
                                        <input name="top_lavel" id="top_lavel" type="checkbox"  value="on" /> Top Lavel
                                    </label>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="menu_label">Description *</label>
                                <textarea class="form-control"  name="description" id="description" rows="5" placeholder="Type your category discription here..." required><?php echo set_value('description'); ?></textarea>
                                <span class="error_signup"><?php echo form_error('description'); ?></span>
                            </div>
                             <div class="form-group col-md-8">
                                <label for="menu_label">Image </label>
                                <input type="file" name="image_upload" id="image_upload" class="form-control">
                                <span class="error_signup"><?php echo form_error('image_upload'); ?></span>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Create Category">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>