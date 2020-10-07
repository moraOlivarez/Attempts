<?php

namespace attempts\store;

use attempts\entities\StoreEntity;


class Almacen
{
    private $almacen = null;

    public function __construct()
    {
        $this->almacen = new StoreEntity();
    }

    public function createAlmacen( $rfcEmpresa, $nombreEmpresa, $razonSocialEmpresa, $giroEmpresa ){
        try {
            // $obj =  new \stdClass();
            // $obj->rfcEmpresa = $rfcEmpresa;
            // $obj->nombreEmpresa =  $nombreEmpresa;
            // $obj->razonSocialEmpresa= $razonSocialEmpresa;
            // $obj->giroEmpresa=  $giroEmpresa;

            // return $this->almacen->create($obj);

           return $this->almacen->create([ 'rfcEmpresa' => $rfcEmpresa ,
                                   'nombreEmpresa'=> $nombreEmpresa,
                                  'razonSocialEmpresa' => $razonSocialEmpresa,
                                  'giroEmpresa' => $giroEmpresa]);
           
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
