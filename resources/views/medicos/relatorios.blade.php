@extends('layouts.painel')
@section('titulo', 'Relatorios')
@section('conteudo')
    <section class="section active ">
        @if (session('erro'))
            <div style="background-color:red;color:white;text-align:center">
                {{ session('erro') }}
            </div>
        @endif
        <div class="tabs">
            <a class="tab active" href="#">Consultas</a>
            <a class="tab" href="#">Prontuários</a>

        </div>
        <div class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Consultas</h2>
                </div>
                <form>
                  <div class="form-group">
    <label>Paciente</label>
    <div class="pp-wrapper" id="pp-wrapper-consulta">
        <div class="pp-input-row">
            <input type="text"
                   id="pp-input-consulta"
                   placeholder="Pesquisar paciente..."
                   autocomplete="off">
            <button type="button" class="btn btn-primary"
                    onclick="ppPesquisar('consulta')">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <button type="button"
                class="btn-todos-pacientes"
                onclick="ppSelecionarTodos('consulta')">
            <i class="fa-solid fa-users"></i> Todos os pacientes
        </button>
        <div class="pp-selecionado" id="pp-sel-consulta"></div>
        <div class="pp-dropdown" id="pp-drop-consulta"></div>
    </div>
    <input type="hidden" id="id_paciente" name="id_paciente" value="">
