$(function () {
    $('#accounts-table').DataTable({
        "processing":true,
        "serverSide":true,
        "pageLength": 15,
        "searching": true,
        "order":[],
        "ajax": {
            url: root + 'banks/load_all_banks',
            type: "POST",
        },
        "columnDefs":[
            // {"width": "100px", "height": "60px", "targets":3},
            // {"width": "18%", "targets":4},

            {
                "targets":[0,1,2,3,4,5],
                "orderable":false,
            },
        ]

    });
});