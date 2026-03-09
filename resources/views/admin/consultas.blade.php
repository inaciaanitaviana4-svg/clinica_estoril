@extends("layouts.admin")
@section("titulo", "Consultas")
@section("conteudo")
    <section id="medico" class="section active">

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
                                <th>Paciente</th>
                                <th>Medico</th>
                                <th>Recepcionista</th>
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
                                    <td>{{ $consulta->nome_paciente}}</td>
                                    <td>{{ $consulta->nome_medico}}</td>
                                    <td>{{ $consulta->nome_recepcionista}}</td>
                                    <td>{{ $consulta->data }}</td>
                                    <td>{{ $consulta->hora }}</td>
                                    <td>
                                      {{ badge_estados($consulta->estado) }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                           <a  href="{{ route('detalhes_consulta_admin',$consulta->id_consulta) }}"class="btn  btn-small"><i class="fa-solid fa-eye"></i></a>
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