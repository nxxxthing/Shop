<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use App\Models\ViewOrderData;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
//        $orders = Orders::all();
        $orders = ViewOrderData::all();
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
        $order = Orders::create($request->all());
        return redirect()->back()->with('message', __('messages.order_add_suc'));
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
        $status = '';
        switch ($order['status']) {
            case 1:
                $status = 'pending';
                break;
            case 2:
                $status = 'arriving';
                break;
            case 3:
                $status = 'arrived';
                break;
            case 4:
                $status = 'confirmed';
                break;
            default:
                return response([
                    "error" => "Something is wrong with orders db",
                    "help" => "Contact the developers team to verify"
                ],400);
        }
        return view('admin.orders.show', [
            'order' => $order,
            'user_name' => $user_name,
            'product_name' => $product_name,
            'status' => $status
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
        if ($order['user_id'] == $request['user_id'] && $order['product_id'] == $request['product_id'] &&
            $order['amount'] == $request['amount'] && $order['status'] == $request['status'])
            return redirect()->back()->with('error', __('messages.nothing_edited'));
        $order['user_id'] = $request['user_id'];
        $order['product_id'] = $request['product_id'];
        $order['amount'] = $request['amount'];
        $order['status'] = $request['status'];
        $order->save();
        return redirect()->back()->with('message', __('messages.order_edit_suc'));
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
        return redirect()->back()->with('message', __('messages.order_del_suc'));
    }
}
