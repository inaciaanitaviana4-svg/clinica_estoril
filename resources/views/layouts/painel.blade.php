<?php
$menus = [
    // ['href' => '/admin/dashboard', 'titulo' => 'Dashboard', 'icon' => 'fa-solid fa-gauge'],
];
if (session('tipo_utilizador') == 'medico') {
    $menus = [['href' => route('mostrar_dashboard_medico'), 'titulo' => 'Dashboard', 'icon' => 'fa-solid fa-gauge'], ['href' => route('mostrar_prontuarios_medico'), 'titulo' => 'Prontuarios', 'icon' => 'fa-solid fa-file-medical'], ['href' => route('mostrar_consultas_medico'), 'titulo' => 'Consultas', 'icon' => 'fa-solid fa-calendar-check'], ['href' => route('mostrar_horarios_medico'), 'titulo' => 'Horarios', 'icon' => 'fa-solid fa-clock'], ['href' => route('mostrar_relatorios_medico'), 'titulo' => 'Relatórios', 'icon' => 'fa-solid fa-file-alt'], ['href' => route('listar_minhas_notificacoes'), 'titulo' => 'Notificações', 'icon' => 'fa-solid fa-bell']];
}
if (session('tipo_utilizador') == 'recepcionista') {
    $menus = [['href' => route('mostrar_dashboard_recepcionista'), 'titulo' => 'Dashboard', 'icon' => 'fa-solid fa-gauge'], ['href' => route('mostrar_consultas_recepcionista'), 'titulo' => 'Agendamentos', 'icon' => 'fa-solid fa-stethoscope'], ['href' => route('mostrar_pagamentos_recepcionista'), 'titulo' => 'Pagamentos', 'icon' => 'fa-solid fa-credit-card'], ['href' => route('mostrar_pacientes_recepcionista'), 'titulo' => 'Pacientes', 'icon' => 'fa-solid fa-users'], ['href' => route('mostrar_horarios_recepcionista'), 'titulo' => 'Horarios', 'icon' => 'fa-solid fa-clock']];
}
if (session('tipo_utilizador') == 'paciente') {
    $menus = [['href' => route('mostrar_dashboard_paciente'), 'titulo' => 'Dashboard', 'icon' => 'fa-solid fa-gauge'], ['href' => route('mostrar_consultas_paciente'), 'titulo' => 'Consultas', 'icon' => 'fa-solid fa-stethoscope'], ['href' => route('listar_minhas_notificacoes'), 'titulo' => 'Notificações', 'icon' => 'fa-solid fa-bell'], ['href' => route('mostrar_relatorios_paciente'), 'titulo' => 'Relatórios', 'icon' => 'fa-solid fa-file-alt'], ['href' => route('mostrar_prontuario_paciente'), 'titulo' => 'Prontuario', 'icon' => 'fa-solid fa-file-medical']];
}
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clínica Estoril - A sua saude nas melhores mãos ">
    <title>Clínica Estoril - @yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('notificacao.css') }}">
    <link rel="stylesheet" href="{{ asset('all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toastify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('styles-painel.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    @yield('estilo')
</head>

