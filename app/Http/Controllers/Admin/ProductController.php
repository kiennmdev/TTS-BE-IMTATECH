<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\DataNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    const PATH_VIEW = 'admin.products.';

    public function index()
    {
        $data = Product::query()->with(['catalogue', 'tags'])->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }


    public function create()
    {
        $catalogues = Catalogue::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->get(['id', 'name', 'code']);
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('catalogues', 'colors', 'sizes', 'tags'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $dataProduct = $request->except('product_variants', 'tags', 'product_galleries');
        // dd($dataProduct);

        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

        if (isset($dataProduct['img_thumbnail'])) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }

        $dataProductVariants = $request->product_variant;

        $dataProductTags = $request->tags;

        $dataProductGalleries = $request->product_galleries ?: [];

        //Sử dụng try-catch để dùng cho sql transaction
        try {
            DB::beginTransaction();

            /** @var Product $product */
            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;
                if (isset($dataProductVariant['image'])) {
                    $dataProductVariant['image'] = Storage::put('products', $dataProductVariant['image']);
                }

                ProductVariant::query()->create($dataProductVariant);
            }

            $product->tags()->sync($dataProductTags);

            foreach ($dataProductGalleries as $image) {
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => Storage::put('products', $image)
                ]);
            }

            // throw new DataNotFoundException();

            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();

            if (isset($dataProduct['img_thumbnail'])) {
                Storage::delete($dataProduct['img_thumbnail']);
            }

            if (Str::contains($exception->getMessage(), "SQLSTATE[23000]")) {
                return back()->with("duplicate", "Không được thêm hai biến thể sản phẩm giống nhau");
            }

            dd($exception->getMessage());

            return back();
        }
    }



    public function edit(Product $product)
    {
        // dd($product->toArray());
        $productEdit = Product::with(['catalogue', 'tags', 'galleries', 'variants'])->find($product->id);
        $variants = ProductVariant::with(['products', 'color', 'size'])->find(1);

        dd($variants->toArray());
        $catalogues = Catalogue::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->get(['id', 'name', 'code']);
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('productEdit', 'catalogues', 'colors', 'sizes', 'tags'));
    }


    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $dataProduct = $request->except('product_variants', 'tags', 'product_galleries', '_token', '_method', 'search_terms');
        $dataProduct['id'] = $product->id;
        // dd($dataProduct);
        if (isset($dataProduct['img_thumbnail'])) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }

        $dataProductGalleries = $request->product_galleries;

        $dataProductTags = $request->tags;

        $dataProductVariantTMP = $request->product_variants;

        $dataProductVariants = [];

        foreach ($dataProductVariantTMP as $key => $item) {
            $tmp = explode('-', $key);

            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
                'image' => $item['image'] ?? null
            ];
        }

        try {
            DB::beginTransaction();

            /** @var Product $product */

            Product::query()->where('id', '=', $dataProduct['id'])->update($dataProduct);;

            $product = Product::query()->where('id', '=', $dataProduct['id'])->first();

            $product->tags()->sync($dataProductTags);

            if (isset($dataProductGalleries['add-gallery'])) {
                foreach ($dataProductGalleries['add-gallery'] as $image) {
                    ProductGallery::query()->create([
                        'product_id' => $dataProduct['id'],
                        'image' => Storage::put('products', $image)
                    ]);
                }
            }

            foreach ($dataProductGalleries['edit-gallery'] as $id => $value) {
                ProductGallery::query()->where('id', '=', $id)->update(['status' => $value]);
            }

            foreach ($dataProductVariants as $variant) {
                if ($variant['image'] === null) {
                    unset($variant['image']);
                } else {
                    $variant['image'] = Storage::put('products', $variant['image']);
                }
                ProductVariant::where('product_size_id', $variant['product_size_id'])
                    ->where('product_color_id', $variant['product_color_id'])
                    ->update($variant);
            }

            DB::commit();

            return back();
        } catch (\Exception $exception) {
            DB::rollBack();

            if (isset($dataProduct['img_thumbnail'])) {
                Storage::delete($dataProduct['img_thumbnail']);
            }

            dd($exception);

            return back();
        }
    }


    public function destroy(Product $product)
    {

        try {
            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);
                $product->galleries()->delete();
                $product->variants()->delete();
                $product->delete();
            }, 3);

            return back();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
