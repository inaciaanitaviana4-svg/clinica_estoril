@extends("layouts.painel")
@section("titulo", "detalhes da consulta")
@section("conteudo")
    <section class="section active painel ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Detalhes da consulta</strong> </h2>
            <br><br>
            @if(session("erro"))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session("erro") }}
                </div>
            @endif

            <div>
                <!-- Informações do paciente -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações do paciente
                    </h2>
                    <div class="coluna-div"  >
                        <div class="row">
                            {{ label_detalhes($paciente, 'nome', 'Nome','col') }}
                            {{ label_detalhes($paciente, 'email', 'Email','col') }}
                            {{ label_detalhes($paciente, 'num_telefone', 'Telefone','col') }}
                        </div>
                        <div class="row">
                            {{ label_detalhes($paciente, 'num_bi', 'BI','col') }}
                            {{ label_detalhes($paciente, 'data_nascimento', 'Data de Nascimento','col') }}
                            {{ label_detalhes($paciente, 'estado_civil', 'Estado civil', 'col') }}
                        </div>
                        <div class="row">
                            {{ label_detalhes($paciente, 'seguro', 'Seguro','col') }}
                            {{ label_detalhes($paciente, 'bairro', 'Bairro','col') }}
                            {{ label_detalhes($paciente, 'cidade', 'Cidade','col') }}
                        </div>
                        {{ label_detalhes($paciente, 'morada', 'Morada' ) }}
                    </div>
                </div>
                <!-- Informações da consulta-->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações da consulta
                    </h2>

                </div>

                <!-- Informaçoes do medico -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações do médico
                    </h2>
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
@section("script")
    <script>
    </script>
@endsection