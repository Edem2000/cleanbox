<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diploma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDiplomasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diplomas = Diploma::get()->sortByDesc('created_at');
        return view('admin.pages.diplomas', compact('diplomas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.pages.diploma_page');
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
        $img_path = Storage::putFileAs('diplomas', request()->file('img'), $filename);
        $params['img'] = $img_path;
      }
      Diploma::create($params);
      $message = 'Сертификат <b>' . $request['name_ru'] . '</b> успешно добавлен';
      return redirect()-> route('diplomas.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diploma  $diploma
     * @return \Illuminate\Http\Response
     */
    public function show(Diploma $diploma)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diploma  $diploma
     * @return \Illuminate\Http\Response
     */
    public function edit(Diploma $diploma)
    {
      return view('admin.pages.diploma_page', compact('diploma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diploma  $diploma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diploma $diploma)
    {
      $params = $request->all();
      if ($request->hasFile('img')){
        $filename = str_slug($request->name_ru) . '.' .  request()->file('img')->getClientOriginalExtension();
        $img_path = Storage::putFileAs('diplomas', request()->file('img'), $filename);
        $params['img'] = $img_path;
      }
      $diploma->update($params);
      $message = 'Сертификат <b>' . $request['name_ru'] . '</b> успешно изменен';
      return redirect()-> route('diplomas.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diploma  $diploma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diploma $diploma)
    {
        //
    }
  public function disable(Diploma $diploma)
  {
    $diploma = Diploma::findOrFail($diploma->id);
    $diploma->active = 0;
    $diploma->save();
    $message = 'Сертификат <b>' . $diploma->name_ru . '</b> успешно отключен';
    return redirect()->back()->with('message', $message);
  }
  public function enable(Diploma $diploma)
  {
    $diploma = Diploma::findOrFail($diploma->id);
    $diploma->active = 1;
    $diploma->save();
    $message = 'Сертификат <b>' . $diploma->name_ru . '</b> успешно включен';
    return redirect()->back()->with('message', $message);
  }
}
