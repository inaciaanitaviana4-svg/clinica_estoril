@extends('layouts.painel')
@section('titulo', 'Agendamentos')
@section('conteudo')
    <section id="medico" class="section active">

        <div id="prontuarios" class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Consultas</h2>
                    <a class="btn btn-primary" href="{{ route('mostrar_atendimento_recepcionista') }}">Agendar</a>
                </div>
                @if (session('erro'))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session('erro') }}
                    </div>
                @endif
               <form method="GET" action="{{ route('mostrar_consultas_recepcionista') }}">
                    <div class="form-group" style="display:flex;flex-direction:row;gap:8px;margin-top:20px">
                        <input name="pesquisar_consultas" value="{{ request('pesquisar_consultas') }}" type="text"
                            id="searchInput" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit" id="searchButton"><i
                                class="fa fa-search"></i></button>
                    </div>
                    @if (request('pesquisar_consultas'))
                        <a style="margin-bottom: 12px" href="{{ route('mostrar_consultas_recepcionista') }}"
                            class="btn btn-danger">Limpar pesquisa</a>
                    @endif
                </form>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Tipo de consulta</th>
                                <th>Modalidade</th>
                                <th>Serviço clinico</th>
                                <th>Preço</th>
                                <th>Paciente</th>
                                <th>Médico</th>
                                <th>Data da consulta</th>
                                <th>Hora da consulta</th>
                                <th>Data de Marcação</th>
                                <th>Estado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultas as $consulta)
                                <tr>
                                    <td>{{ $consulta->tipo_consulta }}</td>
                                    <td>{{ $consulta->modalidade }}</td>
                                    <td>{{ $consulta->nome_servico_clinico }}</td>
                                    <td>{{ $consulta->preco_servico_clinico }}</td>
                                    <td>{{ $consulta->nome_paciente }}</td>
                                    <td>{{ $consulta->nome_medico }}</td>
                                    <td>{{ $consulta->data }}</td>
                                    <td>{{ $consulta->hora }}</td>
                                    <td>{{ $consulta->data_marcacao->format('Y-m-d H:i') }}</td>
                                    <td>{{ badge_estados($consulta->estado) }}
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('detalhes_consulta_recepcionista', $consulta->id_consulta) }}"class="btn  btn-small"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 {{ $consultas->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
@endsection
