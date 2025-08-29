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
            [
                'uuid' => 'dbf14fbc-7635-442c-9734-451c351830bd',
                'apiAccessToken' => '9c1979179dfe0ad819e00abcf0ed79d62b350e978353e9adf2ef801a29755ccd'
            ],
            [
                'uuid' => '3b8c564b-d8af-465c-965f-e1d8cc55ef3c',
                'apiAccessToken' => 'b10cf7832ebbcdc94777eb93164ae6a6f017e3601f314de731c6a95cd6516f82'
            ],
        ]);

//        Device::insert([
//            ['uuid' => Uuid::uuid4(), 'apiAccessToken' => bin2hex(random_bytes(32))],
//            ['uuid' => Uuid::uuid4(), 'apiAccessToken' => bin2hex(random_bytes(32))],
//        ]);
    }
};
