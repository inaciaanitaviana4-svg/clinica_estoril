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

            <form method="post" id="formulario" action="{{ route('salvar_registro_utilizador_admin', $utilizador->id_util ?? null) }}">
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
                            <label class="editar-perfil-label editar-perfil-label--required">Morada</label>
                            <textarea name="morada" class="editar-perfil-textarea" maxlength="10" placeholder="Rua, número, edifício, andar, apartamento...">{{ $dados['paciente']->morada ?? ($dados['admin']->morada ?? ($dados['recepcionista']->morada ?? ($dados['medico']->morada ?? ''))) }}</textarea>
                        </div>
                        <div class="editar-perfil-field" data-input="cidade">
                            <label class="editar-perfil-label editar-perfil-label--required">Cidade</label>
                            <input name="cidade" type="text" class="editar-perfil-input"
                                value="{{ $dados['paciente']->cidade ?? '' }}" maxlength="25" placeholder="Digite a cidade">
                        </div>
                        <div class="editar-perfil-field" data-input="bairro">
                            <label class="editar-perfil-label editar-perfil-label--required">Bairro</label>
                            <input name="bairro" type="text" class="editar-perfil-input"
                                value="{{ $dados['paciente']->bairro ?? '' }}" maxlength="25" placeholder="Digite o bairro">
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
document.addEventListener("DOMContentLoaded", function () {

  const form = document.getElementById("formulario");

  const nome = document.getElementById("nome");
  const data = document.getElementById("data_nascimento");
  const bi = document.getElementById("num_bi");
  const email = document.getElementById("email");
  const telefone = document.getElementById("num_telefone");
  const senha = document.getElementById("senha");

  // ================= REGEX =================
  const regexNome = /^[A-ZÁÉÍÓÚÂÊÔÃÕÇ][a-záéíóúâêôãõç]{2,}( [A-ZÁÉÍÓÚÂÊÔÃÕÇ][a-záéíóúâêôãõç]{2,})+$/;
  const regexBI = /^00\d{7}LA\d{3}$/;
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const regexTelefone = /^9\d{8}$/;
  const regexSenha = /^(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9]{6,10}$/;

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
    validar(nome, regexNome, "erro-nome",
      "Nome deve ter pelo menos 3 letras por palavra e iniciar com maiúscula");
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
    validar(senha, regexSenha, "erro-senha",
      "Senha deve ter 6 a 10 caracteres, deve conter uma letra maiúscula e  número");
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

    if (!validar(nome, regexNome, "erro-nome", "Nome de usuário inválido")) {
      valido = false;
    }

    if (!validar(email, regexEmail, "erro-email", "Email inválido")) {
      valido = false;
    }

    if (!validar(telefone, regexTelefone, "erro-tel", "Número de telefone inválido")) {
      valido = false;
    }

    if (!validar(senha, regexSenha, "erro-senha", "Senha inválida")) {
      valido = false;
    }

    // BI opcional
    if (bi.value.trim() !== "") {
      if (!validar(bi, regexBI, "erro-bi", "Bilhete Identidade inválido")) {
        valido = false;
      }
    }

    // Data
   if(data && data.offsetParent !==null){
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
