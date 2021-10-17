<div class="wrap ipak-main">
    <div class="row">
        <div class="col">
            <div style="background:#2c9eef;" class="mbm-ipak-tile">
                <h3>موجودی بانک</h3>
                <hr>
                <p><?php echo esc_html($this->ViewData["bank"]); ?></p>
                <i class="fa fa-bank"></i>
            </div>
        </div>
        <div class="col">
            <div style="background:#ef2c2c;" class="mbm-ipak-tile">
                <h3>هزینه</h3>
                <hr>
                <p><?php echo esc_html($this->ViewData["cost"]); ?></p>
                <i class="fa fa-user"></i>
            </div>
        </div>
        <div class="col">
            <div style="background:#efaa2c;" class="mbm-ipak-tile">
                <h3>درآمد</h3>
                <hr>
                <p><?php echo esc_html($this->ViewData["income"]); ?></p>
                <i class="fa fa-user"></i>
            </div>
        </div>
        <div class="col">
            <div style="background:#bf54f5;" class="mbm-ipak-tile">
                <h3>سودوزیان</h3>
                <hr>
                <p><?php echo esc_html($this->ViewData["sod"]); ?></p>
                <i class="fa fa-bar-chart"></i>
            </div>
        </div>
    </div>

    <hr>
    <div class="panel panel-primary">
        <div class="panel-heading">
            راهنمایی
        </div>
        <div >
            بدهکار یعنی مبلغی که دیگران به شما بدهکار هستند
        </div>
        <div >
            طلبکار یعنی مبلغی که دیگران از شما طلبکار هستند
        </div>
    </div>

</div>