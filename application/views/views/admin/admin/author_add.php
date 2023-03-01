<section id="main-content">
    <section class="wrapper" style="min-height: 87vh;">
        <div class="col-lg-12 pull-left padding0 admin_title">
            <h2>Author Create</h2>
            <div class="my-4 border"></div>
            <form action="<?php echo base_url("author_create")?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author_name">Author Name</label>
                            <input type="text" name="author_name" id="author_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file_upload">Author Image</label>
                            <input type="file" class="form-control" name="file_upload">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="featured">Author Featured</label>
                            <select name="featured" id="featured" class="form-control">
                                <option value="1" class="form-control">Yes</option>
                                <option value="0" class="form-control">no</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author_description">Description</label>
                            <textarea name="author_description" id="author_description" cols="1" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="Submit" class="btn btn-primary float-right" >
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>    