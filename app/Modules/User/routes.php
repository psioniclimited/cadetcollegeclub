<?php

/*
  |--------------------------------------------------------------------------
  | User Routes
  |--------------------------------------------------------------------------
  |
  | All the routes for User module has been written here
  |
  |
 */
Route::group(['middleware' => ['web']], function () {
    
    //Route::get('/', 'App\Modules\User\Controllers\IndexController@index');

    
    //Login Module
    Route::get('login', 'App\Modules\User\Controllers\IndexController@index');
    Route::post('user_login', 'App\Modules\User\Controllers\IndexController@loginUser');

    Route::get('logout', 'App\Modules\User\Controllers\IndexController@logoutUser');

    //User Module
    Route::get('allusers', 'App\Modules\User\Controllers\IndexController@allUsers')->middleware(['permission:user.read']);
    Route::get('getusers', 'App\Modules\User\Controllers\IndexController@getUsers')->middleware(['permission:user.read']);
    Route::get('create_users', 'App\Modules\User\Controllers\IndexController@createUsers');
    Route::post('create_users_process', 'App\Modules\User\Controllers\IndexController@createUsersProcess');
    
    Route::get('users/{id}/edit', 'App\Modules\User\Controllers\IndexController@editUsers')->middleware(['permission:user.update']);
    Route::post('edit_users_process', 'App\Modules\User\Controllers\IndexController@editUsersProcess')->middleware(['permission:user.update']);


    //User Settings
    Route::get('roles', 'App\Modules\User\Controllers\UserSettingsController@allRoles')->middleware(['permission:role.readAndcreate']);
    Route::get('getroles', 'App\Modules\User\Controllers\UserSettingsController@getRoles')->middleware(['permission:role.readAndcreate']);
    Route::post('role_add_process', 'App\Modules\User\Controllers\UserSettingsController@addRolesProcess')->middleware(['permission:role.readAndcreate']);   
    Route::get('roles/{id}/edit', 'App\Modules\User\Controllers\UserSettingsController@editRoles')->middleware(['permission:role.readAndcreate']);
    Route::post('role_edit_process', 'App\Modules\User\Controllers\UserSettingsController@editRolesProcess')->middleware(['permission:permission.readAndcreate']);
    

    Route::get('permissions', 'App\Modules\User\Controllers\UserSettingsController@allPermissions')->middleware(['permission:permission.readAndcreate']);
    Route::get('getpermissions', 'App\Modules\User\Controllers\UserSettingsController@getPermissions')->middleware(['permission:permission.readAndcreate']);
    Route::post('permission_add_process', 'App\Modules\User\Controllers\UserSettingsController@addPermissionsProcess')->middleware(['permission:permission.readAndcreate']);
    Route::get('permission/{id}/edit', 'App\Modules\User\Controllers\UserSettingsController@editPermission')->middleware(['permission:permission.readAndcreate']);
    Route::post('permission_edit_process', 'App\Modules\User\Controllers\UserSettingsController@editPermissionProcess')->middleware(['permission:permission.readAndcreate']);
    
   
    /****************
    * Delete a User *
    *****************/     
    Route::post('users/{user}/delete', 'App\Modules\User\Controllers\IndexController@deleteUser')->middleware(['permission:user.delete']);    
    
});

