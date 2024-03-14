<?php

// use CodeZero\LocalizedRoutes\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// Route xử lý cho admin

// Route::localized(function () {

Route::namespace('Admin')->group(function () {

    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login')->name('admin.login');
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');
    Route::get('/404', array(
        'as' => 'adminError',
        'uses' => 'AdminController@error'
    ));
    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', 'HomeController@index')->name('admin.dashboard');

        // các route của quản trị viên sẽ được viết trong group này, còn chức năng của user sẽ viết ngoài route
        Route::group(['middleware' => 'checkAdminPermission'], function () {

            //Talk js
            // Route::group(['prefix' => 'talkjs'], function () {
            //     Route::get('/', 'TalkjsController@index')->name('admin.talkjs');
            // });

            //Setting cost
            // Route::group(['prefix' => 'setting-cost'], function () {
            //     Route::get('/', 'SettingCostController@index')->name('admin_setting_cost');
            //     Route::post('/', 'SettingCostController@store');
            // });

            // Xử lý users admin
            Route::group(['prefix' => 'user-admin'], function () {
                Route::get('/', 'UserAdminController@index')->name('admin.listUserAdmin');
                Route::get('edit/{id}', 'UserAdminController@edit')->name('admin.userAdminDetail');
                Route::post('post', 'UserAdminController@post')->name('admin.postUserAdmin');
                Route::get('add', 'UserAdminController@create')->name('admin.addUserAdmin');
                Route::get('/delete/{id}', 'UserAdminController@deleteUserAdmin')->name('admin.delUserAdmin');
            });

            Route::group(['prefix' => 'permission'], function () {
                Route::get('/', 'Auth\PermissionController@index')->name('admin_permission.index');
                Route::get('create', 'Auth\PermissionController@create')->name('admin_permission.create');
                Route::get('/edit/{id}', 'Auth\PermissionController@edit')->name('admin_permission.edit');
                Route::post('/post', 'Auth\PermissionController@post')->name('admin_permission.post');
                Route::get('/delete/{id}', 'Auth\PermissionController@delete')->name('admin_permission.delete');
            });
            Route::group(['prefix' => 'role'], function () {
                Route::get('/', 'Auth\RoleController@index')->name('admin_role.index');
                Route::get('create', 'Auth\RoleController@create')->name('admin_role.create');
                Route::get('/edit/{id}', 'Auth\RoleController@edit')->name('admin_role.edit');
                Route::post('/post', 'Auth\RoleController@post')->name('admin_role.post');
                Route::get('/delete/{id}', 'Auth\RoleController@delete')->name('admin_role.delete');
            });
            // Route::group(['prefix' => 'type'], function () {
            //     Route::get('/list', 'ShopTypeController@index')->name('admin_type');
            //     Route::get('/create', 'ShopTypeController@create')->name('admin_type.create');
            //     Route::get('/edit/{id}', 'ShopTypeController@edit')->name('admin_type.edit');
            //     Route::post('/post', 'ShopTypeController@post')->name('admin_type.post');
            // });

            // Discount Code
            // Route::get('/list-discount-code', 'DiscountCodeController@listDiscountCode')->name('admin.discountCode');
            // Route::get('/discount-code/create', 'DiscountCodeController@createDiscountCode')->name('admin.createDiscountCode');
            // Route::get('/discount-code/{id}', 'DiscountCodeController@discountCodeDetail')->name('admin.discountCodeDetail');
            // Route::post('/discount-code/post', 'DiscountCodeController@postDiscountCodeDetail')->name('admin.postDiscountCodeDetail');

            // Xử lý users admin
            // Route::get('/list-user-admin', 'AdminUserController@listUserAdmin')->name('admin.listUserAdmin');
            // Route::get('/user-admin/{id}', 'AdminUserController@userAdminDetail')->name('admin.userAdminDetail');
            // Route::post('/user-admin/{id}', 'AdminUserController@postUserAdminDetail')->name('admin.postUserAdminDetail');
            // Route::get('/add-user-admin', 'AdminUserController@addUserAdmin')->name('admin.addUserAdmin');
            // Route::post('/add-user-admin', 'AdminUserController@postAddUserAdmin')->name('admin.postAddUserAdmin');
            // Route::get('/delete-user-admin/{id}', 'AdminUserController@deleteUserAdmin')->name('admin.delUserAdmin');

            // Xử lý users
            Route::get('/list-users', 'AdminController@listUsers')->name('admin.listUsers');
            Route::get('/user/{id}', 'AdminController@userDetail')->name('admin.userDetail');
            Route::post('/users/{id}', 'AdminController@postUserDetail')->name('admin.postUserDetail');
            Route::get('/add-users', 'AdminController@addUsers')->name('admin.addUsers');
            Route::post('/add-users', 'AdminController@postAddUsers')->name('admin.postAddUsers');
            Route::get('/delete-user/{id}', 'AdminController@deleteUser')->name('admin.delUser');

            // Brand
            // Route::get('/list-brand', 'BrandController@index')->name('admin.brand');
            // Route::get('/brand/create', 'BrandController@create')->name('admin.brand.create');
            // Route::get('/brand/{id}', 'BrandController@edit')->name('admin.brand.edit');
            // Route::post('/brand/post', 'BrandController@post')->name('admin.brand.post');

            //Orders
            // Route::get('/list-order', 'OrderController@listOrder')->name('admin.listOrder');
            // Route::get('/search-order', 'OrderController@searchOrder')->name('admin.searchOrder');
            // Route::get('/order/{id}', 'OrderController@orderDetail')->name('admin.orderDetail');
            // Route::post('/order/post', 'OrderController@postOrderDetail')->name('admin.postOrderDetail');

            // Export excel
            Route::get('/export_customer', array('as' => 'admin.exportCustomer', 'uses' => 'AdminController@exportCustomer'));
            Route::get('/export_orders', array('as' => 'admin.exportOrders', 'uses' => 'AdminController@exportOrder'));
            Route::get('/export_products', array('as' => 'admin.exportProducts', 'uses' => 'AdminController@exportProduct'));

            // Xử lý đánh giá sản phẩm
            Route::get('/list-rating', 'AdminController@listRating')->name('admin.listRating');
            Route::get('/rating/{id}', 'AdminController@ratingDetail')->name('admin.ratingDetail');
            Route::post('rating', 'AdminController@postRating')->name('admin.postRating');
        });
        // End checkAdminPermission

        // Page
        Route::group(['prefix' => 'page'], function () {
            Route::get('/list', 'PageController@index')->name('admin.pageList');
            Route::get('create', 'PageController@create')->name('admin.createPage');
            Route::get('/edit/{id}', 'PageController@edit')->name('admin.pageEdit');
            Route::post('post', 'PageController@post')->name('admin.postPageDetail');
        });


        // Slider Home
        Route::group(['prefix' => 'slider'], function () {
            Route::get('create', 'SliderController@create')->name('admin.sliderCreate');
            Route::get('{id}', 'SliderController@edit')->name('admin.sliderEdit');
            Route::post('post', 'SliderController@postSliderDetail')->name('admin.postSliderDetail');
            Route::post('insert', 'SliderController@insert')->name('admin.slider.insert');
            Route::post('edit', 'SliderController@editSlider')->name('admin.slider.insert');
            Route::post('delete', 'SliderController@deleteSlider')->name('admin.slider.delete');
            Route::post('sort', 'SliderController@updateSort')->name('admin.slider.sort');
        });
        Route::get('slider', 'SliderController@index')->name('admin.slider');

        $admin_module = ['post', 'product', 'service', 'project', 'campaign', 'video', 'contact', 'subscription'];

        foreach ($admin_module as $item) {

            // Module data
            $prefix_controller = Str::headline($item) . 'Controller'; // postController
            $prefix_name = 'admin.' . $item; // admin.post
            Route::get($item, $prefix_controller . '@index')->name($prefix_name . 'List');
            Route::get($item . '/create', $prefix_controller .  '@create')->name($prefix_name . 'Create');
            Route::get($item . '/{id}', $prefix_controller  . '@edit')->name($prefix_name . 'Edit');
            Route::post(
                $item . '/post',
                $prefix_controller  . '@post'
            )->name($prefix_name . 'Post');

            // Module Category
            $prefix_controller = Str::headline($item) . 'CategoryController'; // postCategoryController
            $prefix_name = 'admin.' . $item . 'Category'; // admin.postCategory
            Route::get($item . '-category', $prefix_controller . '@index')->name($prefix_name . 'List');
            Route::get(
                $item . '-category/create',
                $prefix_controller . '@create'
            )->name($prefix_name . 'Create');
            Route::get($item . '-category/{id}', $prefix_controller . '@edit')->name($prefix_name . 'Edit');
            Route::post($item . '-category/post', $prefix_controller . '@post')->name($prefix_name . 'Post');

            // // Product
            // Route::get('product', 'ProductController@index')->name('admin.productList');
            // Route::get('product/create', 'ProductController@create')->name('admin.productCreate');
            // Route::get('product/{id}', 'ProductController@edit')->name('admin.productEdit');
            // Route::post('product/post', 'ProductController@post')->name('admin.productPost');

            // // Product Category
            // Route::get('product-category', 'ProductCategoryController@index')->name('admin.productCategoryList');
            // Route::get('product-category/create', 'ProductCategoryController@create')->name('admin.productCategoryCreate');
            // Route::get('product-category/{id}', 'ProductCategoryController@edit')->name('admin.productCategoryEdit');
            // Route::post('product-category/post', 'ProductCategoryController@post')->name('admin.productCategoryPost');
        }

        // Change password
        Route::get('/change-password', 'AdminController@changePassword')->name('admin.changePassword');
        Route::post('/change-password', 'AdminController@postChangePassword')->name('admin.postChangePassword');
        Route::get('/check-password', 'AjaxController@checkPassword')->name('admin.checkPassword');

        //ajax delete
        Route::post('/delete-id', 'AjaxController@ajax_delete')->name('admin.ajax_delete');

        // Ajax replicate (copy data)
        Route::post('/replicate-id', 'AjaxController@ajax_replicate')->name('admin.ajax_replicate');

        // Ajax quickchange value
        Route::post('/quick-change', 'AjaxController@ajax_quickchange')->name('admin.ajaxQuickChange');

        // Ajax process
        Route::post('ajax/process_theme_fast', 'AjaxController@processThemeFast')->name('admin.ajax.processThemeFast');
        Route::post('ajax/process_new_item', 'AjaxController@update_new_item_status')->name('admin.ajax.process_new_item');
        Route::post('ajax/process_flash_sale', 'AjaxController@update_process_flash_sale')->name('admin.ajax.process_flash_sale');
        Route::post('ajax/process_sale_top_week', 'AjaxController@update_process_sale_top_week')->name('admin.ajax.process_sale_top_week');
        Route::post('ajax/process_propose', 'AjaxController@update_process_propose')->name('admin.ajax.process_propose');
        Route::post('ajax/process_store_status', 'AjaxController@updateStoreStatus')->name('admin.ajax.process_store_status');
        Route::post('ajax/load_variable', 'AjaxController@loadVariable')->name('admin.ajax.load_variable');

        Route::get('media-manager/fm-button', 'FileManagerController@fmButton')
            ->name('fm.fm-button');

        // Email template
        Route::group(['prefix' => 'email-template'], function () {
            Route::get('/', 'EmailTemplateController@index')->name('admin.email_template');
            Route::get('edit/{id}', 'EmailTemplateController@edit')->name('admin.email_template.edit');
            Route::get('add', 'EmailTemplateController@create')->name('admin.email_template.create');
            Route::post('post', 'EmailTemplateController@post')->name('admin.email_template.post');
        });

        Route::group(['prefix' => 'admin-menu'], function () {
            Route::get('/', 'AdminMenuController@index')->name('admin_menu.index');
            Route::post('create', 'AdminMenuController@postCreate')->name('admin_menu.create');
            Route::get('edit/{id}', 'AdminMenuController@edit')->name('admin_menu.edit');
            Route::post('edit/{id}', 'AdminMenuController@postEdit')->name('admin_menu.edit');
            Route::post('delete', 'AdminMenuController@deleteList')->name('admin_menu.delete');
            Route::post('update_sort', 'AdminMenuController@updateSort')->name('admin_menu.update_sort');
        });

        // Setting
        Route::get('/menu', 'AdminController@getMenu')->name('admin.menu');
        Route::group(['prefix' => 'theme-option'], function () {
            Route::get('/', 'AdminController@getThemeOption')->name('admin.themeOption');
            Route::post('/', 'AdminController@postThemeOption')->name('admin.postThemeOption');
        });

        // Menu
        Route::post('addcustommenu', 'MenuWPController@addcustommenu')->name('haddcustommenu');
        Route::post('deleteitemmenu', 'MenuWPController@deleteitemmenu')->name('hdeleteitemmenu');
        Route::post('deletemenug', 'MenuWPController@deletemenug')->name('hdeletemenug');
        Route::post('createnewmenu', 'MenuWPController@createnewmenu')->name('hcreatenewmenu');
        Route::post('generatemenucontrol', 'MenuWPController@generatemenucontrol')->name('hgeneratemenucontrol');
        Route::post('updateMenuItem', 'MenuWPController@updateitem')->name('updateMenuItem');
    });
});
// });
