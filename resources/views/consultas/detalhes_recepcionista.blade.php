@extends('layouts.painel')
@section('titulo', 'detalhes da consulta')
@section('conteudo')
    <section class="section active painel ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Detalhes da consulta</strong> </h2>
            <br><br>
            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif

            <div>
                <!-- Informações do paciente -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações do paciente
                    </h2>
                    <div class="coluna-div">
                        <div class="row">
                            {{ label_detalhes($paciente, 'nome', 'Nome', 'col') }}
                            {{ label_detalhes($paciente, 'email', 'Email', 'col') }}
                            {{ label_detalhes($paciente, 'num_telefone', 'Telefone', 'col') }}
                        </div>
                        <div class="row">
                            {{ label_detalhes($paciente, 'num_bi', 'BI', 'col') }}
                            {{ label_detalhes($paciente, 'data_nascimento', 'Data de Nascimento', 'col') }}
                            {{ label_detalhes($paciente, 'estado_civil', 'Estado civil', 'col') }}
                        </div>
                        <div class="row">
                            {{ label_detalhes($paciente, 'seguro', 'Seguro', 'col') }}
                            {{ label_detalhes($paciente, 'bairro', 'Bairro', 'col') }}
                            {{ label_detalhes($paciente, 'cidade', 'Cidade', 'col') }}
                        </div>
                        {{ label_detalhes($paciente, 'morada', 'Morada') }}
                    </div>
                </div>
                <!-- Informações da consulta-->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações da consulta
                    </h2>
                    <div class="coluna-div">
                        <div class="row">
                            {{ label_detalhes($consulta, 'nome_tipo_consulta', 'Tipo de consulta', 'col') }}
                            {{ label_detalhes($consulta, 'nome_servico_clinico', 'Serviço clínico', 'col') }}
                            {{ label_detalhes($consulta, 'preco_servico_clinico', 'Preço do serviço clínico', 'col') }}
                            {{ label_detalhes($consulta, 'nome_recepcionista', 'Recepcionista', 'col') }}
                        </div>
                        <div class="row">
                            {{ label_detalhes($consulta, 'modalidade', 'Modalidade', 'col') }}
                            {{ label_detalhes($consulta, 'data', 'Data', 'col') }}
                            {{ label_detalhes($consulta, 'hora', 'Hora', 'col') }}
                            {{ label_detalhes($consulta, 'estado', 'Estado', 'col') }}
                        </div>
                        {{ label_detalhes($consulta, 'observacao', 'Observação') }}
                    </div>
                </div>

                <!-- Informaçoes do medico -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações do médico
                    </h2>
                    <div class="coluna-div">
                        @if ($medico)
                            <div class="row">
                                {{ label_detalhes($medico, 'nome', 'Nome', 'col') }}
                                {{ label_detalhes($medico, 'email', 'Email', 'col') }}
                                {{ label_detalhes($medico, 'num_telefone', 'Telefone', 'col') }}
                                {{ label_detalhes($medico, 'especialidade', 'Especialidade', 'col') }}
                            </div>
                            <form class=""
                                action="{{ route('desassociar_medico_consulta_recepcionista', $consulta->id_consulta) }}"
                                method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Desassociar médico</button>
                            </form>
                        @else
                            <form class="row"
                                action="{{ route('associar_medico_consulta_recepcionista', $consulta->id_consulta) }}"
                                method="POST">
                                {{ csrf_field() }}
                                <div class="w-100 form-group">
                                    <label for="id_medico">Medico</label>
                                    <select class="w-100" id="id_medico" name="id_medico">
                                        <option value="">Selecione um medico</option>
                                        @foreach ($medicos as $medico)
                                            <option value="{{ $medico->id_medico }}">{{ $medico->nome }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Associar médico</button>
                            </form>
                        @endif
                    </div>
                </div>


                <!-- Informações de pagamentos -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações de pagamento
                    </h2>

                </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script></script>
@endsection
