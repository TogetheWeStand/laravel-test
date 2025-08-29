<?php

use Illuminate\Support\Facades\Route;
use App\Models\Device;
use App\Http\Controllers\ApiDeviceLog;

Route::middleware('api.auth.basic')->get('/logs/view', [ApiDeviceLog::class, 'show']);

Route::middleware('api.auth.bearer:' . Device::class)
    ->put('/logs/upload', [ApiDeviceLog::class, 'upload']);
