<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $pages = Pages::all();
        return response()->json([
            'pages' => $pages
        ]);
    }

    public function show($id) {
        $page = Pages::findOrFail($id)->makeVisible(['created_at', 'updated_at']);
        return response()->json([
            'page' => $page
        ]);
    }
}
