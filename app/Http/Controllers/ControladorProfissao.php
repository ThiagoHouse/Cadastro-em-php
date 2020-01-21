<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\profissaos;


class ControladorProfissao extends Controller
{
   
    public function index()
    {   
        $profs= profissaos::all();
        return view('profissao', compact('profs'));
    }

  

    public function create()
    {
        return view('novaprofissao');
    }

  
    public function store(Request $request)
    {
        $prof = new profissaos();
        $prof->nome= $request->input('nomeprofissao');
        $prof->save();
        return redirect('/profissao');
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        $prof= profissaos::find($id);
        if (isset($prof)){
            return view('editarprofissao', compact('prof'));
            }
            return redirect('/profissao');
    }

  
    public function update(Request $request, $id)
    {
        $prof= profissaos::find($id);
        if (isset($prof)){
            $prof->nome = $request->input('nomeprofissao');
            $prof->save();
            }
            return redirect('/profissao');
        }
   
    public function destroy($id)
    {
        $prof= profissaos::find($id);
        if (isset($prof)){
            $prof->delete();

        }
        return redirect('/profissao');
    }
    public function indexJson()
    {   
        $profs= profissaos::all();
        return json_encode($profs);
    }

}
