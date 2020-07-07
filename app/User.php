<?php

namespace App;

use App\Perfil;
use App\Receta;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Evento que se ejecuta cuadno un usuario es creado
    protected static function boot()
    {
        parent::boot();

        //Asignar perfil una vez se hara creado un usuario nuevo
        static::created(function ($user){
            $user->perfil()->create();
        });
    }

    /**
     * Relación de 1:n de usuarios a recetas
     */
    public function recetas(){
        return $this->hasMany(Receta::class);
    }

    /**
     * Relacion de uno a uno
     */
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    //Recetas que usuario le ha dado me gusta
    public function meGusta()
    {
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }

}
