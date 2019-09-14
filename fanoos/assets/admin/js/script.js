// Restricts input for each element in the set of matched elements to the given inputFilter.
(function($) {
    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    };
}(jQuery));


$('input[name="qty"], input[name="amount"]').inputFilter(function(value) {
    return /^-?\d*[.,]?\d*$/.test(value);
});


var csrf_token= getCookie('csrf_cookie_name');
$.ajaxSetup({
    data: {
        'csrf_test_name' : csrf_token
    }
});


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

//==========================================================
//  Ajax Form Submission
//==========================================================
function msgBox(type, msg) {
    $('#msg').html(`
        <div class="alert alert-${type}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        ${msg}
        </div>
    `);
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);
}


function msgBoxModal(type, msg) {
    $('#msgModal').html(`
        <div class="alert alert-${type}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        ${msg}
        </div>
    `);
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);
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


//*****************************************************************
//***************** Purchase Cart Ajax Start from here*************
//*****************************************************************
function pur_product_id(str) {
    const rowid = str.id;
    const productID = str.value;
    const linke = root;
    const postUrl = root + 'purchase/add_to_cart';
    const csrftoken = getCookie('csrf_cookie_name');

    loader();
    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            product_id: productID,
            rowid: rowid,
            csrf_test_name: csrftoken,
        },
        cache: false,
        success: function(response) {
            $.get(root + 'purchase/show_cart', function(cart) {
                $('#cart-view').html(cart);
                $('.products').select2();
            });
            $('#overlay').remove();
        }
    });
}


function pur_updateItem(str) {
    const val = str.id;
    const rowid = val.slice(3);
    const type = val.slice(0,3);
    const o_val = str.value;

    const postUrl = root + 'purchase/update_cart_item';
    const csrftoken = getCookie('csrf_cookie_name');
    loader();
    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            rowid: rowid,
            type: type,
            o_val: o_val,
            csrf_test_name: csrftoken,
        },
        cache: false,
        success: function(response) {
            $.get(root + 'purchase/show_cart', function(cart) {
                $('#cart-view').html(cart);
                $('.products').select2();
            });
            $('#overlay').remove();
        }
    });
}


function pur_order_discount(str)
{
    const discount = str.value;
    const postUrl = root + 'purchase/order_discount';
    const csrftoken = getCookie('csrf_cookie_name');
    loader();
    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            discount: discount,
            csrf_test_name: csrftoken,
        },
        cache: false,
        success: function(response) {
            $.get(root + 'purchase/show_cart', function(cart) {
                $('#cart-view').html(cart);
                $('.products').select2();
            });
            $('#overlay').remove();
        }
    });
}


function pur_tax(str)
{
    const tax = str.value;
    const postUrl = root + 'purchase/order_tax';
    const csrftoken = getCookie('csrf_cookie_name');
    loader();
    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            tax: tax,
            csrf_test_name: csrftoken,
        },
        cache: false,
        success: function(response) {
            $.get(root + 'purchase/show_cart', function(cart) {
                $('#cart-view').html(cart);
                $('.products').select2();
            });
            $('#overlay').remove();
        }
    });
}

function pur_shipping(str)
{
    const shipping = str.value;
    const postUrl = root + 'purchase/order_shipping';
    const csrftoken = getCookie('csrf_cookie_name');
    loader();
    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            shipping: shipping,
            csrf_test_name: csrftoken,
        },
        cache: false,
        success: function(response) {
            $.get(root + 'purchase/show_cart', function(cart) {
                $('#cart-view').html(cart);
                $('.products').select2();
            });
            $('#overlay').remove();
        }
    });
}





function pur_removeItem(str) {
    const rowid = str.id;
    const postUrl = root + 'purchase/remove_item';
    const csrftoken = getCookie('csrf_cookie_name');
    loader();
    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            rowid: rowid,
            csrf_test_name: csrftoken,
        },
        cache: false,
        success: function(response) {
            $.get(root + 'purchase/show_cart', function(cart) {
                $('#cart-view').html(cart);
                $('.products').select2();
            });
            $('#overlay').remove();
        }

    });

}


function getVendor(str) {
    let vendor_id = str.value;
    let postUrl = root + 'purchase/select_vendor_by_id';
    let csrftoken = getCookie('csrf_cookie_name');

    loader();
    $.ajax({
        url: postUrl,
        type: "POST",
        data: {
            vendor_id: vendor_id,
            'csrf_test_name': csrftoken,
        },
        cache: false,
        success: function(response) {
            let customer = $.parseJSON(response);
            $('[name="email"]').val(customer.email);
            $('[name="b_address"]').val(customer.b_address);
            $('[name="s_address"]').val(customer.s_address);
            $('#overlay').remove();
        }
    });
}

//==========================================================
//  Save Product Category
//==========================================================
function saveCategory() {
    const postUrl = $('#form-category').attr('action');
    let input = $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'csrf_test_name')
                        .val(getCookie('csrf_cookie_name'));
    $('#form-category').append($(input));
    $.ajax({
        url: postUrl,
        type: "POST",
        data: $('#form-category').serialize(),
        cache: false,
        success: function(result) {
            $('#p_category').val('');
            let data = $.parseJSON(result);
            msgBoxModal(data[0], data[1]);

        }
    });
}
