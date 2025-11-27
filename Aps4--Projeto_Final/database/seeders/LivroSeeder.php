<?php

namespace Database\Seeders;

use App\Models\Livro;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    public function run(): void
    {        
        $livros = [
            [
                'titulo' => 'Dom Casmurro',
                'autor' => 'Machado de Assis',
                'descricao' => 'Clássico da literatura brasileira que narra a história de Bentinho e sua obsessão por Capitu.',
                'preco' => 25.90,
                'estoque' => 15,
                'isbn' => '978-85-254-0123-4',
            ],
            [
                'titulo' => 'O Cortiço',
                'autor' => 'Aluísio Azevedo',
                'descricao' => 'Romance naturalista que retrata a vida em um cortiço no Rio de Janeiro do século XIX.',
                'preco' => 22.50,
                'estoque' => 10,
                'isbn' => '978-85-254-0456-7',
            ],
            [
                'titulo' => 'Algoritmos e Estruturas de Dados',
                'autor' => 'Thomas Cormen',
                'descricao' => 'Livro fundamental para estudantes de ciência da computação sobre algoritmos.',
                'preco' => 189.90,
                'estoque' => 5,
                'isbn' => '978-85-352-7233-8',
            ],
            [
                'titulo' => 'Como Fazer Amigos e Influenciar Pessoas',
                'autor' => 'Dale Carnegie',
                'descricao' => 'Clássico livro de relacionamento interpessoal e desenvolvimento pessoal.',
                'preco' => 34.90,
                'estoque' => 20,
                'isbn' => '978-85-7542-189-3',
            ],
            [
                'titulo' => 'Uma Breve História do Tempo',
                'autor' => 'Stephen Hawking',
                'descricao' => 'Explicação acessível sobre cosmologia e física teórica.',
                'preco' => 42.90,
                'estoque' => 8,
                'isbn' => '978-85-8057-172-4',
            ],
            [
                'titulo' => 'O Senhor dos Anéis: A Sociedade do Anel',
                'autor' => 'J.R.R. Tolkien',
                'descricao' => 'Primeiro volume da épica fantasia sobre a Terra Média.',
                'preco' => 39.90,
                'estoque' => 12,
                'isbn' => '978-85-7542-923-3',
            ],
            [
                'titulo' => 'História do Brasil',
                'autor' => 'Boris Fausto',
                'descricao' => 'Análise abrangente da formação e desenvolvimento do Brasil.',
                'preco' => 55.00,
                'estoque' => 7,
                'isbn' => '978-85-314-1068-2',
            ],
            [
                'titulo' => 'O Assassinato no Expresso Oriente',
                'autor' => 'Agatha Christie',
                'descricao' => 'Clássico mistério com o detetive Hercule Poirot.',
                'preco' => 28.90,
                'estoque' => 18,
                'isbn' => '978-85-7542-445-0',
            ],
            [
                'titulo' => '1822: Como um homem sábio, uma princesa triste e um escocês louco por dinheiro ajudaram Dom Pedro a criar o Brasil',
                'autor' => 'Laurentino Gomes',
                'descricao' => 'Relato envolvente sobre a independência do Brasil.',
                'preco' => 48.90,
                'estoque' => 6,
                'isbn' => '978-85-7542-890-8',
            ],
            [
                'titulo' => 'Sapiens: Uma Breve História da Humanidade',
                'autor' => 'Yuval Noah Harari',
                'descricao' => 'Análise fascinante sobre a evolução da espécie humana.',
                'preco' => 54.90,
                'estoque' => 14,
                'isbn' => '978-85-7542-933-2',
            ],
        ];

        foreach ($livros as $livroData) {
            Livro::create($livroData);
        }
    }
}