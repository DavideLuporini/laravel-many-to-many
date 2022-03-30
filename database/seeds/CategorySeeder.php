<?php

use App\Model\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['label' => 'HTML', 'color' => 'danger'],
            ['label' => 'CSS', 'color' => 'primary'],
            ['label' => 'ES6', 'color' => 'warning'],
            ['label' => 'PHP', 'color' => 'info'],
            ['label' => 'SQL', 'color' => 'success'],
            ['label' => 'VUEJS', 'color' => 'success'],
            ['label' => 'BOOTSTRAP', 'color' => 'light'],

        ];
        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->label = $category['label'];
            $newCategory->color = $category['color'];
            $newCategory->save();
        }
    }
}
