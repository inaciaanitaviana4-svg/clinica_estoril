async function mostrarRemoverItemModal(url, options) {
    $("#remover-modal-error").attr("hidden", true);
    $("#remover-modal-error").text("");
    $("#remover-modal").modal("show");
    $("#confirm-button").on("click", async function (e) {
        await fetchRemoverItemModal(url, options);
    });
}

async function fetchRemoverItemModal(url, options) {
    try {
        const headers = options?.headers || {};
        const recarregarPagina = options?.recarregarPagina ?? true;
        const callback = options?.callback;

        const response = await fetch(url, {
            method: "GET",
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
            callback?.(false, mensagem?.erro || "");
            console.error("Erro ao remover item:", response);
        }
    } catch (error) {
        $("#remover-modal-error").attr("hidden", false);
        $("#remover-modal-error").text("Erro ao remover item");
        console.error("Erro ao remover item:", error);
        callback?.(false, error);
    }
}
