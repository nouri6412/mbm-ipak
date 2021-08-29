function ipak_hesab_model_form(model) {
    ipak_hesab_base_ajax({
        'action': 'ipak_hesab_model_form',
        'model': model
    }, function (result) {
        console.log(result);
    });
}