<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('password');
            $table->boolean('isactive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     // Hapus index unique
    Schema::table('users', function (Blueprint $table) {
        $table->dropUnique(['username']);
        $table->dropUnique(['email']);
    });

    // Hapus tabel
    Schema::dropIfExists('users');
    }
};
