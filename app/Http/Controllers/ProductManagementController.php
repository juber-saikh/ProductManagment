<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductManagement;
use App\Models\CategoryManagement;

class ProductManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->query('cat')){
            $cat=$request->query('cat');
            $product_name=$request->query('prod');
            $products = ProductManagement::whereHas('categoryname' , function($query) use($cat,$product_name) {
                $query->where('category_name',$cat);
            })->where('product_name',$product_name)->get();
        }else{
            $products = ProductManagement::with(array('categoryname' => function($query) {
                $query->select('id','category_name');
            }))->get();
        }


        //dd($products);
        $data['category'] = CategoryManagement::all();
        return view('product/index',compact('products'),$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = CategoryManagement::all();
        return view('product/create',$data);
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
            'product_name' => 'required|max:255',
            'product_description' => 'required|max:255',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
        ]);

        $file  = $request->product_image;

        if($request->product_image) {
            $fileName = (uniqid()).'.'.$file->extension();
            $file->move(public_path('uploads/products'), $fileName);
        }
        $validatedData['product_image'] = $fileName;
        //$request->category_image->move(public_path('images'), $imageName);
        $show = ProductManagement::create($validatedData);

        return redirect('/products')->with('success', 'Product Added Successfully');
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
        $products = ProductManagement::findOrFail($id);
        $data['category'] = CategoryManagement::all();

        return view('product/edit', compact('products'),$data);
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
            'product_name' => 'required|max:255',
            'product_description' => 'required|max:255',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
        ]);

        $file  = $request->product_image;

        if($request->product_image) {
            $fileName = (uniqid()).'.'.$file->extension();
            $file->move(public_path('uploads/products'), $fileName);
            $filenames = $file->getClientOriginalName();
        }
        $validatedData['product_image'] = $fileName;

        ProductManagement::whereId($id)->update($validatedData);

        return redirect('/products')->with('success', 'Product Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductManagement::findOrFail($id);
        $category->delete();
        return redirect('/products')->with('success', 'Product Data is successfully deleted');
    }
}
