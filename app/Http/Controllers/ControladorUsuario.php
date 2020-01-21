<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\usuarios;

class ControladorUsuario extends Controller
{
    public function indexView()
    {
        return view('usuario');
    }
    
    public function index()
    {
        $usua = usuarios::all();
        return $usua->toJson();
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
    public function store(Request $request)
    {
        $usua = new usuarios();
        $usua->nome = $request->input('nome');
        $usua->email = $request->input('email');
        $usua->profissao_id = $request->input('profissao_id');
        $usua->save();
        return json_encode($usua);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usua = usuarios::find($id);
        if (isset($usua)) {
            return json_encode($usua);            
        }
        return response('Usuario não encontrado', 404);
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
    public function update(Request $request, $id)
    {
        $usua = usuarios::find($id);
        if (isset($usua)) {
            $usua->nome = $request->input('nome');
            $usua->email = $request->input('email');
            $usua->profissao_id = $request->input('profissao_id');
            $usua->save();
            return json_encode($usua);
        }
        return response('Usuario não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usua = usuarios::find($id);
        if (isset($usua)) {
            $usua->delete();
            return response('OK', 200);
        }
        return response('Produto não encontrado', 404);
    }
}

?>