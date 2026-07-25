<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
        [
            'name' => 'general',
            'description' => 'Ruang umum untuk pembicaraan santai',
        ],
        ];

        foreach ($categories as $cat) {
                    Category::create([
                        'name'        => $cat['name'],
                        'slug'        => Str::slug($cat['name']),
                        'description' => $cat['description'],
                    ]);
        }
    }
}
