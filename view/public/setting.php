<div class="wrap ipak-main">
    <h2>تنظیمات</h2>
    <?php global $MBM_Ipak_Core;  
    $countPerPage = $this->get_setting("_CountPerPage") ;
    $MBM_Ipak_Core->print_alert(); ?>
    <form action="<?php echo esc_html(admin_url('admin.php')); ?>?page=ipak-hesab-setting" method="POST">


        <div class="col-auto my-1">
            <label class="mr-sm-2" for="idCountPerPage">تعداد در صفحه</label>
            <select class="custom-select mr-sm-2" id="idCountPerPage" name="_CountPerPage">
                <option <?php if ($countPerPage == 10 ) echo 'selected="selected"'; ?> >10</option>
                <option <?php if ($countPerPage == 20 ) echo 'selected="selected"'; ?> >20</option>
                <option <?php if ($countPerPage == 40 ) echo 'selected="selected"'; ?> >40</option>
                <option <?php if ($countPerPage == 60 ) echo 'selected="selected"'; ?> >60</option>
                <option <?php if ($countPerPage == 80 ) echo 'selected="selected"'; ?> >80</option>
                <option <?php if ($countPerPage == 100 ) echo 'selected="selected"'; ?> >100</option>
            </select>
        </div>
        <hr />
        <div class="form-check">
            <input class="form-check-input" type="checkbox" <?php if ($this->get_setting("_woo_transition") == 1) echo 'checked="checked"'; ?> value="1" name="_woo_transition" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                <?php echo esc_html("پشتیبانی از تراکنش های افزونه ووکامرس"); ?>
            </label>
        </div>
        <hr />

        <input type="submit" name="submit_model" value="ذخیره" />
    </form>
</div>