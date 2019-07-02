$(function () {
  $('#slider-table').DataTable({
      "processing":true,
      "serverSide":true,
      "pageLength": 15,
      "searching": false,
      "order":[],
      "ajax": {
          url: 'load_all_sliders',
          type: "POST",
      },
      "columnDefs":[
          // {"width": "100px", "height": "60px", "targets":5},
          // {"width": "20%", "targets":7},
          // {"width": "18%", "targets": 3},
          // {"width": "18%", "targets": 4},
          // {"width": "3%", "targets": 0},
          {
              "targets":[0,1,2,3,4,5,6,7,8],
              "orderable":false,
          },
      ]

  });
});