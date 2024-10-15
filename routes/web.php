<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogController;

Route::get('/', [DashboardController::class, 'view'])->name('dashboard');

Route::get('blogs', [BlogController::class, 'allBlog'])->name('blogs');
Route::get('blog/listing', [BlogController::class, 'blogListing'])->name('blog.listing');
Route::get('create/blog', [BlogController::class, 'create'])->name('blog.create');
Route::get('edit/{blog}/blog', [BlogController::class, 'edit'])->name('blog.edit');
Route::post('save-blog', [BlogController::class, 'save'])->name('save.blog');
Route::get('bolg/{blog}/details', [BlogController::class, 'bolgDetails'])->name('bolg.details');
Route::post('blog/change-status', [BlogController::class, 'changeStatus'])->name('blog.change.status');
Route::post('blog/delete', [BlogController::class, 'delete'])->name('blog.delete');
Route::post('blog/delete/image', [BlogController::class, 'deleteImage'])->name('delete.blog.image');
Route::get('my-blogs', [BlogController::class, 'myBlogs'])->name('my.blogs');

require __DIR__ . '/auth.php';
