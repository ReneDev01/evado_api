<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PubsController;
use App\Http\Controllers\API\MealsController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PlaceController;
use App\Http\Controllers\API\TypesController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\NotifyController;
use App\Http\Controllers\API\PricesController;
use App\Http\Controllers\API\PromosController;
use App\Http\Controllers\API\DeliversController;
use App\Http\Controllers\API\PartenersController;
use App\Http\Controllers\API\OperationsController;
use App\Http\Controllers\API\DeleverAuthController;
use App\Http\Controllers\API\CustomerAuthController;
use App\Http\Controllers\API\PartenerAuthController;
use App\Http\Controllers\PushNotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth
Route::post('customer/login', [CustomerAuthController::class, 'login'])->name('customer.auth');

Route::post('delever/login', [DeleverAuthController::class, 'login'])->name('delever.auth');
Route::post('partener/login', [PartenerAuthController::class, 'login'])->name('partener.auth');
Route::group(['middleware' => ['auth:sanctum']], function(){
    //customer
    Route::get('customer/infos', [CustomerAuthController::class, 'info'])->name('customer.infos');
    Route::post('customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
    Route::post('customer/complete/info', [CustomerAuthController::class, 'completeInfo'])->name('customer.complete');
    Route::post('customer/update', [CustomerAuthController::class, 'update'])->name('customer.update');
    Route::post('customer/fcnToken', [CustomerAuthController::class, 'add_fcnToken']);
    Route::post('customer/credit/account', [CustomerAuthController::class, 'creditAccount']);
    //delever
    Route::get('delever/infos', [DeleverAuthController::class, 'info'])->name('delever.infos');
    Route::post('delever/logout', [DeleverAuthController::class, 'logout'])->name('delever.logout');
    Route::post('delever/update', [DeleverAuthController::class, 'update']);
    Route::get('delever/take/order/{id}', [DeliversController::class, 'takeOrder']);
    Route::get('delever/orders', [DeliversController::class, 'deliverOrder']);
    Route::post('order/delived/{id}', [DeliversController::class, 'order_delived']);
    Route::get('order/deliver/stats', [DeliversController::class, 'deliver_stat']);
    Route::post('deliver/fcnToken', [DeleverAuthController::class, 'add_fcnToken']);
    //partener
    Route::get('partener/infos', [PartenerAuthController::class, 'info'])->name('partener.infos');
    Route::post('partener/logout', [PartenerAuthController::class, 'logout'])->name('partener.logout');
    Route::get('partener/all/order', [PartenersController::class, 'partener_order'])->name('partener.orderAll');
    Route::get('partener/order/progress', [PartenersController::class, 'order_in_progress'])->name('partener.progress');
    Route::get('partener/order/delived', [PartenersController::class, 'order_delived'])->name('partener.delived');
    Route::get('order/partener/stats', [PartenersController::class, 'partener_stat']);
    Route::post('partener/order/confirmed/{id}', [PartenersController::class, 'confirmed_order']);
    Route::post('partener/fcn_token', [PartenerAuthController::class, 'add_fcnToken']);
    //place
    Route::controller(PlaceController::class)->group(function(){
        Route::get('places', 'index');
        Route::get('place/show/{id}', 'show');
        Route::get('place/edit/{id}', 'edit');
        Route::post('place/store', 'store');
        Route::post('place/update/{id}', 'update');
        Route::delete('place/destroy/{place}','destroy');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('orders', 'index');
        Route::get('orders/in_progress', 'in_progress');
        Route::get('orders/delived', 'delived');
        Route::get('orders/list', 'not_taked');
        Route::get('order/show/{id}', 'show');
        Route::post('order/store', 'store');
    });

    Route::controller(OperationsController::class)->group(function(){
        Route::get('delever/paiement/all', 'delever_paiement_get');
        Route::post('delever/paiement', 'delever_paiement');

        Route::get('customer/account/history', 'get_customer_credit');
        Route::post('customer/credit/account', 'creditAccount');
        Route::post('customer/credit/confirmation', 'confirm_paygate');

    });

    //notification
    Route::post('start/notify', [NotifyController::class, 'start']);
    Route::post('promo/notify', [NotifyController::class, 'promoNotify']);

    /* pubs latest all */
    Route::get('pubs/latest', [PubsController::class, 'latestPubs']);
    Route::get('pubs/promo', [PubsController::class, 'promo']);
    /* latest promos */
    Route::get('promos/latest', [PromosController::class, 'latestPromos']);

    /* latest meals */
    Route::get('meals/latest', [MealsController::class, 'latestMeals']);
    Route::get('meal/{id}', [MealsController::class, 'mealShow']);

    //Type partener
    Route::get('type/liste', [TypesController::class, 'typeList']);
    Route::get('partener/type/{id}', [TypesController::class, 'typePartener']);

    //partener group
    Route::get('partener/groups/{id}', [PartenersController::class, 'partenerGroups'])->name('partener.group');
    Route::get('partener/group/meals/{id}', [PartenersController::class, 'partenerGroupMeal'])->name('partener_group.meals');
    Route::get('partener/meals/{id}', [PartenersController::class, 'partenerAllMeals'])->name('partener.meals');

    //parteners
    Route::get('parteners', [PartenersController::class, 'getParteners'])->name('partener.all');

});

Route::post('send',[PushNotificationController::class, 'bulksend'])->name('bulksend');
Route::get('all-notifications', [PushNotificationController::class, 'index']);
Route::get('get-notification-form', [PushNotificationController::class, 'create']);

//price
Route::get('price', [PricesController::class, 'index']);
Route::get('order/all', [OrderController::class, 'all']);
//parteners
Route::get('parteners', [PartenersController::class, 'getParteners'])->name('partener.all');
Route::post('partener/search', [PartenersController::class, 'searchPartener'])->name('partener.saerch');




//validation 
Route::post('customer/validation', [CustomerAuthController::class, 'smsValidate'])->name('customer.validation');
//password forgot
Route::post('customer/update/pass', [CustomerAuthController::class, 'passForgot'])->name('customer.passUpdate');
Route::post('delever/update/pass', [DeleverAuthController::class, 'passForgot']);
Route::post('partener/update/pass', [PartenerAuthController::class, 'passForgot']);

Route::controller(ClientController::class)->group(function(){
    Route::get('customers', 'index');
    Route::get('customer/show/{id}', 'show');
    Route::get('customer/edit/{id}', 'edit');
    Route::post('customer/store', 'store');
    Route::post('customer/block/{id}', 'block');
    //Route::post('customer/update/{id}', 'update');
});

Route::post('confirmation/action', [OperationsController::class, 'confirm_paygate']);


