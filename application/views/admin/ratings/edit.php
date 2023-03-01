<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Update Rating</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>

                        <form action="<?php echo base_url('admin/ratings/edit').'/'.$this->uri->segment(4).'/'.encode_url($result['id']); ?>" id="update_rating" role="form" method="post">
                            <div class="form-group col-md-8">
                                <label for="no_stars">Rating Stars *</label>
                                <select class="form-control" name="no_stars">
                                	<option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <span class="error_signup"><?php echo form_error('no_stars'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="comments">Comments </label>
                                
                                <textarea class="form-control" name="comments"><?php echo $result['comments'] ?></textarea>
                                <span class="error_signup"><?php echo form_error('comments'); ?></span>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update Rating">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>