
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

            <form method="post" id="formulario" action="{{ route('salvar_cadastro_paciente_recepcionista') }}">
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
                            <label class="editar-perfil-label editar-perfil-label--required">Morada</label>
                            <textarea name="morada" class="editar-perfil-textarea"
                                placeholder="Rua, número, edifício, andar, apartamento..." maxlength="10"></textarea>
                        </div>
                        <div class="editar-perfil-field" data-input="cidade">
                            <label class="editar-perfil-label editar-perfil-label--required">Cidade</label>
                            <input name="cidade" type="text" class="editar-perfil-input"
                                value="" placeholder="Digite a cidade" maxlength="20">
                        </div>
                        <div class="editar-perfil-field" data-input="bairro">
                            <label class="editar-perfil-label editar-perfil-label--required">Bairro</label>
                            <input name="bairro" type="text" class="editar-perfil-input"
                                value="" placeholder="Digite o bairro" maxlength="20">
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
 // REGEX
const nomeRegex =/^[A-ZÁÉÍÓÚÂÊÔÃÕÇ][a-záéíóúâêôãõç]{2,}( [A-ZÁÉÍÓÚÂÊÔÃÕÇ][a-záéíóúâêôãõç]{2,})+$/;
const telefoneRegex = /^9[0-9]{8}$/;
const biRegex = /^00[0-9]{7}LA[0-9]{3}$/;
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// senha: 6-10 caracteres, letra maiúscula, número
const senhaRegex = /^(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9]{6,10}$/;

// ===================== VALIDAÇÕES =====================

// Nome
function validarNome() {
    let input = document.getElementById("nome");
    let erro = document.getElementById("nomeErro");
    let valor = input.value.trim();

    if (!nomeRegex.test(valor)) {
        input.classList.add("invalido");
        input.classList.remove("valido");
        erro.textContent = "Nome deve ter pelo menos 3 letras por palavra e iniciar com maiúscula";
        erro.className="erro";
        return false;
    }

    input.classList.remove("invalido");
    input.classList.add("valido");
    erro.textContent = "✓ Válido";
    erro.className = "sucesso";
    return true;
}

// Email
function validarEmail() {
    let input = document.getElementById("email");
    let erro = document.getElementById("emailErro");

    if (!emailRegex.test(input.value.trim())) {
        input.classList.add("invalido");
        input.classList.remove("valido");
        erro.textContent = "Email inválido ";
        erro.className="erro";
        return false;
    }

    input.classList.remove("invalido");
    input.classList.add("valido");
    erro.textContent = "✓ Válido";
    erro.className = "sucesso";
    return true;
}

// Telefone
function validarTelefone() {
    let input = document.getElementById("num_telefone");
    let erro = document.getElementById("telefoneErro");

    if (!telefoneRegex.test(input.value)) {
        input.classList.add("invalido");
        input.classList.remove("valido");
        erro.textContent = "Número de telefone deve começar com 9 e ter 9 dígitos ";
        erro.className="erro";
        return false;
    }

    input.classList.remove("invalido");
    input.classList.add("valido");
    erro.textContent = "✓ Válido";
    erro.className = "sucesso";
    return true;
}

// BI
function validarBI() {
    let input = document.getElementById("num_bi");
    let erro = document.getElementById("biErro");
    let valor= input.value.trim();
    
    //se estiver vazio
    if(valor==""){
      input.classList.remove("invalido");
      input.classList.remove("válido");
      erro.textContent="";
      return true;
    }
   
    //se estiver preenchido
    if (!biRegex.test(input.value)) {
        input.classList.add("invalido");

        input.classList.remove("valido");
        erro.textContent = "Campo opcional. Formato exigido: 00XXXXXXXLA000  ";
        erro.className="erro";
        return false;
    }

    input.classList.remove("invalido");
    input.classList.add("valido");
    erro.textContent = "✓ Válido";
    erro.className = "sucesso";
    return true;
}

// Data
function validarData() {
    let input = document.getElementById("data_nascimento");
    let erro = document.getElementById("dataErro");

    let valor = input.value;
    //campo vazio
    if (!valor) {
        erro.textContent = "Campo obrigatório";
        erro.className="erro";
        input.classList.add("invalido");

        input.classList.remove("valido");
        return false;
    }
     
    let data = new Date(valor);
    let hoje = new Date();

    //calcular data minima (105 anos atras)
    let dataMinima = new Date();
    dataMinima.setFullYear(hoje.getFullYear()-105);

    //data futura....

    if (data > hoje) {
        erro.textContent = "Data futura é não permitido ";
        erro.className="erro";
        input.classList.add("invalido");

        input.classList.remove("valido");
        return false;
    }

    //data muito antiga
    if(data<dataMinima){
        erro.textContent="Idade máxima permitida é de 105 anos";
        erro.className="erro";
        input.classList.add("invalido");
        input.classList.remove("valido");

        return false;
    }

    //valido
    erro.textContent = "✓ Válido";
    erro.className = "sucesso";
    input.classList.remove("invalido");
    input.classList.add("valido");
    return true;
}

// Senha
function validarSenha() {
    let input = document.getElementById("senha");
    let erro = document.getElementById("senhaErro");

    if (!senhaRegex.test(input.value)) {
        input.classList.add("invalido");
        input.classList.remove("valido");
        erro.textContent = "Senha deve ter 6 a 10 caracteres, deve conter uma letra maiúscula e  número ";
        erro.className="erro";
        return false;
    }

    input.classList.remove("invalido");
    input.classList.add("valido");
    erro.textContent = "✓ Válido";
    erro.className = "sucesso";
    return true;
}

// Confirmar senha
function validarConfirmarSenha() {
    let senha = document.getElementById("senha").value;
    let confirmar = document.getElementById("confirmar_senha");
    let erro = document.getElementById("confirmarSenhaErro");

    if (confirmar.value !== senha || confirmar.value === "") {
        confirmar.classList.add("invalido");
        confirmar.classList.remove("valido");
        erro.textContent = "As senhas não coincidem ❌";
        erro.className="erro";
        return false;
    }

    confirmar.classList.remove("invalido");
    confirmar.classList.add("valido");
    erro.textContent = "✓ Coincide";
    erro.className = "sucesso";
    return true;
}

// ===================== EVENTOS =====================

document.getElementById("nome").addEventListener("input", validarNome);
document.getElementById("email").addEventListener("input", validarEmail);

document.getElementById("num_telefone").addEventListener("input", function(){
    this.value = this.value.replace(/\D/g, '').slice(0,9);
    validarTelefone();
});

document.getElementById("num_bi").addEventListener("input", validarBI);
document.getElementById("data_nascimento").addEventListener("change", validarData);
document.getElementById("senha").addEventListener("input", validarSenha);
document.getElementById("confirmar_senha").addEventListener("input", validarConfirmarSenha);

// ===================== SUBMIT =====================

function mostrarAlert(mensagem) {
    const box= document.getElementById("custom-alert");
    const text= document.getElementById("custom-alert-text");

    text.textContent= mensagem;
    box.classList.remove("hidden");
}

function fecharAlert() {
    document.getElementById("custom-alert").classList.add("hidden");
}
document.getElementById("formulario").addEventListener("submit", function(e){

    let valido =
        validarNome() &&
        validarEmail() &&
        validarTelefone() &&
        validarBI() &&
        validarData() &&
        validarSenha() &&
        validarConfirmarSenha();

    if (!valido) {
        e.preventDefault();
        mostrarAlert("Corrija os erros antes de enviar.");
    } else {
        mostrarAlert("Formulário válido!");
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
