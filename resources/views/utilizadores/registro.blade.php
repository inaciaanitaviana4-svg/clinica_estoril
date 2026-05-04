@extends('layouts.admin')
@section('titulo', 'Registro de usuário')
@section('conteudo')
    <section class="section active ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Registro de utilizador</strong> </h2>
            <br><br>
            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif

       

            <form method="post" id="formulario" enctype="multipart/form-data"
      action="{{ route('salvar_registro_utilizador_admin', $utilizador->id_util ?? null) }}">
    {{ csrf_field() }}

         {{-- Foto de perfil --}}
<div style="display:flex; flex-direction:column; align-items:center; margin-bottom:32px;">
    <label for="foto" id="foto-label" style="
        position:relative; width:120px; height:120px; border-radius:50%;
        cursor:pointer; overflow:hidden; border:3px dashed #a0aec0;
        background:#f0f4f8; display:flex; align-items:center;
        justify-content:center; transition:border-color 0.2s;"
        onmouseover="this.style.borderColor='#0066cc';document.getElementById('foto-overlay').style.opacity='1'"
        onmouseout="this.style.borderColor='#a0aec0';document.getElementById('foto-overlay').style.opacity='0'">

        @if(isset($utilizador) && $utilizador->foto)
            <img id="foto-preview"
                 src="{{ asset('storage/' . $utilizador->foto) }}"
                 alt="Foto" style="width:100%; height:100%;
                 object-fit:cover; border-radius:50%;">
            <i id="foto-icon" class="fa-solid fa-circle-user"
               style="display:none; font-size:64px; color:#a0aec0;"></i>
        @else

         <img id="foto-preview" src="" alt="Foto"
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
        {{ isset($utilizador) && $utilizador->foto ? 'Alterar foto' : 'Adicionar foto (opcional)' }}
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
                            <input name="nome" type="text" class="editar-perfil-input" id="nome"
                                value="{{ $utilizador->nome ?? '' }}" placeholder="Digite seu nome completo">
                                <small id="erro-nome" class="erro"></small>
                        </div>
                        <div class="editar-perfil-field">
                            <label class="editar-perfil-label editar-perfil-label--required">Gênero</label>
                            <select name="genero" class="editar-perfil-select">
                                <option value="">Selecione...</option>
                                <option value="M" {{ ($utilizador->genero ?? '') == 'M' ? 'selected' : '' }}>Masculino
                                </option>
                                <option value="F" {{ ($utilizador->genero ?? '') == 'F' ? 'selected' : '' }}>Feminino
                                </option>
                            </select>
                        </div>
                        <div class="editar-perfil-field" data-input="data_nascimento">
                            <label class="editar-perfil-label editar-perfil-label--required">Data de Nascimento</label>
                            <input name="data_nascimento" id="data_nascimento" type="date" class="editar-perfil-input"
                                value="{{ $dados['paciente']->data_nascimento ?? '' }}">
                                <small id="erro-data" class="erro"></small>
                        </div>
                        <div class="editar-perfil-field" data-input="estado_civil">
                            <label class="editar-perfil-label">Estado Civil</label>
                            <select name="estado_civil" class="editar-perfil-select">
                                <option value="">Selecione...</option>
                                <option value="solteiro" @selected($dados['paciente']->estado_civil ?? '' == 'solteiro')>
                                    Solteiro(a)</option>
                                <option value="casado" @selected($dados['paciente']->estado_civil ?? '' == 'casado')>
                                    Casado(a)
                                </option>
                                <option value="divorciado" @selected($dados['paciente']->estado_civil ?? '' == 'divorciado')>
                                    Divorciado(a)</option>
                                <option value="viuvo" @selected($dados['paciente']->estado_civil ?? '' == 'viuvo')>
                                    Viúvo(a)
                                </option>
                            </select>
                        </div>
                        <div class="editar-perfil-field" data-input="num_bi">
                            <label class="editar-perfil-label editar-perfil-label--required">Número do BI</label>
                            <input name="num_bi" id="num_bi" type="text" class="editar-perfil-input"
                                value="{{ $dados['paciente']->num_bi ?? '' }}" placeholder="000000000LA000" >
                                <small id="erro-bi" class="erro"></small>
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
                                value="{{ $utilizador->email ?? '' }}" placeholder="seu.email@exemplo.com">
                                <small id="erro-email" class="erro"></small>
                            <span class="editar-perfil-helper-text">Este email será usado para login e notificações</span>
                        </div>
                        <div class="editar-perfil-field" data-input="num_telefone">
                            <label class="editar-perfil-label editar-perfil-label--required">Número de Telefone</label>
                            <input name="num_telefone" id="num_telefone" type="text" class="editar-perfil-input"
                                value="{{ $utilizador->num_telefone ?? '' }}" placeholder=" 900000000">
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
                        <div class="editar-perfil-field editar-perfil-field--full" data-input="morada">
                            <label class="editar-perfil-label editar-perfil-label--required">Rua/Morada</label>
                            <textarea name="morada" class="editar-perfil-textarea" maxlength="10" placeholder="Rua, número, edifício, andar, apartamento...">{{ $dados['paciente']->morada ?? ($dados['admin']->morada ?? ($dados['recepcionista']->morada ?? ($dados['medico']->morada ?? ''))) }}</textarea>
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
                                value="{{ $dados['paciente']->bairro ?? '' }}" maxlength="25" placeholder="Digite o bairro">
                                <small id="erro-bairro" class="erro"></small>
                        </div>
                        <div class="editar-perfil-field editar-perfil-field--full" data-input="seguro">
                            <label class="editar-perfil-label">Seguro</label>
                            <input name="seguro" type="text" class="editar-perfil-input"
                                value="{{ $dados['paciente']->seguro ?? '' }}" maxlength="15"
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
                            <input name="senha" id="senha" type="password" class="editar-perfil-input"
                                placeholder="Digite sua senha" maxlength="10">
                                <small id="erro-senha" class="erro"></small>
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
                            <label class="editar-perfil-label ">Especialidade</label>
                            <select name="especialidade" class="editar-perfil-select">
                                <option value="Nenhuma">Nenhuma</option>
                                @foreach ($especialidades as $especialidade)
                                    <option value="{{ $especialidade->nome }}">{{ $especialidade->nome }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="editar-perfil-field" data-input="ano_experiencia">
                            <label class="editar-perfil-label editar-perfil-label--required">Anos de Experiência</label>
                            <input type="number" id="ano_experiencia" name="ano_experiencia"  class="editar-perfil-input"
                                value="{{ $dados['medico']->ano_experiencia ?? '' }}" placeholder="0" min="0"
                                max="70">
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
@section('script')
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

  const nome = document.getElementById("nome");
  const data = document.getElementById("data_nascimento");
  const bi = document.getElementById("num_bi");
  const email = document.getElementById("email");
  const telefone = document.getElementById("num_telefone");
  const senha = document.getElementById("senha");
   const bairro = document.getElementById("bairro");

  // ================= REGEX =================
  const regexNome = /^[A-Za-zÁÉÍÓÚÂÊÔÃÕÇáéíóúâêôãõç\s]+$/;
  const regexBI = /^00\d{7}LA\d{3}$/;
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const regexTelefone = /^9\d{8}$/;
/*  const regexSenha = /^(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9]{6,10}$/;*/
  const regexBairro = /^(?=.*[A-Za-z])[A-Za-z0-9\s]{4,}$/;

    const senhasComuns = [
    "123456", "password", "12345678", "qwerty", "abc123",
    "111111", "123123", "admin", "000000", "senha",
    "1234", "12345"
  ];


  // ================= FUNÇÃO GENÉRICA =================
  function validar(campo, regex, erroId, mensagem) {
    const erro = document.getElementById(erroId);

    if (!regex.test(campo.value.trim())) {
      erro.textContent = mensagem;
      erro.className = "erro";

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

    const dataMinima = new Date();
    dataMinima.setFullYear(hoje.getFullYear() - 105);

    if (dataValor > hoje) return false;
    if (dataValor < dataMinima) return false;

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


  // Bairro
  bairro.addEventListener("input", function () {
    const erro = document.getElementById("erro-bairro");

    if (bairro.value.trim() === "") {
      erro.textContent = "O bairro não pode estar vazio";
    } else if (!regexBairro.test(bairro.value)) {
      erro.textContent = "Bairro inválido (mínimo 4 caracteres e deve conter letras)";
    } else {
      erro.textContent = "";
    }
  });


  // BI (OPCIONAL)
  bi.addEventListener("input", function () {
    if (bi.value.trim() === "") {
      document.getElementById("erro-bi").textContent = "";
      bi.classList.remove("input-erro", "input-sucesso");
    } else {
      validar(bi, regexBI, "erro-bi",
        "Campo opcional. Formato exigido: 00XXXXXXXLA000");
    }
  });

  // Data
 if(data){
     data.addEventListener("input", function () {
    const erro = document.getElementById("erro-data");

    if (!validarDataNascimento(this.value)) {
      erro.textContent = "Data inválida! idades permitidas: 0 a 105 anos";
      erro.className = "erro";

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

  function mostrarAlert(mensagem) {
    const box= document.getElementById("custom-alert");
    const text= document.getElementById("custom-alert-text");

    text.textContent= mensagem;
    box.classList.remove("hidden");
}

function fecharAlert() {
    document.getElementById("custom-alert").classList.add("hidden");
}
   form.addEventListener("submit", function (e) {

    let valido = true;

    if (!validarNome()) {
      valido = false;
    }

    if (!validar(email, regexEmail, "erro-email", "Email inválido")) {
      valido = false;
    }

    if (!validar(telefone, regexTelefone, "erro-tel", "Número de telefone inválido")) {
      valido = false;
    }

    if (!validarSenhaForte()) {
      valido = false;
    }

    if(bairro && bairro.offsetParent !==null){
      if (!regexBairro.test(bairro.value.trim())) {
      valido = false;
      document.getElementById("erro-bairro").textContent = "Bairro inválido";
    }
    }

    

    // BI opcional
    if (bi.value.trim() !== "") {
      if (!validar(bi, regexBI, "erro-bi", "Bilhete Identidade inválido")) {
        valido = false;
      }
    }

    // Data
    if (data && data.offsetParent !== null) {
      if (!validarDataNascimento(data.value)) {
        valido = false;

        const erro = document.getElementById("erro-data");
        erro.textContent = "Data inválida!";
        erro.className = "erro";

        data.classList.add("input-erro");
        data.classList.remove("input-sucesso");
      }
    }

    // Bloquear envio
    if (!valido) {
      e.preventDefault();
      mostrarAlert("Corrija os erros antes de enviar.");
    }

  });

});


        const select_tipo = document.querySelector('[name="tipo"]')
        select_tipo.addEventListener("change", function() {
            const valor_selecionado = this.value
            mostrar_campos_por_tipo(valor_selecionado)
        })
        document.addEventListener("DOMContentLoaded", function() {
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
