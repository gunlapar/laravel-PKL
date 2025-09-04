<?php
use App\Http\Controllers\DataSiswaController;

Route::get('/', [DataSiswaController::class, 'index']);
Route::resource('siswa', DataSiswaController::class);