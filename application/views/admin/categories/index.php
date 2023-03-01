<?php
    $uri = 0;
    if($this->uri->segment(3) != ''){
        $uri = $this->uri->segment(3);
    }
?>
<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">
                Manage Categories
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-2 col-sm-2 col-md-1">Id</th>
                            <th class="col-xs-2 col-sm-2 col-md-2">Title</th>
                            <th class="col-xs-3 col-sm-3 col-md-3">Description</th>
                            
                            <th class="col-xs-1 col-sm-1 col-md-1">Status</th>
                            
                            <th class="col-xs-4 col-sm-2 col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) { ?>
                            <tr>
                            <td class="col-xs-1 col-sm-1 col-md-1">
                                
                                        
                                    <?php echo $row['category_id'];  ?>
                                        
                                    <?php  ?>
                                </td>
                                
                            
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $row['title']; ?></td>
                                <td class="col-xs-3 col-sm-3 col-md-3"><div class="limit-listing-desc"><?php echo $row['description']; ?></div></td>
                                <td class="col-xs-1 col-sm-1 col-md-1">
                                    <?php if ($row['top_lavel'] == 1) { ?>
                                        <span class="btn btn-success btn-xs cursor_default" title="Top lavel Category"><i class="fa fa-check"></i></span>
                                    <?php } else { ?>
                                        <span class="btn btn-danger btn-xs cursor_default" title="Not a top lavel Category"><i class="fa fa-ban"></i></span>
                                    <?php } ?>
                                </td>
                               
                                
                                <td class="col-xs-4 col-sm-2 col-md-2">
                                    <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('admin/categories/edit').'/'.$uri . "/" .encode_url($row['category_id']); ?>';"><i class="fa fa-pencil"></i></button>
                                    <?php if($row['status'] == 1){ ?>
                                        <button class="btn btn-danger btn-xs" title="Deactivate this category" onclick="window.location = '<?php echo base_url('admin/categories/update_status').'/'.$uri.'/'.encode_url($row['category_id']).'/0'; ?>'"><i class="fa fa-ban "></i></button>
                                    <?php }else{ ?>
                                        <button class="btn btn-success btn-xs" title="Activate this category" onclick="window.location = '<?php echo base_url('admin/categories/update_status').'/'.$uri.'/'.encode_url($row['category_id']).'/1'; ?>'"><i class="fa fa-check "></i></button>
                                    <?php } ?>
                                    <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo base_url('admin/categories/delete').'/'.$uri.'/'.encode_url($row['category_id']); ?>');"><i class="fa fa-trash-o "></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php echo $pagination; ?>
            <?php }else{
                adminRecordNotFoundMsg();
            } ?>
        </section>
    </section>
</section>

<script type="application/javascript">

    function importProducts(cat_id){

        var actionUrl = '<?php echo base_url('admin/products/import_products') ?>';
        var loaderObj = $('.products-import-loader-cont');

        resetProductsImportLoader();

        $.ajax({
            url:actionUrl,
            type:'post',
            data:{cat_id:cat_id},
            success:function(response){
                console.log(response);

                var decodedResponse = $.parseJSON(response);
                var dialogueDisplayTime = 1000;

                if(decodedResponse){
                    var respMsg = decodedResponse['msg'];
                    var respStatus = decodedResponse['status'];
                    var respProdAttr = decodedResponse['product_attr'];

                    loaderObj.find('.content-loading-msg').text(respMsg);
                    loaderObj.find('img').hide();

                    if(respStatus == 'success'){
                        loaderObj.find('.content-loading-msg').addClass('green');
                        loaderObj.find('.success-img').show();
                        dialogueDisplayTime = 1000;

                    } else if(respStatus == 'warning'){
                        loaderObj.find('.content-loading-msg').addClass('yellow');
                        loaderObj.find('.warning-img').show();
                        dialogueDisplayTime = 2500;

                    } else if(respStatus == 'error'){
                        loaderObj.find('.content-loading-msg').addClass('red');
                        loaderObj.find('.error-img').show();
                        dialogueDisplayTime = 1500;
                    }

                    setTimeout(function(){
                        loaderObj.hide('slow');
                    }, dialogueDisplayTime);
                }
            }
        });
    }

    function resetProductsImportLoader(){
        var loaderObj = $('.products-import-loader-cont');

        loaderObj.find('img').hide();
        loaderObj.find('.loader-img').show();
        loaderObj.find('.content-loading-msg').removeClass('yellow red green');

        loaderObj.find('.content-loading-msg').text("Importing products, please wait a moment...");
        loaderObj.show();
    }
</script>