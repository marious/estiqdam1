$('#accepted_table').editable({
    container: 'body',
    selector: 'td.contract_received_date',
    url: window.root + 'agent_worker/update_worker_editable_data',
    title: 'Contract Received Date',
    type: 'POST',
    format: 'yyyy-mm-dd',
    viewformat: 'd-M-yy',
    datepicker: {
        weekStart: 1
    },
    // dataType: 'json',
});

$('#accepted_table').editable({
    container: 'body',
    selector: 'td.biometric_date',
    url: window.root + 'agent_worker/update_worker_editable_data',
    title: 'Biometric Date',
    type: 'POST',
    format: 'yyyy-mm-dd',
    viewformat: 'd-M-yy',
    datepicker: {
        weekStart: 1
    },
    // dataType: 'json',
});

$('#accepted_table').editable({
    container: 'body',
    selector: 'td.memo',
    url: window.root + 'agent_worker/update_worker_editable_data',
    title: 'MEMO',
    type: 'POST',
    // dataType: 'json',
});
