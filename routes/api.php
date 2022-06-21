<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Jobs
    Route::post('jobs/media', 'JobsApiController@storeMedia')->name('jobs.storeMedia');
    Route::apiResource('jobs', 'JobsApiController');

    // Registration Flow
    Route::apiResource('registration-flows', 'RegistrationFlowApiController');

    // Applied Jobs
    Route::apiResource('applied-jobs', 'AppliedJobsApiController');

    // Job Alerts
    Route::apiResource('job-alerts', 'JobAlertsApiController');
});
