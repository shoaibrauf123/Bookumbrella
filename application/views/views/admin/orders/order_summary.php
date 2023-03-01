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
                Order Summary
            </header>
            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>
                        <form action="" role="form" method="post">

                            <div class="form-group col-md-2">
                                <label for="title">Start Date</label>
                                <input type="text" class="form-control" id="start_date" onchange="filter_orders()"/>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="title">End Date</label>
                                <input type="text" class="form-control" id="end_date" onchange="filter_orders()"/>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="menu_label">Selers</label>
                                <select class="form-control" id="seller" onchange="filter_orders()">
                                        <option value="">Select seller</option>
                                        <?php 
                                        $sellers = $this->comman_model->get('user', array('user_type' => 'seller'));
                                        if($sellers){ foreach($sellers as $seller){ ?>
                                            <option value="<?php echo $seller['user_id']; ?>"><?php echo $seller['first_name']; ?></option>
                                        <?php } } ?>
                                </select>
                            </div>
                        </form>
                        <div class="form-group col-md-12">
                        <strong> Total Amount:</strong><?php echo ($results[0]['total_amount'] == '')? 0 : $results[0]['total_amount'];?><span></span> <br>
                        <strong> Total Shiping:</strong><span><?php echo ($results[0]['total_shiping'] == '')? 0 : $results[0]['total_shiping'];?></span> <br>
                        <strong> Total Commission:</strong><span><?php echo ($results[0]['total_commission'] == '')? 0 : $results[0]['total_commission'];?></span> <br>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>
<script type="application/javascript">
  $(document).ready(function(){
    $('#seller').val('<?php echo $this->input->get('seller'); ?>');
    $('#start_date').val('<?php echo $this->input->get('start_date'); ?>');
    $('#start_date').datepicker({});
    
    $('#end_date').val('<?php echo $this->input->get('end_date'); ?>');
    $('#end_date').datepicker({});

  });
    function filter_orders(obj){
        var query_str = '';
        if($('#start_date').val() != ''){
            query_str += '&start_date='+$('#start_date').val();
        }
        if($('#end_date').val() != ''){
            query_str += '&end_date='+$('#end_date').val();
        }
        if($('#seller').val() != ''){
            query_str += '&seller='+$('#seller').val();
        }
        if(query_str!=''){
          query_str = encodeURI('?'+query_str);  
        }
        
        window.location.href = '<?php echo base_url('admin/orders/summary'); ?>'+query_str;
    }   
</script>