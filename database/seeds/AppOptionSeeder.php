<?php

use App\AppOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Delete all records in DB
        DB::table('app_options')->delete();

        //Get default app options
        $appOptions = $this->getOptions();

        //Iterate items to insert in DB
        DB::table('app_options')->insert($appOptions);
    }

    private function getOptions()
    {
        return [
            [
                'name' => 'home_title',
                'value' => 'Bienvenido a mi portafolio',
                'description' => 'Título de la página principal'
            ],
            [
                'name' => 'works_page_title',
                'value' => 'Trabajos/Proyectos',
                'description' => 'Título de la página de proyectos'
            ],
            [
                'name' => 'about_page_title',
                'value' => 'Sobre mi',
                'description' => 'Título de la página de acerca'
            ],
        ];
    }
}
