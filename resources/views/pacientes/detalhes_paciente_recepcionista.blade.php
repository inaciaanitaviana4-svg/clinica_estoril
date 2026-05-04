@extends('layouts.painel')
@section('titulo', 'Detalhes do Paciente')
@section('conteudo')
    <section class="section active">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align:center;"><strong>Detalhes do Paciente</strong></h2>
            <br>

            @if(session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif

            {{-- Busca o utilizador associado a este paciente --}}
            @php
                $utilizadorPaciente = \App\Models\Utilizador::where('id_paciente', $paciente->id_paciente)->first();
            @endphp

            <div>
                <!-- Foto e nome no topo -->
                <div style="display:flex; flex-direction:column; align-items:center; margin-bottom:28px;">
                    @if($utilizadorPaciente && $utilizadorPaciente->foto)
                        <img src="{{ asset('storage/' . $utilizadorPaciente->foto) }}"
                             alt="Foto de {{ $paciente->nome }}"
                             style="width:110px; height:110px; border-radius:50%;
                                    object-fit:cover; border:3px solid #e2e8f0;
                                    box-shadow:0 2px 8px rgba(0,0,0,0.10);
                                    margin-bottom:12px;">
                    @else
                        <div style="width:110px; height:110px; border-radius:50%;
                                    background:#e8f0fe; display:flex; align-items:center;
                                    justify-content:center; border:3px solid #e2e8f0;
                                    margin-bottom:12px;">
                            <i class="fa-solid fa-circle-user"
                               style="font-size:60px; color:#0066cc;"></i>
                        </div>
                    @endif
                    <span style="font-size:18px; font-weight:600; color:#2d3748;">
                        {{ $paciente->nome }}
                    </span>
                </div>

                <!-- Informações Pessoais -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        Informações Pessoais
                    </h2>
                    <div class="coluna-div">
                        <div class="row">
                            {{ label_detalhes($paciente, 'nome', 'Nome', 'col') }}
                        </div>
                        <div class="row">
                            {{ label_detalhes($paciente, 'genero', 'Género', 'col') }}
                            {{ label_detalhes($paciente, 'data_nascimento', 'Data de Nascimento', 'col') }}
                            {{ label_detalhes($paciente, 'num_bi', 'Número do BI', 'col') }}
                            {{ label_detalhes($paciente, 'estado_civil', 'Estado Civil', 'col') }}
                            {{ label_detalhes($paciente, 'seguro', 'Seguro', 'col') }}
                        </div>
                    </div>
                </div>

                <!-- Informações de Contacto -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        Informações de Contacto
                    </h2>
                    <div class="coluna-div">
                        <div class="row">
                            {{ label_detalhes($paciente, 'num_telefone', 'Telefone', 'col') }}
                            {{ label_detalhes($paciente, 'email', 'Email', 'col') }}
                        </div>
                    </div>
                </div>

                <!-- Informações de Endereço -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        Informações de Endereço
                    </h2>
                    <div class="coluna-div">
                        <div class="row">
                            {{ label_detalhes($paciente, 'cidade', 'Província', 'col') }}
                            {{ label_detalhes($paciente, 'bairro', 'Bairro', 'col') }}
                            {{ label_detalhes($paciente, 'morada', 'Rua/Morada', 'col') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script></script>
@endsection