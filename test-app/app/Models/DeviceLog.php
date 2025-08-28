<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $deviceId
 * @property string $logDate
 */
class DeviceLog extends Model
{
    use HasFactory;

//    public $timestamps = true;

    protected $table = 'DeviceLog';
    protected $fillable = ['deviceId', 'logDate'];
}
