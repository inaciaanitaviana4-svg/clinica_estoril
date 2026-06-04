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
  // ===================== ABRIR CÂMERA — versão universal =====================
function abrirCamera() {

    // ── 1. Detecta o dispositivo/browser ──────────────────────────────────
    const isMobile  = /Android|iPhone|iPad|iPod|Mobile/i.test(navigator.userAgent);
    const isIOS     = /iPhone|iPad|iPod/i.test(navigator.userAgent);
    const isSafari  = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    const isChrome  = /Chrome/i.test(navigator.userAgent) && !/Edge/i.test(navigator.userAgent);
    const isFirefox = /Firefox/i.test(navigator.userAgent);

    // ── 2. iOS Safari: usa input[capture] nativo (getUserMedia tem bugs no iOS) ──
    if (isIOS) {
        const input = document.createElement('input');
        input.type    = 'file';
        input.accept  = 'image/*';
        input.capture = 'user'; // câmara frontal no iOS
        input.style.display = 'none';
        document.body.appendChild(input);

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) processarArquivoFoto(file);
            document.body.removeChild(input);
        });

        // iOS requer que o click seja disparado directamente — sem setTimeout
        input.click();
        return;
    }

    // ── 3. Verifica suporte getUserMedia ──────────────────────────────────
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        // Fallback: input com capture para Android antigo / browsers legados
        const input = document.createElement('input');
        input.type    = 'file';
        input.accept  = 'image/*';
        input.capture = 'environment';
        input.style.display = 'none';
        document.body.appendChild(input);
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) processarArquivoFoto(file);
            document.body.removeChild(input);
        });
        input.click();
        return;
    }

    // ── 4. Verifica HTTPS ─────────────────────────────────────────────────
    if (!window.isSecureContext) {
        criarModal({
            titulo: 'Página não segura',
            mensagem: 'O acesso à câmera requer HTTPS. Verifica se estás a aceder via <strong>https://</strong> e não http://',
            confirmarTexto: 'OK',
            mostrarCancelar: false
        });
        return;
    }

    // ── 5. Cria o overlay ─────────────────────────────────────────────────
    const overlay = document.createElement('div');
    overlay.id = 'camera-overlay';
    overlay.style.cssText = `
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.96);
        z-index: 99999;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: ${isMobile ? '12px' : '20px'};
        font-family: sans-serif;
        box-sizing: border-box;
        padding: ${isMobile ? '16px' : '24px'};
    `;

    const loadingMsg = document.createElement('p');
    loadingMsg.textContent = 'A aguardar permissão da câmera...';
    loadingMsg.style.cssText = 'color:rgba(255,255,255,0.7);font-size:14px;margin:0;text-align:center;';
    overlay.appendChild(loadingMsg);
    document.body.appendChild(overlay);

    // Bloqueia scroll do body enquanto câmera está aberta
    document.body.style.overflow = 'hidden';

    let stream       = null;
    let usandoFrontal = true;

    // ── 6. Lista de constraints — tenta do mais específico ao mais genérico ──
    const constraints = [
        { video: { facingMode: 'user',        width: { ideal: 1280 }, height: { ideal: 720 } }, audio: false },
        { video: { facingMode: 'environment', width: { ideal: 1280 }, height: { ideal: 720 } }, audio: false },
        { video: { width: { ideal: 1280 },    height: { ideal: 720 } }, audio: false },
        { video: true, audio: false }
    ];

    function tentarConstraint(index) {
        if (index >= constraints.length) {
            fecharCamera();
            criarModal({
                titulo: 'Câmera indisponível',
                mensagem: `
                    Não foi possível aceder à câmera.<br><br>
                    <strong>Possíveis causas:</strong><br>
                    • Permissão negada — clica no 🔒 na barra de endereço e permite a câmera<br>
                    • Câmera em uso por outra aplicação<br>
                    • Dispositivo sem câmera
                `,
                confirmarTexto: 'OK',
                mostrarCancelar: false
            });
            return;
        }

        navigator.mediaDevices.getUserMedia(constraints[index])
            .then(function (mediaStream) {
                stream = mediaStream;
                construirUI(mediaStream);
            })
            .catch(function (err) {
                console.warn('[Câmera] Tentativa ' + (index + 1) + ' falhou:', err.name, err.message);

                if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                    fecharCamera();
                    // Mensagem adaptada ao browser
                    let instrucoes = '';
                    if (isFirefox) {
                        instrucoes = '1. Clica no ícone 🎥 na barra de endereço<br>2. Selecciona "Permitir" para a câmera<br>3. Recarrega a página';
                    } else if (isMobile) {
                        instrucoes = '1. Vai às Definições do teu telemóvel<br>2. Privacidade → Câmera<br>3. Permite o acesso para este browser<br>4. Volta e tenta novamente';
                    } else {
                        instrucoes = '1. Clica no ícone 🔒 na barra de endereço<br>2. Em "Câmera", selecciona "Permitir"<br>3. Recarrega a página';
                    }
                    criarModal({
                        titulo: 'Permissão negada',
                        mensagem: `Bloqueaste o acesso à câmera.<br><br><strong>Para corrigir:</strong><br>${instrucoes}`,
                        confirmarTexto: 'OK',
                        mostrarCancelar: false
                    });
                } else if (err.name === 'NotFoundError' || err.name === 'DevicesNotFoundError') {
                    fecharCamera();
                    criarModal({
                        titulo: 'Câmera não encontrada',
                        mensagem: 'Nenhuma câmera foi detectada neste dispositivo.',
                        confirmarTexto: 'OK',
                        mostrarCancelar: false
                    });
                } else if (err.name === 'NotReadableError' || err.name === 'AbortError') {
                    fecharCamera();
                    criarModal({
                        titulo: 'Câmera ocupada',
                        mensagem: 'A câmera está a ser usada por outra aplicação. Fecha outras aplicações que usem a câmera e tenta novamente.',
                        confirmarTexto: 'OK',
                        mostrarCancelar: false
                    });
                } else {
                    tentarConstraint(index + 1);
                }
            });
    }

    // ── 7. Constrói a UI da câmera ────────────────────────────────────────
    function construirUI(mediaStream) {
        overlay.innerHTML = '';

        const video = document.createElement('video');
        video.autoplay    = true;
        video.playsInline = true; // ESSENCIAL para iOS e mobile em geral
        video.muted       = true; // Necessário para autoplay funcionar em todos os browsers
        video.srcObject   = mediaStream;
        video.setAttribute('playsinline', '');       // atributo HTML para Safari
        video.setAttribute('webkit-playsinline', ''); // Safari antigo

        video.style.cssText = `
            width: 100%;
            max-width: ${isMobile ? '100%' : '500px'};
            max-height: ${isMobile ? '55vh' : '60vh'};
            border-radius: ${isMobile ? '10px' : '14px'};
            background: #111;
            object-fit: cover;
            box-shadow: 0 8px 32px rgba(0,0,0,0.6);
            transform: scaleX(-1);
        `;

        const canvas = document.createElement('canvas');
        canvas.style.display = 'none';

        // Instrução
        const instrucao = document.createElement('p');
        instrucao.textContent = isMobile
            ? 'Toca em "Capturar" para tirar a foto'
            : 'Posiciona o rosto e clica em "Capturar foto"';
        instrucao.style.cssText = `
            color: rgba(255,255,255,0.65);
            font-size: ${isMobile ? '12px' : '13px'};
            margin: 0;
            text-align: center;
        `;

        // ── Botão de trocar câmera (só em mobile com múltiplas câmeras) ──
        const btnRow = document.createElement('div');
        btnRow.style.cssText = `
            display: flex;
            gap: ${isMobile ? '10px' : '12px'};
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
        `;

        // Botão Capturar
        const btnCapturar = document.createElement('button');
        btnCapturar.type = 'button';
        btnCapturar.innerHTML = `<i class="fa-solid fa-camera" style="margin-right:8px;"></i>${isMobile ? 'Capturar' : 'Capturar foto'}`;
        btnCapturar.style.cssText = `
            background: #0066cc;
            color: white;
            border: none;
            padding: ${isMobile ? '14px 28px' : '13px 30px'};
            border-radius: 50px;
            font-size: ${isMobile ? '16px' : '15px'};
            font-weight: 600;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        `;

        // Botão Trocar câmera (frente/traseira) — útil em mobile
        const btnTrocar = document.createElement('button');
        btnTrocar.type = 'button';
        btnTrocar.innerHTML = '<i class="fa-solid fa-rotate"></i>';
        btnTrocar.title = 'Trocar câmera';
        btnTrocar.style.cssText = `
            background: rgba(255,255,255,0.15);
            color: white;
            border: none;
            width: ${isMobile ? '52px' : '48px'};
            height: ${isMobile ? '52px' : '48px'};
            border-radius: 50%;
            font-size: ${isMobile ? '18px' : '16px'};
            cursor: pointer;
            display: ${isMobile ? 'flex' : 'none'};
            align-items: center;
            justify-content: center;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        `;

        // Botão Cancelar
        const btnCancelar = document.createElement('button');
        btnCancelar.type = 'button';
        btnCancelar.innerHTML = `<i class="fa-solid fa-xmark" style="margin-right:8px;"></i>${isMobile ? 'Cancelar' : 'Cancelar'}`;
        btnCancelar.style.cssText = `
            background: rgba(255,255,255,0.12);
            color: white;
            border: none;
            padding: ${isMobile ? '14px 22px' : '13px 24px'};
            border-radius: 50px;
            font-size: ${isMobile ? '16px' : '15px'};
            font-weight: 600;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        `;

        btnRow.appendChild(btnCapturar);
        if (isMobile) btnRow.appendChild(btnTrocar);
        btnRow.appendChild(btnCancelar);

        overlay.appendChild(video);
        overlay.appendChild(canvas);
        overlay.appendChild(instrucao);
        overlay.appendChild(btnRow);

        // Garante que o vídeo arranca (Edge, Safari e Firefox às vezes precisam)
        video.addEventListener('loadedmetadata', () => {
            video.play().catch(e => console.warn('[Câmera] play() falhou:', e));
        });

        // ── Capturar foto ──
        btnCapturar.addEventListener('click', function () {
            const largura = video.videoWidth  || 640;
            const altura  = video.videoHeight || 480;

            canvas.width  = largura;
            canvas.height = altura;

            const ctx = canvas.getContext('2d');
            // Espelha para corrigir o mirror do vídeo
            ctx.translate(largura, 0);
            ctx.scale(-1, 1);
            ctx.drawImage(video, 0, 0, largura, altura);

            canvas.toBlob(function (blob) {
                if (!blob) { console.error('[Câmera] toBlob falhou'); return; }
                const file = new File([blob], 'foto-perfil.jpg', { type: 'image/jpeg' });
                fecharCamera();
                processarArquivoFoto(file);
            }, 'image/jpeg', 0.92);
        });

        // ── Trocar câmera (frente ↔ traseira) ──
        btnTrocar.addEventListener('click', function () {
            usandoFrontal = !usandoFrontal;
            // Para o stream actual
            if (stream) stream.getTracks().forEach(t => t.stop());
            overlay.innerHTML = '';
            const msg = document.createElement('p');
            msg.textContent = 'A trocar câmera...';
            msg.style.cssText = 'color:rgba(255,255,255,0.7);font-size:14px;margin:0;';
            overlay.appendChild(msg);

            navigator.mediaDevices.getUserMedia({
                video: { facingMode: usandoFrontal ? 'user' : 'environment' },
                audio: false
            }).then(function (novoStream) {
                stream = novoStream;
                construirUI(novoStream);
            }).catch(function () {
                // Se falhar, tenta o genérico
                navigator.mediaDevices.getUserMedia({ video: true, audio: false })
                    .then(function (novoStream) { stream = novoStream; construirUI(novoStream); })
                    .catch(fecharCamera);
            });
        });

        // ── Cancelar ──
        btnCancelar.addEventListener('click', fecharCamera);
    }

    // ── 8. Fecha e limpa tudo ─────────────────────────────────────────────
    function fecharCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            stream = null;
        }
        document.body.style.overflow = '';
        const el = document.getElementById('camera-overlay');
        if (el) el.remove();
    }

    // Fecha com ESC (desktop)
    const fecharEsc = function (e) {
        if (e.key === 'Escape') {
            fecharCamera();
            document.removeEventListener('keydown', fecharEsc);
        }
    };
    document.addEventListener('keydown', fecharEsc);

    // ── 9. Arranca ────────────────────────────────────────────────────────
    tentarConstraint(0);
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
                <span style="color:black;">Tirar nova foto</span>
            </div>
            <div class="foto-menu-item" data-editar="ficheiros">
                <i class="fa-regular fa-folder-open"></i>
                <span style="color:black;">Escolher da galeria</span>
            </div>
            <div class="foto-menu-item" data-editar="cancelar" style="border-top: 1px solid #e2e8f0;">
                <i class="fa-solid fa-xmark"></i>
                <span style="color:black;">Cancelar</span>
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