</div>
                    <div class="form-group">
                        <label for="estado">
                            Estado
                        </label>
                        <select name="estado" id="estado">
                            <option value="">Todos</option>
                            <option value="pedente">Pedente</option>
                            <option value="agendada">Agendada</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="cancelada">cancelada</option>
                            <option value="concluida">concluida</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_recepcionista">
                            Recepcionista
                        </label>
                        <select name="id_recepcionista" id="id_recepcionista">
                            <option value="">Todos</option>
                            @foreach ($recepcionistas as $recepcionista)
                                <option value="{{ $recepcionista->id_recepcionista }}">{{ $recepcionista->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_tipo_consulta">
                            Tipo de Consulta
                        </label>
                        <select name="id_tipo_consulta" id="id_tipo_consulta">
                            <option value="">Todos</option>
                            @foreach ($tipos_consultas as $tipo_consulta)
                                <option value="{{ $tipo_consulta->id_tipo_consulta }}">{{ $tipo_consulta->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_servico_clinico">
                            Serviço clinicos
                        </label>
                        <select name="id_servico_clinico" id="id_servico_clinico">
                            <option value="">Todos</option>
                            @foreach ($servicos_clinicos as $servico_clinico)
                                <option value="{{ $servico_clinico->id_servico_clinico }}">{{ $servico_clinico->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="data_inicio">
                            Data de início
                        </label>
                        <input name="data_inicio" id="data_inicio"type="date" />
                    </div>
                    <div class="form-group">
                        <label for="data_fim">
                            Data final
                        </label>
                        <input name="data_fim" id="data_fim" type="date" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-full" id="gerar_relatorio_consultas_btn">
                        Gerar relatório
                    </button>
                </form>
            </div>
        </div>
        <div class="tab-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Prontuários</h2>
                </div>
                <form>
                    <div class="form-group">
    <label>Paciente <span style="color:#ef4444">*</span></label>
    <div class="pp-wrapper" id="pp-wrapper-prontuario">
        <div class="pp-input-row">
            <input type="text"
                   id="pp-input-prontuario"
                   placeholder="Pesquisar paciente..."
                   autocomplete="off">
            <button type="button" class="btn btn-primary"
                    onclick="ppPesquisar('prontuario')">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <button type="button"
                class="btn-todos-pacientes"
                onclick="ppSelecionarTodos('prontuario')">
            <i class="fa-solid fa-users"></i> Todos os pacientes
        </button>
        <div class="pp-selecionado" id="pp-sel-prontuario"></div>
        <div class="pp-dropdown" id="pp-drop-prontuario"></div>
    </div>
    <input type="hidden" id="id_paciente_prontuario" name="id_paciente_prontuario" value="">
</div>
                    <div class="form-group">
                        <label for="data_inicio_prontuario">
                            Data de início
                        </label>
                        <input name="data_inicio_prontuario" id="data_inicio_prontuario" type="date" />
                    </div>
                    <div class="form-group">
                        <label for="data_fim_prontuario">
                            Data final
                        </label>
                        <input name="data_fim_prontuario" id="data_fim_prontuario" type="date" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-full" id="gerar_relatorio_prontuario_btn">
                        Gerar relatório
                    </button>
                </form>
            </div>
        </div>
    </section>

@endsection
@section('script')
<script>
    // ── Pesquisa de Paciente ──────────────────────────────────
const PP_API = "{{ route('api_pesquisar_pacientes') }}";
const PP_IDS = {
    consulta:   'id_paciente',
    prontuario: 'id_paciente_prontuario',
    pagamento:  'id_paciente_pagamento',
};
let ppTimers = {};

// Pesquisa ao clicar no botão
async function ppPesquisar(s) {
    const termo = document.getElementById(`pp-input-${s}`).value.trim();
    const drop  = document.getElementById(`pp-drop-${s}`);

    if (termo.length < 2) {
        drop.innerHTML = '<div class="pp-vazio">Digite pelo menos 2 caracteres.</div>';
        drop.classList.add('aberto');
        return;
    }

    drop.innerHTML = '<div class="pp-loading"><i class="fa fa-spinner fa-spin"></i> A pesquisar...</div>';
    drop.classList.add('aberto');

    try {
        const res  = await fetch(`${PP_API}?termo=${encodeURIComponent(termo)}`);
        const data = await res.json();

        if (!data.length) {
            drop.innerHTML = '<div class="pp-vazio">Nenhum paciente encontrado.</div>';
            return;
        }

        drop.innerHTML = data.map(p => `
            <div class="pp-item" onclick="ppSelecionar('${s}', ${p.id_paciente}, '${p.nome.replace(/'/g,"\\'")}', '${(p.num_telefone||'').replace(/'/g,"\\'")}')">
                <strong>${p.nome}</strong>
                <div class="pp-item-sub">${p.num_telefone || ''} ${p.email ? '· ' + p.email : ''}</div>
            </div>
        `).join('');

    } catch(e) {
        drop.innerHTML = '<div class="pp-vazio">Erro ao pesquisar. Tente novamente.</div>';
    }
}

// Pesquisa ao digitar (debounce 400ms)
document.addEventListener('DOMContentLoaded', () => {
    Object.keys(PP_IDS).forEach(s => {
        const inp = document.getElementById(`pp-input-${s}`);
        if (!inp) return;

        inp.addEventListener('input', () => {
            clearTimeout(ppTimers[s]);
            ppTimers[s] = setTimeout(() => ppPesquisar(s), 400);
        });

        inp.addEventListener('keydown', e => {
            if (e.key === 'Enter') { e.preventDefault(); ppPesquisar(s); }
        });
    });

    // Fechar dropdown ao clicar fora
    document.addEventListener('click', e => {
        Object.keys(PP_IDS).forEach(s => {
            const wrapper = document.getElementById(`pp-wrapper-${s}`);
            if (wrapper && !wrapper.contains(e.target)) {
                document.getElementById(`pp-drop-${s}`)?.classList.remove('aberto');
            }
        });
    });
});

function ppSelecionar(s, id, nome, tel) {
    document.getElementById(PP_IDS[s]).value = id;

    // Destaca o item clicado a azul no dropdown
    const drop = document.getElementById(`pp-drop-${s}`);
    drop.querySelectorAll('.pp-item').forEach(item => item.classList.remove('selecionado'));
    event.currentTarget.classList.add('selecionado');

    // Actualiza o campo de confirmação por baixo
    const sel = document.getElementById(`pp-sel-${s}`);
    sel.innerHTML = `
        <i class="fa-solid fa-circle-check" style="color:#1a56db; font-size:16px; flex-shrink:0;"></i>
        <div style="flex:1; min-width:0;">
            <div class="pp-sel-nome">${nome}</div>
            ${tel ? `<div class="pp-sel-sub"><i class="fa-solid fa-phone" style="font-size:10px;"></i> ${tel}</div>` : ''}
        </div>
        <span class="pp-sel-badge" style="color:#111827; font-weight:700; font-size:12px;">Selecionado</span>
    `;
    sel.classList.add('visivel');

    // Fecha dropdown e limpa input
    drop.classList.remove('aberto');
    document.getElementById(`pp-input-${s}`).value = '';
    document.getElementById(`pp-input-${s}`).placeholder = 'Pesquisar outro paciente...';
}
function ppSelecionarTodos(s) {
    // Limpa o id — backend interpreta vazio como "todos"
    document.getElementById(PP_IDS[s]).value = '';

    // Fecha dropdown se estiver aberto
    document.getElementById(`pp-drop-${s}`)?.classList.remove('aberto');
    document.getElementById(`pp-input-${s}`).value = '';
    document.getElementById(`pp-input-${s}`).placeholder = 'Pesquisar paciente...';

    // Mostra badge de confirmação
    const sel = document.getElementById(`pp-sel-${s}`);
    sel.innerHTML = `
        <i class="fa-solid fa-users" style="color:#1a56db; font-size:16px; flex-shrink:0;"></i>
        <div style="flex:1; min-width:0;">
            <div class="pp-sel-nome">Todos os pacientes</div>
            <div class="pp-sel-sub">O relatório incluirá todos os pacientes</div>
        </div>
        <span class="pp-sel-badge" style="color:#111827; font-weight:700; font-size:12px;">Selecionado</span>
    `;
    sel.classList.add('visivel');
}
// ─────────────────────────────────────────────────────────
</script>
    <script src="/tabs.js"></script>
    <script src="/relatorio-consultas.js"></script>
    <script src="/relatorio-prontuario.js"></script>
    <script>
        const url = "{{ route('api_relatorio_consultas') }}"
        const logo_url = "{{ asset('imagem/logo.png') }}"
        const csrfToken = "{{ csrf_token() }}";
        const gerar_relatorio_consultas_btn = document.getElementById('gerar_relatorio_consultas_btn')
        gerar_relatorio_consultas_btn.addEventListener('click', async (e) => {
            const id_paciente = document.getElementById('id_paciente').value || null
            const estado = document.getElementById('estado').value || null
            const id_recepcionista = document.getElementById('id_recepcionista').value || null
            const id_tipo_consulta = document.getElementById('id_tipo_consulta').value || null
            const id_servico_clinico = document.getElementById('id_servico_clinico').value || null
            const data_inicio = document.getElementById('data_inicio').value || null
            const data_fim = document.getElementById('data_fim').value || null
            try {
                e.preventDefault()
                const resultado = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        id_paciente,
                        estado,
                        id_recepcionista,
                        id_tipo_consulta,
                        id_servico_clinico,
                        data_inicio,
                        data_fim
                    }),
                })
                const dados = await resultado.json();
                if (!resultado.ok) {
                    throw new Error(
                        dados?.erro || "Erro ao gerar relatório de consultas",
                    );
                }
                const descricao = `${data_inicio} - ${data_fim} - ${estado}`

                const logotipo = await obterImagemBase64(logo_url)
                gerarRelatorioConsultasTabela(dados, {
                    logotipo,
                    descricao
                })
            } catch (error) {
                console.error("Erro ao gerar relatório de consultas :", error);
                mostrarMensagemErro(
                    "Ocorreu um erro ao gerar relatório de consultas. Por favor, tente novamente.\n" +
                    error?.message || "",
                );
            }
        })
        const gerar_relatorio_prontuario_btn = document.getElementById('gerar_relatorio_prontuario_btn')
        gerar_relatorio_prontuario_btn.addEventListener('click', async (e) => {
            const id_paciente = document.getElementById('id_paciente_prontuario')
            const data_inicio = document.getElementById('data_inicio_prontuario')
            const data_fim = document.getElementById('data_fim_prontuario')
            const rota =
                "{{ route('api_relatorio_prontuario_paciente', ['id_paciente' => ':id', 'data_inicio' => 'data_inicio_param', 'data_fim' => 'data_fim_param']) }}"
            const url = rota.replace(':id', id_paciente.value)
                .replaceAll('data_inicio_param', data_inicio.value ? encodeURIComponent(data_inicio.value) : '')
                .replaceAll('data_fim_param', data_fim.value ? encodeURIComponent(data_fim.value) : '')
                .replaceAll('amp;', '')
            try {
                e.preventDefault()
                const resultado = await fetch(url, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },

                })
                const dados = await resultado.json();
                if (!resultado.ok) {
                    throw new Error(
                        dados?.erro || "Erro ao gerar relatório de prontuario",
                    );
                }
                const descricao = `${dados.nome} `

                const logotipo = await obterImagemBase64(logo_url)
                gerarRelatorioProntuarioPacienteTabela(dados, {
                    logotipo,
                    descricao
                })
            } catch (error) {
                console.error("Erro ao gerar relatório de prontuario :", error);
                mostrarMensagemErro(
                    "Ocorreu um erro ao gerar relatório de prontuario. Por favor, tente novamente.\n" +
                    error?.message || "",
                );
            }
        })
    </script>
@endsection