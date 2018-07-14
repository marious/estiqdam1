$(function() {

    load_contracts(false);

    function load_contracts(is_country, is_agent)
    {
        var dataTable = $('#not_arrived_table').DataTable({
            "processing":true,
            "serverSide":true,
            "pageLength": 20,
            "searching": false,
            "order":[],
            "ajax": {
                url: window.root + "reports/load_not_arrived",
                type: "POST",
                data: {is_country: is_country, is_agent: is_agent}
            },
            "columnDefs":[
                // { "width": "2%", "targets": 5},
                {
                    "targets":[0,1,2,3,4,5,6,7,8,9,10],
                    "orderable":false,
                },
            ],
        });
    }


    $(document).on('change', '#country', function() {
        var country = $(this).val();
        $('#not_arrived_table').DataTable().destroy();
        if (country != '') {
            load_contracts(country);
        } else {
            load_contracts();
        }
    });

    $(document).on('change', '#representative', function() {
        var representative = $(this).val();
        $('#agent').val('');
        $('#not_arrived_table').DataTable().destroy();
        if (representative != '') {
            load_contracts(representative);
        } else {
            load_contracts();
        }
    });

    $(document).on('change', '#agent', function() {
        var agent = $(this).val();
        $('#representative').val('');
        $('#not_arrived_table').DataTable().destroy();
        if (agent != '') {
            load_contracts(false, agent);
        } else {
            load_contracts();
        }
    });

});