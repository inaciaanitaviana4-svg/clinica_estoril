// ===================== GERENCIAMENTO DE FOTO COMPLETO =====================

// Aguarda o DOM carregar completamente
document.addEventListener('DOMContentLoaded', function() {
    // Seleciona o elemento de entrada da foto (input file)
    const fotoInput = document.getElementById('foto');
    if (!fotoInput) return;
    
    // Seleciona o container da foto (label que envolve a foto)
    const fotoLabel = document.getElementById('foto-label');
    if (!fotoLabel) return;
    
    // Variáveis para armazenar a foto atual
    let isEditMode = false;
    // ===================== ESTILOS GLOBAIS =====================
const globalStyle = document.createElement('style');

globalStyle.textContent = `
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translate(-50%, -45%);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }

    /* ===================== X ESTILO WINDOWS ===================== */
    .btn-close-windows {
        cursor: pointer;
        color: #a0aec0;
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        font-size: 18px;
    }

    .btn-close-windows:hover {
        background: #e81123;
        color: white;
    }

    /* ===================== MODAL PERSONALIZADO ===================== */
    .modal-personalizado {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border-radius: 14px;
        box-shadow: 0 12px 35px rgba(0,0,0,0.25);
        z-index: 10050;
        width: 420px;
        max-width: 92%;
        overflow: hidden;
        animation: fadeIn 0.2s ease-out;
        font-family: sans-serif;
    }

    .modal-header {
        padding: 14px 16px;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-title {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
    }

    .modal-body {
        padding: 24px 20px;
        text-align: center;
        color: #334155;
        font-size: 15px;
        line-height: 1.5;
    }

    .modal-footer {
        padding: 16px;
        display: flex;
        justify-content: center;
        gap: 12px;
        border-top: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    .modal-btn {
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.2s;
    }

    .modal-btn-cancelar {
        background: #e2e8f0;
        color: #1e293b;
    }

    .modal-btn-cancelar:hover {
        background: #cbd5e1;
    }

    .modal-btn-confirmar {
        background: #e81123;
        color: white;
    }

    .modal-btn-confirmar:hover {
        background: #c50f1f;
    }

    .modal-sucesso-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #dcfce7;
        color: #16a34a;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        font-size: 32px;
    }
`;

document.head.appendChild(globalStyle);
    
    // Verifica se já existe foto (se o preview está visível)
    const fotoPreview = document.getElementById('foto-preview');
    const fotoIcon = document.getElementById('foto-icon');
    
    // Função para verificar se tem foto
    function hasFoto() {
        return fotoPreview && fotoPreview.style.display !== 'none' && fotoPreview.src && fotoPreview.src !== '';
    }

             // ===================== MODAL PERSONALIZADO =====================
function criarModal({
    titulo = '',
    mensagem = '',
    confirmarTexto = 'Confirmar',
    cancelarTexto = 'Cancelar',
    mostrarCancelar = true,
    tipo = 'confirmacao',
    onConfirm = null
}) {

    const overlay = document.createElement('div');

    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.45);
        backdrop-filter: blur(2px);
        z-index: 10049;
    `;

    const modal = document.createElement('div');
    modal.className = 'modal-personalizado';

    let iconHTML = '';

    if (tipo === 'sucesso') {
        iconHTML = `
            <div class="modal-sucesso-icon">
                <i class="fa-solid fa-check"></i>
            </div>
        `;
    }

    modal.innerHTML = `
        <div class="modal-header">

            <div class="modal-title">
                ${titulo}
            </div>

            <div class="btn-close-windows modal-close">
                <i class="fa-solid fa-xmark"></i>
            </div>

        </div>

        <div class="modal-body">
            ${iconHTML}
            ${mensagem}
        </div>

        <div class="modal-footer">

            ${
                mostrarCancelar
                ? `
                    <button class="modal-btn modal-btn-cancelar">
                        ${cancelarTexto}
                    </button>
                `
                : ''
            }

            <button class="modal-btn modal-btn-confirmar">
                ${confirmarTexto}
            </button>

        </div>
    `;

    document.body.appendChild(overlay);
    document.body.appendChild(modal);

    function fecharModal() {
        modal.remove();
        overlay.remove();
    }

    // Fechar no X
    modal.querySelector('.modal-close')
        .addEventListener('click', fecharModal);

    // Fechar clicando fora
    overlay.addEventListener('click', fecharModal);

    // Botão cancelar
    const cancelarBtn = modal.querySelector('.modal-btn-cancelar');

    if (cancelarBtn) {
        cancelarBtn.addEventListener('click', fecharModal);
    }

    // Confirmar
    modal.querySelector('.modal-btn-confirmar')
        .addEventListener('click', function() {

            if (onConfirm) {
                onConfirm();
            }

            fecharModal();
        });
}

    
    // ===================== FUNÇÃO PARA MOSTRAR MENU DE OPÇÕES =====================
    function mostrarMenuFoto(event) {
        event.stopPropagation();
        
        // Remove qualquer menu existente
        const menuExistente = document.querySelector('.foto-menu');
        if (menuExistente) menuExistente.remove();
        
        // Cria o menu flutuante
        const menu = document.createElement('div');
        menu.className = 'foto-menu';
        menu.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            z-index: 10000;
            min-width: 220px;
            overflow: hidden;
            animation: fadeIn 0.2s ease-out;
        `;
        
        // Conteúdo do menu baseado se tem foto ou não
        let menuContent = '';
        
        if (hasFoto()) {
            // Menu para quando já tem foto
            menuContent = `
                <div class="foto-menu-item" data-acao="visualizar">
                    <i class="fa-regular fa-eye"></i>
                    <span style="color:black;">Visualizar foto</span>
                </div>
                <div class="foto-menu-item" data-acao="editar">
                    <i class="fa-regular fa-pen-to-square"></i>
                    <span style="color:black;">Trocar de foto</span>
                </div>
                <div class="foto-menu-item" data-acao="deletar">
                    <i class="fa-regular fa-trash-can"></i>
                    <span style="color:black;">Deletar foto</span>
                </div>
            `;
        } else {
            // Menu para quando não tem foto
            menuContent = `
                <div class="foto-menu-item" data-acao="abrir-camera">
                    <i class="fa-solid fa-camera"></i>
                    <span style="color:black;">Abrir câmera</span>
                </div>
                <div class="foto-menu-item" data-acao="abrir-ficheiros">
                    <i class="fa-regular fa-folder-open"></i>
                    <span style="color:black;">Ir para ficheiros</span>
                </div>
            `;
        }
        
        menu.innerHTML = `
            <div class="foto-menu-header" style="
                padding: 12px;
                border-bottom: 1px solid #e2e8f0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                background: #f7fafc;">
                <span style="font-weight: 600; color: #2d3748;">Opções de foto</span>
                <div class="btn-close-windows foto-menu-close">
    <i class="fa-solid fa-xmark"></i>
</div>
            </div>
            <div class="foto-menu-body">
                ${menuContent}
            </div>
        `;
        
        // Adiciona estilos
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translate(-50%, -45%); }
                to { opacity: 1; transform: translate(-50%, -50%); }
            }
            .foto-menu-item {
                padding: 12px 16px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 12px;
                transition: background 0.2s;
                border-bottom: 1px solid #edf2f7;
            }
            .foto-menu-item:last-child {
                border-bottom: none;
            }
            .foto-menu-item:hover {
                background: #f7fafc;
            }
            .foto-menu-item i {
                width: 20px;
                color: #4a5568;
            }
            .foto-menu-item span {
                color: #2d3748;
            }
        `;
        document.head.appendChild(style);
        
        document.body.appendChild(menu);
        
        // Adiciona overlay para fechar ao clicar fora
        const overlay = document.createElement('div');
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            z-index: 9999;
        `;
        document.body.appendChild(overlay);
        
        // Fecha o menu ao clicar no X
        menu.querySelector('.foto-menu-close').addEventListener('click', function(e) {
            e.stopPropagation();
            menu.remove();
            overlay.remove();
        });
        
        // Fecha o menu ao clicar no overlay
        overlay.addEventListener('click', function() {
            menu.remove();
            overlay.remove();
        });
        
        // Eventos dos itens do menu
        menu.querySelectorAll('.foto-menu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.stopPropagation();
                const acao = this.dataset.acao;
                
                switch(acao) {
                    case 'abrir-camera':
                        menu.remove();
                        overlay.remove();
                        abrirCamera();
                        break;
                    case 'abrir-ficheiros':
                        menu.remove();
                        overlay.remove();
                        abrirFicheiros();
                        break;
                    case 'visualizar':
                        menu.remove();
                        overlay.remove();
                        visualizarFoto();
                        break;
                    case 'editar':
                        menu.remove();
                        overlay.remove();
                        editarFoto();
                        break;
                    case 'deletar':
                        menu.remove();
                        overlay.remove();
                        deletarFoto();
                        break;
                }
            });
        });
    }
    
    // ===================== ABRIR CÂMERA =====================
    function abrirCamera() {
        // Verifica se o dispositivo tem câmera
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            // Método moderno para abrir câmera diretamente
            const videoInput = document.createElement('input');
            videoInput.type = 'file';
            videoInput.accept = 'image/*';
            videoInput.capture = 'environment'; // Tenta usar a câmera traseira
            
            // Para mobile, isso pode abrir a câmera diretamente
            videoInput.click();
            
            videoInput.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    processarArquivoFoto(file);
                }
            };
        } else {
            // Fallback: abre com o atributo capture
            const cameraInput = document.createElement('input');
            cameraInput.type = 'file';
            cameraInput.accept = 'image/*';
            cameraInput.setAttribute('capture', 'environment');
            
            cameraInput.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    processarArquivoFoto(file);
                }
            };
            
            cameraInput.click();
        }
    }
    
    // ===================== ABRIR FICHEIROS =====================
    function abrirFicheiros() {
        // Limpa o valor anterior para garantir que o change seja disparado
        fotoInput.value = '';
        fotoInput.click();
    }
    
    // ===================== PROCESSAR ARQUIVO DE FOTO =====================
    function processarArquivoFoto(file) {
        if (!file) return;
        
        // Verifica se é imagem
        if (!file.type.startsWith('image/')) {
            mostrarAlerta('Por favor, selecione um arquivo de imagem válido.');
            return;
        }
        
        // Limite de 5MB
        if (file.size > 5 * 1024 * 1024) {
            mostrarAlerta('A imagem deve ter no máximo 5MB.');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('foto-preview');
            const icon = document.getElementById('foto-icon');
            
            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            if (icon) {
                icon.style.display = 'none';
            }
            
            // Atualiza o DataTransfer do input file
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fotoInput.files = dataTransfer.files;
            
            // Se houver campo de remover foto, remove
            const hiddenInput = document.querySelector('input[name="remover_foto"]');
            if (hiddenInput) {
                hiddenInput.remove();
            }
            
            isEditMode = true;
        };
        reader.readAsDataURL(file);
    }
    
    // ===================== VISUALIZAR FOTO =====================
    function visualizarFoto() {
        const preview = document.getElementById('foto-preview');
        if (!preview || !preview.src || preview.src === '') return;
        
        // Cria modal de visualização
        const modal = document.createElement('div');
        modal.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.95);
            z-index: 10001;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        `;
        
        const img = document.createElement('img');
        img.src = preview.src;
        img.style.cssText = `
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        `;
        
        const closeBtn = document.createElement('div');
        closeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        closeBtn.className = 'btn-close-windows';

closeBtn.style.cssText = `
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(4px);
    color: white;
    width: 48px;
    height: 48px;
    font-size: 22px;
