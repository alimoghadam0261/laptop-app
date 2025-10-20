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
        Schema::create('digital_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('digitaltool_id')->constrained('digitaltools')->onDelete('cascade');
            $table->string('card_number')->index();
            $table->string('status');
            $table->string('name_receiver')->index();
            $table->string('phone');
            $table->string('name_project');
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
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
        Schema::dropIfExists('digital_histories');
    }
};
