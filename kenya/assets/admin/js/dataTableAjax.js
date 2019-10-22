$(document).ready(function() {
   let table = $('#table').DataTable({
       "processing": true, //Feature control the processing indicator.
       "serverSide": true, //Feature control DataTables' server-
       "datatable-buttons": false,
       "iDisplayLength": 25,
        dom: "Bfrtip",
       "order": [], //Initial no order.

       // Load data for the table's content from an Ajax source
       "ajax": {
           url: root + list,
           type: "POST",
           data: function(d) {
               d.csrf_test_name = getCookie('csrf_cookie_name');
           },
       },

       //Set column definition initialisation properties.
       "columnDefs": [
           {
               "targets": [ -1 ], //last column
               "orderable": false, //set not orderable
           },
       ],
   });

    $('#min').keyup( function() { table.draw(); } );
    $('#max').keyup( function() { table.draw(); } );

});