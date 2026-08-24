<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $regionNames = ['Arica y Parinacota','Tarapacá','Antofagasta','Atacama','Coquimbo','Valparaíso','Metropolitana','O Higgins','Maule','Ñuble','Biobío','Araucanía','Los Ríos','Los Lagos','Aysén','Magallanes'];
        foreach ($regionNames as $name) {
            DB::table('regions')->updateOrInsert(['name' => $name], ['active' => true, 'updated_at' => $now, 'created_at' => $now]);
        }

        $regions = DB::table('regions')->pluck('id', 'name');
        $delegations = [
            ['Metropolitana', 'Metropolitana'], ['Valparaíso', 'Valparaíso'], ['Coquimbo', 'Coquimbo'],
            ['O’Higgins', 'O Higgins'], ['Maule', 'Maule'], ['Biobío', 'Biobío'], ['Araucanía', 'Araucanía'],
            ['Los Ríos', 'Los Ríos'], ['Los Lagos', 'Los Lagos'], ['Magallanes', 'Magallanes'],
        ];
        $delegationImages = ['delegations/demo-metropolitana.png','delegations/demo-valparaiso.png','delegations/demo-coquimbo.png','delegations/demo-ohiggins.png'];
        foreach ($delegations as $index => [$name, $region]) {
            DB::table('delegations')->updateOrInsert(
                ['name' => $name],
                ['region_id' => $regions[$region], 'image' => $delegationImages[$index % count($delegationImages)], 'postulation_status' => $index % 3 === 0 ? 'A' : 'C', 'updated_at' => $now, 'created_at' => $now]
            );
        }

        foreach ($delegations as $index => [$name, $region]) {
            if ($index % 3 !== 0) {
                continue;
            }

            $delegationId = DB::table('delegations')->where('name', $name)->value('id');
            DB::table('postulations')->updateOrInsert(
                ['title' => 'Proceso de incorporación · '.$name, 'delegation_id' => $delegationId],
                [
                    'description' => 'Convocatoria para personas interesadas en formarse y colaborar como voluntarias del Cuerpo de Socorro Andino de Chile.',
                    'cant_people_selected' => 12,
                    'status' => 'A',
                    'start_date' => $now->copy()->subDays(5),
                    'end_date' => $now->copy()->addDays(25),
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }

        $categoryId = DB::table('categories_news')->updateOrInsert(['name' => 'Operaciones'], ['updated_at' => $now, 'created_at' => $now]);
        $categoryId = DB::table('categories_news')->where('name', 'Operaciones')->value('id');
        $news = [
            ['Operativo preventivo en la alta cordillera','Equipos voluntarios realizaron patrullajes preventivos y entregaron recomendaciones de seguridad a visitantes.'],
            ['Entrenamiento nacional de rescate técnico','Delegaciones participaron en una jornada de cuerdas, camillaje y coordinación de operaciones complejas.'],
            ['Recomendaciones para una salida segura','Planificar la ruta, revisar el clima y registrar el aviso de salida son acciones fundamentales antes de subir.'],
            ['Nueva jornada de formación para voluntarios','La capacitación abordó primeros auxilios, orientación, comunicaciones y gestión segura de incidentes.'],
            ['Trabajo coordinado entre delegaciones','Equipos regionales reforzaron sus protocolos conjuntos para responder con rapidez en zonas de difícil acceso.'],
            ['Prevención de accidentes durante el invierno','El uso de equipamiento adecuado y la evaluación del terreno reducen los riesgos en condiciones invernales.'],
            ['Rescate aerotransportado en zona cordillerana','La operación permitió evacuar de manera segura a una persona accidentada en terreno de alta complejidad.'],
            ['Voluntariado y servicio a la comunidad','Conoce el trabajo desinteresado de quienes entregan tiempo, experiencia y preparación al rescate de montaña.'],
            ['Simulacro nocturno de búsqueda y rescate','La actividad permitió evaluar comunicaciones, iluminación, desplazamiento y coordinación durante la noche.'],
            ['Socorro Andino fortalece su presencia nacional','Las delegaciones continúan desarrollando capacidades para apoyar a comunidades y visitantes de montaña.'],
        ];
        $newsImages = ['news/demo-operacion-1.jpg','news/demo-operacion-2.jpg','news/demo-operacion-3.jpg','news/demo-operacion-4.jpg'];
        foreach ($news as $index => [$title, $description]) {
            $slug = 'demo-' . Str::slug($title);
            DB::table('news_main')->updateOrInsert(
                ['slug' => $slug],
                ['title' => $title, 'description' => '<p>'.$description.'</p>', 'image' => $newsImages[$index % count($newsImages)], 'category_id' => $categoryId, 'user_id' => null, 'featured' => $index < 2, 'updated_at' => $now->copy()->subDays($index), 'created_at' => $now->copy()->subDays($index)]
            );
        }

        $this->command?->info('Demo listo: '.DB::table('news_main')->where('slug', 'like', 'demo-%')->count().' noticias y '.DB::table('delegations')->whereIn('name', collect($delegations)->pluck(0))->count().' delegaciones.');
    }
}
