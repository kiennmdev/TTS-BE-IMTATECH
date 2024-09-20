<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    const PATH_VIEW = "admin.tags.";

    public function index()
    {
        $tags = Tag::query()->latest('id')->paginate(10);
        
        return view(self::PATH_VIEW . __FUNCTION__, compact('tags'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $tag = Tag::query()->create($data);

        return back();
    }

 
    public function update(Request $request, string $id)
    {
        $tag = Tag::query()->where('id', $id)->first(); 

        $data = $request->all();

        $tag->update($data);

        return back();
    }


    public function destroy(string $id)
    {
        // dd($id);
        $tag = Tag::query()->where('id', $id)->first(); 

        $tag->delete();

        return back();
    }
}
