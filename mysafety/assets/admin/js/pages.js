$(function () {
    $('#service-table').DataTable({
        "processing":true,
        "serverSide":true,
        "pageLength": 15,
        "searching": true,
        "order":[],
        "ajax": {
            url: 'load_all_pages',
            type: "POST",
        },
        "columnDefs":[
            {"width": "100px", "height": "60px", "targets":5},
            {"width": "20%", "targets":7},
            {"width": "18%", "targets": 3},
            {"width": "18%", "targets": 4},
            {"width": "3%", "targets": 0},
            {
                "targets":[0,1,2,3,4,5,7],
                "orderable":false,
            },
        ]

    });
});