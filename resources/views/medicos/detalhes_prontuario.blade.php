@extends('layouts.painel')
@section('titulo', 'detalhes do prontuario')
@section('conteudo')
    <section class="section active painel ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Detalhes do prontuário</strong> </h2>
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
                    <div class="row mt-4">
                        <form class="col"
                            action="{{ route('mudar_estado_consulta_recepcionista', $consulta->id_consulta) }}"
                            method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="estado" value="cancelada">
                            <button  type="submit" class="btn btn-danger">Cancelar consulta</button>
                        </form>
                        <form class="col"
                            action="{{ route('mudar_estado_consulta_recepcionista', $consulta->id_consulta) }}"
                            method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="estado" value="agendada">
                            <button style="background-color: #6366f1" type="submit" class="btn btn-success">Agendar consulta</button>
                        </form>
                        <form class="col"
                            action="{{ route('mudar_estado_consulta_recepcionista', $consulta->id_consulta) }}"
                            method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="estado" value="confirmada">
                            <button style="background-color: #3b82f6" type="submit" class="btn btn-success">Confirmar consulta</button>

                        </form>
                        <form class="col"
                            action="{{ route('mudar_estado_consulta_recepcionista', $consulta->id_consulta) }}"
                            method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="estado" value="em_espera">
                            <button style="background-color:#6b7280" type="submit" class="btn btn-success">Colocar em espera</button>

                        </form>

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
                    <form class=""
                        action="{{ route('fazer_pagamento_consulta_recepcionista', $consulta->id_consulta) }}"
                        method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col form-group">
                                <label for="id_servico_clinico">Serviços clínicos</label>
                                <select class="w-100" id="id_servico_clinico" name="id_servico_clinico">
                                    <option value="">Selecione o serviço clínico</option>
                                    @foreach ($servicos_clinicos as $servico)
                                        <option value="{{ $servico->id_servico_clinico }}">{{ $servico->nome }} ->
                                            {{ number_format($servico->preco, 2, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col form-group">
                                <label for="id_metodo_pagamento">Método de pagamento</label>
                                <select class="w-100" id="id_metodo_pagamento" name="id_metodo_pagamento">
                                    <option value="">Selecione um método de pagamento</option>
                                    @foreach ($metodos_pagamento as $metodo)
                                        <option value="{{ $metodo->id_metodo_pagamento }}">{{ $metodo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col form-group">
                                <label for="valor_pago">Valor pago</label>
                                <input type="number" id="valor_pago" name="valor_pago" min="0" step="0.01">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Fazer pagamento</button>
                        </div>
                    </form>

                    <div class="table-responsive-sm mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Serviço clínico</th>
                                    <th scope="col">Método de pagamento</th>
                                    <th scope="col">Valor pago</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pagamentos as $pagamento)
                                    <tr>
                                        <th scope="row">{{ $pagamento->id_pagamento }}</th>
                                        <td>{{ $pagamento->nome_servico_clinico }}</td>
                                        <td>{{ $pagamento->nome_metodo_pagamento }}</td>
                                        <td>{{ number_format($pagamento->total_pago, 2, ',', '.') }}</td>
                                        <td>{{ $pagamento->estado }}</td>
                                        <td>
                                            <a href="{{ route('cancelar_pagamento_consulta_recepcionista', $pagamento->id_pagamento) }}"
                                                class="btn btn-sm btn-outline-danger">Cancelar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="row" colspan="4"></th>
                                    <th scope="row" colspan="">Total pago:</th>
                                    <th scope="row" colspan="">Saldo total:</th>
                                </tr>
                                <tr>
                                    <td scope="row" colspan="4"></td>
                                    <td scope="row">{{ number_format($resumo['total_pago'], 2, ',', '.') }}</td>
                                    <td scope="row">{{ number_format($resumo['saldo_total'], 2, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script></script>
@endsection
