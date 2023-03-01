<style>
    .level-1 li > label {
        padding-left: 15px !important;
    }

    .level-1 li a {
        padding-left: 15px !important;
    }

    .level-2 li > label {
        padding-left: 25px !important;
    }

    .level-2 li a {
        padding-left: 25px !important;
    }

    .level-3 li > label {
        padding-left: 35px !important;
    }

    .level-3 li a {
        padding-left: 35px !important;
    }

    .level-4 li > label {
        padding-left: 45px !important;
    }

    .level-4 li a {
        padding-left: 45px !important;
    }

    .fa-circle::before {
        content: "";
        font-size: 8px;
    }

    .cat_active {
        font-weight: 700;
        font-style: italic;
        /*font-size: 15px;*/
		margin-right:5px !important;
    }
    .f_condition
	{
		margin-right:5px !important;
	}
	.rateit-range-2
	{
		margin-left:5px !important;
	}

    li.has-children {
    border: 2px solid #e6e6e6;
    font-size: 15px;
    margin-bottom: 40px;
    background: #fff;
    padding: 10px 25px 15px;
}
#mCSB_2_container li{
    padding:3px 0px;
}
#mCSB_2_container li span{
font-family: Helvetica !important;
}

#mCSB_1_container li span{
font-family: Helvetica !important;  
}
.cd-accordion-menu-cont .section-title {
    font-family: "Libre Baskerville" !important;
    background: #fff !important;
    color: #000;
    margin-top: 2px;
    padding: 10px 0;
    margin: 0 0 13px;
    font-size: 20px;
    /* padding-top: 6px !important; */
    /* border-top: 1px solid #666 !important; */

}
.cd-accordion-menu-cont .section-title::before{
    content: "";
    width: 50px;
    height: 3px;
    top: 97%;
    left: 0px;
    background: #000;
    position: absolute;
}

.section-title li span{
    font-family:"roboto" !important;
}



