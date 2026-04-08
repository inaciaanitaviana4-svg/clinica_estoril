
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
    </style>
</head>

<body>
    <header class="header header-simple">
        <div class="containe">
           <div class="container">
            <div class="nav-wrapper">
                <!-- Logo -->
                <a href="/">
                    <div class="logo">
                        <img src="imagem/logo.jpg" alt="logotipo da clinica">
                        <span>Clínica Estoril</span>
                    </div>
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
                                required><span id="nomeErro" class="erro"></span>
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
                            <input type="password" id="senha" name="senha" placeholder="**********" maxlength="8" required>
                            <span id="senhaErro" class="erro"></span>
                        </div>
                        <div class="form-group">
                            <label for="confirmar_senha">Confirmar senha</label>
                            <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="**********" maxlength="8"
                                required><span id="confirmarSenhaErro" class="erro"></span>
                        </div>

                        <div class="form-group">
                            <label for="data_nascimento">Data de Nascimento</label>
                            <input type="date" id="data_nascimento" name="data_nascimento" required><span id="dataErro" class="erro"></span>
                        </div>
                        <div class="form-group">
                            <label for="num_bi">Número do Bilhete de Identidade</label>
                            <input type="text" id="num_bi" name="num_bi" placeholder="007484030LA045" 
                                required><span id="biErro" class="erro"></span>
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
<script>
 // REGEX
const nomeRegex = /^[A-ZÀ-Ü][a-zà-ü]+( [A-ZÀ-Ü][a-zà-ü]+)+$/;
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
        erro.textContent = "Nome inválido ";
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
        erro.textContent = "Email inválido ";
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
        erro.textContent = "Telefone inválido ";
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

    if (!biRegex.test(input.value)) {
        input.classList.add("invalido");
        erro.textContent = "BI inválido ";
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
    let hoje = new Date();

    if (!valor) {
        erro.textContent = "Campo obrigatório";
        return false;
    }

    let data = new Date(valor);

    if (data > hoje) {
        erro.textContent = "Data futura não permitida ";
        return false;
    }

    erro.textContent = "✓ Válido";
    erro.className = "sucesso";
    input.classList.add("valido");
    return true;
}

// Senha
function validarSenha() {
    let input = document.getElementById("senha");
    let erro = document.getElementById("senhaErro");

    if (!senhaRegex.test(input.value)) {
        input.classList.add("invalido");
        erro.textContent = "Senha deve ter 6 a 10 caracteres, deve conter uma letra maiúscula e  número ";
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
        erro.textContent = "As senhas não coincidem ❌";
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
        alert("Corrija os erros antes de enviar.");
    } else {
        alert("Formulário válido!");
    }

});
</script>
</body>

</html>