<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.pages.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.product_page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        if ($request->hasFile('img')){
            $filename = str_slug($request->name_ru) . '1.' .  request()->file('img')->getClientOriginalExtension();
            $img_path = Storage::putFileAs('products', request()->file('img'), $filename);
            $params['img'] = $img_path;
        }
        if ($request->hasFile('img2')){
            $filename = str_slug($request->name_ru) . '2.' .  request()->file('img2')->getClientOriginalExtension();
            $img2_path = Storage::putFileAs('products', request()->file('img2'), $filename);
            $params['img2'] = $img2_path;
        }
        if ($request->hasFile('img3')){
            $filename = str_slug($request->name_ru) . '3.' .  request()->file('img3')->getClientOriginalExtension();
            $img3_path = Storage::putFileAs('products', request()->file('img3'), $filename);
            $params['img3'] = $img3_path;
        }
        if ($request->hasFile('img_doubled')){
            $filename = str_slug($request->name_ru) . '_doubled.' .  request()->file('img_doubled')->getClientOriginalExtension();
            $img_doubled_path = Storage::putFileAs('products', request()->file('img_doubled'), $filename);
            $params['img_doubled'] = $img_doubled_path;
        }

        Product::create($params);
        $message = 'Товар <b>' . $request['name_ru'] . '</b> успешно добавлен';
        return redirect()-> route('products.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('admin.pages.product_page', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $params = $request->all();
        if ($request->hasFile('img')){
            $filename = str_slug($request->name_ru) . '1.' .  request()->file('img')->getClientOriginalExtension();
            $img_path = Storage::putFileAs('products', request()->file('img'), $filename);
            $params['img'] = $img_path;
        }
        if ($request->hasFile('img2')){
            $filename = str_slug($request->name_ru) . '2.' .  request()->file('img2')->getClientOriginalExtension();
            $img2_path = Storage::putFileAs('products', request()->file('img2'), $filename);
            $params['img2'] = $img2_path;
        }
        if ($request->hasFile('img3')){
            $filename = str_slug($request->name_ru) . '3.' .  request()->file('img3')->getClientOriginalExtension();
            $img3_path = Storage::putFileAs('products', request()->file('img3'), $filename);
            $params['img3'] = $img3_path;
        }
        if ($request->hasFile('img_doubled')){
            $filename = str_slug($request->name_ru) . '_doubled.' .  request()->file('img_doubled')->getClientOriginalExtension();
            $img_doubled_path = Storage::putFileAs('products', request()->file('img_doubled'), $filename);
            $params['img_doubled'] = $img_doubled_path;
        }

        $product->update($params);
      $message = 'Товар <b>' . $request['name_ru'] . '</b> успешно обновлен';
      return redirect()-> route('products.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function disable(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $product->active = 0;
        $product->save();
        $message = 'Товар <b>' . $product->name_ru . '</b> успешно отключен';
        return redirect()->back()->with('message', $message);
    }
    public function enable(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $product->active = 1;
        $product->save();
      $message = 'Товар <b>' . $product->name_ru . '</b> успешно включен';
      return redirect()->back()->with('message', $message);
    }
    public function makeHidden(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $product->visible = 0;
        $product->save();
      $message = 'Товар <b>' . $product->name_ru . '</b> успешно скрыт';
      return redirect()->back()->with('message', $message);
    }
    public function makeVisible(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $product->visible = 1;
        $product->save();
      $message = 'Товар <b>' . $product->name_ru . '</b> успешно показан';
      return redirect()->back()->with('message', $message);
    }
}
