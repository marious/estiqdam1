$(function () {
    $('#customers-table').DataTable({
        "processing":true,
        "serverSide":true,
        "pageLength": 15,
        "searching": true,
        "order":[],
        "ajax": {
            url: root + 'customers/load_all_customers',
            type: "POST",
            'csrf_token': csrf_token,
        },
        "columnDefs":[
            // {"width": "100px", "height": "60px", "targets":3},
            // {"width": "18%", "targets":4},

            {
                "targets":[0,1,2,3,4,5,6,7],
                "orderable":false,
            },
        ]

    });
});



$(function () {
    $('#vendors-table').DataTable({
        "processing":true,
        "serverSide":true,
        "pageLength": 15,
        "searching": true,
        "order":[],
        "ajax": {
            url: root + 'customers/load_all_vendors',
            type: "POST",
            'csrf_token': csrf_token,
        },
        "columnDefs":[
            // {"width": "100px", "height": "60px", "targets":3},
            // {"width": "18%", "targets":4},

            {
                "targets":[0,1,2,3,],
                "orderable":false,
            },
        ]

    });
});