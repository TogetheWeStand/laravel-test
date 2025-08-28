<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Device;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    protected const TABLE = 'Device';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36)->unique()->comment('Уникальный идентификатор устройства');
            $table->string('apiAccessToken')->unique();
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('updatedAt')->useCurrentOnUpdate()->nullable();
        });

        $this->addSomeDevices();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }

    /**
     * @return void
     */
    protected function addSomeDevices(): void
    {
        Device::insert([
            ['uuid' => Uuid::uuid4(), 'apiAccessToken' => bin2hex(random_bytes(32))],
            ['uuid' => Uuid::uuid4(), 'apiAccessToken' => bin2hex(random_bytes(32))],
        ]);
    }
};
