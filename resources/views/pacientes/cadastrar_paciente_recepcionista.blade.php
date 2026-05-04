@extends("layouts.painel")
@section("titulo", "Cadastro de Paciente")
@section("conteudo")
    <section class="section active">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Cadastro de Paciente</strong> </h2>
            <br><br>
            @if(session("erro"))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session("erro") }}
                </div>
            @endif

            <form method="post" id="formulario" enctype="multipart/form-data" action="{{ route('salvar_cadastro_paciente_recepcionista') }}">
                {{ csrf_field() }}

                {{-- FOTO DE PERFIL --}}
    <div style="display:flex; flex-direction:column; align-items:center; margin-bottom:28px;">
        <label for="foto" id="foto-label" style="
            position:relative; width:120px; height:120px; border-radius:50%;
            cursor:pointer; overflow:hidden; border:3px dashed #a0aec0;
            background:#f0f4f8; display:flex; align-items:center;
            justify-content:center; transition:border-color 0.2s;"
            onmouseover="this.style.borderColor='#0066cc';document.getElementById('foto-overlay').style.opacity='1'"
            onmouseout="this.style.borderColor='#a0aec0';document.getElementById('foto-overlay').style.opacity='0'">

            <img id="foto-preview" src="" alt="Foto"
                 style="display:none; width:100%; height:100%;
                        object-fit:cover; border-radius:50%;">

                         <i id="foto-icon" class="fa-solid fa-circle-user"
               style="font-size:64px; color:#a0aec0;"></i>

            <div id="foto-overlay" style="
                position:absolute; inset:0; background:rgba(0,0,0,0.38);
                border-radius:50%; display:flex; align-items:center;
                justify-content:center; opacity:0; transition:opacity 0.2s;
                pointer-events:none;">
                <i class="fa-solid fa-camera" style="color:white; font-size:26px;"></i>
            </div>
        </label>

        <input type="file" id="foto" name="foto" accept="image/*" style="display:none">
        <span style="margin-top:8px; font-size:13px; color:#718096;">
            Clique para adicionar foto (opcional)
        </span>
    </div>


                <!-- Informações Pessoais -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Informações Pessoais
                    </h2>

                    <div class="editar-perfil-grid">
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Nome Completo</label>
                            <input name="nome" type="text" id="nome" class="editar-perfil-input" 
                                placeholder="Digite seu nome completo">
                                <span id="nomeErro" class="erro"></span>
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
                            <input name="data_nascimento" id="data_nascimento" type="date" class="editar-perfil-input"
                                value=""><span id="dataErro" class="erro"></span>
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
                            <input name="num_bi" id="num_bi" type="text" class="editar-perfil-input"
                                value="" placeholder="000000000LA000"  ><span id="biErro" class="erro"></span>
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
                            <input name="email" id="email" type="email" class="editar-perfil-input"
                                value="" placeholder="seu.email@exemplo.com"><span id="emailErro" class="erro"></span>
                            <span class="editar-perfil-helper-text">Este email será usado para login e notificações</span>
                        </div>
                          <div class="editar-perfil-field" data-input="num_telefone">
                            <label class="editar-perfil-label editar-perfil-label--required">Número de Telefone</label>
                            <input name="num_telefone" id="num_telefone" type="text" class="editar-perfil-input"
                                value="" placeholder=" 900000000">
                                <span id="telefoneErro" class="erro"></span>
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
                            <label class="editar-perfil-label editar-perfil-label--required">Rua/Moarada</label>
                            <textarea name="morada" class="editar-perfil-textarea"
                                placeholder="Rua, número, edifício, andar, apartamento..." maxlength="10"></textarea>
                        </div>
                        <div class="editar-perfil-field" data-input="cidade">
                            <label class="editar-perfil-label editar-perfil-label--required">Província</label>
                           <select id="cidade" name="cidade" class="editar-perfil-select">
                                <option value="Bengo">Bengo</option>
                                <option value="Benguela">Benguela</option>
                                <option value="Bié">Bié</option>
                                <option value="Cabinda">Cabinda</option>
                                <option value="Cuando">Cuando</option>
                                <option value="Cubando">Cubando</option>
                                <option value="Cuanza Norte">Cuanza Norte</option>
                                <option value="Cuanza Sul">Cuanza Sul</option>
                                <option value="Cunene">Cunene</option>
                                <option value="Huambo">Huambo</option>
                                <option value="Icolo Bengo">Icolo Bengo</option>
                                <option value="Luanda">Luanda</option>
                                <option value="Lunda Norte">Lunda Norte</option>
                                <option value="Lunda sul">Lunda Sul</option>
                                <option value="Malanje">Malanje</option>
                                <option value="Moxico">Moxico</option>
                                <option value="Moxico Leste">Moxico Leste</option>
                                <option value="Namibe">Namibe</option>
                                <option value="Uíge">Uíge</option>
                                <option value="Zaire">Zaire</option>
                            </select>
                        </div>
                        <div class="editar-perfil-field" data-input="bairro">
                            <label class="editar-perfil-label editar-perfil-label--required">Bairro</label>
                            <input name="bairro" id="bairro" type="text" class="editar-perfil-input"
                                value="" placeholder="Digite o bairro" maxlength="20">
                                <span id="bairroErro" class="erro"></span>
                        </div>
                        <div class="editar-perfil-field editar-perfil-field--full" data-input="seguro">
                            <label class="editar-perfil-label">Seguro</label>
                            <input name="seguro" type="text" class="editar-perfil-input"
                                value=""
                                placeholder="Informações do seguro profissional" maxlength="15">
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
                            <input name="senha" id="senha" type="password" class="editar-perfil-input" placeholder="Digite sua senha">
                        </div><span id="senhaErro" class="erro"></span>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Confirmar Senha</label>
                            <input name="confirmar_senha" id="confirmar_senha" type="password" class="editar-perfil-input" placeholder="Confirme sua senha">
                            <span id="confirmarSenhaErro" class="erro"></span>
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
{{-- Preview da foto --}}
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

