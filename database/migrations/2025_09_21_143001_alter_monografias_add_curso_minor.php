<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('monografias', function (Blueprint $table) {
            // Adiciona curso_id e minor_id
            $table->foreignId('curso_id')->nullable()->after('id')->constrained('cursos')->onDelete('cascade');
            $table->foreignId('minor_id')->nullable()->after('curso_id')->constrained('minors')->onDelete('cascade');

            // Remove coluna antiga de texto
            $table->dropColumn('curso');
        });
    }

    public function down(): void
    {
        Schema::table('monografias', function (Blueprint $table) {
            $table->string('curso')->nullable()->after('id');
            $table->dropForeign(['curso_id']);
            $table->dropColumn('curso_id');

            $table->dropForeign(['minor_id']);
            $table->dropColumn('minor_id');
        });
    }
};

