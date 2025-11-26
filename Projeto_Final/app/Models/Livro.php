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
        'categoria_id',
    ];

    protected $casts = [
        'preco' => 'decimal:2',
        'estoque' => 'integer',
    ];

    /**
     * Relacionamento com categoria
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Accessor para formatar o preço
     */
    public function getPrecoFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->preco, 2, ',', '.');
    }

    /**
     * Accessor para URL da imagem
     */
    public function getImagemCapaUrlAttribute()
    {
        if ($this->imagem_capa) {
            return asset('storage/' . $this->imagem_capa);
        }
        return asset('images/sem-capa.svg');
    }
}