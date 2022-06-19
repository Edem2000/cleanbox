<?php

namespace App\Http\Controllers;

use App\Models\BlogNewsArticle;
use App\Models\BlogPressArticle;
use App\Models\ContactRequest;
use App\Models\Product;
use App\Models\Diploma;
use App\Models\AboutYear;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Payment;
use Http;

class MainController extends Controller
{
    public function getIndex(){
        $products = Product::get();
        $news_articles = BlogNewsArticle::get()->sortByDesc('created_at');
        $diplomas = Diploma::get()->sortByDesc('created_at');
        return view('pages.index', compact('products', 'news_articles', 'diplomas'));
    }
    public function getCatalog(){
        $products = Product::all();
        return view('pages.catalog', compact('products'));
    }
    public function getCart(){
        $items = \Cart::session(session_id())->getContent();
        return view('pages.cart', compact('items'));
    }
    public function getProductPage($id){
        $product = Product::findOrFail($id);
        return view('pages.product', compact('product'));
    }
    public function getCheckoutPage(){
        $items = \Cart::session(session_id())->getContent();
        return view('pages.checkout', compact('items'));
    }
    public function checkoutComplete(Request $request, OrderService $orderService)
    {
        $orderId = $orderService->make($request->except('_token'));

        return Payment::makeGateway(request('payment_method'), $orderId);
    }
    public function checkoutSuccess($orderId){

        \Cart::session(session_id())->clear();
        return view('pages.success', compact('orderId'));

    }
    public function getBlogPage() {
        $news_articles = BlogNewsArticle::get()->sortByDesc('created_at');
        $press_articles = BlogPressArticle::get()->sortByDesc('created_at');
//        dd($news_articles);
        return view('pages.blog', compact('news_articles', 'press_articles'));
    }
    public function getBlogArticlePage(BlogNewsArticle $news) {
        $news->increment('views',1);
        return view('pages.blogArticle', compact('news'));
    }
    public function getDiplomas(){
      $diplomas = Diploma::get()->sortByDesc('created_at');
      return view('pages.diplomas', compact('diplomas'));
    }
    public function getAbout(){
      $years = AboutYear::get()->sortByDesc('year');
      return view('pages.about', compact('years'));
    }
    public function updateShares($id){
      $news = BlogNewsArticle::find($id);
      $news->increment('shares',1);
      return response()->json(array('success' => 'true'), 200);

    }
    public function changeLocale($locale){
        $availableLocales = ['ru', 'en', 'uz'];
        if(!in_array($locale, $availableLocales)){
            $locale = config('app.locale');
        }
        session(['locale'=>$locale]);
        App::setLocale($locale);
        return redirect()->back();
    }
    public function sendContactForm(Request $request){
      $token = '1771675598:AAGU8KWH7JeyPcXPGzYaz3eN66Hrjdy2zc4';
      $chat_id = '-557232963';
      $params = $request->all();
      if(is_null($request['email'])){
        $params['email'] = 'Не указано';
      }
      if(is_null($request['message'])){
        $params['message'] = 'Нет сообщения';
      }
      $contact = ContactRequest::create($params);

      $arr = array(
        'Имя: ' => $contact->name,
        'Номер: ' => $contact->phone,
        'Email: ' => $contact->email,
        'Сообщение: ' => $contact->message,
      );
      $txt = '<b>Обратная связь:</b>%0A%0A';
      foreach ($arr as $key => $value) {
        $txt .= "<b>" . $key . "</b> " . $value . "%0A";
      };
      $url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$chat_id.'&parse_mode=html&text='.$txt;
      $res = Http::get($url);
      return response()->json(array('name'=>$contact->name), $res->status());
    }

}
