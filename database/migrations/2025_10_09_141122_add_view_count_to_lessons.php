<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('view_count')->default(0)->after('estimated_minutes');
        });
    }
    public function down(): void {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('view_count');
        });
    }
};
