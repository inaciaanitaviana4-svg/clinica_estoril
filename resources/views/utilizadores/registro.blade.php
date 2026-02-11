@extends("layouts.admin")
@section("titulo", "Registro de usuário")
@section("conteudo")
    <section class="section active ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Registro de utilizador</strong> </h2>
            <br><br>
            @if(session("erro"))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session("erro") }}
                </div>
            @endif

            <form method="post" action="{{ route('salvar_registro_utilizador_admin', $utilizador->id_util ?? null) }}">
                {{ csrf_field() }}


                <!-- Informações Pessoais -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações Pessoais
                    </h2>

                    <div class="editar-perfil-grid">
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Tipo</label>
                            <select name="tipo" class="editar-perfil-select">
                                <option value="paciente" @selected($tipo_utilizador == 'paciente')>Paciente</option>
                                <option value="medico" @selected($tipo_utilizador == 'medico')>Médico</option>
                                <option value="recepcionista" @selected($tipo_utilizador == 'recepcionista')>
                                    Recepcionista</option>
                                <option value="administrador" @selected($tipo_utilizador == 'administrador')>
                                    Administrador</option>
                            </select>
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Nome Completo</label>
                            <input name="nome" type="text" class="editar-perfil-input" value="{{ $utilizador->nome ?? '' }}"
                                placeholder="Digite seu nome completo">
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Gênero</label>
                            <select name="genero" class="editar-perfil-select">
                                <option value="">Selecione...</option>
                                <option value="M" {{ $utilizador->genero ?? '' == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ $utilizador->genero ?? '' == 'F' ? 'selected' : '' }}>Feminino</option>
                            </select>
                        </div>
                        <div class="editar-perfil-field" data-input="data_nascimento">
                            <label class="editar-perfil-label editar-perfil-label--required">Data de Nascimento</label>
                            <input name="data_nascimento" type="date" class="editar-perfil-input"
                                value="{{ $dados["paciente"]->data_nascimento ?? '' }}">
                        </div>
                        <div class="editar-perfil-field" data-input="estado_civil">
                            <label class="editar-perfil-label">Estado Civil</label>
                            <select name="estado_civil" class="editar-perfil-select">
                                <option value="">Selecione...</option>
                                <option value="solteiro" @selected($dados["paciente"]->estado_civil ?? '' == 'solteiro')>
                                    Solteiro(a)</option>
                                <option value="casado" @selected($dados["paciente"]->estado_civil ?? '' == 'casado')>
                                    Casado(a)
                                </option>
                                <option value="divorciado" @selected($dados["paciente"]->estado_civil ?? '' == 'divorciado')>
                                    Divorciado(a)</option>
                                <option value="viuvo" @selected($dados["paciente"]->estado_civil ?? '' == 'viuvo')>
                                    Viúvo(a)
                                </option>
                            </select>
                        </div>
                        <div class="editar-perfil-field" data-input="num_bi">
                            <label class="editar-perfil-label editar-perfil-label--required">Número do BI</label>
                            <input name="num_bi" type="text" class="editar-perfil-input"
                                value="{{ $dados["paciente"]->num_bi ?? '' }}" placeholder="000000000LA000" max="14"
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
                                value="{{ $utilizador->email ?? '' }}" placeholder="seu.email@exemplo.com">
                            <span class="editar-perfil-helper-text">Este email será usado para login e notificações</span>
                        </div>
                        <div class="editar-perfil-field" data-input="num_telefone">
                            <label class="editar-perfil-label editar-perfil-label--required">Número de Telefone</label>
                            <input name="num_telefone" type="tel" class="editar-perfil-input"
                                value="{{ $utilizador->num_telefone ?? '' }}" placeholder=" 900000000" maxlength="9" minlength="9" >
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
                                placeholder="Rua, número, edifício, andar, apartamento...">{{ $dados["paciente"]->morada ?? $dados["admin"]->morada ?? $dados["recepcionista"]->morada ?? $dados["medico"]->morada ?? ''}}</textarea>
                        </div>
                        <div class="editar-perfil-field" data-input="cidade">
                            <label class="editar-perfil-label editar-perfil-label--required">Cidade</label>
                            <input name="cidade" type="text" class="editar-perfil-input"
                                value="{{ $dados["paciente"]->cidade ?? ''}}" placeholder="Digite a cidade">
                        </div>
                        <div class="editar-perfil-field" data-input="bairro">
                            <label class="editar-perfil-label editar-perfil-label--required">Bairro</label>
                            <input name="bairro" type="text" class="editar-perfil-input"
                                value="{{ $dados["paciente"]->bairro ?? '' }}" placeholder="Digite o bairro">
                        </div>
                        <div class="editar-perfil-field editar-perfil-field--full" data-input="seguro">
                            <label class="editar-perfil-label">Seguro</label>
                            <input name="seguro" type="text" class="editar-perfil-input"
                                value="{{ $dados["paciente"]->seguro ?? ''}}"
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

                <!-- Informações Profissionais -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações Profissionais
                    </h2>

                    <div class="editar-perfil-grid">
                        <div class="editar-perfil-field" data-input="especialidade">
                            <label class="editar-perfil-label editar-perfil-label--required">Especialidade</label>
                            <select name="especialidade" class="editar-perfil-select">
                                @foreach ($especialidades as $especialidade)
                                    <option value="{{ $especialidade->nome }}">{{ $especialidade->nome }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="editar-perfil-field" data-input="ano_experiencia">
                            <label class="editar-perfil-label editar-perfil-label--required">Anos de Experiência</label>
                            <input name="ano_experiencia" type="number" class="editar-perfil-input"
                                value="{{ $dados["medico"]->ano_experiencia ?? '' }}" placeholder="0" min="0" max="70">
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-full">
                        Guardar
                    </button>
                    <a href="{{ route('mostrar_cadastros_admin') }}" class="btn btn-danger btn-full "
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