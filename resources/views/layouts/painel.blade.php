<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clínica Estoril - A sua saude nas melhores mãos ">
    <title>Clínica Estoril - @yield('titulo')</title>
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/toastify.min.css" />
    <link rel="stylesheet" href="/styles-painel.css">
    <link rel="stylesheet" href="/bootstrap.min.css">

    @yield('estilo')
</head>

<body class="bg-light">

    <!-- HEADER E NAVEGAÇÃO -->
    <header class="header">
        <div class="container">
            <div class="nav-wrapper">
                <!-- Logo -->
                <a href="/">
                    <div class="logo">
                        <img src="/imagem/logo.jpg" alt="logotipo da clinica">
                        <span>Clínica Estoril</span>
                    </div>
                </a>

                <!-- Navegação Desktop   active -->
                <nav class="nav-menu">
                    @if (session('tipo_utilizador') == 'paciente')
                        <a href="/consultas-paciente" class="nav-link">Consultas</a>
                        <a href="/listar-minhas-notificacoes" class="nav-link">Notificações</a>
                    @endif
                    @if (session('tipo_utilizador') == 'medico')
                        <a href="{{ route('mostrar_triagens_recepcionista') }}" class="nav-link">Triagens</a>
                        <a href="/prontuarios" class="nav-link">Prontuarios</a>
                        <a href="/consulta" class="nav-link">Consultas</a>
                        <a href="/exames" class="nav-link">Exames</a>
                        <a href="/horarios" class="nav-link">Horarios</a>
                        <a href="/relatorio_medico" class="nav-link">Relatórios</a>
                    @endif
                    @if (session('tipo_utilizador') == 'recepcionista')
                        <a href="{{ route('mostrar_consultas_recepcionista') }}"
                            class="nav-link {{ link_ativo('mostrar_consultas_recepcionista') }}">Consultas/Agendamentos</a>
                        <a href="{{ route('mostrar_pagamentos_recepcionista') }}"
                            class="nav-link {{ link_ativo('mostrar_pagamentos_recepcionista') }}">Pagamentos</a>
                        <a href="{{ route('mostrar_pacientes_recepcionista') }}"
                            class="nav-link {{ link_ativo('mostrar_pacientes_recepcionista') }}">Pacientes</a>
                    @endif
                    <a class="nav-link" style=" font-weight: 500; color:red;" href="/sair"><strong>Sair</strong></a>
                    <a href="/visualizar-perfil" class="nav-link"><i style="font-size: 28px; color: #0066cc"
                            class="fa-solid fa-circle-user"></i></a>
                </nav>
            </div>
            <!-- Menu Mobile Toggle -->
            <button class="mobile-menu-toggle" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        </div>
    </header>

    @yield('conteudo')

    <!-- FOOTER -->
    <!-- Botão Voltar ao Topo -->
    <button class="back-to-top" id="backToTop" aria-label="Voltar ao topo">
        <i class="fas fa-arrow-up"></i>
    </button>
    @yield('script')

    <script src="/script.js"></script>
    <script src="/chatbot.js"></script>
    <script src="/auth.js"></script>
    <script src="/main.js"></script>
</body>

</html>
