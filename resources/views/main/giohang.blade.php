@extends('layout.master')
@section('content')
@section('title')
    <title>Giỏ hàng</title>
@endsection
<section class=" section-container">
    <div class="row row-section">
        <div class="l-content">
            <div class="null">
            </div>

        </div>
        <div class="r-content">
            <div class="little-a">
                <a href="{{route('index')}}">
                    Trang chủ
                </a>
                >
                <a href="#">Giỏ hàng</a>
            </div>
            <div class="img-content">
                <img src="{{asset('bonsai/images/gioithieu.jpg')}}" class="img-fluid" alt="Responsive image">
            </div>

        </div>
        <div class="new_cart">
            <div class="present">
                <i class="fab fa-pagelines">
                    <h5>Giỏ hàng</h5>
                </i>
{{--                <img src="{{asset('bonsai/images/icon_section1.png')}}">--}}
            </div>

        </div>
        <div class="cart_wrapper" style="margin-top: 33px; width: 100%;">
            @include('main.components.cart_component')
        </div>
    </div>
</section>
<!-- End Section -->
<script>
    function cartUpdate(event) {
        event.preventDefault();
        let urlUpdateCart = $('.update_cart_url').data('url');
        let id = $(this).data('id');
        let quantity = $(this).parents('tr').find('input.quantity').val();
        let inventory = $(this).parents('tr').find('input.inventory').val();
        if (parseInt(quantity) > parseInt(inventory)){
            alert('số luơng đã đat giới hạn')
        }
        else {
            $.ajax({
                type: "GET",
                url: urlUpdateCart,
                data: {id:id, quantity: quantity},
                success: function (data) {
                    if (data.code === 200){
                        $('.cart_wrapper').html(data.cart_component);
                        alertify.error('Cập nhật giá thành công!');
                    }

                },
                error: function () {

                }
            });
        }
    }
    function cartDelete(event) {
        event.preventDefault();
        let urlDelete = $('.cart').data('url');
        let id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: urlDelete,
            data: {id:id},
            success: function (data) {
                if (data.code === 200){
                    $('.cart_wrapper').html(data.cart_component);
                    alertify.error('Xoá sản phẩm thành công!');
                }
            },
            error: function () {

            }
        });
    }
    $(function () {
       $(document).on('click','.cart-update',cartUpdate);
        $(document).on('click','.cart-delete',cartDelete);
    });
</script>

@endsection
