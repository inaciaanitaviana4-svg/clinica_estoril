@extends('layouts.painel')
@section('titulo', 'Agendamento')
@section('conteudo')

<section>
    <div class="login-container">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align:center;"><strong>Agendamento</strong></h2>
            <br>

            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center;
                            padding:8px;border-radius:4px;margin-bottom:12px;">
                    {{ session('erro') }}
                </div>
            @endif

            <form method="post" id="formAgendamento"
                  action="{{ route('salvar_atendimento_recepcionista') }}">
                {{ csrf_field() }}

                

                {{-- LINHA 2: Paciente (pesquisa) --}}
                <div class="form-group">
                    <label for="pp-input-paciente">Paciente <span style="color:#ef4444">*</span></label>
                    <div class="pp-wrapper" id="pp-wrapper-paciente">
                        <div class="pp-input-row">
                            <input type="text"
                                   id="pp-input-paciente"
                                   placeholder="Pesquisar paciente pelo nome..."
                                   autocomplete="off">
                            <button type="button" class="btn btn-primary"
                                    onclick="ppPesquisarAtend('paciente')">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="pp-selecionado" id="pp-sel-paciente"></div>
                        <div class="pp-dropdown"   id="pp-drop-paciente"></div>
                    </div>
                    <input type="hidden" id="id_paciente" name="id_paciente">
                    <small class="erro" id="erro-paciente"></small>
                </div>

                {{-- LINHA 3: Data + Horário --}}
                <div>
                    <div class=" form-group">
                        <label for="data">Data da consulta</label>
                        <input class="w-100" type="date" id="data" name="data" required>
                        <small class="erro" id="erro-data"></small>
                    </div>
                    
                

                {{-- LINHA 4: Tipo de consulta + Serviço clínico --}}
                <div>
                    <div class=" form-group">
                        <label for="id_tipo_consulta">Tipo de consulta</label>
                        <select class="w-100 tipo_consulta_auto_select"
                                id="id_tipo_consulta" name="id_tipo_consulta">
                            <option value="">Selecione o tipo de consulta</option>
                            @foreach ($tipos_consultas as $tipo)
                                <option value="{{ $tipo->id_tipo_consulta }}">
                                    {{ $tipo->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" form-group">
                        <label for="id_servico_clinico">Serviços clínicos</label>
                        <select class="w-100 servico_clinico_auto_select"
                                id="id_servico_clinico" name="id_servico_clinico">
                                 <option value="">Selecione um serviçõ Clínico</option>
                        </select>
                    </div>
                </div>

                {{-- LINHA 5: Médico (pesquisa) --}}
                <div class=" form-group">
                        <label for="id_medico">Medico</label>
                        <select class="w-100 medico_auto_select" id="id_medico" name="id_medico">
                            <option value="">Selecione um medico</option>
                            

                        </select>
                    </div>

                <div class="form-group">
                        <label for="hora">Horário Preferencial</label>
                        <select class="w-100 horario_auto_select" id="hora" name="hora">
                 <option value="">Selecione um horário</option>
</select>
                    </div>

                {{-- LINHA 6: Observação --}}
                <div class="form-group">
                    <label for="observacao">Observação</label>
                    <textarea id="observacao" name="observacao" rows="5"
                        placeholder="Descreva brevemente o motivo da consulta ou dúvidas"></textarea>
                    <small class="erro" id="erro-obs"></small>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-paper-plane"></i> Agendar
                    </button>
                    <p class="form-note">
                        Entraremos em contacto para confirmar o agendamento.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
@section('script')
<script src="/auto-select.js"></script>
   
    <script>
    // ── Pesquisa de Paciente e Médico no Atendimento ──────────────────────────────
const PP_API_PACIENTE = "{{ route('api_pesquisar_pacientes') }}";
const PP_API_MEDICO   = "/api/pesquisar-medicos"; // rota a criar — ver abaixo
let ppTimersAtend = {};

async function ppPesquisarAtendimento(tipo) {
    const termo = document.getElementById(`pp-input-${tipo}`).value.trim();
    const drop  = document.getElementById(`pp-drop-${tipo}`);

    if (termo.length < 2) {
        drop.innerHTML = '<div class="pp-vazio">Digite pelo menos 2 caracteres.</div>';
        drop.classList.add('aberto');
        return;
    }

    drop.innerHTML = '<div class="pp-loading"><i class="fa fa-spinner fa-spin"></i> A pesquisar...</div>';
    drop.classList.add('aberto');

    try {
        const api = tipo === 'paciente' ? PP_API_PACIENTE : PP_API_MEDICO;
        const res  = await fetch(`${api}?termo=${encodeURIComponent(termo)}`);
        const data = await res.json();

        if (!data.length) {
            drop.innerHTML = '<div class="pp-vazio">Nenhum resultado encontrado.</div>';
            return;
        }

        if (tipo === 'paciente') {
            drop.innerHTML = data.map(p => `
                <div class="pp-item"
                     onclick="ppSelecionarAtendimento('paciente', ${p.id_paciente}, '${p.nome.replace(/'/g,"\\'")}', '${(p.num_telefone||'').replace(/'/g,"\\'")}', '')">
                    <strong>${p.nome}</strong>
                    <div class="pp-item-sub">
                        ${p.num_telefone || ''}
                        ${p.email ? '· ' + p.email : ''}
                    </div>
                </div>
            `).join('');
        } else {
            drop.innerHTML = data.map(m => `
                <div class="pp-item"
                     onclick="ppSelecionarAtendimento('medico', ${m.id_medico}, '${m.nome.replace(/'/g,"\\'")}', '${(m.especialidade||'').replace(/'/g,"\\'")}', '${(m.num_telefone||'').replace(/'/g,"\\'")}')">
                    <strong>${m.nome}</strong>
                    <div class="pp-item-sub">
                        ${m.especialidade || ''}
                        ${m.num_telefone ? '· ' + m.num_telefone : ''}
                    </div>
                </div>
            `).join('');
        }

    } catch (err) {
        drop.innerHTML = '<div class="pp-vazio">Erro ao pesquisar. Tente novamente.</div>';
    }
}

function ppSelecionarAtendimento(tipo, id, nome, sub, extra) {
    // Guarda o id no hidden
    document.getElementById(`id_${tipo}`).value = id;

    // Destaca item no dropdown
    const drop = document.getElementById(`pp-drop-${tipo}`);
    drop.querySelectorAll('.pp-item').forEach(i => i.classList.remove('selecionado'));
    event.currentTarget.classList.add('selecionado');

    // Mostra badge de confirmação
    const sel = document.getElementById(`pp-sel-${tipo}`);
    const icone = tipo === 'paciente' ? 'fa-user' : 'fa-user-md';
    sel.innerHTML = `
        <i class="fa-solid fa-circle-check" style="color:#1a56db;font-size:16px;flex-shrink:0;"></i>
        <div style="flex:1;min-width:0;">
            <div class="pp-sel-nome">${nome}</div>
            ${sub ? `<div class="pp-sel-sub">${sub}</div>` : ''}
        </div>
        <span class="pp-sel-badge" style="color:#111827;font-weight:700;font-size:12px;">Selecionado</span>
    `;
    sel.classList.add('visivel');

    // Limpa o erro se existir
    const erroEl = document.getElementById(`erro-${tipo}`);
    if (erroEl) erroEl.textContent = '';

    // Fecha dropdown e limpa input
    drop.classList.remove('aberto');
    document.getElementById(`pp-input-${tipo}`).value = '';
    document.getElementById(`pp-input-${tipo}`).placeholder =
        tipo === 'paciente' ? 'Pesquisar outro paciente...' : 'Pesquisar outro médico...';
}

// Debounce ao digitar
document.addEventListener('DOMContentLoaded', () => {
    ['paciente', 'medico'].forEach(tipo => {
        const inp = document.getElementById(`pp-input-${tipo}`);
        if (!inp) return;

        inp.addEventListener('input', () => {
            clearTimeout(ppTimersAtend[tipo]);
            ppTimersAtend[tipo] = setTimeout(() => ppPesquisarAtendimento(tipo), 400);
        });

        inp.addEventListener('keydown', e => {
            if (e.key === 'Enter') { e.preventDefault(); ppPesquisarAtendimento(tipo); }
        });
    });

    // Fechar dropdown ao clicar fora
    document.addEventListener('click', e => {
        ['paciente', 'medico'].forEach(tipo => {
            const wrapper = document.getElementById(`pp-wrapper-${tipo}`);
            if (wrapper && !wrapper.contains(e.target)) {
                document.getElementById(`pp-drop-${tipo}`)?.classList.remove('aberto');
            }
        });
    });
});

// Validação no submit — garantir que paciente e médico foram selecionados
document.getElementById('formAgendamento').addEventListener('submit', function(e) {
    let valido = true;

    if (!document.getElementById('id_paciente').value) {
        document.getElementById('erro-paciente').textContent = 'Selecione um paciente';
        valido = false;
    }
    if (!document.getElementById('id_medico').value) {
        document.getElementById('erro-medico').textContent = 'Selecione um médico';
        valido = false;
    }

    if (!valido) e.preventDefault();
}, true); // true = captura antes do listener existente
    </script>
    <script src="/auto-select.js"></script>
    <script>
   const dataInput = document.getElementById("data");

// ================= FUNÇÃO LIMITE DE DATA =================
function obterLimiteMaximo() {
    const hoje = new Date();
    const limite = new Date();

    limite.setMonth(hoje.getMonth() + 2); // +2 meses

    return limite.toISOString().split("T")[0];
}

// ================= DATA =================
dataInput.addEventListener("input", function () {

    const hoje = new Date().toISOString().split("T")[0];
    const limiteMax = obterLimiteMaximo();
    const erro = document.getElementById("erro-data");

    if (this.value < hoje) {
        erro.textContent = "Não pode escolher uma data passada";
        erro.className = "erro";

        this.classList.add("input-erro");
        this.classList.remove("input-sucesso");

    } else if (this.value > limiteMax) {
        erro.textContent = "Só pode agendar até 2 meses à frente";
        erro.className = "erro";

        this.classList.add("input-erro");
        this.classList.remove("input-sucesso");

    } else {
        erro.textContent = "";
        this.classList.remove("input-erro");
        this.classList.add("input-sucesso");
    }
});



// ================= SUBMIT =================


function mostrarAlert(mensagem) {
    const box= document.getElementById("custom-alert");
    const text= document.getElementById("custom-alert-text");

    text.textContent= mensagem;
    box.classList.remove("hidden");
}

function fecharAlert() {
    document.getElementById("custom-alert").classList.add("hidden");
}
document.getElementById("formAgendamento")
.addEventListener("submit", function (e) {

    const hoje = new Date().toISOString().split("T")[0];
    const limiteMax = obterLimiteMaximo();

    const data = dataInput.value;
    const obs = obsInput.value.trim();

    let valido = true;

    if (data < hoje || data > limiteMax) {
        valido = false;
    }

    if (obs.length < 30) {
        valido = false;
    }

    if (!valido) {
        e.preventDefault();
        mostrarAlert("Corrija os erros antes de enviar!");
    }

});
</script>
@endsection