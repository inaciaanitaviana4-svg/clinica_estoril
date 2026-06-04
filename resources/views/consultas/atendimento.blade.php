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

                {{-- Paciente (pesquisa) --}}
                <div class="form-group">
                    <label for="pp-input-paciente">Paciente <span style="color:#ef4444">*</span></label>
                    <div class="pp-wrapper" id="pp-wrapper-paciente">
                        <div class="pp-input-row">
                            <input type="text"
                                   id="pp-input-paciente"
                                   placeholder="Pesquisar paciente pelo nome..."
                                   autocomplete="off">
                            <button type="button" class="btn btn-primary"
                                    onclick="ppPesquisarAtendimento('paciente')">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="pp-selecionado" id="pp-sel-paciente"></div>
                        <div class="pp-dropdown"   id="pp-drop-paciente"></div>
                    </div>
                    <input type="hidden" id="id_paciente" name="id_paciente">
                    <small class="erro" id="erro-paciente"></small>
                </div>

                {{-- Data da consulta --}}
                <div class="form-group">
                    <label for="data">Data da consulta</label>
                    <input class="w-100" type="date" id="data" name="data" required>
                    <small class="erro" id="erro-data"></small>
                </div>

                {{-- Tipo de consulta + Serviço clínico --}}
                <div>
                    <div class="form-group">
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
                    <div class="form-group">
                        <label for="id_servico_clinico">Serviços clínicos</label>
                        <select class="w-100 servico_clinico_auto_select"
                                id="id_servico_clinico" name="id_servico_clinico">
                            <option value="">Selecione um serviço clínico</option>
                        </select>
                    </div>
                </div>

                {{-- Médico --}}
                <div class="form-group">
                    <label for="id_medico">Médico</label>
                    <select class="w-100 medico_auto_select" id="id_medico" name="id_medico">
                        <option value="">Selecione um médico</option>
                    </select>
                    <small class="erro" id="erro-medico"></small>
                </div>

                {{-- Horário --}}
                <div class="form-group">
                    <label for="hora">Horário Preferencial</label>
                    <select class="w-100 horario_auto_select" id="hora" name="hora">
                        <option value="">Selecione um horário</option>
                    </select>
                </div>

                {{-- Observação --}}
                <div class="form-group">
                    <label for="observacao">Observação</label>
                    <textarea id="observacao" name="observacao" rows="5"
                        placeholder="Descreva brevemente o motivo da consulta ou dúvidas"></textarea>
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

    {{-- ============================================================
         TOAST DE ERRO
         ============================================================ --}}
    <div id="toast-erro" style="
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 99999;
        display: none;
        align-items: flex-start;
        gap: 12px;
        background: #fff;
        border-radius: 12px;
        border-left: 4px solid #E24B4A;
        box-shadow: 0 8px 32px rgba(0,0,0,0.14);
        padding: 14px 16px 14px 14px;
        min-width: 280px;
        max-width: 380px;
        animation: slideIn .25s ease;
    ">
        <div style="
            width: 36px; height: 36px;
            border-radius: 50%;
            background: #FCEBEB;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; margin-top: 1px;
        ">
            <i class="fa-solid fa-xmark" style="font-size: 20px; color: #E24B4A;"></i>
        </div>
        <div style="flex: 1; min-width: 0;">
            <p style="margin: 0 0 3px; font-size: 14px; font-weight: 600; color: #111;">
                Corrija os erros
            </p>
            <ul id="toast-erro-lista" style="
                margin: 0;
                padding: 0 0 0 16px;
                font-size: 13px;
                color: #6b7280;
                line-height: 1.7;
            "></ul>
        </div>
        <button onclick="fecharToast()" style="
            background: none; border: none; cursor: pointer;
            color: #9ca3af; padding: 0; margin-top: 1px; flex-shrink: 0;
            font-size: 18px; line-height: 1;
        ">
            <i class="ti ti-x"></i>
        </button>
    </div>

    {{-- ============================================================
         OVERLAY DE PRÉVIA DO AGENDAMENTO (RECEPCIONISTA)
         ============================================================ --}}
    <div id="preview-overlay" style="
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(0,0,0,0.50);
        align-items: center;
        justify-content: center;
        padding: 16px;
    ">
        <div style="
            background: var(--color-background-primary, #fff);
            border-radius: 16px;
            border: 0.5px solid var(--color-border-tertiary, #e5e7eb);
            width: 100%;
            max-width: 560px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
        ">
            {{-- Cabeçalho --}}
            <div style="
                background: var(--color-background-secondary, #f9fafb);
                padding: 20px 24px 16px;
                border-bottom: 0.5px solid var(--color-border-tertiary, #e5e7eb);
                display: flex; align-items: center; gap: 14px;
            ">
                <div style="
                    width: 44px; height: 44px; border-radius: 50%;
                    background: #E6F1FB;
                    display: flex; align-items: center; justify-content: center;
                    flex-shrink: 0;
                ">
                    <i class="ti ti-calendar" style="font-size: 22px; color: #185FA5;"></i>
                </div>
                <div>
                    <p style="margin: 0; font-size: 16px; font-weight: 600; color: var(--color-text-primary, #111);">
                        Confirmar agendamento
                    </p>
                    <p style="margin: 0; font-size: 13px; color: var(--color-text-secondary, #6b7280);">
                        Verifique os dados antes de confirmar
                    </p>
                </div>
            </div>

            {{-- Corpo --}}
            <div style="padding: 20px 24px;">
                <div style="display: grid; gap: 12px;">

                    {{-- Paciente + Médico --}}
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div style="background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                            <p style="margin: 0 0 5px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">
                                <i class="ti ti-user" style="font-size:12px; vertical-align:-1px;"></i> Paciente
                            </p>
                            <p id="prev-paciente" style="margin: 0; font-size: 15px; font-weight: 600; color: var(--color-text-primary, #111);">—</p>
                        </div>
                        <div style="background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                            <p style="margin: 0 0 5px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">
                                <i class="ti ti-stethoscope" style="font-size:12px; vertical-align:-1px;"></i> Médico
                            </p>
                            <p id="prev-medico" style="margin: 0; font-size: 15px; font-weight: 600; color: var(--color-text-primary, #111);">—</p>
                        </div>
                    </div>

                    {{-- Data + Horário --}}
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div style="background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                            <p style="margin: 0 0 5px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">
                                <i class="ti ti-calendar" style="font-size:12px; vertical-align:-1px;"></i> Data
                            </p>
                            <p id="prev-data" style="margin: 0; font-size: 15px; font-weight: 600; color: var(--color-text-primary, #111);">—</p>
                        </div>
                        <div style="background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                            <p style="margin: 0 0 5px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">
                                <i class="ti ti-clock" style="font-size:12px; vertical-align:-1px;"></i> Horário
                            </p>
                            <p id="prev-hora" style="margin: 0; font-size: 15px; font-weight: 600; color: var(--color-text-primary, #111);">—</p>
                        </div>
                    </div>

                    {{-- Tipo + Serviço --}}
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div style="background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                            <p style="margin: 0 0 5px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">
                                <i class="ti ti-notes" style="font-size:12px; vertical-align:-1px;"></i> Tipo de consulta
                            </p>
                            <p id="prev-tipo" style="margin: 0; font-size: 14px; font-weight: 600; color: var(--color-text-primary, #111);">—</p>
                        </div>
                        <div style="background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                            <p style="margin: 0 0 5px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">
                                <i class="ti ti-building-hospital" style="font-size:12px; vertical-align:-1px;"></i> Serviço clínico
                            </p>
                            <p id="prev-servico" style="margin: 0; font-size: 14px; font-weight: 600; color: var(--color-text-primary, #111);">—</p>
                        </div>
                    </div>

                    {{-- Observação --}}
                    <div id="prev-obs-wrap" style="display: none; background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                        <p style="margin: 0 0 5px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">
                            <i class="ti ti-message" style="font-size:12px; vertical-align:-1px;"></i> Observação
                        </p>
                        <p id="prev-obs" style="margin: 0; font-size: 14px; color: var(--color-text-primary, #111); line-height: 1.6;">—</p>
                    </div>

                </div>

                <div style="
                    margin-top: 14px; padding: 10px 14px;
                    background: #EAF3DE; border-radius: 10px;
                    border: 0.5px solid #C0DD97;
                    display: flex; align-items: center; gap: 10px;
                ">
                    <i class="ti ti-info-circle" style="font-size: 17px; color: #3B6D11; flex-shrink: 0;"></i>
                    <p style="margin: 0; font-size: 13px; color: #27500A; line-height: 1.5;">
                        Confirme os dados. A consulta será registada imediatamente após confirmação.
                    </p>
                </div>
            </div>

            {{-- Rodapé --}}
            <div style="
                padding: 16px 24px 20px;
                border-top: 0.5px solid var(--color-border-tertiary, #e5e7eb);
                display: flex; gap: 10px; justify-content: flex-end; flex-wrap: wrap;
            ">
                <button type="button" onclick="fecharPrevia()" style="
                    padding: 10px 22px; border-radius: 10px;
                    border: 0.5px solid var(--color-border-secondary, #d1d5db);
                    background: transparent; font-size: 14px; cursor: pointer;
                    color: var(--color-text-primary, #111);
                    display: flex; align-items: center; gap: 7px;
                " onmouseover="this.style.background='var(--color-background-secondary,#f9fafb)'"
                   onmouseout="this.style.background='transparent'">
                    <i class="ti ti-edit" style="font-size: 16px;"></i>
                    Editar formulário
                </button>

                <button type="button" onclick="confirmarAgendamento()" style="
                    padding: 10px 22px; border-radius: 10px;
                    border: 0.5px solid #185FA5; background: #185FA5;
                    color: #fff; font-size: 14px; font-weight: 600; cursor: pointer;
                    display: flex; align-items: center; gap: 7px;
                " onmouseover="this.style.background='#0C447C'"
                   onmouseout="this.style.background='#185FA5'">
                    <i class="ti ti-check" style="font-size: 16px;"></i>
                    Confirmar agendamento
                </button>
            </div>
        </div>
    </div>
    {{-- FIM DO OVERLAY --}}

</section>

<style>
@keyframes slideIn {
    from { opacity: 0; transform: translateX(40px); }
    to   { opacity: 1; transform: translateX(0);    }
}
@keyframes slideOut {
    from { opacity: 1; transform: translateX(0);    }
    to   { opacity: 0; transform: translateX(40px); }
}
</style>

@endsection

@section('script')
<script src="/auto-select.js"></script>

{{-- ── Script de pesquisa de Paciente (sistema existente) ────────────────── --}}
<script>
const PP_API_PACIENTE = "{{ route('api_pesquisar_pacientes') }}";
const PP_API_MEDICO   = "/api/pesquisar-medicos";
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
    document.getElementById(`id_${tipo}`).value = id;

    const drop = document.getElementById(`pp-drop-${tipo}`);
    drop.querySelectorAll('.pp-item').forEach(i => i.classList.remove('selecionado'));
    event.currentTarget.classList.add('selecionado');

    const sel = document.getElementById(`pp-sel-${tipo}`);
    sel.innerHTML = `
        <i class="fa-solid fa-circle-check" style="color:#1a56db;font-size:16px;flex-shrink:0;"></i>
        <div style="flex:1;min-width:0;">
            <div class="pp-sel-nome">${nome}</div>
            ${sub ? `<div class="pp-sel-sub">${sub}</div>` : ''}
        </div>
        <span class="pp-sel-badge" style="color:#111827;font-weight:700;font-size:12px;">Selecionado</span>
    `;
    sel.classList.add('visivel');

    const erroEl = document.getElementById(`erro-${tipo}`);
    if (erroEl) erroEl.textContent = '';

    drop.classList.remove('aberto');
    document.getElementById(`pp-input-${tipo}`).value = '';
    document.getElementById(`pp-input-${tipo}`).placeholder =
        tipo === 'paciente' ? 'Pesquisar outro paciente...' : 'Pesquisar outro médico...';
}

document.addEventListener('DOMContentLoaded', () => {
    ['paciente'].forEach(tipo => {
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

    document.addEventListener('click', e => {
        ['paciente'].forEach(tipo => {
            const wrapper = document.getElementById(`pp-wrapper-${tipo}`);
            if (wrapper && !wrapper.contains(e.target)) {
                document.getElementById(`pp-drop-${tipo}`)?.classList.remove('aberto');
            }
        });
    });
});
</script>

{{-- ── Validação de data + Toast + Prévia ─────────────────────────────────── --}}
<script>
const dataInput = document.getElementById("data");

// ================= LIMITE DE DATA =================
function obterLimiteMaximo() {
    const hoje = new Date();
    const limite = new Date();
    limite.setMonth(hoje.getMonth() + 2);
    return limite.toISOString().split("T")[0];
}

// ================= VALIDAÇÃO DA DATA =================
dataInput.addEventListener("input", function () {
    const hoje      = new Date().toISOString().split("T")[0];
    const limiteMax = obterLimiteMaximo();
    const erro      = document.getElementById("erro-data");

    if (this.value < hoje) {
        erro.textContent = "Não pode escolher uma data passada";
        this.classList.add("input-erro");
        this.classList.remove("input-sucesso");
    } else if (this.value > limiteMax) {
        erro.textContent = "Só pode agendar até 2 meses à frente";
        this.classList.add("input-erro");
        this.classList.remove("input-sucesso");
    } else {
        erro.textContent = "";
        this.classList.remove("input-erro");
        this.classList.add("input-sucesso");
    }
});

// ================= TOAST DE ERRO =================
let toastTimer = null;

function mostrarToastErro(erros) {
    const toast = document.getElementById('toast-erro');
    const lista = document.getElementById('toast-erro-lista');

    // Monta os itens da lista
    lista.innerHTML = erros.map(e => `<li>${e}</li>`).join('');

    // Cancela timer anterior
    if (toastTimer) clearTimeout(toastTimer);

    // Reinicia animação
    toast.style.animation = 'none';
    toast.style.display = 'flex';
    void toast.offsetWidth;
    toast.style.animation = 'slideIn .25s ease';

    // Fecha automaticamente após 5 segundos
    toastTimer = setTimeout(() => fecharToast(), 5000);
}

function fecharToast() {
    const toast = document.getElementById('toast-erro');
    toast.style.animation = 'slideOut .2s ease forwards';
    setTimeout(() => {
        toast.style.display = 'none';
        toast.style.animation = '';
    }, 200);
}

// ================= FUNÇÕES DA PRÉVIA =================
function formatarData(valor) {
    if (!valor) return '—';
    const [y, m, d] = valor.split('-');
    return `${d}/${m}/${y}`;
}

function mostrarPrevia() {
    const horaEl    = document.getElementById('hora');
    const tipoEl    = document.getElementById('id_tipo_consulta');
    const servicoEl = document.getElementById('id_servico_clinico');
    const medicoEl  = document.getElementById('id_medico');
    const obs       = document.getElementById('observacao').value.trim();

    // Nome do paciente — vem do badge do sistema de pesquisa
    const selPaciente  = document.getElementById('pp-sel-paciente');
    const nomePaciente = selPaciente?.querySelector('.pp-sel-nome')?.textContent?.trim() || '—';

    // Nome do médico — vem do select
    const nomeMedico = medicoEl.selectedIndex > 0
        ? medicoEl.options[medicoEl.selectedIndex].text : '—';

    document.getElementById('prev-paciente').textContent = nomePaciente;
    document.getElementById('prev-medico').textContent   = nomeMedico;
    document.getElementById('prev-data').textContent     = formatarData(dataInput.value);
    document.getElementById('prev-hora').textContent     = horaEl.selectedIndex > 0 ? horaEl.options[horaEl.selectedIndex].text : '—';
    document.getElementById('prev-tipo').textContent     = tipoEl.selectedIndex > 0 ? tipoEl.options[tipoEl.selectedIndex].text : '—';
    document.getElementById('prev-servico').textContent  = servicoEl.selectedIndex > 0 ? servicoEl.options[servicoEl.selectedIndex].text : '—';

    const obsWrap = document.getElementById('prev-obs-wrap');
    if (obs) {
        document.getElementById('prev-obs').textContent = obs;
        obsWrap.style.display = 'block';
    } else {
        obsWrap.style.display = 'none';
    }

    document.getElementById('preview-overlay').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function fecharPrevia() {
    document.getElementById('preview-overlay').style.display = 'none';
    document.body.style.overflow = '';
}

function confirmarAgendamento() {
    fecharPrevia();
    document.getElementById('formAgendamento')
        .removeEventListener('submit', interceptarSubmit, true);
    document.getElementById('formAgendamento').submit();
}

// ================= INTERCEPTAR SUBMIT =================
function interceptarSubmit(e) {
    e.preventDefault();

    const hoje      = new Date().toISOString().split("T")[0];
    const limiteMax = obterLimiteMaximo();
    const data      = dataInput.value;
    const erros     = [];

    // Validar paciente
    if (!document.getElementById('id_paciente').value) {
        document.getElementById('erro-paciente').textContent = 'Selecione um paciente';
        erros.push('Selecione um paciente');
    } else {
        document.getElementById('erro-paciente').textContent = '';
    }

    // Validar data
    if (!data) {
        document.getElementById('erro-data').textContent = 'Escolha uma data para a consulta';
        dataInput.classList.add('input-erro');
        erros.push('Escolha uma data para a consulta');
    } else if (data < hoje) {
        dataInput.dispatchEvent(new Event('input'));
        erros.push('Não pode escolher uma data passada');
    } else if (data > limiteMax) {
        dataInput.dispatchEvent(new Event('input'));
        erros.push('Só pode agendar até 2 meses à frente');
    }

    // Validar médico
    if (!document.getElementById('id_medico').value) {
        document.getElementById('erro-medico').textContent = 'Selecione um médico';
        erros.push('Selecione um médico');
    } else {
        document.getElementById('erro-medico').textContent = '';
    }

    if (erros.length > 0) {
        mostrarToastErro(erros);

        // Scroll suave até o primeiro campo com erro
        const primeiroErro = document.querySelector('.input-erro, .erro:not(:empty)');
        if (primeiroErro) {
            primeiroErro.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        return;
    }

    mostrarPrevia();
}

document.getElementById('formAgendamento')
    .addEventListener('submit', interceptarSubmit, true);

// Fechar overlay ao clicar no backdrop
document.getElementById('preview-overlay').addEventListener('click', function (e) {
    if (e.target === this) fecharPrevia();
});
</script>

@endsection