<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductsCollection;
use App\Http\Resources\ProductsResource;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class ApiController extends Controller
{
    public function index() {
        $products = DB::table('products')->paginate(5);
        return ProductsResource::collection($products);
    }

    public function show($id) {
        return new ProductsResource(Product::findOrFail($id));
    }

    public function save_admin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|gte:1',
            'status' => 'required|gte:1|lte:4'
        ], [
            'user_id.exists' => 'User with this id was not found',
            'product_id.exists' => 'Product with this id was not found',
            'status.lte' => 'Status has to be from 1 to 4',
            'status.gte' => 'Status has to be from 1 to 4',
            'amount.gte' => 'Amount can not be less than 1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $order = Orders::create($request->all());
        return new OrderResource($order);
    }
}
