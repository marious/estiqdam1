$(function () {
    $('#users-table').DataTable({
        "processing":true,
        "serverSide":true,
        "pageLength": 15,
        "searching": true,
        "order":[],
        "ajax": {
            url: 'users/load_all_users',
            type: "POST",
        },
        "columnDefs":[
            // {"width": "100px", "height": "60px", "targets":5},
            // {"width": "20%", "targets":7},
            // {"width": "18%", "targets": 3},
            {"className": "date-cell", "targets": 4},
            // {"width": "3%", "targets": 0},
            {
                "targets":[1,2,3,5],
                "orderable":false,
            },
        ]

    });
});

