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
        Schema::create('tools_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tools_id')->constrained('tools')->onDelete('cascade');


            $table->string('card_number');
            $table->string('status');
            $table->string('name_receiver');
            $table->string('phone');
            $table->string('name_project');
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools_histories');
    }
};
