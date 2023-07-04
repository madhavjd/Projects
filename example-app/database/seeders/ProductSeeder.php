<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(Faker $faker): void
    {
        for ($i=0; $i <10 ; $i++) { 
            DB::table('product')->insert([
                'product_title' => $faker->name,
                'product_description' => $faker->paragraph(),
                'product_price' => rand(10,10000),
                'product_quantity' => rand(1,100),
            ]);
        }
        
    }
}
