<?php $this->model_obj->prepare_items(); ?>
<div class="wrap ipak-main">
    <h2><?php echo $this->model['label']; ?></h2>
    <?php global $MBM_Ipak_Core;
    $MBM_Ipak_Core->print_alert(); ?>

    <div class="table-header">
        <div>
            <?php
            if (!isset($this->model["is_report"])) {
            ?>
                <button onclick="ipak_hesab_model_form('<?php echo esc_attr($this->model['name']); ?>',0)" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ipak-model-form">
                <span class="span-inside-btn "><?php echo esc_attr($this->model["label"]) ; ?></span><i class="fa fa-plus"></i></button>
            <?php } ?>
        </div>
        
        <form action="?page=<?php echo !empty($_REQUEST["page"])?esc_attr(sanitize_text_field($_REQUEST["page"])) : ''; ?>" method="post" class="form-search-table">
            <input value="<?php echo !empty($_REQUEST["page"])?esc_attr(get_option(sanitize_text_field($_REQUEST["page"]). "_search")) : ''; ?>" id="search-main-table" name="search-main-table" class="form-control" placeholder="جستجو.." />
            <input class="btn btn-primary" type="submit" value="بگرد" />
        </form>
    </div>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <form method="post">
                        <?php
                        $this->model_obj->display(); ?>
                    </form>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>
    <a class="btn btn-primary" href="?page=<?php echo !empty($_REQUEST["page"])?esc_attr(sanitize_text_field($_REQUEST["page"])) : ''; ?>&export_model=1">خروجی CSV</a>

</div>