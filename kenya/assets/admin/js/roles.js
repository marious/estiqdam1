$(".permission-group").on('ifToggled', function () {
    // $(this).parents('li').find('.child').prop('checked', this.checked);
   var el = $(this).parents('li').find('.child');
   $(el).iCheck('toggle');
});