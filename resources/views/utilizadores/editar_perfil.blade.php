@extends(Session::get('tipo_utilizador') == 'admi' ? 'layouts.admin' : 'layouts.painel')
@section('titulo', 'Perfil')
@section('conteudo')
    <section>
        <div class="editar-perfil-container">
            <!-- Header -->
            <div class="editar-perfil-header">
                <div class="editar-perfil-header-content">
                    <div class="editar-perfil-header-text">
                <h1>Editar Perfil</h1>
                <p>Atualize suas informações pessoais e profissionais</p>
            </div>
             </div>
                  

            <!-- Formulário -->
            <form action="/editar-perfil" id="formulario" method="POST"
      class="editar-perfil-form" enctype="multipart/form-data">
    {{ csrf_field() }}

       {{-- Foto de perfil circular — centro do formulário --}}
    <div style="display:flex; flex-direction:column; align-items:center; margin-bottom:20px;">
        <label for="foto" id="foto-label" style="
            position:relative; width:120px; height:120px; border-radius:50%;
            cursor:pointer; overflow:hidden; border:3px dashed #a0aec0;
            background:#f0f4f8; display:flex; align-items:center;
            justify-content:center; transition:border-color 0.2s;"
            onmouseover="this.style.borderColor='#0066cc';document.getElementById('foto-overlay').style.opacity='1'"
            onmouseout="this.style.borderColor='#a0aec0';document.getElementById('foto-overlay').style.opacity='0'">

            @if($utilizador->foto)
                <img id="foto-preview"
                     src="{{ asset('storage/' . $utilizador->foto) }}"
                     alt="Foto de perfil"
                     style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                <i id="foto-icon" class="fa-solid fa-circle-user"
                   style="display:none; font-size:64px; color:#a0aec0;"></i>
            @else

             <img id="foto-preview" src="" alt="Foto de perfil"
                     style="display:none; width:100%; height:100%;
                            object-fit:cover; border-radius:50%;">
                <i id="foto-icon" class="fa-solid fa-circle-user"
                   style="font-size:64px; color:#a0aec0;"></i>
            @endif

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
            {{ $utilizador->foto ? 'Clique para alterar foto' : 'Clique para adicionar foto' }}
        </span>
    </div>

     
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
                            <input name="nome" id="nome" type="text" class="editar-perfil-input" value="{{ $utilizador->nome }}"
                                placeholder="Digite seu nome completo">
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
                                <select name="estado_civil" id="estado_civil" class="editar-perfil-select">
                                    <option value="">Selecione...</option>
                                    <option value="solteiro"
                                        {{ $dados['paciente']->estado_civil == 'solteiro' ? 'selected' : '' }}>
                                        Solteiro(a)</option>
                                    <option value="casado"
                                        {{ $dados['paciente']->estado_civil == 'casado' ? 'selected' : '' }}>
                                        Casado(a)
                                    </option>
                                    <option value="divorciado"
                                        {{ $dados['paciente']->estado_civil == 'divorciado' ? 'selected' : '' }}>
                                        Divorciado(a)</option>
                                    <option value="viuvo"
                                        {{ $dados['paciente']->estado_civil == 'viuvo' ? 'selected' : '' }}>
                                        Viúvo(a)
                                    </option>
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

                <!-- Informações de Contato -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Contato
                    </h2>
                    <div class="editar-perfil-grid">
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Email</label>
                            <input name="email" id="email" type="email" class="editar-perfil-input"
                                value="{{ $utilizador->email }}" placeholder="seu.email@exemplo.com">
                                <small id="erro-email" class="erro"></small>
                            <span class="editar-perfil-helper-text">Este email será usado para login e notificações</span>
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Número de Telefone</label>
                            <input name="num_telefone" id="num_telefone" type="tel" class="editar-perfil-input"
                                value="{{ $utilizador->num_telefone }}" placeholder="+244 900 000 000">
                                <small id="erro-tel" class="erro"></small>
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
                            <label class="editar-perfil-label editar-perfil-label--required">Rua/Morada</label>
                            <textarea name="morada" class="editar-perfil-textarea" placeholder="Rua, número, edifício, andar, apartamento...">{{ $dados['paciente']->morada ?? ($dados['admin']->morada ?? ($dados['recepcionista']->morada ?? $dados['medico']->morada)) }}</textarea>
                        </div>
                        @if ($dados['paciente'])
                            <div class="editar-perfil-field">
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
                            <div class="editar-perfil-field">
                                <label class="editar-perfil-label editar-perfil-label--required">Bairro</label>
                                <input name="bairro" id="bairro" type="text" class="editar-perfil-input"
                                    value="{{ $dados['paciente']->bairro }}" placeholder="Digite o bairro">
                            </div>
                            <div class="editar-perfil-field editar-perfil-field--full">
                                <label class="editar-perfil-label">Seguro</label>
                                <input name="seguro" id="seguro" type="text" class="editar-perfil-input"
                                    value="{{ $dados['paciente']->seguro }}"
                                    placeholder="Informações do seguro profissional">
                            </div>
                        @endif
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
                            <input name="senha" id="senha" type="password" class="editar-perfil-input"
                                placeholder="Digite sua senha" maxlength="10">
                                <small id="erro-senha" class="erro"></small>
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Confirmar Senha</label>
                            <input name="confirmar_senha" id="confirmar_senha" type="password" class="editar-perfil-input"
                                placeholder="Confirme sua senha" maxlength="10">
                                <small id="erro-confirmar-senha" class="erro"></small>
                        </div>
                    </div>
                </div>
                <!-- Informações Profissionais -->
                @if (!$dados['paciente'])
                    <div class="editar-perfil-section">
                        <h2 class="editar-perfil-section-title">
                            <span class="editar-perfil-section-icon"></span>
                            Informações Profissionais
                        </h2>
                        <div class="editar-perfil-grid">
                            @if ($dados['medico'])
                                <div class="editar-perfil-field">
                                    <label class="editar-perfil-label editar-perfil-label--required">Especialidade</label>
                                    <input name="especialidade" id="especialidade" type="text" class="editar-perfil-input"
                                        value="{{ $dados['medico']->especialidade }}"
                                        placeholder="Digite sua especialidade">
                                </div>
                                <div class="editar-perfil-field">
                                    <label class="editar-perfil-label editar-perfil-label--required">Anos de
                                        Experiência</label>
                                    <input name="ano_experiencia" id="ano_experiencia" type="number" class="editar-perfil-input"
                                        value="{{ $dados['medico']->ano_experiencia }}" placeholder="0" min="0"
                                        max="70">
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
    {{-- Script de preview --}}
