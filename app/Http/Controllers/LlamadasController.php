<?php

namespace App\Http\Controllers;

use App\Http\Requests\LlamadaRequest;
use App\models\Llamadas;
use App\models\Prospectos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LlamadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LlamadaRequest $request)
    {
        $fecha_hora = Carbon::parse( $request->fecha_hora);
        $llamadas = new Llamadas();
        $llamadas->aunto = $request->aunto;
        $llamadas->fecha_hora = $fecha_hora;
        $llamadas->estatus = $request->estatus;
        $llamadas->prospectos_id = $request->prospectos_id;

        $llamadas->save();


        return response(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LlamadaRequest $request
     * @param Llamadas $llamada
     * @return \Illuminate\Http\Response
     */
    public function update(LlamadaRequest $request, Llamadas $llamada)
    {
        $fecha_hora = Carbon::parse( $request->fecha_hora);
        $llamada->aunto = $request->aunto;
        $llamada->fecha_hora = $fecha_hora;
        $llamada->estatus = $request->estatus;
        $llamada->prospectos_id = $request->prospectos_id;
        $llamada->save();

        return response(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Llamadas $llamada
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy( Llamadas $llamada)
    {
        $llamada->delete();
        return response(200);
    }

    public function registro($id)
    {
        $data['llamadas'] = Llamadas::where('prospectos_id',$id)->get();
        $data['pendientes'] = Llamadas::where('prospectos_id',$id)
            ->where('estatus',Llamadas::PENDIENTE)
            ->count();
        $data['realizados'] = Llamadas::where('prospectos_id',$id)
            ->where('estatus',Llamadas::REALIZADO)
            ->count();
        $data['no_realizados'] = Llamadas::where('prospectos_id',$id)
            ->where('estatus',Llamadas::NO_REALIZADO)
            ->count();
        $data['prospecto'] =Prospectos::find($id);
        return view('llamadas.index',$data);
    }
}
