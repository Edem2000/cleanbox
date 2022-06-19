<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogNewsArticle;
use App\Models\BlogPressArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBlogNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news_articles = BlogNewsArticle::get()->sortByDesc('created_at');
        $press_articles = BlogPressArticle::get()->sortByDesc('created_at');
        return view('admin.pages.blog', compact('news_articles', 'press_articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.news_article');
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
        $img_path = Storage::putFileAs('blog/news', request()->file('img'), $filename);
        $params['img'] = $img_path;
      }
      BlogNewsArticle::create($params);
      $message = 'Наши новости: статья <b>' . $request['name_ru'] . '</b> успешно добавлена';
      return redirect()-> route('news.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogNewsArticle  $blogNewsArticle
     * @return \Illuminate\Http\Response
     */
    public function show(BlogNewsArticle $blogNewsArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogNewsArticle  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogNewsArticle $news)
    {
      return view('admin.pages.news_article', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogNewsArticle  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogNewsArticle $news)
    {
      $params = $request->all();
      if ($request->hasFile('img')){
        $filename = str_slug($request->name_ru) . '.' .  request()->file('img')->getClientOriginalExtension();
        $img_path = Storage::putFileAs('blog/news', request()->file('img'), $filename);
        $params['img'] = $img_path;
      }
      $news->update($params);
      $message = 'Наши новости: статья <b>' . $news->name_ru . '</b> успешно обновлена';
      return redirect()-> route('news.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogNewsArticle  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogNewsArticle $news)
    {
        $news->delete();
        $message = 'Наши новости: статья успешно удалена';
        return redirect()-> route('news.index')->with('message', $message);
    }
  public function disable(BlogNewsArticle $news)
  {
    $news = BlogNewsArticle::findOrFail($news->id);
    $news->active = 0;
    $news->save();
    $message = 'Наши новости: статья <b>' . $news->name_ru . '</b> успешно отключена';
    return redirect()->back()->with('message', $message);
  }
  public function enable(BlogNewsArticle $news)
  {
    $news = BlogNewsArticle::findOrFail($news->id);
    $news->active = 1;
    $news->save();
    $message = 'Наши новости: статья <b>' . $news->name_ru . '</b> успешно включена';
    return redirect()->back()->with('message', $message);
  }
}
