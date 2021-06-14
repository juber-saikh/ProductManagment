<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryManagement;

class CategoryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = CategoryManagement::all();

        return view('category/index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|max:255',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_category' => 'required',
        ]);

        $file  = $request->category_image;

        if($request->category_image) {
            $fileName = (uniqid()).'.'.$file->extension();
            $file->move(public_path('uploads/category'), $fileName);
        }
        $validatedData['category_image'] = $fileName;

        //$request->category_image->move(public_path('images'), $imageName);

        $show = CategoryManagement::create($validatedData);

        return redirect('/category')->with('success', 'Category Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryManagement::findOrFail($id);

        return view('category/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|max:255',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_category' => 'required',
        ]);

        $file  = $request->category_image;

        if($request->category_image) {
            $fileName = (uniqid()).'.'.$file->extension();
            $file->move(public_path('uploads/category'), $fileName);
        }
        $validatedData['category_image'] = $fileName;
        CategoryManagement::whereId($id)->update($validatedData);

        return redirect('/category')->with('success', 'Category Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = CategoryManagement::findOrFail($id);
        $category->delete();
        return redirect('/category')->with('success', 'Category Data is successfully deleted');
    }
}
