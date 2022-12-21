$(document).ready(function () {
    $('#store_form').on('beforeSubmit', function(e) {
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
           url: form.attr("action"),
           type: form.attr("method"),
           data: new FormData( this ),
           processData: false,
           contentType: false,
                success: function (response) {
                    if(response.status == 200) {
                        toastr["success"]('Form saved Successfully');
                        $.pjax.reload({container: '#storeForm'}).done(function () {
                           $.pjax.reload({container: '#store-index'});
                        });
         
                    } else {
                        console.log(response);
                        toastr["error"]('Form did not save');
                    }
                },
                error: function (response) {
                    console.log(response);

                    toastr["error"]('Error: Form did not save, Internal server error');
                }
        });
    
    }).on('submit', function(e){
    
        e.preventDefault();
    
    });
});