<div class="wrap ipak-main">
    <h2><?php  echo $this->model['label']; ?></h2>
<?php global $MBM_Ipak_Core; $MBM_Ipak_Core->print_alert(); ?>

    <button onclick="ipak_hesab_model_form('<?php echo $this->model['name']; ?>',0)" data-toggle="modal" data-target="#ipak-model-form" class="btn btn-primary"><span class="span-inside-btn"><?php echo ""." ".$this->model["label"]; ?></span><i class="fa fa-plus"></i></button>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <form method="post">
                        <?php
                        $this->model_obj->prepare_items();
                        $this->model_obj->display(); ?>
                    </form>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>
</div>