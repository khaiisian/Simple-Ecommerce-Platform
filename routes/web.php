<?php

use App\Http\Controllers\Admin\AdminItemController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'user') {
            return redirect()->route('user.item');
        } elseif (Auth::user()->role == 'admin') {
            return redirect()->route('admin.item');
        }
    }
    return view('auth.register');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/item', [ItemController::class, 'index'])->name('user.item');
    Route::get('/get-cart', function () {
        $cart_lst = Session::get('cart', []);
        $msg = 'success';
        return response()->json(['cart_lst' => $cart_lst, 'msg' => $msg]);
    });

    Route::post('/add-to-cart', function (Request $request) {
        $cartItem = $request->cartItem;
        $cart = Session::get('cart', default: ['cart' => []]);

        $itemFound = false;
        foreach ($cart['cart'] as &$item) {
            if ($item['item_id'] == $cartItem['item_id']) {
                $item['quantity'] += 1;
                $item['total_price'] = $item['item_price'] * $item['quantity'];
                $itemFound = true;
                break;
            }
        }

        if (!$itemFound) {
            $cart['cart'][] = array_merge($cartItem, ['quantity' => 1], ['total_price' => $cartItem['item_price']]);
        }

        Session::put('cart', $cart);
        return response()->json([
            'msg' => 'cart successful',
            'cart' => $cart
        ]);
    });

    Route::post('/remove-cart', function (Request $request) {
        $itemId = $request->item_id;

        $cart = Session::get('cart', ['cart' => []]);

        $cart['cart'] = array_filter($cart['cart'], function ($item) use ($itemId) {
            return $item['item_id'] != $itemId;
        });

        Session::put('cart', $cart);

        return response()->json(['msg' => 'Item removed']);
    });

    Route::post('/order', [OrderController::class, 'create'])->name('user.order');
    // Route::post('/order', function () {
    //     return view('profile.edit');
    // })->name('user.order');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/item', [AdminItemController::class, 'index'])->name('admin.item');
    Route::post('/item/create', [AdminItemController::class, 'store']);
    Route::get('/item/{id}/delete', [AdminItemController::class, 'destroy'])->name('admin.item.destroy');
    Route::get('/item/{id}/edit', [AdminItemController::class, 'edit'])->name('admin.item.edit');
    Route::post('/item/update', [AdminItemController::class, 'update'])->name('admin.item.update');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('/order-details/{id}', [AdminOrderController::class, 'show'])->name('admin.order-detail');
});

require __DIR__ . '/auth.php';