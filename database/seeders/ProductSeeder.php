<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; 
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File; 

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $faker->unique(true); // Increase max retries
        $faker->unique(true);

        // Get all category IDs
        $categoryIds = Category::pluck('id')->toArray();
        // Ensure there are at least one category
        if (empty($categoryIds)) {
            $this->command->info('No categories found. Please create some categories first.');
            return; // Exit the seeder if no categories exist
        }

        $size = count($categoryIds);

        // Log the size for debugging purposes
        Log::info('Number of categories:', ['count' => $size]);
        $counter = 0;

        // Define the directory containing product images
        $imageDirectory = public_path('upload/product');

        // Get all image files in the directory
        $images = File::files($imageDirectory);

        // Create 200 products with random category and image
        for ($i = 0; $i < 200; $i++) {
            $cateId = $categoryIds[$counter % $size];
            $randomImage = $faker->randomElement($images);
            
            // Generate a unique name by appending the counter
            $uniqueName = $faker->word . '-' . ($i + 1);

            Product::create([
                'cate_id' => $cateId,
                'name' => $uniqueName,
                'slug' => strtolower(str_replace(' ', '-', $uniqueName)),
                'small_description' => $faker->sentence(5),
                'description' => $faker->paragraph(3),
                'original_price' => $faker->numberBetween(500, 2000),
                'selling_price' => $faker->numberBetween(500, 2000),
                'image' => basename($randomImage), // Use the filename of the random image
                'qty' => $faker->numberBetween(10, 100),
                'tax' => $faker->randomElement(['5%', '10%', '15%']),
                'status' => $faker->randomElement([0, 1]),
                'trending' => $faker->randomElement([0, 1]),
                'meta_title' => $faker->sentence(3),
                'meta_keyword' => implode(',', $faker->words(5)),
                'meta_description' => $faker->paragraph(2),
            ]);
            $counter++;
        }
    }
}