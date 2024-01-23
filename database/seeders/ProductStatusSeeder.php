<?php

namespace Database\Seeders;

use App\Models\ProductsStatus;
use App\Models\ProductStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductStatus::updateOrCreate([
            'name'     =>'En existencia',
            'code'     => 'in_stock'
        ]);
        ProductStatus::updateOrCreate([
            'name'     =>'Pocas Existencias',
            'code'     => 'low_stock'
        ]);
        ProductStatus::updateOrCreate([
            'name'     =>'Sin Existencia',
            'code'     => 'out_of_stock'
        ]);
    }
}
