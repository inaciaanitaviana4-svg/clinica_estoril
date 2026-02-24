document.addEventListener("DOMContentLoaded", async () => {
    await listarDiagnosticos();
    await listarExames();
});

async function salvarDiagnostico() {
    const diagnostico_textarea = document.getElementById(
        "diagnostico-textarea"
    );
    const diagnostico = diagnostico_textarea.value.trim();
    if (diagnostico === "") {
        alert("Por favor, preencha o diagnóstico antes de salvar.");
        return;
    }
    await fetch(api.salvarDiagnostico, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            diagnostico: diagnostico,
        }),
    });
    alert("Diagnóstico salvo com sucesso!");
    await listarDiagnosticos();
    diagnostico_textarea.value = ""; // Limpa o textarea após salvar
}

async function listarDiagnosticos() {
    try {
        const response = await fetch(api.listarDiagnosticos, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        if (!response.ok) {
            throw new Error(
                "Erro ao listar diagnósticos: " + response.statusText
            );
        }
        const diagnosticos = await response.json();
        const historicoDiagsnoticos = document.getElementById(
            "historico-diagnosticos"
        );
        historicoDiagsnoticos.innerHTML = "";
        diagnosticos.forEach((item) => {
            const novoItem = document.createElement("div");
            novoItem.className = "rc-history-item";
            novoItem.innerHTML = `
                <div class="rc-history-meta">
                    <span><i class="fa-regular fa-calendar-days"></i> ${item.data}</span>
                    <span><i class="fa-solid fa-user-doctor"></i>${item.medico}</span>
                </div>
                <div class="rc-history-content">${item.descricao}</div>
                `;

            historicoDiagsnoticos.appendChild(novoItem);
        });
    } catch (error) {
        console.error("Erro ao listar diagnósticos:", error);
    }
}

async function adicionarExame() {
    const exameSelect = document.getElementById("exame-select");
    const exameId = exameSelect.value;
    if (!exameId) {
        alert("Por favor, selecione um exame para adicionar.");
        return;
    }
    try {
        const response = await fetch(api.registroExame, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                id_servico_clinico: exameId,
            }),
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error("Erro ao adicionar exame: " + data?.erro || "");
        }

        alert("Exame adicionado com sucesso!");

        await listarExames();
        exameSelect.value = ""; // Limpa a seleção após adicionar
    } catch (error) {
        console.error("Erro ao adicionar exame:", error);
        alert(
            "Ocorreu um erro ao adicionar o exame. Por favor, tente novamente.\n" +
                error?.message || ""
        );
    }
}

async function listarExames() {
    try {
        const response = await fetch(api.listarExames, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        if (!response.ok) {
            throw new Error("Erro ao listar exames: " + response.statusText);
        }
        const exames = await response.json();
        const tabelaExames = document.getElementById("tabela-exame");
        tabelaExames.innerHTML = "";
        exames.forEach((exame) => {
            const novaLinha = document.createElement("tr");
            let acaoBtn = "";
            if (exame.status === "PENDENTE") {
                acaoBtn = `<button class="btn btn-sm btn-primary" onclick="adicionarResultadoExame(${exame.id_exame_solicitado})">Adicionar Resultado</button>`;
            } else if (exame.status === "REALIZADO") {
                acaoBtn = `<button class="btn btn-sm btn-success" onclick="visualizarExame(${exame.id_exame_solicitado})">Visualizar Resultado</button>`;
            }
            novaLinha.innerHTML = `
                <td style="align-content: center;">${exame.nome_exame}</td>
                <td style="align-content: center;">${badge_estados(
                    exame.status
                )}</td>
                <td style="align-content: center;">
                    ${acaoBtn}
                </td>
            `;
            tabelaExames.appendChild(novaLinha);
        });
    } catch (error) {
        console.error("Erro ao listar exames:", error);
    }
}

async function salvarResultadoExame() {
    try {
        let resultadoTextarea = document.getElementById(
            "exame-resultado-modal"
        );
        let observacoesTextarea = document.getElementById(
            "exame-observacoes-modal"
        );
        let idInput = document.getElementById("exame-id-modal");

        const resultado = resultadoTextarea?.value?.trim() || "";
        const observacoes = observacoesTextarea?.value?.trim() || "";
        const id = idInput?.value?.trim();

        if (resultado === "") {
            alert("Por favor, preencha o resultado antes de salvar.");
            return;
        }

        const url = api.salvarResultadoExame.replace(":id_exame", id);
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                resultado,
                observacoes,
            }),
        });

        if (!response.ok) {
            const data = await response.json();
            throw new Error(data?.erro || "Error ao salvar resultado do exame");
        }

        alert("Resultado salvo com sucesso!");
        $("#visualizarExameModal").modal("hide");
        await listarExames();

        resultadoTextarea.value = "";
        observacoesTextarea.value = "";
        idInput.value = "";
    } catch (error) {
        alert(
            "Ocorreu um erro ao salvar o resultado do exame: " +
                error?.message || ""
        );

        console.error("Erro ao salvar resultado do exame:", error);
    }
}