`;
        
        modal.appendChild(img);
        modal.appendChild(closeBtn);
        document.body.appendChild(modal);
        
        const fecharModal = function() {
            modal.remove();
        };
        
        modal.addEventListener('click', fecharModal);
        closeBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            fecharModal();
        });
        
        // Fecha com ESC
        document.addEventListener('keydown', function fecharEsc(e) {
            if (e.key === 'Escape') {
                fecharModal();
                document.removeEventListener('keydown', fecharEsc);
            }
        });
    }
    
    // ===================== EDITAR FOTO =====================
    function editarFoto() {
        // Cria um menu flutuante para opções de edição
        const editMenu = document.createElement('div');
        editMenu.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            z-index: 10002;
            min-width: 220px;
            overflow: hidden;
        `;
        
        editMenu.innerHTML = `
            <div class="edit-menu-header" style="
                padding: 12px;
                border-bottom: 1px solid #e2e8f0;
                background: #f7fafc;
                font-weight: 600;
                color: #2d3748;
                text-align: center;">
                Editar foto
            </div>
            <div class="foto-menu-item" data-editar="camera">
                <i class="fa-solid fa-camera"></i>
                <span>Tirar nova foto</span>
            </div>
            <div class="foto-menu-item" data-editar="ficheiros">
                <i class="fa-regular fa-folder-open"></i>
                <span>Escolher da galeria</span>
            </div>
            <div class="foto-menu-item" data-editar="cancelar" style="border-top: 1px solid #e2e8f0;">
                <i class="fa-solid fa-xmark"></i>
                <span>Cancelar</span>
            </div>
        `;
        
        // Adiciona estilos
        const styleItens = document.createElement('style');
        styleItens.textContent = `
            .foto-menu-item {
                padding: 12px 16px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 12px;
                transition: background 0.2s;
                border-bottom: 1px solid #edf2f7;
            }
            .foto-menu-item:last-child {
                border-bottom: none;
            }
            .foto-menu-item:hover {
                background: #f7fafc;
            }
            .foto-menu-item i {
                width: 20px;
                color: #4a5568;
            }
            .foto-menu-item span {
                color: #2d3748;
            }
        `;
        document.head.appendChild(styleItens);
        
        // Overlay para fechar
        const overlay = document.createElement('div');
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            z-index: 10001;
        `;
        document.body.appendChild(overlay);
        document.body.appendChild(editMenu);
        
        editMenu.querySelectorAll('[data-editar]').forEach(item => {
            item.addEventListener('click', function() {
                const acao = this.dataset.editar;
                editMenu.remove();
                overlay.remove();
                
                if (acao === 'camera') {
                    abrirCamera();
                } else if (acao === 'ficheiros') {
                    abrirFicheiros();
                }
            });
        });
        
        overlay.addEventListener('click', function() {
            editMenu.remove();
            overlay.remove();
        });
    }
    
    // ===================== DELETAR FOTO =====================
    function deletarFoto() {

    criarModal({
        titulo: 'Remover foto',

        mensagem: `
            Tem certeza que deseja remover esta foto?
            <br><br>
            Esta ação não poderá ser desfeita.
        `,

        confirmarTexto: 'Remover',
        cancelarTexto: 'Cancelar',
        mostrarCancelar: true,

        onConfirm: function() {

            const preview = document.getElementById('foto-preview');
            const icon = document.getElementById('foto-icon');

            if (preview) {
                preview.src = '';
                preview.style.display = 'none';
            }

            if (icon) {
                icon.style.display = 'block';
            }

            // Limpa input
            fotoInput.value = '';

            // Campo hidden
            let hiddenInput = document.querySelector('input[name="remover_foto"]');

            if (!hiddenInput) {

                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'remover_foto';
                hiddenInput.value = '1';

                if (fotoInput.form) {
                    fotoInput.form.appendChild(hiddenInput);
                }

            } else {

                hiddenInput.value = '1';
            }

            // Modal sucesso
            criarModal({
                titulo: 'Foto removida',

                mensagem: `
                    A foto foi removida com sucesso!
                `,

                confirmarTexto: 'OK',
                mostrarCancelar: false,
                tipo: 'sucesso'
            });
        }
    });
}
    
    // ===================== MOSTRAR ALERTA =====================
    function mostrarAlerta(mensagem, tipo = 'erro') {
        // Tenta usar o toastify se disponível
        if (typeof toast !== 'undefined' && toast.error) {
            if (tipo === 'erro') {
                toast.error(mensagem);
            } else {
                toast.success(mensagem);
            }
        } else {
            // Fallback para alert normal
            alert(mensagem);
        }
    }
    
    // ===================== EVENTO DE CLIQUE NA FOTO =====================
    fotoLabel.addEventListener('click', function(e) {
        // Impede que o clique propague
        e.preventDefault();
        e.stopPropagation();
        mostrarMenuFoto(e);
    });
    
    // ===================== EVENTO DE CHANGE DO INPUT FILE =====================
    fotoInput.addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            processarArquivoFoto(file);
        }
    });
});