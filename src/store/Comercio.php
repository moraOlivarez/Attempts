<?php

namespace attempts\store;

// use attempts\support\singleton;
use Illuminate\Support\Str;
use attempts\entities\ClienteEntity;
use Illuminate\Support\Facades\Hash;
use attempts\entities\ComercioEntity;
use attempts\entities\DomicilioEntity;
use attempts\entities\ComercioEstadoEntity;



class Comercio
{
 
    private $almacen = null;
    private $direccion = null;
    private $comercio = null;

    public function __construct()
    {
        $this->cliente = new ClienteEntity();
        $this->direccion= new DomicilioEntity();
        $this->comercio = new ComercioEntity();
        $this->estadoComercio = new ComercioEstadoEntity();
    }

    public function createDomicilio( $calle_1, $calle_2, $colonia, $codigoPostal, $ciudad,  $municipio, $estado , $pais){
        try {

           
           return $this->direccion->create([ 'calle_1' => $calle_1 , 'calle_2'=> $calle_2,
                                  'colonia' => $colonia, 'codigoPostal' => $codigoPostal, 'ciudad' =>  $ciudad,
                                  'municipio' => $municipio , 'estado' => $estado, 'pais' => $pais ]);
           
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function deleteDomicilio( int $id){
        try {
                return $this->direccion->where('id', "=", $id)->delete();
                // return "exito";
           
        } catch (\Exception $e) {

                throw new \Exception($e->getMessage());
        }
    }

    public function getDomicilio( int $id){
        try {
                return $this->direccion->find($id);
                // return "exito";
           
        } catch (\Exception $e) {

                throw new \Exception($e->getMessage());
        }
    }

    public function getAllDomicilio(){
        try {
                // return $this->direccion->delete($id);
                return  $this->direccion->get();
           
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

    public function createClient($nombre, $materno, $paterno, $email, $usuario ){

        return $this->cliente->create(['nombre' => $nombre,'apellido_materno' => $materno, 'apellido_paterno' =>$paterno ,
        'email' =>  $email,  'usuario' => $usuario , 'clave_acceso' => self::createPassword().""]);

    }
    public function updateClient( int $id, $nombre, $materno, $paterno, $email, $usuario ){

        return $this->cliente->findOrFail($id)->update(['nombre' => $nombre,'apellido_materno' => $materno, 'apellido_paterno' =>$paterno ,
        'email' =>  $email,  'usuario' => $usuario , 'clave_acceso' => self::createPassword().""]);

    }
  
    public function deleteClient( int $id ){
        try {

            return $this->cliente->where('id',"=", $id)->delete();
            
        }catch (\Exception $e) {

        throw new \Exception($e->getMessage());
        }
    
    }
    public function getAllClient(){
        try {
                return $this->cliente->get();
               
           
        } catch (\Exception $e) {

                throw new \Exception($e->getMessage());
        }
    }


    static public function createPassword(){
      
        return Str::random(16);
    }


    public function createCommerce( string $nombre, int $direccion_id, int $cliente_id ){
        try {
   
                return $this->comercio->create(['nombre' => $nombre, 'direccion_id' => $direccion_id, 'cliente_id' => $cliente_id ]);
               
           
        } catch (\Exception $e) {

                throw new \Exception($e->getMessage());
        }
    }

    public function deleteCommerce(  int $id ){
        try {
                
             $eliminar =   $this->comercio->findOrFail($id);
             
               
             $this->deleteClient(( int) $eliminar->cliente_id);
             $this->deleteDomicilio((int)$eliminar->direccion_id);
            

            return     $this->comercio->where('id', "=", $id)->delete();
           
        } catch (\Exception $e) {

                throw new \Exception($e->getMessage());
        }
    }

    public function createCommerceState(  int $comercio_id , string $estado){
        try {
                
            return  $this->estadoComercio->create(['comercio_id' => $comercio_id, 'estado' => $estado]);
           
        } catch (\Exception $e) {

                throw new \Exception($e->getMessage());
        }
    }
    public function updateCommerceState( int $id, int $comercio_id , string $estado){
        try {
                
            return  $this->estadoComercio->where('id', '=', $id)->update(['comercio_id' => $comercio_id, 'estado' => $estado]);
           
        } catch (\Exception $e) {

                throw new \Exception($e->getMessage());
        }
    }

    public function deleteCommerceState(  int $id ){
        try {
                
            return  $this->estadoComercio->where('id', '=', $id)->delete();
           
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
