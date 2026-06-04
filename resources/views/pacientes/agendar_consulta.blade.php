@extends('layouts.painel')
@section('titulo', 'Agendar Consulta')
@section('conteudo')

<section>
    <div class="login-container">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Agendamento de consulta</strong></h2>
            <br><br>

            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif

            <form method="post" action="/agendar-consulta-paciente" id="formAgendamento">
                {{ csrf_field() }}

                <div>
                    <div class="col form-group">
                        <label for="data">Data da consulta</label>
                        <input class="w-100" type="date" id="data" name="data" required>
                        <small class="erro" id="erro-data"></small>
                    </div>

                    <div>
                        <div class="col form-group">
                            <label for="id_tipo_consulta">Tipo de consulta</label>
                            <select class="w-100 tipo_consulta_auto_select" id="id_tipo_consulta" name="id_tipo_consulta">
                                <option value="">Selecione</option>
                                @foreach ($tipos_consultas as $tipo)
                                    <option value="{{ $tipo->id_tipo_consulta }}">{{ $tipo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="id_servico_clinico">Serviço clínico</label>
                            <select class="w-100 servico_clinico_auto_select" id="id_servico_clinico" name="id_servico_clinico">
                            </select>
                        </div>
                    </div>

                    <div class="col form-group">
                        <label for="hora">Horário Preferencial</label>
                        <select class="w-100 horario_auto_select" id="hora" name="hora">
                            <option value="">Selecione um horário</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="observacao">Observação</label>
                        <textarea id="observacao" name="observacao" rows="5"
                            placeholder="Descreva brevemente o motivo da consulta ou dúvidas"></textarea>
                    </div>

                    <div class="d-flex justify-content-center flex-column align-items-center">
                        <button type="submit" class="btn btn-primary w-50">
                            <i class="fas fa-paper-plane"></i>
                            Agendar
                        </button>
                        <p class="form-note">
                            Entraremos em contacto para confirmar o agendamento.
                        </p>
                    </div>
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
        max-width: 360px;
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
            <p id="toast-erro-msg" style="margin: 0; font-size: 13px; color: #6b7280; line-height: 1.5;">
                Preencha todos os campos obrigatórios.
            </p>
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
         OVERLAY DE PRÉVIA DO AGENDAMENTO
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
            max-width: 520px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
        ">
            {{-- Cabeçalho --}}
            <div style="
                background: var(--color-background-secondary, #f9fafb);
                padding: 20px 24px 16px;
                border-bottom: 0.5px solid var(--color-border-tertiary, #e5e7eb);
                display: flex;
                align-items: center;
                gap: 14px;
            ">
                <div style="
                    width: 44px; height: 44px;
                    border-radius: 50%;
                    background: #E6F1FB;
                    display: flex; align-items: center; justify-content: center;
                    flex-shrink: 0;
                ">
                    <i class="ti ti-calendar-check" style="font-size: 22px; color: #185FA5;"></i>
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

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div style="background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                            <p style="margin: 0 0 4px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">Data</p>
                            <p id="prev-data" style="margin: 0; font-size: 15px; font-weight: 600; color: var(--color-text-primary, #111);">—</p>
                        </div>
                        <div style="background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                            <p style="margin: 0 0 4px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">Horário</p>
                            <p id="prev-hora" style="margin: 0; font-size: 15px; font-weight: 600; color: var(--color-text-primary, #111);">—</p>
                        </div>
                    </div>

                    <div style="background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                        <p style="margin: 0 0 4px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">Tipo de consulta</p>
                        <p id="prev-tipo" style="margin: 0; font-size: 15px; font-weight: 600; color: var(--color-text-primary, #111);">—</p>
                    </div>

                    <div style="background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                        <p style="margin: 0 0 4px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">Serviço clínico</p>
                        <p id="prev-servico" style="margin: 0; font-size: 15px; font-weight: 600; color: var(--color-text-primary, #111);">—</p>
                    </div>

                    <div id="prev-obs-wrap" style="display: none; background: var(--color-background-secondary, #f9fafb); border-radius: 10px; padding: 12px 14px; border: 0.5px solid var(--color-border-tertiary, #e5e7eb);">
                        <p style="margin: 0 0 4px; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: var(--color-text-tertiary, #9ca3af);">Observação</p>
                        <p id="prev-obs" style="margin: 0; font-size: 14px; color: var(--color-text-primary, #111); line-height: 1.6;">—</p>
                    </div>

                </div>

                <div style="
                    margin-top: 14px;
                    padding: 10px 14px;
                    background: #EAF3DE;
                    border-radius: 10px;
                    border: 0.5px solid #C0DD97;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                ">
                    <i class="ti ti-info-circle" style="font-size: 17px; color: #3B6D11; flex-shrink: 0;"></i>
                    <p style="margin: 0; font-size: 13px; color: #27500A; line-height: 1.5;">
                        Entraremos em contacto para confirmar o agendamento.
                    </p>
                </div>
            </div>

            {{-- Rodapé --}}
            <div style="
                padding: 16px 24px 20px;
                border-top: 0.5px solid var(--color-border-tertiary, #e5e7eb);
                display: flex;
                gap: 10px;
                justify-content: flex-end;
                flex-wrap: wrap;
            ">
                <button type="button" onclick="fecharPrevia()" style="
                    padding: 10px 22px;
                    border-radius: 10px;
                    border: 0.5px solid var(--color-border-secondary, #d1d5db);
                    background: transparent;
                    font-size: 14px;
                    cursor: pointer;
                    color: var(--color-text-primary, #111);
                    display: flex; align-items: center; gap: 7px;
                " onmouseover="this.style.background='var(--color-background-secondary,#f9fafb)'"
                   onmouseout="this.style.background='transparent'">
                    <i class="ti ti-edit" style="font-size: 16px;"></i>
                    Editar formulário
                </button>

                <button type="button" onclick="confirmarAgendamento()" style="
                    padding: 10px 22px;
                    border-radius: 10px;
                    border: 0.5px solid #185FA5;
                    background: #185FA5;
                    color: #fff;
                    font-size: 14px;
                    font-weight: 600;
                    cursor: pointer;
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

function mostrarToastErro(mensagem) {
    const toast = document.getElementById('toast-erro');
    document.getElementById('toast-erro-msg').textContent = mensagem;

    // Cancela timer anterior se existir
    if (toastTimer) clearTimeout(toastTimer);

    // Reinicia a animação
    toast.style.animation = 'none';
    toast.style.display = 'flex';
    void toast.offsetWidth; // força reflow para reiniciar animação
    toast.style.animation = 'slideIn .25s ease';

    // Fecha automaticamente após 4 segundos
    toastTimer = setTimeout(() => fecharToast(), 4000);
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
    const obs       = document.getElementById('observacao').value.trim();

    document.getElementById('prev-data').textContent =
        formatarData(dataInput.value);
    document.getElementById('prev-hora').textContent =
        horaEl.selectedIndex > 0 ? horaEl.options[horaEl.selectedIndex].text : '—';
    document.getElementById('prev-tipo').textContent =
        tipoEl.selectedIndex > 0 ? tipoEl.options[tipoEl.selectedIndex].text : '—';
    document.getElementById('prev-servico').textContent =
        servicoEl.selectedIndex > 0 ? servicoEl.options[servicoEl.selectedIndex].text : '—';

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

    // Validar data
    if (!data) {
        erros.push("Escolha uma data para a consulta");
        document.getElementById('erro-data').textContent = "Campo obrigatório";
        dataInput.classList.add("input-erro");
    } else if (data < hoje) {
        erros.push("Não pode escolher uma data passada");
        dataInput.dispatchEvent(new Event('input'));
    } else if (data > limiteMax) {
        erros.push("Só pode agendar até 2 meses à frente");
        dataInput.dispatchEvent(new Event('input'));
    }

    if (erros.length > 0) {
        // Monta mensagem amigável
        const msg = erros.length === 1
            ? erros[0]
            : `${erros.length} campos com erro: ${erros.join('; ')}`;
        mostrarToastErro(msg);

        // Faz scroll suave até o primeiro campo com erro
        const primeiroErro = document.querySelector('.input-erro');
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