<script>
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
</script>
    <script>
document.addEventListener("DOMContentLoaded", function () {

const form = document.getElementById("formulario");

if (!form) return; // segurança

const nome = document.getElementById("nome");
const data = document.getElementById("data_nascimento");
const bi = document.getElementById("num_bi");
const email = document.getElementById("email");
const telefone = document.getElementById("num_telefone");
const senha = document.getElementById("senha");
const confirmarSenha = document.getElementById("confirmar_senha");


// ================= REGEX =================
const regexNome = /^[A-Za-zÁÉÍÓÚÂÊÔÃÕÇáéíóúâêôãõç\s]+$/;
const regexBI = /^00\d{7}LA\d{3}$/;
const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const regexTelefone = /^9\d{8}$/;
/*const regexSenha = /^(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9]{6,10}$/;*/

  const senhasComuns = [
    "123456", "password", "12345678", "qwerty", "abc123",
    "111111", "123123", "admin", "000000", "senha",
    "1234", "12345"
  ];
// ================= FUNÇÃO GENÉRICA =================
function validar(campo, regex, erroId, mensagem) {
    const erro = document.getElementById(erroId);

    if (!campo || !erro) return true;

    if (!regex.test(campo.value.trim())) {
        erro.textContent = mensagem;
        campo.classList.add("input-erro");
        campo.classList.remove("input-sucesso");
        return false;
    } else {
        erro.textContent = "";
        campo.classList.remove("input-erro");
        campo.classList.add("input-sucesso");
        return true;
    }
}

 // ================= VALIDAÇÃO NOME =================
  function validarNome() {
    const erro = document.getElementById("erro-nome");
    let valor = nome.value;

    if (valor.trim() === "") {
      erro.textContent = "O nome não pode estar vazio";
      return false;
    }

    if (/\d/.test(valor)) {
      erro.textContent = "O nome não pode conter números";
      return false;
    }

    if (!regexNome.test(valor)) {
      erro.textContent = "O nome contém caracteres inválidos";
      return false;
    }

    const partes = valor.trim().split(/\s+/);

    if (partes.length < 2) {
      erro.textContent = "Deve inserir nome e sobrenome";
      return false;
    }

    for (let parte of partes) {
      if (parte.length < 3) {
        erro.textContent = "Cada nome deve ter pelo menos 3 letras";
        return false;
      }

      if (parte[0] !== parte[0].toUpperCase()) {
        erro.textContent = "Cada nome deve começar com letra maiúscula";
        return false;
      }
    }

    erro.textContent = "";
    return true;
  }

  
  // ================= NORMALIZAÇÃO ESPAÇOS =================
  nome.addEventListener("blur", function () {
    this.value = this.value.replace(/\s+/g, " ").trim();
  });

    // ================= SENHA =================
  function validarSenhaForte() {
    const erro = document.getElementById("erro-senha");
    const valor = senha.value;

    if (valor.length < 6 || valor.length > 10) {
      erro.textContent = "A senha deve ter entre 6 e 10 caracteres";
      return false;
    }

    if (!/[A-Z]/.test(valor) || !/[0-9]/.test(valor)) {
      erro.textContent = "A senha deve conter pelo menos uma letra maiúscula e um número";
      return false;
    }

    if (senhasComuns.includes(valor.toLowerCase())) {
      erro.textContent = "Senha muito comum, escolha outra mais segura";
      return false;
    }

    const partesNome = nome.value.toLowerCase().split(/\s+/);

    for (let parte of partesNome) {
      if (parte.length > 2 && valor.toLowerCase().includes(parte)) {
        erro.textContent = "A senha não pode conter partes do seu nome";
        return false;
      }
    }

    erro.textContent = "";
    return true;
  }

// ================= DATA =================
function validarDataNascimento(valor) {
    if (!valor) return false;

    const hoje = new Date();
    const dataValor = new Date(valor);

    hoje.setHours(0,0,0,0);
    dataValor.setHours(0,0,0,0);

    const dataMinima = new Date();
    dataMinima.setFullYear(hoje.getFullYear() - 105);
    if(dataValor>hoje || dataValor<dataMinima) return false;
    

    return true;
}


// ================= EVENTOS =================
// Nome
  nome.addEventListener("input", function () {
    if (!validarNome()) {
      nome.classList.add("input-erro");
      nome.classList.remove("input-sucesso");
    } else {
      nome.classList.remove("input-erro");
      nome.classList.add("input-sucesso");
    }
  });

  // Email
  email.addEventListener("input", function () {
    validar(email, regexEmail, "erro-email", "Email inválido");
  });

  // Telefone
  telefone.addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, '').slice(0, 9);
    validar(telefone, regexTelefone, "erro-tel",
      "Número deve começar com 9 e ter 9 dígitos");
  });

    // Senha
  senha.addEventListener("input", function () {
    if (!validarSenhaForte()) {
      senha.classList.add("input-erro");
      senha.classList.remove("input-sucesso");
    } else {
      senha.classList.remove("input-erro");
      senha.classList.add("input-sucesso");
    }
  });