{{-- restante JS que já tens... --}}
</script>


    <script>
 const telefoneRegex = /^9[0-9]{8}$/;
const biRegex = /^00[0-9]{7}LA[0-9]{3}$/;
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const senhasComuns = ["123456", "password", "12345678", "qwerty", "abc123", "111111"];


// ===================== UTIL =====================

function normalizarEspacos(valor) {
    return valor.replace(/\s+/g, ' ').trim();
}


// ===================== VALIDAÇÕES =====================

// Nome
function validarNome() {
    let input = document.getElementById("nome");
    let erro = document.getElementById("nomeErro");
    let valor = input.value;

    if (valor.trim() === "") {
        erro.textContent = "Campo obrigatório";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    if (/\d/.test(valor)) {
        erro.textContent = "O nome não pode conter números";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    let partes = normalizarEspacos(valor).split(" ");

    if (partes.length < 2) {
        erro.textContent = "Informe nome e sobrenome";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    for (let parte of partes) {
        if (parte.length < 3) {
            erro.textContent = "Cada nome deve ter no mínimo 3 letras";
            erro.className = "erro";
            input.classList.add("invalido");
            input.classList.remove("valido");
            return false;
        }

        if (parte[0] !== parte[0].toUpperCase()) {
            erro.textContent = "Cada nome deve começar com letra maiúscula";
            erro.className = "erro";
            input.classList.add("invalido");
            input.classList.remove("valido");
            return false;
        }
    }

    erro.textContent = "✓ Nome válido";
    erro.className = "sucesso";
    input.classList.remove("invalido");
    input.classList.add("valido");
    return true;
}


// Email
function validarEmail() {
    let input = document.getElementById("email");
    let erro = document.getElementById("emailErro");

    if (!emailRegex.test(input.value.trim())) {
        erro.textContent = "Email inválido";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    erro.textContent = "✓ Email válido";
    erro.className = "sucesso";
    input.classList.remove("invalido");
    input.classList.add("valido");
    return true;
}


// Telefone
function validarTelefone() {
    let input = document.getElementById("num_telefone");
    let erro = document.getElementById("telefoneErro");

    if (!telefoneRegex.test(input.value)) {
        erro.textContent = "Número deve começar com 9 e ter 9 dígitos";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    erro.textContent = "✓ Telefone válido";
    erro.className = "sucesso";
    input.classList.remove("invalido");
    input.classList.add("valido");
    return true;
}


// BI
function validarBI() {
    let input = document.getElementById("num_bi");
    let erro = document.getElementById("biErro");
    let valor = input.value.trim();

    if (valor === "") {
        input.classList.remove("invalido");
        input.classList.remove("valido");
        erro.textContent = "";
        return true;
    }

    if (!biRegex.test(valor)) {
        erro.textContent = "Campo Opcional! Formato Exigido: 00XXXXXXXLA000";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    erro.textContent = "✓ BI válido";
    erro.className = "sucesso";
    input.classList.remove("invalido");
    input.classList.add("valido");
    return true;
}


// Data
function validarData() {
    let input = document.getElementById("data_nascimento");
    let erro = document.getElementById("dataErro");

    let valor = input.value;

    if (!valor) {
        erro.textContent = "Campo obrigatório";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    let data = new Date(valor + "T00:00:00");
    let hoje = new Date();

    let dataMinima = new Date();
    dataMinima.setFullYear(hoje.getFullYear() - 105);

    if (data > hoje) {
        erro.textContent = "Data futura não permitida";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    if (data < dataMinima) {
        erro.textContent = "Idade máxima é 105 anos";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    erro.textContent = "✓ Data válida";
    erro.className = "sucesso";
    input.classList.remove("invalido");
    input.classList.add("valido");
    return true;
}


// Bairro
function validarBairro() {
    let input = document.getElementById("bairro");
    let erro = document.getElementById("bairroErro");
    let valor = input.value;

    if (valor.trim() === "") {
        erro.textContent = "Campo obrigatório";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    let normalizado = normalizarEspacos(valor);

    if (normalizado.length < 4) {
        erro.textContent = "O bairro deve ter no mínimo 4 caracteres";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    if (/^\d+$/.test(normalizado)) {
        erro.textContent = "O bairro não pode conter apenas números";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    if (/^[a-z]/.test(normalizado)) {
        erro.textContent = "Deve começar com letra maiúscula";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    erro.textContent = "✓ Bairro válido";
    erro.className = "sucesso";
    input.classList.remove("invalido");
    input.classList.add("valido");
    return true;
}


// Senha
function validarSenha() {
    let input = document.getElementById("senha");
    let erro = document.getElementById("senhaErro");
    let senha = input.value;
    let nome = normalizarEspacos(document.getElementById("nome").value.toLowerCase());

    if (senha === "") {
        erro.textContent = "Campo obrigatório";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    if (senha.length < 6 || senha.length > 10) {
        erro.textContent = "Deve ter 6 a 10 caracteres";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    if (!/[A-Z]/.test(senha)) {
        erro.textContent = "Deve ter uma letra maiúscula";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    if (!/[0-9]/.test(senha)) {
        erro.textContent = "Deve ter um número";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    let partesNome = nome.split(" ");

    for (let parte of partesNome) {
        if (parte.length > 2 && senha.toLowerCase().includes(parte)) {
            erro.textContent = "A senha não deve conter partes do seu nome";
            erro.className = "erro";
            input.classList.add("invalido");
            input.classList.remove("valido");
            return false;
        }
    }

    if (senhasComuns.includes(senha.toLowerCase())) {
        erro.textContent = "Senha muito fraca";
        erro.className = "erro";
        input.classList.add("invalido");
        input.classList.remove("valido");
        return false;
    }

    erro.textContent = "✓ Senha segura";
    erro.className = "sucesso";
    input.classList.remove("invalido");
    input.classList.add("valido");
    return true;
}


// Confirmar senha
function validarConfirmarSenha() {
    let senha = document.getElementById("senha").value;
    let confirmar = document.getElementById("confirmar_senha");
    let erro = document.getElementById("confirmarSenhaErro");

    if (confirmar.value !== senha || confirmar.value === "") {
        erro.textContent = "As senhas não coincidem";
        erro.className = "erro";
        confirmar.classList.add("invalido");
        confirmar.classList.remove("valido");
        return false;
    }

    erro.textContent = "✓ Coincide";
    erro.className = "sucesso";
    confirmar.classList.remove("invalido");
    confirmar.classList.add("valido");
    return true;
}


// ===================== EVENTOS =====================

// input (não bloqueia espaço)
document.getElementById("nome").addEventListener("input", validarNome);
document.getElementById("bairro").addEventListener("input", validarBairro);

// normalizar só ao sair
document.getElementById("nome").addEventListener("blur", function(){
    this.value = normalizarEspacos(this.value);
    validarNome();
});

document.getElementById("bairro").addEventListener("blur", function(){
    this.value = normalizarEspacos(this.value);
    validarBairro();
});

document.getElementById("email").addEventListener("input", validarEmail);

document.getElementById("num_telefone").addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, '').slice(0, 9);
    validarTelefone();
});

document.getElementById("num_bi").addEventListener("input", validarBI);
document.getElementById("data_nascimento").addEventListener("change", validarData);
document.getElementById("senha").addEventListener("input", validarSenha);
document.getElementById("confirmar_senha").addEventListener("input", validarConfirmarSenha);


// ===================== SUBMIT =====================

function mostrarAlert(mensagem) {
    const box = document.getElementById("custom-alert");
    const text = document.getElementById("custom-alert-text");

    text.textContent = mensagem;
    box.classList.remove("hidden");
}

function fecharAlert() {
    document.getElementById("custom-alert").classList.add("hidden");
}

document.getElementById("formulario").addEventListener("submit", function (e) {

    let valido =
        validarNome() &&
        validarEmail() &&
        validarTelefone() &&
        validarBI() &&
        validarData() &&
        validarBairro() &&
        validarSenha() &&
        validarConfirmarSenha();

    if (!valido) {
        e.preventDefault();
        mostrarAlert("Corrija os erros antes de enviar.");
    }
});
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