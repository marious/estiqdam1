$(function() {

  $('.dd').nestable();
  update_out('#list2', '#reorder');

  $('#list2').on('change', function() {
    var out = $('#list2').nestable('serialize');
    $('#reorder').val(JSON.stringify(out));
  });

  function update_out(selector, sel2) {
    var out = $(selector).nestable('serialize');
    $(sel2).val(JSON.stringify(out));
  };



  $('input[type="checkbox"].minimal-blue, input[type="radio"].minimal-blue').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue'
  }); 	
  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue'
  }); 

});


