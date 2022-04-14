<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        return response()->json([
//            'message' => 'Product created',
//            'product' => $request
//        ], 201);
        $request->validate([
            'name' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'image' => ['image', 'nullable']
        ]);

        $image_name = 'no_photo.jpg';
        if ($request->hasFile('image')) {
            $path = 'public/img';
            $image = $request->file('image');
            $image_name = uniqid('img_') . '.jpg';
            $request->file('image')->storeAs($path, $image_name);
        }

        $product = Product::create(array_merge($request->all(), ['image_name' => $image_name]));
        $product->save();
        return redirect()->back()->with('message', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
