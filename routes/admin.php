<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

// note that the prefix is admin for all file route

###################################### Start Mcamara Routes     ######################################
Route::group(['prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    ###################################### Start Admin Guest Routes ######################################
    Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
        Route::get('/','DashboardController@index') -> name('admin.dashboard');  // first admin page admin visits if authenticated
        ###################################### Start Logout Route   ######################################
        Route::get('logout', 'LoginController@logoutAdmin')->name('admin.logout');
        ###################################### End Logout Route   ######################################
        ######################################  Shipping Routes   ######################################
        Route::group(['prefix' => 'settings'],function () {
            Route::get('shipping-methods/{type}','SettingsController@editShippingMethods') -> name('edit.shippings.methods');
            Route::put('shipping-methods/{id}','SettingsController@updateShippingMethods') -> name('update.shippings.methods');
        });
        ###################################### End Shipping Routes   ######################################
            ###################################### Start Categories Routes   ######################################
            Route::group(['prefix' => 'categories'] , function() {
                //View All Categories Route
                Route::get('categories/{type?}','CategoriesController@index') -> name('view-categories');
                //View Add New Main Category Form
                Route::get('add-category/{type?}','CategoriesController@addCategory')->name('add-category');
                //Store In Database New Main Category
                Route::post('store-category/{type}','CategoriesController@storeMainCategory')->name('store-category');
                //View Category To Update From
                Route::get('edit-category/{id}','CategoriesController@editCategory')->name('view-update-category');
                //Update Category Function
                Route::put('update-category/{id}','CategoriesController@updateCategory')->name('update-category');
                //Delete Category Function
                Route::get('delete-category/{id}','CategoriesController@deleteCategory')->name('delete-category');

            });
            ###################################### End Categories Routes   ######################################
        ###################################### Start Edit Profile Routes   ######################################
        Route::Group(['prefix' => 'profile'], function () {
                Route::get('admin-profile', 'AdminProfileController@adminProfile')->name('admin-profile');
                Route::put('update-admin-profile/{id}', 'AdminProfileController@updateAdminProfile')->name('update-admin-profile');
            });
        ###################################### End Edit Profile Routes   ######################################
    });
    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin', 'prefix' => 'admin'], function () {
        //View Admin Login Form
        Route::get('login', 'LoginController@login') -> name('admin.login');
        // Authenticate Admin If Exists In DB
        Route::post('login', 'LoginController@postLogin') -> name('admin.post.login');
    });
});


