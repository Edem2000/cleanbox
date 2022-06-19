<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutYear;
use App\Models\AboutMonth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class AdminAboutController extends Controller
{
  public function index(){
    $years = AboutYear::get()->sortByDesc('year');
    return view('admin.pages.about', compact('years'));
  }
  public function create(){
    $months = [
        1 =>  'Январь',
        2 =>  'Февраль',
        3 =>  'Март',
        4 =>  'Апрель',
        5 =>  'Май',
        6 =>  'Июнь',
        7 =>  'Июль',
        8 =>  'Август',
        9 =>  'Сентябрь',
        10 => 'Октябрь',
        11 => 'Ноябрь',
        12 => 'Декабрь',
    ];
    return view('admin.pages.about_article', compact('months'));
  }
  public function store(Request $request){
    $months = [
      'ru' => [
        1 =>  'Январь',
        2 =>  'Февраль',
        3 =>  'Март',
        4 =>  'Апрель',
        5 =>  'Май',
        6 =>  'Июнь',
        7 =>  'Июль',
        8 =>  'Август',
        9 =>  'Сентябрь',
        10 => 'Октябрь',
        11 => 'Ноябрь',
        12 => 'Декабрь',
      ],
      'en' => [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
      ],
      'uz' => [
        1 => 'Yanvar',
        2 => 'Fevral',
        3 => 'Mart',
        4 => 'Aprel',
        5 => 'May',
        6 => 'Iyun',
        7 => 'Iyul',
        8 => 'Avgust',
        9 => 'Sentabr',
        10 => 'Oktabr',
        11 => 'Noyabr',
        12 => 'Dekabr',
      ],
    ];
    $month_ru = $months['ru'][$request['month_id']];
    $month_en = $months['en'][$request['month_id']];
    $month_uz = $months['uz'][$request['month_id']];
    if(!AboutYear::where('year', $request['year'])->exists()){
      $year = AboutYear::create(['year' => $request['year']]);
      $year->months()->create([
        'month_id' => $request['month_id'],
        'month_ru' => $month_ru,
        'month_en' => $month_en,
        'month_uz' => $month_uz,
        'content_ru' => $request['content_ru'],
        'content_en' => $request['content_en'],
        'content_uz' => $request['content_uz'],
      ]);
      $message = 'Данные для месяца <b>' . $month_ru . '</b> в году <b>' . $year->year . '</b> успешно созданы';
      return redirect()->route('about.index')->with('message', $message);
    }
    else{

      $year = AboutYear::where('year', intval($request['year']))->get()->first();
      if($year->has('months')){
//        if( $year::whereHas('months', function (Builder $query) {
//          $query->where('month_id');
//        }, '=', $request['month_id']))
//        dd($year->months->where('month_id', '=', $request['month_id']));
        if($year->months->where('month_id', '=', $request['month_id'])->first())
        {

          $message = 'Для месяца <b>' . $month_ru . '</b> в году <b>' . $year->year . '</b> данные уже существуют';
          return back()->with('message', $message);
        }
      }
        $month = AboutMonth::create([
          'year_id' => $year->id,
          'month_id' => $request['month_id'],
          'month_ru' => $month_ru,
          'month_en' => $month_en,
          'month_uz' => $month_uz,
          'content_ru' => $request['content_ru'],
          'content_en' => $request['content_en'],
          'content_uz' => $request['content_uz'],
        ]);
        $month->year()->associate($year);
      $message = 'Данные для месяца <b>' . $month_ru . '</b> в году <b>' . $year->year . '</b> успешно созданы';
        return redirect()->route('about.index')->with('message', $message);
    }
  }
  public function edit(AboutMonth $month){
    $months = [
      1 =>  'Январь',
      2 =>  'Февраль',
      3 =>  'Март',
      4 =>  'Апрель',
      5 =>  'Май',
      6 =>  'Июнь',
      7 =>  'Июль',
      8 =>  'Август',
      9 =>  'Сентябрь',
      10 => 'Октябрь',
      11 => 'Ноябрь',
      12 => 'Декабрь',
    ];
//    dd($month->year()->get());
    return view('admin.pages.about_article', compact('months', 'month'));
  }
  public function update(Request $request, AboutMonth $month){
    $months = [
      'ru' => [
        1 =>  'Январь',
        2 =>  'Февраль',
        3 =>  'Март',
        4 =>  'Апрель',
        5 =>  'Май',
        6 =>  'Июнь',
        7 =>  'Июль',
        8 =>  'Август',
        9 =>  'Сентябрь',
        10 => 'Октябрь',
        11 => 'Ноябрь',
        12 => 'Декабрь',
      ],
      'en' => [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
      ],
      'uz' => [
        1 => 'Yanvar',
        2 => 'Fevral',
        3 => 'Mart',
        4 => 'Aprel',
        5 => 'May',
        6 => 'Iyun',
        7 => 'Iyul',
        8 => 'Avgust',
        9 => 'Sentabr',
        10 => 'Oktabr',
        11 => 'Noyabr',
        12 => 'Dekabr',
      ],
    ];
    $month_ru = $months['ru'][$request['month_id']];
    $month_en = $months['en'][$request['month_id']];
    $month_uz = $months['uz'][$request['month_id']];
    if(!AboutYear::where('year', $request['year'])->exists()){
      $year = AboutYear::create(['year' => $request['year']]);
      $month->update([
        'year_id' => $year->id,
        'month_id' => $request['month_id'],
        'month_ru' => $month_ru,
        'month_en' => $month_en,
        'month_uz' => $month_uz,
        'content_ru' => $request['content_ru'],
        'content_en' => $request['content_en'],
        'content_uz' => $request['content_uz'],
      ]);
    }
    else{
      $year = AboutYear::where('year', $request['year'])->get()->first();
      $month->update([
        'year_id' => $year->id,
        'month_id' => $request['month_id'],
        'month_ru' => $month_ru,
        'month_en' => $month_en,
        'month_uz' => $month_uz,
        'content_ru' => $request['content_ru'],
        'content_en' => $request['content_en'],
        'content_uz' => $request['content_uz'],
      ]);
    }
    $month->year()->associate($year);
    $message = 'Данные для месяца <b>' . $month_ru . '</b> в году <b>' . $year->year . '</b> успешно обновлены';
    return redirect()->route('about.index')->with('message', $message);

  }

  public function disable(AboutMonth $month)
  {
    $month = AboutMonth::findOrFail($month->id);
    $month->active = 0;
    $month->save();
    $message = 'Данные для месяца <b>' . $month->month_ru . '</b> в году <b>' . $month->year()->get()->first()->year . '</b> успешно отключены';
    return redirect()->route('about.index')->with('message', $message);
  }
  public function enable(AboutMonth $month)
  {
    $month = AboutMonth::findOrFail($month->id);
    $month->active = 1;
    $month->save();
    $message = 'Данные для месяца <b>' . $month->month_ru . '</b> в году <b>' . $month->year()->get()->first()->year . '</b> успешно включены';
    return redirect()->route('about.index')->with('message', $message);
  }
}
