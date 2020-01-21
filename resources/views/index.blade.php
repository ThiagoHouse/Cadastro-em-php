@extends('layout.app', ["current" => "home"])

@section('body')

<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de usuarios</h5>
                    <p class="card=text">
                        Aqui você cadastra todos os seus usuarios.
                        Só não se esqueça de cadastrar previamente as profissões
                    </p>
                    <a href="/usuarios" class="btn btn-primary">Cadastre seus usuarios</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de profissões</h5>
                    <p class="card=text">
                        Cadastre as profissões
                    </p>
                    <a href="/profissao" class="btn btn-primary">Cadastre suas profissao</a>
                </div>
            </div>            
        </div>
    </div>
</div>

@endsection