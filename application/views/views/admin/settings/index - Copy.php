<?php foreach($settings_data as $setting){ ?>
    <div class="form-group ">
        <label for="field-<?php echo $setting['slug']; ?>" class="control-label col-lg-2"><?php echo ucwords($setting['title']); ?></label>
        <div class="col-lg-6">
            <input id="field-<?php echo $setting['slug']; ?>" class="form-control" name="<?php echo $setting['slug']; ?>" type="text" value="<?php echo $setting['value']; ?>"/>
        </div>
    </div>
<?php } ?>