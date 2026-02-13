@extends("layouts.painel")
@section("titulo", "Atendimento & Agendamento")
@section("conteudo")

    <section class="login-section">
        <div class="login-container">
            <!-- Seleção de Tipo de Usuário -->
            <div class="login-card" id="userTypeCard">
                <h2 style="text-align: center;"><strong>Atendimento/Agendamento</strong> </h2>
                <br><br>
                @if(session("erro"))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session("erro") }}
                    </div>
                @endif

                <form method="post" action="{{ route('salvar_atendimento_recepcionista') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col form-group">
                            <label for="modalidade">Modalidade</label>
                            <select class="w-100"id="modalidade" name="modalidade">
                                <option value="">Selecione a modalidade</option>
                                    <option value="imediata">Imediata</option>
                                    <option value="agendada">Agendada</option>
                                   
                              
                            </select>
                        </div>
                        <div class=" col form-group">
                            <label for="id_paciente">Paciente</label>
                            <select class="w-100" id="id_paciente" name="id_paciente">
                                <option value="">Selecione o paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id_paciente }}">{{ $paciente->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">


                        <div class="col form-group">
                            <label for="data">Data da consulta</label>
                            <input class="w-100" type="date" id="data" name="data" min="2025-01-01" max="2026-06-20">

                        </div>
                        <div class="col form-group">
                            <label for="hora">Horário Preferencial</label>
                            <select class="w-100" id="hora" name="hora">
                                <option value="">Selecione um horário</option>
                                @foreach ($horarios as $horario)
                                    <option value="{{ $horario->hora }}"> {{ $horario->hora }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="id_tipo_consulta">Tipo de consulta</label>
                            <select class="w-100" id="id_tipo_consulta" name="id_tipo_consulta">
                                <option value="">Selecione o tipo de consulta</option>
                                @foreach ($tipos_consultas as $tipo)
                                    <option value="{{ $tipo->id_tipo_consulta }}">{{ $tipo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="id_servico_clinico">Serviços clínicos</label>
                            <select class="w-100" id="id_servico_clinico" name="id_servico_clinico">
                                <option value="">Selecione o serviço clínico</option>
                                @foreach ($servicos_clinicos as $servico)
                                    <option value="{{ $servico->id_servico_clinico }}">{{ $servico->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class=" col form-group">
                        <label for="id_medico">Medico</label>
                        <select class="w-1" id="id_medico" name="id_medico">
                            <option value="">Selecione um medico</option>
                            @foreach ($medicos as $medico)
                                <option value="{{ $medico->id_medico }}">{{ $medico->nome }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="observacao">observação</label>
                        <textarea id="observacao" name="observacao" rows="5"
                            placeholder="Descreva brevemente o motivo da consulta ou dúvidas"></textarea>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary btn-full">
                            <i class="fas fa-paper-plane"></i>
                            Agendar
                        </button>

                        <p class="form-note">
                            Entraremos em contacto para confirmar o agendamento.
                        </p>
                    </div>
                </form>
            </div>
            <div class="login-help">
                <div class="help-card">
                    <i class="fas fa-question-circle"></i>
                    <h3>Precisa de Ajuda?</h3>
                    <p>Entre em contacto com o nosso suporte</p>
                    <a href="/contacto">Contactar Suporte</a>
                </div>
            </div>
    </section>
@endsection