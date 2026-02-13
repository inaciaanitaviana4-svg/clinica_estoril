<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clínica Estoril - A sua saude nas melhores mãos ">
    <title>Clínica Estoril - @yield("titulo")</title>
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/toastify.min.css" />
    @yield("estilo")
</head>

<body>
    <!-- HEADER E NAVEGAÇÃO -->
    <header class="header">
        <div class="container">
            <div class="nav-wrapper">
                <!-- Logo -->
                <a href="/">
                    <div class="logo">
                        <img src="imagem/logo.jpg" alt="logotipo da clinica">
                        <span>Clínica Estoril</span>
                    </div>
                </a>

                <!-- Navegação Desktop   active -->
                <nav class="nav-menu">
                    <a href="/" class="nav-link">Início</a>
                    <a href="/sobre" class="nav-link">Sobre</a>
                    <a href="/servicos" class="nav-link">Serviços</a>
                    <a href="/especialidades" class="nav-link">Especialidades</a>
                    <a href="/equipa" class="nav-link">Equipa</a>
                    <a href="/contacto" class="nav-link">Contacto</a>
                    <a href="/blog" class="nav-link">Blog</a>
                    <a href="/chatbot" class="nav-link">Chat Bot</a>
                </nav>

                <!-- Botão de Login -->
                @if( session("id_utilizador"))
                <div style="display: flex; align-items: center; gap:8px;">
                    @if(session("tipo_utilizador")=="admi")
                    <a href="/admin/dashboard" class="btn-login">
                        <span>Dashboard</span>
                    </a>
                    @endif
                    @if(session("tipo_utilizador")=="recepcionista")
                    <a href="{{ route('mostrar_consultas_recepcionista') }}" class="btn-login">
                        <span>Agendamentos</span>
                    </a>
                    @endif
                    @if(session("tipo_utilizador")=="medico")
                    <a href= "{{ route('mostrar_consultas_medico') }}" class="btn-login">
                        <span>Consultas</span>
                        <a class="sidebar-menu-item" style="padding: 12px 16px; font-weight: 500; color:red;"
                        href="/sair"><strong>Sair</strong></a>
                    </a>
                    @endif
                    @if(session("tipo_utilizador")=="paciente")
                    <a href="/visualizar-perfil" class="btn-login">
                        <span>Perfil</span>
                    </a>
                    @endif
            
                </div>
                @else
                <a href="/login" class="btn-login">
                    <i class="fas fa-user"></i>
                    <span>Entrar</span>
                </a>
                @endif

                <!-- Menu Mobile Toggle -->
                <button class="mobile-menu-toggle" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="mobile-menu">
            <a href="/" class="mobile-link active">Início</a>
            <a href="/sobre" class="mobile-link">Sobre</a>
            <a href="/servicos" class="mobile-link">Serviços</a>
            <a href="/especialidades" class="mobile-link">Especialidades</a>
            <a href="/equipa" class="mobile-link">Equipa</a>
            <a href="/contacto" class="mobile-link">Contacto</a>
            <a href="/blog" class="nav-link">Blog</a>
            <a href="/chatbot" class="nav-link">Chat Bot</a>
        </div>
    </header>

    @yield("conteudo")

    <!-- FOOTER -->
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
                        <a href="https://www.facebook.com/c.estoril/" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/clinica_estoril?igsh=cXRuMzBwYW5oM2ti" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
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
                        <li class="phone">
                            <i class="fas fa-phone"></i>
                            <span>+244 939789797</span> |
                            <span> 943500700</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>geral@clinicaestoril.Ao</span>
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
                    <span>|</span>
                 
            </div>
        </div>
    </footer>

    <!-- Botão Voltar ao Topo -->
    <button class="back-to-top" id="backToTop" aria-label="Voltar ao topo">
        <i class="fas fa-arrow-up"></i>
    </button>
    @yield("script")
    <script src="/script.js"></script>
    <script src="/chatbot.js"></script>
    <script src="/auth.js"></script>
    <script src="/main.js"></script>
</body>

</html>
