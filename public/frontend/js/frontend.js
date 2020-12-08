$(document).ready(function () {
    $('.header-drop').mouseenter(function () {
        $(this).addClass("open")
    });
    $('.header-drop').mouseleave(function () {
        $(this).removeClass("open")
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#item-qty").change(function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let qty = $(this).val();
        $.ajax({
            type: 'PUT',
            url: '/cart/update/' + id,
            data: {
                qty: qty
            },
            success: function (res) {
                if(!res.error){
                    console.log(res.message)
                }else {
                    console.log(res.message)
                }
            }
        })
    });

    $('#productsTable').dataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/products/get-data',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'category', name: 'category' },
            { data: 'image', name: 'image' },
            { data: 'origin_price', name: 'origin_price' },
            { data: 'sale_price', name: 'sale_price' },
            { data: 'discount_percent', name: 'discount_percent' },
            { data: 'content', name: 'content' },
            { data: 'action' },
        ]
    })
});
