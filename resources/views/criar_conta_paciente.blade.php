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
                   <form method="post" action="/cadastrar-paciente" id="formulario"
      enctype="multipart/form-data">
    {{ csrf_field() }}
                        <div style="display:flex; flex-direction:column; align-items:center; margin-bottom:28px;">
    <label for="foto" id="foto-label" style="
        position:relative; width:110px; height:110px; border-radius:50%;
        cursor:pointer; overflow:hidden; border:3px dashed #a0aec0;
        background:#f0f4f8; display:flex; align-items:center;
        justify-content:center; transition:border-color 0.2s;"
        onmouseover="this.style.borderColor='#0066cc';document.getElementById('foto-overlay').style.opacity='1'"
        onmouseout="this.style.borderColor='#a0aec0';document.getElementById('foto-overlay').style.opacity='0'">

        <img id="foto-preview" src="" alt="Foto"
             style="display:none; width:100%; height:100%;
                    object-fit:cover; border-radius:50%;">

        <i id="foto-icon" class="fa-solid fa-circle-user"
           style="font-size:58px; color:#a0aec0;"></i>

             <div id="foto-overlay" style="
            position:absolute; inset:0; background:rgba(0,0,0,0.38);
            border-radius:50%; display:flex; align-items:center;
            justify-content:center; opacity:0; transition:opacity 0.2s;
            pointer-events:none;">
            <i class="fa-solid fa-camera" style="color:white; font-size:22px;"></i>
        </div>
    </label>
    <input type="file" id="foto" name="foto" accept="image/*" style="display:none">
    <span style="margin-top:8px; font-size:13px; color:#718096;">
        Clique para adicionar foto (opcional)
    </span>
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

                        {{-- TERMOS DE USO — adiciona antes do botão submit --}}
<div class="form-group" style="margin-top: 20px;">
    <div style="
        border: 1px solid #cbd5e0;
        border-radius: 8px;
        padding: 16px;
        background: #f7fafc;
        max-height: 180px;
        overflow-y: auto;
        font-size: 13px;
        color: #4a5568;
        line-height: 1.6;
        margin-bottom: 12px;">

        <strong style="display:block; margin-bottom:8px; color:#2d3748; font-size:14px;">
            Termos de Uso — Clínica Estoril
        </strong>

        <strong>1. Aceitação dos Termos</strong><br>
        Ao criar uma conta na plataforma da Clínica Estoril, o utilizador declara ter lido,
        compreendido e aceite os presentes Termos de Uso e a Política de Privacidade.
        <br><br>

        <strong>2. Uso da Plataforma</strong><br>
        A plataforma destina-se exclusivamente à gestão de consultas médicas, comunicação
        entre pacientes e profissionais de saúde, e acesso a registos clínicos pessoais.
        É proibido o uso da plataforma para fins ilícitos, fraudulentos ou que causem
        dano a terceiros.
        <br><br>

        <strong>3. Dados Pessoais e Privacidade</strong><br>
        Os seus dados pessoais e informações de saúde são tratados com total
        confidencialidade, em conformidade com a legislação angolana de proteção de dados.
        A Clínica Estoril não partilha os seus dados com terceiros sem o seu consentimento,
        exceto quando exigido por lei ou para prestação direta dos serviços médicos.
        <br><br>

        <strong>4. Responsabilidades do Utilizador</strong><br>
        O utilizador é responsável por manter as suas credenciais de acesso em segurança
        e por fornecer informações verdadeiras e atualizadas. Informações falsas podem
        resultar no cancelamento da conta.
        <br><br>

        <strong>5. Agendamento e Cancelamento de Consultas</strong><br>
        O utilizador pode agendar e cancelar consultas através da plataforma.
        Cancelamentos devem ser efetuados com antecedência mínima de 24 horas.
        A clínica reserva o direito de reagendar consultas em casos de força maior.
        <br><br>

        <strong>6. Propriedade Intelectual</strong><br>
        Todo o conteúdo da plataforma, incluindo textos, imagens e software, é propriedade
        da Clínica Estoril e está protegido por direitos de autor. É proibida a reprodução
        sem autorização expressa.
        <br><br>

        <strong>7. Limitação de Responsabilidade</strong><br>
        A Clínica Estoril não se responsabiliza por falhas técnicas temporárias,
        interrupções de serviço por causas externas ou uso indevido da plataforma
        por parte do utilizador.
        <br><br>

        <strong>8. Alterações aos Termos</strong><br>
        A Clínica Estoril reserva o direito de atualizar estes Termos de Uso.
        Os utilizadores serão notificados de alterações significativas.
        O uso continuado da plataforma após as alterações implica a sua aceitação.
        <br><br>

        <strong>9. Contacto</strong><br>
        Para questões relacionadas com estes termos, contacte-nos através de
        geral@clinicaestoril.AO ou pelo telefone +244 939 789 797.
    </div>

    {{-- Checkbox de aceitação --}}
    <label style="
        display: flex;
        align-items: flex-start;
        gap: 10px;
        cursor: pointer;
        font-size: 14px;
        color: #2d3748;">
        <input type="checkbox"
               id="aceitar_termos"
               name="aceitar_termos"
               style="
                   width: 18px;
                   height: 18px;
                   margin-top: 2px;
                   cursor: pointer;
                   flex-shrink: 0;
                   accent-color: #0066cc;">
        <span>
            Li e aceito os <strong>Termos de Uso</strong> e a
            <a href="/politica_seguranca" target="_blank"
               style="color: #0066cc; text-decoration: underline;">
               Política de Privacidade
            </a>
            da Clínica Estoril.
        </span>
    </label>
    <span id="termosErro" class="erro" style="display:block; margin-top:6px;"></span>
</div>

<button type="submit" class="btn btn-primary btn-full" id="btn-submit" disabled
        style="opacity: 0.5; cursor: not-allowed; transition: opacity 0.2s;">
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
                    <a href="/termos-uso">Termos de Uso</a>
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
// Ativa/desativa o botão conforme o checkbox
const checkboxTermos = document.getElementById('aceitar_termos');
const btnSubmit      = document.getElementById('btn-submit');

checkboxTermos.addEventListener('change', function () {
    if (this.checked) {
        btnSubmit.disabled = false;
        btnSubmit.style.opacity = '1';
        btnSubmit.style.cursor  = 'pointer';
        document.getElementById('termosErro').textContent = '';
    } else {
        btnSubmit.disabled = true;
        btnSubmit.style.opacity = '0.5';
        btnSubmit.style.cursor  = 'not-allowed';
    }
});
</script>
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

function validarTermos() {
    const checkbox = document.getElementById('aceitar_termos');
    const erro     = document.getElementById('termosErro');

    if (!checkbox.checked) {
        erro.textContent = 'Deve aceitar os Termos de Uso para continuar.';
        erro.className   = 'erro';
        return false;
    }
    erro.textContent = '';
    return true;
}

document.getElementById("formulario").addEventListener("submit", function (e) {
    let valido =
        validarNome()           &&
        validarEmail()          &&
        validarTelefone()       &&
        validarBI()             &&
        validarData()           &&
        validarBairro()         &&
        validarSenha()          &&
        validarConfirmarSenha() &&
        validarTermos();        // ← NOVO

    if (!valido) {
        e.preventDefault();
        mostrarAlert("Corrija os erros antes de enviar.");
    }
});




</script>
</body>

</html>
