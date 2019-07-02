$(function () {

 var path = window.location.pathname.split('/');
 var productId = path[path.length - 1];


 var dataTable =  $('#product-images-table').DataTable({
      "processing":true,
      "serverSide":true,
      "pageLength": 10,
      "searching": false,
      "order":[],
      "ajax": {
          url: window.root + 'products/load_all_product_images/' + productId,
          type: "POST",
      },
      "columnDefs":[
          // {"width": "100px", "height": "60px", "targets":6},
          // {"width": "20%", "targets":8},
          // {"width": "10%", "targets": 1},
          // {"width": "10%", "targets": 2},
          // {"width": "10%", "targets": 3},
          // {"width": "3%", "targets": 0},
          // {"width": "12%", "targets": 7},
          {
              "targets":[0,1,2,3],
              "orderable":false,
          },
      ]

  });



  $('#form').on('submit', function(e) {
    e.preventDefault();
  
    var url = $(this).attr('action');
    var method = $(this).attr('method');
  
    $.ajax({
  
      xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener('progress', function(e) {
          if (e.lengthComputable) {
            var percentComplete = e.loaded / e.total;
            percentComplete = parseInt(percentComplete * 100);
            $('.progress-bar').width(percentComplete + '%');
            $('#progress-status').html(percentComplete + '%');
          }
        }, false);
        return xhr;
      },
  
      url: url,
      type: method,
      dataType: 'JSON',
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
  
      beforeSend: function() {
        $('#submit').html('<img src="" style="max-width: 12px;"> Loading');
        $('#submit').prop('disabled', true);
        $('.progress-info').show();
        $('.progress-bar').width('0%');
      },
  
      success: function(data) {
        console.log(data[0]);
        $('#submit').prop('disabled', false);
        $('#submit').html('Submit');
  
        if (data[0] == true) {
          toastr['success'](data[1]);
          $('#form')[0].reset();
  
        } else {
          toastr['error'](data[1]);
        }
  
        $('.progress-info').hide();
        $('#progress-status').hide();
        $('.progress-bar').width('0%');
        dataTable.ajax.reload();
  
      },
  
    });

    });
});