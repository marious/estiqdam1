$(document).on('click', '.upload', function() {
    $('#uploadModal').modal('show');
    var contractNumber = $(this).data('contract-number');
    $('#contract-number').val(contractNumber);
});