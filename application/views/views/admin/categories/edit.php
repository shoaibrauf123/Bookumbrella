<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Edit Category</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>
                        <form action="<?php echo base_url('admin/categories/edit').'/'.$this->uri->segment(4).'/'.encode_url($category_data['category_id']); ?>" id="edit_category" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-8">
                                <label for="menu_label">Category Title *</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $category_data['title']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('title'); ?></span>
                            </div>

                             <div class="form-group col-md-8">
                                <label for="menu_label">Parent Category</label>

                                <select class="form-control" type="text" name="parent_id" id="parent_select">
                                <option value="">Select Parent</option>
                                <?php if($parent_categories){ foreach($parent_categories as $parents) { ?>
                                <option <?php echo ($category_data['parent_id'] == $parents['category_id'])? 'selected="selected"' : ''; ?> value="<?php echo $parents['category_id']; ?>"><?php echo $parents['title']; ?></option>
                                <?php } } ?>
                                </select>
                                 <span class="error_signup"><?php echo form_error('parent_id'); ?></span>
                            </div>
                            
                           
                            
                            <div class="form-group col-md-8">
                                <label for="menu_label">Category Status</label>
                                <select class="form-control" type="text" name="status" required>
                                    <option value="">Select Status</option>
                                    <option <?php echo ($category_data['status'] == '1')? 'selected="selected"' : ''; ?> value="1">Active</option>
                                    <option <?php echo ($category_data['status'] == '0')? 'selected="selected"' : ''; ?> value="0">Deactive</option>
                                </select>
                                <span class="error_signup"><?php echo form_error('status'); ?></span>
                            </div>
                            <div class="form-group col-md-8">
                                    <label for="top_lavel">
                                        <input id="top_lavel" name="top_lavel" type="checkbox" <?php echo ($category_data['top_lavel']==1) ? 'checked="checked"':''; ?>  value="on" /> Top Lavel
                                    </label>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="menu_label">Description *</label>
                                <textarea class="form-control"  name="description" id="description" rows="5" placeholder="Type your category discription here..." required><?php echo $category_data['description']; ?></textarea>
                                <span class="error_signup"><?php echo form_error('description'); ?></span>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update Category">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- page end-->
    </section>
</section>