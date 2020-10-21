<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate=Category::all();
        return response()->json($cate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cate = new Category;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $filename = time().'.'.$ext;
            $path = public_path().'/uploads/';
            $image->move($path,$filename);
        } else {
            $filename = 'image-not-found.png';
        }
        $cate->categoryname = $request->input('categoryname');
        $cate->image = $filename;
        $cate->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $cates=Category::find($category);
        return response()->json($cates);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cate = Category::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $filename = time().'.'.$ext;
            $path = public_path().'/uploads/';
            $image->move($path,$filename);
        } else {
            $filename = 'image-not-found.png';
        }
        $cate->categoryname = $request->input('categoryname');
        $cate->image = $filename;
        $cate->save();
        // return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {   
        $path = public_path().'/uploads/';
        if ($category->image != 'image-not-found.png') {
            File::delete($path.$category->image);
        }
        $category->delete();
    }
}
