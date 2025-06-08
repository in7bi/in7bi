<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurTeamsTable extends Migration
{
    public function up(): void
    {
        Schema::create('our_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('linkedin')->nullable();
            $table->string('upload_photo')->nullable(); // path ke foto yang diupload
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('our_teams');
    }
}
