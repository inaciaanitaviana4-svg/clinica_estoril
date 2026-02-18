@extends('layouts.painel')
@section('titulo', 'detalhes do paciente')
@section('conteudo')
    <section class="section active painel ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Detalhes do paciente</strong> </h2>
            <br><br>
            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif

            <div>
                <!-- Informações do paciente -->
                <div class="editar-perfil-section">
                    <div class="coluna-div">
                        <div class="row">

                            {{ label_detalhes($paciente, 'nome', 'nome', 'col') }}
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
                <!-- Informações de contacto -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        Informações de contacto
                    </h2>
                    <div class="coluna-div">
                        <div class="row">
                            {{ label_detalhes($paciente, 'num_telefone', 'Telefone', 'col') }}
                            {{ label_detalhes($paciente, 'email', 'Email', 'col') }}
                        </div>
                    </div>
                </div>
                <!-- Informações de endereço -->
                     <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        Informações de endereço
                    </h2>
                    <div class="coluna-div">
                        <div class="row">
                            {{ label_detalhes($paciente, 'cidade', 'Cidade', 'col') }}
                            {{ label_detalhes($paciente, 'bairro', 'Bairro', 'col') }}
                            {{ label_detalhes($paciente, 'morada', 'Morada', 'col') }}
                        </div>
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
