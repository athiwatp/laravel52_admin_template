<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Gallery as Gallery;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gallery')->delete();

        $faker = Faker::create('ru_RU');

        foreach (range(1,105) as $index) {
            Gallery::create([
                'title' => $faker->sentence(10),
                'tp' => Config::get('constants.GALLERY.PHOTO'),
                'filename' => $faker->image('public/uploads/gallery/2016/03/30', 300, 300, 'cats'),
                'pos' => (int)($index % 10 === 0),
                'user_id' => 1
            ]);
        }
    }
}
