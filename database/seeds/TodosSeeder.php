<?php

use Illuminate\Database\Seeder;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //---Creates five or ten fake todo
        factory(App\Todo::class, 5)->create();
    }
}
