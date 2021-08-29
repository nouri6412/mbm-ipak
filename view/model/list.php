<div class="wrap">
    <h2><?php  echo $title_page; ?></h2>
    <button onclick="ipak_hesab_model_form({'model_name':'<?php echo 'bank'; ?>','model_id':'0'})" data-toggle="modal" data-target="#ipak-model-form" class="btn btn-primary"><span class="span-inside-btn"><?php echo "ایجاد"." ".$this->model["label"]; ?></span><i class="fa fa-plus"></i></button>

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