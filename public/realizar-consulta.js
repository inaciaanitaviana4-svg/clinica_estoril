document.addEventListener("DOMContentLoaded", async () => {
    await listarDiagnosticos();
    await listarExames();
    await listarMedicamentos();
});

async function salvarDiagnostico() {
    const diagnostico_textarea = document.getElementById(
        "diagnostico-textarea",
    );
    const diagnostico = diagnostico_textarea.value.trim();
    if (diagnostico === "") {
        mostrarMensagemAlerta(
            "Por favor, preencha o diagnóstico antes de salvar.",
        );
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
    mostrarMensagemSucesso("Diagnóstico salvo com sucesso!");
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
                "Erro ao listar diagnósticos: " + response.statusText,
            );
        }
        const diagnosticos = await response.json();
        const historicoDiagsnoticos = document.getElementById(
            "historico-diagnosticos",
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
        mostrarMensagemAlerta("Por favor, selecione um exame para adicionar.");
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

        mostrarMensagemSucesso("Exame adicionado com sucesso!");

        await listarExames();
        exameSelect.value = ""; // Limpa a seleção após adicionar
    } catch (error) {
        console.error("Erro ao adicionar exame:", error);
        mostrarMensagemErro(
            "Ocorreu um erro ao adicionar o exame. Por favor, tente novamente.\n" +
                error?.message || "",
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
                <td style="align-content: center;">${badge_estados_exames(
                    exame.status,
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
            "exame-resultado-modal",
        );
        let observacoesTextarea = document.getElementById(
            "exame-observacoes-modal",
        );
        let idInput = document.getElementById("exame-id-modal");

        const resultado = resultadoTextarea?.value?.trim() || "";
        const observacoes = observacoesTextarea?.value?.trim() || "";
        const id = idInput?.value?.trim();

        if (resultado === "") {
            mostrarMensagemAlerta(
                "Por favor, preencha o resultado antes de salvar.",
            );
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

        mostrarMensagemSucesso("Resultado salvo com sucesso!");
        $("#visualizarExameModal").modal("hide");
        await listarExames();

        resultadoTextarea.value = "";
        observacoesTextarea.value = "";
        idInput.value = "";
    } catch (error) {
        mostrarMensagemErro(
            "Ocorreu um erro ao salvar o resultado do exame: " +
                error?.message || "",
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
        mostrarMensagemErro(
            "Ocorreu um erro ao buscar os dados do exame: " + error?.message ||
                "",
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
        mostrarMensagemErro(
            "Ocorreu um erro ao buscar os dados do exame: " + error?.message ||
                "",
        );

        console.error("Erro ao adicionar resultado exame:", error);
    }
}
async function adicionarMedicamento() {
    const medicamentoInput = document.getElementById("receitaMedicamento");
    const dosagemInput = document.getElementById("receitaDosagem");
    const frequenciaInput = document.getElementById("receitaFrequencia");
    const duracaoInput = document.getElementById("receitaDuracao");
    const medicamento = medicamentoInput?.value?.trim() || "";
    const dosagem = dosagemInput?.value?.trim() || "";
    const frequencia = frequenciaInput?.value?.trim() || "";
    const duracao = duracaoInput?.value?.trim() || "";
    if (!medicamento) {
        mostrarMensagemAlerta(
            "Por favor, informe o medicamento para adicionar.",
        );
        return;
    }
    if (!dosagem) {
        mostrarMensagemAlerta("Por favor, informe a dosagem para adicionar.");
        return;
    }
    if (!frequencia) {
        mostrarMensagemAlerta(
            "Por favor, informe a frequência para adicionar.",
        );
        return;
    }
    if (!duracao) {
        mostrarMensagemAlerta("Por favor, informe a duração para adicionar.");
        return;
    }
    try {
        const response = await fetch(api.adicionarMedicamento, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                medicamento,
                dosagem,
                frequencia,
                duracao,
            }),
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(
                "Erro ao adicionar medicamento: " + data?.erro || "",
            );
        }

        mostrarMensagemSucesso("Medicamento adicionado com sucesso!");

        await listarMedicamentos();
        medicamentoInput.value = ""; // Limpa a seleção após adicionar
        dosagemInput.value = ""; // Limpa a seleção após adicionar
        frequenciaInput.value = ""; // Limpa a seleção após adicionar
        duracaoInput.value = ""; // Limpa a seleção após adicionar
    } catch (error) {
        console.error("Erro ao adicionar medicamento:", error);
        mostrarMensagemErro(
            "Ocorreu um erro ao adicionar o medicamento. Por favor, tente novamente.\n" +
                error?.message || "",
        );
    }
}

async function listarMedicamentos() {
    try {
        const response = await fetch(api.listarMedicamentos, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        if (!response.ok) {
            throw new Error(
                "Erro ao listar medicamentos: " + response.statusText,
            );
        }
        const medicamentos = await response.json();
        const tabelaMedicamentos =
            document.getElementById("lista-medicamentos");
        tabelaMedicamentos.innerHTML = "";
        medicamentos.forEach((medicamento) => {
            const novaLinha = document.createElement("div");
            novaLinha.innerHTML = `
               <div class="medication-item">
                        <div class="medication-fields">
                            <div>
                                <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.2rem;">Medicamento
                                </div>
                                <div style="font-weight:500;">${medicamento.medicamento}</div>
                            </div>
                            <div>
                                <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.2rem;">Dosagem
                                </div>
                                <div>${medicamento.dosagem}</div>
                            </div>
                            <div>
                                <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.2rem;">Frequência
                                </div>
                                <div>${medicamento.frequencia}</div>
                            </div>
                            <div>
                                <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.2rem;">Duração
                                </div>
                                <div>${medicamento.duracao}</div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-danger" onclick="removerMedicamento(${medicamento.id_receita_item})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
            `;
            tabelaMedicamentos.appendChild(novaLinha);
        });
    } catch (error) {
        console.error("Erro ao listar medicamentos:", error);
    }
}

async function removerMedicamento(id) {
    const url = api.removerMedicamento.replace(":id_medicamento", id);

    try {
        await mostrarRemoverItemModal(url, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            recarregarPagina: false,
            callback: async (sucesso) => {
                if (sucesso) {
                    await listarMedicamentos();
                } else {
                    mostrarMensagemErro(
                        "Não foi possível remover o medicamento. Por favor, tente novamente.",
                    );
                }
            },
        });
    } catch (error) {
        console.error("Erro ao remover medicamento:", error);
        mostrarMensagemErro(
            "Ocorreu um erro ao remover o medicamento. Por favor, tente novamente.",
        );
    }
}

async function salvarObservacoesReceita() {
    const observacoesTextarea = document.getElementById("observacoes-receita");
    const observacoes = observacoesTextarea?.value?.trim() || "";

    try {
        const response = await fetch(api.salvarObservacoesReceita, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                observacoes: observacoes,
            }),
        });
        if (!response.ok) {
            const data = await response.json();
            throw new Error(
                data?.erro || "Erro ao salvar observações da receita",
            );
        }
        mostrarMensagemSucesso("Observações salvas com sucesso!");
    } catch (error) {
        console.error("Erro ao salvar observações da receita:", error);
        mostrarMensagemErro(
            "Ocorreu um erro ao salvar as observações da receita. Por favor, tente novamente.\n" +
                error?.message || "",
        );
    }
}

