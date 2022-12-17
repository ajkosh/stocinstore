$(document).ready(function () {
    $("#enable-store").click(function() {
    
        if($(this).is(":checked")) {
         $(".store-image").show(300);
        } else {
            $(".store-image").hide(200);
        }
    });

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
                    toastr["success"]('Form saved Successfully');
                    $.pjax.reload({container:'#store-index'});
                
                },
                error: function () {
                    toastr["error"]('Form did not save');
                
        
                }
        });
    
    }).on('submit', function(e){
    
        e.preventDefault();
    
    });
});