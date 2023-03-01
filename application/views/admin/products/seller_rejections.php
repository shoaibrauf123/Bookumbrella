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
                Seller failed uploaded books
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th class="col-xs-1 col-sm-1 col-md-2">Seller</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Action</th>
                            <th class="col-xs-4 col-sm-4 col-md-4">ISBN</th>
                            <th class="col-xs-1 col-sm-1 col-md-1">Sku</th>
                            <th class="col-xs-4 col-sm-2 col-md-2">Stutus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) {  ?>
                            <tr>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php 
								$seller = $this->comman_model->get("user",array('user_id'=>$row['seller_id']));
								if($seller)
								echo $seller[0]['first_name']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['seller_action_type']; ?></td>
                                <td class="col-xs-4 col-sm-4 col-md-4"><?php echo $row['isbn']; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-1">
                                    
									<?php echo $row['sku']; ?>
                                </td>
                                <td class="col-xs-4 col-sm-2 col-md-2">
                                     <?php if ($row['status'] == 1) { ?>
                                        <span class="btn btn-success btn-xs cursor_default" title="Actived"><i class="fa fa-check"></i></span>
                                    <?php } else { ?>
                                        <span class="btn btn-danger btn-xs cursor_default" title="Deactived"><i class="fa fa-ban"></i></span>
                                    <?php } ?>
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