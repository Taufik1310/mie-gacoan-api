<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('name', 200)->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->text('profilePicture')->default('/storage/images/default.png')->nullable();
            $table->enum('role', [0, 1, 2])->default(2);
            $table->boolean('isBlocked')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $data = array(
            [
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'name' => 'Administrator',
                'role' => 0,
                'email_verified_at' => now()
            ],
            [
                'email' => 'kasir@gmail.com',
                'password' => Hash::make('kasir123'),
                'name' => 'Kasir',
                'role' => 1,
                'email_verified_at' => now()
            ],
        );
        foreach ($data as $datum) {
            User::create($datum);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
