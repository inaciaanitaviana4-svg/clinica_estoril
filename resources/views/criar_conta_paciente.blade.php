<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toastify.min.css') }}" />
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
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
                        <div style="text-align:center; margin-bottom:20px;">

</div>
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
                            <label for="cidade">Província</label>
                            <select id="cidade" name="cidade">
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
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" name="bairro" placeholder="Ex.: Golf 2" maxlength="20" required>
                            <span id="bairroErro" class="erro"></span>
                        </div>
                        <div class="form-group">
                            <label for="morada">Rua/Morada</label>
                            <input id="morada" name="morada" placeholder="Digite o nome da sua rua" maxlength="20" required>
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
                    <a href="/politica_seguranca">Política de Privacidade</a>
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
function previewImagem(event){

    const input = event.target;
    const preview = document.getElementById('preview-foto');

    if(input.files && input.files[0]){

        const reader = new FileReader();

        reader.onload = function(e){
            preview.src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// ===================== REGEX =====================

// ===================== REGEX =====================

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



</script>
</body>

</html>
