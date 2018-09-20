<?php

use Illuminate\Database\Seeder;
use App\Models\Color;
use App\Models\Category;
use App\Models\Tag;

class DummyData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $color = [
            ['name' => 'Black'],
            ['name' => 'White'],
            ['name' => 'Red'],
            ['name' => 'Metallic'],
            ['name' => 'Brown'],
        ];
        Color::insert($color);

        $tag = [
            ['name' => 'Kitchen'],
            ['name' => 'Kitchen Apliances'],
            ['name' => 'Ingredients'],
            ['name' => 'Coffee, Tea & Cocktails'],
            ['name' => 'Chocolate'],
            ['name' => 'Cookware'],
        ];
        Tag::insert($tag);

        $category = [
            ['name' => 'Food'],
            ['name' => 'Cookware'],
            ['name' => 'Dining Set'],
            ['name' => 'Beverages'],
        ];
        Category::insert($category);

    }
}
