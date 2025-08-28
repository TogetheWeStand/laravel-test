<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\DeviceLog;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('api.auth.basic')->get('/logs/view', function (Request $request) {
    $device_id = $request->query('device_id');
    DeviceLog::
    var_dump("ITS VIEW", $request->query('device_id'));
//    return $request->user();
});

Route::put('/logs/upload', function (Request $request) {
    var_dump("ITS UPLOAD", $request);
//    return $request->user();
});

Route::get('/logs/add', function (Request $request) {
    DeviceLog::insert([
        ['deviceId' => 1, 'logDate' => '2025-07-26T01:48:52Z'],
        ['deviceId' => 2, 'logDate' => '2025-08-26T01:48:52Z'],
    ]);
    return 'Success';
});

Route::get('/logs/get', function (Request $request) {
    $device_id = $request->query('device_id');
    $device = \App\Models\Device::with('logs')->where('uuid', '=', $device_id)->get()->first();

    foreach ($device->logs as $log) {
        var_dump($log);
    }

});
