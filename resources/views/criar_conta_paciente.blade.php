<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Criar conta Paciente</title>

<style>
    body {
        font-family: Arial;
    }

    input {
        display: block;
        margin-bottom: 5px;
        padding: 6px;
        width: 250px;
    }

    .erro {
        color: red;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .sucesso {
        color: green;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .invalido {
        border: 2px solid red;
    }

    .valido {
        border: 2px solid green;
    }
    .custom-alert{
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.5);
        display:flex;
        justify-content:center;
        align-items:center;
        z-index:9999;
         font-size:18px;
        font-weight:bold;
    }

    .custom-alert-box{
        background:white;
        padding:20px;
        border-radius:10px;
        text-align:center;
        min-width:250px;
        box-shadow:0 5px 20px rgba(0,0,0,0.3);

    }

    .custom-alert button{
        margin-top:10px;
        padding:8px 15px;
        border:none;
        background:#0d6efd;
        color:white;
        border-radius:5px;
        cursor:pointer;
        font-weight:bold;
    }

    .hidden{
        display:none;
    }
    </style>
</head>

<body>
    <header class="header header-simple">
        <div class="containe">
            <div class="nav-wrapper">
                <a href="/" class="logo">
                    <img src="imagem/logo.jpg" alt="logotipo da clínica">
                    <span>Clínica Estoril</span>
                </a>

                <a href="/login" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    <span>Voltar</span>
                </a>
            </div>
        </div>
    </header>
    <section class="login-section">
        <div class="login-container">
            <!-- Seleção de Tipo de Usuário -->
            <div class="login-card" id="userTypeCard">

                <div class="container">
                    <div class="photo"></div>

                    <h2 style="text-align: center;"><strong>Registo de Paciente</strong> </h2>
                    @if (session('erro'))
                        <div style="background-color:red;color:white;text-align:center">
                            {{ session('erro') }}
                        </div>
                    @endif
                    <form method="post" action="/cadastrar-paciente" id="formulario" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nome">Nome Completo</label>
                            <input type="text" id="nome" name="nome" placeholder="Ex.: Eugénio Influencer"
                              title="Este campo não permite números, somente letras."  required><span id="nomeErro" class="erro"></span>
                        </div>
                        <div class="form-group">
                            <label for="num_telefone">Número de telefone</label>
                            <input type="text" id="num_telefone" name="num_telefone" placeholder="9XXXXXXXX"
                                maxlength="9" min="9" required><span id="telefoneErro" class="erro"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" id="email" name="email" placeholder="eugenio@gmail.com"
                                required><span id="emailErro" class="erro"></span>
                        </div>
                        <div class="form-group">
                            <label for="senha">senha</label>
                            <input type="password" id="senha" name="senha" placeholder="**********"  required>
                            <span id="senhaErro" class="erro"></span>
                        </div>
                        <div class="form-group">
                            <label for="confirmar_senha">Confirmar senha</label>
                            <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="**********" 
                                required><span id="confirmarSenhaErro" class="erro"></span>
                        </div>

                        <div class="form-group">
                            <label for="data_nascimento">Data de Nascimento</label>
                            <input type="date" id="data_nascimento" name="data_nascimento" required><span id="dataErro" class="erro"></span>
                        </div>
                        <div class="form-group">
                            <label for="num_bi">Número do Bilhete de Identidade</label>
                            <input type="text" id="num_bi" name="num_bi" placeholder="007484030LA045" 
                            ><span id="biErro" class="erro"></span>
                        </div>
                        <div class="form-group">
                            <label for="genero">Gênero</label>
                            <select id="genero" name="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estado_civil">Estado Civil</label>
                            <select id="estado_civil" name="estado_civil">
                                <option value="solteiro">Solteiro/a</option>
                                <option value="casado">Casado/a</option>
                                <option value="divorciado">Divorciado/a</option>
                                <option value="viuvo">Viúvo/a</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" name="cidade" placeholder="Ex.: Luanda" maxlenght="20" required>
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" name="bairro" placeholder="Ex.: Golf 2" maxlength="20" required>
                        </div>
                        <div class="form-group">
                            <label for="morada">Rua</label>
                            <input id="morada" name="morada" placeholder="Digite o nome da sua rua" maxlength="10" required>
                        </div>
                        <div class="form-group">
                            <label for="seguro">Seguro ou Particular</label>
                            <select id="seguro" name="seguro">
                                <option value="sem seguro">sem seguro</option>
                                <option value="particular">Particular</option>
                                <option value="fidelidade">Fidelidade</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-full">
                            <i class="fas fa-sign-in-alt"></i>
                            Concluir Registo
                        </button>
                    </form>
                </div>
            </div>
            <div class="login-help">
                <div class="help-card">
                    <i class="fas fa-question-circle"></i>
                    <h3>Precisa de Ajuda?</h3>
                    <p>Entre em contacto com o nosso suporte</p>
                    <a href="/contacto">Contactar Suporte</a>
                </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- Info da Clínica -->
                <div class="footer-section">
                    <div class="footer-logo">
                        <img src="imagem/preta.jpg" alt="logotipo da clínica estoril" width="50" height="50">
                        <span>Clínica Estoril</span>
                    </div>
                    <p class="footer-desc">
                        A saúde nas melhores mãos há mais de 10 anos.
                        Cuidamos de você e da sua família.
                    </p>
                    <div class="social-links">
                      <a href="https://www.facebook.com/c.estoril/" aria-label="Facebook"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/clinica_estoril?igsh=cXRuMzBwYW5oM2ti"
                            aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                       
                    </div>
                </div>

                <!-- Links Rápidos -->
                <div class="footer-section">
                    <h4 class="footer-title">Links Rápidos</h4>
                    <ul class="footer-links">
                        <li><a href="/">Início</a></li>
                        <li><a href="/sobre">Sobre Nós</a></li>
                        <li><a href="/servicos">Serviços</a></li>
                        <li><a href="/especialidades">Especialidades</a></li>
                        <li><a href="/equipa">Nossa Equipa</a></li>
                    </ul>
                </div>

               

                <!-- Contacto -->
                <div class="footer-section">
                    <h4 class="footer-title">Contacto</h4>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Municipio do Kilamba Kiaxi-Luanda<br>Golf2 vila Estoril, Angola</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>+244 939789797</span>
                            <span>+244 943500700</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>geral@clinicaestoril.Angola</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>24h / 7 dias por semana</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Clínica Estoril. Todos os direitos reservados.</p>
                <div class="footer-bottom-links">
                    <a href="#">Política de Privacidade</a>
                    <span>|</span>
                    <a href="#">Termos de Uso</a>
                </div>
            </div>
        </div>
    </footer>
    <div id="custom-alert" class="custom-alert hidden">
        <div class="custom-alert-box">
            <p id="custom-alert-text"></p>
            <button onclick="fecharAlert()">Ok</button>
        </div>
        </div>
    
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
        erro.textContent = "As senhas não coincidem ";
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
</script>
</body>

</html>
