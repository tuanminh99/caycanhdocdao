<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Contact;
use App\Info;
use App\Intro;
use App\Product;
use App\Setting;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;

class Layout_Controller extends Controller
{
    public function master(){
        return view('layout.master');
    }
    public function index(){
        $cate = Category::all();
        $hotInfos = Info::inRandomOrder()->limit(4)->get();
        $contacts = Contact::inRandomOrder()->orderBy('created_at')->limit(3)->get();
        $products = Product::paginate(8);
//        $sellings = Product::orderBy('purchases', 'desc')->limit(4)->get();
        return view('main.index', compact('cate','hotInfos','contacts','products'));
    }
    public function gioithieu(){
        $intros = Intro::all();
        $cate = Category::all();
        $hotInfos = Info::inRandomOrder()->limit(3)->get();
        return view('main.gioithieu',compact('intros','hotInfos','cate'));
    }

    public function tintuc(){
        $infos = Info::paginate(3);
        $cate = Category::all();
        $hotInfos =Info::inRandomOrder()->limit(3)->get();
        return view('main.tintuc',compact('infos','hotInfos','cate'));
    }
    public function lienhe(){

        $hotInfos = Info::inRandomOrder()->limit(3)->get();
        $cate = Category::all();
        return view('main.lienhe',compact('hotInfos','cate'));
    }

    public function lienhes(Request $request){
        $contacts = Contact::create([
            'name'=> $request->name,
            'email'=> $request->mail,
            'address'=> $request->address,
            'phone'=> $request->phone,
            'contents'=>$request->contents
        ]);
        return redirect() -> route('index');
    }

    public function sanpham(){
        $products = Product::paginate(16);
        $cate = Category::all();
        $hotInfos = Info::inRandomOrder()->limit(3)->get();
        return view('main.sanpham',compact('products','hotInfos','cate'));
    }
    public function sanphamchitiet($id){
        $product = Product::where('id',$id)->first();
        $productRelated = Product::where('category_id',$product->category_id)->inRandomOrder()->whereNull('deleted_at')->limit(4)->get();
        $cate = Category::all();
        return view('main.sanphamchitiet',compact('cate','product','productRelated'));
    }
    public function loaisanpham($slug){
        $hotInfos = Info::inRandomOrder()->limit(3)->get();
        $cate1 = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $cate1->id)->paginate(5);
        $cate = Category::all();
        return view('list_categories.index',compact('hotInfos','cate', 'products', 'cate', 'cate1'));
    }

    public function timkiem(Request $request){
        $hotInfos = Info::inRandomOrder()->limit(3)->get();
        $products = Product::where('name', 'like', '%'.$request->key.'%')->paginate(4);
        $cate = Category::all();
        $key = $request->key;
        return view('main.timkiem',compact('hotInfos','categories', 'products', 'cate', 'key'));
    }

    public function tintucchitiet($id){
        $infos = Info::all();
        $hotInfos =Info::inRandomOrder()->limit(3)->get();
        $cate = Category::all();
        $inf = Info::find($id);

        return view('list_categories.tintucchitiet',compact('hotInfos','cate','infos', 'inf'));
    }

    public function giohang(){
        $cate = Category::all();
        $carts = session()->get('cart');
        return view('main.giohang',compact('cate','carts'));

    }
    public function addcart($id){
        $products = Product::find($id);
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            if ( $cart[$id]['quantity'] < $products->stock)
            {
                $cart[$id]['quantity'] = $cart[$id]['quantity']+1;
            }
            else {
                return response()->json([
                    'code' => 500,
                    'message' => 'error'
                ], 500);
            }
        }
        else {
            $cart[$id] = [
                'name' => $products->name,
                'price' => $products->price,
                'quantity' => 1,
                'image' => $products->feature_image_path,
                'inventory'=> $products->stock
            ];
        }
        session()->put('cart',$cart);
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], 200);
    }
    public function updatecart(Request $request) {
        if ($request->id && $request->quantity) {
            $carts = session()->get('cart');
            $carts[$request->id]['quantity'] = $request->quantity;
            session()->put('cart',$carts);
            $carts = session()->get('cart');
            $cartComponent = view('main.components.cart_component',compact('carts'))->render();
            return response()->json(['cart_component'=>$cartComponent, 'code'=> 200],200);
        }
    }
    public function deletecart(Request $request) {
        if ($request->id) {
            $carts = session()->get('cart');
            unset($carts[$request->id]);
            session()->put('cart',$carts);
            $carts = session()->get('cart');
            $cartComponent = view('main.components.cart_component',compact('carts'))->render();
            return response()->json(['cart_component'=>$cartComponent, 'code'=> 200],200);
        }
    }
    public function thanhtoan(){
        $cate = Category::all();
        $carts = session()->get('cart');
        return view('main.thanhtoan',compact('cate','carts'));
    }
    public function cash_payment() {
        $cate = Category::all();
        return view('checkout.cash_payment',compact('cate'));
    }

    public function save_checkout(Request $request) {
        $dataShippings = array();
        $dataShippings['shipping_name'] = $request->name;
        $dataShippings['shipping_email'] = $request->email;
        $dataShippings['shipping_address'] = $request->address;
        $dataShippings['shipping_phone'] = $request->phone;
        $dataShippings['shipping_note'] = $request->note;
        $shipping_id = DB::table('shippings')->insertGetId($dataShippings);
        Session::put('shipping_id',$shipping_id);

        //insert payment
        $payment_data = array();
        $payment_data['payment_status']= 'Đang chờ xử lý';
        $payment_id = DB::table('payments')->insertGetId($payment_data);

        //insert order
//        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        $order_data = array();
        $carts = session()->get('cart');
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $total = 0;
            foreach($carts as $id => $cart) {
                $total += $cart['price'] * $cart['quantity'];
            }
        $order_data['order_total']= $total;
        $order_data['order_status']= 'Đang chờ xử lý';

        $order_id = DB::table('orders')->insertGetId($order_data);

        //insert order detail
        foreach ($carts as $id => $cart) {
            $product = Product::find($id);

            $order_d_data = array();
            $order_d_data['order_id']= $order_id;
            $order_d_data['product_id']=$id;
            $order_d_data['product_name']= $cart['name'];
            $order_d_data['product_price']= $cart['price'];
            $order_d_data['product_quantity']= $cart['quantity'];
            DB::table('order_details')->insert($order_d_data);
            $product->update([
                'stock' => $product->stock - (int)$cart['quantity']
            ]);
        }
        Session::forget('cart');
        return redirect() -> route('cash_payment');
    }

    public function login_customer(Request $request) {
        $email = $request->email;
        $password = md5($request->password);
        $result = DB::table('customers')->where('customer_email',$email)->where('password',$password)->first();
        if ($result){
            Session::put('customer_id',$result->customer_id);
            return redirect() ->route('thanhtoan');
        }
        else {
            return redirect() ->route('login_checkout')->with(['mess'=>'a']);
        }

    }
    public function login_checkout() {
        return view('checkout.login_checkout');
    }
    public function logout_checkout() {
       Session::flush();
       return redirect() -> route('login_checkout');
    }
    public function signup_checkout() {
        return view('checkout.signup_checkout');
    }
    public function add_customer(Request $request) {
        $data = array();
        $data['customer_name'] = $request->name;
        $data['customer_email'] = $request->email;
        $data['password'] = md5($request->password);
        $data['customer_phone'] = $request->phone;

        $customer_id = DB::table('customers')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->name);
        return redirect() -> route('login_checkout');
    }

}
