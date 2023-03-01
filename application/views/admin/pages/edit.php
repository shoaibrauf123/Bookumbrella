<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Edit Page</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>
                        <form action="<?php echo base_url('admin/pages/edit').'/'.$this->uri->segment(4).'/'.encode_url($page_data['page_id']); ?>" id="edit_page" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <label for="menu_label">Page Title *</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $page_data['title']; ?>" required/>
                                <span class="error_signup"><?php echo form_error('title'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="page-url">Page Url:</label>&nbsp;
                                <div class="page-slug-editing-cont">
                                    <p class="view-screen-field-val" id="page-url">
                                        <a id="page-link" target="_blank" href="<?php echo base_url('pages/'.$page_data['slug']); ?>"><?php echo base_url('pages'); ?>/<span id="slug-edit-disp"><?php echo $page_data['slug']; ?></span></a>
                                        <input id="page-slug-val" name="slug" value="<?php echo $page_data['slug']; ?>">
                                        <a id="page-slug-edit" class="btn-primary btn-xs" href="javascript:void(0);" data-action-type="edit">Edit</a>
                                    </p>
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="last-page-update-by">Last Updated By:</label>&nbsp;<p class="view-screen-field-val" id="last-page-update-by"><?php echo getUsername($page_data['updated_by']); ?></p>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="last-page-update-on">Last Updated On:</label>&nbsp;<p class="view-screen-field-val" id="last-page-update-on"><?php echo $page_data['date_updated']; ?></p>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="page-added-by">Added By:</label>&nbsp;<p class="view-screen-field-val" id="page-added-by"><?php echo getUsername($page_data['user_id']); ?></p>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="page-added-on">Added On:</label>&nbsp;<p class="view-screen-field-val" id="page-added-on"><?php echo $page_data['date_created']; ?></p>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="single-page-editor">Description *</label>
                                <textarea class="form-control"  name="description" id="single-page-editor" placeholder="Type your page description here..." rows="10" required><?php echo $page_data['description']; ?></textarea>
                                <span class="error_signup"><?php echo form_error('description'); ?></span>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update Page">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- page end-->
    </section>
</section>

<script type="application/javascript">
    $('#page-slug-edit').click(function(){
        var ctrl = $(this);
        var pageLinkCtrl = $('#page-link');
        var slugInputCtrl = $('#page-slug-val');

        var actionType = ctrl.attr('data-action-type');
        var slug_edit_data_cont = $('#slug-edit-disp');
        var newUrl = '';

        if(ctrl.attr('disabled') != 'disabled'){
            if(actionType == 'edit'){
                slugInputCtrl.show();
                slug_edit_data_cont.html('');
                ctrl.attr('data-action-type','save');
                ctrl.text('Save');

            } else if(actionType == 'save'){

                var actionUrl = '<?php echo base_url('admin/pages/change_page_slug') ?>';
                var newSlugVal = slugInputCtrl.val();
                var page_id = <?php echo $page_data['page_id']; ?>;

                slugInputCtrl.attr('disabled','disabled');
                ctrl.attr('disabled','disabled');
                ctrl.text('Updating...');

                $.ajax({
                    url:actionUrl,
                    type:'post',
                    data: {page_id:page_id,slug:newSlugVal},
                    success:function(response){
                        slugInputCtrl.hide();
                        slug_edit_data_cont.html(newSlugVal);
                        newUrl = '<?php echo base_url('pages') ?>'+'/'+slugInputCtrl.val();
                        pageLinkCtrl.attr('href',newUrl);
                        ctrl.attr('data-action-type','edit');
                        ctrl.text('Edit');
                        ctrl.removeAttr('disabled');
                        slugInputCtrl.removeAttr('disabled');
                    }
                });
            }
        }
    });
</script>