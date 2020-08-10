<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');
Route::post('/form-submitted','FormController@submit')->name('form.submit');
Route::get('/form-data' , 'FormController@formdata')->name('form.data');
Route::get('/about-us', function () {
    return view('aboutus');
})->name('about.us');
Route::group(['prefix' => 'products'], function(){
	Route::get('/sticks', function(){
		return view('products.sticks');
	})->name('products.sticks');
	Route::get('/straw', function(){
		return view('products.straw');
	})->name('products.straw');
	Route::get('/stirrer', function(){
		return view('products.stirrer');
	})->name('products.stirrer');
	Route::get('/skewers', function(){
		return view('products.skewers');
	})->name('products.skewers');
});
Route::get('/blog', 'BlogController@view')->name('blog.main.view');
Route::get('/marco-bamboo/dashboard/blog', 'BlogController@adminView')->name('blog.view');
Route::get('/blog/{path}' , 'BlogController@blogview')->name('blog.post.view');
Route::get('/create-blog', function () {
    return view('blog.create');
});
Route::post('/blog/post/create', 'BlogController@create')->name('blog.create');
Route::post('/blog/post/delete/{id}', 'BlogController@del')->name('blog.delete');

Route::resource('/ajax', 'AjaxController');

Route::get('/react' , function(){
    return view('react');
});


Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');


Route::get('/blog-view', function () {
    return view('blog.view');
});



Route::get('/sendemail', 'SendEmailController@index');
Route::post('/sendemail/send', 'SendEmailController@send');