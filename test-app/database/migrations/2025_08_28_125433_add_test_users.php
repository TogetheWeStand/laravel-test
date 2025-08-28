<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        User::insert([
            ['name' => 'Vincent Vega', 'email' => 'vincent@vega.com', 'password' => Hash::make('123456')],
            ['name' => 'Jules Winnfield', 'email' => 'jules@winnfield.com', 'password' => Hash::make('654321')],
        ]);
    }

    /**
     * @return void
     */
    public function down(): void
    {
        User::whereIn('email', ['vincent@vega.com', 'jules@winnfield.com'])->delete();
    }
};
