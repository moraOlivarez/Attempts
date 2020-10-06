<?php

namespace leonardo_organization\organization;

use Hrm_TyA\ConfigReporte\ConfigReporteEntity;
use Illuminate\Database\Eloquent\Builder;
use leonardo_organization\entities\ColaboradorEntity;
use leonardo_organization\entities\PuestoEntity;
use leonardo_organization\entities\SucursalEntity;

class Colaborador
{
    private $colaborador = null;

    public function __construct()
    {
        $this->colaborador = new ColaboradorEntity();
    }


    public function createColaborador($nombreColab, $apellidoMatColab, $apellidoPatColab, $fechaNacColab, $curpColab, $idPuesto,
                                      $telefonoColab = null, $correoColab = null, $rfcColab = null, $nssColab = null, $idUsuario = null,
                                      $estado_civil = null, $fecha_ingreso = null, $clabe_interbancaria = null,
                                      $ciudad = null, $estado_nacimiento = null, $credito_infonavit = null, $descuento_mensual = null,
                                      $sueldo_diario = null,$sueldo_mensual = null,$sucursal_id = null,$tipo = null)
    {
        try {

            if (!PuestoEntity::where('id', $idPuesto)->exists()) {
                throw new \Exception('No se encontro puesto con ese id');
            }

            if($clabe_interbancaria !== null){
                if($this->colaborador->where('clabe_interbancaria',$clabe_interbancaria)->exists()){
                    throw new \Exception('La clabe interbancaria ya existe.');
                }
            }

            if($curpColab !== null){
                if($this->colaborador->where('curpColaborador',$curpColab)->exists()){
                    throw new \Exception('La CURP ya existe.');
                }
            }

            if($sucursal_id !== null){
                if(!SucursalEntity::where('id',$sucursal_id)->exists()){
                    throw new \Exception('No se encontro la sucursal.');
                }
            }


            return $this->colaborador->create([
                'nombreColaborador' => $nombreColab,
                'apellidoMatColaborador' => $apellidoMatColab,
                'apellidoPatColaborador' => $apellidoPatColab,
                'fechaNacimientoColaborador' => $fechaNacColab,
                'telefonoColaborador' => $telefonoColab,
                'correoColaborador' => $correoColab,
                'rfcColaborador' => $rfcColab,
                'curpColaborador' => $curpColab,
                'nssColaborador' => $nssColab,
                'id_Puesto' => $idPuesto,
                'estado_civil' => $estado_civil,
                'fecha_ingreso' => $fecha_ingreso,
                'clabe_interbancaria' => $clabe_interbancaria,
                'ciudad' => $ciudad,
                'estado_nacimiento' => $estado_nacimiento,
                'credito_infonavit' => $credito_infonavit,
                'descuento_mensual' => $descuento_mensual,
                'sueldo_diario' => $sueldo_diario,
                'sueldo_mensual' => $sueldo_mensual,
                'sucursal_id' => $sucursal_id,
                'tipo' => $tipo
            ]);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getAllColaboradores()
    {
        try {
            $colaborador = ColaboradorEntity::all();

            return $colaborador;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getColaboradores($sucursal_id = null,$puesto_id = null,$colaborador_id = null)
    {
        try {
            $colaborador = ColaboradorEntity::with([
                'puesto',
                'sucursal'
            ]);

            if($sucursal_id !== null){
                $colaborador = $colaborador->whereHas('sucursal', function(Builder $query) use($sucursal_id){
                    $query->where('id',$sucursal_id);
                });
            }

            if($puesto_id !== null){
                $colaborador = $colaborador->whereHas('puesto', function(Builder $query) use($puesto_id){
                    $query->where('id',$puesto_id);
                });
            }

            return ['data' => $colaborador_id !== null ? $colaborador->where('id',$colaborador_id)->get() :$colaborador->get()];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getRelationsDataByIdColaborador($id)
    {
        try {
            if(!ColaboradorEntity::where('id',$id)->exists()){
                throw new \Exception('No existe el colaborador');
            }
            
            $colaborador = ColaboradorEntity::with([
                'puesto',
                'sucursal',
                'usuario',
                'documentospersonal.archivo',
                'documentospersonal.tipodocumento'
            ])->where('id',$id)->first();

            return $colaborador;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateColaboradorById($idColab, $nombreColab, $apellidoMatColab, $apellidoPatColab, $fechaNacColab = null, $curpColab = null, $idPuesto = null,
                                          $telefonoColab = null, $correoColab = null, $rfcColab = null, $nssColab = null, $idUsuario = null,
                                          $estado_civil = null, $fecha_ingreso = null, $clabe_interbancaria = null,
                                          $ciudad = null, $estado_nacimiento = null, $credito_infonavit = null, $descuento_mensual = null,
                                          $sueldo_diario = null,$sueldo_mensual = null,$sucursal_id = null,$tipo = null)
    {
        try {
            if($idPuesto !== null){
                if (!PuestoEntity::where('id', $idPuesto)->exists()) {
                    throw new \Exception('No se encontro puesto con ese id');
                }
            }

            if($clabe_interbancaria !== null){
                if($this->colaborador->where('clabe_interbancaria',$clabe_interbancaria)->exists()){
                    throw new \Exception('La clabe interbancaria ya existe.');
                }
            }

            if($curpColab !== null){
                if($this->colaborador->where('curpColaborador',$curpColab)->exists()){
                    throw new \Exception('La CURP ya existe.');
                }
            }

            if($sucursal_id !== null){
                if(!SucursalEntity::where('id',$sucursal_id)->exists()){
                    throw new \Exception('No se encontro la sucursal.');
                }
            }

            if($this->colaborador->where('id',$idColab)->exists()){

                $colab = ColaboradorEntity::find($idColab);

                $colab->nombreColaborador = $nombreColab;
                $colab->apellidoPatColaborador = $apellidoPatColab;
                $colab->apellidoMatColaborador = $apellidoMatColab;
                !is_null($fechaNacColab) ? $colab->fechaNacimientoColaborador = $fechaNacColab : false;
                !is_null($curpColab) ? $colab->curpColaborador = $curpColab : false;
                !is_null($idPuesto) ? $colab->id_Puesto = $idPuesto : false;
                !is_null($telefonoColab) ? $colab->telefonoColaborador = $telefonoColab : false;
                !is_null($correoColab) ? $colab->correoColaborador = $correoColab : false;
                !is_null($rfcColab) ? $colab->rfcColaborador = $rfcColab : false;
                !is_null($nssColab) ? $colab->nssColaborador = $nssColab : false;
                !is_null($idUsuario) ? $colab->id_Usuario = $idUsuario : false;
                !is_null($estado_civil) ? $colab->estado_civil = $estado_civil : false;
                !is_null($fecha_ingreso) ? $colab->fecha_ingreso = $fecha_ingreso : false;
                !is_null($clabe_interbancaria) ? $colab->clabe_interbancaria = $clabe_interbancaria : false;
                !is_null($ciudad) ? $colab->ciudad = $ciudad : false;
                !is_null($estado_nacimiento) ? $colab->estado_nacimiento = $estado_nacimiento : false;
                !is_null($credito_infonavit) ? $colab->credito_infonavit = $credito_infonavit : false;
                !is_null($descuento_mensual) ? $colab->descuento_mensual = $descuento_mensual : false;
                !is_null($sueldo_diario) ? $colab->sueldo_diario = $sueldo_diario : false;
                !is_null($sueldo_mensual) ? $colab->sueldo_mensual = $sueldo_mensual : false;
                !is_null($sucursal_id) ? $colab->sucursal_id = $sucursal_id : false;
                !is_null($tipo) ? $colab->tipo = $tipo : false;

                $colab->save();

                return $colab;
            }else{
                throw new \Exception('No se encontro el colaborador.');
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function delete($id){
        $this->colaborador->find($id)->delete();
    }

    public function getColaboradorById($id)
    {
        try {
            $colaborador = ColaboradorEntity::select('lorganization_colaborador.*', 'lorganization_puesto.nombrePuesto')
                ->leftjoin('lorganization_puesto', 'lorganization_colaborador.id_Puesto', 'lorganization_puesto.id')
                ->where('lorganization_colaborador.id', $id)->first();
            return $colaborador;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getColaboradorByRFC($rfc)
    {
        try {
            $colaborador = ColaboradorEntity::select('lorganization_colaborador.*', 'lorganization_puesto.nombrePuesto')
                ->leftjoin('lorganization_puesto', 'lorganization_colaborador.id_Puesto', 'lorganization_puesto.id')
                ->where('lorganization_colaborador.rfcColaborador', $rfc)->first();

            return $colaborador;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getColaboradorByCURP($curp)
    {
        try {
            $colaborador = ColaboradorEntity::select('lorganization_colaborador.*', 'lorganization_puesto.nombrePuesto')
                ->leftjoin('lorganization_puesto', 'lorganization_colaborador.id_Puesto', 'lorganization_puesto.id')
                ->where('lorganization_colaborador.curpColaborador', $curp)->first();

            return $colaborador;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getAllColaboradoresByPuestoId($idPuesto)
    {
        try {
            $colaborador = ColaboradorEntity::where('id_Puesto', $idPuesto)->get();

            return $colaborador;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getAllColaboradoresByPuestoSlug($slugPuesto)
    {
        try {
            $idPuesto = Puesto::getIdPuestoBySlug($slugPuesto);

            $colaborador = ColaboradorEntity::where('id_Puesto', $idPuesto)->get();

            return $colaborador;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getPluckColaborador(int $sucursal_id = null)
    {
        try {
            
            return $sucursal_id !== null ? ColaboradorEntity::where('sucursal_id',$sucursal_id)->get()->pluck('nombreCompleto', 'id') :ColaboradorEntity::get()->pluck('nombreCompleto', 'id');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getPluckCollaboratorNoConfig(){
        return ColaboradorEntity::doesntHave('departamento')
                ->doesntHave('configreporte')
                ->get()
                ->pluck('nombreCompleto','id');
    }

    public function existsCollaboratorByUser(int $user_id){
        $collaborator = ColaboradorEntity::where('id_Usuario',$user_id);
        return $collaborator->exists()  ? $collaborator->first() : false;
    }

    public function getCollaboratorById($id){
        return ColaboradorEntity::with([
            'puesto',
            'sucursal'
        ])->where('id',$id)->first();
    }


}
