<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('rescates')) {
            return;
        }

        Schema::table('rescates', function (Blueprint $table) {
            $table->string('incident_code', 40)->nullable()->after('id');
            $table->string('commandante_incidente')->nullable()->after('hora_llamado');
            $table->string('puesto_comando')->nullable()->after('commandante_incidente');
            $table->string('nivel_activacion', 30)->nullable()->after('puesto_comando');
            $table->text('objetivos_incidente')->nullable()->after('nivel_activacion');
            $table->text('riesgos_operacionales')->nullable()->after('objetivos_incidente');
            $table->text('plan_comunicaciones')->nullable()->after('riesgos_operacionales');
            $table->text('zona_operaciones')->nullable()->after('plan_comunicaciones');
            $table->string('estado_cierre', 30)->nullable()->after('zona_operaciones');
            $table->time('hora_desmovilizacion')->nullable()->after('estado_cierre');
            $table->text('lecciones_aprendidas')->nullable()->after('hora_desmovilizacion');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('rescates')) {
            return;
        }

        Schema::table('rescates', function (Blueprint $table) {
            $table->dropColumn([
                'incident_code', 'commandante_incidente', 'puesto_comando',
                'nivel_activacion', 'objetivos_incidente', 'riesgos_operacionales',
                'plan_comunicaciones', 'zona_operaciones', 'estado_cierre',
                'hora_desmovilizacion', 'lecciones_aprendidas',
            ]);
        });
    }
};
