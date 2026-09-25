<?php

namespace Database\Seeders;

use App\Constants\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name'=>'Ação'
            ],
            [
                'name'=>'RPG'
            ],
            [
                'name'=>'Estratégia'
            ],
            [
                'name'=>'Esporte'
            ],
            [
                'name'=>'Simulação'
            ],
            [
                'name'=>'Indie'
            ]
        ];

        DB::table(Table::CATEGORIES)->insert($categories);
    }
}