<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{asset('bonsai/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('bonsai/css/all.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('bonsai/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('bonsai/css/style_sanPham.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('bonsai/css/style_lienHe.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('bonsai/css/style_tintuc.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('bonsai/css/style_trang_chu.css')}}">

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

{{--    seo meta--}}
	<meta charset="utf-8">
	<meta name="viewport" content="width = device-width, initial-scale = 1">
    @yield('title')
</head>
<body>
<script type="text/javascript" src="{{asset('bonsai/js/jquery-3.5.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bonsai/js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bonsai/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bonsai/js/jsSanPham.js')}}"></script>
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

	<!-- Header -->
	<header>
		<!-- Header -->
		<div class="first-header">
			<div class="container">

				<div class="row menu-header">

					<div class="col-sm-5 col-lg-5 col-5 p-img">
                        <i class="fas fa-phone"></i>
						<p>Hotline: <b>{{getConfigValue('Hotline')}}</b></p>
					</div>
					<div class="col-sm-1 col-lg-1 col-1 f-img">
						<a href="{{getConfigValue('fb')}}" target="_blank">
						<img src="{{ asset('bonsai/images/f.png') }}">
						</a>
					</div>
					<div class="col-sm-1 col-lg-1 col-1 t-img">
						<a href="{{getConfigValue('Twitter')}}" target="_blank">
						<img src="{{ asset('bonsai/images/t.png') }}">
						</a>
					</div>
					<div class="col-sm-1 col-lg-1 col-1 g-img">
						<a href="#">
						<img src="{{ asset('bonsai/images/g.png') }}">
						</a>
					</div>
					<div class="col-sm-1 col-lg-1 col-1 y-img">
						<a href="{{getConfigValue('yt')}}" target="_blank">
						<img src="{{ asset('bonsai/images/y.png') }}">
						</a>
					</div>
				</div>

                <div class="row login">
                    <div class="col-sm-5 col-lg-5 col-5">
                        <?php
                            $customer_id = Session::get('customer_id');
                            if ($customer_id != NULL) {
                        ?>
                            <i class="fas fa-sign-out-alt"></i>
                            <a href="{{ route('logout_checkout')}}">Đăng xuất</a>
                            <?php
                            }
                            else{
                                ?>
                            <i class="fas fa-sign-in-alt m-r-3"></i>
                            <a href="{{ route('login_checkout')}}">Đăng nhập</a>
                            <?php
                            }
                            ?>

                        <i class="fas fa-user-plus m-l-22"></i>
                        <a href="{{ route('signup_checkout')}}">Đăng ký</a>


                    </div>
                </div>
			</div>
		</div>
		<div class="container second-header">
			<div class="row">
				<div class=" col-2 col-lg-2 col-sm-5 ">
                    <a href="{{ route('index')}}"><img src="{{ asset('bonsai/images/logo.png') }}"></a>
				</div>
				<form method="get" action="{{route('timkiem')}}" class=" col-4 col-lg-4 col-sm-5 search-box">
					<div class="input-group mb-3">
					  <input name="key" type="text" class="form-control" placeholder="Tìm kiếm">
						<div class="input-group-append">
						    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
						    	<i class="fas fa-search"></i>
						    </button>
					  	</div>
					</div>
				</form>
				<div class=" col-3 col-lg-3 col-sm-5 hand">
					<img src="{{ asset('bonsai/images/hand1.png') }}">
					<p>
						CAM KẾT CHẤT LƯỢNG DỊCH VỤ SẢN PHẨM
					</p>
				</div>
				<div class=" col-3 col-lg-3 col-sm-5 hand">
					<img src="{{ asset('bonsai/images/hand2.png') }}">
					<p>VẬN CHUYỂN NỘI THÀNH MIỄN PHÍ</p>
				</div>
			</div>
		</div>
	</header>
		<!-- End Header -->

		<!-- Nav -->
	<nav>
		<div class="nav">
				<ul>
					<li>
						<div class="dropdown">
						  <span class="dropbtn">
						  	<i class="fas fa-list"></i>Danh mục sản phẩm
						  </span>
						  <div class="dropdown-content">
                              @foreach($cate as $c)
						  <a href="{{ route('loaisanpham', ['slug'=>$c->slug]) }}">
						  	<img src="{{ asset('bonsai/images/icon_mnuL.png') }}">
						  	<p>{{$c->name}}</p>
						  </a>
                              @endforeach
						  </div>
						</div>
					</li>
					<li>
						<div class="menu-nav">
							<a href="{{ route('index') }}">Trang chủ</a>
						</div>
					</li>
					<li>
						<div class="menu-nav">
							<a href="{{ route('gioithieu') }}">Giới thiệu</a>
						</div>
					</li>
					<li>
						<div class="menu-nav">
							<a href="{{ route('sanpham') }}">Sản phẩm</a>
						</div>
					</li>
					<li>
						<div class="menu-nav">
							<a href="{{ route('tintuc') }}">Tin tức</a>
						</div>
					</li>
					<li>
						<div class="menu-nav">
							<a href="{{ route('lienhe') }}">Liên hệ</a>
						</div>
					</li>
                    <li style="margin-left: 20px">
                        <div class="menu-nav">
                            <a href="{{route('giohang')}}"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </li>
				</ul>
		</div>
	</nav>
        <!-- End Nav -->

    @yield('content')


    <!-- Footer -->
	<footer>
		<div class="f-footer">
			<div class="row ff-footer">
				<div class="left-footer">
				<ul>
					<li>
						<div class="menu-nav">
							<a href="{{ route('index')}}">Trang chủ</a>
						</div>
					</li>
					<li>
						<div class="menu-nav">
							<a href="{{ route('gioithieu') }}">Giới thiệu</a>
						</div>
					</li>
					<li>
						<div class="menu-nav">
							<a href="{{ route('sanpham') }}">Sản phẩm</a>
						</div>
					</li>
					<li>
						<div class="menu-nav">
							<a href="{{ route('tintuc') }}">Tin tức</a>
						</div>
					</li>
					<li>
						<div class="menu-nav">
							<a href="{{ route('lienhe') }}">Liên hệ</a>
						</div>
					</li>
				</ul>
			</div>
			<div class="right-footer">
				<p>Kết nối với chúng tôi</p>
                <a href="{{getConfigValue('fb')}}" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="{{getConfigValue('Twitter')}}" target="_blank">
                    <i class="fab fa-twitter-square"></i>
                </a>
                <a href="#" target="_blank">
                    <i class="fab fa-google-plus-g"></i>
                </a>
                <a href="{{getConfigValue('yt')}}" target="_blank">
                    <i class="fab fa-youtube-square"></i>
                </a>
			</div>
			</div>
		</div>
		<div class="e-footer">
			<div class="row footer-container">
				<div class="col l-img-footer">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d878.6218985405725!2d105.7476591195976!3d21.05389455344456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345509f10f4b6b%3A0xb3e638ca9b7850ec!2zQsawxqHMiWkgRGnDqsyDbiBWw6JuIFRodcyJeQ!5e0!3m2!1svi!2s!4v1602076947039!5m2!1svi!2s" width="307" height="161" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				</div>
				<div class="col bt-footer">
					<h5>Nhà vườn Vân Thủy</h5>
					<br/>
					<i class="fas fa-map-marker-alt"> </i> Địa chỉ: {{getConfigValue('Địa chỉ')}}
					<br/>
					<i class="fas fa-phone-alt"> </i> Hotline: {{getConfigValue('Hotline_footer')}}
					<br/>
					<i class="far fa-envelope"> </i> Email: {{getConfigValue('Email')}}
					<br/>
					<i class="fas fa-globe-africa"> </i> Website: {{getConfigValue('Website')}}
					<br/>
					<i class="far fa-copyright"> </i> Copyright {{getConfigValue('Copyright')}}
				</div>
				<div class="col r-img-footer">
{{--					<img src="{{ asset('bonsai/images/fb.jpg') }}">--}}
				</div>
			</div>
		</div>
	</footer>