async function imprimirReceita(id) {
    try {
        const response = await fetch(api.buscarReceita, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        const data = await response.json();

        if (!response.ok) {
            const data = await response.json();
            throw new Error(data?.erro || "Erro ao buscar receita");
        }
 // definição do layout do PDF usando pdfMake
        const docDefinition = {
            pageSize: "A4",
            pageMargins: [40, 60, 40, 60],
            content: [
                {
                    text: "RECEITA MÉDICA",
                    style: "header",
                    alignment: "center",
                },
                { text: "\n" },

                {
                    columns: [
                        [
                            {
                                text: `Paciente: ${data.consulta.nome_paciente}`,
                            },
                            {
                                text: `Idade: ${new Date().getFullYear() - new Date(data.consulta.data_nascimento_paciente).getFullYear()} anos`,
                            },
                            {
                                text: `Telefone: ${data.consulta.telefone_paciente}`,
                            },
                        ],
                        [
                            { text: `Data: ${data.consulta.data}` },
                            { text: `Hora: ${data.consulta.hora}` },
                            {
                                text: `Serviço: ${data.consulta.nome_servico_clinico}`,
                            },
                        ],
                    ],
                },

                { text: "\nPrescrição:\n", style: "subheader" },

                {
                    table: {
                        widths: ["*", 70, 80, 70],
                        body: [
                            [
                                { text: "Medicamento", bold: true },
                                { text: "Dosagem", bold: true },
                                { text: "Frequência", bold: true },
                                { text: "Duração", bold: true },
                            ],
                            ...data.medicamentos.map((item) => [
                                item.medicamento,
                                item.dosagem,
                                item.frequencia,
                                item.duracao,
                            ]),
                        ],
                    },
                    layout: "lightHorizontalLines",
                },

                data.consulta.observacoes_receita
                    ? {
                          text: `\nObservações:\n${data.consulta.observacoes_receita}`,
                      }
                    : {},

                {
                    text: "\n\n\n__________________________________\nAssinatura do Médico",
                    alignment: "right",
                },

                {
                    text: `\nDr(a). ${data.consulta.nome_medico}`,
                    alignment: "right",
                },
            ],
            styles: {
                header: { fontSize: 18, bold: true },
                subheader: { fontSize: 14, bold: true },
            },
        };

        const pdfDocGenerator = pdfMake.createPdf(docDefinition);

        pdfDocGenerator.getBuffer((buffer) => {
            // Cria um Blob e uma URL para o PDF
            const blob = new Blob([buffer], { type: "application/pdf" });
            const dataUrl = URL.createObjectURL(blob);

            // Cria um iframe invisível
            const iframe = document.createElement("iframe");
            iframe.style.display = "none";
            iframe.src = dataUrl;

            document.body.appendChild(iframe);

            // Dispara a impressão quando o PDF carregar no iframe
            iframe.onload = () => {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();

                // Opcional: remover o iframe após um tempo para limpeza
                 //setTimeout(() => {
                     //URL.revokeObjectURL(dataUrl);
                     //document.body.removeChild(iframe);
               //  }, 1000);
            };
        });
    } catch (error) {
        console.error("Erro ao imprimir receita:", error);
        mostrarMensagemErro(
            "Ocorreu um erro ao imprimir a receita. Por favor, tente novamente.",
        );
    }
}
