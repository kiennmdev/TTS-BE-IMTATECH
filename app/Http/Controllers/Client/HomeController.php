<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $newProducts = Product::with(['variants' => function ($query) {
            $query->select('product_id', DB::raw('MIN(price_regular) as min_price_regular'), DB::raw('MAX(price_regular) as max_price_regular'), DB::raw('MIN(price_sale) as min_price_sale'), DB::raw('MAX(price_sale) as max_price_sale'))
                  ->groupBy('product_id');
        }])->latest('id')->where('is_new', '=', true)->where('is_active', true)->limit(8)->get();

        $products = Product::with(['variants' => function ($query) {
            $query->select('product_id', DB::raw('MIN(price_regular) as min_price_regular'), DB::raw('MAX(price_regular) as max_price_regular'), DB::raw('MIN(price_sale) as min_price_sale'), DB::raw('MAX(price_sale) as max_price_sale'))
                  ->groupBy('product_id');
        }])->latest('id')->where('is_active', true)->limit(8)->get();

        $productBestSellers = Product::query()->with(['tags', 'variants' => function ($query) {
            $query->select('product_id', DB::raw('MIN(price_regular) as min_price_regular'), DB::raw('MAX(price_regular) as max_price_regular'), DB::raw('MIN(price_sale) as min_price_sale'), DB::raw('MAX(price_sale) as max_price_sale'))
                  ->groupBy('product_id');
        }])->where('is_hot_deal', true)->where('is_active', true)->latest('id')->limit(4)->get();

        $banners = Banner::query()->latest('id')->get();

        $currentDate = Carbon::now()->format('Y-m-d');

        $coupons = Coupon::query()->where('expiry', '>', $currentDate)->latest('id')->get();
        
        return view('client.home', compact('newProducts', 'products', 'productBestSellers', 'banners', 'coupons'));
    }
}
