$(function () {
  $('#categories-table').DataTable({
      "processing":true,
      "serverSide":true,
      "pageLength": 15,
      "searching": true,
      "order":[],
      "ajax": {
          url: 'load_all_categories',
          type: "POST",
      },
      "columnDefs":[
          {"width": "100px", "height": "60px", "targets":5},
          {"width": "20%", "targets":6},
          {"width": "5%", "targets": 0},
          {"width": "10%", "targets": 1},
          {"width": "10%", "targets": 2},
          {"width": "3%", "targets": 0},
          {"width": "10%", "targets": 7},
          {"width": "12%", "className": "date-cell", "targets": 6},
          {
              "targets":[0,1,2,3,4,5,7],
              "orderable":false,
          },
      ]

  });
});