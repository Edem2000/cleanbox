<?php

use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminBlogNewsController;
use App\Http\Controllers\Admin\AdminBlogPressController;
use App\Http\Controllers\Admin\AdminContactRequestsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDiplomasController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['set_locale'])->group(function (){
  Route::get('/', [MainController::class, 'getIndex'])->name('getIndex');
  Route::prefix('/catalog')->group(function (){
    Route::get('/', [MainController::class, 'getCatalog'])->name('getCatalog');
    Route::get('/{id}', [MainController::class, 'getProductPage'])->where('id', '[0-9]+')->name('getProductPage');
  });
  Route::prefix('/cart')->group(function(){
    Route::get('/', [MainController::class, 'getCart'])->name('getCart');
    Route::post('/add', [CartController::class, 'cartAdd'])->name('cartAdd');
    Route::post('/increase', [CartController::class, 'increaseCartItemQuantity'])->name('increaseCartItemQuantity');
    Route::post('/decrease', [CartController::class, 'decreaseCartItemQuantity'])->name('decreaseCartItemQuantity');
    Route::post('/remove', [CartController::class, 'cartRemove'])->name('cartRemove');
    Route::get('/getQuantity', [CartController::class, 'getCartQuantity'])->name('getCartQuantity');
  });
  Route::prefix('/checkout')->group(function (){
    Route::get('/', [MainController::class, 'getCheckoutPage'])->name('getCheckoutPage');
    Route::post('/make', [MainController::class, 'checkoutComplete'])->name('checkoutComplete');
//        Route::post('/make', function (){
//            dd('I am here');
//        })->name('checkoutComplete');
    Route::get('/complete/{id}', [MainController::class, 'checkoutSuccess'])->where('id', '[0-9]+')->name('checkoutSuccess');
  });

  Route::prefix('/blog')->group(function (){
    Route::get('/', [MainController::class, 'getBlogPage'])->name('getBlogPage');
    Route::get('/article/{news}', [MainController::class, 'getBlogArticlePage'])->where('id', '[0-9]+')->name('getBlogArticlePage');
    Route::post('/article/{id}/shares/update', [MainController::class, 'updateShares'])->where('id', '[0-9]+');
  });
  Route::post('/send-contact', [MainController::class, 'sendContactForm'])->name('sendContactForm');
  Route::get('/why-us', [MainController::class, 'getDiplomas'])->name('getDiplomas');
  Route::get('/about', [MainController::class, 'getAbout'])->name('getAbout');
});
Route::middleware(['auth'])->prefix('admin')->group(function (){
  Route::get('/', [AdminController::class, 'getAdminDashboard'])->name('getAdminDashboard');
  Route::prefix('products/{product}')->group(function (){
    Route::get('/disable', [ProductController::class, 'disable'])->name('disableProduct');
    Route::get('/enable', [ProductController::class, 'enable'])->name('enableProduct');
    Route::get('/makeHidden', [ProductController::class, 'makeHidden'])->name('hideProduct');
    Route::get('/makeVisible', [ProductController::class, 'makeVisible'])->name('showProduct');
  });
  Route::resource('products', ProductController::class);
//  Route::put('/products/{product}', function(Request $request){
//    dd($request->all());
//  })->name('products.update');
  Route::prefix('/blog')->group(function(){
    Route::prefix('/news/{news}')->group(function (){
      Route::get('/disable', [AdminBlogNewsController::class, 'disable'])->name('disableNews');
      Route::get('/enable', [AdminBlogNewsController::class, 'enable'])->name('enableNews');
    });
    Route::resource('news', AdminBlogNewsController::class);
    Route::prefix('/press/{press}')->group(function (){
      Route::get('/disable', [AdminBlogPressController::class, 'disable'])->name('disablePress');
      Route::get('/enable', [AdminBlogPressController::class, 'enable'])->name('enablePress');
    });
    Route::resource('press', AdminBlogPressController::class);
  });
  Route::resource('orders', AdminOrderController::class);
  Route::resource('diplomas', AdminDiplomasController::class);
  Route::prefix('/diplomas/{diploma}')->group(function (){
    Route::get('/disable', [AdminDiplomasController::class, 'disable'])->name('disableDiploma');
    Route::get('/enable', [AdminDiplomasController::class, 'enable'])->name('enableDiploma');
  });
  Route::prefix('/feedback')->group(function (){
    Route::get('/', [AdminContactRequestsController::class, 'index'])->name('feedback.index');
    Route::prefix('/{id}')->group(function (){
      Route::get('/activate', [AdminContactRequestsController::class, 'markRequestAsProcessed'])->name('markRequestAsProcessed');
      Route::get('/deactivate', [AdminContactRequestsController::class, 'markRequestAsWaiting'])->name('markRequestAsWaiting');
    });

  });
  Route::prefix('/contacts')->group(function (){
    Route::get('/', [AdminController::class, 'getContactsPage'])->name('contacts.index');
    Route::post('/update', [AdminController::class, 'updateContactsPage'])->name('contacts.update');
  });
  Route::prefix('/about')->group(function (){
    Route::get('/', [AdminAboutController::class, 'index'])->name('about.index');
    Route::get('/create', [AdminAboutController::class, 'create'])->name('about.create');
    Route::post('/store', [AdminAboutController::class, 'store'])->name('about.store');
    Route::prefix('{month}')->group(function (){
      Route::get('/edit', [AdminAboutController::class, 'edit'])->name('about.edit');
      Route::post('/update', [AdminAboutController::class, 'update'])->name('about.update');
      Route::get('/enable', [AdminAboutController::class, 'enable'])->name('about.enable');
      Route::get('/disable', [AdminAboutController::class, 'disable'])->name('about.disable');
    });
  });
});

Route::get('/locale/{locale}', [MainController::class, 'changeLocale'])->where('locale', 'ru|en|uz')->name('locale');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/create-link', function (){
  Artisan::call('storage:link');
});
Route::get('/cache', function (){
  Artisan::call('optimize');
});

require __DIR__.'/auth.php';
