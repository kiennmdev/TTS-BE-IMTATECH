<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    const PATH_VIEW = 'admin.product-colors.';

    public function index()
    {
        $colors = ProductColor::query()->first('id')->paginate(10);

        return view(self::PATH_VIEW . __FUNCTION__, compact('colors'));
    }


    public function store(Request $request)
    {
        $data = $request->toArray();

        $color = ProductColor::query()->create($data);

        return back();
    }


    public function update(Request $request, string $id)
    {
        
        $color = ProductColor::find($id);

        $data = $request->toArray();

        $color->update($data);

        return back();
    }


    public function destroy(string $id)
    {
        $color = ProductColor::find($id);

        $color->delete();

        return back();
    }
}
