<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clínica Estoril - A sua saude nas melhores mãos ">
    <title>Clínica Estoril - @yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toastify.min.css') }}" />
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
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

                <!-- Navegação Desktop   active -->
                <nav class="nav-menu">
                    <a href="/" class="nav-link ">Início</a>
                    <a href="/sobre" class="nav-link ">Sobre</a>
                    <a href="/servicos" class="nav-link">Serviços</a>
                    <a href="/especialidades" class="nav-link">Especialidades</a>
                    <a href="/equipa" class="nav-link">Equipa</a>
                    <a href="/contacto" class="nav-link">Contacto</a>
                    <a href="/blog" class="nav-link">Blog</a>

                </nav>

                <!-- Botão de Login -->
                @if (session('id_utilizador'))
                    <div style="display: flex; align-items: center; gap:8px;">
                        @if (session('tipo_utilizador') == 'admi')
                            <a href="/admin/dashboard" class="btn-login">
                                <span>Dashboard</span>
                            </a>
                        @endif
                        @if (session('tipo_utilizador') == 'recepcionista')
                            <a href="{{ route('mostrar_dashboard_recepcionista') }}" class="btn-login">
                                <span>Dashboard</span>
                            </a>
                        @endif
                        @if (session('tipo_utilizador') == 'medico')
                            <a href= "{{ route('mostrar_dashboard_medico') }}" class="btn-login">
                                <span>Dashboard</span>
                            </a>
                        @endif
                        @if (session('tipo_utilizador') == 'paciente')
                            <a href="{{ route('mostrar_dashboard_paciente') }}" class="btn-login">
                                <span>Dashboard</span>
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
            <a href="/" class="mobile-link ">Início</a>
            <a href="/sobre" class="mobile-link">Sobre</a>
            <a href="/servicos" class="mobile-link">Serviços</a>
            <a href="/especialidades" class="mobile-link">Especialidades</a>
            <a href="/equipa" class="mobile-link">Equipa</a>
            <a href="/contacto" class="mobile-link">Contacto</a>
            <a href="/blog" class="mobile-link">Blog</a>

        </div>
    </header>

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
    <script src="{{ asset('script.js') }}"></script>
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


