if ($('#daterange-btn').length)
{
    $('#daterange-btn').daterangepicker(
        {
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 Days': [moment(),moment().add(6, 'days')],
                '15 Days': [moment(),moment().add(14, 'days')],
                '30 Days': [moment(),moment().add(29, 'days')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                '60 Days': [moment(),moment().add(59, 'days')],
                '90 Days': [moment(),moment().add(89, 'days')]
                //'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment(),
            endDate: moment().add(29, 'days')
        },
        function (start, end) {
            $('#daterange-btn span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            $(".invoice_date").val(start.format('DD/MM/YYYY'));
            $(".due_date").val(end.format('DD/MM/YYYY'));
        }
    );
}

// }
//*****************************************************************
//*********************Loader Function*****************************
//*****************************************************************
function loader() {
    let over = `<div id="overlay">
                    <img src="${root}assets/admin/img/balls.gif" id="loading">
                </div>
`;
    $(over).appendTo('body');
}

//*****************************************************************
//*********************Get CSRF TOKEN******************************
//*****************************************************************

function getCookie(name) {

    var cookieValue = null;
    if (document.cookie && document.cookie != '') {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = jQuery.trim(cookies[i]);
            // Does this cookie string begin with the name we want?
            if (cookie.substring(0, name.length + 1) == (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;

}

//*******************************************************
//*****************Cart Ajax Start from here*************
//*******************************************************
function get_product_id(str) {
    const rowid = str.id;
    const productId = str.value;
    const postUrl = root + 'sales/add_to_cart';
    const csrfToken = getCookie('csrf_cookie_name');
    loader();
    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            product_id: productId,
            rowid: rowid,
            status: status,
            'csrf_test_name': csrfToken
        },
        cache: false,
        success: function(response) {
            $.get(root + 'sales/show_cart', function(cart) {
                $('#cart-view').html(cart);
                $('.products').select2();
            });
            $('#overlay').remove();
        }
    });

}


// Update Item
function updateItem(str) {
    let val = str.id;
    let rowid = val.slice(3);
    let type = val.slice(0,3);
    let o_val = str.value;
    let qty = $('#qty'+rowid).val();
    let price = $('#prc'+rowid).val();
    let p_id = $('#pid'+rowid).val();

    let postUrl = root + 'sales/update_cart_item';
    let csrfToken = getCookie('csrf_cookie_name');
    loader();

    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            rowid: rowid,
            type: type,
            o_val: o_val,
            qty: qty,
            price: price,
            p_id: p_id,
            status: status,
            'csrf_test_name': csrfToken,
        },
        cache: false,
        success: function(response) {
            $.get(root + 'sales/show_cart', function(cart) {
                $('#cart-view').html(cart);
                $('.products').select2();
            });
            $('#overlay').remove();
        }

    });
}


// Remove Item
function removeItem(str) {
    const rowid = str.id;
    const postUrl = root + 'sales/remove_item';
    let csrftoken = getCookie('csrf_cookie_name');
    loader();
    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            rowid: rowid,
            status: status,
            'csrf_test_name': csrftoken
        },
        cache: false,
        success: function(response) {
            $.get(root + 'sales/show_cart', function(cart) {
                $('#cart-view').html(cart);
                $('.products').select2();
            });
            $('#overlay').remove();
        }
    });
}