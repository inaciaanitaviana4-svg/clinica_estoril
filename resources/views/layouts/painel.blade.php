<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clínica Estoril - A sua saude nas melhores mãos ">
    <title>Clínica Estoril - @yield('titulo')</title>
    <link rel="stylesheet" href="{{asset('styles.css')}}">
    <link rel="stylesheet" href="{{asset('all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastify.min.css')}}" />
    <link rel="stylesheet" href="{{asset('styles-painel.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap.min.css')}}">
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
                    <a href="/consultas-paciente" class="nav-link"><i class="fa-solid fa-stethoscope"></i> Consultas</a>
                    <a href="/listar-minhas-notificacoes" class="nav-link"><i class="fa-solid fa-bell"></i> Notificações</a>
                    @endif
                    @if (session('tipo_utilizador') == 'medico')
                    <a href="/prontuarios" class="nav-link"><i class="fa-solid fa-file-medical"></i> Prontuarios</a>
                    <a href="/consulta" class="nav-link"><i class="fa-solid fa-calendar-check"></i> Consultas</a>
                    <a href="/horarios" class="nav-link"><i class="fa-solid fa-clock"></i> Horarios</a>
                    <a href="/relatorio_medico" class="nav-link"><i class="fa-solid fa-file-alt"></i> Relatórios</a>
                    @endif
                    @if (session('tipo_utilizador') == 'recepcionista')
                    <a href="{{ route('mostrar_consultas_recepcionista') }}"
                        class="nav-link {{ link_ativo('mostrar_consultas_recepcionista') }}"><i class="fa-solid fa-stethoscope"></i> Consultas/Agendamentos</a>
                    <a href="{{ route('mostrar_pagamentos_recepcionista') }}"
                        class="nav-link {{ link_ativo('mostrar_pagamentos_recepcionista') }}"><i class="fa-solid fa-credit-card"></i> Pagamentos</a>
                    <a href="{{ route('mostrar_pacientes_recepcionista') }}"
                        class="nav-link {{ link_ativo('mostrar_pacientes_recepcionista') }}"><i class="fa-solid fa-users"></i> Pacientes</a>
                    @endif
                    <a class="nav-link" style=" font-weight: 500; color:red;" href="/sair"><strong><i class="fa-solid fa-right-from-bracket"></i> Sair</strong></a>
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

    <!-- Modal Remover -->
    @include('components.remover_modal')

    <!-- Botão Voltar ao Topo -->
    <button class="back-to-top" id="backToTop" aria-label="Voltar ao topo">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="{{asset('pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('jquery-3.2.1.slim.min.js')}}"></script>
    <script src="{{asset('popper.min.js')}}"></script>
    <script src="{{asset('bootstrap.min.js')}}"></script>
     <script src="{{asset('toastify-js.js')}}"></script>
    <script src="{{asset('toastify.js')}}"></script>
    <script src="{{asset('remover-modal.js')}}"></script>
    @yield('script')

</body>

</html>
