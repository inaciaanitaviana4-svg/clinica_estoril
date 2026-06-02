@extends(Session::get('tipo_utilizador') == 'admi' ? 'layouts.admin' : 'layouts.painel')
@section('titulo', 'Configurações')
@section('conteudo')
<section>
<div class="editar-perfil-container">

    {{-- ======= ECRÃ INICIAL: Seleção de opção ======= --}}
    <div id="tela-selecao">
        <div class="editar-perfil-header">
            <div class="editar-perfil-header-content">
                <div class="editar-perfil-header-text">
                    <h1>Configurações da Conta</h1>
                    <p>O que deseja fazer?</p>
                </div>
            </div>
        </div>

        <div style="display:flex; gap:24px; justify-content:center; flex-wrap:wrap; padding:40px 20px;">

            {{-- Card 1: Editar Informações --}}
            <div onclick="mostrarTela('tela-info')" style="
                cursor:pointer; width:260px; padding:36px 28px;
                border:2px solid #e2e8f0; border-radius:16px;
                background:#fff; text-align:center;
                transition:all 0.2s; box-shadow:0 2px 8px rgba(0,0,0,0.06);"
                onmouseover="this.style.borderColor='#0066cc';this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 24px rgba(0,102,204,0.15)';"
                onmouseout="this.style.borderColor='#e2e8f0';this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)';">
                <div style="width:64px;height:64px;background:#e8f0fe;border-radius:50%;
                            display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fa-solid fa-user-pen" style="font-size:28px;color:#0066cc;"></i>
                </div>
                <h3 style="margin:0 0 8px;font-size:17px;color:#1a202c;">Editar Informações</h3>
                <p style="margin:0;font-size:13px;color:#718096;line-height:1.5;">
                    Atualize nome, email, telefone, foto e demais dados pessoais
                </p>
            </div>

            {{-- Card 2: Alterar Senha --}}
            <div onclick="mostrarTela('tela-senha')" style="
                cursor:pointer; width:260px; padding:36px 28px;
                border:2px solid #e2e8f0; border-radius:16px;
                background:#fff; text-align:center;
                transition:all 0.2s; box-shadow:0 2px 8px rgba(0,0,0,0.06);"
                onmouseover="this.style.borderColor='#0066cc';this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 24px rgba(0,102,204,0.15)';"
                onmouseout="this.style.borderColor='#e2e8f0';this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)';">
                <div style="width:64px;height:64px;background:#fff0f0;border-radius:50%;
                            display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fa-solid fa-lock" style="font-size:28px;color:#e53e3e;"></i>
                </div>
                <h3 style="margin:0 0 8px;font-size:17px;color:#1a202c;">Alterar Palavra-passe</h3>
                <p style="margin:0;font-size:13px;color:#718096;line-height:1.5;">
                    Confirme a palavra-passe atual e defina uma nova
                </p>
            </div>

        </div>

        <div style="text-align:center; padding-bottom:32px;">
            <a href="/visualizar-perfil" style="color:#718096;font-size:14px;text-decoration:none;">
                ← Voltar ao perfil
            </a>
        </div>
    </div>


    {{-- ======= ECRÃ 1: Editar Informações Pessoais ======= --}}
    <div id="tela-info" style="display:none;">

        <div class="editar-perfil-header">
            <div class="editar-perfil-header-content">
                <div class="editar-perfil-header-text">
                    <h1>Editar Informações</h1>
                    <p>Atualize suas informações pessoais e profissionais</p>
                </div>
            </div>
        </div>

        <form action="/editar-perfil" id="formulario-info" method="POST"
              class="editar-perfil-form" enctype="multipart/form-data">
            {{ csrf_field() }}

            {{-- Foto de perfil --}}
            <div style="display:flex;flex-direction:column;align-items:center;margin-bottom:20px;">
                <label for="foto" id="foto-label" style="
                    position:relative;width:120px;height:120px;border-radius:50%;
                    cursor:pointer;overflow:hidden;border:3px solid #cbd5e0;
                    background:#f7fafc;display:flex;align-items:center;
                    justify-content:center;transition:all 0.2s;
                    box-shadow:0 2px 4px rgba(0,0,0,0.1);"
                    onmouseover="this.style.borderColor='#0066cc';this.style.transform='scale(1.02)';"
                    onmouseout="this.style.borderColor='#cbd5e0';this.style.transform='scale(1)';">

                    @if(isset($utilizador) && $utilizador->foto)
                        <img id="foto-preview" src="{{ asset('storage/' . $utilizador->foto) }}"
                             alt="Foto" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        <i id="foto-icon" class="fa-solid fa-circle-user"
                           style="display:none;font-size:64px;color:#a0aec0;"></i>
                    @else
                        <img id="foto-preview" src="" alt="Foto"
                             style="display:none;width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        <i id="foto-icon" class="fa-solid fa-circle-user"
                           style="font-size:64px;color:#a0aec0;"></i>
                    @endif

                    <div style="position:absolute;inset:0;background:rgba(0,0,0,0.4);border-radius:50%;
                                display:flex;align-items:center;justify-content:center;
                                opacity:0;transition:opacity 0.2s;pointer-events:none;">
                        <i class="fa-solid fa-camera" style="color:white;font-size:24px;"></i>
                    </div>
                </label>
                <input type="file" id="foto" name="foto" accept="image/*" style="display:none">
                <span style="margin-top:8px;font-size:12px;color:#718096;">Clique na foto para alterar</span>
            </div>

            {{-- Informações Pessoais --}}
            <div class="editar-perfil-section">
                <h2 class="editar-perfil-section-title">
                    <span class="editar-perfil-section-icon"></span>Informações Pessoais
                </h2>
                <div class="editar-perfil-grid">
                    <div class="editar-perfil-field">
                        <label class="editar-perfil-label editar-perfil-label--required">Nome Completo</label>
                        <input name="nome" id="nome" type="text" class="editar-perfil-input"
                               value="{{ $utilizador->nome }}" placeholder="Digite seu nome completo">
                        <small id="erro-nome" class="erro"></small>
                    </div>
                    <div class="editar-perfil-field">
                        <label class="editar-perfil-label editar-perfil-label--required">Gênero</label>
                        <select name="genero" class="editar-perfil-select">
                            <option value="">Selecione...</option>
                            <option value="M" {{ $utilizador->genero == 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ $utilizador->genero == 'F' ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>
                    @if ($dados['paciente'])
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Data de Nascimento</label>
                            <input name="data_nascimento" id="data_nascimento" type="date" class="editar-perfil-input"
                                   value="{{ $dados['paciente']->data_nascimento }}">
                            <small id="erro-data" class="erro"></small>
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label">Estado Civil</label>
                            <select name="estado_civil" class="editar-perfil-select">
                                <option value="">Selecione...</option>
                                <option value="solteiro" {{ $dados['paciente']->estado_civil == 'solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                                <option value="casado"   {{ $dados['paciente']->estado_civil == 'casado'   ? 'selected' : '' }}>Casado(a)</option>
                                <option value="divorciado" {{ $dados['paciente']->estado_civil == 'divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                                <option value="viuvo"    {{ $dados['paciente']->estado_civil == 'viuvo'    ? 'selected' : '' }}>Viúvo(a)</option>
                            </select>
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Número do BI</label>
                            <input name="num_bi" id="num_bi" type="text" class="editar-perfil-input"
                                   value="{{ $dados['paciente']->num_bi }}" placeholder="000000000LA000">
                            <small id="erro-bi" class="erro"></small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Contato --}}
            <div class="editar-perfil-section">
                <h2 class="editar-perfil-section-title">
                    <span class="editar-perfil-section-icon"></span>Contato
                </h2>
                <div class="editar-perfil-grid">
                    <div class="editar-perfil-field">
                        <label class="editar-perfil-label editar-perfil-label--required">Email</label>
                        <input name="email" id="email" type="email" class="editar-perfil-input"
                               value="{{ $utilizador->email }}" placeholder="seu.email@exemplo.com">
                        <small id="erro-email" class="erro"></small>
                        <span class="editar-perfil-helper-text">Usado para login e notificações</span>
                    </div>
                    <div class="editar-perfil-field">
                        <label class="editar-perfil-label editar-perfil-label--required">Número de Telefone</label>
                        <input name="num_telefone" id="num_telefone" type="tel" class="editar-perfil-input"
                               value="{{ $utilizador->num_telefone }}" placeholder="+244 900 000 000">
                        <small id="erro-tel" class="erro"></small>
                    </div>
                </div>
            </div>

            {{-- Endereço --}}
            <div class="editar-perfil-section">
                <h2 class="editar-perfil-section-title">
                    <span class="editar-perfil-section-icon"></span>Endereço
                </h2>
                <div class="editar-perfil-grid">
                    <div class="editar-perfil-field editar-perfil-field--full">
                        <label class="editar-perfil-label editar-perfil-label--required">Rua/Morada</label>
                        <textarea name="morada" class="editar-perfil-textarea"
                                  placeholder="Rua, número, edifício...">{{ $dados['paciente']->morada ?? ($dados['admin']->morada ?? ($dados['recepcionista']->morada ?? $dados['medico']->morada)) }}</textarea>
                    </div>
                    @if ($dados['paciente'])
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Província</label>
                            <select id="cidade" name="cidade" class="editar-perfil-select">
                                @foreach(['Bengo','Benguela','Bié','Cabinda','Cuando','Cubando','Cuanza Norte','Cuanza Sul','Cunene','Huambo','Icolo Bengo','Luanda','Lunda Norte','Lunda Sul','Malanje','Moxico','Moxico Leste','Namibe','Uíge','Zaire'] as $prov)
                                    <option value="{{ $prov }}" {{ $dados['paciente']->cidade == $prov ? 'selected' : '' }}>{{ $prov }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Bairro</label>
                            <input name="bairro" type="text" class="editar-perfil-input"
                                   value="{{ $dados['paciente']->bairro }}" placeholder="Digite o bairro">
                        </div>
                        <div class="editar-perfil-field editar-perfil-field--full">
                            <label class="editar-perfil-label">Seguro</label>
                            <input name="seguro" type="text" class="editar-perfil-input"
                                   value="{{ $dados['paciente']->seguro }}" placeholder="Informações do seguro">
                        </div>
                    @endif
                </div>
            </div>

            {{-- Informações Profissionais (médico) --}}
            @if (!$dados['paciente'] && $dados['medico'])
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>Informações Profissionais
                    </h2>
                    <div class="editar-perfil-grid">
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Especialidade</label>
                            <input name="especialidade" type="text" class="editar-perfil-input"
                                   value="{{ $dados['medico']->especialidade }}" placeholder="Especialidade">
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Anos de Experiência</label>
                            <input name="ano_experiencia" type="number" class="editar-perfil-input"
                                   value="{{ $dados['medico']->ano_experiencia }}" min="0" max="70">
                        </div>
                    </div>
                </div>
            @endif

            <div class="editar-perfil-actions">
                <button type="button" onclick="voltarSelecao()"
                        class="editar-perfil-btn editar-perfil-btn-cancel">← Voltar</button>
                <button type="submit" class="editar-perfil-btn editar-perfil-btn-save">Salvar Alterações</button>
            </div>
        </form>
    </div>


    {{-- ======= ECRÃ 2: Alterar Palavra-passe ======= --}}
    <div id="tela-senha" style="display:none;">

        <div class="editar-perfil-header">
            <div class="editar-perfil-header-content">
                <div class="editar-perfil-header-text">
                    <h1>Alterar Palavra-passe</h1>
                    <p>Confirme a passe atual e defina uma nova</p>
                </div>
            </div>
        </div>

        <form action="/alterar-senha" id="formulario-senha" method="POST" class="editar-perfil-form">
            {{ csrf_field() }}

            <div class="editar-perfil-section">
                <h2 class="editar-perfil-section-title">
                    <span class="editar-perfil-section-icon"></span>Segurança
                </h2>
                <div class="editar-perfil-grid">

                    {{-- Senha atual --}}
                    <div class="editar-perfil-field editar-perfil-field--full">
                        <label class="editar-perfil-label editar-perfil-label--required">Palavra-passe Atual</label>
                        <div style="position:relative;">
                            <input name="senha_atual" id="senha_atual" type="password"
                                   class="editar-perfil-input" placeholder="Digite a passe atual" maxlength="10"
                                   style="padding-right:44px;">
                            <button type="button" onclick="toggleSenha('senha_atual','olho-atual')"
                                    style="position:absolute;right:12px;top:50%;transform:translateY(-50%);
                                           background:none;border:none;cursor:pointer;color:#718096;">
                                <i id="olho-atual" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <small id="erro-senha-atual" class="erro"></small>
                    </div>

                    {{-- Nova senha --}}
                    <div class="editar-perfil-field">
                        <label class="editar-perfil-label editar-perfil-label--required">Nova Palavra-passe</label>
                        <div style="position:relative;">
                            <input name="nova_senha" id="nova_senha" type="password"
                                   class="editar-perfil-input" placeholder="Nova passe" maxlength="10"
                                   style="padding-right:44px;">
                            <button type="button" onclick="toggleSenha('nova_senha','olho-nova')"
                                    style="position:absolute;right:12px;top:50%;transform:translateY(-50%);
                                           background:none;border:none;cursor:pointer;color:#718096;">
                                <i id="olho-nova" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <small id="erro-nova-senha" class="erro"></small>

                        {{-- Indicador de força --}}
                        <div style="margin-top:8px;">
                            <div style="height:4px;background:#e2e8f0;border-radius:4px;overflow:hidden;">
                                <div id="barra-forca" style="height:100%;width:0%;transition:all 0.3s;border-radius:4px;"></div>
                            </div>
                            <span id="texto-forca" style="font-size:11px;color:#718096;margin-top:4px;display:block;"></span>
                        </div>
                    </div>

                    {{-- Confirmar nova senha --}}
                    <div class="editar-perfil-field">
                        <label class="editar-perfil-label editar-perfil-label--required">Confirmar Nova Palavra-passe</label>
                        <div style="position:relative;">
                            <input name="confirmar_nova_senha" id="confirmar_nova_senha" type="password"
                                   class="editar-perfil-input" placeholder="Confirme a nova passe" maxlength="10"
                                   style="padding-right:44px;">
                            <button type="button" onclick="toggleSenha('confirmar_nova_senha','olho-confirmar')"
                                    style="position:absolute;right:12px;top:50%;transform:translateY(-50%);
                                           background:none;border:none;cursor:pointer;color:#718096;">
                                <i id="olho-confirmar" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <small id="erro-confirmar-nova-senha" class="erro"></small>
                    </div>

                </div>

                {{-- Requisitos --}}
                <div style="margin-top:16px; padding:16px; background:#f7fafc;
                            border-radius:10px; border:1px solid #e2e8f0;">
                    <p style="margin:0 0 10px; font-size:13px; font-weight:600; color:#4a5568;">
                        Requisitos da palavra-passe:
                    </p>
                    <ul style="margin:0; padding-left:18px; font-size:13px; color:#718096; line-height:2;">
                        <li id="req-min">Entre 6 e 10 caracteres</li>
                        <li id="req-maiuscula">Pelo menos uma letra maiúscula</li>
                        <li id="req-numero">Pelo menos um número</li>
                    </ul>
                </div>
            </div>

            <div class="editar-perfil-actions">
                <button type="button" onclick="voltarSelecao()"
                        class="editar-perfil-btn editar-perfil-btn-cancel">← Voltar</button>
                <button type="submit" class="editar-perfil-btn editar-perfil-btn-save">Alterar Palavra-passe</button>
            </div>
        </form>
    </div>

</div>
</section>


<script>
// ── Navegação entre telas ──────────────────────────────────────────
function mostrarTela(id) {
    document.getElementById('tela-selecao').style.display = 'none';
    document.getElementById('tela-info').style.display    = 'none';
    document.getElementById('tela-senha').style.display   = 'none';
    document.getElementById(id).style.display             = 'block';
}
function voltarSelecao() {
    mostrarTela('tela-selecao');
}

// ── Toggle visibilidade da senha ──────────────────────────────────
function toggleSenha(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type   = 'text';
        icon.className = 'fa-solid fa-eye-slash';
    } else {
        input.type   = 'password';
        icon.className = 'fa-solid fa-eye';
    }
}

// ── Preview de foto ───────────────────────────────────────────────
document.getElementById('foto').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('foto-preview').src           = e.target.result;
        document.getElementById('foto-preview').style.display = 'block';
        document.getElementById('foto-icon').style.display    = 'none';
    };
    reader.readAsDataURL(file);
});

// ── Validações formulário de informações ─────────────────────────
document.addEventListener("DOMContentLoaded", function () {

    // ---- Regex ----
    const regexNome     = /^[A-Za-zÁÉÍÓÚÂÊÔÃÕÇáéíóúâêôãõç\s]+$/;
    const regexBI       = /^00\d{7}LA\d{3}$/;
    const regexEmail    = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const regexTelefone = /^9\d{8}$/;
    const senhasComuns  = ["123456","password","12345678","qwerty","abc123",
                           "111111","123123","admin","000000","senha","1234","12345"];

    function validar(campo, regex, erroId, mensagem) {
        const erro = document.getElementById(erroId);
        if (!campo || !erro) return true;
        if (!regex.test(campo.value.trim())) {
            erro.textContent = mensagem;
            campo.classList.add("input-erro");
            campo.classList.remove("input-sucesso");
            return false;
        }
        erro.textContent = "";
        campo.classList.remove("input-erro");
        campo.classList.add("input-sucesso");
        return true;
    }

    function validarNome() {
        const nome  = document.getElementById("nome");
        const erro  = document.getElementById("erro-nome");
        if (!nome || !erro) return true;
        const valor = nome.value;
        if (valor.trim() === "")             { erro.textContent = "O nome não pode estar vazio"; return false; }
        if (/\d/.test(valor))                { erro.textContent = "O nome não pode conter números"; return false; }
        if (!regexNome.test(valor))          { erro.textContent = "Caracteres inválidos"; return false; }
        const partes = valor.trim().split(/\s+/);
        if (partes.length < 2)               { erro.textContent = "Insira nome e sobrenome"; return false; }
        for (let p of partes) {
            if (p.length < 3)                { erro.textContent = "Cada nome deve ter pelo menos 3 letras"; return false; }
            if (p[0] !== p[0].toUpperCase()) { erro.textContent = "Cada nome deve começar com maiúscula"; return false; }
        }
        erro.textContent = "";
        return true;
    }

    function validarDataNascimento(valor) {
        if (!valor) return false;
        const hoje = new Date(); hoje.setHours(0,0,0,0);
        const d    = new Date(valor); d.setHours(0,0,0,0);
        const min  = new Date(); min.setFullYear(hoje.getFullYear() - 105);
        return !(d > hoje || d < min);
    }

    // Eventos — formulário de informações
    const nome     = document.getElementById("nome");
    const email    = document.getElementById("email");
    const telefone = document.getElementById("num_telefone");
    const bi       = document.getElementById("num_bi");
    const data     = document.getElementById("data_nascimento");

    if (nome)     nome.addEventListener("input", () => { validarNome(); nome.classList.toggle("input-sucesso", validarNome()); });
    if (nome)     nome.addEventListener("blur",  () => { nome.value = nome.value.replace(/\s+/g," ").trim(); });
    if (email)    email.addEventListener("input", () => validar(email, regexEmail, "erro-email", "Email inválido"));
    if (telefone) telefone.addEventListener("input", function () {
        this.value = this.value.replace(/\D/g,'').slice(0,9);
        validar(telefone, regexTelefone, "erro-tel", "Deve começar com 9 e ter 9 dígitos");
    });
    if (bi) bi.addEventListener("input", function () {
        if (bi.value.trim() === "") { document.getElementById("erro-bi").textContent = ""; bi.classList.remove("input-erro","input-sucesso"); }
        else validar(bi, regexBI, "erro-bi", "Formato: 00XXXXXXXLA000");
    });
    if (data) data.addEventListener("input", function () {
        const erro = document.getElementById("erro-data");
        if (!validarDataNascimento(this.value)) {
            erro.textContent = "Idade inválida (0–105 anos)";
            this.classList.add("input-erro"); this.classList.remove("input-sucesso");
        } else {
            erro.textContent = ""; this.classList.remove("input-erro"); this.classList.add("input-sucesso");
        }
    });

    // Submit — informações
    const formInfo = document.getElementById("formulario-info");
    if (formInfo) formInfo.addEventListener("submit", function (e) {
        let ok = true;
        if (!validarNome()) ok = false;
        if (email    && !validar(email, regexEmail, "erro-email", "Email inválido"))             ok = false;
        if (telefone && !validar(telefone, regexTelefone, "erro-tel", "Telefone inválido"))      ok = false;
        if (bi && bi.value.trim() !== "" && !validar(bi, regexBI, "erro-bi", "BI inválido"))     ok = false;
        if (data && !validarDataNascimento(data.value)) {
            document.getElementById("erro-data").textContent = "Data inválida";
            data.classList.add("input-erro"); ok = false;
        }
        if (!ok) { e.preventDefault(); }
    });


    // ── Validações formulário de senha ────────────────────────────
    const senhaAtual       = document.getElementById("senha_atual");
    const novaSenha        = document.getElementById("nova_senha");
    const confirmarNova    = document.getElementById("confirmar_nova_senha");

    function validarNovaSenha() {
        const erro = document.getElementById("erro-nova-senha");
        if (!novaSenha || !erro) return true;
        const v = novaSenha.value;

        // Atualiza requisitos visuais
        setReq("req-min",       v.length >= 6 && v.length <= 10);
        setReq("req-maiuscula", /[A-Z]/.test(v));
        setReq("req-numero",    /[0-9]/.test(v));

        // Força da senha
        let forca = 0;
        if (v.length >= 6) forca++;
        if (/[A-Z]/.test(v)) forca++;
        if (/[0-9]/.test(v)) forca++;
        if (v.length >= 9)   forca++;
        const cores  = ["#e53e3e","#dd6b20","#d69e2e","#38a169"];
        const textos = ["Fraca","Razoável","Boa","Forte"];
        const barra  = document.getElementById("barra-forca");
        const texto  = document.getElementById("texto-forca");
        if (barra && texto && v.length > 0) {
            barra.style.width      = (forca * 25) + "%";
            barra.style.background = cores[forca - 1] || cores[0];
            texto.textContent      = "Força: " + (textos[forca - 1] || textos[0]);
            texto.style.color      = cores[forca - 1] || cores[0];
        }

        if (v.length < 6 || v.length > 10)         { erro.textContent = "Entre 6 e 10 caracteres"; return false; }
        if (!/[A-Z]/.test(v) || !/[0-9]/.test(v)) { erro.textContent = "Precisa de maiúscula e número"; return false; }
        if (senhasComuns.includes(v.toLowerCase())) { erro.textContent = "Senha muito comum"; return false; }
        erro.textContent = ""; return true;
    }

    function setReq(id, ok) {
        const el = document.getElementById(id);
        if (!el) return;
        el.style.color      = ok ? "#38a169" : "#718096";
        el.style.fontWeight = ok ? "600" : "400";
    }

    if (novaSenha)     novaSenha.addEventListener("input", validarNovaSenha);
    if (confirmarNova) confirmarNova.addEventListener("input", function () {
        const erro = document.getElementById("erro-confirmar-nova-senha");
        if (this.value !== novaSenha.value) {
            erro.textContent = "As palavras-passe não coincidem";
            this.classList.add("input-erro"); this.classList.remove("input-sucesso");
        } else {
            erro.textContent = ""; this.classList.remove("input-erro"); this.classList.add("input-sucesso");
        }
    });

    const formSenha = document.getElementById("formulario-senha");
    if (formSenha) formSenha.addEventListener("submit", function (e) {
        let ok = true;
        if (!senhaAtual || senhaAtual.value.trim() === "") {
            document.getElementById("erro-senha-atual").textContent = "Insira a passe atual";
            senhaAtual.classList.add("input-erro"); ok = false;
        }
        if (!validarNovaSenha()) ok = false;
        if (confirmarNova && confirmarNova.value !== novaSenha.value) {
            document.getElementById("erro-confirmar-nova-senha").textContent = "As palavras-passe não coincidem";
            confirmarNova.classList.add("input-erro"); ok = false;
        }
        if (!ok) e.preventDefault();
    });
});
</script>
@endsection