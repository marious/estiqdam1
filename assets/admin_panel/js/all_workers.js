$(function() {

    load_workers(false);

    function load_workers(is_agent)
    {
        var dataTable = $('#all-workers').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax": {
                url: window.root + "agent_worker/load_all_workers",
                type: "POST",
                data: {is_agent: is_agent}
            },
            "columnDefs":[
                {
                    "targets":[0,1,2,4,5],
                    "orderable":false,
                },
            ],
        });
    }


    $(document).on('change', '#agent', function() {
        var agent = $(this).val();
        $('#all-workers').DataTable().destroy();
        if (agent != '') {
            load_workers(agent);
        } else {
            load_workers();
        }
    });

});