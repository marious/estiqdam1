$(function() {

    $('#accepted_table').on('click', '.accept-link', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        window.open(link, 'newwindow', 'width=700, height=500');
        console.log(link);
    });
    //
    // load_contracts(false);
    //
    // function load_contracts(is_representative, is_agent)
    // {
    //     var dataTable = $('#accepted_table').DataTable({
    //         "processing":true,
    //         "serverSide":true,
    //         "pageLength": 50,
    //         "searching": true,
    //         "order":[],
    //         "ajax": {
    //             url: window.root + "agent_worker/load_accepted_worker",
    //             type: "POST",
    //         },
    //         "columnDefs":[
    //             {
    //                 "targets":[0,1,2],
    //                 "orderable":false,
    //             },
    //         ],
    //     });
    // }


    $('#accepted-workers').editable({
        container: 'body',
        selector: 'td.stamping_date',
        url: window.root + 'agent_worker/update_processing_date',
        title: 'Stamp Date',
        type: 'POST',
        format: 'yyyy-mm-dd',
        viewformat: 'dd-mm-yyyy',
        datepicker: {
            weekStart: 1
        },
        // dataType: 'json',
    });

    $('#accepted-workers').editable({
        container: 'body',
        selector: 'td.arrived_date',
        url: window.root + 'agent_worker/update_processing_date',
        title: 'Arrived Date',
        type: 'POST',
        format: 'yyyy-mm-dd',
        viewformat: 'dd-mm-yyyy',
        datepicker: {
            weekStart: 1
        },
        // dataType: 'json',
    });



});