<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            [
                'nome'       => 'Ut blandit',
                'created_at' => now()
            ],
            [
                'nome' => 'Sed eget',
                'created_at' => now()
            ],
            [
                'nome' => 'Nam quis',
                'created_at' => now()
            ]
        ]);
    }
}
