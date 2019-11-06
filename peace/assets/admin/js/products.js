$(function () {
    $('#products-table').DataTable({
        "processing":true,
        "serverSide":true,
        "pageLength": 15,
        "searching": true,
        "order":[],
        "ajax": {
            url: 'load_all_products',
            type: "POST",
        },
        "columnDefs":[
            {"width": "100px", "height": "60px", "targets":6},
            {"width": "20%", "targets":8},
            {"width": "10%", "targets": 1},
            {"width": "10%", "targets": 2},
            {"width": "10%", "targets": 3},
            {"width": "3%", "targets": 0},
            {"width": "12%", "targets": 7},
            {
                "targets":[0,1,2,3,4,5,6,8],
                "orderable":false,
            },
        ]

    });
});