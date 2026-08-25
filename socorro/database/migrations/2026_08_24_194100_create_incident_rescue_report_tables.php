<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('rescates')) {
            Schema::create('rescates', function (Blueprint $table) {
                $table->id();
                $table->string('incident_code', 40)->nullable()->unique();
                $table->date('fecha_operativo');
                $table->time('hora_llamado');
                $table->string('commandante_incidente');
                $table->string('puesto_comando')->nullable();
                $table->string('nivel_activacion', 30);
                $table->text('objetivos_incidente');
                $table->text('riesgos_operacionales');
                $table->text('plan_comunicaciones')->nullable();
                $table->text('zona_operaciones')->nullable();
                $table->string('estado_cierre', 30);
                $table->time('hora_desmovilizacion')->nullable();
                $table->text('lecciones_aprendidas')->nullable();
                $table->string('tipo_emergencia', 100);
                $table->string('lugar');
                $table->string('nombre_llamado');
                $table->string('telefono', 30);
                $table->string('nombre_completo');
                $table->string('rut_dni', 40)->nullable();
                $table->unsignedTinyInteger('edad')->nullable();
                $table->string('sexo', 30)->nullable();
                $table->decimal('estatura', 6, 2)->nullable();
                $table->decimal('peso', 6, 2)->nullable();
                $table->string('telefono_afectado', 30)->nullable();
                $table->string('condicion_fisica')->nullable();
                $table->string('lugar_exacto')->nullable();
                $table->decimal('latitud', 10, 7)->nullable();
                $table->decimal('longitud', 10, 7)->nullable();
                $table->integer('altitud')->nullable();
                $table->string('ubicacion_vehiculo_rescate')->nullable();
                $table->text('condicion_sanitaria_inicial')->nullable();
                $table->text('eva_inicial')->nullable();
                $table->text('msc_inicial')->nullable();
                $table->string('estado_emocional_psicologico')->nullable();
                $table->longText('resumen_acciones');
                $table->text('medicamentos_administrados')->nullable();
                $table->string('metodo_evacuacion')->nullable();
                $table->string('destino_final_paciente')->nullable();
                $table->longText('descripcion_emergencia');
                $table->longText('observaciones_generales')->nullable();
                $table->foreignId('id_delegation')->constrained('delegations')->restrictOnDelete();
                $table->foreignId('id_usuario')->nullable()->constrained('users')->nullOnDelete();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('rescate_xabcde')) {
            Schema::create('rescate_xabcde', function (Blueprint $table) {
                $table->id();
                $table->foreignId('rescate_id')->constrained('rescates')->cascadeOnDelete();
                $table->text('x_hemorragias')->nullable();
                $table->text('a_via_aerea')->nullable();
                $table->text('b_respiracion')->nullable();
                $table->text('c_circulacion')->nullable();
                $table->text('d_estado_neurologico')->nullable();
                $table->text('e_exposicion')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('rescate_sample')) {
            Schema::create('rescate_sample', function (Blueprint $table) {
                $table->id();
                $table->foreignId('rescate_id')->constrained('rescates')->cascadeOnDelete();
                $table->text('signos_sintomas')->nullable();
                $table->text('alergias')->nullable();
                $table->text('medicamentos')->nullable();
                $table->text('patologias_previas')->nullable();
                $table->text('ultima_ingesta')->nullable();
                $table->text('eventos_previos')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('rescate_bitacora')) {
            Schema::create('rescate_bitacora', function (Blueprint $table) {
                $table->id();
                $table->foreignId('rescate_id')->constrained('rescates')->cascadeOnDelete();
                $table->text('emergencia_presencial')->nullable();
                $table->time('salida_cuartel')->nullable();
                $table->time('llegada_acceso')->nullable();
                $table->time('contacto_grupo')->nullable();
                $table->text('evaluacion_sanitaria_inicial')->nullable();
                $table->time('inicio_descenso')->nullable();
                $table->time('llegada_extraccion')->nullable();
                $table->time('traslado_destino_final')->nullable();
                $table->time('regreso_cuartel')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('rescate_material_equipo')) {
            Schema::create('rescate_material_equipo', function (Blueprint $table) {
                $table->id();
                $table->foreignId('rescate_id')->constrained('rescates')->cascadeOnDelete();
                $table->string('material');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('rescate_voluntarios')) {
            Schema::create('rescate_voluntarios', function (Blueprint $table) {
                $table->id();
                $table->foreignId('rescate_id')->constrained('rescates')->cascadeOnDelete();
                $table->foreignId('voluntario_id')->constrained('voluntaries')->restrictOnDelete();
                $table->timestamps();
                $table->unique(['rescate_id', 'voluntario_id']);
            });
        }

        if (!Schema::hasTable('rescate_instituciones')) {
            Schema::create('rescate_instituciones', function (Blueprint $table) {
                $table->id();
                $table->foreignId('rescate_id')->constrained('rescates')->cascadeOnDelete();
                $table->string('institucion');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('rescate_instituciones');
        Schema::dropIfExists('rescate_voluntarios');
        Schema::dropIfExists('rescate_material_equipo');
        Schema::dropIfExists('rescate_bitacora');
        Schema::dropIfExists('rescate_sample');
        Schema::dropIfExists('rescate_xabcde');
        Schema::dropIfExists('rescates');
    }
};
