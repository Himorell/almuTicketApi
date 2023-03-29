<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Area;
use App\Models\Room;
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
        //Users seeds
        
        User::factory()->create([
            'name' => 'Fem',
            'surname' => 'Coders',
            'email' => 'coders@arrabalempleo.org',
            'isAdmin' => True,
        ]);

        User::factory()->create([
            'name' => 'Almudena',
            'surname' => 'Andreu',
            'email' => 'a.andreu@arrabalempleo.org',
            'isAdmin' => True,
        ]);

        User::factory()->create([
            'name' => 'Anabel',
            'surname' => 'Vilar',
            'email' => 'avilar@arrabalempleo.org',
            'isAdmin' => false,
        ]);
        User::factory()->create([
            'name' => 'Sandra',
            'surname' => 'Leon',
            'email' => 'sleon@arrabalempleo.org',
            'isAdmin' => false,
        ]);
        User::factory()->create([
            'name' => 'Carmen',
            'surname' => 'Cruces',
            'email' => 'ccruces@arrabalempleo.org',
            'isAdmin' => false,
        ]);
        User::factory()->create([
            'name' => 'Carmen',
            'surname' => 'Gallardo',
            'email' => 'cgallardo@arrabalempleo.org',
            'isAdmin' => false,
        ]);
        User::factory()->create([
            'name' => 'Raquel',
            'surname' => 'Palomo',
            'email' => 'rpalomo@arrabalempleo.org',
            'isAdmin' => false,
        ]);

        //Categories seeds
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

        //States seeds
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

        //Locations seeds
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

        //Areas seeds
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

        //Rooms seeds
        Room::create([
            'name' => 'IMO/Salón de Actos',
        ]);
        Room::create([
            'name' => 'IMO/Espacio de Innovación',
        ]);
        Room::create([
            'name' => 'IMO/Sala de Formación',
        ]);
        Room::create([
            'name' => 'IMO/Sala de Encuentros',
        ]);
        Room::create([
            'name' => 'EL CARMEN/Aula de Formación',
        ]);
        Room::create([
            'name' =>'EL CARMEN/Espacio Central Abierto',
        ]);
        Room::create([
            'name' =>'EL CARMEN/Espacio Coworking',
        ]);

        Room::create([
            'name' =>'DOS ACERAS/Aula 3',
        ]);
        Room::create([
            'name' =>'DOS ACERAS/Sala Común 1ªPlanta',
        ]);
        Room::create([
            'name' =>'DOS ACERAS/Salon de Actos',
        ]);
        Room::create([
            'name' =>'EDIF.GALAXIA/Sala Galaxia',
        ]);
        Room::create([
            'name' => 'OTROS',
        ]);


        //Incidences seeds
        Incidence::create([
            'user_id' => 3,
            'area_id' => 6,
            'category_id' =>1,
            'location_id' => 4,
            'state_id' => 2,
            'title' => 'Apoyo administrativo para nuevo proyecto',
            'description' => 'Apoyo administrativo para nuevo proyecto para determinar viabilidad de promocion de becas',
        ]);

        Incidence::create([
            'user_id' => 4,
            'area_id' => 2,
            'category_id' =>3,
            'location_id' => 4,
            'state_id' => 2,
            'title' => 'Instalacion de nuevos programas a portatiles nuevos',
            'description' => 'Instalacion de nuevos programas a portatiles nuevos que han llegado a RRHH para nuevos proyectos',
        ]);

        //Bookings seeds
        Booking::create([
            'user_id' => 5,
            'area_id' => 10,
            'room_id' => 9,
            'location_id' => 5,
            'state_id' => 1,
            'date' => '2023-01-01',
            'startTime' => '09:01',
            'endTime' => '11:30',
            'numPeople' => 6,
            'description' => 'Presentacion de nuevo proyecto a Incorpora',
            'comment' => '',
        ]);

        Booking::create([
            'user_id' => 6,
            'area_id' => 3,
            'room_id' => 6,
            'location_id' => 4,
            'state_id' => 1,
            'date' => '2023-01-01',
            'startTime' => '10:01',
            'endTime' => '12:01',
            'numPeople' => 6,
            'description' => 'Historias Femcoders',
            'comment' => '',
        ]);

    }
}