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
   <div class="modal fade" id="remover-modal" tabindex="-1" role="dialog" aria-labelledby="remover-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="remover-modal-label">Deseja remover esse item?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja remover este item? Esta ação não pode ser desfeita.</p>

                    <p hidden id="remover-modal-error" class="bg-danger text-white"
                        style="padding: 4px; border-radius: 4px;"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <button id="confirm-button" type="button" class="btn btn-primary">Sim</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <!-- Botão Voltar ao Topo -->
    <button class="back-to-top" id="backToTop" aria-label="Voltar ao topo">
        <i class="fas fa-arrow-up"></i>
    </button>
     <script src="/jquery-3.2.1.slim.min.js"></script>
    <script src="/popper.min.js"></script>
    <script src="/bootstrap.min.js"></script>
     <script>
        async function mostrarRemoverItemModal(url) {
            $('#remover-modal-error').attr("hidden", true)
            $('#remover-modal-error').text('')
            $('#remover-modal').modal('show')
            await $('#confirm-button').on('click', async function(e) {
                await fetchRemoverItemModal(url)
            })
        }

        async function fetchRemoverItemModal(url) {
            try {
                const response = await fetch(url, {
                    method: 'GET'
                })
                if (response.ok) {
                    $('#remover-modal').modal('hide')
                    $('#remover-modal-error').text('')
                    location.reload();
                } else {
                    const mensagem = await response.json()
                    $('#remover-modal-error').attr("hidden", false)
                    $('#remover-modal-error').text('Erro ao remover item: ' + mensagem?.erro || '')
                    console.error('Erro ao remover item:', response);
                }
            } catch (error) {
                $('#remover-modal-error').attr("hidden", false)
                $('#remover-modal-error').text('Erro ao remover item')
                console.error('Erro ao remover item:', error);
            }
        }
    </script>
    @yield('script')

</body>

</html>
