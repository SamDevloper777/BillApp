<?php

use App\Livewire\Admin\Category\CategoryCrud;
use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Admin\Inventry\AddProduct;
use App\Livewire\Admin\Inventry\ProductList;
use App\Livewire\Admin\Inventry\UpdateProduct;
use App\Livewire\Admin\Metal\MetalCrud;
use Illuminate\Support\Facades\Route;


Route::get('/',Dashboard::class)->name('dashboard');

Route::get('/category',CategoryCrud::class)->name('category.index');
Route::get('/metal',MetalCrud::class)->name('metal.index');

Route::get('/products', ProductList::class)->name('products.index');
Route::get('/products/create', AddProduct::class)->name('products.create');
Route::get('/products/{id}/edit', UpdateProduct::class)->name('products.edit');