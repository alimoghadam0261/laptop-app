<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', App\Livewire\Authentication\Login::class)->name('login');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard',App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');

    Route::get('/users/create',App\Livewire\Admin\Tools\Create::class)->name('admin.users.create');
    Route::get('/users/index',App\Livewire\Admin\Tools\Index::class)->name('admin.users.index');
    Route::get('/users/edit/{id}',App\Livewire\Admin\Tools\Edit::class)->name('admin.users.edit');

    Route::get('/laptop/create',App\Livewire\Admin\Electronic\Laptop\Create::class)->name('admin.laptop.create');
    Route::get('/laptop/index',App\Livewire\Admin\Electronic\Laptop\Index::class)->name('admin.laptop.index');
    Route::get('/laptop/edit/{id}',App\Livewire\Admin\Electronic\Laptop\Edit::class)->name('admin.laptop.edit');
    Route::get('/laptop/show/{id}',App\Livewire\Admin\Electronic\Laptop\Show::class)->name('admin.laptop.show');
    Route::get('/laptop/transfer',App\Livewire\Admin\Electronic\Laptop\Transfer::class)->name('admin.laptop.transfer');

    Route::get('/tools/create',App\Livewire\Admin\Tools\Create::class)->name('admin.tools.create');
    Route::get('/tools/index',App\Livewire\Admin\Tools\Index::class)->name('admin.tools.index');
    Route::get('/tools/edit/{id}',App\Livewire\Admin\Tools\Edit::class)->name('admin.tools.edit');
    Route::get('/tools/show/{id}',App\Livewire\Admin\Tools\Show::class)->name('admin.tools.show');
    Route::get('/tools/transfer',App\Livewire\Admin\Tools\Transfer::class)->name('admin.tools.transfer');
    Route::get('/tools/category',App\Livewire\Admin\Tools\Category::class)->name('admin.tools.category');

    Route::get('/profile/create',App\Livewire\Admin\Profile\Create::class)->name('admin.profile.create');
    Route::get('/profile/index',App\Livewire\Admin\Profile\Index::class)->name('admin.profile.index');
    Route::get('/profile/personal',App\Livewire\Admin\Profile\Personal::class)->name('admin.profile.personal');



});



Route::post('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');
