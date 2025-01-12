<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom role_id dan created_by
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            // Foreign key ke tabel roles
            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            // Self referencing foreign key
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['role_id', 'created_by']);
        });
    }
};
