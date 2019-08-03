$('#customers-list').select2({
    ajax: {
        url: root + '/customers/get',
        type: "get",
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
//======================================================================================================================
// Add Payment
//======================================================================================================================


