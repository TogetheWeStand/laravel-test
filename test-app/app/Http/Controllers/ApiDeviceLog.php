<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\DeviceLog;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class ApiDeviceLog extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $device_id = $request->query('device_id');
        /** @var Device $device */
        $device = Device::with('logs')->where('uuid', '=', $device_id)->get()->first();
        $data = [];

        foreach ($device->logs as $log) {
            $data[] = [
                "log_id" => $log->id,
                "device_id" => $device->uuid,
                "log_date" => $log->logDate,
            ];
        }

        return response()->json($data, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param Request $request
     * @return ContractsApplication|ResponseFactory|Application|Response
     */
    public function upload(Request $request): ContractsApplication|ResponseFactory|Application|Response
    {
        $device_id = $request->json('device_id');
        $log_date = $request->json('log_date');

        if (!$device_id || !$log_date) {
            return response('Unprocessable Entity', 422, ['WWW-Authenticate' => 'Bearer']);
        }

        $device = Device::where('apiAccessToken', $request->bearerToken())->first();

        if ($device->uuid != $device_id) {
            return response('Forbidden', 403, ['WWW-Authenticate' => 'Bearer']);
        }

        $log = new DeviceLog([
            'deviceId' => $device->id,
            'logDate' => $log_date,
        ]);
        $log->save();

        return response('OK', 200);
    }
}
