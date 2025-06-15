<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('investor_details', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->text('address');
            $table->string('nationality');
            $table->string('identification_number', 16);
            $table->string('npwp')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investor_details');
    }
};
