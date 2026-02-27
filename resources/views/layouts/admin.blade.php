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
    <style>
        .sidebar-menu-item {
            text-decoration: none;
        }

        .sidebar-menu-item-active {
            background-color: #0066cc;
            color: white;
        }

        .sidebar-menu-item:hover {
            background-color: #0066cc30;
        }
    </style>
</head>

<body class="bg-light">
    <div style="display: flex;">
        <div style="position: fixed; width: 240px; top:0px; height: 100%; background-color: white;">
            <aside>
                <div style="padding: 8px;">
                    <a href="/">
                        <div
                            style="display: flex; justify-content: center; align-items: center; gap: 4px; height: 52px;">
                            <img style="height: 40px; width: 40px; object-fit: cover;" src="/imagem/logo.jpg"
                                alt="logotipo da clinica">
                            <span style="font-weight: bold; font-size: 14pt;">Clínica Estoril</span>
                        </div>
                    </a>
                </div>

                <div style="display: flex; flex-direction: column; margin-top: 20px;">
                    <?php $menus = [['href' => '/admin/dashboard', 'titulo' => 'Dashboard', 'icon' => 'fa-solid fa-gauge'], ['href' => '/admin/pagamentos', 'titulo' => 'Pagamentos', 'icon' => 'fa-solid fa-credit-card'], ['href' => '/admin/cadastros', 'titulo' => 'Cadastros', 'icon' => 'fa-solid fa-users'], ['href' => '/admin/consultas', 'titulo' => 'Consultas', 'icon' => 'fa-solid fa-stethoscope'], ['href' => '/admin/prontuarios', 'titulo' => 'Prontuários', 'icon' => 'fa-solid fa-file-medical'], ['href' => '/admin/exames', 'titulo' => 'Exames', 'icon' => 'fa-solid fa-microscope'], ['href' => '/admin/relatorios-medicos', 'titulo' => 'Relatórios Medicos', 'icon' => 'fa-solid fa-file-alt']];
                    ?>
                    @foreach ($menus as $menu)
                    <a class="sidebar-menu-item" style="padding: 12px 16px; font-weight: 500;"
                        href="{{ $menu['href'] }}"><i class="{{ $menu['icon'] }}"></i> {{ $menu['titulo'] }}</a>
                    @endforeach
                    <a class="sidebar-menu-item" style="padding: 12px 16px; font-weight: 500; color:red;"
                        href="/sair"><i class="fa-solid fa-right-from-bracket"></i> <strong>Sair</strong></a>
                </div>
            </aside>
        </div>
        <header
            style="position: fixed; top: 0px; left:240px;right: 0px; background-color: white; padding: 8px; height: 52px;">
            <div style="display: flex; align-items: center; height: 100%; justify-content: space-between;">
                <span style="font-weight: bold; font-size: px;">@yield('titulo')</span>
                <a href="/visualizar-perfil"
                    style="display: flex; justify-items: center; align-items: center; height: fit-content;"><i
                        style="font-size: 28px; color: #0066cc" class="fa-solid fa-circle-user"></i></a>
            </div>
        </header>

    </div>

    <main style="margin-left: 240px; margin-top: 52px; padding: 16px">
        @yield('conteudo')
    </main>

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
    <script src="{{asset('script.js')}}"></script>
    <script src="{{asset('auth.js')}}"></script>
    <script src="{{asset('toastify-js.js')}}"></script>
    <script src="{{asset('toastify.js')}}"></script>
    <script src="{{asset('remover-modal.js')}}"></script>

    @yield('script')

    <script>
        const url = window.location.pathname
        const menus = document.getElementsByClassName("sidebar-menu-item")

        for (let i = 0; i < menus.length; i++) {
            const menu = menus.item(i)
            menu.classList.remove("sidebar-menu-item-active")
            const href = menu.getAttribute("href")
            if (url.startsWith(href)) {
                menu.classList.add("sidebar-menu-item-active")
            }
        }
    </script>
</body>


</html>
