<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Device;

return new class extends Migration
{
    protected const TABLE = 'DeviceLog';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->integer('deviceId');
            $table->timestamp('logDate');

            $table->index('deviceId');
            $table->foreign('deviceId')
                ->references('id')
                ->on((new Device())->getTable())
                ->onDelete('cascade');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};
