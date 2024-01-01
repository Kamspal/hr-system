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

// Departments
Route::get('/departments', 'DepartmentController@index');
Route::get('/departments/{id}', 'DepartmentController@show');
Route::post('/departments', 'DepartmentController@store');
Route::put('/departments/{id}', 'DepartmentController@update');
Route::delete('/departments/{id}', 'DepartmentController@destroy');

// Positions
Route::get('/positions', 'PositionController@index');
Route::get('/positions/{id}', 'PositionController@show');
Route::post('/positions', 'PositionController@store');
Route::put('/positions/{id}', 'PositionController@update');
Route::delete('/positions/{id}', 'PositionController@destroy');

// Salaries
Route::get('/salaries', 'SalaryController@index');
Route::get('/salaries/{id}', 'SalaryController@show');
Route::post('/salaries', 'SalaryController@store');
Route::put('/salaries/{id}', 'SalaryController@update');
Route::delete('/salaries/{id}', 'SalaryController@destroy');

// Employees
Route::get('/employees', 'EmployeeController@index');
Route::get('/employees/{id}', 'EmployeeController@show');
Route::post('/employees', 'EmployeeController@store');
Route::put('/employees/{id}', 'EmployeeController@update');
Route::delete('/employees/{id}', 'EmployeeController@destroy');

// Attendances
Route::get('/attendances', 'AttendanceController@index');
Route::get('/attendances/{id}', 'AttendanceController@show');
Route::post('/attendances', 'AttendanceController@store');
Route::put('/attendances/{id}', 'AttendanceController@update');
Route::delete('/attendances/{id}', 'AttendanceController@destroy');
