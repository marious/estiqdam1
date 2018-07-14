$(function() {

    load_contracts(false);

    function load_contracts(is_representative, is_agent)
    {
        var dataTable = $('#tickets-contracts').DataTable({
            "processing":true,
            "serverSide":true,
            "pageLength": 25,
            "searching": true,
            "order":[],
            "ajax": {
                url: window.root + "tickets/load_tickets_contracts",
                type: "POST",
                data: {is_representative: is_representative, is_agent: is_agent}
            },
            "columnDefs":[
                { "width": "10%", "targets": 5},
                {
                    "targets":[0,1,2,3,4,5,6,7,8,9],
                    "orderable":false,
                },
            ],
        });
    }


    $(document).on('change', '#representative', function() {
        var representative = $(this).val();
        var agent = $('#agent').val();
        $('#processing_table').DataTable().destroy();
        load_contracts(representative, agent);
    });

    $(document).on('change', '#agent', function() {
        var agent = $(this).val();
        var representative = $('#representative').val();
        $('#processing_table').DataTable().destroy();
        load_contracts(representative, agent);
    });

});