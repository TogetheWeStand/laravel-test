<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $uuid
 * @property string $apiAccessToken
 * @property string $createdAt
 * @property string $updatedAt
 */
class Device extends Model
{
    use HasFactory;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

//    public $timestamps = true;

    protected $table = 'Device';
    protected $fillable = ['uuid', 'apiAccessToken'];


    public function logs()
    {
        return $this->hasMany(DeviceLog::class, 'deviceId', 'id');
    }
}
