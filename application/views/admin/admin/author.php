<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<section id="main-content">
    <section class="wrapper" style="min-height: 87vh;">
        <div class="col-lg-12 ">
            <h2 style="display: inline;">Author Record</h2>
            <div class="my-4"></div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Author Name</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php if(isset($author)){foreach($author as $auth){ ?>
                            <tr>
                                <td><?php echo $auth->author_name ?></td>
                                <td><img width="50px" height="80px" src="<?php echo  base_url("uploads/author_gallery/".$auth->image) ?>" alt="No Found"></td>
                                     <?php if($auth->featured == 1){ ?>
                                        <td>Yes</td>
                                     <?php }else{ ?>
                                        <td>No</td>
                                     <?php } ?>

                                <td style="width: 250px"><?php echo $auth->description; ?></td>
                                <td><a href="<?php echo base_url("edit_author/".$auth->id); ?>" class="btn btn-primary">Update</a> <a href="<?php echo base_url("delete_author/".$auth->id); ?>" class="btn btn-danger">Delete</a></td>
                            </tr>
                        <?php }} ?>
                    
                </tbody>
            </table>
        </div>
    </section>
</section>    