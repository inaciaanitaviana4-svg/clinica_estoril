@extends(Session::get('tipo_utilizador')=="admi"?"layouts.admin":"layouts.painel")
@section("titulo", "Perfil")
@section("conteudo")
    <section class="section active {{ Session::get('tipo_utilizador')=="admi"?"":"painel" }}">
        <div class="editar-perfil-container">
            <!-- Header -->
            <div class="editar-perfil-header">
                <div class="editar-perfil-header-content">
                    <div class="editar-perfil-header-text">
                        <h1>Editar Perfil</h1>
                        <p>Atualize suas informações pessoais e profissionais</p>
                    </div>
                </div>
            </div>

            <!-- Formulário -->
            <form action="/editar-perfil" method="POST" class="editar-perfil-form">
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
                            <input name="nome" type="text" class="editar-perfil-input" value="{{ $utilizador->nome }}"
                                placeholder="Digite seu nome completo">
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Gênero</label>
                            <select name="genero" class="editar-perfil-select">
                                <option value="">Selecione...</option>
                                <option value="M" {{ $utilizador->genero == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ $utilizador->genero == 'F' ? 'selected' : '' }}>Feminino</option>
                            </select>
                        </div>
                        @if($dados["paciente"])
                            <div class="editar-perfil-field">
                                <label class="editar-perfil-label editar-perfil-label--required">Data de Nascimento</label>
                                <input name="data_nascimento" type="date" class="editar-perfil-input"
                                    value="{{ $dados["paciente"]->data_nascimento }}">
                            </div>
                            <div class="editar-perfil-field">
                                <label class="editar-perfil-label">Estado Civil</label>
                                <select name="estado_civil" class="editar-perfil-select">
                                    <option value="">Selecione...</option>
                                    <option value="solteiro" {{ $dados["paciente"]->estado_civil == 'solteiro' ? 'selected' : '' }}>
                                        Solteiro(a)</option>
                                    <option value="casado" {{ $dados["paciente"]->estado_civil == 'casado' ? 'selected' : '' }}>
                                        Casado(a)
                                    </option>
                                    <option value="divorciado" {{ $dados["paciente"]->estado_civil == 'divorciado' ? 'selected' : '' }}>
                                        Divorciado(a)</option>
                                    <option value="viuvo" {{ $dados["paciente"]->estado_civil == 'viuvo' ? 'selected' : '' }}>
                                        Viúvo(a)
                                    </option>
                                </select>
                            </div>
                            <div class="editar-perfil-field">
                                <label class="editar-perfil-label editar-perfil-label--required">Número do BI</label>
                                <input name="num_bi" type="text" class="editar-perfil-input"
                                    value="{{ $dados["paciente"]->num_bi }}" placeholder="000000000LA000">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Informações de Contato -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Contato
                    </h2>
                    <div class="editar-perfil-grid">
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Email</label>
                            <input name="email" type="email" class="editar-perfil-input" value="{{ $utilizador->email }}"
                                placeholder="seu.email@exemplo.com">
                            <span class="editar-perfil-helper-text">Este email será usado para login e notificações</span>
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Número de Telefone</label>
                            <input name="num_telefone" type="tel" class="editar-perfil-input"
                                value="{{ $utilizador->num_telefone }}" placeholder="+244 900 000 000">
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
                        <div class="editar-perfil-field editar-perfil-field--full">
                            <label class="editar-perfil-label editar-perfil-label--required">Morada</label>
                            <textarea name="morada" class="editar-perfil-textarea"
                                placeholder="Rua, número, edifício, andar, apartamento...">{{ $dados["paciente"]->morada??$dados["admin"]->morada??$dados["recepcionista"]->morada??$dados["medico"]->morada }}</textarea>
                        </div>
                        @if($dados["paciente"])
                            <div class="editar-perfil-field">
                                <label class="editar-perfil-label editar-perfil-label--required">Cidade</label>
                                <input name="cidade" type="text" class="editar-perfil-input"
                                    value="{{ $dados["paciente"]->cidade }}" placeholder="Digite a cidade">
                            </div>
                            <div class="editar-perfil-field">
                                <label class="editar-perfil-label editar-perfil-label--required">Bairro</label>
                                <input name="bairro" type="text" class="editar-perfil-input"
                                    value="{{ $dados["paciente"]->bairro }}" placeholder="Digite o bairro">
                            </div>
                            <div class="editar-perfil-field editar-perfil-field--full">
                                <label class="editar-perfil-label">Seguro</label>
                                <input name="seguro" type="text" class="editar-perfil-input"
                                    value="{{ $dados["paciente"]->seguro }}" placeholder="Informações do seguro profissional">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Informações Profissionais -->
                @if(!$dados["paciente"])
                    <div class="editar-perfil-section">
                        <h2 class="editar-perfil-section-title">
                            <span class="editar-perfil-section-icon"></span>
                            Informações Profissionais
                        </h2>
                        <div class="editar-perfil-grid">
                            @if($dados["medico"])
                                <div class="editar-perfil-field">
                                    <label class="editar-perfil-label editar-perfil-label--required">Especialidade</label>
                                    <input name="especialidade" type="text" class="editar-perfil-input"
                                        value="{{ $dados["medico"]->especialidade }}" placeholder="Digite sua especialidade">
                                </div>
                                <div class="editar-perfil-field">
                                    <label class="editar-perfil-label editar-perfil-label--required">Anos de Experiência</label>
                                    <input name="ano_experiencia" type="number" class="editar-perfil-input"
                                        value="{{ $dados["medico"]->ano_experiencia }}" placeholder="0" min="0" max="70">
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <!-- Botões de Ação -->
                <div class="editar-perfil-actions">
                    <a href="/visualizar-perfil" class="editar-perfil-btn editar-perfil-btn-cancel">Cancelar</a>
                    <button type="submit" class="editar-perfil-btn editar-perfil-btn-save">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </section>
@endsection