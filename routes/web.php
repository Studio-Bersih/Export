<?php

use App\Http\Controllers\Report;
use Illuminate\Support\Facades\Route;

Route::get('/Excel', [Report::class, 'exportExcel']);