<body class="bg-light">
    <div>
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
                        <a class="sidebar-menu-item" style="padding: 12px 16px; font-weight: 500;"
                            href="{{ $menu['href'] }}">

                            @if (str_contains($menu['href'], 'notificac'))
                                {{-- Ícone com badge por cima --}}
                                <span class="notif-icon-wrapper">
                                    <i class="{{ $menu['icon'] }}"></i>
                                    <span class="notif-badge" id="notif-badge" style="display:none;">0</span>
                                </span>
                            @else
                                <i class="{{ $menu['icon'] }}"></i>
                            @endif

                            {{ $menu['titulo'] }}
                        </a>
                    @endforeach
                    <!-- BOTÃO TERMINAR SESSÃO --> <a class="sidebar-menu-item sair" href="/sair">
                        <i class="fa-solid fa-right-from-bracket"></i> <strong>Terminar Sessão</strong> </a>
                </div>
            </aside>
        </div>
        <header
            style="position: fixed; top: 0px; left:240px;right: 0px; background-color: white; padding: 8px; height: 52px; z-index: 100;">
            <div style="display: flex; align-items: center; height: 100%; justify-content: space-between;">
                <span style="font-weight: bold; font-size: px;">@yield('titulo')</span>
                <a href="/visualizar-perfil"
                    style="display:flex; align-items:center; height:fit-content;
          gap:8px; text-decoration:none; color:inherit;">
                    <span style="font-weight:500; font-size:14px;">
                        {{ session('nome_utilizador') ?? 'Utilizador' }}
                    </span>

                    @if (session('foto_utilizador'))
                        <img src="{{ asset('storage/' . session('foto_utilizador')) }}" alt="Foto de perfil"
                            style="width:34px; height:34px; border-radius:50%;
                    object-fit:cover; border:2px solid #e2e8f0;
                    flex-shrink:0;">
                    @else
                        <i style="font-size:28px; color:#0066cc" class="fa-solid fa-circle-user"></i>
                    @endif
                </a>
            </div>
        </header>

    </div>
    <main style="margin-left: 240px; margin-top: 52px; padding: 16px">
        @yield('conteudo')
    </main>
    <div id="custom-alert" class="custom-alert hidden">
        <div class="custom-alert-box">
            <p id="custom-alert-text"></p>
            <button onclick="fecharAlert()">Ok</button>
        </div>
    </div>
    <!-- Modal Remover -->
    @include('components.remover_modal')

    <!-- Botão Voltar ao Topo -->
    <button class="back-to-top" id="backToTop" aria-label="Voltar ao topo">
        <i class="fas fa-arrow-up"></i>
    </button>

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

    @yield('script')
    @section('script')
        <script>
            // Assim que a página de notificações carrega, atualiza o badge imediatamente
            document.addEventListener('DOMContentLoaded', function() {
                // Força atualização do badge ao entrar na página de notificações
                if (typeof atualizarBadgeNotificacoes === 'function') {
                    atualizarBadgeNotificacoes();
                }
            });
        </script>
    @endsection

    <script>
        const urlAtual = window.location.pathname;
        const menus = document.getElementsByClassName("sidebar-menu-item");

        for (let i = 0; i < menus.length; i++) {
            const menu = menus[i];

            // remove classe ativa
            menu.classList.remove("sidebar-menu-item-active");

            // pega apenas o pathname do href
            const href = new URL(menu.href).pathname;

            // compara as rotas
            if (urlAtual === href || urlAtual.startsWith(href + "/")) {
                menu.classList.add("sidebar-menu-item-active");
            }
        }

        function mostrarAlert(mensagem) {
            const box = document.getElementById("custom-alert");
            const text = document.getElementById("custom-alert-text");

            text.textContent = mensagem;
            box.classList.remove("hidden");
        }

        function fecharAlert() {
            document.getElementById("custom-alert").classList.add("hidden");
        }

        // Polling de notificações — verifica a cada 30 segundos
        function atualizarBadgeNotificacoes() {
            fetch('/api/notificacoes-nao-lidas')
                .then(r => r.json())
                .then(data => {
                    const badge = document.getElementById('notif-badge');
                    if (!badge) return;

                    const total = data.total;

                    if (total > 0) {
                        // Define o texto: +10 se passar de 10, senão o número exato
                        badge.textContent = total > 10 ? '+10' : total;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }
                })
                .catch(() => {}); // falha silenciosa
        }

        // Executa imediatamente ao carregar a página
        atualizarBadgeNotificacoes();

        // Repete a cada 30 segundos
        setInterval(atualizarBadgeNotificacoes, 30000);
        const sucessoMsg = "{{ session('sucesso') }}";
        const erroMsg = "{{ session('erro') }}";

        if (sucessoMsg) {
             mostrarMensagemSucesso(sucessoMsg);
        }
        if (erroMsg) {
             mostrarMensagemErro(erroMsg);
        }
    </script>
</body>


</html>
