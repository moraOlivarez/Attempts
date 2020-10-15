<?php

namespace attempts\entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DomicilioEntity extends Model{
    protected $table = 'CM_domicilio';
    protected static $nameTable = 'CM_domicilio';
    //protected static $razonSocial = 'razonSocialEmpresa';
    protected $fillable = [
       'calle_1', 
        'calle_2',
        'colonia',
        'codigoPostal',
        'ciudad',
        'municipio',
        'estado',
        'pais'
    ];

    // use SoftDeletes;



}