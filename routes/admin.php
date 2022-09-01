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

###################################### Start Mcamara Routes     ############################################################
Route::group(['prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    ###################################### Start Admin Guest Routes #########################################################
    Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
        Route::get('/','DashboardController@index') -> name('admin.dashboard');  // first admin page admin visits if authenticated
        ###################################### Start Logout Route   #########################################################
        Route::get('logout', 'LoginController@logoutAdmin')->name('admin.logout');
        ###################################### End Logout Route   ###########################################################


        ######################################  Shipping Routes   ###########################################################
        Route::group(['prefix' => 'settings'],function () {
            Route::get('shipping-methods/{type}','SettingsController@editShippingMethods') -> name('edit.shippings.methods');
            Route::put('shipping-methods/{id}','SettingsController@updateShippingMethods') -> name('update.shippings.methods');
        });
        ###################################### End Shipping Routes   ########################################################


        ###################################### Start Categories Routes   ####################################################
        Route::group(['prefix' => 'main_categories'], function () {
            Route::get('/', 'MainCategoriesController@index')->name('admin.maincategories');
            Route::get('create', 'MainCategoriesController@create')->name('admin.maincategories.create');
            Route::post('store', 'MainCategoriesController@store')->name('admin.maincategories.store');
            Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.maincategories.edit');
            Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.maincategories.update');
            Route::get('delete/{id}', 'MainCategoriesController@destroy')->name('admin.maincategories.delete');
        });
        ###################################### End Categories Routes   #################################################


        ######################################  Start Brands Route   ###################################################
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
        ######################################  End Brands   ###########################################################


        ###################################### Start Tags Routes #######################################################
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagsController@index')->name('admin.tags');
            Route::get('create', 'TagsController@create')->name('admin.tags.create');
            Route::post('store', 'TagsController@store')->name('admin.tags.store');
            Route::get('edit/{id}', 'TagsController@edit')->name('admin.tags.edit');
            Route::post('update/{id}', 'TagsController@update')->name('admin.tags.update');
            Route::get('delete/{id}', 'TagsController@destroy')->name('admin.tags.delete');
        });
        ######################################  End Tags   #############################################################


        ################################## Products Routes #############################################################
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductsController@index')->name('admin.products');
            Route::get('general-information', 'ProductsController@create')->name('admin.products.general.create');
            Route::post('store-general-information', 'ProductsController@store')->name('admin.products.general.store');

            Route::get('price/{id}', 'ProductsController@getPrice')->name('admin.products.price');
            Route::post('price', 'ProductsController@saveProductPrice')->name('admin.products.price.store');

            Route::get('stock/{id}', 'ProductsController@getStock')->name('admin.products.stock');
            Route::post('stock', 'ProductsController@saveProductStock')->name('admin.products.stock.store');

            Route::get('images/{id}', 'ProductsController@addImages')->name('admin.products.images');
            Route::post('images', 'ProductsController@saveProductImages')->name('admin.products.images.store');
            Route::post('images/db', 'ProductsController@saveProductImagesDB')->name('admin.products.images.store.db');
            Route::get('delete/{id}', 'ProductsController@destroy')->name('admin.products.delete');
        });
        ################################## End Products    ###############################################################


        ################################## Attrributes Routes ###########################################################
        Route::group(['prefix' => 'attributes'], function () {
            Route::get('/', 'AttributesController@index')->name('admin.attributes');
            Route::get('create', 'AttributesController@create')->name('admin.attributes.create');
            Route::post('store', 'AttributesController@store')->name('admin.attributes.store');
            Route::get('delete/{id}', 'AttributesController@destroy')->name('admin.attributes.delete');
            Route::get('edit/{id}', 'AttributesController@edit')->name('admin.attributes.edit');
            Route::post('update/{id}', 'AttributesController@update')->name('admin.attributes.update');
        });
        ################################## End Attributes    ############################################################


        ################################## Attrributes Options ###########################################################
        Route::group(['prefix' => 'options'], function () {
            Route::get('/', 'OptionsController@index')->name('admin.options');
            Route::get('create', 'OptionsController@create')->name('admin.options.create');
            Route::post('store', 'OptionsController@store')->name('admin.options.store');
            Route::get('delete/{id}','OptionsController@destroy') -> name('admin.options.delete');
            Route::get('edit/{id}', 'OptionsController@edit')->name('admin.options.edit');
            Route::post('update/{id}', 'OptionsController@update')->name('admin.options.update');
        });
        ################################## End Options    ############################################################




        ###################################### Start Edit Profile Routes   ###############################################
        Route::Group(['prefix' => 'profile'], function () {
                Route::get('admin-profile', 'AdminProfileController@adminProfile')->name('admin-profile');
                Route::put('update-admin-profile/{id}', 'AdminProfileController@updateAdminProfile')->name('update-admin-profile');
            });
        ###################################### End Edit Profile Routes   #################################################
    });
    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin', 'prefix' => 'admin'], function () {
        //View Admin Login Form
        Route::get('login', 'LoginController@login') -> name('admin.login');
        // Authenticate Admin If Exists In DB
        Route::post('login', 'LoginController@postLogin') -> name('admin.post.login');
    });
});


