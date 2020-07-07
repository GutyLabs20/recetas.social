<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //campos que se agregan
    protected $fillable = [
        'titulo', 'ingredientes', 'preparacion', 'imagen', 'categoria_id'
    ];

    //Obtener la categoria via llave FK
    public function categoria()
    {   
        return $this->belongsTo(CategoriaReceta::class);
    }

    //Obtener la categoria via llave FK
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id'); //Este segundo parametro es la FK de la tabla
    }

    //Likes que ha recibido de una receta
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
