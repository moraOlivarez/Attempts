<?php

namespace attempts\store;

use attempts\entities\ClienteEntity;
use attempts\entities\DomicilioEntity;
use attempts\support\singleton;
class Comercio
{
    // use singleton;
    private $almacen = null;
    private $direccion = null;

    public function __construct()
    {
        $this->cliente = new ClienteEntity();
        $this->direccion= new DomicilioEntity();
    }

    public function createDomicilio( $calle_1, $calle_2, $colonia, $codigoPostal, $ciudad,  $municipio, $estado , $pais){
        try {

           
           return $this->direccion->create([ 'calle_1' => $calle_1 , 'calle_2'=> $calle_1,
                                  'colonia' => $colonia, 'codigoPostal' => $codigoPostal, 'ciudad' =>  $ciudad,
                                  'municipio' => $municipio , 'estado' => $estado, 'pais' => $pais ]);
           
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function deleteDomicilio( int $id){
        try {
                return $this->direccion->delete($id);
           
        } catch (\Exception $e) {

                throw new \Exception($e->getMessage());
        }
    }
    public function updateDomicilio(  $id, $calle_1, $calle_2, $colonia, $codigoPostal, $ciudad,  $municipio, $estado , $pais){

            $domicilio = $this->direccion::find($id);

        try {

            $domicilio->calle_1 = $calle_1;
            $domicilio->calle_2 = $calle_2;
            $domicilio->colonia =  $colonia;
            $domicilio->codigoPostal =  $codigoPostal;
            $domicilio->ciudad= $ciudad;
            $domicilio->municipio= $municipio;
            $domicilio->estado= $estado;
            $domicilio->pais=  $pais;
            $domicilio->save();

                    
        } catch (\Exception $e) {
            
                throw new \Exception($e->getMessage());
        }
    }








    // public function createCliente( $rfcEmpresa, $nombreEmpresa, $razonSocialEmpresa, $giroEmpresa ){
    //     try {
    //         // $obj =  new \stdClass();
    //         // $obj->rfcEmpresa = $rfcEmpresa;
    //         // $obj->nombreEmpresa =  $nombreEmpresa;
    //         // $obj->razonSocialEmpresa= $razonSocialEmpresa;
    //         // $obj->giroEmpresa=  $giroEmpresa;

    //         // return $this->almacen->create($obj);

    //        return $this->almacen->create([ 'rfcEmpresa' => $rfcEmpresa ,
    //                                'nombreEmpresa'=> $nombreEmpresa,
    //                               'razonSocialEmpresa' => $razonSocialEmpresa,
    //                               'giroEmpresa' => $giroEmpresa]);
           
    //     } catch (\Exception $e) {
    //         throw new \Exception($e->getMessage());
    //     }
    // }

}
