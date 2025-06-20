<?php

use App\Livewire\Admin\Category\CategoryCrud;
use App\Livewire\Admin\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;


Route::get('/',Dashboard::class)->name('dashboard');

Route::get('/category',CategoryCrud::class)->name('category.index');