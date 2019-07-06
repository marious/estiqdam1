$(function () {
    $('#messages-table').DataTable({
        "processing":true,
        "serverSide":true,
        "pageLength": 15,
        "searching": true,
        "order":[],
        "ajax": {
            url: 'load_all_contacts',
            type: "POST",
        },
        "columnDefs":[
            {"width": "100px", "height": "60px", "targets":3},
            {"width": "30%", "targets":4},
            {"width": "12%", "className": "date-cell" , "targets":5},

            {
                "targets":[0,1,2,3,4,6],
                "orderable":false,
            },
        ]

    });
});