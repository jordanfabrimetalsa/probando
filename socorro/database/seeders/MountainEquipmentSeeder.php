<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MountainEquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $delegationId = DB::table('delegations')->where('is_national', true)->value('id')
            ?? DB::table('delegations')->value('id');
        $userId = DB::table('users')->where('role', 'admin')->value('id');

        $warehouseId = DB::table('warehouses')->where('name', 'Bodega Nacional de Montaña')->value('id');
        if (!$warehouseId) {
            $warehouseId = DB::table('warehouses')->insertGetId([
                'name'=>'Bodega Nacional de Montaña', 'description'=>'Equipamiento técnico para rescate y operaciones de montaña.',
                'path'=>'Sede Nacional · Área de Operaciones', 'status'=>true, 'delegation_id'=>$delegationId,
                'created_at'=>$now, 'updated_at'=>$now,
            ]);
        }

        $categoryNames = [
            'Cuerdas y anclajes', 'Protección personal', 'Nieve y hielo', 'Orientación y comunicaciones',
            'Rescate y camillaje', 'Campamento y supervivencia', 'Primeros auxilios',
        ];
        $categories = [];
        foreach ($categoryNames as $name) {
            DB::table('categories')->updateOrInsert(['name'=>$name], [
                'description'=>'Equipamiento de '.$name.' para operaciones de montaña.', 'updated_at'=>$now, 'created_at'=>$now,
            ]);
            $categories[$name] = DB::table('categories')->where('name',$name)->value('id');
        }

        $equipment = [
            ['Cuerda estática 11 mm x 100 m','Cuerdas y anclajes',8,'Petzl','100 m','Blanco'],
            ['Cuerda semiestática 10,5 mm x 50 m','Cuerdas y anclajes',10,'Beal','50 m','Rojo'],
            ['Cuerda dinámica 9,8 mm x 70 m','Cuerdas y anclajes',8,'Edelrid','70 m','Azul'],
            ['Cordín auxiliar 7 mm x 30 m','Cuerdas y anclajes',15,'Beal','30 m','Naranjo'],
            ['Cinta tubular 25 mm','Cuerdas y anclajes',25,'Fixe','120 cm','Negro'],
            ['Anillo de cinta cosida','Cuerdas y anclajes',30,'Petzl','120 cm','Amarillo'],
            ['Mosquetón HMS con seguro','Cuerdas y anclajes',40,'Petzl','Universal','Gris'],
            ['Mosquetón oval con seguro','Cuerdas y anclajes',35,'Kong','Universal','Gris'],
            ['Polea simple de rescate','Cuerdas y anclajes',15,'Petzl','Universal','Rojo'],
            ['Polea doble de rescate','Cuerdas y anclajes',10,'Petzl','Universal','Amarillo'],
            ['Bloqueador de puño','Cuerdas y anclajes',12,'Petzl','Universal','Negro'],
            ['Descendedor autofrenante','Cuerdas y anclajes',10,'Petzl','Universal','Rojo'],
            ['Placa multianclaje','Cuerdas y anclajes',12,'Kong','Mediana','Rojo'],
            ['Protector de cuerda','Cuerdas y anclajes',15,'Singing Rock','60 cm','Negro'],
            ['Casco de rescate técnico','Protección personal',30,'Petzl','Ajustable','Rojo'],
            ['Arnés integral de rescate','Protección personal',20,'Petzl','Ajustable','Negro'],
            ['Arnés de montaña','Protección personal',25,'Black Diamond','M/L','Azul'],
            ['Guantes de trabajo técnico','Protección personal',40,'Petzl','M/L','Negro'],
            ['Antiparras de ventisca','Protección personal',20,'Julbo','Universal','Negro'],
            ['Lentes de protección categoría 4','Protección personal',25,'Julbo','Universal','Gris'],
            ['Polainas impermeables','Protección personal',20,'Naturehike','M/L','Negro'],
            ['Chaleco reflectante operativo','Protección personal',30,'CSA','Ajustable','Naranjo'],
            ['Crampones de 12 puntas','Nieve y hielo',20,'Petzl','Ajustable','Gris'],
            ['Piolet clásico 60 cm','Nieve y hielo',18,'Petzl','60 cm','Gris'],
            ['Piolet técnico','Nieve y hielo',12,'Black Diamond','50 cm','Naranjo'],
            ['Tornillo de hielo 17 cm','Nieve y hielo',25,'Petzl','17 cm','Gris'],
            ['Estaca para nieve','Nieve y hielo',20,'MSR','60 cm','Rojo'],
            ['Raquetas de nieve','Nieve y hielo',15,'TSL','Ajustable','Azul'],
            ['Pala de avalancha','Nieve y hielo',18,'Ortovox','Telescópica','Naranjo'],
            ['Sonda de avalancha 240 cm','Nieve y hielo',18,'Ortovox','240 cm','Azul'],
            ['Detector de víctimas de avalancha','Nieve y hielo',12,'Mammut','Digital','Negro'],
            ['GPS de montaña','Orientación y comunicaciones',12,'Garmin','Portátil','Negro'],
            ['Radio VHF portátil','Orientación y comunicaciones',25,'Motorola','Portátil','Negro'],
            ['Batería de repuesto para radio','Orientación y comunicaciones',35,'Motorola','Compatible','Negro'],
            ['Brújula de navegación','Orientación y comunicaciones',20,'Suunto','Profesional','Transparente'],
            ['Linterna frontal 500 lúmenes','Orientación y comunicaciones',35,'Petzl','500 lm','Negro'],
            ['Baliza luminosa de señalización','Orientación y comunicaciones',20,'Nitecore','LED','Rojo'],
            ['Power bank resistente 20000 mAh','Orientación y comunicaciones',20,'Nitecore','20000 mAh','Negro'],
            ['Camilla canasto de rescate','Rescate y camillaje',6,'Spencer','Adulto','Naranjo'],
            ['Camilla plegable','Rescate y camillaje',8,'Spencer','Adulto','Naranjo'],
            ['Colchón de vacío','Rescate y camillaje',6,'Spencer','Adulto','Azul'],
            ['Férula de tracción','Rescate y camillaje',8,'Spencer','Adulto','Negro'],
            ['Inmovilizador cervical ajustable','Primeros auxilios',25,'Ambu','Ajustable','Rojo'],
            ['Manta térmica de emergencia','Primeros auxilios',80,'Lifesystems','Individual','Dorado'],
            ['Botiquín trauma avanzado','Primeros auxilios',12,'Elite Bags','Avanzado','Rojo'],
            ['Bolsa de reanimación manual','Primeros auxilios',10,'Ambu','Adulto','Azul'],
            ['Oxímetro de pulso','Primeros auxilios',15,'ChoiceMMed','Portátil','Negro'],
            ['Carpa de expedición 4 personas','Campamento y supervivencia',10,'Doite','4 personas','Naranjo'],
            ['Saco de dormir -15 °C','Campamento y supervivencia',25,'Doite','-15 °C','Azul'],
            ['Cocinilla de montaña','Campamento y supervivencia',15,'MSR','Compacta','Gris'],
            ['Filtro purificador de agua','Campamento y supervivencia',15,'Katadyn','Portátil','Azul'],
            ['Mochila técnica 60 litros','Campamento y supervivencia',20,'Osprey','60 L','Rojo'],
            ['Toldo de emergencia 3 x 3 m','Campamento y supervivencia',12,'Naturehike','3 x 3 m','Naranjo'],
        ];

        foreach ($equipment as $index => [$name,$category,$stock,$brand,$size,$colour]) {
            $barcode = 'MNT-'.str_pad((string)($index + 1), 3, '0', STR_PAD_LEFT);
            $productId = DB::table('products')->where('barcode',$barcode)->value('id');
            if ($productId) {
                DB::table('products')->where('id',$productId)->update([
                    'name'=>$name,'description'=>'Equipo operativo de montaña: '.$name,'colour'=>$colour,
                    'size'=>$size,'brand'=>$brand,'id_category'=>$categories[$category],
                    'id_warehouse'=>$warehouseId,'deleted_at'=>null,'updated_at'=>$now,
                ]);
                continue;
            }

            $productId = DB::table('products')->insertGetId([
                'barcode'=>$barcode,'name'=>$name,'description'=>'Equipo operativo de montaña: '.$name,
                'colour'=>$colour,'size'=>$size,'brand'=>$brand,'stock'=>$stock,'status'=>true,'image'=>null,
                'id_category'=>$categories[$category],'id_warehouse'=>$warehouseId,
                'created_at'=>$now,'updated_at'=>$now,
            ]);
            DB::table('stock_products')->insert(['count'=>$stock,'cost'=>0,'product_id'=>$productId,'created_at'=>$now,'updated_at'=>$now]);
            DB::table('stock_movement')->insert([
                'type'=>'add','quantity'=>$stock,'balance_before'=>0,'balance_after'=>$stock,'unit_cost'=>0,
                'reason'=>'Carga inicial de equipamiento de montaña','reference'=>'SEED-MONTAÑA','occurred_at'=>$now,
                'product_id'=>$productId,'warehouse_id'=>$warehouseId,'delegation_id'=>$delegationId,
                'user_id'=>$userId,'created_at'=>$now,'updated_at'=>$now,
            ]);
        }
    }
}
