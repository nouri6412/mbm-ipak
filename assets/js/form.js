function ipak_hesab_model_form(model_name,nodel_id) {
    ipak_hesab_base_ajax({
        'action': 'ipak_hesab_model_form',
        'model_name':model_name,
        'model_id': model_id,
    }, function (result) {
        jQuery('.ipak-model-form .modal-body').html(result.html);
    });
}