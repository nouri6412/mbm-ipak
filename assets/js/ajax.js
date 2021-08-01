function ipak_hesab_model_insert()
{
 jQuery.ajax( {
     url : ipak_hesab_object.ajaxurl,
     data : {
         'action' : 'ipak_hesab_model_insert',
         'test' :  'hello test ajax'
     },
     dataType : 'json',
     type : 'POST',
     success : function ( result )
     {
         console.log(result);	
     }
 } );
}