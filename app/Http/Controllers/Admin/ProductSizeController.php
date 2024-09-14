<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{

    const PATH_VIEW = 'admin.product-sizes.';

    public function index()
    {
        $sizes = ProductSize::query()->first('id')->paginate(10);

        return view(self::PATH_VIEW . __FUNCTION__, compact('sizes'));
    }


    public function store(Request $request)
    {
        $data = $request->toArray();

        $size = ProductSize::query()->create($data);

        return back();
    }



    public function update(Request $request, string $id)
    {
        $size = ProductSize::find($id);

        $data = $request->toArray();

        $size->update($data);

        return back();
    }


    public function destroy(string $id)
    {
        $size = ProductSize::find($id);

        $size->delete();

        return back();
    }
}
