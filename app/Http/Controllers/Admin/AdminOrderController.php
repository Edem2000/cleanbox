<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\s;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $ordersQuery = Order::query();
//        dd(request()->all());
//        dd($request->has('payme'));
//        $orders = Order::with(['delivery', 'items'])->orderByDesc('id')->paginate(10);
      if($request->has('payme')){
        $ordersQuery->where('payment_method', '=', 'payme');
      }
      if($request->has('click')){
        $ordersQuery->where('payment_method', '=', 'click');
      }
      if($request->has('apelsin')){
        $ordersQuery->where('payment_method', '=', 'apelsin');
      }
      if($request->filled('paid')){
        $ordersQuery->where('status', '1');
      }
      if($request->filled('unpaid')){
        $ordersQuery->where('status', '0');
      }
      $orders = $ordersQuery->with(['items'])->orderByDesc('created_at')->paginate(10)->withPath('?' . $request ->getQueryString());

      $statuses = OrderStatus::get();
      return view('admin.pages.orders', compact('orders', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
      $statuses = OrderStatus::get();
      return view('admin.pages.order_page', compact('order', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
      $order->update($request->all());
      $status = OrderStatus::where('status_id', '=', $order->processing_status)->get()->first();
      $message = 'Статус заказа <b>#' . $order->id . '</b> успешно изменен на <b>' . $status->name . '</b>';
      return redirect()-> route('orders.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
