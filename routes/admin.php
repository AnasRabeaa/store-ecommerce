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
        ###################################### End Logout Route   ########################################


        ######################################  Shipping Routes   ########################################
        Route::group(['prefix' => 'settings'],function () {
            Route::get('shipping-methods/{type}','SettingsController@editShippingMethods') -> name('edit.shippings.methods');
            Route::put('shipping-methods/{id}','SettingsController@updateShippingMethods') -> name('update.shippings.methods');
        });
        ###################################### End Shipping Routes   ######################################


        ###################################### Start Categories Routes   ######################################
        Route::group(['prefix' => 'categories'] , function() {
            //View All Categories Route
            Route::get('/{type?}','CategoriesController@index') -> name('view-categories');
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
        ######################################  Start Brands Route   ########################################
        Route::group(['prefix' => 'brands'] , function() {
            //View All brands Route
            Route::get('/','BrandsController@index') -> name('view-brands');
            //View Add New Brand Form
            Route::get('add-brand/','BrandsController@addBrand')->name('add-brand');
            //Store In Database New Brand
            Route::post('store-brand/','BrandsController@storeBrand')->name('store-brand');
            //View Brand To Update From
            Route::get('edit-brand/{id}','BrandsController@editBrand')->name('view-update-brand');
             //Update Brand Function
            Route::put('update-brand/{id}','BrandsController@updateBrand')->name('update-brand');
            //Delete Brand Function
            Route::get('delete-brand/{id}','BrandsController@deleteBrand')->name('delete-brand');
        });
        ######################################  End Brands   ############################################

        ###################################### Start Tags Routes ########################################
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagsController@index')->name('admin.tags');
            Route::get('create', 'TagsController@create')->name('admin.tags.create');
            Route::post('store', 'TagsController@store')->name('admin.tags.store');
            Route::get('edit/{id}', 'TagsController@edit')->name('admin.tags.edit');
            Route::post('update/{id}', 'TagsController@update')->name('admin.tags.update');
            Route::get('delete/{id}', 'TagsController@destroy')->name('admin.tags.delete');
        });
        ######################################  End Tags   ##################################################


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


