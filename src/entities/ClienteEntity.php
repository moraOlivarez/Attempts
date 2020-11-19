<?php

namespace attempts\entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteEntity extends Model{
    protected $table = 'CM_cliente';
    protected static $nameTable = 'CM_cliente';
    // protected static $razonSocial = 'razonSocialEmpresa';
    protected $fillable = [
       'nombre',
       'apellido_materno',
       'apellido_paterno',
       'email',
       'usuario',
       'clave_acceso',
    ];

    // use SoftDeletes;

// public function getCompanyName(){
//     return  static::$razonSocial;
// }

}