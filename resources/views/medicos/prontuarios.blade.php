@extends("layouts.painel")
@section("titulo", "Prontuarios")
@section("conteudo")
    <section id="medico" class="section active painel">

        <div id="prontuarios" class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Prontuarios</h2>
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
                                    <td>  {{ date('Y') - date('Y', strtotime($paciente->data_nascimento)) }} ano(s)</td>
                                    <td>{{ $paciente->genero }}</td>
                                    <td>{{ $paciente->num_telefone }}</td>
                                    <td>{{ $paciente->email }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('mostrar_detalhes_prontuario_medico', $paciente->id_paciente) }}" class="btn btn-primary"><i class="fa-solid fa-stethoscope"></i></a>           
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