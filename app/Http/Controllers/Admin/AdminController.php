<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function getAdminDashboard(){
        $products_sold = (int) Product::sum('num_sold');
        $orders_quantity = Order::count();
        $orders = Order::orderByDesc('created_at')->get();
        $orders_amount = 0;
        foreach ($orders as $order){
            $orders_amount += $order->amount;
        }
        $products_a = Product::get();

        $products = [['Название', 'Продано']];
        foreach ($products_a as $product){
            $products[] = [$product->name_ru, $product->num_sold];
        }

        $statuses = OrderStatus::get();
        return view('admin.pages.dashboard', compact('products_sold', 'orders_amount', 'orders_quantity', 'products', 'orders', 'statuses'));
    }

    public function getContactsPage(){
      return view('admin.pages.contacts');
    }
  public function updateContactsPage(Request $request){
      DB::table('contacts')
        ->where('id', 1)
        ->update([
          'phone' => $request['phone'],
          'facebook' => $request['facebook'],
          'instagram' => $request['instagram'],
          'telegram' => $request['telegram'],
        ]);
    $message = 'Контактные данные успешно обновлены';
      return redirect()->back()->with('message', $message);
  }

}
