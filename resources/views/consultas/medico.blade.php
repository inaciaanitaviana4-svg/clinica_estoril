@extends("layouts.painel")
@section("titulo", "Consultas")
@section("conteudo")
    <section id="medico" class="section active painel">

        <div id="prontuarios" class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Consultas</h2>
                  <!--  <a class="btn btn-primary" href="/agendar-consulta-paciente">agendar Consulta</a>-->
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
                                <th>Tipo</th>
                                <th>Serviço clinico</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultas as $consulta)

                                <tr>
                                    <td>{{ $consulta->tipo_consulta }}</td>
                                    <td>{{ $consulta->nome_servico_clinico}}</td>
                                    <td>{{ $consulta->data }}</td>
                                    <td>{{ $consulta->hora }}</td>
                                    <td>
                                        <span style="
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
                                            @if($consulta->estado == "pendente" || $consulta->estado == "agendada")
                                                <form action="/cancelar-consulta-paciente/{{$consulta->id_consulta }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-bg-red btn-small">Cancelar</button>

                                                </form>
                                            @endif

                                              @if($consulta->estado == "agendada")
                                                <form action="/confirmar-consulta-paciente/{{$consulta->id_consulta }}"
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
            </div>
        </div>
    </section>
@endsection