<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function rating(Request $request) {

        $data = $request->except('_token', 'product_variant_id', 'order_item_id');
        $productVariant = ProductVariant::query()->where('id', $request->product_variant_id)->first('product_id');
        $orderItem = OrderItem::query()->where('id', $request->order_item_id)->first();

        $data += [
            'user_id' => Auth::user()->id,
            'product_id' => $productVariant->product_id
        ];

        try {
            DB::beginTransaction();

            $rating = Rating::query()->create($data);

            DB::commit();

            $orderItem->update(
                ['is_rating' => true]
            );

            return back()->with('success', 'Đánh giá thành công!');

        } catch (\Exception $exception) {
            
            return $exception->getMessage();
        }
    }
}
