@extends('layout.master')
@section('content')
@section('title')
    <title>Tìm kiếm</title>
@endsection
<section class=" section-container">
    <div class="row row-section">
        <div class="l-content">
            <div class="null">
            </div>
            <div class="newfeed">
                <h3>Tin mới</h3>
                <ul>
                    @foreach($hotInfos as $info)
                        <li>
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="http://localhost:8001{{$info->images}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card- body card1">
                                        <a href="{{route('tintucchitiet',['id'=>$info->id])}}">
                                            <h5 class="card-title">{{$info->titles}}</h5>
                                        </a>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <i class="far fa-clock">{{$info->created_at->format('d-m-Y')}}</i>
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="r-content">
            <div class="little-a">
                <a href="{{ route('index') }}">
                    Trang chủ
                </a>
                >
                <a>Tìm kiêm: {{$key}}</a>
            </div>
            <div class="img-content-sp">
                <img src="{{asset('bonsai/images/gioithieu.jpg')}}" class="img-fluid-sp" alt="Responsive image">
            </div>
            <div class="new">
                <div class="present">
                    <i class="fab fa-pagelines">
                        <h5>Tìm kiếm: {{$key}}</h5>
                    </i>
                </div>
{{--                <img src="{{asset('bonsai/images/icon_section1.png')}}">--}}
            </div>

            <div class=" product-list1">
                <div class="row list1 list11">

                    @foreach($products as $product)

                        <div style="max-width: 25%;min-width: 25%;" class="col col-list">
                            <div class="card">
                                <img src="http://localhost:8001{{$product->feature_image_path}}" class="card-img-top" alt="...">
                                <div class="show-infor">

                                    <span>{!! Str::limit($product->description,140) !!}</span>
                                    <br>
                                    <a href='{{route("sanphamchitiet",['id'=>$product->id])}}' class="btn btn-light">Chi tiết</a>

                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{Str::limit($product->name, 20)}}</h5>
                                    <p class="card-text"><small class="text-muted">{{number_format($product->price)}}đ</small></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{$products->links()}}
        </div>
    </div>
</section>
@endsection
