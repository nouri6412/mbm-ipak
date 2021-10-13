<div class="wrap ipak-main">
    <h2>تنظیمات</h2>
    <?php global $MBM_Ipak_Core;
    $MBM_Ipak_Core->print_alert(); ?>
<form action="<?php  echo esc_html(admin_url('admin.php')); ?>?page=ipak-hesab-setting" method="POST">

    <div class="form-check">
        <input class="form-check-input" type="checkbox" <?php if($this->_woo_transition == "1") echo 'checked="checked"'; ?> value="1" name="chk-woo-to-ipak-sanad" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            <?php  echo esc_html("پشتیبانی از تراکنش های افزونه ووکامرس"); ?>
        </label>
    </div>


<input type="submit" name="submit_model" value="ذخیره"/>
</form>
</div>