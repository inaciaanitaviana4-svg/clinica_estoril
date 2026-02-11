@extends("layouts.admin")
@section("titulo", "Cadastros")
@section("conteudo")
    <section class="section active ">
        <div class="tabs">
            <a class="tab active" href="#">Utilizadores</a>
            <a class="tab" href="#">Especialidades</a>

        </div>
        <!-- listagem de utilizadores-->
        <div class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Utilizadores</h2>
                    <a class="btn btn-primary" href="/admin/cadastros/utilizadores/registro">Cadastrar</a>
                </div>
                @if(session("erro"))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session("erro") }}
                    </div>
                @endif

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Gênero</th>
                                <th>Nivel de acesso</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($utilizadores as $utilizador)

                                <tr>
                                    <td>{{ $utilizador->nome }}</td>
                                    <td>{{ $utilizador->email }}</td>
                                    <td>{{ $utilizador->num_telefone }}</td>
                                    <td>{{ $utilizador->genero }}</td>
                                    @if($utilizador->nivel_acesso == 0)
                                        <td>Administrador</td>
                                    @elseif($utilizador->nivel_acesso == 1)
                                        <td>Recepcionista</td>
                                    @elseif($utilizador->nivel_acesso == 2)
                                        <td>Médico</td>
                                    @elseif($utilizador->nivel_acesso == 3)
                                        <td>Paciente</td>
                                    @endif
                                    <td>

                                        <div class="btn-group">

                                            <button onclick="mostrarRemoverItemModal('{{route('remover_utilizador_admin',$utilizador->id_util)}}')" class="btn btn-bg-red btn-small">Remover</button>
                                            <a href="/admin/cadastros/utilizadores/registro/{{$utilizador->id_util }}"
                                                class="btn btn-primary btn-small">Editar</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- listagem de Especialidades-->
        <div class="tab-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Especialidades</h2>
                    <a class="btn btn-primary" href="/admin/cadastros/especialidades/registro">Adicionar</a>
                </div>


                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Activo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($especialidades as $especialidade)

                                <tr>
                                    <td>{{ $especialidade->nome }}</td>
                                    <td>{{ $especialidade->descricao }}</td>
                                    <td>{{ $especialidade->activo ? "Sim" : "Não"}}</td>

                                    <td>
                                        <div class="btn-group">

                                            <button onclick="mostrarRemoverItemModal('{{route('remover_especialidade_admin',$especialidade->id_espec)}}')" class="btn btn-bg-red btn-small">Remover</button>

                                            <a href="{{ route('mostrar_registro_especialidade_admin', $especialidade->id_espec) }}"
                                                class="btn btn-primary btn-small">Editar</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
@section("script")
    <script src="/tabs.js"></script>
@endsection