<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class ProductsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        $products = [
            [
                'title' => 'Product 1',
                'slug' => 'PRD-'.strtoupper(Str::random(10)),
                'description' => null,
                'stock'=>10,
                'price'=>5.25,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Product 2',
                'slug' => 'PRD-'.strtoupper(Str::random(10)),
                'description' => null,
                'stock'=>15,
                'price'=>6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Product 3',
                'slug' => 'PRD-'.strtoupper(Str::random(10)),
                'description' => null,
                'stock'=>6,
                'price'=>9.13,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Product 4',
                'slug' => 'PRD-'.strtoupper(Str::random(10)),
                'description' => null,
                'stock'=>8,
                'price'=>15.5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Product 5',
                'slug' => 'PRD-'.strtoupper(Str::random(10)),
                'description' => null,
                'stock'=>10,
                'price'=>7.3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Product 6',
                'slug' => 'PRD-'.strtoupper(Str::random(10)),
                'description' => null,
                'stock'=>20,
                'price'=>99.6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            
        ];
        DB::table('products')->insert($products);
    }
}
