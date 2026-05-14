@extends('layouts.painel')
@section('titulo', 'Prontuário paciente')
@section('conteudo')
    <section id="medico" class="section active">

        <div id="prontuarios" class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Consultas</h2>
                </div>
                @if (session('erro'))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session('erro') }}
                    </div>
                @endif
                <form method="GET" action="{{ route('mostrar_prontuario_paciente') }}">
                    <div class="form-group" style="display:flex;flex-direction:row;gap:8px;margin-top:20px">
                        <input name="pesquisar_consultas" value="{{ request('pesquisar_consultas') }}" type="text"
                            id="searchInput" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit" id="searchButton"><i
                                class="fa fa-search"></i></button>
                    </div>
                    @if (request('pesquisar_consultas'))
                        <a style="margin-bottom: 12px"
                            href="{{ route('mostrar_prontuario_paciente') }}"
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
                                                @case('agendada')  #6B7280 @break
                                                @case('confirmada') #3B82F6 @break
                                                @case('cancelada') #EF4444 @break
                                                @case('concluida')  #22C55E @break
                                            @endswitch
                                        ">
                                            {{ ucfirst($consulta->estado) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('mostrar_detalhes_consulta_paciente', ['id_consulta' => $consulta->id_consulta]) }}"
                                            class="btn btn-primary"><i class="fa-solid fa-stethoscope"></i></a>
      
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