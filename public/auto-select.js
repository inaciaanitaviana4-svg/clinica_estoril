function formatarMoeda(valor) {
    return valor.toLocaleString('pt-AO', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}
const tipoConsultaSelect = document.querySelector('.tipo_consulta_auto_select');
const servicoClinicoSelect = document.querySelector('.servico_clinico_auto_select');
tipoConsultaSelect?.addEventListener("change", (e) => {
    const tipoConsultaId = e.target.value;
    servicoClinicoSelect.innerHTML = '<option value="">Selecione o serviço clínico</option>';
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
const horarioPacienteSelect = document.querySelector('.horario_auto_select');
servicoClinicoSelect?.addEventListener("change", (e) => {
    const servicoClinicoId = e.target.value;

    if(horarioPacienteSelect) {
        horarioPacienteSelect.innerHTML = '<option value="">Selecione o horário</option>';
        fetch(`/api/medicos/horarios?id_servico_clinico=${servicoClinicoId}`)
        .then(response => response.json())
        .then(data => {
              if (data.erro) {
                mostrarMensagemErro(data.erro);
                return;
            }
            // Atualizar as opções do select de serviços clínicos com os dados recebidos
            horarioPacienteSelect.innerHTML = '<option value="">Selecione o horário</option>';
            data.forEach(horrio => {
                const option = document.createElement('option');
                option.value = horrio.hora;
                     option.text = `${mostrarDiaSemana(horrio.dia_semana)}${horrio.hora}`;
                horarioPacienteSelect.appendChild(option);
            });
        });
    }
     medicoSelect.innerHTML = '<option value="">Selecione o médico</option>';
    fetch(`/api/servicos-clinicos/medicos?id_servico_clinico=${servicoClinicoId}`)
        .then(response => response.json())
        .then(data => {
            if (data.erro) {
                mostrarMensagemErro(data.erro);
            }
            // Atualizar as opções do select de médicos com os dados recebidos
            medicoSelect.innerHTML = '<option value="">Selecione o médico</option>';
            data.medicos.forEach(medico => {
                const option = document.createElement('option');
                option.value = medico.id_medico;
                option.text = `${medico.nome} (${medico.especialidade})`;
                medicoSelect.appendChild(option);
            });
        });
})
const horarioSelect = document.querySelector('.horario_auto_select');
function mostrarDiaSemana(diaSemana) {
    const diasSemana = {
        1: 'Segunda-feira - ',
        2: 'Terca-feira - ',
        3: 'Quarta-feira - ',
        4: 'Quinta-feira - ',
        5: 'Sexta-feira - ',
        6: 'Sábado - ',
        7: 'Domingo - '
    };
    return diasSemana[diaSemana] || '';
}
const medicoSelect = document.querySelector('.medico_auto_select');
medicoSelect?.addEventListener("change", (e) => {
    const medicoId = e.target.value;
     horarioSelect.innerHTML = '<option value="">Selecione o horário</option>';
    fetch(`/api/medicos/horarios?id_medico=${medicoId}`)
        .then(response => response.json())
        .then(data => {
              if (data.erro) {
                mostrarMensagemErro(data.erro);
                return;
            }
            // Atualizar as opções do select de serviços clínicos com os dados recebidos
            horarioSelect.innerHTML = '<option value="">Selecione o horário</option>';
            data.forEach(horrio => {
                const option = document.createElement('option');
                option.value = horrio.hora;
                option.text = `${mostrarDiaSemana(horrio.dia_semana)}${horrio.hora}`;
                horarioSelect.appendChild(option);
            });
        });
})
