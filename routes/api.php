<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test','App\Http\Controllers\TestController@index');

Route::get('/departmentgetAll','App\Http\Controllers\DepartmentController@getAll');

Route::get('/coursesgetAll','App\Http\Controllers\CoursesController@getAll');

Route::get('/gradegetAll','App\Http\Controllers\GradeController@getAll');

Route::get('/classesgetAll','App\Http\Controllers\ClassesController@getAll');

Route::get('/studentgetAll','App\Http\Controllers\StudentController@getAll');

Route::post('/students','App\Http\Controllers\StudentController@createStudent');

//enrolment here
Route::get('/enrollmentgetAll','App\Http\Controllers\EnrollmentController@getAll');

Route::get('/enrollmentgetByReff/{refNo}', 'App\Http\Controllers\EnrollmentController@getByEnrolRefNo');

Route::post('/enrollmentOnline','App\Http\Controllers\EnrollmentController@enrol');

Route::post('/enrollmentMakePayment','App\Http\Controllers\EnrollmentController@makePayment');


