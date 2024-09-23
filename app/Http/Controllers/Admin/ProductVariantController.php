<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductVariantController extends Controller
{
    const PATH_VIEW = "admin.product-variants.";

    public function index()
    {
        $productVariants = ProductVariant::with(['product','color','size'])->get();
        // dd($productVariants->toArray());

        return view(self::PATH_VIEW . __FUNCTION__, compact('productVariants'));
    }

    public function updateMulti(Request $request)
    {
        $data = $request->variant_update;

        try {
            DB::beginTransaction();

            foreach ($data as $id => $value) {
                if(isset($value['image'])) {
                    $value['image'] = Storage::put('products',$value['image']);
                }
                ProductVariant::query()->where('id', $id)->update($value);
            }

            DB::commit();

            return back();

        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

    }

    public function destroy(string $id) {
        $productVariant = ProductVariant::query()->where('id', $id)->first();
        // dd($productVariant);
        
        $productVariant->delete();

        if($productVariant->image !== null) {
            Storage::delete($productVariant->image);
        }

        return back();
    }
}
