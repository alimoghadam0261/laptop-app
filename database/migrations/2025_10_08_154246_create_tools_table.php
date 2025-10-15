<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('category_tools')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');


            $table->string('name')->index();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('price')->nullable();
            $table->string('status')->default('سالم');
            $table->string('year')->nullable();
            $table->string('serial_jam')->unique()->index();
            $table->string('model')->nullable();
            $table->string('content')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tools');

    }
};
