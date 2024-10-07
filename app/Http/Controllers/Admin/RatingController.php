<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    const PATH_VIEW = 'admin.ratings.';

    public function index() {

        $products = Product::with(['ratings'])->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('products'));
    }

    public function detail(string $id) {

        $product = Product::query()->where('id', $id)->first();
        
        $ratings = Rating::query()->with(['user'])->where('product_id', $id)->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('ratings', 'product'));
    }
}
