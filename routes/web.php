<?php

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Doctor Patient
    Route::delete('doctor-patients/destroy', 'DoctorPatientController@massDestroy')->name('doctor-patients.massDestroy');
    Route::resource('doctor-patients', 'DoctorPatientController');

    // Report
    Route::delete('reports/destroy', 'ReportController@massDestroy')->name('reports.massDestroy');
    Route::post('reports/media', 'ReportController@storeMedia')->name('reports.storeMedia');
    Route::post('reports/ckmedia', 'ReportController@storeCKEditorImages')->name('reports.storeCKEditorImages');
    Route::resource('reports', 'ReportController');

    // Medications
    Route::delete('medications/destroy', 'MedicationsController@massDestroy')->name('medications.massDestroy');
    Route::post('medications/media', 'MedicationsController@storeMedia')->name('medications.storeMedia');
    Route::post('medications/ckmedia', 'MedicationsController@storeCKEditorImages')->name('medications.storeCKEditorImages');
    Route::resource('medications', 'MedicationsController');

    // Test
    Route::delete('tests/destroy', 'TestController@massDestroy')->name('tests.massDestroy');
    Route::post('tests/media', 'TestController@storeMedia')->name('tests.storeMedia');
    Route::post('tests/ckmedia', 'TestController@storeCKEditorImages')->name('tests.storeCKEditorImages');
    Route::resource('tests', 'TestController');

    // Appointment
    Route::delete('appointments/destroy', 'AppointmentController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentController');

    // Drug
    Route::delete('drugs/destroy', 'DrugController@massDestroy')->name('drugs.massDestroy');
    Route::post('drugs/media', 'DrugController@storeMedia')->name('drugs.storeMedia');
    Route::post('drugs/ckmedia', 'DrugController@storeCKEditorImages')->name('drugs.storeCKEditorImages');
    Route::resource('drugs', 'DrugController');

    // Doctor Field
    Route::delete('doctor-fields/destroy', 'DoctorFieldController@massDestroy')->name('doctor-fields.massDestroy');
    Route::resource('doctor-fields', 'DoctorFieldController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', 'patient', 'code.confirmed']], function () {
    Route::get('/home', function () {
        return redirect()->route('frontend.profile.index');
    })->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Doctor Patient
    Route::delete('doctor-patients/destroy', 'DoctorPatientController@massDestroy')->name('doctor-patients.massDestroy');
    Route::resource('doctor-patients', 'DoctorPatientController');

    // Report
    Route::delete('reports/destroy', 'ReportController@massDestroy')->name('reports.massDestroy');
    Route::post('reports/media', 'ReportController@storeMedia')->name('reports.storeMedia');
    Route::post('reports/ckmedia', 'ReportController@storeCKEditorImages')->name('reports.storeCKEditorImages');
    Route::resource('reports', 'ReportController');

    // Medications
    Route::delete('medications/destroy', 'MedicationsController@massDestroy')->name('medications.massDestroy');
    Route::post('medications/media', 'MedicationsController@storeMedia')->name('medications.storeMedia');
    Route::post('medications/ckmedia', 'MedicationsController@storeCKEditorImages')->name('medications.storeCKEditorImages');
    Route::resource('medications', 'MedicationsController');

    // Test
    Route::delete('tests/destroy', 'TestController@massDestroy')->name('tests.massDestroy');
    Route::post('tests/media', 'TestController@storeMedia')->name('tests.storeMedia');
    Route::post('tests/ckmedia', 'TestController@storeCKEditorImages')->name('tests.storeCKEditorImages');
    Route::resource('tests', 'TestController');

    // Appointment
    Route::delete('appointments/destroy', 'AppointmentController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentController');

    // Drug
    Route::delete('drugs/destroy', 'DrugController@massDestroy')->name('drugs.massDestroy');
    Route::post('drugs/media', 'DrugController@storeMedia')->name('drugs.storeMedia');
    Route::post('drugs/ckmedia', 'DrugController@storeCKEditorImages')->name('drugs.storeCKEditorImages');
    Route::resource('drugs', 'DrugController');

    // Doctor Field
    Route::delete('doctor-fields/destroy', 'DoctorFieldController@massDestroy')->name('doctor-fields.massDestroy');
    Route::resource('doctor-fields', 'DoctorFieldController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});

Route::get('code/confirm', [\App\Http\Controllers\ConfirmCodeController::class, 'index'])->name('code.confirm');
Route::post('/code', [\App\Http\Controllers\ConfirmCodeController::class, 'confirmCode'])->middleware('auth')->name('code.confirmCode');
