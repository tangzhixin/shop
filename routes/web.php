<?php

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
Route::get('/admin/index','admin\AdminController@index');
Route::get('/admin/add','admin\AdminController@add');
Route::post('/admin/do_add','admin\AdminController@do_add');
Route::get('/admin/del','admin\AdminController@del');
Route::get('/admin/update','admin\AdminController@update');
Route::post('/admin/do_update','admin\AdminController@do_update');




Route::get('/admin/add_goods','admin\GoodsController@add_goods');
Route::post('/admin/do_add_goods','admin\GoodsController@do_add_goods');


Route::get('/student/register','StudentController@register');
Route::post('/student/do_register','StudentController@do_register');

Route::get('/student/login','StudentController@login');
Route::post('/student/do_login','StudentController@do_login');
// 浏览学生信息
Route::get('/student/index','StudentController@index');
// 删除学生信息
Route::get('/student/delete','StudentController@delete');
// 添加学生信息
Route::get('/student/add','StudentController@add');
Route::post('/student/save','StudentController@save');
// 修改学生信息
Route::get('/student/update','StudentController@update');
Route::post('/student/updateadd','StudentController@updateadd');

// 调用中间件
Route::group(['middleware'=>['login']],function(){
    // 添加学生信息
Route::get('/student/add','StudentController@add');
});


