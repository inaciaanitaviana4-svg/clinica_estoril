const tipoConsultaSelect = document.querySelector('.tipo_consulta_auto_select');
const servicoClinicoSelect = document.querySelector('.servico_clinico_auto_select');
tipoConsultaSelect?.addEventListener("change", (e) => {
    const tipoConsultaId = e.target.value;
    fetch(`/api/servicos-clinicos?tipo_consulta_id=${tipoConsultaId}`)
        .then(response => response.json())
        .then(data => {
            // Atualizar as opções do select de serviços clínicos com os dados recebidos
            servicoClinicoSelect.innerHTML = '<option value="">Selecione o serviço clínico</option>';
            data.forEach(servico => {
                const option = document.createElement('option');
                option.value = servico.id_servico_clinico;
                option.text = `${servico.nome} (${formatarMoeda(servico.preco)})`;
                servicoClinicoSelect.appendChild(option);
            });
        });
})
function formatarMoeda(valor) {
    return valor.toLocaleString('pt-AO', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}