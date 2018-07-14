if ($('#agents_table').lenght !== 0) {
    $('#customers_table').DataTable({
        "process": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: window.root + "/customers/fetch",
            type: "POST"
        },
        "columnDefs":[
            {
                "targets":[0,1,2,3,4],
                "orderable":false,
            }
        ],
    });
}