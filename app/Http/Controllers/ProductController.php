<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'image' => ['image']
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $image_name = 'no_photo.jpg';
        if ($request->hasFile('image')) {
            $path = 'public/img';
            $image = $request->file('image');
            $image_name = uniqid('img_') . '.jpg';
            $request->file('image')->storeAs($path, $image_name);
        }

        $product = Product::create(array_merge($request->all(), ['image_name' => $image_name]));
        $product->save();
        return response()->json([
            'message' => 'Product created',
            'product' => $product
        ], 201);
    }
}
