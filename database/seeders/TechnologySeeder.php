<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i=0; $i < 20 ; $i++) {
        $newTechnology=new Technology();
        $newTechnology->name =  $faker->unique()-> text(9);

        $newTechnology->color=$faker->safeHexColor();
        $newTechnology->save();
        $newTechnology->slug= Str::slug($newTechnology->id . ' ' . $newTechnology->name);
        $newTechnology->update();
        }

    }
}
