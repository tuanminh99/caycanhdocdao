@extends('layout.master')
@section('content')
@section('title')
    <title>Trang chủ</title>
@endsection
    <!-- Section -->
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
                </div>
                <div class="img-content-sp">
                    <img src="{{asset('bonsai/images/gioithieu.jpg')}}" class="img-fluid-sp" alt="Responsive image">
                </div>
            </div>
        </div>

        @foreach($cate as $c)
        <div class=" new_product">
            <div class="ban_chay">
                <i class="fab fa-pagelines">
                    <h5>{{$c->name}}</h5>
                </i>
            </div>
{{--            <img src="{{asset('bonsai/images/icon_section1.png')}}">--}}
            <div class="more">
                <a href="{{route('loaisanpham',['slug'=>$c->slug])}}">Xem tất cả>></a>
            </div>
        </div>
        <div class="row product">
            <div class="product-content">
                <!-- <img src="{{asset('bonsai/images/banner1.jpg')}}"> -->
            </div>
            <div class=" product-list">
                <div class="row list1">
                    @foreach($c->products->take(8) as $p)
                    <div class="col col-list">
                        <div class="card">
                            <img  class="img-index" src="http://localhost:8000{{$p->feature_image_path}}" class="card-img-top" alt="...">
                            <div class="show-infor1">
                                <!-- <span>{!!Str::limit($p->description,200)!!}</span>
                                <br/>
                                <a href="{{route('sanphamchitiet',['id'=>$p->id])}}" type="button" class="btn btn-light">Chi tiết</a>
{{--                                <button type="button" class="btn btn-light">Mua ngay</button>--}} -->
                            </div>
                            <div class="card-body">
                                <h5 title="{{$p->name}}" class="card-title">{{Str::limit($p->name,20)}}</h5>
                                <p class="card-text"><small class="text-muted">{{number_format($p->price)}}đ</small></p>
                                <a class="eye" href="{{route('sanphamchitiet',['id'=>$p->id])}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </section>
    <!-- End section -->

    <!-- Result  -->
    <div class="result">
        <div class="result-content">
            <h2>TIN TỨC</h2>
        </div>
        <div class="list-result ">
            <div class="row row-container">
                @foreach($hotInfos as $info)
                <div class="col-3">
                    <div class="card">
                        <img src="http://localhost:8000{{$info->images}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 title="{{$info->titles}}" class="card-title"><a href='{{route("tintucchitiet",['id'=>$info->id])}}'>{{Str::limit($info->titles,30)}}</a></h5>
                            <p class="card-text">
                                <small class="text-muted">
                                    {!!Str::limit($info->brief)!!}
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="last-result">
            <button type="button" class="btn btn-outline-success"><a href='{{route("tintuc")}}'>Xem thêm</a></button>
        </div>
    </div>
    <!-- End result  -->

    <!-- Comment -->
    <div class="comment">
        <div class="content-comment">
            <h2>Ý kiến khách hàng</h2>
        </div>
        <div class="d-lg-flex flex-sm-row  justify-content-lg-between justify-content-sm-center customer-review-list">
            @foreach($contacts as $c)
            <div class="customer-review-item">
                <div class="customer-review-message">
                    <div class="icon">
                        <img src="{{ asset('bonsai/images/icon.png') }}" alt="">
                    </div>
                    <p>{!! \Illuminate\Support\Str::limit($c->contents, 200)!!}</p>
                </div>
                <div class="customer-review-info">
                    <img src="{{ asset('bonsai/images/avatar.png') }}" alt="">
                    <div class="customer-review-name">
                        <b>{{$c->name}}</b>
                        <p>{{$c->address}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- End Comment -->
<script>
    $()
</script>
@endsection

