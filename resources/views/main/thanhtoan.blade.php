@extends('layout.master')
@section('content')
@section('title')
    <title>Thanh toán</title>
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
                <a href="#">Thanh toán</a>
            </div>
            <div class="img-content">
                <img src="{{asset('bonsai/images/gioithieu.jpg')}}" class="img-fluid" alt="Responsive image">
            </div>

        </div>
        <div class="new">
            <div class="present-pay">
                <i class="fab fa-pagelines">
                    <h5 style="margin-left: 20px">Thanh toán</h5>
                </i>
            </div>

        </div>
        <div class="container-fluid">
            <form action="{{route('save_checkout')}}" method="post">
                @csrf
            <div class="row">

                <div class="col-md-7">
                    <div class="">
                        <b style="font-family: sans-serif">THANH TOÁN VÀ GIAO HÀNG</b>
                    </div>
                    <div style="margin-top: 15px">
                        <b>Họ và tên *</b>
                    </div>
                    <div style="margin-top: 5px">
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nhập họ tên của bạn">
                    </div>
                    <div style="margin-top: 15px">
                        <b>Địa chỉ *</b>
                    </div>
                    <div style="margin-top: 5px">
                        <input type="text" name="address" class="form-control" id="exampleInputEmail1"  placeholder="Nhập địa chỉ của bạn">
                    </div>
                    <div style="margin-top: 15px">
                        <b>Số điện thoại *</b>
                    </div>
                    <div style="margin-top: 5px">
                        <input type="number" name="phone" class="form-control" id="exampleInputEmail1"  placeholder="Nhập SĐT của bạn">
                    </div>
                    <div style="margin-top: 15px">
                        <b>Email *</b>
                    </div>
                    <div style="margin-top: 5px">
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"  placeholder="Nhập email của bạn">
                    </div>
                    <div style="margin-top: 15px">
                        <b style="font-family: sans-serif">THÔNG TIN BỔ SUNG</b>
                    </div>
                    <div class="form-group" style="margin-top: 5px">
                        <label for="exampleFormControlTextarea1">Ghi chú đơn hàng</label>
                        <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>


                <div class="col-md-5" style="border: 2px solid #1e7e34">
                    <div class="" style="padding: 18px 8px">
                        <b style="font-family: sans-serif">ĐƠN HÀNG CỦA BẠN</b>
                    </div>
{{--                    <div class="" style="font-size: 15px; margin-left: 7px; border-bottom: 2px solid #b2b4b691; padding-bottom: 10px">--}}
{{--                        <b>SẢN PHẨM</b>--}}
{{--                        <b style="margin-left: 280px">TẠM TÍNH</b>--}}
{{--                    </div>--}}
                    <table class="table table-payment">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">đơn giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach((array)$carts as $id => $cart)
                            @php
                                $total += $cart['price'] * $cart['quantity'];
                            @endphp
                        <tr>
                            <th scope="row">TM{{$id}}</th>
                            <td>{{$cart['name']}}</td>
                            <td>{{number_format($cart['price'])}}đ</td>
                            <td>{{$cart['quantity']}}</td>
                            <td>{{number_format($cart['price'] * $cart['quantity'])}}đ</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="float: right">
                        <strong>Tổng tiền: {{number_format($total)}}đ</strong>
                    </div><br/>
                    <div style="color: red">
                        <strong>* Lưu ý: Thanh toán khi nhận hàng</strong>
                    </div>
                    <button style="margin-left: 15px; margin-top: 30px;" type="submit" name="send_order" class="btn btn-warning"><b>ĐẶT HÀNG</b></button>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<!-- End Section -->
@endsection
