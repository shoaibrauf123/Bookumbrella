<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            

            <header class="panel-heading">
                <label for="menu_label">Create Book</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>
                        <form action="<?php echo base_url('admin/products/add'); ?>" id="create_product" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <label for="title">Book Title *</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title'); ?>" required/>
                                <span class="error_signup"><?php echo form_error('title'); ?></span>
                            </div>

                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-4 margin0">
                                    <label for="price">List Price </label>
                                    <input type="text" class="form-control" name="buy_price" id="buy_price" value="<?php echo set_value('buy_price'); ?>" onkeypress="return isDecimalValue(event)"/>
                                    <span class="error_signup"><?php echo form_error('buy_price'); ?></span>
                                </div>

                                
                                
                                
                                

                                <div class="form-group col-md-4 margin0">
                                    <label for="isbn">ISBN 10</label>
                                    <input type="text" class="form-control" name="isbn" id="isbn" value="<?php echo set_value('isbn'); ?>" onkeypress="return isDecimalValue(event)" />
                                    <span class="error_signup"><?php echo form_error('isbn'); ?></span>
                                </div>
                            </div>
                                <div class="form-group col-md-4 margin0">
                                    <label for="isbn13">ISBN 13 *</label>
                                    <input type="text" class="form-control" name="isbn13" id="isbn13" value="<?php echo set_value('isbn13'); ?>" onkeypress="return isDecimalValue(event)"  />
                                    <span class="error_signup"><?php echo form_error('isbn13'); ?></span>
                                </div>
                            </div>
                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-12 margin0">
                                    <label for="price">SKU </label>
                                    <input type="text" class="form-control" name="sku" id="sku" value="<?php echo set_value('sku'); ?>"/>
                                    <span class="error_signup"><?php echo form_error('sku'); ?></span>
                                </div>


                            <div class="form-group col-md-12 margin0">
                                    <label for="pages">Pages </label>
                                    <input type="text" class="form-control" name="pages" id="pages" value="<?php echo set_value('pages'); ?>" />
                                    <span class="error_signup"><?php echo form_error('pages'); ?></span>
                                </div>
                                
                                
                                
                            </div>
                            
                            
                            
                            
                            
                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-12 margin0">
                                    <label for="weight">Weight </label>
                                    <input type="text" class="form-control" name="weight" id="weight" value="<?php echo set_value('weight'); ?>" />
                                    <span class="error_signup"><?php echo form_error('weight'); ?></span>
                                </div>


                                <div class="form-group col-md-12 margin0">
                                    <label for="dimensions">Dimensions </label>
                                    <input type="text" class="form-control" name="dimensions" id="dimensions" value="<?php echo set_value('dimensions'); ?>"/>
                                    <span class="error_signup"><?php echo form_error('dimensions'); ?></span>
                                </div>
                                
                                
                                 <div class="form-group col-md-12 margin0">
                                    <label for="grade">Month Of The Book</label>
                                       <select name="month_of_the_book" class="form-control" id="month_of_the_book">
                                            <option value="1">Yes</option>
                                            <option value="0">no</option>
                                       </select>
                                    <span class="error_signup"><?php echo form_error('month_of_the_book'); ?></span>
                               
                                </div>


                            </div>
                            
                            
                            
                            
                            
                            

                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6 margin0">
                                    <label for="menu_label">Category </label>
                                    <select class="form-control" name="category_id" >
                                        <option value="">Select Category</option>
                                        <?php if($categories){ foreach($categories as $cat){ ?>
                                            <option <?php echo (set_value('category_id') == $cat['category_id'])? 'selected="selected"' : ''; ?> value="<?php echo $cat['category_id']; ?>"><?php echo $cat['title']; ?></option>
                                        <?php } } ?>
                                    </select>
                                    <span class="error_signup"><?php echo form_error('category_id'); ?></span>
                                </div>
                                <div class="form-group col-md-6 margin0">
                                    <label for="image">Display Image *</label>
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
                                    <label for="advertiser_id">Publisher Id</label>
                                    <input type="number" class="form-control" name="advertiser_id" id="advertiser_id" value="<?php echo set_value('advertiser_id'); ?>" />
                                    <span class="error_signup"><?php echo form_error('advertiser_id'); ?></span>
                                </div>

                                <div class="form-group col-md-6 margin0">
                                    <label for="advertiser_name">Publisher Name</label>
                                    <input type="text" class="form-control" name="advertiser_name" id="advertiser_name" value="<?php echo set_value('advertiser_name'); ?>" />
                                    <span class="error_signup"><?php echo form_error('advertiser_name'); ?></span>
                                </div>
                            </div>

                            
                            
                            
                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-6 margin0">
                                    <label for="author">Author</label>
                                    <!-- <input type="text" class="form-control" name="author" id="author" value="<?php echo set_value('author'); ?>" /> -->
                                    <select name="author" id="author" class="form-control">
                                        <?php if(isset($author)){foreach($author as $aut){ ?>
                                            <option value="<?php echo $aut->id ?>"><?php echo $aut->author_name ?></option>
                                        <?php }} ?>
                                    </select>
                                    <span class="error_signup"><?php echo form_error('author'); ?></span>
                                </div>

                                <div class="form-group col-md-6 margin0">
                                    <label for="format">Format</label>
                                    <input type="text" class="form-control" name="format" id="format" value="<?php echo set_value('format'); ?>" />
                                    <span class="error_signup"><?php echo form_error('format'); ?></span>
                                </div>
                            </div>
                            
                               
                            
                            
                            <div class="form-group col-md-8 padding0">
                                <div class="form-group col-md-4 margin0">
                                    <label for="edition">Edition </label>
                                    <input type="text" class="form-control" name="edition" id="edition" value="<?php echo set_value('edition'); ?>" />
                                    <span class="error_signup"><?php echo form_error('edition'); ?></span>
                                </div>

                                <div class="form-group col-md-4 margin0">
                                    <label for="language">Language</label>
                                    <input type="text" readonly class="form-control" name="language" id="language" value="English" />
                                    <span class="error_signup"><?php echo form_error('language'); ?></span>
                                </div>
                                
                                
                                
                                

                                <div class="form-group col-md-4 margin0">
                                    <label for="grade">Grade</label>
                                    <input type="text" class="form-control" name="grade" id="grade" value="<?php echo set_value('grade'); ?>"  />
                                    <span class="error_signup"><?php echo form_error('grade'); ?></span>
                                </div>
                            </div>
                           
                            
                            
                            
                            

                            <div class="form-group col-md-8">
                                <label for="single-product-editor">Description</label>
                                <textarea class="form-control"  name="description" id="single-page-editor" rows="10" placeholder="Type your product long description here..." ><?php echo set_value('description'); ?></textarea>
                                <span class="error_signup"><?php echo form_error('description'); ?></span>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Create Book">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>