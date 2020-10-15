<?php

namespace attempts\entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreEntity extends Model{
    protected $table = 'CM_comercioEstado';
    protected static $nameTable = 'CM_comercioEstado';
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