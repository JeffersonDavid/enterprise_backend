<?php
namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;



class ConnectedApplication extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'oauth_clients'; // Nombre de la tabla en la base de datos
    protected $fillable = [
        'name',
        'secret',
    ];

    // Resto de la implementación del modelo
}
