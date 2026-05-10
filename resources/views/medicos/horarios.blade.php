@extends('layouts.painel')
@section('titulo', 'Horários')
@section('conteudo')
    <section id="medico" class="section active">

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
                    <input type="hidden" id="id_horario" name="id_horario" />
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
                        <select name="hora" id="hora" required>
                            <option value="07:00">07:00</option>
                            <option value="07:30">07:30</option>
                            <option value="08:00">08:00</option>
                            <option value="08:30">08:30</option>
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                            <option value="18:00">18:00</option>
                            <option value="18:30">18:30</option>
                            <option value="19:00">19:00</option>
                            <option value="19:30">19:30</option>
                            <option value="20:00">20:00</option>
                            <option value="20:30">20:30</option>
                            <option value="21:00">21:00</option>
                            <option value="21:30">21:30</option>
                            <option value="22:00">22:00</option>
                            <option value="22:30">22:30</option>
                            <option value="23:00">23:00</option>
                            <option value="23:30">23:30</option>
                        </select>
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
            const id_horario = document.getElementById('id_horario')
            const dia_semana = document.getElementById('dia_semana')
            const hora = document.getElementById('hora')
            const activo = document.getElementById('activo')
            id_horario.value = dados.id_horario
            dia_semana.value = dados.dia_semana
            hora.value = dados.hora
            activo.checked = dados.activo
        }
    </script>
@endsection
