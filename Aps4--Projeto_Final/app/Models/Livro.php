<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';

    protected $fillable = [
        'titulo',
        'autor',
        'descricao',
        'preco',
        'estoque',
        'isbn',
        'imagem_capa',
    ];

    protected $casts = [
        'preco' => 'decimal:2',
        'estoque' => 'integer',
    ];

    public function getPrecoFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->preco, 2, ',', '.');
    }

    public function getImagemCapaUrlAttribute()
    {
        if ($this->imagem_capa) {
            return asset('storage/' . $this->imagem_capa);
        }
        return asset('images/sem-capa.svg');
    }
}