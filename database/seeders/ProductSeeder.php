<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        Product::factory(20)->create()->each(function (Product $producto) {

            $faker = Faker::create();

            $producto->image()->create(['url'=>'products/'.$faker->image('public/storage/products',640,480,'Product',false)]);
        });
    }
}
