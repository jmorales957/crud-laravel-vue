<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProspectoRequest;
use App\models\Prospectos;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ProspectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['prospectos'] = Prospectos::all();
        return view('prospectos.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prospectos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProspectoRequest $request)
    {
        try {
            $prospectos = $request->all();
            Prospectos::create($prospectos);

            return response(200);
        }
        catch (Exception $error) {
            return response(400)->json($error);
        }

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProspectoRequest $request,Prospectos $prospecto)
    {
        $prospecto->update($request->all());

        return response(200)->json($prospecto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prospectos $prospecto)
    {
        $prospecto->delete();
        return response(200);
    }
}
