<?php

namespace App\Services;

use App\Models\Product;
use Http;
use Illuminate\Support\Arr;
use App\Models\{
    Order,
    OrderItem
};
use Cart;

class OrderService
{
    const STATUS_NOT_PAID = 0;
    const STATUS_PAID = 1;
    const STATUS_CANCELLED = 2;

    const DELIVERY_STATUS_PENDING = 0;
    const DELIVERY_STATUS_COMPLETE = 1;

    /**
     * @param int $id
     */
    public function cancelOrder(int $id): void
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => self::STATUS_CANCELLED
        ]);
    }

    /**
     * @param int $id
     * @return Order|null
     */
    public function getOrder(int $id)
    {
        return Order::find($id);
    }

    /**
     * @param int $id
     * @return string
     */
    public function getOrderPaymentMethod(int $id): string
    {
        $order = Order::findOrFail($id);

        return $order->payment_method;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function isOrderCanceled(int $id): bool
    {
        $order = Order::findOrFail($id);

        return $order->status === self::STATUS_CANCELLED;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function isOrderPaid(int $id): bool
    {
        $order = Order::findOrFail($id);
        $status= (int) $order->status;
        return $status === self::STATUS_PAID;
    }

    /**
     * @param array $orderData
     * @return Order
     * @throws \Throwable
     */
    public function make(array $orderData): int
    {
        $order = null;
        \DB::transaction(function () use (&$order, $orderData) {
            $cart = Cart::session(session_id())->getContent();
            if(Arr::exists($orderData, 'delivery')){
                $delivery = 1;
            }
            else{
                $delivery = 0;
            }
            $order = Order::create([
                'customer' => $orderData['customer'],
                'phone' => $orderData['phone'],
                'address' => $orderData['address'],
                'payment_method' => $orderData['payment_method'],
                'delivery' => $delivery,
                'comment' => $orderData['comment'],
                'amount' => Cart::getTotal(),
            ]);
            $items = $cart->map(function ($v, $k) {
                $product = Product::findOrFail($k);
                $product->increment('num_sold',1);
                return new OrderItem([
                    'item_id' => $k,
                    'item_name' => $v->name,
                    'quantity' => $v->quantity,
                ]);
            });

            $order->items()->saveMany($items);
            $order->agreement()->create();
        });

      $token = '1771675598:AAGU8KWH7JeyPcXPGzYaz3eN66Hrjdy2zc4';
      $chat_id = '-557232963';
      $method = ucfirst($order->payment_method);
      if($order->address){
        $address = $order->address;
      }
      else{
        $address = '???? ??????????????';
      }
      if($order->status == 0){
        $paid = "???? ????????????????";
      }
      else{
        $paid = "????????????????";
      }
      $arr = [
        "&#128100; ????????????: " => $order->customer,
        "&#128222; ??????????????: " => $order->phone,
        "??????????: " => $address,
        "?????????? ????????????: " => $method,
        "???????????? ????????????: " => $paid,
      ];
      if($order->comment){
        $comment_arr = ["??????????????????????: " => $order->comment];
        $arr = $arr + $comment_arr;
      }
      $txt = "<b>?????????? #". $order->id. ":</b> \n\n";
      foreach ($arr as $key => $value) {
        $txt .= "<b>" . $key . "</b>" . $value . "\n";
      };
      $products = "\n&#128717; ????????????:\n";
      foreach ($order->items as $order_item){
        $item = Product::find($order_item->item_id);
        $products .= "<b>" . $item->__('name') . "</b> - " . $order_item->quantity . " ????. = ". number_format($item->price*$order_item->quantity, 0, ',', '.') .";\n";
      }
      $txt .= "__________\n" . $products . "__________\n\n&#128176; ?????????? ????????????:  \n <b>" . number_format($order->amount, 0, ',', '.') . " ??????</b> \n";

      $url = "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&parse_mode=html&text=".urlencode($txt);
      $res = Http::get($url);
      $order->message_id = json_decode($res->body())->result->message_id;
      $order->save();
        return $order->id;
    }

    /**
     * @param int $id
     */
    public function markOrderAsPaid(int $id): void
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => self::STATUS_PAID
        ]);
        
      $token = '1771675598:AAGU8KWH7JeyPcXPGzYaz3eN66Hrjdy2zc4';
      $chat_id = '-557232963';
        
      $method = ucfirst($order->payment_method);
      if($order->address){
        $address = $order->address;
      }
      else{
        $address = '???? ??????????????';
      }
      if($order->status == 0){
        $paid = "???? ????????????????";
      }
      else{
        $paid = "????????????????";
      }
      $arr = [
        "&#128100; ????????????: " => $order->customer,
        "&#128222; ??????????????: " => $order->phone,
        "??????????: " => $address,
        "?????????? ????????????: " => $method,
        "???????????? ????????????: " => $paid,
      ];
      if($order->comment){
        $comment_arr = ["??????????????????????: " => $order->comment];
        $arr = $arr + $comment_arr;
      }
      $txt = "<b>?????????? #". $order->id. ":</b> \n\n";
      foreach ($arr as $key => $value) {
        $txt .= "<b>" . $key . "</b>" . $value . "\n";
      };
      $products = "\n&#128717; ????????????:\n";
      foreach ($order->items as $order_item){
        $item = Product::find($order_item->item_id);
        $products .= "<b>" . $item->__('name') . "</b> - " . $order_item->quantity . " ????. = ". number_format($item->price*$order_item->quantity, 0, ',', '.') .";\n";
      }
      $txt .= "__________\n" . $products . "__________\n\n&#128176; ?????????? ????????????:  \n <b>" . number_format($order->amount, 0, ',', '.') . " ??????</b> \n";

      $url = "https://api.telegram.org/bot".$token."/editMessageText?chat_id=".$chat_id."&message_id=" . $order->message_id ."&parse_mode=html&text=".urlencode($txt);
      $res = Http::get($url);

      //send update message
      $text = "<b>?????????? #" . $order->id . "</b> ?????????????? ??????????????";
      $update_url = "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&reply_to_message_id=" . $order->message_id . "&parse_mode=html&text=".urlencode($text);
      $result = Http::get($update_url);
    }
}
