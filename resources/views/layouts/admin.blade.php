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
    <link rel="stylesheet" href="/styles-painel.css">
    <link rel="stylesheet" href="/bootstrap.min.css">
    @yield("estilo")
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
                    <?php $menus = [
    ["href" => "/admin/dashboard", "titulo" => "Dashboard"],
    ["href" => "/admin/pagamentos", "titulo" => "Pagamentos"],
    ["href" => "/admin/cadastros", "titulo" => "Cadastros"],
    ["href" => "/admin/consultas", "titulo" => "Consultas"],
    ["href" => "/admin/prontuarios", "titulo" => "Prontuários"],
    ["href" => "/admin/exames", "titulo" => "Exames"],
];
                    ?>
                    @foreach($menus as $menu)
                        <a class="sidebar-menu-item" style="padding: 12px 16px; font-weight: 500;"
                            href="{{ $menu['href'] }}">{{ $menu['titulo'] }}</a>
                    @endforeach
                    <a class="sidebar-menu-item" style="padding: 12px 16px; font-weight: 500; color:red;"
                        href="/sair"><strong>Sair</strong></a>
                </div>
            </aside>
        </div>
        <header
            style="position: fixed; top: 0px; left:240px;right: 0px; background-color: white; padding: 8px; height: 52px;">
            <div style="display: flex; align-items: center; height: 100%; justify-content: space-between;">
                <span style="font-weight: bold; font-size: px;">@yield("titulo")</span>
                <a href="/visualizar-perfil"
                    style="display: flex; justify-items: center; align-items: center; height: fit-content;"><i
                        style="font-size: 28px; color: #0066cc" class="fa-solid fa-circle-user"></i></a>
            </div>
        </header>

    </div>

    <main style="margin-left: 240px; margin-top: 52px; padding: 16px">
        @yield("conteudo")
    </main>
    <!-- Modal Remover -->
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
    @yield("script")
    <script>
        const url = window.location.pathname
        const menus = document.getElementsByClassName("sidebar-menu-item")

        for (let i = 0; i < menus.length; i++) {
            const menu = menus.item(i)
            menu.classList.remove("sidebar-menu-item-active")
            const href = menu.getAttribute("href")
            console.log(href, url)
            if (href === url) {
                console.log("Entrou")
                menu.classList.add("sidebar-menu-item-active")
            }
        }
    </script>
    <script src="/script.js"></script>
    <!-- <script src="/chatbot.js"></script> -->
    <script src="/auth.js"></script>
    <!-- <script src="/main.js"></script> -->
    <script type="text/javascript" src="/toastify-js.js"></script>
    <script>
       /* Toastify({
            text: "Mensagem de sucesso!",
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            backgroundColor: "#4BB543", // verde de sucesso
        }).showToast();

        Toastify({
            text: "Mensagem de erro!",
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            backgroundColor: "#FF3333", // vermelho de erro
        }).showToast();

        Toastify({
            text: "Mensagem de informação!",
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            backgroundColor: "#3498db", // azul de informação
        }).showToast();
        */
    </script>

    <script>
        function mostrarRemoverItemModal(url) {
            $('#remover-modal-error').attr("hidden", true)
            $('#remover-modal-error').text('')
            $('#remover-modal').modal('show')
            $('#confirm-button').on('click', function (e) {
                fetchRemoverItemModal(url)
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
</body>


</html>