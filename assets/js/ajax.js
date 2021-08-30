function ipak_hesab_base_ajax(data, callback) {
    console.log(ipak_hesab_object);
    data["page"]=ipak_hesab_object.page;
    console.log(data);
    jQuery.ajax({
        url: ipak_hesab_object.ajaxurl,
        data: data,
        dataType: 'json',
        type: 'POST',
        success: callback,
        beforeSend: function () {
            jQuery('.loading-ajax').show();
        },
        complete: function () {
            jQuery('.loading-ajax').hide();
        }
    });
}


function ipak_hesab_model_insert() {
    ipak_hesab_base_ajax({
        'action': 'ipak_hesab_model_insert',
        'test': 'hello test ajax'
    }, function (result) {
        console.log(result);
    });
}