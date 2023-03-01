<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Edit Book</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>
                        <form action="<?php echo base_url('admin/products/edit').'/'.$this->uri->segment(4).'/'.encode_url($product_data['product_id']); ?>" id="edit_product" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <label for="title">Book Title *</label>
                                <input type="text" class="form-control" name="title" id="title" value='<?php echo $product_data['title']; ?>' required/>
                                <span class="error_signup"><?php echo form_error('title'); ?></span>
                            </div>

                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-4 margin0">
                                    <label for="buy_price">Buy Price *</label>
                                    <input type="text" class="form-control" name="buy_price" id="buy_price" value="<?php echo $product_data['buy_price']; ?>" onkeypress="return isDecimalValue(event)" required/>
                                    <span class="error_signup"><?php echo form_error('buy_price'); ?></span>
                                </div>

                                <div class="form-group col-md-4 margin0">
                                    <label for="retail_price">Rent Price</label>
                                    <input type="text" class="form-control" name="rent_price" id="rent_price" value="<?php echo $product_data['rent_price']; ?>" onkeypress="return isDecimalValue(event)" />
                                    <span class="error_signup"><?php echo form_error('rent_price'); ?></span>
                                </div>

                                <div class="form-group col-md-4 margin0">
                                    <label for="isbn">ISBN</label>
                                    <input type="text" class="form-control" name="isbn" id="isbn" value="<?php echo $product_data['isbn']; ?>" onkeypress="return isDecimalValue(event)" />
                                    <span class="error_signup"><?php echo form_error('isbn'); ?></span>
                                </div>
                            </div>

                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-12 margin0">
                                    <label for="price">SKU *</label>
                                    <input type="text" class="form-control" name="sku" id="sku" value="<?php echo $product_data['sku']; ?>" required/>
                                    <span class="error_signup"><?php echo form_error('sku'); ?></span>
                                </div>


                            </div>
                            
                            
                            
                            
                            
                            

                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6 margin0">
                                    <label for="menu_label">Category *</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php if($categories){ foreach($categories as $cat){ ?>
                                            <option <?php echo ($cat['category_id'] == $product_data['category_id'])? 'selected="selected"' : ''; ?> value="<?php echo $cat['category_id']; ?>"><?php echo $cat['title']; ?></option>
                                        <?php } } ?>
                                    </select>
                                    <span class="error_signup"><?php echo form_error('category_id'); ?></span>
                                </div>
                                <div class="form-group col-md-6 margin0">
                                    <label for="image">Update Image</label>
                                    <div>
                                        <div name="image" data-provides="fileupload" class="fileupload fileupload-new">
                                            <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input name="image" type="file" class="default">
                                            </span>
                                            <span style="margin-left:5px;" class="fileupload-preview"></span>
                                            <a style="float: none; margin-left:5px;" data-dismiss="fileupload" class="close fileupload-exists" href="#"></a>
                                        </div>
                                        <span class="error_signup"><?php echo form_error('image'); ?></span>
                                    </div>
                                </div>
                            </div>






