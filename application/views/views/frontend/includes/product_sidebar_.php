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
    }
	
	
	.level-2 span
	{
		padding-left:5px;
	}
	.cat_active
	{
		padding-left:5px;
	}
.cd-accordion-menu ul label, .cd-accordion-menu ul a
{
	background:#fff !important;
}
.innoCustomScrollBar {
    background-color: #fff !important;
}
.country
{
	margin-bottom:10px;
	margin-top:10px;
	width:100%;
}
.cd-accordion-menu-cont .section-title
{
	background:#00489a !important;
}
#mCSB_1_container span {
    padding-left: 5px;
}
.rateit-range {
    margin-left: 5px;
}


</style>
<!-- search sidebar start here -->
<div class="cd-accordion-menu-cont">
    <ul class="cd-accordion-menu animated">
<?php /*
        <li class="has-children">
            <input type="checkbox" <?php echo ($this->input->get('cat')) ? 'checked=""' : ''; ?> id="categories">
            <label class="section-title" for="categories">CATEGORIES</label>
           <?php if ($main_category) { ?>
                <ul class="level-1 scroll innoCustomScrollBar">
                    <?php
                    $parent4 = $parent3 = $parent2 = $parent1 = false;
                    $parent1 = $this->comman_model->get('category', array('category_id' => ($this->input->get('cat') / 999)));
                    if ($parent1[0]['parent_id'] > 0) {
                        $parent2 = $parent1;
                        $parent1 = $this->comman_model->get('category', array('category_id' => $parent1[0]['parent_id']));
                    }
                    if ($parent1[0]['parent_id'] > 0) {
                        $parent3 = $parent2;
                        $parent2 = $parent1;
                        $parent1 = $this->comman_model->get('category', array('category_id' => $parent2[0]['parent_id']));
                    }
                    if ($parent1[0]['parent_id'] > 0) {
                        $parent4 = $parent3;
                        $parent3 = $parent2;
                        $parent2 = $parent1;
                        $parent1 = $this->comman_model->get('category', array('category_id' => $parent2[0]['parent_id']));
                    }

                    // print_r($parent1[0]['category_id']);
                    foreach ($main_category as $key => $value) {

                        $sub_cats = false;
                        if ($parent1 && $parent1[0]['category_id'] == $value['category_id']) {
                            $sub_cats = $this->comman_model->get('category', array('parent_id' => $value['category_id'], 'status' => 1));
                        }

                        if ($sub_cats) { ?>
                            <li class="has-children">
                                <input type="checkbox" id="cat-group-<?php echo $value['category_id']; ?>">
                                <label onclick="set_cat(<?php echo $value['category_id'] * 999; ?>);"
                                       for="cat-group-<?php echo $value['category_id']; ?>"><span <?php echo ($value['category_id'] == ($this->input->get('cat') / 999)) ? 'class="cat_active"' : ''; ?>><?php echo $value['title']; ?> </span><?php echo ($parent1[0]['category_id'] == $value['category_id']) ? '<i class="fa fa-circle pull-right"></i>' : ''; ?>
                                </label>
                                <ul class="level-2" <?php echo ($parent1[0]['category_id'] == $value['category_id']) ? 'style="display:block;"' : ''; ?>>
                                    <?php foreach ($sub_cats as $s_cat) {
                                        $third_level_cats = false;
                                        if ($parent2 && $parent2[0]['category_id'] == $s_cat['category_id']) {
                                            $third_level_cats = $this->comman_model->get('category', array('parent_id' => $s_cat['category_id'], 'status' => 1));
                                        }
                                        //$third_level_cats = $this->comman_model->get('category',array('parent_id'=>$s_cat['category_id']));
                                        if ($third_level_cats) { ?>
                                            <li class="has-children">
                                                <input type="checkbox"
                                                       id="cat-group-<?php echo $s_cat['category_id']; ?>">
                                                <label onclick="set_cat(<?php echo $s_cat['category_id'] * 999; ?>);"
                                                       for="cat-group-<?php echo $s_cat['category_id']; ?>"><span <?php echo ($s_cat['category_id'] == ($this->input->get('cat') / 999)) ? 'class="cat_active"' : ''; ?>><?php echo $s_cat['title']; ?></span></label>
                                                <ul class="level-3" <?php echo ($parent2[0]['category_id'] == $s_cat['category_id']) ? 'style="display:block;"' : ''; ?>>
                                                    <?php foreach ($third_level_cats as $third_level_cat) {
                                                        $forth_level_cats = false;
                                                        if ($parent3 && $parent3[0]['category_id'] == $third_level_cat['category_id']) {
                                                            $forth_level_cats = $this->comman_model->get('category', array('parent_id' => $third_level_cat['category_id'], 'status' => 1));
                                                        }
                                                        if ($forth_level_cats) { ?>
                                                            <li class="has-children">
                                                                <input type="checkbox"
                                                                       id="cat-group-<?php echo $third_level_cat['category_id']; ?>">
                                                                <label
                                                                    onclick="set_cat(<?php echo $third_level_cat['category_id'] * 999; ?>);"
                                                                    for="cat-group-<?php echo $third_level_cat['category_id']; ?>"><span <?php echo ($third_level_cat['category_id'] == ($this->input->get('cat') / 999)) ? 'class="cat_active"' : ''; ?>><?php echo $third_level_cat['title']; ?></span></label>
                                                                <ul class="level-4" <?php echo ($parent3[0]['category_id'] == $third_level_cat['category_id']) ? 'style="display:block;"' : ''; ?>>
                                                                    <?php foreach ($forth_level_cats as $forth_level_cat) { ?>
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               onclick="set_cat(<?php echo $forth_level_cat['category_id'] * 999; ?>);"><span <?php echo ($forth_level_cat['category_id'] == ($this->input->get('cat') / 999)) ? 'class="cat_active"' : ''; ?>><?php echo $forth_level_cat['title']; ?></span></a>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </li>
                                                        <?php } else { ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                   onclick="set_cat(<?php echo $third_level_cat['category_id'] * 999; ?>);"><span <?php echo ($third_level_cat['category_id'] == ($this->input->get('cat') / 999)) ? 'class="cat_active"' : ''; ?>><?php echo $third_level_cat['title']; ?></span></a>
                                                            </li>
                                                        <?php }
                                                        ?>

                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } else { ?>
                                            <li>
                                                <a href="javascript:void(0)"
                                                   onclick="set_cat(<?php echo $s_cat['category_id'] * 999; ?>);"><span <?php echo ($s_cat['category_id'] == ($this->input->get('cat') / 999)) ? 'class="cat_active"' : ''; ?>><?php echo $s_cat['title']; ?></span></a>
                                            </li>
                                        <?php }
                                        ?>

                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="has-children">
                                <label
                                    onclick="set_cat(<?php echo $value['category_id']; ?>);"><span <?php echo ($value['category_id'] == ($this->input->get('cat'))) ? 'class="cat_active"' : ''; ?>><?php echo $value['title']; ?> </span><?php echo (($this->input->get('cat') ) == $value['category_id']) ? '<i class="fa fa-circle pull-right"></i>' : ''; ?>
                                </label>

                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            <?php } ?>
        </li><!--CATEGORIES END-->
< */ ?>
        <li class="has-children">
        <?php
            $condition_array = array();
            if($this->input->get('condition'))
                $condition_array = explode(',', $this->input->get('condition'));
        ?>
            <input type="checkbox" class="menu-label" checked="checked" <?php //echo ($condition_array) ? 'checked="checked"' : ''; ?> id="brands">
            <label class="section-title">CONDITION</label>
            
                <ul class="scroll innoCustomScrollBar">
             
                    <li><a href="javascript:void(0)" onclick="filter_condition(this)"><input type="checkbox" class="f_condition" value="New" type="checkbox" <?php echo (in_array('New', $condition_array))? 'checked="chacked"' : ''; ?> /><span <?php echo (in_array('New', $condition_array)) ? 'class="cat_active"' : ''; ?>>New</span> </a></li>
                    <!-- <li><a href="javascript:void(0)" onclick="filter_condition('Used')"><input type="checkbox" <?php //echo ('Used' == ($this->input->get('condition'))) ? 'checked="chacked"' : ''; ?> /><span <?php //echo ('Used' == ($this->input->get('condition'))) ? 'class="cat_active"' : ''; ?>> <?php //echo 'Used' ?></span> </a></li> -->
                    <li>
                        <a><input type="checkbox" <?php echo (in_array($this->input->get('condition'), array('Like New', 'Very Good', 'Good', 'Acceptable'))) ? 'checked="chacked"' : ''; ?>><span <?php echo ('Used' == ($this->input->get('condition'))) ? 'class="cat_active"' : ''; ?> style="padding-left:3px;">Used</span></a>
                        <ul class="level-2" style="display:block;">
                            <li><a href="javascript:void(0)" onclick="filter_condition(this)"><input type="checkbox" class="f_condition" value="Like New" type="checkbox" <?php echo (in_array('Like New', $condition_array))? 'checked="chacked"' : ''; ?> /><span <?php echo ('Like New' == ($this->input->get('condition'))) ? 'class="cat_active"' : ''; ?>>Like New</span> </a></li>
                            <li><a href="javascript:void(0)" onclick="filter_condition(this)"><input type="checkbox" class="f_condition" value="Very Good" type="checkbox" <?php echo (in_array('Very Good', $condition_array))? 'checked="chacked"' : ''; ?> /><span <?php echo ('Very Good' == ($this->input->get('condition'))) ? 'class="cat_active"' : ''; ?>>Very Good</span> </a></li>
                            <li><a href="javascript:void(0)" onclick="filter_condition(this)"><input type="checkbox" class="f_condition" value="Good" type="checkbox" <?php echo (in_array('Good', $condition_array))? 'checked="chacked"' : ''; ?> /><span <?php echo ('Good' == ($this->input->get('condition'))) ? 'class="cat_active"' : ''; ?>>Good</span> </a></li>
                            <li><a href="javascript:void(0)" onclick="filter_condition(this)"><input type="checkbox" class="f_condition" value="Acceptable" type="checkbox" <?php echo (in_array('Acceptable', $condition_array))? 'checked="chacked"' : ''; ?> /><span <?php echo ('Acceptable' == ($this->input->get('condition'))) ? 'class="cat_active"' : ''; ?>>Acceptable</span> </a></li>
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
                    <li><a href="javascript:void(0)" onclick="filter_type(this)"><input class="f_type" value="Normal" type="checkbox" <?php echo (in_array('Normal', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo ('Normal' == ($this->input->get('type'))) ? 'class="cat_active"' : ''; ?>> <?php echo 'Normal' ?> </a></li>
                    <li><a href="javascript:void(0)" onclick="filter_type(this)"><input class="f_type" value="Internation Edition" type="checkbox" <?php echo (in_array('Internation Edition', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo ('Internation Edition' == ($this->input->get('type'))) ? 'class="cat_active"' : ''; ?>> <?php echo 'Internation Edition' ?></span> </a></li>
                    <li><a href="javascript:void(0)" onclick="filter_type(this)"><input class="f_type" value="Teachers Edition" type="checkbox" <?php echo (in_array('Teachers Edition', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo ('Teachers Edition' == ($this->input->get('type'))) ? 'class="cat_active"' : ''; ?>> <?php echo 'Teachers Edition' ?></span> </a></li>
                    <li><a href="javascript:void(0)" onclick="filter_type(this)"><input class="f_type" value="Study Guide" type="checkbox" <?php echo (in_array('Study Guide', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo ('Study Guide' == ($this->input->get('type'))) ? 'class="cat_active"' : ''; ?>> <?php echo 'Study Guide' ?></span> </a></li>
                    <li><a href="javascript:void(0)" onclick="filter_type(this)"><input class="f_type" value="Work Book" type="checkbox" <?php echo (in_array('Work Book', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo ('Work Book' == ($this->input->get('type'))) ? 'class="cat_active"' : ''; ?>> <?php echo 'Work Book' ?></span> </a></li>
                    <li><a href="javascript:void(0)" onclick="filter_type(this)"><input class="f_type" value="Library Copy" type="checkbox" <?php echo (in_array('Library Copy', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo ('Library Copy' == ($this->input->get('type'))) ? 'class="cat_active"' : ''; ?>> <?php echo 'Library Copy' ?></span> </a></li>    
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
                 
                <select onchange="filter_country(this.value)" class="country">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country) {
                        echo '<option value="'.$country['country'].'">'.$country['country'].'</option>';
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
                <label class="section-title" >Rating</label>
            
                <ul class="scroll innoCustomScrollBar">
                    <li><a href="javascript:void(0)" onclick="filter_rating(this)"> <input class="f_rating" value="1" type="checkbox" <?php echo (in_array(1, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="1"></span> </a></li>
                    <li><a href="javascript:void(0)" onclick="filter_rating(this)"> <input class="f_rating" value="2" type="checkbox" <?php echo (in_array(2, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="2"></span> </a></li>
                    <li><a href="javascript:void(0)" onclick="filter_rating(this)"> <input class="f_rating" value="3" type="checkbox" <?php echo (in_array(3, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="3"></span> </a></li>
                    <li><a href="javascript:void(0)" onclick="filter_rating(this)"> <input class="f_rating" value="4" type="checkbox" <?php echo (in_array(4, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="4"></span> </a></li>
                    <li><a href="javascript:void(0)" onclick="filter_rating(this)"> <input class="f_rating" value="5" type="checkbox" <?php echo (in_array(5, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="5"></span> </a></li>     
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