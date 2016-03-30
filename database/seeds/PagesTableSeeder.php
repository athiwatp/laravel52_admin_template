<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Pages as Pages;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('static_pages')->delete();

        $faker = Faker::create('ru_RU');

        foreach (range(1,105) as $index) {
            Pages::create([
                'title' => $faker->sentence(10),
                'meta_keywords' => $faker->title,
                'meta_descriptions' => $faker->title,
                'content' => $faker->text,
                'is_published' =>  (int)($index % 2 === 0),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ]);
        }
    }
}