<div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6 margin0">
                                    <label for="book_condition">Condition</label>
                                    <select class="form-control" name="book_condition" required>
                                        <option value="">Select Condition</option>
                                       
                               <option <?php echo (set_value('book_condition') == 'New')? 'selected="selected"' : ''; ?> value="New">New</option>
                               <option <?php echo (set_value('book_condition') == 'Like New')? 'selected="selected"' : ''; ?> value="Like New">Like New</option>
                               <option <?php echo (set_value('book_condition') == 'Very Good')? 'selected="selected"' : ''; ?> value="Very Good">Very Good</option>
                               <option <?php echo (set_value('book_condition') == 'Good')? 'selected="selected"' : ''; ?> value="Good">Good</option>
                               <option <?php echo (set_value('book_condition') == 'Acceptable')? 'selected="selected"' : ''; ?> value="Acceptable">Acceptable</option>
                               
                                    </select>
                                    <span class="error_signup"><?php echo form_error('book_condition'); ?></span>
                                </div>

                                <div class="form-group col-md-6 margin0">
                                    <label for="retail_price">Type</label>
                                    
                                    <select class="form-control" name="book_type" required>
                                        <option value="">Select Type</option>
                                       
                               <option <?php echo (set_value('book_type') == 'Normal')? 'selected="selected"' : ''; ?> value="Normal">Normal</option>
                               <option <?php echo (set_value('book_type') == 'Internation Edition')? 'selected="selected"' : ''; ?> value="Internation Edition">Internation Edition</option>
                               <option <?php echo (set_value('book_type') == 'Teachers Edition')? 'selected="selected"' : ''; ?> value="Teachers Edition">Teachers Edition</option>
                               <option <?php echo (set_value('book_type') == 'Study Guide')? 'selected="selected"' : ''; ?> value="Study Guide">Study Guide</option>
                               <option <?php echo (set_value('book_type') == 'Work Book')? 'selected="selected"' : ''; ?> value="Work Book">Work Book</option>
                               <option <?php echo (set_value('book_type') == 'Library Copy')? 'selected="selected"' : ''; ?> value="Library Copy">Library Copy</option>
                               
                                    </select>
                                    
                                    <span class="error_signup"><?php echo form_error('book_type'); ?></span>
                                </div>
                            </div>
















                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6 margin0">
                                    <label for="price">Advertiser Id</label>
                                    <input type="number" class="form-control" name="advertiser_id" id="advertiser_id" value="<?php echo $product_data['advertiser_id']; ?>" />
                                    <span class="error_signup"><?php echo form_error('advertiser_id'); ?></span>
                                </div>

                                <div class="form-group col-md-6 margin0">
                                    <label for="retail_price">Advertiser Name</label>
                                    <input type="text" class="form-control" name="advertiser_name" id="advertiser_name" value="<?php echo $product_data['advertiser_name']; ?>" />
                                    <span class="error_signup"><?php echo form_error('advertiser_name'); ?></span>
                                </div>
                            </div>

                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6 margin0">
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control" name="author" id="author" value="<?php echo $product_data['author']; ?>" />
                                    <span class="error_signup"><?php echo form_error('author'); ?></span>
                                </div>

                                <div class="form-group col-md-6 margin0">
                                    <label for="format">Format</label>
                                    <input type="text" class="form-control" name="format" id="format" value="<?php echo $product_data['format']; ?>" />
                                    <span class="error_signup"><?php echo form_error('format'); ?></span>
                                </div>
                            </div>
                            
                            
                            
                            
                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6 margin0">
                                    <label for="edition">Edition</label>
                                    <input type="number" class="form-control" name="edition" id="edition" value="<?php echo $product_data['edition']; ?>" />
                                    <span class="error_signup"><?php echo form_error('edition'); ?></span>
                                </div>

                                <div class="form-group col-md-6 margin0">
                                    <label for="language">Language</label>
                                    <input type="text" readonly class="form-control" name="language" id="language" value="English" />
                                    <span class="error_signup"><?php echo form_error('english'); ?></span>
                                </div>
                            </div>
                            
                            
                            
                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6 margin0">
                                    <label for="grade">Grade</label>
                                    <input type="text" class="form-control" name="grade" id="grade" value="<?php echo $product_data['grade']; ?>" />
                                    <span class="error_signup"><?php echo form_error('grade'); ?></span>
                                </div>

                                
                            </div>
                            
                            
                            

                            <div class="form-group col-md-8">
                                <label for="single-product-editor">Description</label>
                                <textarea class="form-control"  name="description" id="single-page-editor" rows="10" placeholder="Type your product long description here..." required><?php echo $product_data['description']; ?></textarea>
                                <span class="error_signup"><?php echo form_error('description'); ?></span>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update Book">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- page end-->
    </section>
</section>