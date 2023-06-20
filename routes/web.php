<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\RestaurantOutletController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\OrderDetailController;
use App\Http\Controllers\Customer\CustomerController;


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

Route::group(['prefix'=>'/admin', 'as' => 'admin.'], function(){
    //Login Routes
    Route::post('/login',[LoginController::class,'login'])->name('login');
    Route::get('/', [LoginController::class,'index']);
    //Accordion Menu Routes
    Route::get('/user_list',[UserController::class,'index'])->name('user_list');
    Route::get('/restaurant_list',[RestaurantController::class,'index'])->name('restaurant_list');
    Route::get('/restaurant_outlet_list',[RestaurantOutletController::class,'index'])->name('restaurant_outlet_list');
    Route::get('/menu_list',[MenuController::class,'index'])->name('menu_list');
    Route::get('/order/{order_status}',[OrderController::class,'displayAdminOrders'])->name('order');
    Route::get('/log_out',[LoginController::class,'logOut'])->name('log_out');

    //User Routes
    Route::post('/add_user_form', [UserController::class,'toAddUserForm'])->name('add_user_form');
    Route::post('/add_user', [UserController::class,'addUser'])->name('add_user');
    Route::post('/disable_user_record/{id}',[UserController::class, 'disableUserRecord'])->name('disable_user_record');
    Route::post('/enable_user_record/{id}',[UserController::class, 'enableUserRecord'])->name('enable_user_record');
    Route::post('/to_update_user/{id}',[UserController::class,'toUpdateUser'])->name('to_update_user');
    Route::post('/update_user/{id}',[UserController::class,'updateUser'])->name('update_user');

    //Restaurant Routes
    Route::post('/add_restaurant_form', [RestaurantController::class,'toAddRestaurantForm'])->name('add_restaurant_form');
    Route::post('/add_restaurant', [RestaurantController::class,'addRestaurant'])->name('add_restaurant');
    Route::post('/disable_restaurant_record/{id}',[RestaurantController::class, 'disableRestaurantRecord'])->name('disable_restaurant_record');
    Route::post('/enable_restaurant_record/{id}',[RestaurantController::class, 'enableRestaurantRecord'])->name('enable_restaurant_record');
    Route::post('/to_update_restaurant/{id}',[RestaurantController::class,'toUpdateRestaurant'])->name('to_update_restaurant');
    Route::post('/update_restaurant/{id}',[RestaurantController::class,'updateRestaurant'])->name('update_restaurant');

    //Restaurant Outlet Routes
    Route::post('/add_restaurant_outlet_form', [RestaurantOutletController::class,'toAddRestaurantOutletForm'])->name('add_restaurant_outlet_form');
    Route::post('/add_restaurant_outlet', [RestaurantOutletController::class,'addRestaurantOutlet'])->name('add_restaurant_outlet');
    Route::post('/disable_restaurant_outlet_record/{id}',[RestaurantOutletController::class, 'disableRestaurantOutletRecord'])->name('disable_restaurant_outlet_record');
    Route::post('/enable_restaurant_outlet_record/{id}',[RestaurantOutletController::class, 'enableRestaurantOutletRecord'])->name('enable_restaurant_outlet_record');
    Route::post('/to_update_restaurant_outlet/{id}',[RestaurantOutletController::class,'toUpdateRestaurantOutlet'])->name('to_update_restaurant_outlet');
    Route::post('/update_restaurant_outlet/{id}',[RestaurantOutletController::class,'updateRestaurantOutlet'])->name('update_restaurant_outlet');

    //Menu Routes
    Route::post('/add_menu_form', [MenuController::class,'toAddMenuForm'])->name('add_menu_form');
    Route::post('/add_menu', [MenuController::class,'addMenu'])->name('add_menu');
    Route::post('/disable_menu_record/{id}',[MenuController::class, 'disableMenuRecord'])->name('disable_menu_record');
    Route::post('/enable_menu_record/{id}',[MenuController::class, 'enableMenuRecord'])->name('enable_menu_record');
    Route::post('/to_update_menu/{id}',[MenuController::class,'toUpdateMenu'])->name('to_update_menu');
    Route::post('/update_menu/{id}',[MenuController::class,'updateMenu'])->name('update_menu');
    Route::post('/display_menu', [MenuController::class,'displayMenu'])->name('display_menu');
    Route::get('/display_menu', [MenuController::class,'displayMenu'])->name('display_menu');


    //Menu Items Routes
    Route::get('/menu_item_list',[MenuItemController::class,'index'])->name('menu_item_list');
    Route::post('/add_menu_item_form', [MenuItemController::class,'toAddMenuItemForm'])->name('add_menu_item_form');
    Route::get('/add_menu_item_form', [MenuItemController::class,'toAddMenuItemForm'])->name('add_menu_item_form');
    Route::post('/add_menu_item', [MenuItemController::class,'addMenuItem'])->name('add_menu_item');
    Route::post('/disable_menu_item_record/{id}',[MenuItemController::class, 'disableMenuItemRecord'])->name('disable_menu_item_record');
    Route::post('/enable_menu_item_record/{id}',[MenuItemController::class, 'enableMenuItemRecord'])->name('enable_menu_item_record');
    Route::post('/to_update_menu_item/{id}',[MenuItemController::class,'toUpdateMenuItem'])->name('to_update_menu_item');
    Route::post('/update_menu_item/{id}',[MenuItemController::class,'updateMenuItem'])->name('update_menu_item');
    Route::post('/display_menu_items', [MenuItemController::class,'displayMenuItems'])->name('display_menu_items');
    Route::get('/display_menu_items', [MenuItemController::class,'displayMenuItems'])->name('display_menu_items');
    //Order Routes
    Route::get('/update_status/{selected_order_status}/{order_status}/{order_id}/{color}',[OrderController::class,'updateStatus'])->name('update_status');
    //Order Detail Routes
    Route::get('/order_detail/{order_id}',[OrderDetailController::class,'displayAdminOrderDetails'])->name('order_detail');
    Route::get('/back_to_order_list',function(){
        return Redirect::to(url()->previous());
    })->name('back_to_order_list');
    

});

