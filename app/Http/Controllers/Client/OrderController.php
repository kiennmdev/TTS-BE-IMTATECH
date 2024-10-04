<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Events\OrderCreated;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function view()
    {
        if (!session('cart')) {

            return redirect()->route('cart.list');
        } else {

            $cart = session('cart');

            $totalAmount = session('total_amount');

            return view('client.checkout', compact('cart', 'totalAmount'));
        }
    }

    public function create(Request $request)
    {
        // dd(session('cart'));
        // dd($request->toArray());
        $validate = $request->validate([
            "user_name" => ["required"],
            "user_address" => ["required"],
            "user_email" => ["required", 'email'],
            "user_phone" => ["required"]
        ]);

        // dd($request->except('_token', 'payment_method'));

        if ($request->payment_method == 'momo') {

            session()->put('order', $request->except('_token'));
            return redirect()->route('payment.momo');

        } else if ($request->payment_method == 'cod'){

            try {
                DB::transaction(function () use ($request) {

                    $dataItem = [];

                    foreach (session('cart') as $variantID => $item) {

                        $dataItem[] = [
                            'product_variant_id' => $variantID,
                            'quantity' => $item['quantity_purchase'],
                            'product_name' => $item['product']['name'],
                            'product_sku' => $item['product']['sku'],
                            'product_img_thumbnail' => $item['image'],
                            'product_price_regular' => $item['price_regular'],
                            'product_price_sale' => $item['price_sale'],
                            'variant_size_name' => $item['size']['name'],
                            'variant_color_name' => $item['color']['name'],
                        ];
                    }

                    if (Auth::check()) {

                        $order = Order::query()->create([
                            'user_id' => Auth::user()->id,
                            'user_name' => $request->user_name,
                            'user_email' => $request->user_email,
                            'user_phone' => $request->user_phone,
                            'user_address' => $request->user_address,
                            'discount' => $request->discount ?? 0,
                            'total_price' => $request->total_price,

                        ]);
                    } else {

                        $user = User::query()->create([
                            'name' => $request->user_name,
                            'email' => $request->user_email,
                            'password' => bcrypt($request->user_email),
                            'phone' => $request->user_phone,
                            'address' => $request->user_address,
                            'is_active' => false,
                        ]);

                        $order = Order::query()->create([
                            'user_id' => $user->id,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'user_phone' => $user->phone,
                            'user_address' => $user->address,
                            'discount' => $request->discount ?? 0,
                            'total_price' => $request->total_price,
                        ]);
                    }

                    foreach ($dataItem as $item) {

                        $item['order_id'] = $order->id;

                        OrderItem::query()->create($item);
                    }

                    OrderCreated::dispatch(session('cart'), $order);
                });

                session()->forget(['cart', 'total_amount', 'coupon', 'order']);

                return redirect()->route('home')->with('success', 'Đặt hàng thành công');
            } catch (Exception $exception) {

                dd($exception);
            }
        }
    }

    public function detail(Order $order)
    {

        $orderItems  = Order::with('order_items')->find($order->id);

        return view('client.order-detail', compact('orderItems'));
    }

    public function canceledOrder(Order $order) {
        if ($order->status_order == "pending" || $order->status_order == "confirmed") {
            $order->update(['status_order' => 'canceled']);
        }
        return back();
    }

    public function addCoupon(Request $request)
    {
        $coupon = Coupon::query()->where('code', $request->coupon)->first();

        if ($coupon) {
            session()->put('coupon', $coupon);
        }

        return redirect()->route('checkout.view');
    }

    public function deleteCoupon()
    {
        session()->forget('coupon');

        return redirect()->route('checkout.view');
    }
}
