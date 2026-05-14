<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clínica Estoril - A sua saude nas melhores mãos ">
    <title>Clínica Estoril - @yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('all.min.css') }}">
     <link rel="stylesheet" href="{{ asset('chatbot.css') }}">
     <link rel="stylesheet" href="{{ asset('blog.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toastify.min.css') }}" />
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Nunito:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('assets/icons/bootstrap-icons.css') }}" />
    @yield('estilo')
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

            <!-- Navegação Desktop -->
            <nav class="nav-menu">
                <a href="/" class="nav-link">Início</a>
                <a href="/sobre" class="nav-link">Sobre</a>
                <a href="/servicos" class="nav-link">Serviços</a>
                <a href="/especialidades" class="nav-link">Especialidades</a>
                <a href="/equipa" class="nav-link">Equipa</a>
                <a href="/contacto" class="nav-link">Contacto</a>
                <a href="/blog" class="nav-link">Blog</a>
            </nav>

            <!-- Botão de Login / Avatar (desktop + mobile) -->
            @if (session('id_utilizador'))
                @php
                    $utilizador_logado = \App\Models\Utilizador::find(session('id_utilizador'));
                    $link_painel = match(session('tipo_utilizador')) {
                        'admi'          => '/admin/dashboard',
                        'recepcionista' => route('mostrar_consultas_recepcionista'),
                        'medico'        => route('mostrar_consultas_medico'),
                        'paciente'      => '/painel-paciente/dashboard',
                        default         => '/'
                    };
                @endphp
                <a href="{{ $link_painel }}" class="btn-login btn-login--avatar" title="Ir para o painel">
                    @if ($utilizador_logado && $utilizador_logado->foto)
                        <img src="{{ $utilizador_logado->foto_url }}" alt="Foto de perfil" class="btn-login__foto">
                    @else
                        <span class="btn-login__iniciais">
                            {{ strtoupper(substr($utilizador_logado->nome ?? 'U', 0, 1)) }}
                        </span>
                    @endif
                    <span class="btn-login__label">
                        @if (session('tipo_utilizador') == 'admi') Dashboard
                        @elseif (session('tipo_utilizador') == 'recepcionista') Agendamentos
                        @elseif (session('tipo_utilizador') == 'medico') Consultas
                        @else Consultas
                        @endif
                    </span>
                </a>
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

    <!-- Menu Mobile (só links de navegação, sem botão de acesso) -->
    <div class="mobile-menu">
        <a href="/" class="mobile-link">Início</a>
        <a href="/sobre" class="mobile-link">Sobre</a>
        <a href="/servicos" class="mobile-link">Serviços</a>
        <a href="/especialidades" class="mobile-link">Especialidades</a>
        <a href="/equipa" class="mobile-link">Equipa</a>
        <a href="/contacto" class="mobile-link">Contacto</a>
        <a href="/blog" class="mobile-link">Blog</a>
    </div>
</header>
           
<button id="chat-fab" aria-label="Abrir assistente virtual Clínica Estoril">
  <i class="bi bi-chat-dots-fill"></i>
  <div class="fab-badge"></div>
</button>

<div id="chat-window" role="dialog" aria-label="Assistente Virtual Clínica Estoril">
  <div class="chat-header">
    <div class="header-avatar"><i class="bi bi-hospital-fill"></i></div>
    <div class="header-info">
      <h3>Clínica Estoril</h3>
      <div class="status"><span class="online-dot"></span>Assistente Virtual &middot; Online agora</div>
    </div>
    <button id="close-chat" aria-label="Fechar"><i class="bi bi-x-lg"></i></button>
  </div>

  <div class="chat-context">
    <i class="bi bi-geo-alt-fill"></i>
    Bairro Golf 2, Vila Estoril &middot; Kilamba Kiaxi, Luanda, Angola
  </div>

  <div id="chat-messages"></div>
  <div class="options-wrap" id="options-wrap"></div>

  <div class="chat-input-wrap">
    <input id="chat-input" type="text" placeholder="Escreva a sua mensagem…" autocomplete="on" aria-label="Mensagem"/>
    <button id="send-btn" aria-label="Enviar"><i class="bi bi-send-fill"></i></button>
  </div>

  <div class="chat-footer">Assistente da <span>Clínica Estoril</span> &mdash; Luanda, Angola</div>
</div>

    @yield('conteudo')

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

                <!-- Especialidades -->
                

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
                            <span>+244 943500700</span>
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
                    <a href="/politica_seguranca">Política de Privacidade</a>
                    <span>|</span>
                    <a href="/termos-uso">Termos de Uso</a>
                    <span>|</span>

                </div>
            </div>
    </footer>

    <!-- Botão Voltar ao Topo -->
    <button class="back-to-top" id="backToTop" aria-label="Voltar ao topo">
        <i class="fas fa-arrow-up"></i>
    </button>
    <script src="{{ asset('script.js') }}"></script>
    <script src="{{ asset('chatbot.js') }}"></script>
    <script src="{{ asset('auth.js') }}"></script>
    <script src="{{ asset('main.js') }}"></script>
    @yield('script')
    <script>
        const url = window.location.pathname
        const menus = document.getElementsByClassName("nav-link")

        for (let i = 0; i < menus.length; i++) {
            const menu = menus.item(i)
            menu.classList.remove("active")
            const href = menu.getAttribute("href")
            if (href === '/' && url === '/') {
                menu.classList.add("active")
            } else if (url.startsWith(href) && href !== '/') {
                menu.classList.add("active")
            }
        }

   </script>
   
<script>

</script>
</body>

</html>