Route::group(['prefix' => 'customer', 'as' => 'customer.'], function(){
    //Home
    Route::get('/', function () {
        return redirect()->route('customer.home');
    });
    Route::get('home', [OrderController::class,'index'])->name('home');
    Route::post('home', [OrderController::class,'index'])->name('home');

    //Login and SignUp
    Route::post('to_login', [CustomerController::class,'index'])->name('to_login');
    Route::get('to_login', [CustomerController::class,'index'])->name('to_login');
    Route::post('login', [CustomerController::class,'login'])->name('login');
    Route::get('login', [CustomerController::class,'login'])->name('login');
    Route::post('to_sign_up', [CustomerController::class,'toSignUp'])->name('to_sign_up');
    Route::get('to_sign_up', [CustomerController::class,'toSignUp'])->name('to_sign_up');
    Route::post('sign_up', [CustomerController::class,'signUp'])->name('sign_up');
    Route::get('log_out', [CustomerController::class,'logOut'])->name('log_out');
    
    //Order
    Route::get('order', [OrderController::class,'index'])->name('order');
    Route::post('order', [OrderController::class,'index'])->name('order');
    Route::get('display_menu_items', [OrderController::class,'displayMenuItems'])->name('display_menu_items');
    Route::post('increment_quantity', [OrderController::class,'incrementQuantity'])->name('increment_quantity');
    Route::post('decrement_quantity', [OrderController::class,'decrementQuantity'])->name('decrement_quantity');
    Route::post('remove_quantity', [OrderController::class,'removeQuantity'])->name('remove_quantity');
    Route::get('display_cart', [OrderController::class,'displayCart'])->name('display_cart');
    Route::get('to_cart', [OrderController::class,'toCart'])->name('to_cart');
    Route::post('to_check_out', [OrderController::class,'checkOut'])->name('to_check_out');
    Route::post('add_to_cart', [OrderController::class,'addItemToCart'])->name('add_to_cart');
    Route::post('place_order', [OrderController::class,'placeOrder'])->name('place_order');
    Route::get('display_order/{user_id}/{order_status}', [OrderController::class,'displayOrder'])->name('display_order');
    Route::get('display_order_detail/{order_id}', [OrderDetailController::class,'displayOrderDetail'])->name('display_order_detail');

    //Order History
    Route::get('order_history', function(){
        return view('order_history');
    })->name('order_history');
    
});

