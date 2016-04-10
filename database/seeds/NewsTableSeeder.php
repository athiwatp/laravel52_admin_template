<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\News as News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->delete();

        $faker = Faker::create('ru_RU');

        foreach (range(1,105) as $index) {
            $title = $faker->sentence(10);
            News::create([
                'title' => $title,
                'url' => substr(md5($title), 0, 255),
                'content' => $faker->text,
                'date' => $faker->dateTime,
                'source' => $faker->company,
                'is_published' =>  (int)($index % 2 === 0),
                'is_main' => (int)($index % 10 === 0),
                'is_important' => (int)($index % 4 === 0),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ]);
        }
    }
}
