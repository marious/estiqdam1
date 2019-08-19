//==========================================================
//  Create Invoice
//==========================================================
$("#saveInvoice").click(function ()  {

    $("#from-invoice").validate({
        excluded: ':disabled',
        rules: {

            customer_id: {
                required: true
            },
            invoice_date: {
                required: true
            },
            due_date: {
                required: true
            },
        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});