<div class="cart" data-url="{{route('deletecart')}}">
<div class="container">
    <div class="col-md-12">
        <table class="table table-light update_cart_url" data-url="{{route('updatecart')}}">
            <thead>
            <tr style="background-color: #6c757d66">
                <th scope="col">ID</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Ảnh</th>
                <th scope="col">giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(Session::get('cart')==true)
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
                    <td><img src="http://localhost:8000{{$cart['image']}}" style="width: 80px; height: 60px;"></td>
                    <td>{{number_format($cart['price'])}}đ</td>
                    <td>
                        <input type="number" value="{{$cart['quantity']}}" min="1" class="quantity">
                    </td>
                    <input type="hidden" value="{{$cart['inventory']}}" class="inventory">
                    <td>{{number_format($cart['price'] * $cart['quantity'])}}đ</td>
                    <td>
                        <a href="#"
                           class="btn btn-primary cart-update"
                           data-id="{{$id}}"
                        >
                            Cập nhật
                        </a>
                        <a href="#"
                           class="btn btn-danger cart-delete"
                           data-id="{{$id}}"
                        >
                            Xoá
                        </a>
                    </td>
                </tr>
            @endforeach
            <div class="total-price">
                Tổng cộng:
                <strong>
                    <span>{{number_format($total)}}đ</span>
                </strong>
            </div>
            <div class="button-payment">
                <?php
                $customer_id = Session::get('customer_id');
                if ($customer_id != NULL) {
                ?>
                <button type="button" class="btn btn-warning"><a href="{{route('thanhtoan')}}">Thanh toán</a></button>
                <?php
                }
                else{
                ?>
                <button type="button" class="btn btn-warning"><a href="{{route('login_checkout')}}">Thanh toán</a></button>
                <?php
                }
                ?>
                <button type="button" class="btn btn-warning"><a href="{{route('sanpham')}}">Mua thêm sản phẩm</a></button>
            </div>
            @else
                <tr>
                    <td>
                @php
                    echo 'Vui lòng thêm sản phẩm vào giỏ hàng!';
                @endphp
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

</div>

</div>
