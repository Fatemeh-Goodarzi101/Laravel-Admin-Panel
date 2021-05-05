<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'دیزاین خونه',
            ],
            [
                'name' => 'کتاب و خوندنی',
            ],
            [
                'name' => 'مد و پوشاک'
            ],
            [
                'name' => 'آرایشی بهداشتی',
            ],
            [
                'name' => 'موبایل و لوازمش',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
