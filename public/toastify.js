function mostrarMensagemErro(mensagem) {
    Toastify({
        text: mensagem,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        backgroundColor: "#FF3333", // vermelho de erro
    }).showToast();
}

function mostrarMensagemSucesso(mensagem) {
    Toastify({
        text: mensagem,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        backgroundColor: "#4BB543", // verde de sucesso
    }).showToast();
}

function mostrarMensagemInfo(mensagem) {
    Toastify({
        text: mensagem,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        backgroundColor: "#3498db", // azul de informação
    }).showToast();
}

function mostrarMensagemAlerta(mensagem) {
    Toastify({
        text: mensagem,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        backgroundColor: "#f39c12", // laranja de alerta
    }).showToast();
}
