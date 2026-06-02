@extends('layouts.painel')
@section('titulo', 'Pacientes')
@section('conteudo')
    <section id="medico" class="section active">

        <div id="prontuarios" class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Pacientes</h2>
                    <a class="btn btn-primary" href="{{ route('mostrar_cadastro_paciente_recepcionista') }}">Cadastrar</a>
                </div>
                @if (session('erro'))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session('erro') }}
                    </div>
                @endif
                  <form method="GET"
                    action="{{ route('mostrar_pacientes_recepcionista') }}">
                    <div class="form-group" style="display:flex;flex-direction:row;gap:8px;margin-top:20px">
                        <input name="pesquisar_pacientes" value="{{ request('pesquisar_pacientes') }}" type="text"
                            id="searchInput" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit" id="searchButton"><i
                                class="fa fa-search"></i></button>
                    </div>
                    @if (request('pesquisar_pacientes'))
                        <a style="margin-bottom: 12px"
                            href="{{ route('mostrar_pacientes_recepcionista') }}"
                            class="btn btn-danger">Limpar pesquisa</a>
                    @endif
                </form>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Género</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>BI</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td>{{ $paciente->id_paciente }}</td>
                                                                   
<td>
    <div style="display:flex; align-items:center; gap:10px;">
       
            <div style="width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#667eea,#764ba2);
                        display:flex; align-items:center; justify-content:center;
                        font-size:13px; font-weight:700; color:#fff; flex-shrink:0;
                        box-shadow:0 1px 3px rgba(0,0,0,.15);">
                {{ strtoupper(substr($paciente->nome, 0, 1)) }}
            </div>
       
        <span>{{ $paciente->nome }}</span>
    </div>
</td>
                                    <td>{{ $paciente->genero }}</td>
                                    <td>{{ $paciente->email }}</td>
                                    <td>{{ $paciente->num_telefone }}</td>
                                    <td>{{ $paciente->num_bi }}</td>
                                    <td>
                                        <a
                                            href="{{ route('detalhes_paciente_recepcionista', $paciente->id_paciente) }}"class="btn  btn-small"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 {{ $pacientes->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
@endsection