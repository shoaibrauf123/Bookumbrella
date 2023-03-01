<div class="retailer-redirect-page">
    <div class="content">
        <img src="<?php echo base_url('assets/frontend/img') ?>/mega-loader.gif">
        <br>
        <h1 class="page-title">bookumbrella</h1>
        <p class="page-title-footer"><?php echo $footer_text_content ?></p>
    </div>
</div>

<script>
    $('document').ready(function(){
        var redirectUrl = '<?php echo $redirect_url; ?>';
        console.log("Redirection Url: "+redirectUrl);

        setTimeout(function(){
            location.replace(redirectUrl);
        },2000);
    });
</script>