async function adicionarResultadoExame(id) {
    try {
        const url = api.buscarExame.replace(":id_exame", id);
        const response = await fetch(url, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });

        const data = await response.json();

        if (!response?.ok) {
            throw new Error(data?.erro || "Erro ao buscar os dados do exame");
        }

        let salvarBtn = document.getElementById("salvar-resultado-exame-btn");
        let idInput = document.getElementById("exame-id-modal");
        let title = document.getElementById("exame-titulo-modal");
        let resultado = document.getElementById("exame-resultado-modal");
        let observacoes = document.getElementById("exame-observacoes-modal");

        title.removeAttribute("readonly");
        resultado.removeAttribute("readonly");
        observacoes.removeAttribute("readonly");
        title.removeAttribute("disabled");
        resultado.removeAttribute("disabled");
        observacoes.removeAttribute("disabled");
        salvarBtn.style.display = "block";

        idInput.value = id;
        title.innerHTML = `Exame: ${data?.nome_exame || ""}`;
        resultado.value = data?.resultado || "";
        observacoes.value = data?.observacoes || "";

        $("#visualizarExameModal").modal("show");
    } catch (error) {
        alert(
            "Ocorreu um erro ao buscar os dados do exame: " + error?.message ||
                ""
        );

        console.error("Erro ao adicionar resultado exame:", error);
    }
}

async function visualizarExame(id) {
    try {
        const url = api.buscarExame.replace(":id_exame", id);
        const response = await fetch(url, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });

        const data = await response.json();

        if (!response?.ok) {
            throw new Error(data?.erro || "Erro ao buscar os dados do exame");
        }

        let salvarBtn = document.getElementById("salvar-resultado-exame-btn");
        let idInput = document.getElementById("exame-id-modal");
        let title = document.getElementById("exame-titulo-modal");
        let resultado = document.getElementById("exame-resultado-modal");
        let observacoes = document.getElementById("exame-observacoes-modal");

        idInput.value = id;
        title.innerHTML = `Exame: ${data?.nome_exame || ""}`;
        resultado.value = data?.resultado || "";
        observacoes.value = data?.observacoes || "";

        title.setAttribute("readonly", "readonly");
        resultado.setAttribute("readonly", "readonly");
        observacoes.setAttribute("readonly", "readonly");
        title.setAttribute("disabled", "disabled");
        resultado.setAttribute("disabled", "disabled");
        observacoes.setAttribute("disabled", "disabled");
        salvarBtn.style.display = "none";

        $("#visualizarExameModal").modal("show");
    } catch (error) {
        alert(
            "Ocorreu um erro ao buscar os dados do exame: " + error?.message ||
                ""
        );

        console.error("Erro ao adicionar resultado exame:", error);
    }
}
