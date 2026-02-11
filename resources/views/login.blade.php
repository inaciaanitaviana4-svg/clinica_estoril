<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Área de Acesso - Clínica Estoril">
    <title>Acesso - Clínica Estoril</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="login-page">
    <!-- HEADER SIMPLIFICADO -->
    <header class="header header-simple">
        <div class="container">
            <div class="nav-wrapper">
                <a href="/" class="logo">
                    <img src="imagem/logo.jpg" alt="logotipo da clínica">
                    <span>Clínica Estoril</span>
                </a>

                <a href="/" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    <span>pagina inicial</span>
                </a>
            </div>
        </div>
    </header>

    <!-- ÁREA DE LOGIN -->
    <section class="login-section">
        <div class="login-container">
            <!-- Seleção de Tipo de Usuário -->
            <div class="login-card" id="userTypeCard">
                
                <div class="login-header">
                    <h1>Área de Acesso</h1>
                    <p>Faça o seu login</p>
                </div>
                <div>  
                {{ session("erro") }}
                </div>
                 <form method="post" action="/login">
                     {{ csrf_field() }}
                    <div class="form-group">
                    <label for="numero-email">
                        <i class="fas fa-envelope"></i>
                        Email ou número de telefone
                    </label>
                    <input type="text" id="email" name="email" required placeholder="Digite seu email">
                    </div>
                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock"></i>
                            Senha
                        </label>
                        <div class="password-input">
                            <input type="password" id="password" name="password" required placeholder="Digite sua senha">
                            <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            <span>Lembrar-me</span>
                        </label>
                        <a  href="recuperar_senha.html" class="forgot-password">Esqueci a senha</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-sign-in-alt"></i>
                        Entrar
                    </button>
                    <div class="login-footer">
                        <p>Já tem uma conta? <a href="/criar-conta-paciente">Criar conta</a></p>
                       
                    </div>
                
              
                </form>
            </div>
        </div>

        <!-- Informações de Ajuda -->
        <div class="login-help">
            <div class="help-card">
                <i class="fas fa-question-circle"></i>
                <h3>Precisa de Ajuda?</h3>
                <p>Entre em contacto com o nosso suporte</p>
                <a href="/contacto">Contactar Suporte</a>
            </div>
        </div>
    </section>

    <!-- FOOTER SIMPLIFICADO -->
    <footer  class="footer">
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
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
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

                <!-- Especialidades -->
                <div class="footer-section">
                    <h4 class="footer-title">Especialidades</h4>
                    <ul class="footer-links">
                        <li><a href="/especialidades">Cardiologia</a></li>
                        <li><a href="/especialidades">Neurologia</a></li>
                        <li><a href="/especialidades">Ortopedia</a></li>
                        <li><a href="/especialidades">Pediatria</a></li>
                        <li><a href="/especialidades">Ginecologia</a></li>
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
                            <span>geral@clinicaestoril.AO</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>24h / 7 dias por semana</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 Clínica Estoril. Todos os direitos reservados.</p>
                <div class="footer-bottom-links">
                    <a href="#">Política de Privacidade</a>
                    <span>|</span>
                    <a href="#">Termos de Uso</a>
                    <span>|</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- <script src="script.js"></script> -->
    <script>
        // Funções específicas da página de login
        function showLogin(userType) {
            // Esconde a seleção de tipo de usuário
            document.getElementById('userTypeCard').style.display = 'none';
            
            // Mostra o formulário correspondente
            document.getElementById(userType + 'Form').style.display = 'block';
        }

        function backToUserTypes() {
            // Esconde todos os formulários
            document.getElementById('pacienteForm').style.display = 'none';
            document.getElementById('recepcionistaForm').style.display = 'none';
            document.getElementById('administradorForm').style.display = 'none';
            
            // Mostra a seleção de tipo de usuário
            document.getElementById('userTypeCard').style.display = 'block';
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const button = input.parentElement.querySelector('.toggle-password i');
            
            if (input.type === 'password') {
                input.type = 'text';
                button.classList.remove('fa-eye');
                button.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                button.classList.remove('fa-eye-slash');
                button.classList.add('fa-eye');
            }
        }


// Sistema de Autenticação e Gerenciamento de Usuários

</script>
</body>
</html>