</style>
<!-- search sidebar start here -->
<div class="cd-accordion-menu-cont">
    <ul class="cd-accordion-menu animated">

        <li class="has-children">
        <?php
		
            $condition_array = array();
            if($this->input->get('condition'))
                $condition_array = explode(',', $this->input->get('condition'));
        ?>
            <input type="checkbox" class="menu-label" checked="checked" <?php //echo ($condition_array) ? 'checked="checked"' : ''; ?> id="brands">
            <label class="section-title" style="border-top: 1px solid #666 !important;">Condition</label>
            
                <ul class="scroll innoCustomScrollBar">
                    <li ><span  ><input onclick="filter_condition(this)" type="checkbox" class="f_condition" value="New" id="New" type="checkbox" <?php echo (in_array('New', $condition_array))? 'checked="checked"' : ''; ?> />
                            <span <?php echo (in_array('New', $condition_array)) ? 'class="cat_active"' : ''; ?>>New</span>
                            </a></li>
                    <!-- <li><a href="javascript:void(0)" onclick="filter_condition('Used')"><input type="checkbox" <?php //echo ('Used' == ($this->input->get('condition'))) ? 'checked="chacked"' : ''; ?> /><span <?php //echo ('Used' == ($this->input->get('condition'))) ? 'class="cat_active"' : ''; ?>> <?php //echo 'Used' ?></span> </a></li> -->
                    <li>
                        <span ><input onclick="filter_condition(this)" class="f_condition" type="checkbox" <?php echo (in_array('Used', $condition_array))? 'checked="checked"' : ''; ?> id="Used" value="Used"><span <?php echo (in_array('Used', $condition_array)) ? 'class="cat_active"' : ''; ?> style="padding-left:3px;">Used</span></span>
                        <ul class="level-2" style="display:block;">
                            <li><span  ><input type="checkbox" onclick="filter_condition(this)" class="f_condition"  id="Like New" value="Like New" type="checkbox" <?php echo (in_array('Like New', $condition_array))? 'checked="checked"' : ''; ?> /><span <?php echo (in_array('Like New', $condition_array)) ? 'class="cat_active"' : ''; ?>>Like New</span> </span></li>
                            <li><span ><input onclick="filter_condition(this)" type="checkbox" class="f_condition" id="Very Good" value="Very Good" type="checkbox" <?php echo (in_array('Very Good', $condition_array))? 'checked="checked"' : ''; ?> /><span <?php echo (in_array('Very Good', $condition_array)) ? 'class="cat_active"' : ''; ?>>Very Good</span> </span></li>
                            <li><span ><input type="checkbox" onclick="filter_condition(this)" class="f_condition" id="Good"   value="Good" type="checkbox" <?php echo (in_array('Good', $condition_array))? 'checked="checked"' : ''; ?> /><span <?php echo (in_array('Good', $condition_array)) ? 'class="cat_active"' : ''; ?>>Good</span> </span></li>
                            <li><span  ><input onclick="filter_condition(this)" type="checkbox" class="f_condition" value="Acceptable"  value="Acceptable" type="checkbox" <?php echo (in_array('Acceptable', $condition_array))? 'checked="checked"' : ''; ?> /><span <?php echo (in_array('Acceptable', $condition_array)) ? 'class="cat_active"' : ''; ?>>Acceptable</span> </span></li>
                        </ul>
                    </li>
                    
                </ul>
            
        </li><!--CONDITION END-->

        <li class="has-children">
            <?php
                    $type_array = array();
                    if($this->input->get('type'))
                        $type_array = explode(',', $this->input->get('type'));
                ?>
            <input class="menu-label"
                type="checkbox" checked="checked" <?php //echo ($type_array) ? 'checked="checked"' : ''; ?>
                id="f-type">
            <label class="section-title">TYPE</label>
                <ul class="scroll innoCustomScrollBar">
                    <li><span  ><input onclick="filter_type(this)" class="f_type" value="Normal" type="checkbox" <?php echo (in_array('Normal', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo (in_array('Normal', $condition_array)) ? 'class="cat_active"' : ''; ?>> <?php echo 'Normal' ?> </span></li>
                    <li><span ><input onclick="filter_type(this)" class="f_type" value="Internation Edition" type="checkbox" <?php echo (in_array('Internation Edition', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo (in_array('Internation Edition', $condition_array)) ? 'class="cat_active"' : ''; ?>> <?php echo 'Internation Edition' ?></span> </span></li>
                    <li><span ><input  onclick="filter_type(this)" class="f_type" value="Teachers Edition" type="checkbox" <?php echo (in_array('Teachers Edition', $type_array)) ? 'checked="checked"' : ''; ?>><span <?php echo (in_array('Teachers Edition', $condition_array)) ? 'class="cat_active"' : ''; ?>> <?php echo 'Teachers Edition' ?></span> </span></li>
                    <li><span  ><input onclick="filter_type(this)" class="f_type" value="Study Guide" type="checkbox" <?php echo (in_array('Study Guide', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo (in_array('Study Guide', $condition_array)) ? 'class="cat_active"' : ''; ?>> <?php echo 'Study Guide' ?></span> </span></li>
                    <li><span  ><input onclick="filter_type(this)" class="f_type" value="Work Book" type="checkbox" <?php echo (in_array('Work Book', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo (in_array('Work Book', $condition_array)) ? 'class="cat_active"' : ''; ?>> <?php echo 'Work Book' ?></span> </span></li>
                    <li><span ><input onclick="filter_type(this)" class="f_type" value="Library Copy" type="checkbox" <?php echo (in_array('Library Copy', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo (in_array('Library Copy', $condition_array)) ? 'class="cat_active"' : ''; ?>> <?php echo 'Library Copy' ?></span> </span></li>    
                </ul>
            
        </li><!--TYPE END-->
        <?php
            if($this->uri->segment(1) == 'product' && $this->uri->segment(2) == 'detail'){ 
               $countries = getSellersCountries($this->uri->segment(3));
               if($countries){
            ?>
            <li class="has-children">
            <input class="menu-label" type="checkbox" checked="checked" id="f-country">
                <label class="section-title">Country</label>
                 
                <select onchange="filter_country(this.value)" class="country form-control" style="font-weight:bold; margin-top:10px;">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country) {
                        if($country['country']!=''){
                            echo '<option value="'.$country['country'].'">'.$country['country'].'</option>';
                        }

                    } ?>
                </select>
            
            </li><!--Country END-->

        <?php  } ?>
        <li class="has-children">
            <?php
                    $rating_array = array();
                    if($this->input->get('srating'))
                        $rating_array = explode(',', $this->input->get('srating'));
                ?>
            <input type="checkbox" class="menu-label" checked="checked" <?php //echo ($rating_array) ? 'checked=""' : ''; ?> id="f-rating">
                <label class="section-title" style="border-bottom:solid 1px #666; margin-bottom:20px; padding-bottom:6px;">Rating</label>
            
                <ul class="scroll innoCustomScrollBar">
                    <li><span  > <input onclick="filter_rating(this)" class="f_rating" value="1" type="checkbox" <?php echo (in_array(1, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="1"></span> </span></li>
                    <li><span > <input onclick="filter_rating(this)" class="f_rating" value="2" type="checkbox" <?php echo (in_array(2, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="2"></span> </span></li>
                    <li><span > <input onclick="filter_rating(this)" class="f_rating" value="3" type="checkbox" <?php echo (in_array(3, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="3"></span> </span></li>
                    <li><span > <input onclick="filter_rating(this)" class="f_rating" value="4" type="checkbox" <?php echo (in_array(4, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="4"></span> </span></li>
                    <li><span > <input onclick="filter_rating(this)" 	class="f_rating" value="5" type="checkbox" <?php echo (in_array(5, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="5"></span> </span></li>     
                </ul>
            
        </li><!--Country END-->

<?php    }
?>



       
    </ul>
    <div class="clearfix"></div>
</div>
<!--End search sidebar here -->

<script type="text/javascript" charset="utf-8">
    $(function () {
        $('.country').val('<?php echo $this->input->get('country'); ?>');
        $("#slider-3").slider({
            range: true,
            min: <?php echo round($price_range[0]['min_price'], 0, PHP_ROUND_HALF_DOWN);?>,
            max: <?php echo round($price_range[0]['max_price'], 0, PHP_ROUND_HALF_DOWN);?>,
            values: [<?php echo $min_price;?>, <?php echo $max_price;?>],

            slide: function (event, ui) {
                $(".ui-slider").val(ui.values[0] + "," + ui.values[1]);
                $("#min_price").html("$" + ui.values[0]);
                $("#max_price").html("$" + ui.values[1]);

            },
            change: function (event, ui) {
                setTimeout(function () {
                    $("#frm_filter").submit();
                }, 1000);
            }
        });
        
        $( "#slider" ).slider({
            range: "max",
            min: 0,
            max: 70,
            value: 0,
            slide: function (event, ui) {
               //$( "#amount" ).val( ui.value );
            }
        });

        $('.rateit_filter').rateit({
            step: 1,
            readonly:true,
            resetable:false
        });
    });
</script>