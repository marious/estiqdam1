$(function() {

    load_contracts();

    function load_contracts(is_representative, is_agent)
    {
        var dataTable = $('#all-contracts').DataTable({
            "processing":true,
            "serverSide":true,
            "pageLength": 25,
            "order":[],
            "ajax": {
                url: window.root + "services_entry/load_all_contracts",
                type: "POST",
                data: {is_representative: is_representative, is_agent: is_agent}
            },
            "columnDefs":[
                {
                    "targets":[1,2,3,4,5,6,7,8],
                    "orderable":false,
                },
            ],
        });
    }


    $(document).on('change', '#representative', function() {
        var representative = $(this).val();
        var agent = $('#agent').val();
        $('#all-contracts').DataTable().destroy();
        load_contracts(representative, agent);
    });

    $(document).on('change', '#agent', function() {
        var agent = $(this).val();
        var representative = $('#representative').val();
        $('#all-contracts').DataTable().destroy();
        load_contracts(representative, agent);

    });

});