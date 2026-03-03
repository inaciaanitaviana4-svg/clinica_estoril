@extends('layouts.painel')
@section('titulo', 'Horários')
@section('conteudo')
    <section id="medico" class="section active painel">

        <div id="horarios" class="tab-content active">
            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Registro de Horários</h2>
                </div>
                <form action="{{ route('salvar_horarios_medico') }}" style="margin-top: 12px" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_horario" name="id_horario"/>
                    <div class="form-group">
                        <label for="dia_semana">
                            Dia da semana
                        </label>
                        <select name="dia_semana" id="dia_semana">
                            <option value="1">Segunda-Feira</option>
                            <option value="2">Terça-Feira</option>
                            <option value="3">Quarta-Feira</option>
                            <option value="4">Quinta-Feira</option>
                            <option value="5">Sexta-Feira</option>
                            <option value="6">Sábado</option>
                            <option value="7">Domingo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hora">
                            Horário
                        </label>
                        <input req value="" type="text" id="hora" name="hora" required
                            placeholder="digite o horário (ex: 08:00)">
                    </div>
                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" name="activo" id="activo">
                            <span>Activo</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">
                        Guardar
                    </button>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Horários do Médico</h2>
                </div>


                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Dia da Semana</th>
                                <th>Hora</th>
                                <th>Activo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horarios as $horario)
                                <tr>
                                    <td>{{ dia_semana($horario->dia_semana) }}</td>
                                    <td>{{ $horario->hora }}</td>
                                    <td>{{ $horario->activo ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        <div class="btn-group">

                                            <button onclick="remover_horario({{ $horario->id_horario }})"
                                                class="btn btn-bg-red btn-small">Remover</button>

                                            <button onclick="editar_horario({{ $horario }})"
                                                class="btn btn-primary btn-small">Editar</button>
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
@section('script')
    <script>
        function editar_horario(dados) {
            console.log(dados)
          const id_horario=document.getElementById('id_horario')
          const dia_semana=document.getElementById('dia_semana')
          const hora=document.getElementById('hora')
          const activo=document.getElementById('activo')
          id_horario.value=dados.id_horario
          dia_semana.value=dados.dia_semana
          hora.value=dados.hora
          activo.checked=dados.activo
        }
        const url = "{{ route('remover_horario_medico', ['id_horario' => ':id']) }}"
      const csrfToken = "{{ csrf_token() }}";
      function remover_horario(id_horario) {
        
          mostrarRemoverItemModal(
              url.replace(':id', id_horario), {
                  method: 'DELETE',
                  headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                }
            )
        }
    </script>
@endsection
