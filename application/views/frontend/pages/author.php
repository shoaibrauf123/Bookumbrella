<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>
    section.author_section {
    margin: 20px 0px;
    height:225px;
    }
    .col-md-3 {
        width: 20% !important;
    }
    .col-md-9 {
        width: 80% !important;
    }
    .author_section .athr_img{
        width:170px;
        height:170px;
        border-radius:3px;
        margin:15px 0px;
    }

    .author_detail h2{
        font-weight:600;
        color:#000;
    }
    @media (max-width: 992px){
    
    .col-md-2 {
        width: 100% !important;
    }
    .col-md-10 {
        width: 100% !important;
    }

    }

   

    
</style>

<div class="row mt-2">
    <div class="col-md-2 pull-right">
        <form action="<?php  echo base_url().'author' ?>" method="get" id="sorting">
            <select class="form-control" onchange="$('#sorting').submit();" name="sort_by">
                <option value="1" <?php echo ($this->input->get("sort_by") == 1) ? "selected" : FALSE ?>>Sort BY (A - Z)</option>
                <option value="0" <?php echo ($this->input->get("sort_by") == 0) ? "selected" : FALSE ?>>Sort BY (Z - A)</option>
            </select>
        </form>  
    </div>
</div>

<?php //echo "<pre>";print_r($author);die; ?>

<?php 
    if(!empty($author)){ 
        foreach($author as $auth){
            if($auth->featured == 1){
?>  
                <section class="author_section">
                    
                    <div class="col-md-2">
                        <figure>
                           <a href="products?search=<?php echo $auth->author_name; ?>&cat=keyword"><img class="athr_img" width="80px" src="<?php echo base_url("uploads/author_gallery/".$auth->image) ?>" alt="Not Found"></a>
                        </figure>
                    </div>
                    <div class="col-md-10">
                      <div class="author_detail">
                        <h2><?php echo $auth->author_name ?></h2>
                        <p class="sec_details">
                            <?php echo $auth->description; ?>
                        </p>
                     </div>
                    </div>
                    
                </section>
<?php       }
        }

    } 
?>
<script>



    /*var author_sorting = document.getElementById('sorting');
    if(author_sorting != null){
        author_sorting.addEventListener("click",function(){
            $.ajax({
                method : "POST",
                url : "<?php  echo base_url().'sort_record' ?>",
                data: {"dropdown_record" : author_sorting.value},
                success : function (data){
                    console.log(data);
                }
            });

        });
    }   */

</script>
