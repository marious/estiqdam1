$(function() {

    // load_contracts(false);
    //
    // function load_contracts(is_country, is_agent)
    // {
        var is_agent = false;

        var dataTable = $('#all_accepted').DataTable({
            "processing":true,
            "serverSide":true,
            "pageLength": 20,
            "searching": true,
            "order":[],
            "ajax": {
                url: window.root + "agent_worker/get_all_accepted",
                type: "POST",
                data: {is_agent: is_agent}
            },
            "columnDefs":[
                // { "width": "2%", "targets": 5},
                {
                    "targets":[0,1,2,3,4,5,6,7,8,9],
                    "orderable":false,
                },
            ],
        });
    // }



    $(document).on('submit', '#worker-form', function(event) {
        event.preventDefault();
        var biometricDate = $('#biometric_date').val();
        var contractReceivedDate = $('#contract-received-date').val();
        var pk = $('#worker_id').val();

        if (biometricDate || contractReceivedDate) {
            $.ajax({
                url: window.root + "agent_worker/update_worker_contract_received_biometric",
                data: {"name": ["biometric_date", "contract_received_date"], "value": [biometricDate, contractReceivedDate], "pk": pk},
                // dataType: "json",
                method: "post",
                // contentType:false,
                // processData:false,
                success: function(data) {
                    $('#worker-form')[0].reset();
                    $('#worker-modal').modal('hide');
                    dataTable.ajax.reload();
                }

            });
        }
    });


    $(document).on('click', '.update', function() {
        var worker_id = $(this).attr('id');
        $.ajax({
            url: window.root + 'agent_worker/get_worker_by_id',
            method: "POST",
            data: {worker_id: worker_id},
            dataType: "json",
            success: function(data) {
                $('#worker-modal').modal('show');
                $('#worker_id').val(data.id);
            }

        });
    });


    // $(document).on('change', '#country', function() {
    //     var country = $(this).val();
    //     $('#not_arrived_table').DataTable().destroy();
    //     if (country != '') {
    //         load_contracts(country);
    //     } else {
    //         load_contracts();
    //     }
    // });

    // $(document).on('change', '#representative', function() {
    //     var representative = $(this).val();
    //     $('#agent').val('');
    //     $('#not_arrived_table').DataTable().destroy();
    //     if (representative != '') {
    //         load_contracts(representative);
    //     } else {
    //         load_contracts();
    //     }
    // });
    //






    $(document).on('change', '#agent', function() {
        var agent = $(this).val();
        console.log(agent);
        $('#all_accepted').DataTable().destroy();

        var dataTable = $('#all_accepted').DataTable({
            "processing":true,
            "serverSide":true,
            "pageLength": 20,
            "searching": true,
            "order":[],
            "ajax": {
                url: window.root + "agent_worker/get_all_accepted",
                type: "POST",
                data: {is_agent: agent}
            },
            "columnDefs":[
                // { "width": "2%", "targets": 5},
                {
                    "targets":[0,1,2,3,4,5,6,7,8,9],
                    "orderable":false,
                },
            ],
        });
        $(document).on('submit', '#worker-form', function(event) {
            event.preventDefault();
            var biometricDate = $('#biometric_date').val();
            var pk = $('#worker_id').val();

            if (biometricDate) {
                $.ajax({
                    url: window.root + "agent_worker/update_worker_editable_data",
                    data: {"name": "biometric_date", "value": biometricDate, "pk": pk},
                    // dataType: "json",
                    method: "post",
                    // contentType:false,
                    // processData:false,
                    success: function(data) {
                        $('#worker-form')[0].reset();
                        $('#worker-modal').modal('hide');
                        dataTable.ajax.reload();
                    }

                });
            }
        });
    });



    $(document).on('click', '#vfs-worker', function(e) {
       e.preventDefault();
       var agent = $('#agent').val();
        var newWin = window.open();

        $.ajax({
           url: window.root + "agent_worker/print_vfs_worker",
           data: {agent_id: agent},
           method: 'POST',
           datatype: "html",
           success: function(data) {
               newWin.document.write(data);
               newWin.document.close();
               newWin.focus();
               newWin.print();
               newWin.close();
           }
       });
    });

    $(document).on('click', '#not-vfs-worker', function(e) {
        e.preventDefault();
        var agent = $('#agent').val();
        var newWin = window.open();

        $.ajax({
            url: window.root + "agent_worker/print_not_vfs_worker",
            data: {agent_id: agent},
            method: 'POST',
            datatype: "html",
            success: function(data) {
                newWin.document.write(data);
                newWin.document.close();
                newWin.focus();
                newWin.print();
                newWin.close();
            }
        });
    });

});