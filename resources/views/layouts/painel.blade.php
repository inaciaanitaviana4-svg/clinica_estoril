<?php
$menus = [];

if (session('tipo_utilizador') == 'medico') {
    $menus = [
        ['href' => route('mostrar_dashboard_medico'),    'titulo' => 'Dashboard',    'icon' => 'fa-solid fa-gauge'],
        ['href' => route('mostrar_consultas_medico'),    'titulo' => 'Consultas',    'icon' => 'fa-solid fa-calendar-check'],
        ['href' => route('mostrar_prontuarios_medico'),  'titulo' => 'Prontuários',  'icon' => 'fa-solid fa-file-medical'],
        ['href' => route('mostrar_horarios_medico'),     'titulo' => 'Horários',     'icon' => 'fa-solid fa-clock'],
        ['href' => route('mostrar_relatorios_medico'),   'titulo' => 'Relatórios',   'icon' => 'fa-solid fa-file-alt'],
        ['href' => route('listar_minhas_notificacoes'),  'titulo' => 'Notificações', 'icon' => 'fa-solid fa-bell'],
    ];
}

if (session('tipo_utilizador') == 'recepcionista') {
    $menus = [
        ['href' => route('mostrar_dashboard_recepcionista'),  'titulo' => 'Dashboard',    'icon' => 'fa-solid fa-gauge'],
        ['href' => route('mostrar_consultas_recepcionista'),  'titulo' => 'Agendamentos', 'icon' => 'fa-solid fa-stethoscope'],
        ['href' => route('mostrar_pagamentos_recepcionista'), 'titulo' => 'Pagamentos',   'icon' => 'fa-solid fa-credit-card'],
        ['href' => route('mostrar_pacientes_recepcionista'),  'titulo' => 'Pacientes',    'icon' => 'fa-solid fa-users'],
        ['href' => route('mostrar_horarios_recepcionista'),   'titulo' => 'Horários',     'icon' => 'fa-solid fa-clock'],
    ];
}

if (session('tipo_utilizador') == 'paciente') {
    $menus = [
        ['href' => route('mostrar_dashboard_paciente'),   'titulo' => 'Dashboard',    'icon' => 'fa-solid fa-gauge'],
        ['href' => route('mostrar_consultas_paciente'),   'titulo' => 'Consultas',    'icon' => 'fa-solid fa-stethoscope'],
        ['href' => route('mostrar_prontuario_paciente'),  'titulo' => 'Prontuário',   'icon' => 'fa-solid fa-file-medical'],
        ['href' => route('mostrar_relatorios_paciente'),  'titulo' => 'Relatórios',   'icon' => 'fa-solid fa-file-alt'],
        ['href' => route('listar_minhas_notificacoes'),   'titulo' => 'Notificações', 'icon' => 'fa-solid fa-bell'],
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clínica Estoril - A sua saude nas melhores mãos">
    <title>Clínica Estoril - @yield('titulo')</title>

    {{-- Script anti-flash: aplica dark mode ANTES dos estilos carregarem --}}
    <script>
       (function () {
        const userId = "{{ session('id_utilizador', 'guest') }}";
        const key = 'clinica_dark_mode_' + userId;
        if (localStorage.getItem(key) === '1') {
            document.documentElement.classList.add('pre-dark');
            document.documentElement.classList.add('dark-ready');
        }
    })();
    </script>

    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('notificacao.css') }}">
    <link rel="stylesheet" href="{{ asset('all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toastify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('styles-painel.css') }}">
    <link rel="stylesheet" href="{{ asset('styles-painel-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="stylesheet" href="{{ asset('assets/icons/bootstrap-icons.css') }}" />
    @yield('estilo')
</head>

