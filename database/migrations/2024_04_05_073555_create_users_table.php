<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role',['admin','user'])->default('user');
            $table->string('password');
            $table->string('email_validate')->nullable();
            $table->enum('status',['aktif','non-aktif'])->default('non-aktif');
            $table->dateTime('last_login')->nullable()->default(null);
            $table->timestamps(); 
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};