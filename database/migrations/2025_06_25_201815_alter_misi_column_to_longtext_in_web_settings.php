<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterMisiColumnToLongtextInWebSettings extends Migration
{
    /**
     * Ubah kolom 'misi' menjadi LONGTEXT
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE web_settings MODIFY misi LONGTEXT NULL');
    }

    /**
     * Kembalikan kolom 'misi' ke TEXT
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE web_settings MODIFY misi TEXT NULL');
    }
}
