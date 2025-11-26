<?php

namespace Database\Seeders;

use App\Models\Livro;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = Categoria::all();
        
        $livros = [
            [
                'titulo' => 'Dom Casmurro',
                'autor' => 'Machado de Assis',
                'descricao' => 'Clássico da literatura brasileira que narra a história de Bentinho e sua obsessão por Capitu.',
                'preco' => 25.90,
                'estoque' => 15,
                'isbn' => '978-85-254-0123-4',
                'categoria_nome' => 'Ficção',
            ],
            [
                'titulo' => 'O Cortiço',
                'autor' => 'Aluísio Azevedo',
                'descricao' => 'Romance naturalista que retrata a vida em um cortiço no Rio de Janeiro do século XIX.',
                'preco' => 22.50,
                'estoque' => 10,
                'isbn' => '978-85-254-0456-7',
                'categoria_nome' => 'Ficção',
            ],
            [
                'titulo' => 'Algoritmos e Estruturas de Dados',
                'autor' => 'Thomas Cormen',
                'descricao' => 'Livro fundamental para estudantes de ciência da computação sobre algoritmos.',
                'preco' => 189.90,
                'estoque' => 5,
                'isbn' => '978-85-352-7233-8',
                'categoria_nome' => 'Técnico',
            ],
            [
                'titulo' => 'Como Fazer Amigos e Influenciar Pessoas',
                'autor' => 'Dale Carnegie',
                'descricao' => 'Clássico livro de relacionamento interpessoal e desenvolvimento pessoal.',
                'preco' => 34.90,
                'estoque' => 20,
                'isbn' => '978-85-7542-189-3',
                'categoria_nome' => 'Auto-ajuda',
            ],
            [
                'titulo' => 'Uma Breve História do Tempo',
                'autor' => 'Stephen Hawking',
                'descricao' => 'Explicação acessível sobre cosmologia e física teórica.',
                'preco' => 42.90,
                'estoque' => 8,
                'isbn' => '978-85-8057-172-4',
                'categoria_nome' => 'Ciência',
            ],
            [
                'titulo' => 'O Senhor dos Anéis: A Sociedade do Anel',
                'autor' => 'J.R.R. Tolkien',
                'descricao' => 'Primeiro volume da épica fantasia sobre a Terra Média.',
                'preco' => 39.90,
                'estoque' => 12,
                'isbn' => '978-85-7542-923-3',
                'categoria_nome' => 'Fantasia',
            ],
            [
                'titulo' => 'História do Brasil',
                'autor' => 'Boris Fausto',
                'descricao' => 'Análise abrangente da formação e desenvolvimento do Brasil.',
                'preco' => 55.00,
                'estoque' => 7,
                'isbn' => '978-85-314-1068-2',
                'categoria_nome' => 'História',
            ],
            [
                'titulo' => 'O Assassinato no Expresso Oriente',
                'autor' => 'Agatha Christie',
                'descricao' => 'Clássico mistério com o detetive Hercule Poirot.',
                'preco' => 28.90,
                'estoque' => 18,
                'isbn' => '978-85-7542-445-0',
                'categoria_nome' => 'Mistério',
            ],
            [
                'titulo' => '1822: Como um homem sábio, uma princesa triste e um escocês louco por dinheiro ajudaram Dom Pedro a criar o Brasil',
                'autor' => 'Laurentino Gomes',
                'descricao' => 'Relato envolvente sobre a independência do Brasil.',
                'preco' => 48.90,
                'estoque' => 6,
                'isbn' => '978-85-7542-890-8',
                'categoria_nome' => 'História',
            ],
            [
                'titulo' => 'Sapiens: Uma Breve História da Humanidade',
                'autor' => 'Yuval Noah Harari',
                'descricao' => 'Análise fascinante sobre a evolução da espécie humana.',
                'preco' => 54.90,
                'estoque' => 14,
                'isbn' => '978-85-7542-933-2',
                'categoria_nome' => 'Não-ficção',
            ],
        ];

        foreach ($livros as $livroData) {
            $categoria = $categorias->where('nome', $livroData['categoria_nome'])->first();
            
            if ($categoria) {
                Livro::create([
                    'titulo' => $livroData['titulo'],
                    'autor' => $livroData['autor'],
                    'descricao' => $livroData['descricao'],
                    'preco' => $livroData['preco'],
                    'estoque' => $livroData['estoque'],
                    'isbn' => $livroData['isbn'],
                    'categoria_id' => $categoria->id,
                ]);
            }
        }
    }
}