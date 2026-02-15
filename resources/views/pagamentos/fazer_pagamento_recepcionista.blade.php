@extends('layouts.painel')
@section('titulo', 'fazer pagamento')
@section('conteudo')

    <section class="login-section">
        <div class="login-container">
            <!-- Seleção de Tipo de Usuário -->
            <div class="login-card" id="userTypeCard">
                <h2 style="text-align: center;"><strong>fazer pagamento</strong> </h2>
                <br><br>
                @if (session('erro'))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session('erro') }}
                    </div>
                @endif

                <form method="post" action="{{ route('salvar_atendimento_recepcionista') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="w-100 form-group">
                            <label for="id_paciente">Paciente</label>
                            <select class="w-100" id="id_paciente" name="id_paciente">
                                <option value="">Selecione o paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id_paciente }}">{{ $paciente->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="data">Data</label>
                                <input class="w-100" type="date" id="data" name="data" min="2025-01-01"
                                    max="2026-06-20">
                            </div>
                        </div>
                        <div class="col form-group">
                            <label for="id_consulta">Consulta</label>
                            <select class="w-100" id="id_consulta" name="id_consulta">
                                <option value="">Selecione a consulta</option>
                                @foreach ($consultas as $consulta)
                                    <option value="{{ $consulta->id_consulta }}">{{ $consulta->tipo_consulta }} -
                                        {{ $consulta->nome_paciente }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="id_metodo_pagamento">Método de Pagamento</label>
                            <select class="w-100" id="id_metodo_pagamento" name="id_metodo_pagamento">
                                <option value="">Selecione o método de pagamento</option>
                                @foreach ($metodos_pagamentos as $metodo)
                                    <option value="{{ $metodo->id_metodo_pagamento }}">{{ $metodo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="valor_pago">Valor pago</label>
                            <input class="w-100" type="number" id="valor_pago" name="valor_pago" step="0.01"
                                placeholder="0,00" min="0">
                        </div>
                    </div>
                    <h2 class="perfil-section-title">
                        Itens do Pagamento
                    </h2>
                    <div>
                        <button type="submit" class="btn btn-primary btn-full">
                            Registrar Pagamento
                        </button>
                    </div>
                </form>
            </div>
    </section>
@endsection
