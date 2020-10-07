<?php

namespace attempts\entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreEntity extends Model{
    protected $table = 'almacen_proveedor';
    protected static $nameTable = 'lorganization_colaborador';
    protected static $correo = 'correoColaborador';
    protected $fillable = [
        'rfcEmpresa',
        'nombreEmpresa',
        'razonSocialEmpresa',
        'giroEmpresa'
    ];

    // use SoftDeletes;



}