<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalogue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CatalogueController extends Controller
{
    const PATH_VIEW = 'admin.catalogues.';

    const PATH_UPLOAD= 'catalogues';

    public function index()
    {
        $data = Catalogue::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }


    public function store(Request $request)
    {
        $data = $request->except('cover');
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] ??= 0;
        
        Catalogue::query()->create($data);
        
        return back();
    }


    public function update(Request $request, string $id)
    {
        $model = Catalogue::query()->findOrFail($id);
        // dd($model->cover);
        $data = $request->except('cover'); 
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] ??= 0;
        
        // dd($data);

        $currentCover = $model->cover;

        $model->update($data);

        if($currentCover && Storage::exists($currentCover) && $request->hasFile('cover')) {
            Storage::delete($currentCover);
        }

        return back();
    }


    public function destroy(string $id)
    {
        $model = Catalogue::query()->findOrFail($id);
        $model->delete();
        if($model->cover && Storage::exists($model->cover)) {
            Storage::delete($model->cover);
        }
        return back();
    }
}
