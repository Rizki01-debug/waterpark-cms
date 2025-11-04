<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::table('company_contacts', function (Blueprint $table) {
    $table->text('google_maps')->change();
});

    }

    public function down(): void
    {
        Schema::table('company_contacts', function (Blueprint $table) {
            $table->string('google_maps', 255)->change();
        });
    }
};
