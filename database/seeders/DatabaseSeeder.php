<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Hj. Nis',
            'email' => 'admin@jamu-hj-nis.com',
            'password' => bcrypt('admin123')
        ]);

        $kategori = [
            ['name' => 'Jamu Tradisional', 'slug' => 'jamu-tradisional'],
            ['name' => 'Herbal Kapsul', 'slug' => 'herbal-kapsul'],
            ['name' => 'Madu & Rempah', 'slug' => 'madu-rempah'],
            ['name' => 'Perawatan Tubuh', 'slug' => 'perawatan-tubuh'],
        ];

        foreach ($kategori as $cat) {
            \App\Models\Category::create($cat);
        }

        $produk = [
            ['name' => 'Jamu Kunyit Asam', 'slug' => 'jamu-kunyit-asam', 'price' => 15000, 'category_id' => 1, 'description' => 'Jamu tradisional segar untuk menyegarkan tubuh dan meredakan nyeri haid.', 'is_featured' => true],
            ['name' => 'Jamu Beras Kencur', 'slug' => 'jamu-beras-kencur', 'price' => 15000, 'category_id' => 1, 'description' => 'Jamu hangat untuk meredakan pegal linu dan menambah nafsu makan.', 'is_featured' => true],
            ['name' => 'Jamu Temulawak', 'slug' => 'jamu-temulawak', 'price' => 18000, 'category_id' => 1, 'description' => 'Jamu temulawak asli untuk menjaga fungsi hati dan pencernaan.', 'is_featured' => true],
            ['name' => 'Kapsul Temulawak', 'slug' => 'kapsul-temulawak', 'price' => 35000, 'category_id' => 2, 'description' => 'Ekstrak temulawak dalam bentuk kapsul praktis.', 'is_featured' => false],
            ['name' => 'Kapsul Pegagan', 'slug' => 'kapsul-pegagan', 'price' => 30000, 'category_id' => 2, 'description' => 'Membantu melancarkan sirkulasi darah dan meningkatkan daya ingat.', 'is_featured' => false],
            ['name' => 'Madu Hutan Asli', 'slug' => 'madu-hutan-asli', 'price' => 85000, 'category_id' => 3, 'description' => 'Madu murni dari hutan liar, kaya akan antioksidan.', 'is_featured' => true],
            ['name' => 'Madu Hitam Pahit', 'slug' => 'madu-hitam-pahit', 'price' => 95000, 'category_id' => 3, 'description' => 'Madu hitam berkhasiat untuk menurunkan gula darah dan menjaga stamina.', 'is_featured' => false],
            ['name' => 'Lulur Tradisional', 'slug' => 'lulur-tradisional', 'price' => 25000, 'category_id' => 4, 'description' => 'Lulur rempah untuk mengangkat sel kulit mati dan mencerahkan kulit.', 'is_featured' => false],
            ['name' => 'Param Kocok', 'slug' => 'param-kocok', 'price' => 20000, 'category_id' => 4, 'description' => 'Param cair untuk meredakan nyeri otot dan masuk angin.', 'is_featured' => false],
            ['name' => 'Wedang Uwuh', 'slug' => 'wedang-uwuh', 'price' => 12000, 'category_id' => 3, 'description' => 'Minuman rempah hangat khas tradisional.', 'is_featured' => true],
        ];

        foreach ($produk as $prod) {
            \App\Models\Product::create($prod);
        }

        \App\Models\Testimonial::create([
            'name' => 'Siti Aisyah',
            'role' => 'Pelanggan Setia',
            'content' => 'Jamu beras kencurnya mantap banget! Badan jadi lebih segar setelah minum.',
            'is_active' => true
        ]);
        \App\Models\Testimonial::create([
            'name' => 'Budi Santoso',
            'role' => 'Pekerja Kantoran',
            'content' => 'Sejak rutin minum jamu temulawak Hj. Nis, maag saya sudah jarang kambuh.',
            'is_active' => true
        ]);
    }
}
