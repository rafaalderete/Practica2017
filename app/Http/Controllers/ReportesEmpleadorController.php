<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB; 
use Carbon\Carbon;

class ReportesEmpleadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(true){

            $empresaId = Auth::user()->persona->juridica->id;

            //-------------------------------------------------------//

            $cantEstadosPostulados = DB::select('select count(*) postulados, epl.estado_postulacion
                                                    from estudiante_propuesta_laboral as epl join propuestas_laborales pl on epl.propuesta_laboral_id = pl.id
                                                    where pl.juridica_id = ?
                                                    group by estado_postulacion
                                                    order by postulados Desc',[$empresaId]);

            //-------------------------------------------------------//

            $cantPostSinDecidirPorProp = DB::select('select count(*) postulados_sin_decidir, pl.titulo
                                    from estudiante_propuesta_laboral as epl join propuestas_laborales pl on epl.propuesta_laboral_id = pl.id
                                    where epl.estado_postulacion = "en espera" and pl.juridica_id = ?
                                    group by titulo 
                                    order by postulados_sin_decidir Desc',[$empresaId]);

            $propConMayorEstSinDecidir;
            $i = 0;
            while ( ($i < 3) && ( $i < sizeof($cantPostSinDecidirPorProp))){
                    $cantPostSinDecidirPorProp[$i]->titulo = str_limit($cantPostSinDecidirPorProp[$i]->titulo, $limit = 20, $end = '...');
                    $propConMayorEstSinDecidir[$i] = $cantPostSinDecidirPorProp[$i];
                    $i++;
            }

            //-------------------------------------------------------//

            $SueldoPorCarrera = DB::select('select avg(cvs.sueldo_bruto_pretendido) promedio_sueldo, ca.nombre_carrera as carrera
                                            from cvs join estudiantes as es on cvs.estudiante_id = es.id join carreras as ca on es.carrera_id = ca.id
                                            where cvs.sueldo_bruto_pretendido > 0
                                            group by carrera
                                            order by promedio_sueldo desc');

            // LAS 5 CARRERAS CON MAYOR SUELDO
            $carrerasConMayorSueldoPretendido;
            $i = 0;
            while ( ($i < 5) && ( $i < sizeof($SueldoPorCarrera))){
                    $SueldoPorCarrera[$i]->carrera = str_limit($SueldoPorCarrera[$i]->carrera, $limit = 20, $end = '...');
                    $carrerasConMayorSueldoPretendido[$i] = $SueldoPorCarrera[$i];
                    $i++;
            }

            //-------------------------------------------------------//

            $cantidadEstudiantePorCarrera = DB::select('
                                                select count(*) as cantidad_estudiantes, c.nombre_carrera 
                                                from estudiantes as e join carreras as c on e.carrera_id = c.id 
                                                group by e.carrera_id
                                                order by cantidad_estudiantes Desc');

            // LAS 5 CARRERAS CON MAYOR CANTIDAD DE ESTUDIANTES
            $carrerasConMayorCantidadEstudiantes;
            $i = 0;
            while ( ($i <= 4) && ( $i < sizeof($cantidadEstudiantePorCarrera))){
                    $cantidadEstudiantePorCarrera[$i]->nombre_carrera = str_limit($cantidadEstudiantePorCarrera[$i]->nombre_carrera, $limit = 20, $end = '...');
                    $carrerasConMayorCantidadEstudiantes[$i] = $cantidadEstudiantePorCarrera[$i];
                    $i++;
            }

            //-----------------------------------------------------//

            // por defecto seria empresa, ultimo mes, vigentes

            $today = Carbon::today();
            $desde = $today->subMonth()->toDateString();
            $today = Carbon::today()->toDateString();

            $cantidadPropuestasPorFiltro = DB::select('select count(*) as cantidad_propuestas, ca.nombre_carrera as filtro
                                                    from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id join carreras as ca on rc.carrera_id = ca.id
                                                    where pl.juridica_id = ? and pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                    group by filtro
                                                    order by cantidad_propuestas Asc',[$empresaId,$desde,$today]);

            $cantidadPropuestas;
            $i = 0;
            while ( ($i <= 9) && ( $i < sizeof($cantidadPropuestasPorFiltro))){
                    $cantidadPropuestasPorFiltro[$i]->filtro = str_limit($cantidadPropuestasPorFiltro[$i]->filtro, $limit = 20, $end = '...');
                    $cantidadPropuestas[$i] = $cantidadPropuestasPorFiltro[$i];
                    $i++;
            }

            return view('in.reportes.empleador.index')
                    ->with('carrerasConMayorCantidadEstudiantes',$carrerasConMayorCantidadEstudiantes)
                    ->with('cantidadPropuestas',$cantidadPropuestas)
                    ->with('carrerasConMayorSueldoPretendido',$carrerasConMayorSueldoPretendido)
                    ->with('propConMayorEstSinDecidir',$propConMayorEstSinDecidir)
                    ->with('cantEstadosPostulados',$cantEstadosPostulados);

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    public function getDatosEstadistica(Request $request){

        $today = Carbon::today();
        if($request->tiempo == "ultimo_mes"){
            $desde = $today->subMonth()->toDateString();
        }else{
            if($request->tiempo == "ultimos_6_meses"){
                $desde = $today->subMonth(6)->toDateString();
            }else{
                if($request->tiempo =="ultimo_anio"){
                    $desde = $today->subYear()->toDateString();
                }else{
                    $desde = "0000-00-00"; //valor por defecto
                }
            }
        }

        $empresaId = Auth::user()->persona->juridica->id;
        
        if($request->filtro == "carrera"){
            if($request->estado == "vigente"){
                $cantidadPropuestasPorFiltro = DB::select('select count(*) as cantidad_propuestas, ca.nombre_carrera as filtro
                                                    from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id join carreras as ca on rc.carrera_id = ca.id
                                                    where pl.juridica_id = ? and pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                    group by filtro
                                                    order by cantidad_propuestas Asc',[$empresaId,$desde,$today]);

            }else{
                $cantidadPropuestasPorFiltro = DB::select('select count(*) as cantidad_propuestas, ca.nombre_carrera as filtro
                                                    from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id join carreras as ca on rc.carrera_id = ca.id
                                                    where pl.juridica_id = ? and pl.fecha_inicio_propuesta >= ?
                                                    group by filtro
                                                    order by cantidad_propuestas Asc',[$empresaId,$desde]);

            }
        }else{
            if($request->filtro == "idioma"){
                if($request->estado == "vigente"){
                    $cantidadPropuestasPorFiltro = DB::select('
                                                    select count(*) as cantidad_propuestas, i.nombre_idioma as filtro
                                                    from propuestas_laborales as pl join (select distinct propuesta_laboral_id, idioma_id 
                                                  from requisitos_idioma) as ri on pl.id = ri.propuesta_laboral_id join idiomas as i on ri.idioma_id = i.id
                                                    where pl.juridica_id = ? and pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                    group by filtro
                                                    order by cantidad_propuestas Asc',[$empresaId,$desde,$today]);

                }else{
                    $cantidadPropuestasPorFiltro = DB::select('
                                                    select count(*) as cantidad_propuestas, i.nombre_idioma as filtro
                                                    from propuestas_laborales as pl join (select distinct propuesta_laboral_id, idioma_id 
                                                  from requisitos_idioma) as ri on pl.id = ri.propuesta_laboral_id join idiomas as i on ri.idioma_id = i.id
                                                    where pl.juridica_id = ? and pl.fecha_inicio_propuesta >= ?
                                                    group by filtro
                                                    order by cantidad_propuestas Asc',[$empresaId,$desde]);

                }
            }else{
                if($request->filtro == "tipo_trabajo"){
                    if($request->estado == "vigente"){
                        $cantidadPropuestasPorFiltro = DB::select('
                                                    select count(*) as cantidad_propuestas, tt.nombre_tipo_trabajo as filtro
                                                    from propuestas_laborales as pl join tipos_trabajo as tt on pl.tipo_trabajo_id = tt.id
                                                    where pl.juridica_id = ? and pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                    group by filtro
                                                    order by cantidad_propuestas Asc',[$empresaId,$desde,$today]);

                    }else{
                        $cantidadPropuestasPorFiltro = DB::select('
                                                    select count(*) as cantidad_propuestas, tt.nombre_tipo_trabajo as filtro
                                                    from propuestas_laborales as pl join tipos_trabajo as tt on pl.tipo_trabajo_id = tt.id
                                                    where pl.juridica_id = ? and pl.fecha_inicio_propuesta >= ? 
                                                    group by filtro
                                                    order by cantidad_propuestas Asc',[$empresaId,$desde]);
                    }
                }else{
                    if($request->filtro == "tipo_jornada"){
                        if($request->estado == "vigente"){
                            $cantidadPropuestasPorFiltro = DB::select('
                                                    select count(*) as cantidad_propuestas, tj.nombre_tipo_jornada filtro
                                                    from propuestas_laborales as pl join tipos_jornada as tj on pl.tipo_jornada_id = tj.id
                                                    where pl.juridica_id = ? and pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                    group by filtro
                                                    order by cantidad_propuestas Asc',[$empresaId,$desde,$today]);

                        }else{
                            $cantidadPropuestasPorFiltro = DB::select('
                                                    select count(*) as cantidad_propuestas, tj.nombre_tipo_jornada filtro
                                                    from propuestas_laborales as pl join tipos_jornada as tj on pl.tipo_jornada_id = tj.id
                                                    where pl.juridica_id = ? and pl.fecha_inicio_propuesta >= ?
                                                    group by filtro
                                                    order by cantidad_propuestas Asc',[$empresaId,$desde]);

                        }
                    }
                }
            }
        }


        $cantidadPropuestas;
        $i = 0;
        while ( ($i <= 9) && ( $i < sizeof($cantidadPropuestasPorFiltro))){
                $cantidadPropuestasPorFiltro[$i]->filtro = str_limit($cantidadPropuestasPorFiltro[$i]->filtro, $limit = 20, $end = '...');
                $cantidadPropuestas[$i] = $cantidadPropuestasPorFiltro[$i];
                $i++;
        }


        return response()->json([
        'cantidadPropuestas' => $cantidadPropuestas
      ]);
    }

}
