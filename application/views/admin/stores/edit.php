<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Edit Store</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); 
                        ?>
                        <form action="<?php echo base_url('admin/stores/edit').'/'.$this->uri->segment(4).'/'.encode_url($store_data['store_id']); ?>" id="update_store" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <label for="title">Store Name *</label>
                                <input type="text" class="form-control" name="name" id="title" value="<?php echo $store_data['name']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('name'); ?></span>
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

                            <div class="form-group col-md-8">
                                <label for="price">Network Store id *</label>
                                <input type="text" class="form-control" name="network_store_id" id="network_id" value="<?php echo $store_data['network_store_id']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('network_store_id'); ?></span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="store_link_url">Store Url *</label>
                                <input type="text" class="form-control" name="store_link_url" id="store_link_url" value="<?php echo $store_data['store_link_url']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('store_link_url'); ?></span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="url_key">Url Key *</label>
                                <input type="text" class="form-control" name="url_key" id="network_id" value="<?php echo $store_data['url_key']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('url_key'); ?></span>
                            </div>
                           
                            <div class="form-group col-md-8">
                                <label for="short_description">Short Description *</label>
                                <textarea class="form-control"  name="short_description" rows="6" id="short_description" placeholder="Type description here..." required><?php echo $store_data['short_description']; ?></textarea>
                                <span class="error_signup"><?php echo form_error('short_description'); ?></span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="long_description">Long Description</label>
                                <textarea class="form-control"  name="long_description" id="single-page-editor" rows="10" placeholder="Type your store long description here..." required><?php echo $store_data['long_description']; ?></textarea>
                                <span class="error_signup"><?php echo form_error('long_description'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-8">
                                <label for="menu_label">Network *</label>
                                <select class="form-control" name="network_id" required>
                                    <option value="">Select Network</option>
                                    <?php if($networks){ foreach($networks as $network){ ?>
                                        <option <?php echo ($network['network_id']== $store_data['network_id'])? 'selected="selected"' : ''; ?> value="<?php echo $network['network_id']; ?>"><?php echo $network['title']; ?></option>
                                    <?php } } ?>
                                </select>
                                <span class="error_signup"><?php echo form_error('network_id'); ?></span>
                            </div>
                             <div class="form-group col-md-8">
                                <label for="keywords">keywords *</label>
                                <input type="text" class="form-control" name="keywords" id="store_link_url" value="<?php echo $store_data['keywords']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('keywords'); ?></span>
                            </div>
                             <div class="form-group col-md-8">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $store_data['address']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('address'); ?></span>
                            </div>
                             <div class="form-group col-md-8">
                                <label for="menu_label">Status *</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Select status</option>
                                     <option value="1" <?php if($store_data['status']==1){ echo 'selected="selected"';}  ?>>Active</option>
                                     <option value="0" <?php if($store_data['status']==0){ echo 'selected="selected"';}  ?>>InActive</option>
                                     
                                </select>
                                <span class="error_signup"><?php echo form_error('status'); ?></span>
                            </div>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update Store">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>