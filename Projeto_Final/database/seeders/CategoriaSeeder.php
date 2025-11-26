<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nome' => 'Ficção',
                'descricao' => 'Livros de ficção literária, romances e narrativas imaginárias.',
            ],
            [
                'nome' => 'Não-ficção',
                'descricao' => 'Livros baseados em fatos reais, biografias e documentários.',
            ],
            [
                'nome' => 'Técnico',
                'descricao' => 'Livros técnicos, manuais e literatura especializada.',
            ],
            [
                'nome' => 'Auto-ajuda',
                'descricao' => 'Livros de desenvolvimento pessoal e autoconhecimento.',
            ],
            [
                'nome' => 'História',
                'descricao' => 'Livros sobre história mundial, brasileira e regional.',
            ],
            [
                'nome' => 'Ciência',
                'descricao' => 'Livros de divulgação científica e acadêmica.',
            ],
            [
                'nome' => 'Fantasia',
                'descricao' => 'Livros de fantasia épica, urbana e medieval.',
            ],
            [
                'nome' => 'Mistério',
                'descricao' => 'Livros de suspense, thriller e investigação.',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}