<body class="bg-light">

    <div>
        {{-- ══════════════════════════════════════════
             SIDEBAR
        ══════════════════════════════════════════ --}}
        <div class="menu-vertical">
            <aside>
                <div>
                    <a href="/">
                        <div class="logotipo">
                            <img class="logotipo-clinica" src="/imagem/logo.png" alt="logotipo da clinica">
                            <span class="texto">Clínica Estoril</span>
                        </div>
                    </a>
                </div>

                <div class="paginas-vertical">
                    @foreach ($menus as $menu)
                        <a class="sidebar-menu-item"
                           style="padding: 12px 16px; font-weight: 500;"
                           href="{{ $menu['href'] }}"
                           data-titulo="{{ $menu['titulo'] }}">

                            @if(str_contains($menu['href'], 'notificac'))
                                {{-- Ícone com badge de notificações --}}
                                <span class="notif-icon-wrapper">
                                    <i class="{{ $menu['icon'] }}"></i>
                                    <span class="notif-badge" id="notif-badge" style="display:none;">0</span>
                                </span>
                            @else
                                <i class="{{ $menu['icon'] }}"></i>
                            @endif

                            <span class="menu-label">{{ $menu['titulo'] }}</span>
                        </a>
                    @endforeach

                    {{-- Botão Terminar Sessão --}}
                    <a class="sidebar-menu-item sair" href="/sair" data-titulo="Terminar Sessão">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <strong class="menu-label">Terminar Sessão</strong>
                    </a>
                </div>
            </aside>
        </div>
         <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- ══════════════════════════════════════════
             HEADER
        ══════════════════════════════════════════ --}}
        <header class="painel-header">
            <div style="display: flex; align-items: center; height: 100%; justify-content: space-between;">

                <div style="display:flex; align-items:center; gap:12px;">

    <button class="menu-toggle-btn" id="menuToggleBtn">
        <i class="fa-solid fa-bars"></i>
    </button>

    <span style="font-weight: bold;">
        @yield('titulo')
    </span>
</div>

                <div style="display: flex; align-items: center; gap: 12px;">

                    {{-- Botão Modo Noturno --}}
                    <button class="dark-toggle-btn" id="darkToggleBtn" title="Alternar modo noturno">
                        <span class="toggle-icon" id="darkToggleIcon">🌙</span>
                        <span class="toggle-label" id="darkToggleLabel">Modo Noturno</span>
                    </button>

                    {{-- Perfil --}}
                    <a href="/visualizar-perfil" class="perfil-link">
                        <span class="user-name-text" style="font-weight:500; font-size:14px;">
                            {{ session('nome_utilizador') ?? 'Utilizador' }}
                        </span>
                        @if(session('foto_utilizador'))
                            <img src="{{ asset('storage/' . session('foto_utilizador')) }}"
                                 alt="Foto de perfil"
                                 style="width:34px; height:34px; border-radius:50%; object-fit:cover; border:2px solid #e2e8f0; flex-shrink:0;">
                        @else
                            <i style="font-size:28px; color:#0066cc" class="fa-solid fa-circle-user"></i>
                        @endif
                    </a>
                </div>

            </div>
        </header>
    </div>

    {{-- ══════════════════════════════════════════
         CONTEÚDO PRINCIPAL
    ══════════════════════════════════════════ --}}
    <main class="painel-main">
        @yield('conteudo')
    </main>

    {{-- Alert customizado --}}
    <div id="custom-alert" class="custom-alert hidden">
        <div class="custom-alert-box">
            <p id="custom-alert-text"></p>
            <button onclick="fecharAlert()">Ok</button>
        </div>
    </div>

    {{-- Modal Remover --}}
    @include('components.remover_modal')

    {{-- Botão Voltar ao Topo --}}
    <button class="back-to-top" id="backToTop" aria-label="Voltar ao topo">
        <i class="fas fa-arrow-up"></i>
    </button>

    {{-- Scripts --}}
    <script src="{{ asset('pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('jquery-3.2.1.slim.min.js') }}"></script>
    <script src="{{ asset('popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap.min.js') }}"></script>
    <script src="{{ asset('script.js') }}"></script>
    <script src="{{ asset('auth.js') }}"></script>
    <script src="{{ asset('toastify-js.js') }}"></script>
    <script src="{{ asset('toastify.js') }}"></script>
    <script src="{{ asset('remover-modal.js') }}"></script>
    <script src="{{ asset('foto-menu.js') }}"></script>

    @yield('script')

    <script>
        // ── Marca item ativo na sidebar ──────────────────────────
        const urlAtual = window.location.pathname;
        const menus = document.getElementsByClassName("sidebar-menu-item");

        for (let i = 0; i < menus.length; i++) {
            const menu = menus[i];
            menu.classList.remove("sidebar-menu-item-active");
            const href = new URL(menu.href).pathname;
            if (urlAtual === href || urlAtual.startsWith(href + "/")) {
                menu.classList.add("sidebar-menu-item-active");
            }
        }

        // ── Alert customizado ────────────────────────────────────
        function mostrarAlert(mensagem) {
            const box  = document.getElementById("custom-alert");
            const text = document.getElementById("custom-alert-text");
            text.textContent = mensagem;
            box.classList.remove("hidden");
        }

        function fecharAlert() {
            document.getElementById("custom-alert").classList.add("hidden");
        }

      
       

        // ── Polling badge de notificações (a cada 30s) ───────────
        function atualizarBadgeNotificacoes() {
            fetch('/api/notificacoes-nao-lidas')
                .then(r => r.json())
                .then(data => {
                    const badge = document.getElementById('notif-badge');
                    if (!badge) return;
                    const total = data.total;
                    if (total > 0) {
                        badge.textContent = total > 10 ? '+10' : total;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }
                })
                .catch(() => {});
        }

        atualizarBadgeNotificacoes();
        setInterval(atualizarBadgeNotificacoes, 30000);

        // Força atualização ao entrar na página de notificações
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof atualizarBadgeNotificacoes === 'function') {
                atualizarBadgeNotificacoes();
            }
        });
          const sucessoMsg = "{{ session('sucesso') }}";
        const erroMsg = "{{ session('erro') }}";

        if (sucessoMsg) {
             mostrarMensagemSucesso(sucessoMsg);
        }
        if (erroMsg) {
             mostrarMensagemErro(erroMsg);
        }
        // TOGGLE MENU MOBILE
