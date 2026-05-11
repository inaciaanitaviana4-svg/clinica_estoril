@extends('layouts.painel')
@section('titulo', 'Consultas paciente')
@section('conteudo')
    <section id="medico" class="section active">

        <div id="prontuarios" class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Consultas</h2>
                    <a class="btn btn-primary" href="/agendar-consulta-paciente">agendar Consulta</a>
                </div>
                @if (session('erro'))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session('erro') }}
                    </div>
                @endif
                <form method="GET" action="{{ route('mostrar_consultas_paciente') }}">
                    <div class="form-group" style="display:flex;flex-direction:row;gap:8px;margin-top:20px">
                        <input name="pesquisar_consultas" value="{{ request('pesquisar_consultas') }}" type="text"
                            id="searchInput" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit" id="searchButton"><i
                                class="fa fa-search"></i></button>
                    </div>
                    @if (request('pesquisar_consultas'))
                        <a style="margin-bottom: 12px"
                            href="{{ route('mostrar_consultas_paciente') }}"
                            class="btn btn-danger">Limpar pesquisa</a>
                    @endif
                </form>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Modalidade</th>
                                <th>Tipo</th>
                                <th>Serviço clinico</th>
                                <th>Preço</th>
                                <th>Médico</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Data de Marcação</th>
                                <th>Estado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultas as $consulta)
                                <tr>
                                    <td>{{ $consulta->modalidade }}</td>
                                    <td>{{ $consulta->tipo_consulta }}</td>
                                    <td>{{ $consulta->nome_servico_clinico }}</td>
                                    <td>{{ $consulta->preco_servico_clinico }}</td>
                                    <td>{{ $consulta->nome_medico ?? 'ainda não definido' }}</td>
                                    <td>{{ $consulta->data }}</td>
                                    <td>{{ $consulta->hora }}</td>
                                    <td>{{ $consulta->data_marcacao->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <span
                                            style="
                                            padding: 4px 8px;
                                            border-radius: 6px;
                                            color: #fff;
                                            font-size: 13px;
                                            background-color:
                                            @switch($consulta->estado)
                                                @case('pendente') #F59E0B @break
                                                @case('agendada') #3B82F6 @break
                                                @case('confirmada') #22C55E @break
                                                @case('cancelada') #EF4444 @break
                                                @case('concluida') #6B7280 @break
                                            @endswitch
                                        ">
                                            {{ ucfirst($consulta->estado) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if ($consulta->estado == 'pendente' || $consulta->estado == 'agendada')
                                                <form action="/cancelar-consulta-paciente/{{ $consulta->id_consulta }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-bg-red btn-small">Cancelar</button>

                                                </form>
                                            @endif

                                            @if ($consulta->estado == 'agendada')
                                                <form action="/confirmar-consulta-paciente/{{ $consulta->id_consulta }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-primary btn-small">confirmar</button>

                                                </form>
                                            @endif
                                        </div>
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
