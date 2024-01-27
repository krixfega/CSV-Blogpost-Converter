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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('email');
            $table->string('display_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};