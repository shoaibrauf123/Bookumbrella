<section id="main-content">
    <section class="wrapper" style="min-height: 87vh;">
        <div class="col-lg-12 pull-left padding0 admin_title">
            <h2>Author Update</h2>
            <div class="my-4 border"></div>
            <form action="<?php echo base_url("author_update")?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author_name">Author Name</label>
                            <input type="hidden" name="author_id" id="author_id" class="form-control" value="<?php echo $response[0]->id ?>">
                            <input type="text" name="author_name" id="author_name" class="form-control" value="<?php echo $response[0]->author_name ?>" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author_name">Author Image</label>
                            <input type="file" class="form-control"  name="file_upload" >
                            <input type="hidden" name="old_image" value="<?php echo $response[0]->image ?>">
                            <img width="50px" src="<?php echo base_url("uploads/author_gallery/".$response[0]->image) ?>" alt="Not Found">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="featured">Author Featured</label>
                            <select name="featured" id="featured" class="form-control">
                                <option value="1" class="form-control" <?php echo ($response[0]->featured == 1) ? "selected" : "" ?>>Yes</option>
                                <option value="0" class="form-control" <?php echo ($response[0]->featured == 0) ? "selected" : "" ?>>no</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author_description">Description</label>
                            <textarea name="author_description" id="author_description" cols="1" rows="1" class="form-control" value="<?php echo $response[0]->description; ?>"><?php echo $response[0]->description; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="Update" class="btn btn-primary float-right" >
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>    