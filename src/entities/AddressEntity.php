<?php

namespace attempts\entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressEntity extends Model{
    protected $table = 'almacen_direccion';
    protected static $nameTable = 'almacen_direccion';
    protected static $razonSocial = 'razonSocialEmpresa';
    protected $fillable = [
        'rfcEmpresa',
        'nombreEmpresa',
        'razonSocialEmpresa',
        'giroEmpresa'
    ];

    // use SoftDeletes;


}