<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Departments
Route::resource('departments', 'DepartmentController');

// Positions
Route::resource('positions', 'PositionController');

// Salaries
Route::resource('salaries', 'SalaryController');

// Employees
Route::resource('employees', 'EmployeeController');

// Attendances
Route::resource('attendances', 'AttendanceController');
