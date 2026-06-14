<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Ensure this is the correct namespace for your Category model

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
            [
                'name' => "Casual Wear",
                'slug' => "casual-wear",
                'description' => "Comfortable and stylish casual wear for women.",
                'status' => 0,
                'popular' => 1,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Casual Wear for Women",
                'meta_description' => "Find the latest in casual wear for women at our online store.",
                'meta_keyword' => "Casual, Wear, Comfortable"
            ],
            [
                'name' => "Dresses",
                'slug' => "dresses",
                'description' => "Elegant and versatile dresses for any occasion.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Women's Dresses Online",
                'meta_description' => "Discover a wide range of dresses for women.",
                'meta_keyword' => "Dresses, Elegant, Versatile"
            ],
            [
                'name' => "Jackets & Coats",
                'slug' => "jackets-coats",
                'description' => "Stylish jackets and coats to keep you warm and fashionable.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Jackets & Coats for Women",
                'meta_description' => "Find stylish jackets and coats for women online.",
                'meta_keyword' => "Jackets, Coats, Warm"
            ],
            [
                'name' => "Tops & Blouses",
                'slug' => "tops-blouses",
                'description' => "Versatile tops and blouses to complete any outfit.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Tops & Blouses for Women",
                'meta_description' => "Discover a wide range of tops and blouses for women.",
                'meta_keyword' => "Tops, Blouses, Versatile"
            ],
            [
                'name' => "Jeans",
                'slug' => "jeans",
                'description' => "Comfortable and stylish jeans for every woman.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Jeans for Women",
                'meta_description' => "Find comfortable and stylish jeans for women online.",
                'meta_keyword' => "Jeans, Comfortable, Stylish"
            ],
            [
                'name' => "Skirts & Dresses",
                'slug' => "skirts-dresses",
                'description' => "Flowy skirts and elegant dresses to add femininity to your wardrobe.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Skirts & Dresses for Women",
                'meta_description' => "Discover flowy skirts and elegant dresses for women.",
                'meta_keyword' => "Skirts, Dresses, Femininity"
            ],
            [
                'name' => "Accessories",
                'slug' => "accessories",
                'description' => "Stylish accessories to enhance your outfits.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Women's Accessories",
                'meta_description' => "Find stylish accessories for women online.",
                'meta_keyword' => "Accessories, Stylish, Enhance"
            ],
            [
                'name' => "Footwear",
                'slug' => "footwear",
                'description' => "Comfortable and fashionable footwear for women.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Women's Footwear",
                'meta_description' => "Find comfortable and fashionable footwear for women online.",
                'meta_keyword' => "Footwear, Comfortable, Fashionable"
            ],
            [
                'name' => "Swimwear",
                'slug' => "swimwear",
                'description' => "Stylish swimwear to enjoy the summer season.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Women's Swimwear",
                'meta_description' => "Find stylish swimwear for women online.",
                'meta_keyword' => "Swimwear, Stylish, Summer"
            ],
            [
                'name' => "Outerwear",
                'slug' => "outerwear",
                'description' => "Warm and fashionable outerwear to keep you cozy in cooler weather.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Women's Outerwear",
                'meta_description' => "Find warm and fashionable outerwear for women online.",
                'meta_keyword' => "Outerwear, Warm, Fashionable"
            ],
            [
                'name' => "Undergarments",
                'slug' => "undergarments",
                'description' => "Comfortable and supportive undergarments for all your needs.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Women's Undergarments",
                'meta_description' => "Find comfortable and supportive undergarments for women online.",
                'meta_keyword' => "Undergarments, Comfortable, Supportive"
            ],
            [
                'name' => "Trousers & Leggings",
                'slug' => "trousers-leggings",
                'description' => "Comfortable trousers and leggings to keep you stylish and comfortable.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Women's Trousers & Leggings",
                'meta_description' => "Find comfortable trousers and leggings for women online.",
                'meta_keyword' => "Trousers, Leggings, Comfortable"
            ],
            [
                'name' => "Evening Wear",
                'slug' => "evening-wear",
                'description' => "Elegant evening wear to make a statement at special events.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Evening Wear for Women",
                'meta_description' => "Discover elegant evening wear for women online.",
                'meta_keyword' => "Evening Wear, Elegant, Statement"
            ],
            [
                'name' => "Sportswear",
                'slug' => "sportswear",
                'description' => "Active and comfortable sportswear for fitness and recreation.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Women's Sportswear",
                'meta_description' => "Find active and comfortable sportswear for women online.",
                'meta_keyword' => "Sportswear, Active, Comfortable"
            ],
            [
                'name' => "Home & Living",
                'slug' => "home-living",
                'description' => "Elegant home decor items to create a stylish living space.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Home & Living Decor for Women",
                'meta_description' => "Find elegant home decor items for women online.",
                'meta_keyword' => "Home Decor, Elegant, Stylish"
            ],
            [
                'name' => "Bags & Accessories",
                'slug' => "bags-accessories",
                'description' => "Stylish bags and accessories to carry your essentials with style.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Bags & Accessories for Women",
                'meta_description' => "Find stylish bags and accessories for women online.",
                'meta_keyword' => "Bags, Accessories, Stylish"
            ],
            [
                'name' => "Jewelry",
                'slug' => "jewelry",
                'description' => "Elegant jewelry to complete your outfit.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Women's Jewelry",
                'meta_description' => "Discover elegant jewelry for women online.",
                'meta_keyword' => "Jewelry, Elegant, Complete"
            ],
            [
                'name' => "Handbags",
                'slug' => "handbags",
                'description' => "Stylish handbags to carry your essentials with ease.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Handbags for Women",
                'meta_description' => "Find stylish handbags for women online.",
                'meta_keyword' => "Handbags, Stylish, Carry"
            ],
            [
                'name' => "Scarves & Wraps",
                'slug' => "scarves-wraps",
                'description' => "Stylish scarves and wraps to add warmth and style to your outfit.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Scarves & Wraps for Women",
                'meta_description' => "Find stylish scarves and wraps for women online.",
                'meta_keyword' => "Scarves, Wraps, Stylish"
            ],
            [
                'name' => "Hats & Caps",
                'slug' => "hats-caps",
                'description' => "Stylish hats and caps to keep your head cool and add style.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Hats & Caps for Women",
                'meta_description' => "Find stylish hats and caps for women online.",
                'meta_keyword' => "Hats, Caps, Stylish"
            ],
            [
                'name' => "Belts",
                'slug' => "belts",
                'description' => "Stylish belts to cinch up your outfit and add definition.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Belts for Women",
                'meta_description' => "Find stylish belts for women online.",
                'meta_keyword' => "Belts, Stylish, Cinch"
            ],
            [
                'name' => "Shoes",
                'slug' => "shoes",
                'description' => "Comfortable and fashionable shoes to complete your look.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Women's Shoes",
                'meta_description' => "Find comfortable and fashionable shoes for women online.",
                'meta_keyword' => "Shoes, Comfortable, Fashionable"
            ],
            [
                'name' => "Sunglasses & Eyewear",
                'slug' => "sunglasses-eyewear",
                'description' => "Stylish sunglasses and eyewear to protect your eyes and enhance your look.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Sunglasses & Eyewear for Women",
                'meta_description' => "Find stylish sunglasses and eyewear for women online.",
                'meta_keyword' => "Sunglasses, Eyewear, Stylish"
            ],
            [
                'name' => "Gloves",
                'slug' => "gloves",
                'description' => "Stylish gloves to keep your hands warm and add style.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Gloves for Women",
                'meta_description' => "Find stylish gloves for women online.",
                'meta_keyword' => "Gloves, Stylish, Warm"
            ],
            [
                'name' => "Watches & Timepieces",
                'slug' => "watches-timepieces",
                'description' => "Elegant watches and timepieces to complete your look.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Watches & Timepieces for Women",
                'meta_description' => "Find elegant watches and timepieces for women online.",
                'meta_keyword' => "Watches, Timepieces, Elegant"
            ],
            [
                'name' => "Jewelry Sets",
                'slug' => "jewelry-sets",
                'description' => "Complete jewelry sets to add a touch of elegance to your outfit.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Jewelry Sets for Women",
                'meta_description' => "Find complete jewelry sets for women online.",
                'meta_keyword' => "Jewelry Sets, Elegance, Complete"
            ],
            [
                'name' => "Wallets & Money Clips",
                'slug' => "wallets-money-clips",
                'description' => "Stylish wallets and money clips to keep your essentials organized.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Wallets & Money Clips for Women",
                'meta_description' => "Find stylish wallets and money clips for women online.",
                'meta_keyword' => "Wallets, Money Clips, Stylish"
            ],
            [
                'name' => "Ties & Scarves",
                'slug' => "ties-scarves",
                'description' => "Stylish ties and scarves to add a touch of elegance to your outfit.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Ties & Scarves for Women",
                'meta_description' => "Find stylish ties and scarves for women online.",
                'meta_keyword' => "Ties, Scarves, Stylish"
            ],
            [
                'name' => "Belts & Suspenders",
                'slug' => "belts-suspenders",
                'description' => "Stylish belts and suspenders to cinch up your outfit and add definition.",
                'status' => 0,
                'popular' => 0,
                'image' => "placeholder_image.jpg",
                'meta_title' => "Belts & Suspenders for Women",
                'meta_description' => "Find stylish belts and suspenders for women online.",
                'meta_keyword' => "Belts, Suspenders, Stylish"
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
