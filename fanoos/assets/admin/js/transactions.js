
if ($('#transactions-table').length)
{

    var transactionType = $('#transaction-type').val();

    fetch_data('no', transactionType);

    $('.input-daterange').datepicker({
        todayBtn:'linked',
        format: "dd/mm/yyyy",
        autoclose: true
    });

    $('#search').on('click', function(e) {
        e.preventDefault();
        var startDate = $('#start-date').val();
        var endDate = $('#end-date').val();
        var type = $('#transaction-type').val();
        if (startDate !== '' && endDate !== '')
        {
            $('#transactions-table').DataTable().destroy();
            fetch_data('yes', type, startDate, endDate);

        } else {
            $('#transactions-table').DataTable().destroy();
            fetch_data('no', type);
        }

    });


    function fetch_data(isDateSearch, transactionType = '', startDate = '', endDate = '') {
        var datatable = $('#transactions-table').DataTable({
            "processing":true,
            "serverSide":true,
            "pageLength": 15,
            "searching": true,
            "order":[],
            "ajax": {
                url: root + 'transactions/load_all_transactions',
                type: "POST",
                data: {is_date_search: isDateSearch, start_date: startDate, end_date: endDate, type: transactionType},
            },
            "columnDefs":[
                // {"width": "100px", "height": "60px", "targets":3},
                // {"width": "18%", "targets":4},

                {
                    "targets":[0,1,2,3,4,5,6,7,8,9],
                    "orderable":false,
                },
            ]

        });
    }

}

$("#payee").select2({
    ajax: {
        url: root + '/customers/get',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                searchTerm: params.term // search term
            };
        },
        processResults: function (data) {

            return {
                results: $.map(data, function(item) {
                    return {text: item.title, id:item.id}
                })
            };
        },
        cache: true
    }
});

