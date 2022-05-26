<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class createKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $references = [
            [
                'kategori'	=> "appetizer",
            ],
            [
                'kategori'	=> "main course",
            ],
            [
                'kategori'	=> "dezzert",
            ]
        ];

        \DB::table('kategori')->insert($references);
    }
}
