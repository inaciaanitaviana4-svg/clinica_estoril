async function mostrarRemoverItemModal(url, options) {
    $("#remover-modal-error").attr("hidden", true);
    $("#remover-modal-error").text("");
    $("#remover-modal").modal("show");
    $("#confirm-button").on("click", async function (e) {
        await fetchRemoverItemModal(url, options);
    });
}

async function fetchRemoverItemModal(url, options) {
    const headers = options?.headers || {};
    const method = options?.method || 'GET';
    const recarregarPagina = options?.recarregarPagina ?? true;
    const callback = options?.callback;
    try {
        const response = await fetch(url, {
            method,
            headers: {
                ...headers,
            },
        });
        
        if (response.ok) {
            $("#remover-modal").modal("hide");
            $("#remover-modal-error").text("");

            if (callback) {
                callback?.(true);
            }
            if (recarregarPagina === true) {
                location.reload();
            }
        } else {
            const mensagem = await response.json();
            $("#remover-modal-error").attr("hidden", false);
            $("#remover-modal-error").text(
                "Erro ao remover item: " + mensagem?.erro || "",
            );
            if(callback) callback?.(false, mensagem?.erro || "");
            console.error("Erro ao remover item:", response);
        }
    } catch (error) {
        $("#remover-modal-error").attr("hidden", false);
        $("#remover-modal-error").text("Erro ao remover item");
        console.error("Erro ao remover item:", error);
       if(callback) callback?.(false, error);
    }
}
