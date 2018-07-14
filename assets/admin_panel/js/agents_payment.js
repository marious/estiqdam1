$(function() {

    $('#agents-payment').on('click', '.make-note', function(e) {
        e.preventDefault();
        var contractNumber = $(this).data('contract-number');
        $('#noteModal #contract-number').val(contractNumber);
        $('#noteModal').modal('show');
    });

    $(document).on('click', '#note-button', function() {
       var note = $('#note').val();
       var contractNumber = $('#contract-number').val();
       if (note != '' && contractNumber != '') {
           $.ajax({
               url: window.root + 'finance/save_agent_payment_note',
               method: "POST",
               data: {note: note, contractNumber: contractNumber},
               success: function(data) {
                   window.location.reload();
               }
           });
       }
    });

    // load_contracts();


    $('#agents-payment').on('change', 'input[type="radio"]', function() {
        var contract_number = $(this).data('contract-number');
        var agent_id = $(this).data('agent-id');
        var action = $(this).data('action');

       if (confirm('Are Your Sure?'))
       {
           $.ajax({
               url: window.root + "finance/save_agent_payment",
               type: "POST",
               data: {contract_number: contract_number, agent_id: agent_id, action: action},
               success: function() {
                   window.location.reload();
               }
           });
       }
    });


    //
    // function load_contracts(is_agent)
    // {
    var is_agent = false;

    var dataTable = $('#agents-payment').DataTable({
            "processing":true,
            "serverSide":true,
            "pageLength": 25,
            "order":[],
            "deferRender": true,
            "ajax": {
                url: window.root + "finance/load_all_contracts",
                type: "POST",
                data: {is_agent: is_agent}
            },
            "columnDefs":[
                {
                    "targets":[0,1,2,3,4,5,6,7,8,9,10],
                    "orderable":false,
                },
            ],
        });
    // }



    $(document).on('change', '#agent', function() {
        var agent = $(this).val();
        $('#agents-payment').DataTable().destroy();
        var dataTable = $('#agents-payment').DataTable({
            "processing":true,
            "serverSide":true,
            "pageLength": 25,
            "order":[],
            "deferRender": true,
            "ajax": {
                url: window.root + "finance/load_all_contracts",
                type: "POST",
                data: {is_agent: agent}
            },
            "columnDefs":[
                {
                    "targets":[0,1,2,3,4,5,6,7,8,9,10],
                    "orderable":false,
                },
            ],
        });

    });


    $(document).on('click', '.update-payment', function() {
        var contract_number = $(this).attr('id');
        $.ajax({
            url: window.root + 'finance/get_agent_payment_by_contract_number',
            method: "POST",
            data: {contract_number: contract_number},
            dataType: "json",
            success: function(data) {
                console.log(data);
                $('#payment-form')[0].reset();
                if (data.total_payment) {$('#total_payment').val(data.total_payment)};
                if (data.first_payment) {$('#first_payment').val(data.first_payment)};
                if (data.second_payment) {$('#second_payment').val(data.second_payment)};
                $('#payment-modal').modal('show');
                $('#contract_number').val(data.contract_number);
            }

        });
    });



    $(document).on('submit', '#payment-form', function(event) {
        event.preventDefault();
        var totalPayment = $('#total_payment').val();
        var firstPayment = $('#first_payment').val();
        var secondPayment = $('#second_payment').val();
        var pk = $('#contract_number').val();

        if (totalPayment) {
            $.ajax({
                url: window.root + "finance/update_agent_payment_amount",
                data: [
                        {"name": "total_payment", "value": totalPayment},
                        {"name": "first_payment", "value": firstPayment},
                        {"name": "second_payment", "value": secondPayment},
                        {"name": "contract_number", "value": pk},
                        ],
                // dataType: "json",
                method: "post",
                // contentType:false,
                // processData:false,
                success: function(data) {
                    $('#payment-form')[0].reset();
                    $('#payment-modal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        }
    });


});