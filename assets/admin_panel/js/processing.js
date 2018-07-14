
$(document).on('click', '.upload', function() {
   $('#uploadModal').modal('show');
});


$('#contract_data').editable({
    container: 'body',
    selector: 'td.stamping_date',
    url: window.root + 'services_entry/update_processing_date',
    title: 'تاريخ التفييز',
    type: 'POST',
    format: 'yyyy-mm-dd',
    viewformat: 'dd-mm-yyyy',
    datepicker: {
        weekStart: 1
    },
    // dataType: 'json',

});

$('#contract_data').editable({
    container: 'body',
    selector: 'td.arrived_date',
    url: window.root + 'services_entry/update_processing_date',
    title: 'تاريخ الوصول',
    type: 'POST',
    format: 'yyyy-mm-dd',
    viewformat: 'dd-mm-yyyy',
    datepicker: {
        weekStart: 1
    },
    // dataType: 'json',
});


$('#contract_data').editable({
    container: 'body',
    selector: 'td.delegation_date',
    url: window.root + 'services_entry/update_processing_date',
    title: 'تاريخ التفويض',
    type: 'POST',
    format: 'yyyy-mm-dd',
    viewformat: 'dd-mm-yyyy',
    datepicker: {
        weekStart: 1
    },
    // dataType: 'json',

});
