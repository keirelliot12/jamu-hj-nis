<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@jamu-hj-nis.com',
            'password' => bcrypt('admin123'),
        ]);

        $categories = [
            ['name' => 'Jamu Tradisional', 'description' => 'Jamu cair siap minum dari rempah asli.'],
            ['name' => 'Herbal Kapsul', 'description' => 'Ekstrak herbal dalam bentuk kapsul praktis.'],
            ['name' => 'Madu dan Rempah', 'description' => 'Madu murni dan campuran rempah berkhasiat.'],
            ['name' => 'Perawatan Tubuh', 'description' => 'Lulur dan perawatan luar tradisional.'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
            ]);
        }

        $products = [
            [
                'category_id' => 1,
                'name' => 'Jamu Kunyit Asam',
                'price' => 15000,
                'description' => 'Menyegarkan tubuh dan melancarkan haid.',
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Jamu Beras Kencur',
                'price' => 15000,
                'description' => 'Menghilangkan pegal linu dan menambah nafsu makan.',
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Kapsul Temulawak',
                'price' => 45000,
                'description' => 'Menjaga fungsi hati dan pencernaan.',
                'is_featured' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Madu Hutan Liar',
                'price' => 85000,
                'description' => 'Madu murni dari hutan, kaya antioksidan.',
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Lulur Tradisional Bengkoang',
                'price' => 25000,
                'description' => 'Mencerahkan dan menghaluskan kulit.',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $prod) {
            Product::create([
                'category_id' => $prod['category_id'],
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name']),
                'price' => $prod['price'],
                'description' => $prod['description'],
                'is_featured' => $prod['is_featured'],
            ]);
        }
    }
}
