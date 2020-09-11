<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = Category::create([
            'name' => $request->name,
            'priority' => $request->priority,
            'language' => $request->language,
            'user_id' => \Auth::id(),
        ]);

        $image = $request->image;
        $image = md5($request->file('image')->getClientOriginalName().microtime());
        $ext = $request->file('image')->getClientOriginalExtension();
        $image = $image.'.'.$ext;
        $request->file('image')->move(public_path('/images'), $image);
        Image::create([
            'image' => $image,
            'imageable_id' => $cat->id,
            'imageable_type' => 'App\Models\Category',
        ]);

        return view('backend.category.create');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        $categories = Category::where('id', $category->id)->first();
        return view('backend.category.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $image = Image::where('imageable_id', $category->id)->first();
        unlink(public_path('images/').'/'.$image->image);
        return redirect()->back();
    }
}
