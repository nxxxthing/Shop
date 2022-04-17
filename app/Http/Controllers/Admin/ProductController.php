<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Providers\StorageServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Providers\RouteServiceProvider;
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
        return redirect()->back()->with('message', __('messages.prod_add_suc'));
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
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

        $image_name = $request['secret'];
        if ($request->hasFile('image')) {
            $path = 'public/img';
            $image = $request->file('image');
            $image_name = uniqid('img_') . '.jpg';
            $request->file('image')->storeAs($path, $image_name);
        } elseif ($request['name'] == $product['name'] && $request['author'] == $product['author'] &&
            $request['price'] == $product['price'] && $image_name == $product['image_name'])
            return redirect()->back()->with('error', __('messages.nothing_edited'));

        if ($image_name == "no_photo.jpg" && $image_name != $product['image_name']) {
            Storage::delete(StorageServiceProvider::IMG_PATH . $product['image_name']);
        }
        $product['name'] = $request['name'];
        $product['author'] = $request['author'];
        $product['price'] = $request['price'];
        $product['image_name'] = $image_name;
        $product->save();
        return redirect()->back()->with('message', __('messages.prod_edit_suc'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        if ($product['image_name'] != "no_photo.jpg") {
            Storage::delete(StorageServiceProvider::IMG_PATH . $product['image_name']);
        }
        $product->delete();
        return redirect()->back()->with('message', __('messages.prod_del_suc'));
    }
}
