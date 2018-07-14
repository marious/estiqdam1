$(function() {

if ($('#payment_data').length)
{
    $('#payment_data').editable({
        container: 'body',
        selector: 'td.payment_date',
        url: window.root + 'finance/update_payment_date',
        title: 'تاريخ الدفع',
        type: 'POST',
        format: 'yyyy-mm-dd',
        viewformat: 'dd-mm-yyyy',
        datepicker: {
            weekStart: 1
        },
        // dataType: 'json',

    });
}


    if ($('#finance_table_2').length)
    {

        load_contracts(false, false);

        function load_contracts(is_country, contract_date)
        {
            var dataTable = $('#finance_table_2').DataTable({
                "processing":true,
                "serverSide":true,
                "pageLength": 15,
                "searching": true,
                "order":[],
                "ajax": {
                    url: window.root + "reports/load_not_paid",
                    type: "POST",
                    data: {is_country: is_country, contract_date: contract_date}
                },
                "columnDefs":[
                    // { "width": "2%", "targets": 5},
                    {
                        "targets":[0,1,2,3,4,5,6,7],
                        "orderable":false,
                    },
                ],
            });
        }


        $(document).on('change', '#country', function() {
            var country = $(this).val();
            $('#finance_table_2').DataTable().destroy();
            if (country != '') {
                load_contracts(country);
            } else {
                load_contracts();
            }
        });

    }




    if ($('#finance_table').length) {

        load_contracts(false, false);

        function load_contracts(is_country, contract_date)
        {
            var dataTable = $('#finance_table').DataTable({
                "processing":true,
                "serverSide":true,
                "pageLength": 15,
                "searching": true,
                "order":[],
                "ajax": {
                    url: window.root + "finance/load_not_paid_contracts",
                    type: "POST",
                    data: {is_country: is_country, contract_date: contract_date}
                },
                "columnDefs":[
                    // { "width": "2%", "targets": 5},
                    {
                        "targets":[0,2,3,4,5,6,7],
                        "orderable":false,
                    },
                ],
            });
        }


        $(document).on('change', '#country', function() {
            var country = $(this).val();
            $('#finance_table').DataTable().destroy();
            if (country != '') {
                load_contracts(country);
            } else {
                load_contracts();
            }
        });
    }

    $(document).on('click', '#search_btn', function() {
        var start_date, end_date;
       var contract_date = $('#contract_date').val();
       contract_date = contract_date.split(" - ");
// console.log(contract_date);
        start_date = date('Y-m-d', datetotime('d-m-Y', contract_date[0]));
        end_date = date('Y-m-d', datetotime('d-m-Y', contract_date[1]));
        contract_date = " BETWEEN '"+start_date+"' AND '"+end_date+"' ";
// console.log(contract_date);return;
        $('#finance_table').DataTable().destroy();
        if (contract_date != '')
        {
            load_contracts(false, contract_date);
        } else {
            load_contracts();
        }
    });


    function datetotime(template, date){
        date = date.split( template[1] );
        template = template.split( template[1] );
        date = date[ template.indexOf('m') ]
            + "/" + date[ template.indexOf('d') ]
            + "/" + date[ template.indexOf('Y') ];

        return (new Date(date).getTime()/1000);
    }

});