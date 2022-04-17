<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
