<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class AdminContactRequestsController extends Controller
{
    public function index(Request $request){
      $requestsQuery = ContactRequest::query();
      if($request->filled('processed')){
        $requestsQuery->orWhere('status', '1');
      }
      if($request->filled('waiting')){
        $requestsQuery->orWhere('status', '0');
      }
      $requests = $requestsQuery->orderByDesc('created_at')->paginate(10)->withPath('?' . $request ->getQueryString());
      return view('admin.pages.contact_requests', compact('requests'));
    }
    public function markRequestAsProcessed($id){

      $request = ContactRequest::findOrFail($id);
      $request->status = 1;
      $request->save();
      $message = 'Заявка <b>' . $request->id . '</b> успешно отмечена как обработанная';
      return redirect()->back()->with('message', $message);
    }
    public function markRequestAsWaiting($id){

      $request = ContactRequest::findOrFail($id);
      $request->status = 0;
      $request->save();
      $message = 'Заявка <b>' . $request->id . '</b> успешно отмечена как необработанная';
      return redirect()->back()->with('message', $message);
    }
}
