<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorRelationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('investor_relations', function (Blueprint $table) {
            $table->id();
            $table->string('headline')->nullable();
            $table->string('sub_headline')->nullable();
            $table->text('materi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investor_relations');
    }
}
