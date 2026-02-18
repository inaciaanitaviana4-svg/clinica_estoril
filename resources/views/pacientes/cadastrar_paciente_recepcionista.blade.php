@extends("layouts.painel")
@section("titulo", "Cadastro de Paciente")
@section("conteudo")
    <section class="section active painel">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Cadastro de Paciente</strong> </h2>
            <br><br>
            @if(session("erro"))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session("erro") }}
                </div>
            @endif

            <form method="post" action="{{ route('salvar_cadastro_paciente_recepcionista') }}">
                {{ csrf_field() }}


                <!-- Informações Pessoais -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações Pessoais
                    </h2>

                    <div class="editar-perfil-grid">
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Nome Completo</label>
                            <input name="nome" type="text" class="editar-perfil-input" 
                                placeholder="Digite seu nome completo">
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Gênero</label>
                            <select name="genero" class="editar-perfil-select">
                                <option value="">Selecione...</option>
                                <option value="M">Masculino</option>
                                <option value="F" >Feminino</option>
                            </select>
                        </div>
                        <div class="editar-perfil-field" data-input="data_nascimento">
                            <label class="editar-perfil-label editar-perfil-label--required">Data de Nascimento</label>
                            <input name="data_nascimento" type="date" class="editar-perfil-input"
                                value="">
                        </div>
                        <div class="editar-perfil-field" data-input="estado_civil">
                            <label class="editar-perfil-label">Estado Civil</label>
                            <select name="estado_civil" class="editar-perfil-select">
                                <option value="">Selecione...</option>
                                <option value="solteiro" >
                                    Solteiro(a)</option>
                                <option value="casado">
                                    Casado(a)
                                </option>
                                <option value="divorciado">
                                    Divorciado(a)</option>
                                <option value="viuvo">
                                    Viúvo(a)
                                </option>
                            </select>
                        </div>
                        <div class="editar-perfil-field" data-input="num_bi">
                            <label class="editar-perfil-label editar-perfil-label--required">Número do BI</label>
                            <input name="num_bi" type="text" class="editar-perfil-input"
                                value="" placeholder="000000000LA000" max="14"
                                min="14" >
                        </div>
                    </div>
                </div>

                <!-- Informações de Contato -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Contato
                    </h2>
                    <div class="editar-perfil-grid">
                        <div class="editar-perfil-field" data-input="email">
                            <label class="editar-perfil-label editar-perfil-label--required">Email</label>
                            <input name="email" type="email" class="editar-perfil-input"
                                value="" placeholder="seu.email@exemplo.com">
                            <span class="editar-perfil-helper-text">Este email será usado para login e notificações</span>
                        </div>
                        <div class="editar-perfil-field" data-input="num_telefone">
                            <label class="editar-perfil-label editar-perfil-label--required">Número de Telefone</label>
                            <input name="num_telefone" type="tel" class="editar-perfil-input"
                                value="" placeholder=" 900000000" maxlength="9" minlength="9" >
                        </div>
                    </div>
                </div>

                <!-- Endereço -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Endereço
                    </h2>
                    <div class="editar-perfil-grid">
                        <div class="editar-perfil-field editar-perfil-field--full" data-input="morada">
                            <label class="editar-perfil-label editar-perfil-label--required">Morada</label>
                            <textarea name="morada" class="editar-perfil-textarea"
                                placeholder="Rua, número, edifício, andar, apartamento..."></textarea>
                        </div>
                        <div class="editar-perfil-field" data-input="cidade">
                            <label class="editar-perfil-label editar-perfil-label--required">Cidade</label>
                            <input name="cidade" type="text" class="editar-perfil-input"
                                value="" placeholder="Digite a cidade">
                        </div>
                        <div class="editar-perfil-field" data-input="bairro">
                            <label class="editar-perfil-label editar-perfil-label--required">Bairro</label>
                            <input name="bairro" type="text" class="editar-perfil-input"
                                value="" placeholder="Digite o bairro">
                        </div>
                        <div class="editar-perfil-field editar-perfil-field--full" data-input="seguro">
                            <label class="editar-perfil-label">Seguro</label>
                            <input name="seguro" type="text" class="editar-perfil-input"
                                value=""
                                placeholder="Informações do seguro profissional">
                        </div>
                    </div>
                </div>
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações de Acesso
                    </h2>

                    <div class="editar-perfil-grid">
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Senha</label>
                            <input name="senha" type="password" class="editar-perfil-input" placeholder="Digite sua senha">
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-full">
                        Guardar
                    </button>
                    <a href="{{ route('mostrar_pacientes_recepcionista') }}" class="btn btn-danger btn-full "
                        style="margin-top: 8px;">Cancelar </a>
                </div>
            </form>
        </div>
    </section>
@endsection
@section("script")
    <script>

        const select_tipo = document.querySelector('[name="tipo"]')
        select_tipo.addEventListener("change", function () {
            const valor_selecionado = this.value
            mostrar_campos_por_tipo(valor_selecionado)
        })
        document.addEventListener("DOMContentLoaded", function () {
            const valor_selecionado = select_tipo.value
            mostrar_campos_por_tipo(valor_selecionado)
        })
        function mostrar_campos_por_tipo(valor_selecionado) {
            const data_nascimento = document.querySelector('[data-input="data_nascimento"]')
            const num_bi = document.querySelector('[data-input="num_bi"]')
            const estado_civil = document.querySelector('[data-input="estado_civil"]')
            const cidade = document.querySelector('[data-input="cidade"]')
            const bairro = document.querySelector('[data-input="bairro"]')
            const seguro = document.querySelector('[data-input="seguro"]')
            const especialidade = document.querySelector('[data-input="especialidade"]')
            const ano_experiencia = document.querySelector('[data-input="ano_experiencia"]')
            if (valor_selecionado == 'paciente') {
                data_nascimento.style.display = 'flex'
                num_bi.style.display = 'flex'
                estado_civil.style.display = 'flex'
                cidade.style.display = 'flex'
                bairro.style.display = 'flex'
                seguro.style.display = 'flex'
                especialidade.style.display = 'none'
                ano_experiencia.style.display = 'none'

            }
            if (valor_selecionado == 'recepcionista') {
                data_nascimento.style.display = 'none'
                num_bi.style.display = 'none'
                estado_civil.style.display = 'none'
                cidade.style.display = 'none'
                bairro.style.display = 'none'
                seguro.style.display = 'none'
                especialidade.style.display = 'none'
                ano_experiencia.style.display = 'none'
            }
            if (valor_selecionado == 'medico') {
                data_nascimento.style.display = 'none'
                num_bi.style.display = 'none'
                estado_civil.style.display = 'none'
                cidade.style.display = 'none'
                bairro.style.display = 'none'
                seguro.style.display = 'none'
                especialidade.style.display = 'flex'
                ano_experiencia.style.display = 'flex'
            }
            if (valor_selecionado == 'administrador') {
                data_nascimento.style.display = 'none'
                num_bi.style.display = 'none'
                estado_civil.style.display = 'none'
                cidade.style.display = 'none'
                bairro.style.display = 'none'
                seguro.style.display = 'none'
                especialidade.style.display = 'none'
                ano_experiencia.style.display = 'none'
            }
        }
    </script>
@endsection