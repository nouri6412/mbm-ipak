function ipak_hesab_model_form(model) {
    ipak_hesab_base_ajax({
        'action': 'ipak_hesab_model_form',
        'model_name': model.model_name,
        'model_id': model.model_id,
    }, function (result) {
        jQuery('.ipak-model-form .modal-body').html(result.html);
    });
}