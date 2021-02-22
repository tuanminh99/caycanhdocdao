@extends('layout.master')
@section('content')
@section('title')
    <title>Tin tức chi tiết</title>
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
                                    <img src="http://localhost:8000{{$info->images}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card- body card1">
                                        <a href="{{route('tintucchitiet', ['id'=>$info->id])}}">
                                            <h5 class="card-title">{{$info->titles}}</h5>
                                        </a>
                                        <p class="card-text">
                                            <!-- <small class="text-muted">
                                                <i class="far fa-clock">{{$info->created_at->format('d-m-Y')}}</i>
                                            </small> -->
                                            <small class="text-muted">
                                                {!!Str::limit($info->brief)!!}
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
                    <a href="index.html">
                        Trang chủ
                    </a>
                    >
                    <a href="tintuc.html">Tin Tức</a>
                </div>
                <div class="img-content">
                    <img src="{{asset('bonsai/images/banner.png')}}">
                </div>
                <div class="new">
                    <div class="present">
                        <i class="fab fa-pagelines">
                            <h5>Tin Tức</h5>
                        </i>
                    </div>
{{--                <img src="{{asset('bonsai/images/icon_section1.png')}}">--}}
                </div>
                <div>

                    <img style="width: 250px; height: 250px;" src="http://localhost:8000{{$inf->images}}"/>
                    <p>
                        <h3>{{$inf->titles}}</h3>
                        {!! $inf->contents !!}
                    </p>

                </div>
        </div>
    </div>
</section>
@endsection
