<?php

namespace attempts\entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComercioEntity extends Model{
    protected $table = 'CM_comercio';
    protected static $nameTable = 'CM_comercio';
  //  protected static $razonSocial = 'razonSocialEmpresa';
    protected $fillable = [
        'nombre',
        'direccion_id'
    ];

    // use SoftDeletes;



}