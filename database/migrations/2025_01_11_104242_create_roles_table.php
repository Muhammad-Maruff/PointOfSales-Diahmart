<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('roles', 50);
            $table->boolean('isactive')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
            $table->timestamps();
           
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });

        Schema::dropIfExists('roles');
    }
};
