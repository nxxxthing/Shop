<?php

namespace App\Http\Controllers;

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
        return response()->json([
            'message' => 'List of all products with pagination',
            'products' => $products
        ]);
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return response()->json([
            'message' => $product,
        ]);
    }

    public function save_admin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'status' => 'gte:1|lte:4'
        ], $messages = [
            'user_id.exists' => 'User with this id was not found',
            'product_id.exists' => 'Product with this id was not found',
            'status.lte' => 'Status has to be from 1 to 4',
            'status.gte' => 'Status has to be from 1 to 4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        $order = Orders::create($request->all());
        return response()->json([
            'message' => $order,
        ]);
    }
}
