<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->from(1001);
            $table->timestamps();
            $table->timestamp('online_at')->nullable();

            $table->string('first_name')->comment('Имя');
            $table->string('middle_name')->nullable()->comment('Отчество');
            $table->string('last_name')->nullable()->comment('Фамилия');
            $table->string('gender', 10)->nullable()->comment('Пол');

            $table->string('email')->unique();
            $table->timestamp('email_confirmed_at')->nullable();

            $table->string('password');
            $table->timestamp('password_at')->nullable();
            $table->rememberToken();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
