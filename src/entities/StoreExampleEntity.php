<?php

namespace leonardo_organization\entities;

use App\Users;
use DateInterval;
use DatePeriod;
use DateTime;
use Hrm_TyA\BitacoraReloj\BitacoraRelojEntity;
use Hrm_TyA\CambioHorario\CambioHorario;
use Hrm_TyA\ConfigReporte\ConfigReporteEntity;
use Hrm_TyA\Reporte\ReporteEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use leonardo_HRM\Calificaciones\calificacionEntity;
use leonardo_HRM\CursosParaPuestos\cursosParaPuestosEntity;
use leonardo_HRM\DocumentosPersonal\documentosPersonalEntity;
use leonardo_HRM\Instructor\instructorEntity;
use leonardo_HRM\Percepciones\percepcionesEntity;

class ColaboradorEntity extends Model{
    
    protected $table = 'lorganization_colaborador';
    protected static $nameTable = 'lorganization_colaborador';
    protected static $correo = 'correoColaborador';
    protected $fillable = [
        'nombreColaborador',
        'apellidoMatColaborador',
        'apellidoPatColaborador',
        'fechaNacimientoColaborador',
        'telefonoColaborador',
        'correoColaborador',
        'rfcColaborador',
        'curpColaborador',
        'nssColaborador',
        'id_Puesto',
        'estado_civil',
        'fecha_ingreso',
        'clabe_interbancaria',
        'ciudad',
        'estado_nacimiento',
        'credito_infonavit',
        'descuento_mensual',
        'sueldo_diario',
        'sueldo_mensual',
        'sucursal_id',
        'tipo'
    ];

    use SoftDeletes;

    protected $appends = ["nombreCompleto","checo","imparcial","noChecks"];

    public function getChecoAttribute(){
        date_default_timezone_set('America/Mazatlan');

        $checo = 0;
        
        $checks = $this->bitacora()->where('fecha_dia','<=',date('Y-m-d'))
                ->where('tipo_evento_id','=', 1)
                ->groupBy('fecha_dia','colaborador_id',)
                ->select(DB::raw('SUM(activo) as checo'))
                ->get();
                
        foreach ($checks as $check) {
            if($check->checo === "0"){
                $checo++;
            }
        }

        return $checo;
    }

    public function getImparcialAttribute(){
        date_default_timezone_set('America/Mazatlan');

        $imparcial = 0;
        
        $checks = $this->bitacora()->where('fecha_dia','<=',date('Y-m-d'))
                ->where('tipo_evento_id','=', 1)
                ->groupBy('fecha_dia','colaborador_id',)
                ->select(DB::raw('SUM(activo) as imparcial'))
                ->get();
                
        foreach ($checks as $check) {
            if($check->imparcial === "1"){
                $imparcial++;
            }
        }

        return $imparcial;
    }

    public function getNoChecksAttribute(){
        date_default_timezone_set('America/Mazatlan');
        $period = new DatePeriod( new DateTime($this->fecha_ingreso), new DateInterval('P1D'), new DateTime(date('Y-m-d')));
        $dbData = [];
        $noChecks=0;
        $range = [];

        foreach($period as $date){
            $range[$date->format("Y-m-d")] = 0;
        }

        $data = $this->bitacora()
                    ->select(DB::raw('DATE(fecha_dia) as time'), DB::raw('count(*) as count'))
                    ->where('colaborador_id',4)
                    ->where('tipo_evento_id','=', 1)
                    ->whereDate('fecha_dia','<=',date('Y-m-d'))
                    ->groupBy('time','colaborador_id')
                    ->get();

        foreach($data as $val){
            $dbData[$val->time] = $val->count;
        }
        
        $data = array_replace($range, $dbData);
        
        foreach ($data as $key) {
            if($key === 0){
                $noChecks++;
            }
        }
        
        return $noChecks;
    }


    public static function getTableName(){
        return self::$nameTable;
    }

    public static function getCorreo(){
        return self::$correo;
    }

    public function getNombreCompletoAttribute(){
        return $this->nombreColaborador . " " . $this->apellidoMatColaborador . " " . $this->apellidoPatColaborador;
    }

    public function sucursal(){
        return $this->belongsTo(SucursalEntity::class, 'sucursal_id');
    }

    public function puesto(){
        return $this->belongsTo(PuestoEntity::class, 'id_Puesto');
    }
    
    public function cursospuestos(){
        return $this->hasMany(cursosParaPuestosEntity::class, 'id_Puesto');
    }

    public function documentosPersonal(){
        return $this->hasMany(documentosPersonalEntity::class, 'colaborador_id');
    }

    public function usuario(){
        return $this->belongsTo(Users::class, 'id_Usuario');
    }
    
    public function percepciones(){
        return $this->hasMany(percepcionesEntity::class,'colaborador_id');
    }

    public function bitacora(){
        return $this->hasMany(BitacoraRelojEntity::class, 'colaborador_id');
    }

    public function cambiohorario(){
        return $this->belongsToMany(CambioHorario::class,'Hrm_TyA_cambio_horario', 'aprobado_por_id');
    }

    public function reporte(){
        return $this->belongsToMany(ReporteEntity::class,'Hrm_TyA_reporte', 'colaborador_id');
    }

    public function reportereviso(){
        return $this->belongsToMany(ReporteEntity::class,'Hrm_TyA_reporte', 'colaborador_reviso_id');
    }

    public function instructor(){
        return $this->belongsToMany(instructorEntity::class,'Hrm_instructor', 'colaborador_id');
    }

    public function calificacion(){
        return $this->hasMany(calificacionEntity::class, 'colaborador_id');
    }

    public function configreporte(){
        return $this->morphOne(ConfigReporteEntity::class,'registro');
    }

    public function departamento(){
        return $this->hasOne(DepartamentoEntity::class,'idEncargado');
    }

    
}