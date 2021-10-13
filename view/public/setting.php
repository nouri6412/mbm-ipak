<div class="wrap ipak-main">
    <h2>تنظیمات</h2>
    <?php global $MBM_Ipak_Core;
    $MBM_Ipak_Core->print_alert(); ?>
<form action="<?php  echo esc_html(admin_url('admin.php')); ?>?page=ipak-hesab-setting" method="POST">

<input type="submit" name="submit_model" value="ذخیره"/>
</form>
</div>