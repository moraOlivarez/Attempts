<?php
namespace attempts\entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComercioEstadoEntity extends Model{
    protected $table = 'CM_comercio_estado';
    protected static $nameTable = 'CM_comercio_estado';
   // protected static $razonSocial = 'razonSocialEmpresa';
    protected $fillable = [
       'comercio_id',
        'estado'
    ];

    // use SoftDeletes;

// public function getCompanyName(){
//     return  static::$razonSocial;
// }

}