<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function productList() {

        $key = request()->search;

        $products = Product::with(['variants' => function ($query) {
            $query->select('product_id', DB::raw('MIN(price_regular) as min_price_regular'), DB::raw('MAX(price_regular) as max_price_regular'), DB::raw('MIN(price_sale) as min_price_sale'), DB::raw('MAX(price_sale) as max_price_sale'))
                  ->groupBy('product_id');
        }])->where('is_active', true)->where('name', 'like', "%$key%")->latest('id')->paginate(9);

        // dd($products->toArray());

        return view('client.shop', compact('products'));
    }

    public function productDetail(string $slug) {
        
        $product = Product::query()->with(['catalogue', 'galleries','tags', 'variants' => function ($query) {
            $query->select('product_id', DB::raw('MIN(price_regular) as min_price_regular'), DB::raw('MAX(price_regular) as max_price_regular'), DB::raw('MIN(price_sale) as min_price_sale'), DB::raw('MAX(price_sale) as max_price_sale'))
                  ->groupBy('product_id');
        }])->where('slug', '=', $slug)->firstOrFail();

        $ratings = Rating::query()->with("user")->where('product_id', $product->id)->latest('id')->get();

        $comments = Comment::query()->with('user')->where('product_id', $product->id)->get();
        
        $productVariants = ProductVariant::with(['color', 'size'])->where("product_id", $product->id)->get();

        $colors = [];
        $sizes = [];
        $priceTableVariants = [];

        foreach ($productVariants as $variant) {
            $priceTableVariants[$variant->product_size_id][$variant->product_color_id] = $variant->price_sale > 0 ? "$variant->price_regular - $variant->price_sale" : "$variant->price_regular";
            if(!array_key_exists("color_".$variant->color->id, $colors)){
                $colors["color_".$variant->color->id]['id'] = $variant->color->id;
                $colors["color_".$variant->color->id]['name'] = $variant->color->name;
                $colors["color_".$variant->color->id]['code'] = $variant->color->code;
            }
            if(!array_key_exists("size_".$variant->size->id, $sizes)){
                $sizes["size_".$variant->size->id]['id'] = $variant->size->id;
                $sizes["size_".$variant->size->id]['name'] = $variant->size->name;
            }
        }

        $colors = json_decode(json_encode($colors));
        $sizes = json_decode(json_encode($sizes));

        $productBestSellers = Product::with(['variants' => function ($query) {
            $query->select('product_id', DB::raw('MIN(price_regular) as min_price_regular'), DB::raw('MAX(price_regular) as max_price_regular'), DB::raw('MIN(price_sale) as min_price_sale'), DB::raw('MAX(price_sale) as max_price_sale'))
                  ->groupBy('product_id');
        }])->where('is_hot_deal', true)->latest('id')->limit(8)->get();
        
        return view('client.product-detail', compact('ratings','product', 'colors', 'sizes', 'priceTableVariants', 'comments', 'productBestSellers'));
    }

    public function productCatalogue(string $id) {

        $products = Product::query()->where('catalogue_id', '=', $id)->latest('id')->paginate(9);

        return view('client.shop', compact('products'));
    }
}
