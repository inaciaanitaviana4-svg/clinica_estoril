@extends('layouts.admin')
@section('titulo', 'Prontuarios')
@section('conteudo')
    <section id="medico" class="section active">

        <div id="prontuarios" class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Prontuarios</h2>
                    <!--  <a class="btn btn-primary" href="/agendar-consulta-paciente">agendar Consulta</a>-->
                </div>
                @if (session('erro'))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session('erro') }}
                    </div>
                @endif
                <form method="GET" action="{{ route('mostrar_prontuarios_medico_admin') }}">
                    <div class="form-group" style="display:flex;flex-direction:row;gap:8px;margin-top:20px">
                        <input name="pesquisar_prontuarios" value="{{ request('pesquisar_prontuarios') }}" type="text"
                            id="searchInput" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit" id="searchButton"><i
                                class="fa fa-search"></i></button>
                    </div>
                    @if (request('pesquisar_prontuarios'))
                        <a style="margin-bottom: 12px" href="{{ route('mostrar_prontuarios_medico_admin') }}"
                            class="btn btn-danger">Limpar pesquisa</a>
                    @endif
                </form>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Idade</th>
                                <th>Gênero</th>
                                <th>Telefone</th>
                                <th>Email</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td>{{ $paciente->nome }}</td>
                                    <td> {{ date('Y') - date('Y', strtotime($paciente->data_nascimento)) }} ano(s)</td>
                                    <td>{{ $paciente->genero }}</td>
                                    <td>{{ $paciente->num_telefone }}</td>
                                    <td>{{ $paciente->email }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('mostrar_detalhes_prontuario_admin', $paciente->id_paciente) }}"
                                                class="btn btn-primary"><i class="fa-solid fa-stethoscope"></i></a>
                                        </div>
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
