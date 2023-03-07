<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BO\PubController;
use App\Http\Controllers\BO\MealController;
use App\Http\Controllers\BO\RoleController;
use App\Http\Controllers\BO\TypeController;
use App\Http\Controllers\BO\UserController;
use App\Http\Controllers\BO\GroupController;
use App\Http\Controllers\BO\PriceController;
use App\Http\Controllers\BO\PromoController;
use App\Http\Controllers\BO\OrdersController;
use App\Http\Controllers\BO\DeleverController;
use App\Http\Controllers\BO\CategoryController;
use App\Http\Controllers\BO\PartenerController;
use App\Http\Controllers\BO\UserAuthController;
use App\Http\Controllers\BO\CustomersController;
use App\Http\Controllers\BO\DashboardController;
use App\Http\Controllers\BO\PromotionsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/login', [UserAuthController::class, 'login'])->name('user.auth');

Route::group(['middleware' => ['auth:sanctum']], function(){
    //user
    Route::post('user/infos', [UserAuthController::class, 'info'])->name('user.info');
    Route::post('user/logout', [UserAuthController::class, 'logout'])->name('user.logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::controller(PriceController::class)->group(function(){
        Route::get('prices', 'index')->name('price.index');
        Route::get('price/edit/{id}', 'edit')->name('price.edit');
        Route::get('price/create', 'create')->name('price.create');
        Route::post('price/store', 'store')->name('price.store');
        Route::post('price/update/{id}', 'update')->name('price.update');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('categories', 'index')->name('category.index');
        Route::get('category/show/{id}', 'show')->name('category.show');
        Route::get('category/edit/{id}', 'edit')->name('category.edit');
        Route::post('category/store', 'store')->name('category.store');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category/update/{id}', 'update')->name('category.update');
        
    });

    Route::controller(GroupController::class)->group(function(){
        Route::get('groups', 'index')->name('group.index');
        Route::get('group/show/{id}', 'show')->name('group.show');
        Route::get('group/edit/{id}', 'edit')->name('group.edit');
        Route::get('group/create', 'create')->name('group.create');
        Route::post('group/store', 'store')->name('group.store');
        Route::post('group/update/{id}', 'update')->name('group.update');
        
    });

    Route::controller(TypeController::class)->group(function(){
        Route::post('type/store','store')->name('type.store');
        Route::post('type/update/{id}','update')->name('type.update');
        Route::get('type/show/{id}','show')->name('type.show');
        Route::get('type/create', 'create')->name('type.create');
        Route::get('type/edit/{id}','edit')->name('type.edit');
        Route::get('types','index')->name('type.index');
        Route::delete('type/delete/{type}','destroy')->name('type.destroy');
    });

    Route::controller(RoleController::class)->group(function(){
        Route::post('role/store','store')->name('role.store');
        Route::post('role/update/{id}','update')->name('role.update');
        Route::get('role/edit/{id}','edit')->name('role.edit');
        Route::get('role/show/{id}', 'show')->name('role.show');
        Route::get('roles', 'index')->name('role.index');
    });

    Route::controller(DeleverController::class)->group(function(){
        Route::get('delevers', 'index')->name('delever.index');
        Route::get('delever/show/{id}', 'show')->name('delever.show');
        Route::get('delever/edit/{id}', 'edit')->name('delever.edit');
        Route::get('delever/create', 'create')->name('delever.create');
        Route::get('delever/operations/{id}', 'operate')->name('delever.operate');
        Route::post('delever/store', 'store')->name('delever.store');
        Route::delete('delever/destroy/{delever}', 'destroy')->name('delever.destory');
        Route::get('delever/block/{id}', 'block')->name('delever.block');
        Route::post('delever/update/{id}', 'update')->name('delever.update');
        Route::get('delever/action/{id}', 'valide')->name('delever.action');
    });
    Route::controller(UserController::class)->group(function(){
        Route::post('user/store','store');
        Route::post('user/update/{id}','update');
        Route::get('user/edit/{id}','edit');
        Route::get('user/show/{id}','show');
        Route::get('users','index');
        Route::get('user/create', 'create')->name('user.create');
        Route::delete('user/destroy/{user}','destroy');
    });

    Route::controller(MealController::class)->group(function(){
        Route::get('partener/{id}/meals', 'index')->name('meal.index');
        Route::get('meals/latest', 'latestMeals')->name('meal.latest');
        Route::get('partener/{partener_id}/meal/show/{id}', 'show')->name('meal.show');
        Route::get('meal/edit/{id}', 'edit')->name('meal.edit');
        Route::get('partener/{partener_id}/meal/create', 'create')->name('meal.create');
        Route::post('partener/{partener_id}/meal/store', 'store')->name('meal.store');
        Route::post('meal/update/{id}', 'update')->name('meal.update');
        Route::delete('meal/destroy/{id}','destroy')->name('meal.destroy');

    });

    Route::controller(PubController::class)->group(function(){
        Route::get('pubs', 'index')->name('pub.index');
        Route::get('pub/show/{id}', 'show')->name('pub.show');
        Route::get('pub/edit/{id}', 'edit')->name('pub.edit');
        Route::get('pub/create', 'create')->name('pub.create');
        Route::post('pub/store', 'store')->name('pub.store');
        Route::get('pub/action/{id}', 'activeOrDesactive')->name('pub.action');
        Route::get('pub/promotion/{id}', 'promote')->name('pub.promote');
        Route::post('pub/update/{id}', 'update')->name('pub.update');
        Route::delete('pub/destroy/{pub}','destroy')->name('pub.destroy');
    
    });

    Route::controller(PartenerController::class)->group(function(){
        Route::get('parteners', 'index')->name('partener.index');
        Route::get('partener/show/{id}', 'show')->name('partener.show');
        Route::get('partener/edit/{id}', 'edit')->name('partener.edit');
        Route::get('partener/create', 'create')->name('partener.create');
        Route::get('partener/action/{id}', 'activeOrDesactive')->name('partener.action');
        Route::post('partener/store', 'store')->name('partener.store');
        Route::post('partener/update/{id}', 'update')->name('partener.update');
        Route::delete('partener/destroy/{id}','destroy')->name('partener.destroy');
        
    });

    Route::controller(CustomersController::class)->group(function(){
        Route::get('customers', 'index')->name('customer.index');
        Route::get('customers/operations/{id}', 'operate')->name('customer.operate');
    });

    Route::controller(OrdersController::class)->group(function(){
        Route::get('all/orders', 'all')->name('order.all');
        Route::get('progress/orders', 'in_progress')->name('order.progress');
        Route::get('delived/orders', 'delived')->name('order.delived');
        Route::get('order/show/{id}', 'show')->name('order.show');
    });

    Route::controller(PromotionsController::class)->group(function(){
        Route::get('promotions', 'index')->name('promo.index');
        //Route::get('promotion/show/{id}', 'show')->name('promo.show');
        Route::get('promotions/edit/{id}', 'edit')->name('promo.edit');
        Route::get('promotions/create', 'create')->name('promo.create');
        Route::post('promotions/store', 'store')->name('promo.store');
        Route::post('promotions/update/{id}', 'update')->name('promo.update');
        Route::delete('promotions/destroy/{id}','destroy')->name('promo.destroy');
        Route::get('promotions/action/{id}', 'activeOrDesactive')->name('promo.action');
    });

    /* Route::controller(PromoController::class)->group(function(){
        Route::get('promos', 'index')->name('promo.index');
        Route::get('promo/show/{id}', 'show')->name('promo.show');
        Route::get('promo/edit/{id}', 'edit')->name('promo.edit');
        Route::get('promo/create', 'create')->name('promo.create');
        Route::post('promo/store', 'store')->name('promo.store');
        Route::post('promo/update/{id}', 'update')->name('promo.update');
        Route::delete('promo/destroy/{promo}','destroy')->name('promo.destroy');
    }); */


    Route::controller(UserController::class)->group(function(){
        Route::get('user/index', 'index')->name('user.index');
        Route::get('user/create', 'create')->name('user.create');
        Route::get('user/show/{id}', 'show')->name('user.show');
        Route::get('user/edit/{id}', 'edit')->name('user.edit');
        Route::post('user/store', 'store')->name('user.store');
        Route::post('user/update/{id}', 'update')->name('user.update');
        Route::delete('user/delete/{id}', 'destroy')->name('user.delete');
    });

});

Route::controller(UserAuthController::class)->group(function(){
    Route::get('login', 'index')->name('login');
    Route::post('user/login', 'login')->name('user.login');
    Route::get('deconnection', 'logout')->name('user.logout');
});
