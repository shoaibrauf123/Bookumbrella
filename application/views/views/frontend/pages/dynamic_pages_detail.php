<style>
.page-content
{
	padding-left:30px !important;
	padding-right:30px !important;
}


</style>

<div class="clear20"></div>
<div class="menu-space-top cms-page margin-bottom-20">
    <div class="page-head">
        <h2 class="section-heading"><?php echo $result[0]['title']; ?></h2>
        <hr class="thick">
    </div>
    <div class="page-content container margin-top-20">
        <?php if ($this->session->flashdata('errors')) { ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('errors'); ?> </div>
        <?php } ?>
        <?php echo $result[0]['description']; ?>
    </div>
</div>