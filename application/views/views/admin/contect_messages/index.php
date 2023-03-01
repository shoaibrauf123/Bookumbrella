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
                Manage Contect Messages
            </header>
            <?php $this->load->view('errors'); ?>
            <?php if($results){ $serial = 1; ?>
                <table class="table table-striped table-advance table-hover" >
                    <thead>
                        <tr>
                            <th class="col-xs-1 col-sm-1 col-md-1">Serial</th>
                            <th class="col-xs-2 col-sm-2 col-md-2">Email</th>
                            <th class="col-xs-2 col-sm-2 col-md-2">Subject</th>
                            <th class="col-xs-2 col-sm-2 col-md-4">Message</th>
							<th class="col-xs-1 col-sm-1 col-md-1">Replied</th>
                            <th class="col-xs-1 col-sm-1 col-md-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) { ?>
                            <tr>
                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $serial; ?></td>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $row['sender_email']; ?></td>
                                <td class="col-xs-2 col-sm-2 col-md-2"><?php echo $row['subject']; ?></td>
                                <td class="col-xs-2 col-sm-2 col-md-4"><?php echo $row['message']; ?></td>
								<td class="col-xs-1 col-sm-1 col-md-1"><?php echo ($row['reply'] == 0)? "<a href='javascript:void(0)' onclick='show_model(".$row['msg_id'].")'>Reply</a>" : "YES"; ?></td>
                                <td class="col-xs-1 col-sm-1 col-md-2">
                                   <?php echo $row['created_on']; ?> 
                                </td>
                            </tr>
                        <?php $serial++; } ?>
                    </tbody>
                </table>
                <?php echo $pagination; ?>
            <?php }else{
                adminRecordNotFoundMsg();
            } ?>
        </section>
    </section>
</section>

<!--start Modal -->
<div id="replyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reply</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('admin/contact_us_reply'); ?>" method="post">
                    <input type="hidden" name="messsage_id" id="messsage_id" value="">
					
                    <div class="clear20"></div>
                    <label>Subject</label>
                    <input type="text" placeholder="Subject" name="subject" class="form-control"
                           value="<?php echo set_value('subject'); ?>" required>


                    <div class="clear20"></div>
                    <label>Message</label>
                    <textarea name="message" cols="" placeholder="Message" class="form-control"
                              rows="6" required><?php echo set_value('message'); ?></textarea>
                    <br>
                    <input type="submit" class="btn btn-shadow btn-primary" value="Send">
                    
                </div>
                </form>
  
    </div>

  </div>
</div>
<!--end Modal -->

<script>
function show_model(id){
	$('#messsage_id').val(id);
	$('#replyModal').modal('show');
}
</script>