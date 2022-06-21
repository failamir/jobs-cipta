<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Jobs
    Route::delete('jobs/destroy', 'JobsController@massDestroy')->name('jobs.massDestroy');
    Route::post('jobs/media', 'JobsController@storeMedia')->name('jobs.storeMedia');
    Route::post('jobs/ckmedia', 'JobsController@storeCKEditorImages')->name('jobs.storeCKEditorImages');
    Route::resource('jobs', 'JobsController');

    // Registration Flow
    Route::delete('registration-flows/destroy', 'RegistrationFlowController@massDestroy')->name('registration-flows.massDestroy');
    Route::post('registration-flows/parse-csv-import', 'RegistrationFlowController@parseCsvImport')->name('registration-flows.parseCsvImport');
    Route::post('registration-flows/process-csv-import', 'RegistrationFlowController@processCsvImport')->name('registration-flows.processCsvImport');
    Route::resource('registration-flows', 'RegistrationFlowController');

    // Applied Jobs
    Route::delete('applied-jobs/destroy', 'AppliedJobsController@massDestroy')->name('applied-jobs.massDestroy');
    Route::post('applied-jobs/parse-csv-import', 'AppliedJobsController@parseCsvImport')->name('applied-jobs.parseCsvImport');
    Route::post('applied-jobs/process-csv-import', 'AppliedJobsController@processCsvImport')->name('applied-jobs.processCsvImport');
    Route::resource('applied-jobs', 'AppliedJobsController');

    // Resume
    Route::delete('resumes/destroy', 'ResumeController@massDestroy')->name('resumes.massDestroy');
    Route::post('resumes/media', 'ResumeController@storeMedia')->name('resumes.storeMedia');
    Route::post('resumes/ckmedia', 'ResumeController@storeCKEditorImages')->name('resumes.storeCKEditorImages');
    Route::resource('resumes', 'ResumeController');

    // Meetings
    Route::delete('meetings/destroy', 'MeetingsController@massDestroy')->name('meetings.massDestroy');
    Route::resource('meetings', 'MeetingsController');

    // Job Alerts
    Route::delete('job-alerts/destroy', 'JobAlertsController@massDestroy')->name('job-alerts.massDestroy');
    Route::post('job-alerts/parse-csv-import', 'JobAlertsController@parseCsvImport')->name('job-alerts.parseCsvImport');
    Route::post('job-alerts/process-csv-import', 'JobAlertsController@processCsvImport')->name('job-alerts.processCsvImport');
    Route::resource('job-alerts', 'JobAlertsController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
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
