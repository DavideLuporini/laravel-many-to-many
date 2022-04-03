<?php

use App\Model\Post;
use App\Model\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void        
     */
    public function run(Faker $faker)
    {
        // i create a simple array of ids
        $category_ids = Category::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->category_id = Arr::random($category_ids);
            $post->title = $faker->text(20);
            $post->content = $faker->paragraphs(2, true);
            $post->image = $faker->imageUrl(250, 250);
            $post->save();
        }
    }
}
