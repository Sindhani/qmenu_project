<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        $category = Category::all();
        return view('backend.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.menu.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $menu = Menu::create([
            'name' => $request->name,
            'priority' => $request->priority,
            'language' => $request->language,
            'category_id' => (int)$request->menu,
        ]);
        $image = $request->image;
        $image = md5($request->file('image')->getClientOriginalName() . microtime());
        $ext = $request->file('image')->getClientOriginalExtension();
        $image = $image . '.' . $ext;
        $request->file('image')->move(public_path('/images'), $image);
        Image::create([
            'image' => $image,
            'imageable_id' => $menu->id,
            'imageable_type' => 'App\Models\Menu',
        ]);

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $category = Category::all();
        return view('backend.menu.edit', compact('menu', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->all());
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $image = Image::where('imageable_id', $menu->id)->first();
        $menu->delete();

        unlink(public_path('images/') . '/' . $image->image);
        return redirect()->back();
    }
}
