$(function () {

    if ($('#products-table').length) {


        $('#products-table').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 15,
            "searching": true,
            "order": [],
            "ajax": {
                url: root + 'items/load_all_products',
                type: "POST",
            },
            "columnDefs": [
                // {"width": "100px", "height": "60px", "targets":3},
                // {"width": "18%", "targets":4},

                {
                    "targets": [0, 1, 2, 3,],
                    "orderable": false,
                },
            ]

        });


        $('#services-table').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 15,
            "searching": true,
            "order": [],
            "ajax": {
                url: root + 'items/load_all_services',
                type: "POST",
            },
            "columnDefs": [
                // {"width": "100px", "height": "60px", "targets":3},
                // {"width": "18%", "targets":4},

                {
                    "targets": [0, 1, 2, 3,],
                    "orderable": false,
                },
            ]

        });

    }

    $('#sales_price, #retail_price, #purchase_cost, #wholesale_price').inputFilter(function(value) {
        return /^-?\d*[.,]?\d*$/.test(value);
    });
});



