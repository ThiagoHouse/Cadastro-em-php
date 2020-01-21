@extends('layout.app', ["current" => "profissaos"])

@section('body')
    <div class="card border">
        <div class="card-body">
        <form action="/profissao/{{$prof->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nomeProfissao">Nome da Profissão</label>
                <input type="text" class="form-control" name="nomeprofissao" value="{{$prof->nome}}"
                    id="nomeprofissao" placeholder="Profissao">
                </div>
                <button type="submit" class="btn btn-primary bnt-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger bnt-sm">Cancelar</button>
            </form>
        </div>
    </div>
@endsection