<?php

namespace App\Http\Controllers;

use App\Order;
use App\productImage;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private $order;
    use DeleteModelTrait;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index() {
        $all_orders = DB::table('orders')
            ->join('customers','orders.customer_id','=','customers.customer_id')
            ->select('orders.*','customers.customer_name')
            ->orderby('orders.order_id','desc')->get();
        return view('admin.donhang.manage_order',compact('all_orders'));
    }
    public function view($id) {
        $order_by_id = DB::table('orders')
            ->join('customers','orders.customer_id','=','customers.customer_id')
            ->join('shippings','orders.shipping_id','=','shippings.shipping_id')
            ->join('order_details','orders.order_id','=','order_details.order_id')
            ->select('orders.*','customers.*','shippings.*','order_details.*')->first();

        return view('admin.donhang.view',compact('order_by_id'));
    }
    public function delete($id) {
        try {
            Order::where('order_id', $id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        }
        catch(\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage(). 'Line: '. $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