// Confirmar senha
if (confirmarSenha) {
    confirmarSenha.addEventListener("input", function () {
        const erro = document.getElementById("erro-confirmar-senha");

        if (this.value !== senha.value) {
            erro.textContent = "As senhas não coincidem";
            this.classList.add("input-erro");
        } else {
            erro.textContent = "";
            this.classList.remove("input-erro");
            this.classList.add("input-sucesso");
        }
    });
}

// BI (opcional)
if (bi) {
    bi.addEventListener("input", function () {
        if (bi.value.trim() === "") {
            document.getElementById("erro-bi").textContent = "";
            bi.classList.remove("input-erro", "input-sucesso");
        } else {
            validar(bi, regexBI, "erro-bi", "Campo opcional. Formato exigido: 00XXXXXXXLA000");
        }
    });
}

// Data
if (data) {
    data.addEventListener("input", function () {
        const erro = document.getElementById("erro-data");

        if (!validarDataNascimento(this.value)) {
            erro.textContent = "Idade inválida! idades permitidas: 0 a 105 anos";
            this.classList.add("input-erro");
            this.classList.remove("input-sucesso");
        } else {
            erro.textContent = "";
            this.classList.remove("input-erro");
            this.classList.add("input-sucesso");
        }
    });
}


// ================= SUBMIT =================

form.addEventListener("submit", function (e) {

    let valido = true;

    if (!validarNome()) {
      valido = false;
    }

    if (email && !validar(email, regexEmail, "erro-email", "Email inválido")) {
        valido = false;
    }

    if (telefone && !validar(telefone, regexTelefone, "erro-tel", "Telefone inválido")) {
        valido = false;
    }

    if (!validarSenhaForte()) {
      valido = false;
    }

    // Confirmar senha
    if (confirmarSenha && confirmarSenha.value !== senha.value) {
        document.getElementById("erro-confirmar-senha").textContent = "As senhas não coincidem";
        confirmarSenha.classList.add("input-erro");
        valido = false;
    }

    // BI opcional
    if (bi && bi.value.trim() !== "") {
        if (!validar(bi, regexBI, "erro-bi", "BI inválido")) {
            valido = false;
        }
    }

    // Data
    if (data && !validarDataNascimento(data.value)) {
        valido = false;
        const erro = document.getElementById("erro-data");
         erro.textContent = "Idade inválida! nao é permitido datas futuras";
        data.classList.add("input-erro");   
    }

    // 🔥 BLOQUEIO REAL
    if (!valido) {
        e.preventDefault();
        mostrarAlert("Corrija os erros antes de enviar.");
        return false;
    }

});

});
</script>
@endsection
