@extends('layout.app', ["current" => "usuarios" ])

@section('body')

<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Usuarios</h5>

        <table class="table table-ordered table-hover" id="tabelaUsuarios">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Profissão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
       
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novoUsuario()">Novo usuario</a>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgUsuarios">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <form class="form-horizontal" id="formUsuario">
                <div class="modal-header">
                    <h5 class="modal-title">Novo usuario</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="nomeUsuario" class="control-label">Nome do Usuario</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomeUsuario" placeholder="Nome do usuario">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="emailUsuario" class="control-label">Email</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="emailUsuario" placeholder="Email do usuario">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="profissaoUsuario" class="control-label">Profissão</label>
                        <div class="input-group">
                            <select class="form-control" id="profissaoUsuario" >
                            </select>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
     
     
     
@section('javascript')
<script type="text/javascript">
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    
    function novoUsuario() {
        $('#id').val('');
        $('#nomeUsuario').val('');
        $('#emailUsuario').val('');
        $('#dlgUsuarios').modal('show');
    }
    
    function carregarProfissao() {
        $.getJSON('/api/profissaos', function(data) { 
            for(i=0;i<data.length;i++) {
                opcao = '<option value ="' + data[i].id + '">' + 
                    data[i].nome + '</option>';
                $('#profissaoUsuario').append(opcao);
            }
        });
    }
    
    function montarLinha(p) {
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.nome + "</td>" +
            "<td>" + p.email + "</td>" +
            "<td>" + p.profissao_id + "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }
    
    function editar(id) {
        $.getJSON('/api/usuarios/'+id, function(data) { 
            console.log(data);
            $('#id').val(data.id);
            $('#nomeUsuario').val(data.nome);
            $('#emailUsuario').val(data.email);
            $('#profissaoUsuario').val(data.profissao_id);
            $('#dlgUsuarios').modal('show');            
        });        
    }
    
    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/usuarios/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaUsuarios>tbody>tr");
                e = linhas.filter( function(i, elemento) { 
                    return elemento.cells[0].textContent == id; 
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    
    function carregarUsuarios() {
        $.getJSON('/api/usuarios', function(usuarios) { 
            for(i=0;i<usuarios.length;i++) {
                linha = montarLinha(usuarios[i]);
                $('#tabelaUsuarios>tbody').append(linha);
            }
        });        
    }
    
    function criarUsuario() {
        usua = { 
            nome: $("#nomeUsuario").val(), 
            email: $("#emailUsuario").val(), 
            profissao_id: $("#profissaoUsuario").val() 
        };
        $.post("/api/usuarios", usua, function(data) {
            usuario = JSON.parse(data);
            linha = montarLinha(usuario);
            $('#tabelaUsuarios>tbody').append(linha);            
        });
    }
    
    function salvarUsuario() {
        usua = { 
            id : $("#id").val(), 
            nome: $("#nomeUsuario").val(), 
            email: $("#emailUsuario").val(), 
            profissao_id: $("#profissaoUsuario").val() 
        };
        $.ajax({
            type: "PUT",
            url: "/api/usuarios/" + usua.id,
            context: this,
            data: usua,
            success: function(data) {
                usua = JSON.parse(data);
                linhas = $("#tabelaUsuarios>tbody>tr");
                e = linhas.filter( function(i, e) { 
                    return ( e.cells[0].textContent == usua.id );
                });
                if (e) {
                    e[0].cells[0].textContent = usua.id;
                    e[0].cells[1].textContent = usua.nome;
                    e[0].cells[2].textContent = usua.email;
                    e[0].cells[4].textContent = usua.profissao_id;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });        
    }
    
    $("#formUsuario").submit( function(event){ 
        event.preventDefault(); 
        if ($("#id").val() != '')
            salvarUsuario();
        else
            criarUsuario();
            
        $("#dlgUsuarios").modal('hide');
    });
    
    $(function(){
        carregarProfissao();
        carregarUsuarios();
    })
    
</script>
@endsection
     
     