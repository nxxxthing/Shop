<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $orders = Orders::all();
        return view('admin.orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('admin.orders.create', ['users' => $users, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $product = Product::find($request['product_id']);
        $price = $request['amount'] * $product->price;
        $order = Orders::create(array_merge($request->all(), [
            'price' => $price,
        ]));
        $order->save();
        return redirect()->back()->with('message', 'Order added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Orders $order
     * @return Application|Factory|View
     */
    public function show(Orders $order)
    {
        $product_name = Product::find($order['product_id'])->name;
        $user_name = User::find($order['user_id'])->name;
        return view('admin.orders.show', [
            'order' => $order,
            'user_name' => $user_name,
            'product_name' => $product_name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Orders $order
     * @return Application|Factory|View
     */
    public function edit(Orders $order)
    {
        $users = User::all();
        $products = Product::all();
        return view('admin.orders.edit', [
            'order' => $order,
            'users' => $users,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Orders $order
     * @return RedirectResponse
     */
    public function update(Request $request, Orders $order)
    {
        if ($order['user_id'] == $request['user_id'] && $order['product_id'] == $request['product_id'] && $order['amount'] == $request['amount'])
            return redirect()->back()->with('error', 'Nothing was changed!');
        $product = Product::find($request['product_id']);
        $price = $request['amount'] * $product->price;
        $order['user_id'] = $request['user_id'];
        $order['product_id'] = $request['product_id'];
        $order['amount'] = $request['amount'];
        $order['price'] = $price;
        $order->save();
        return redirect()->back()->with('message', 'Order edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Orders $order
     * @return RedirectResponse
     */
    public function destroy(Orders $order)
    {
        $order->delete();
        return redirect()->back()->with('message', 'Order deleted successfully!');
    }
}
