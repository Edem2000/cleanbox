<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPressArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBlogPressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.pages.press_article');
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
        $filename = str_slug($request->name_ru) . '.' .  request()->file('img')->getClientOriginalExtension();
        $img_path = Storage::putFileAs('blog/press', request()->file('img'), $filename);
        $params['img'] = $img_path;
      }
      BlogPressArticle::create($params);
      $message = 'Мы в прессе: статья <b>' . $request['name_ru'] . '</b> успешно добавлена';
      return redirect()-> route('news.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPressArticle  $press
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPressArticle $press)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPressArticle  $press
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPressArticle $press)
    {
      return view('admin.pages.press_article', compact('press'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPressArticle  $press
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPressArticle $press)
    {
      $params = $request->all();
      if ($request->hasFile('img')){
        $filename = str_slug($request->name_ru) . '.' .  request()->file('img')->getClientOriginalExtension();
        $img_path = Storage::putFileAs('blog/press', request()->file('img'), $filename);
        $params['img'] = $img_path;
      }
      $press->update($params);
      $message = 'Мы в прессе: статья <b>' . $request['name_ru'] . '</b> успешно обновлена';
      return redirect()-> route('news.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPressArticle  $press
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPressArticle $press)
    {
      $press->delete();
      $message = 'Мы в прессе: статья успешно удалена';
      return redirect()-> route('news.index')->with('message', $message);
    }
  public function disable(BlogPressArticle $press)
  {
    $press = BlogPressArticle::findOrFail($press->id);
    $press->active = 0;
    $press->save();
    $message = 'Мы в прессе: статья <b>' . $press->name_ru . '</b> успешно отключена';
    return redirect()->back()->with('message', $message);
  }
  public function enable(BlogPressArticle $press)
  {
    $press = BlogPressArticle::findOrFail($press->id);
    $press->active = 1;
    $press->save();
    $message = 'Мы в прессе: статья <b>' . $press->name_ru . '</b> успешно включена';
    return redirect()->back()->with('message', $message);
  }
}
