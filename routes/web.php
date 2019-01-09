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
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use App\Company;

Route::get('/', "HomeController@guest")->name("home");

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', ['middleware'=>'auth', 'uses'=>'HomeController@dashboard'])->name('admin');

Route::get('/admin/companies', ['middleware'=>'auth', 'uses'=>'HomeController@index'])->name('admin.companies');

Route::post('/admin/companies/add', 'CompaniesController@store')->name('company.add');

Route::match(['put', 'patch'], '/admin/company/{id}/update', 'CompaniesController@update')->name('company.update');

Route::post('/admin/company/{id}/edit', 'CompaniesController@edit')->name('company.edit');

Route::delete('/admin/company/{id}/delete', 'CompaniesController@destroy')->name('company.delete');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name("logout");

Route::any('/search',function(){
    $q = Input::get ( 'q' );
    $companies = Company::where('name','LIKE','%'.$q.'%')->orWhere('address','LIKE','%'.$q.'%')->get();
    if(count($companies) > 0) {
        return view('home', compact('companies'))->withDetails($companies)->withQuery ( $q );
    }
    else{
        $companies = Company::all();
        return view ('home', compact('companies'))->with('flash_warning','No Details found. Try to search again !');
    }
})->name('search');