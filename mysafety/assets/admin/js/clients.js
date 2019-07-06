$(function () {
    $('#clients-table').DataTable({
        "processing":true,
        "serverSide":true,
        "pageLength": 15,
        "searching": true,
        "order":[],
        "ajax": {
            url: 'load_all_clients',
            type: "POST",
        },
        "columnDefs":[
            {"width": "100px", "height": "60px", "targets":3},
            {"width": "18%","className": "date-cell", "targets":4},

            {
                "targets":[0,1,2,3,5],
                "orderable":false,
            },
        ]

    });
});