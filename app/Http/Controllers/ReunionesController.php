<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReunionRequest;
use App\models\Prospectos;
use App\models\Reuniones;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReunionesController extends Controller
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
    public function store(ReunionRequest $request)
    {
        $fecha_hora = Carbon::parse( $request->fecha_hora);
        $reunion = new Reuniones();
        $reunion->aunto = $request->aunto;
        $reunion->fecha_hora = $fecha_hora;
        $reunion->lugar = $request->lugar;
        $reunion->estatus = $request->estatus;
        $reunion->prospectos_id = $request->prospectos_id;
        $reunion->save();
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
     * @param ReunionRequest $request
     * @param Reuniones $reunion
     * @return \Illuminate\Http\Response
     */
    public function update(ReunionRequest $request, Reuniones $reunione)
    {
        $fecha_hora = Carbon::parse( $request->fecha_hora);
        $reunione->aunto = $request->aunto;
        $reunione->fecha_hora = $fecha_hora;
        $reunione->estatus = $request->estatus;
        $reunione->lugar = $request->lugar;
        $reunione->prospectos_id = $request->prospectos_id;
        $reunione->save();

        return response(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Reuniones $reunione)
    {
        $reunione->delete();
            return response(200);
    }

    public function registro($id)
    {
        $data['reuniones'] = Reuniones::where('prospectos_id',$id)->get();
        $data['pendientes'] = Reuniones::where('prospectos_id',$id)
            ->where('estatus',Reuniones::PENDIENTE)
            ->count();
        $data['realizados'] = Reuniones::where('prospectos_id',$id)
            ->where('estatus',Reuniones::REALIZADO)
            ->count();
        $data['no_realizados'] = Reuniones::where('prospectos_id',$id)
            ->where('estatus',Reuniones::NO_REALIZADO)
            ->count();
        $data['prospecto'] =Prospectos::find($id);
        return view('reuniones.index',$data);
    }
}
