<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Area;
use App\Models\User;
use App\Models\State;
use App\Models\Booking;

use App\Models\Category;
use App\Models\Location;
use App\Models\Incidence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Coders',
            'email' => 'coders@arrabalempleo.org',
        ]);

        Category::create([
            'name' => 'Apoyo a Programas',
        ]);
        Category::create([
            'name' => 'Informatica',
        ]);
        Category::create([
            'name' => 'Limpieza',
        ]);
        Category::create([
            'name' => 'Mantenimiento',
        ]);
        Category::create([
            'name' => 'Materiales',
        ]);


        State::create([
            'name' => 'Emitido',
        ]);
        State::create([
            'name' => 'Visto',
        ]);
        State::create([
            'name' => 'Pendiente',
        ]);
        State::create([
            'name' => 'En tramite',
        ]);
        State::create([
            'name' => 'Rechazado',
        ]);
        State::create([
            'name' => 'Aprobado',
        ]);
        State::create([
            'name' => 'Finalizado',
        ]);

        Location::create([
            'name' => 'Dos Aceras',
        ]);
        Location::create([
            'name' => 'Edif. Galaxia',
        ]);
        Location::create([
            'name' => 'Innova Social',
        ]);
        Location::create([
            'name' => 'Mercado El Carmen',
        ]);
        Location::create([
            'name' => 'Pje. Begoña',
        ]);
        Location::create([
            'name' => 'Remoto',
        ]);

        Area::create([
            'name' => 'Personas y Talento',
        ]);
        Area::create([
            'name' => 'Emprendimiento',
        ]);
        Area::create([
            'name' => 'Social y vulnerabilidad',
        ]);
        Area::create([
            'name' => 'Económica',
        ]);
        Area::create([
            'name' => 'Infancia y Familia',
        ]);
        Area::create([
            'name' => 'Proyectos',
        ]);
        Area::create([
            'name' => 'Comunicación',
        ]);
        Area::create([
            'name' => 'Incorporacion Laboral',
        ]);
        Area::create([
            'name' => 'Internacional',
        ]);
        Area::create([
            'name' => 'Privadas de libertad',
        ]);
        Area::create([
            'name' => 'Participacion',
        ]);
        Area::create([
            'name' => 'Innovacion Social',
        ]);
        Area::create([
            'name' => 'Empleabilidad',
        ]);
        Area::create([
            'name' => 'AIDEI',
        ]);
        Area::create([
            'name' => 'Recepcion Chiclana',
        ]);
        Area::create([
            'name' => 'Recepcion Begoña',
        ]);
        Area::create([
            'name' => 'Recepcion Galaxia',
        ]);


        Incidence::factory()->count(10)->create();

        Incidence::create([
            'user_id' => 1,
            'area_id' => 2,
            'category_id' =>3,
            'location_id' => 4,
            'state_id' => 2,
            'title' => 'sentence',
            'description' => 'paragraph',
        ]);

        Incidence::create([
            'user_id' => 1,
            'area_id' => 2,
            'category_id' =>3,
            'location_id' => 4,
            'state_id' => 2,
            'title' => 'Prueba',
            'description' => 'Probando seeder 2',
        ]);

        Booking::factory()->count(10)->create();

        Booking::create([
            'user_id' => 1,
            'area_id' => 1,
            'location_id' => 1,
            'state_id' => 1,
            'date' => '2023-01-01',
            'startTime' => '00:01',
            'endTime' => '00:01',
            'numPeople' => 3,
            'room' => 'name',
            'description' => 'paragraph',
            'comment' => 'comment',
        ]);

    }
}
