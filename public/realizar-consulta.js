document.addEventListener('DOMContentLoaded', async () => {
    await listarDiagnosticos();
});
const salvar_diagnostico_btn = document.getElementById('salvar-diagnostico-btn');
salvar_diagnostico_btn.addEventListener('click', async () => {
    const diagnostico_textarea = document.getElementById('diagnostico-textarea');
    const diagnostico = diagnostico_textarea.value.trim();
    if (diagnostico === '') {
        alert('Por favor, preencha o diagnóstico antes de salvar.');
        return;
    }
    await fetch(api.salvarDiagnostico, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            diagnostico: diagnostico
        })
    });
    alert('Diagnóstico salvo com sucesso!');
    await listarDiagnosticos();
    diagnostico_textarea.value = ''; // Limpa o textarea após salvar
});
async function listarDiagnosticos() {
    try {
        const response = await fetch(api.listarDiagnosticos, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        if (!response.ok) {
            throw new Error('Erro ao listar diagnósticos: ' + response.statusText);
        }
        const diagnosticos = await response.json();
        const historicoDiagsnoticos = document.getElementById('historico-diagnosticos');
        historicoDiagsnoticos.innerHTML = '';
        diagnosticos.forEach((item) => {
            const novoItem = document.createElement('div');
            novoItem.className = 'rc-history-item';
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
        console.error('Erro ao listar diagnósticos:', error);
       
    }
}