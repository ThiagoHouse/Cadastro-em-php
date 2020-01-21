@extends('layout.app', ["current" => "profissao"])


@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Profissão</h5>
    @if(count($profs)>0)
            <table class="table table-ordered table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome da Profissão</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
    @foreach ($profs as $prof)
                    <tr>
                        <td>{{$prof->id}}</td>
                        <td>{{$prof->nome}}</td>
                        <td>
                            <a href="/profissao/editar/{{$prof->id}}" class="btn btn-primary btn-sm">Editar</a>
                            <a href="/profissao/apagar/{{$prof->id}}" class="btn btn-danger btn-sm">Apagar</a>
                        </td>
                    </tr>

         
    @endforeach
                </tbody>
            </table>
    @endif
    </div>
        <div class="card-footer">
            <a href="/profissao/novo" class="btn btn-primary btn-sm" role="button">Nova Profissão</a> 
    </div>
    
@endsection


