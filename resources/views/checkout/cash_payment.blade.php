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
        <div class="">
            <div class="">
                    <h5 style="margin-left: 20px"><b>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất!</b></h5>
            </div>
        </div>

    </div>
</section>
<!-- End Section -->
@endsection
