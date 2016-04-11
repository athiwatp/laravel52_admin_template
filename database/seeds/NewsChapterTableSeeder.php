<?php

use Illuminate\Database\Seeder;
use App\Models\Chapters as Chapter;

class NewsChapterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constants = Config::get('constants');

        Chapter::where('id', 'like', '%%')->delete();

        $faker = Faker\Factory::create('ru_RU');


        foreach (range(1,105) as $index) {
            Chapter::create([
                'title' => $faker->sentence(10),
                'description' => $faker->text,
                'pos' => 0,
                'is_active' => (int)($index % 2 === 0),
                'parent_id' => null,
                'type_chapter' =>  $constants['CHAPTER']['CHAPTER'],

                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ]);
        }
    }
}
