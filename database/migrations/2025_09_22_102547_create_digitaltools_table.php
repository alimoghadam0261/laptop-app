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
        Schema::create('digitaltools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('brand');
            $table->string('serial_it')->unique();
            $table->string('serial_jam')->unique();
            $table->string('cpu');
            $table->string('ram');
            $table->longText('content');
            $table->json('accessories')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digitaltools');
    }
};
