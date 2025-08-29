<?php

namespace App\Models;

use App\Interfaces\IBearerAuthenticableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $uuid
 * @property string $apiAccessToken
 * @property string $createdAt
 * @property string $updatedAt
 */
class Device extends Model implements IBearerAuthenticableModel
{
    use HasFactory;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'Device';
    protected $fillable = ['uuid', 'apiAccessToken'];

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(DeviceLog::class, 'deviceId', 'id');
    }

    /**
     * @return string
     */
    public function getBearerTokenFieldName(): string
    {
        return 'apiAccessToken';
    }
}