// ─────────────────────────────────────────
const menuBtn = document.getElementById('menuToggleBtn');
const sidebar = document.querySelector('.menu-vertical');
const overlay = document.getElementById('sidebarOverlay');

if(menuBtn){

    menuBtn.addEventListener('click', function(){

        sidebar.classList.toggle('aberto');
        overlay.classList.toggle('ativo');

    });

    overlay.addEventListener('click', function(){

        sidebar.classList.remove('aberto');
        overlay.classList.remove('ativo');

    });

}
    </script>
<script>
    const _userId = "{{ session('id_utilizador', 'guest') }}";
    const DARK_KEY = 'clinica_dark_mode_' + _userId;

    function ativarDark() {
        document.body.classList.add('dark-mode');
        document.documentElement.classList.add('pre-dark');
        localStorage.setItem(DARK_KEY, '1');
        const icon  = document.getElementById('darkToggleIcon');
        const label = document.getElementById('darkToggleLabel');
        if (icon)  icon.textContent  = '☀️';
        if (label) label.textContent = 'Modo Claro';
    }

    function desativarDark() {
        document.body.classList.remove('dark-mode');
        document.documentElement.classList.remove('pre-dark');
        localStorage.setItem(DARK_KEY, '0');
        const icon  = document.getElementById('darkToggleIcon');
        const label = document.getElementById('darkToggleLabel');
        if (icon)  icon.textContent  = '🌙';
        if (label) label.textContent = 'Modo Noturno';
    }

    (function () {
        const saved = localStorage.getItem(DARK_KEY);
        if (saved === '1') {
            ativarDark();
        } else if (saved === null && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            ativarDark();
        } else {
            desativarDark(); // garante reset se outro utilizador deixou dark ativo
        }
    })();

    document.getElementById('darkToggleBtn').addEventListener('click', function () {
        document.body.classList.contains('dark-mode') ? desativarDark() : ativarDark();
    });

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
        if (localStorage.getItem(DARK_KEY) === null) {
            e.matches ? ativarDark() : desativarDark();
        }
    });
</script>
</body>
</html>