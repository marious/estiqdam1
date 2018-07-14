function FormValidObject() {
    "use strict";

    function _wrapValidation(message) {
        return '<span class="errorMessage">' + message + '</span>';
    }

    function _validation(validation, status) {
        var status = status || '';
        $.each(validation, function(k, v) {
           $('#' + status + k).addClass('has-error');
           if (typeof v == 'string') {
               $('#' + status + k).after(_wrapValidation(v));
           } else {
               $('#' + status + k).after(_wrapValidation(v[0]));
           }
           $('#' + status + k).on('focusin', function() {
                $(this).removeClass('has-error');
                $(this).next('.errorMessage').remove();
           });
        });
    }

    function _displayMessage(thisForm, message) {
        thisForm.find('div').after(message);
    }

    function _clearFormValidation(thisForm) {
        thisForm.find('.errorMessage').remove();
    }


    function _reset() {
        thisForm[0].reset();
    }



    function _submitInstituteDetailsForm() {
        $(document).on('submit', '#institution-details', function(e) {
           e.preventDefault();
           e.stopPropagation();

           var thisForm = $(this);
           var thisArray = thisForm.serializeArray();

            _addSpinner('#institution-details button');

            $.post(window.root + 'site_settings/index', thisArray, function(data) {
               if (data.result == 1) {
                _removeSpinner('#institution-details button');
                _removeSuccessMsg();
                thisForm.prepend(_addSuccessMsg(data.success));
                $(window).scrollTop(0);
               } else {
                   _clearFormValidation(thisForm);
                   _displayMessage(thisForm, data.message);
                   _validation(data.errors);
                   _removeSuccessMsg();
                   _removeSpinner('#institution-details button');
                   $(window).scrollTop(250);
               }
           }, 'json');
        });
    }


    function _addSpinner(button) {
        var spinnerContent = '<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate spinner" ' +
            'id="">' +
            '</span>';
        $(button).append(spinnerContent);
        $(button).attr('disabled', true);
    }

    function _removeSpinner(button) {
        $('span.spinner').remove();
        $(button).attr('disabled', false);
    }


    function _addSuccessMsg(msg) {
        return '<div class="alert alert-dismissable alert-success alert-msg-success">' +
                '<button type="button" class="close" data-dismiss="alert">×</button>' +
                msg + '</div>';
    }


    function _removeSuccessMsg() {
        $('div.alert-msg-success').remove();
    }


    this.init = function() {
        _submitInstituteDetailsForm();
    }

}

var formValidObject = new FormValidObject();
formValidObject.init();

$('body').on('click', '.delete-btn',function(e) {
    e.preventDefault();
    var link = $(this).attr('href');
    if (confirm('Are You sure to make this action?')) {
        window.location = link;
    }
});


// Add Datatables
//  if ($('#customers_table').lenght != 0) {
//      $('#customers_table').DataTable({
//          "process": true,
//          "serverSide": true,
//          "order": [],
//          "ajax": {
//              url: window.root + "/customers/fetch",
//              type: "POST"
//          },
//          "columnDefs":[
//              {
//                  "targets":[1,2,3,4],
//                  "orderable":false,
//              }
//          ],
//      });
//  }



// Add Datatables
//  if ($('#representatives_table').lenght !== 0) {
//      $('#representatives_table').DataTable({
//          "process": true,
//          "serverSide": true,
//          "order": [],
//          "ajax": {
//              url: window.root + "representatives/fetch",
//              type: "POST"
//          },
//          "columnDefs":[
//              {
//                  "targets":[1],
//                  "orderable":false,
//              }
//          ],
//      });
//  }




$('.dropdown, .btn-group').on('show.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(100);
});
$('.dropdown, .btn-group').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100);
});

$('body').on('click', 'a.view-customer', function(e) {
    e.preventDefault();

    var id = $(this).data('customer');
    if (id != '') {
        $.ajax({
            url: window.root + '/customers/show/' + id,
            method: "POST",
            data: {id: id},
            dataType: "json",
            success: function(data) {
                $('#customer_name').html(data.name);
                $('#customer_email').html(data.email);
                $('#customer_country').html(data.country);
                $('#customer_phone').html(data.phone);
                $('#customer_address').html(data.address);
                $('#customer_image').attr('src', window.root + '/assets/img/customers/' + data.image);

                $('#customer_modal').modal();
            }
        });
    }
});


$('body').on('click', 'a.view-agent', function(e) {
    e.preventDefault();

    var id = $(this).data('agent');
    if (id != '') {
        $.ajax({
            url: window.root + '/agents/show/' + id,
            method: "POST",
            data: {id: id},
            dataType: "json",
            success: function(data) {
                $('#agent_name').html(data.name);
                $('#agent_email').html(data.email);
                $('#agent_country').html(data.country);
                $('#agent_phone').html(data.phone);
                $('#agent_address').html(data.address);
                $('#agent_image').attr('src', window.root + '/assets/img/agents/' + data.image);

                $('#agent_modal').modal();
            }
        });
    }
});


$('body').on('click', 'a.view-representative', function(e) {
    e.preventDefault();

    var id = $(this).data('representative');
    if (id != '') {
        $.ajax({
            url: window.root + '/representatives/show/' + id,
            method: "POST",
            data: {id: id},
            dataType: "json",
            success: function(data) {
                $('#representative_name').html(data.name);
                $('#representative_modal').modal();
            }
        });
    }
});


$('#searched_by').on('change', function() {
    var $this = $(this);
    $.ajax({
        url: window.root + '/services_entry/advanced_search_ajax',
        method: 'POST',
        data: {searched_by: $this.val()},
        dataType: "html",
        success: function(data) {
            $('.enter-keyword').text(data);
        }
    });
});

// $('#searched_query').typeahead({
//     source: function(query, result) {
//         $.ajax({
//             url: window.root +  'services_entry/do_advanced_search',
//             method: "POST",
//             data: {query: query, searched: $('#searched_by').val()},
//             dataType: "json",
//             success: function(data) {
//                 result($.map(data, function(item) {
//                     //var searchedVal = $('#searched_by').val();
//                     return item.customer_name_in_english;
//                 }));
//             }
//         });
//     }
// });

$('#searched_by').on('change', function() {
   $('#searched_query').val('');
});


$('.carousel').carousel({
    interval: 10000
});

if ($('#tickets-contracts')) {
    $('#tickets-contracts').on('click', '.update-form', function(e) {
        var formId = $(this).data('form-id');
        console.log('#' + formId);
        var input = $('#' + formId + ' ' + 'input.departure_date');
        console.log($('#form-618 input.departure_date'));
        $('#' + formId + ' ' + '.departure_date_text').css('display', 'none');
    });
}

if ($('.combodate').length) {
    $('.combodate').combodate();
}


