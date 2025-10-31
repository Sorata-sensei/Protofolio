<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('otp'); // Kolom untuk menyimpan OTP
            $table->unsignedBigInteger('user_id'); // Kolom untuk menyimpan ID user
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
            $table->timestamp('expires_at')->nullable(); // Kolom untuk waktu kadaluarsa
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Relasi dengan tabel users
        });
    }

    public function down()
    {
        Schema::dropIfExists('otps');
    }
};