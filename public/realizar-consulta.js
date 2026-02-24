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
        if (!response.ok) {
            throw new Error("Erro ao adicionar exame: " + response.statusText);
        }
        const exame = await response.json();
        alert("Exame adicionado com sucesso!");
        await listarExames();
        exameSelect.value = ""; // Limpa a seleção após adicionar
    } catch (error) {
        console.error("Erro ao adicionar exame:", error);
        alert(
            "Ocorreu um erro ao adicionar o exame. Por favor, tente novamente."
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
                acaoBtn = `<button class="btn btn-sm btn-primary" onclick="adicionarResultadoExame(${exame.id_exame_realizado},${exame})">Adicionar Resultado</button>`;
            } else if (exame.status === "REALIZADO") {
                acaoBtn = `<button class="btn btn-sm btn-success" onclick="visualizarExame(${exame.id_exame_realizado}, ${exame})">Visualizar Resultado</button>`;
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

function adicionarResultadoExame(id, dados) {
    console.log({ id, dados });
}

function visualizarExame(id, dados) {
    cosole.log({ id, dados });
}