</body>

  <!-- ============================================================
       ESTILOS GERAIS DA PÁGINA DE DEMONSTRAÇÃO
       ============================================================ -->
  <style>
   

    /* ============================================================
       BOTÃO FLUTUANTE (ícone circular)
       ============================================================ */
    #chat-toggle {
      position: fixed;
      bottom: 28px;
      right: 28px;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: #1a5fa8;          /* azul principal */
      border: none;
      cursor: pointer;
      box-shadow: 0 4px 16px rgba(26,95,168,.45);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      transition: background .2s, transform .15s;
    }
    #chat-toggle:hover  { background: #1450900; transform: scale(1.07); }
    #chat-toggle:active { transform: scale(.96); }

    /* SVG do ícone de chat dentro do botão */
    #chat-toggle svg { width: 30px; height: 30px; fill: #fff; }

    /* Ponto de notificação vermelho (visível antes de abrir) */
    #notif-dot {
      position: absolute;
      top: 4px; right: 4px;
      width: 13px; height: 13px;
      background: #e53935;
      border-radius: 50%;
      border: 2px solid #fff;
    }

    /* ============================================================
       JANELA DO CHAT
       ============================================================ */
    #chat-window {
      position: fixed;
      bottom: 100px;
      right: 28px;
      width: 360px;
      max-height: 540px;
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 8px 32px rgba(26,95,168,.22);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      z-index: 999;
      /* começa oculto */
      opacity: 0;
      pointer-events: none;
      transform: translateY(20px) scale(.97);
      transition: opacity .25s, transform .25s;
    }

    /* Estado visível */
    #chat-window.open {
      opacity: 1;
      pointer-events: all;
      transform: translateY(0) scale(1);
    }

    /* ---- Cabeçalho azul ---- */
    .chat-header {
      background: #1a5fa8;
      color: #fff;
      padding: 14px 18px;
      display: flex;
      align-items: center;
      gap: 10px;
      flex-shrink: 0;
    }
    .chat-header .avatar {
      width: 38px; height: 38px;
      border-radius: 50%;
      background: #fff;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .chat-header .avatar svg { width: 22px; height: 22px; fill: #1a5fa8; }
    .chat-header .info h2 { font-size: .95rem; font-weight: 600; }
    .chat-header .info p  { font-size: .75rem; opacity: .85; }
    /* Botão fechar (X) no canto */
    .btn-close {
      margin-left: auto;
      background: none;
      border: none;
      color: #fff;
      cursor: pointer;
      font-size: 1.3rem;
      line-height: 1;
      padding: 2px 6px;
      border-radius: 6px;
      transition: background .15s;
    }
    .btn-close:hover { background: rgba(255,255,255,.2); }

    /* ---- Área de mensagens ---- */
    .chat-body {
      flex: 1;
      overflow-y: auto;
      padding: 16px 14px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      background: #f5f8fd;
    }
    /* Barra de scroll discreta */
    .chat-body::-webkit-scrollbar { width: 5px; }
    .chat-body::-webkit-scrollbar-thumb { background: #b0c8e8; border-radius: 4px; }

    /* ---- Bolhas de mensagem ---- */
    .msg {
      max-width: 85%;
      padding: 10px 14px;
      border-radius: 16px;
      font-size: .88rem;
      line-height: 1.5;
      word-break: break-word;
    }
    /* Bot: alinhado à esquerda, fundo azul claro */
    .msg.bot {
      background: #e3edf8;
      color: #1a3a5c;
      align-self: flex-start;
      border-bottom-left-radius: 4px;
    }
    /* Usuário: alinhado à direita, azul principal */
    .msg.user {
      background: #1a5fa8;
      color: #fff;
      align-self: flex-end;
      border-bottom-right-radius: 4px;
    }

    /* ---- Lista de assuntos (menu) ---- */
    .topics-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 7px;
      margin-top: 4px;
    }
    .topics-list li button {
      width: 100%;
      text-align: left;
      background: #fff;
      border: 1.5px solid #1a5fa8;
      color: #1a5fa8;
      border-radius: 10px;
      padding: 9px 14px;
      font-size: .85rem;
      cursor: pointer;
      transition: background .15s, color .15s;
      font-family: inherit;
      font-weight: 500;
    }
    .topics-list li button:hover {
      background: #1a5fa8;
      color: #fff;
    }

    /* ---- Botão "Voltar" ---- */
    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: none;
      border: 1.5px solid #1a5fa8;
      color: #1a5fa8;
      border-radius: 10px;
      padding: 7px 14px;
      font-size: .82rem;
      cursor: pointer;
      font-family: inherit;
      margin-top: 6px;
      transition: background .15s, color .15s;
    }
    .btn-back:hover { background: #1a5fa8; color: #fff; }

    /* ---- Rodapé / input ---- */
    .chat-footer {
      padding: 10px 12px;
      background: #fff;
      border-top: 1px solid #dce8f7;
      display: flex;
      gap: 8px;
      flex-shrink: 0;
    }
    .chat-footer input {
      flex: 1;
      border: 1.5px solid #b0c8e8;
      border-radius: 10px;
      padding: 9px 12px;
      font-size: .85rem;
      outline: none;
      font-family: inherit;
      color: #1a3a5c;
      background: #f5f8fd;
      transition: border-color .15s;
    }
    .chat-footer input:focus { border-color: #1a5fa8; }
    .chat-footer button {
      background: #1a5fa8;
      border: none;
      border-radius: 10px;
      width: 40px; height: 40px;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      transition: background .15s;
    }
    .chat-footer button:hover  { background: #14508a; }
    .chat-footer button svg { width: 18px; height: 18px; fill: #fff; }

    /* ---- Responsivo para ecrãs pequenos ---- */
    @media (max-width: 420px) {
      #chat-window { width: calc(100vw - 24px); right: 12px; }
    }
  </style>
</head>
<body>

<!-- ============================================================
     BOTÃO FLUTUANTE
     ============================================================ -->
<button id="chat-toggle" aria-label="Abrir chat de apoio">
  <!-- Ícone de balão de conversa -->
  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M20 2H4C2.9 2 2 2.9 2 4v18l4-4h14c1.1 0 2-.9
             2-2V4c0-1.1-.9-2-2-2zm0 12H6l-2 2V4h16v10z"/>
  </svg>
  <!-- Ponto vermelho de notificação -->
  <span id="notif-dot"></span>
</button>


<!-- ============================================================
     JANELA DO CHAT
     ============================================================ -->
<div id="chat-window" role="dialog" aria-label="Chat de apoio Clínica Estoril">

  <!-- Cabeçalho -->
  <div class="chat-header">
    <div class="avatar">
      <!-- Ícone de cruz médica / clínica -->
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M19 3H5C3.9 3 3 3.9 3 5v14c0 1.1.9 2 2 2h14c1.1
                 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
      </svg>
    </div>
    <div class="">
      <h2>Clínica Estoril</h2>
      <p>Assistente Virtual • Online</p>
    </div>
    <button class="btn-close" id="btn-close" aria-label="Fechar chat">✕</button>
  </div>

  <!-- Área de mensagens -->
  <div class="chat-body" id="chat-body">
    <!-- As mensagens serão injetadas via JavaScript -->
  </div>

  <!-- Rodapé com campo de texto -->
  <div class="chat-footer">
    <input type="text" id="user-input"
           placeholder="Escreva uma mensagem…"
           aria-label="Campo de mensagem" />
    <button id="btn-send" aria-label="Enviar mensagem">
      <!-- Ícone de enviar -->
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
      </svg>
    </button>
  </div>

</div><!-- /#chat-window -->


<!-- ============================================================
     JAVASCRIPT  –  Toda a lógica do chatbot
     ============================================================ -->
<script>
  /* ----------------------------------------------------------
     1. DADOS DOS ASSUNTOS
        Cada tópico tem: label (texto do botão), title (título
        da resposta) e content (HTML ou texto da resposta).
     ---------------------------------------------------------- */
  const topics = [
    {
      id: 'horarios',
      label: '🕐 Horários',
      title: 'Horários de Funcionamento',
      content: `
        <strong>Segunda a Sexta:</strong> 08h00 – 20h00<br>
        <strong>Sábados:</strong> 08h00 – 14h00<br>
        <strong>Domingos e Feriados:</strong> Encerrado<br><br>
        Para urgências fora do horário consulte a secção <em>Urgências</em>.
      `
    },
    {
      id: 'localizacao',
      label: '📍 Localização',
      title: 'Localização',
      content: `
        <strong>Morada:</strong><br>
        Av. do Estoril, nº 123, 2765-000 Estoril, Portugal<br><br>
        <strong>Como chegar:</strong><br>
        • Comboio: Linha de Cascais – Estação do Estoril (5 min a pé)<br>
        • Autocarro: Carris Metropolitana, linha 417<br>
        • Carro: Estacionamento gratuito disponível
      `
    },
    {
      id: 'contactos',
      label: '📞 Contactos',
      title: 'Contactos',
      content: `
        <strong>Telefone:</strong> +351 214 000 000<br>
        <strong>WhatsApp:</strong> +351 912 000 000<br>
        <strong>Email:</strong> geral@clinicaestoril.pt<br>
        <strong>Site:</strong> www.clinicaestoril.pt<br><br>
        Estamos disponíveis no horário de funcionamento para responder às suas dúvidas.
      `
    },
    {
      id: 'especialidades',
      label: '🩺 Especialidades',
      title: 'Especialidades Médicas',
      content: `
        Oferecemos as seguintes especialidades:<br><br>
        • Medicina Geral e Familiar<br>
        • Cardiologia<br>
        • Dermatologia<br>
        • Endocrinologia<br>
        • Ginecologia e Obstetrícia<br>
        • Ortopedia<br>
        • Pediatria<br>
        • Psicologia e Psiquiatria<br>
        • Neurologia<br>
        • Oftalmologia
      `
    },
    {
      id: 'agendar',
      label: '📅 Como Agendar Consulta',
      title: 'Como Agendar Consulta',
      content: `
        Pode agendar a sua consulta de três formas:<br><br>
        <strong>1. Online</strong> – Aceda ao nosso site, faça login e escolha especialidade, médico e horário disponível.<br><br>
        <strong>2. Telefone</strong> – Ligue para <strong>+351 214 000 000</strong> durante o horário de funcionamento.<br><br>
        <strong>3. Presencialmente</strong> – Dirija-se à receção e a nossa equipa irá ajudá-lo a marcar.
      `
    },
    {
      id: 'cancelamento',
      label: '🔄 Cancelamento / Reagendamento',
      title: 'Cancelamento e Reagendamento',
      content: `
        <strong>Cancelamento:</strong><br>
        Para cancelar, contacte-nos com pelo menos <strong>24 horas de antecedência</strong> para evitar taxa de cancelamento tardio.<br><br>
        <strong>Reagendamento:</strong><br>
        Pode reagendar a sua consulta sem custos através do nosso site, telefone ou WhatsApp.<br><br>
        <strong>Política de faltas:</strong> Após 2 faltas sem aviso, poderá ser solicitado pagamento antecipado para futuras marcações.
      `
    },
    {
      id: 'pagamentos',
      label: '💳 Pagamentos',
      title: 'Pagamentos',
      content: `
        Aceitamos os seguintes meios de pagamento:<br><br>
        • Dinheiro<br>
        • Multibanco / Débito direto<br>
        • Cartões Visa, Mastercard e American Express<br>
        • MB Way<br>
        • Seguros de saúde: Médis, Multicare, AdvanceCare, Fidelidade e outros (verificar na receção)<br><br>
        O pagamento é efetuado no final de cada consulta ou ato clínico.
      `
    },
    {
      id: 'urgencias',
      label: '🚨 Urgências',
      title: 'Urgências',
      content: `
        <strong>Linha de urgência:</strong> <strong>+351 214 000 999</strong> (24h/7 dias)<br><br>
        Em situações de risco de vida, ligue imediatamente para o <strong>112</strong>.<br><br>
        A clínica dispõe de serviço de urgência para situações não graves durante o horário de funcionamento. Para urgências fora do horário, recomendamos o Hospital de Cascais (15 min).
      `
    },
    {
      id: 'exames',
      label: '🔬 Exames / Laboratório',
      title: 'Exames e Laboratório',
      content: `
        <strong>Tipos de exames disponíveis:</strong><br><br>
        • Análises clínicas (sangue, urina, fezes)<br>
        • Eletrocardiograma (ECG)<br>
        • Ecografia geral e obstétrica<br>
        • Radiografia (RX)<br>
        • Densitometria óssea<br><br>
        <strong>Colheitas:</strong> Seg. a Sex. das 07h30 às 10h30 (em jejum)<br><br>
        Os resultados ficam disponíveis no portal do paciente em 24 a 48 horas úteis.
      `
    },
    {
      id: 'login',
      label: '👤 Login e Cadastro',
      title: 'Login e Cadastro no Portal',
      content: `
        <strong>Como fazer Cadastro:</strong><br>
        1. Aceda a <em>www.clinicaestoril.pt</em><br>
        2. Clique em "Criar conta"<br>
        3. Preencha os dados pessoais e o nº de utente do SNS<br>
        4. Confirme o email recebido na caixa de correio<br><br>
        <strong>Como fazer Login:</strong><br>
        1. Clique em "Entrar" no canto superior direito do site<br>
        2. Insira o seu email e palavra-passe<br>
        3. Se esqueceu a password, use a opção "Recuperar password"<br><br>
        Em caso de dificuldade contacte: suporte@clinicaestoril.pt
      `
    }
  ];

  /* ----------------------------------------------------------
     2. REFERÊNCIAS AOS ELEMENTOS DO DOM
     ---------------------------------------------------------- */
  const chatToggle  = document.getElementById('chat-toggle');
  const chatWindow  = document.getElementById('chat-window');
  const btnClose    = document.getElementById('btn-close');
  const chatBody    = document.getElementById('chat-body');
  const userInput   = document.getElementById('user-input');
  const btnSend     = document.getElementById('btn-send');
  const notifDot    = document.getElementById('notif-dot');

  /* ----------------------------------------------------------
     3. CONTROLO DE ABERTURA / FECHO DO CHAT
     ---------------------------------------------------------- */
  chatToggle.addEventListener('click', () => {
    const isOpen = chatWindow.classList.contains('open');
    if (isOpen) {
      closeChat();
    } else {
      openChat();
    }
  });

  btnClose.addEventListener('click', closeChat);

  function openChat() {
    chatWindow.classList.add('open');
    notifDot.style.display = 'none'; // remove ponto vermelho ao abrir
    // Se o chat ainda não tem mensagens, mostra a saudação inicial
    if (chatBody.children.length === 0) {
      showGreeting();
    }
    // Foca o campo de texto (acessibilidade)
    setTimeout(() => userInput.focus(), 250);
  }

  function closeChat() {
    chatWindow.classList.remove('open');
  }

  /* ----------------------------------------------------------
     4. ADICIONAR MENSAGENS NA BOLHA
        role: 'bot' | 'user'
        html: conteúdo pode ser HTML
     ---------------------------------------------------------- */
  function addMessage(html, role) {
    const div = document.createElement('div');
    div.className = `msg ${role}`;
    div.innerHTML = html;
    chatBody.appendChild(div);
    scrollToBottom();
    return div;
  }

  /* Rola para a última mensagem */
  function scrollToBottom() {
    chatBody.scrollTop = chatBody.scrollHeight;
  }

  /* ----------------------------------------------------------
     5. SAUDAÇÃO INICIAL COM LISTA DE ASSUNTOS
     ---------------------------------------------------------- */
  function showGreeting() {
    // Mensagem de boas-vindas
    addMessage(
      'Olá! 👋 Bem-vindo(a) ao assistente virtual da <strong>Clínica Estoril</strong>.<br>Como posso ajudar? Escolha um dos temas abaixo:',
      'bot'
    );
    // Lista de assuntos (menu)
    showTopicMenu();
  }

  /* Cria e exibe o menu com todos os tópicos */
  function showTopicMenu() {
    const wrapper = document.createElement('div');
    wrapper.className = 'msg bot';
    wrapper.style.padding = '8px 10px';

    const ul = document.createElement('ul');
    ul.className = 'topics-list';

    topics.forEach(topic => {
      const li = document.createElement('li');
      const btn = document.createElement('button');
      btn.textContent = topic.label;
      btn.dataset.id = topic.id;

      /* Ao clicar num assunto: */
      btn.addEventListener('click', () => {
        // Mostra o texto que o utilizador "escolheu" como mensagem de utilizador
        addMessage(topic.label, 'user');
        // Mostra a resposta do bot com botão de voltar
        showTopicContent(topic);
      });

      li.appendChild(btn);
      ul.appendChild(li);
    });

    wrapper.appendChild(ul);
    chatBody.appendChild(wrapper);
    scrollToBottom();
  }

  /* ----------------------------------------------------------
     6. MOSTRAR CONTEÚDO DE UM TÓPICO + BOTÃO VOLTAR
     ---------------------------------------------------------- */
  function showTopicContent(topic) {
    // Bolha com título e conteúdo
    addMessage(
      `<strong>${topic.title}</strong><br><br>${topic.content}`,
      'bot'
    );

    // Bolha com botão "Voltar ao menu"
    const backWrapper = document.createElement('div');
    backWrapper.className = 'msg bot';
    backWrapper.style.background = 'transparent';
    backWrapper.style.padding = '2px 0';

    const btnBack = document.createElement('button');
    btnBack.className = 'btn-back';
    btnBack.innerHTML = '← Voltar ao menu';

    btnBack.addEventListener('click', () => {
      // Simula mensagem do utilizador
      addMessage('← Voltar ao menu', 'user');
      // Exibe o menu novamente
      addMessage('Claro! Aqui estão os temas disponíveis:', 'bot');
      showTopicMenu();
    });

    backWrapper.appendChild(btnBack);
    chatBody.appendChild(backWrapper);
    scrollToBottom();
  }

  /* ----------------------------------------------------------
     7. ENVIO DE MENSAGEM PELO CAMPO DE TEXTO
        O bot verifica se o texto corresponde a algum tópico.
        Se sim, mostra o conteúdo. Caso contrário, devolve
        uma mensagem padrão com o menu.
     ---------------------------------------------------------- */
  function handleUserMessage() {
    const text = userInput.value.trim();
    if (!text) return;

    // Exibe a mensagem do utilizador
    addMessage(text, 'user');
    userInput.value = '';

    // Tenta encontrar um tópico pelo texto digitado (case-insensitive)
    const lower = text.toLowerCase();
    const found = topics.find(t =>
      lower.includes(t.id) ||
      lower.includes(t.label.replace(/[^a-záéíóúãõâêîôûàèìòùç ]/gi, '').toLowerCase().split(' ').slice(1).join(' '))
    );

    if (found) {
      // Resposta ligada ao tópico encontrado
      setTimeout(() => showTopicContent(found), 300);
    } else {
      // Resposta genérica + menu
      setTimeout(() => {
        addMessage(
          'Desculpe, só consigo responder a questões relacionadas com a Clínica Estoril. 🏥<br>Por favor escolha um dos temas abaixo:',
          'bot'
        );
        showTopicMenu();
      }, 300);
    }
  }

  /* Evento de clique no botão enviar */
  btnSend.addEventListener('click', handleUserMessage);

  /* Evento de tecla Enter no input */
  userInput.addEventListener('keydown', e => {
    if (e.key === 'Enter') handleUserMessage();
  });

  /* ----------------------------------------------------------
     8. MOSTRAR PONTO DE NOTIFICAÇÃO AO CARREGAR (simula
        mensagem pendente para atrair atenção do utilizador)
     ---------------------------------------------------------- */
  // O ponto vermelho já está visível por padrão (no HTML),
  // será removido ao abrir o chat (ver openChat).

</script>
</body>

</html>
