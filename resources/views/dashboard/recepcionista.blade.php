@extends("layouts.painel")
@section("titulo","Dashboard")
@section('estilo')
<link rel="stylesheet" href="{{ asset('dashboard-recepcionista.css') }}">
@endsection
@section("conteudo")
<div class="content">

    <!-- ══ DASHBOARD ══════════════════════ -->
    <div class="page active" id="page-dashboard">

        <div class="hero-card">
            <div>
                <div class="hero-greeting">Bem-vindo(a) 👋</div>
                <div class="hero-name" id="heroNome">—</div>
                <div class="hero-msg">Gerencie as consultas agendadas e os pagamentos da clínica num só lugar.</div>
            </div>
            <div class="hero-ava" id="heroAva">—</div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon si-purple"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg></div>
                <div>
                    <div class="stat-val" id="statHoje">—</div>
                    <div class="stat-lbl">Consultas Hoje</div>
                    <div class="stat-sub" id="statHojeSub">—</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-blue"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                    </svg></div>
                <div>
                    <div class="stat-val" id="statMes">—</div>
                    <div class="stat-lbl">Consultas no Mês</div>
                    <div class="stat-sub" id="statMesSub">—</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg></div>
                <div>
                    <div class="stat-val" id="statReceitaMes">—</div>
                    <div class="stat-lbl">Receita do Mês (Kz)</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-orange"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg></div>
                <div>
                    <div class="stat-val" id="statSemRecep">—</div>
                    <div class="stat-lbl">Sem Recepcionista</div>
                </div>
            </div>
        </div>

        <div class="grid-2">
            <!-- Consultas de hoje -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="ct-icon si-purple"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        Consultas de Hoje
                    </div>
                    <a class="card-link" onclick="showPage('consultas');return false;">Ver todas</a>
                </div>
                <div class="card-body" id="consultasHojeList">
                    <div class="skel" style="height:50px;border-radius:10px;margin-bottom:6px;"></div>
                    <div class="skel" style="height:50px;border-radius:10px;margin-bottom:6px;opacity:.7"></div>
                    <div class="skel" style="height:50px;border-radius:10px;opacity:.4"></div>
                </div>
            </div>

            <!-- Pagamentos recentes -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="ct-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg></div>
                        Pagamentos Recentes
                    </div>
                    <a class="card-link" onclick="showPage('pagamentos');return false;">Ver todos</a>
                </div>
                <div class="card-body" id="pagamentosRecentesList">
                    <div class="skel" style="height:42px;margin-bottom:8px;border-radius:8px;"></div>
                    <div class="skel" style="height:42px;margin-bottom:8px;border-radius:8px;opacity:.7"></div>
                    <div class="skel" style="height:42px;border-radius:8px;opacity:.4"></div>
                </div>
            </div>
        </div>

    </div><!-- /page-dashboard -->

    <!-- ══ CONSULTAS ══════════════════════ -->
    <div class="page" id="page-consultas">
        <div class="page-header">
            <h2>Consultas</h2>
            <div class="toolbar">
                <div class="search-bar">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
                    </svg>
                    <input type="text" id="consultaSearch" placeholder="Pesquisar paciente/médico..." oninput="filtrarConsultas()">
                </div>
            </div>
        </div>
        <div class="filter-tabs">
            <div class="ftab active" onclick="setFiltroC('todos',this)">Todas</div>
            <div class="ftab" onclick="setFiltroC('agendada',this)">Agendadas</div>
            <div class="ftab" onclick="setFiltroC('concluida',this)">Concluídas</div>
            <div class="ftab" onclick="setFiltroC('cancelada',this)">Canceladas</div>
            <div class="ftab" onclick="setFiltroC('sem_recepcionista',this)">Sem Recepcionista</div>
        </div>
        <div class="table-wrap">
            <table class="ct-table">
                <thead>
                    <tr>
                        <th>Data / Hora</th>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Tipo / Serviço</th>
                        <th>Estado</th>
                        <th>Recepcionista</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="consultasTbody">
                    <tr>
                        <td colspan="7" class="no-data">A carregar...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- /page-consultas -->

    <!-- ══ PAGAMENTOS ═════════════════════ -->
    <div class="page" id="page-pagamentos">
        <div class="page-header">
            <h2>Pagamentos</h2>
            <div class="toolbar">
                <div class="search-bar">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
                    </svg>
                    <input type="text" id="pagSearch" placeholder="Pesquisar paciente..." oninput="filtrarPagamentos()">
                </div>
            </div>
        </div>
        <div class="pag-stats" id="pagStats">
            <div class="skel" style="height:80px;border-radius:14px;"></div>
            <div class="skel" style="height:80px;border-radius:14px;opacity:.7"></div>
            <div class="skel" style="height:80px;border-radius:14px;opacity:.4"></div>
        </div>
        <div class="filter-tabs">
            <div class="ftab active" onclick="setFiltroP('todos',this)">Todos</div>
            <div class="ftab" onclick="setFiltroP('pago',this)">Pagos</div>
            <div class="ftab" onclick="setFiltroP('pendente',this)">Pendentes</div>
        </div>
        <div class="table-wrap">
            <table class="ct-table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Paciente</th>
                        <th>Método</th>
                        <th>Itens</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="pagamentosTbody">
                    <tr>
                        <td colspan="7" class="no-data">A carregar...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- /page-pagamentos -->

</div>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="fecharModal(event)">
    <div class="modal">
        <div class="modal-header">
            <div>
                <div class="modal-title" id="modalTitulo">Detalhes</div>
                <div class="modal-meta" id="modalMeta">—</div>
            </div>
            <button class="modal-close" onclick="fecharModalDireto()">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body" id="modalBody"></div>
    </div>
</div>
@endsection
@section('script')
<script>
    // ════════════════════════════════════════════════════════
    //  ⚙️  CONFIGURAÇÃO
    // ════════════════════════════════════════════════════════
    const API_BASE = 'https://SUA_URL_AQUI/api';
    const RECEPCIONISTA_ID = /* ID injectado pelo PHP */ 1;
    //
    //  Endpoints esperados:
    //  GET {API_BASE}/recepcionista/{id}/dashboard
    //    → { recepcionista:{nome},
    //        stats:{hoje, mes, receita_mes, sem_recepcionista,
    //               hoje_agendadas, mes_agendadas},
    //        consultas_hoje:[{id,paciente,medico,tipo_consulta,servico,hora,estado,id_recepcionista}],
    //        pagamentos_recentes:[{id,paciente,data,metodo_pagamento,total_pago,estado}] }
    //
    //  GET {API_BASE}/recepcionista/{id}/consultas
    //    → lista de consultas (próprias + sem recepcionista)
    //      cada item: {id,paciente,medico,tipo_consulta,servico,data,hora,estado,modalidade,id_recepcionista,recepcionista}
    //
    //  GET {API_BASE}/recepcionista/{id}/pagamentos
    //    → lista de pagamentos com itens
    //      cada item: {id,paciente,data,metodo_pagamento,recepcionista,total_pago,estado,itens:[{servico,quantidade,valor,total}]}
    //
    //  GET {API_BASE}/recepcionista/{id}/pagamentos/stats
    //    → {total_mes, total_pago, total_pendente}
    // ════════════════════════════════════════════════════════

    const MESES_PT = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    let _consultas = [];
    let _pagamentos = [];
    let _filtroC = 'todos';
    let _filtroP = 'todos';

    // ── Helpers ───────────────────────────────────────────
    const fmt = d => {
        if (!d) return '—';
        const [y, m, day] = d.split('-');
        return `${day}/${m}/${y}`;
    };
    const iniciais = n => n?.split(' ').filter(Boolean).slice(0, 2).map(x => x[0].toUpperCase()).join('') || '?';
    const numFmt = v => Number(v || 0).toLocaleString('pt-AO');

    function badgeClass(e = '') {
        const v = e.toLowerCase();
        if (v.includes('conclu') || v === 'realizada') return 'badge-realizada';
        if (v === 'cancelada') return 'badge-cancelada';
        if (v === 'pago') return 'badge-pago';
        if (v === 'pendente') return 'badge-pendente';
        return 'badge-agendada';
    }

    function badgeLabel(e = '') {
        const v = e.toLowerCase();
        if (v === 'concluida') return 'Concluída';
        if (v === 'cancelada') return 'Cancelada';
        if (v === 'agendada') return 'Agendada';
        if (v === 'pago') return 'Pago';
        if (v === 'pendente') return 'Pendente';
        return e;
    }

    // ── Navegação ─────────────────────────────────────────
    const titles = {
        dashboard: 'Visão Geral',
        consultas: 'Consultas',
        pagamentos: 'Pagamentos'
    };

    function showPage(id) {
        document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        document.getElementById('page-' + id).classList.add('active');
        document.querySelector(`[onclick="showPage('${id}');return false;"]`).classList.add('active');
        document.getElementById('topbarTitle').textContent = titles[id];
    }

    // ── Data ──────────────────────────────────────────────
    (function() {
        const n = new Date();
        document.getElementById('topbarDate').textContent =
            `${['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'][n.getDay()]}, ${n.getDate()} de ${MESES_PT[n.getMonth()]} de ${n.getFullYear()}`;
    })();

    // ── Init ──────────────────────────────────────────────
    async function init() {
        try {
            const res = await fetch(`${API_BASE}/recepcionista/${RECEPCIONISTA_ID}/dashboard`, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            const d = await res.json();
            renderRecepcionista(d.recepcionista || {});
            renderStats(d.stats || {});
            renderConsultasHoje(d.consultas_hoje || []);
            renderPagamentosRecentes(d.pagamentos_recentes || []);
        } catch (e) {
            console.error(e);
        }
        carregarConsultas();
        carregarPagamentos();
    }

    function renderRecepcionista(r) {
        const nome = r.nome || 'Recepcionista';
        document.getElementById('sidebarInitials').textContent = iniciais(nome);
        document.getElementById('sidebarNome').textContent = nome;
        document.getElementById('heroNome').textContent = nome;
        document.getElementById('heroAva').textContent = iniciais(nome);
    }

    function renderStats(s) {
        document.getElementById('statHoje').textContent = s.hoje ?? '0';
        document.getElementById('statHojeSub').textContent = `${s.hoje_agendadas??'0'} agendadas`;
        document.getElementById('statMes').textContent = s.mes ?? '0';
        document.getElementById('statMesSub').textContent = `${s.mes_agendadas??'0'} agendadas`;
        document.getElementById('statReceitaMes').textContent = numFmt(s.receita_mes);
        document.getElementById('statSemRecep').textContent = s.sem_recepcionista ?? '0';
    }

    function renderConsultasHoje(lista) {
        const el = document.getElementById('consultasHojeList');
        if (!lista.length) {
            el.innerHTML = '<div class="no-data">Sem consultas para hoje.</div>';
            return;
        }
        el.innerHTML = lista.map(c => `
            <div class="consulta-hoje-item" onclick="abrirModalConsulta(${c.id})">
            <div class="chi-hora"><div class="chi-hora-val">${c.hora||'—'}</div><div class="chi-hora-lbl">horas</div></div>
            <div class="chi-divider"></div>
            <div class="chi-info">
                <div class="chi-paciente">${c.paciente||'—'}${!c.id_recepcionista?'<span class="sem-recep">Sem recep.</span>':''}</div>
                <div class="chi-tipo">${c.medico||'—'} · ${c.tipo_consulta||c.servico||'—'}</div>
            </div>
            <div class="chi-right"><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></div>
            </div>`).join('');
    }

    function renderPagamentosRecentes(lista) {
        const el = document.getElementById('pagamentosRecentesList');
        if (!lista.length) {
            el.innerHTML = '<div class="no-data">Sem pagamentos recentes.</div>';
            return;
        }
        el.innerHTML = lista.map(p => `
            <div class="pag-item" style="cursor:pointer" onclick="abrirModalPagamento(${p.id})">
            <div class="pag-left">
                <div class="pag-paciente">${p.paciente||'—'}</div>
                <div class="pag-meta">${fmt(p.data)} · ${p.metodo_pagamento||'—'}</div>
            </div>
            <div class="pag-right">
                <div class="pag-val">${numFmt(p.total_pago)} Kz</div>
                <span class="badge ${badgeClass(p.estado)}" style="margin-top:3px;display:inline-block">${badgeLabel(p.estado)}</span>
            </div>
            </div>`).join('');
    }

    // ── Consultas tabela ──────────────────────────────────
    async function carregarConsultas() {
        try {
            const res = await fetch(`${API_BASE}/recepcionista/${RECEPCIONISTA_ID}/consultas`, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error();
            _consultas = await res.json();
            filtrarConsultas();
        } catch (e) {
            document.getElementById('consultasTbody').innerHTML = '<tr><td colspan="7" class="no-data" style="color:#c0392b">Erro ao carregar.</td></tr>';
        }
    }

    function filtrarConsultas() {
        const q = (document.getElementById('consultaSearch')?.value || '').toLowerCase();
        const lista = _consultas.filter(c => {
            let mF = true;
            if (_filtroC === 'sem_recepcionista') mF = !c.id_recepcionista;
            else if (_filtroC !== 'todos') mF = (c.estado || '').toLowerCase() === _filtroC;
            const mS = !q || (c.paciente || '').toLowerCase().includes(q) || (c.medico || '').toLowerCase().includes(q) || (c.tipo_consulta || '').toLowerCase().includes(q);
            return mF && mS;
        });
        const tbody = document.getElementById('consultasTbody');
        if (!lista.length) {
            tbody.innerHTML = '<tr><td colspan="7" class="no-data">Nenhuma consulta encontrada.</td></tr>';
            return;
        }
        tbody.innerHTML = lista.map(c => `
            <tr>
            <td><strong>${fmt(c.data)}</strong><div style="font-size:11px;color:var(--text-gray)">${c.hora||''}</div></td>
            <td><strong>${c.paciente||'—'}</strong></td>
            <td>${c.medico||'—'}</td>
            <td>${c.tipo_consulta||'—'}<div style="font-size:11px;color:var(--text-gray)">${c.servico||''}</div></td>
            <td><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></td>
            <td>${c.recepcionista||'<span style="color:var(--accent);font-size:12px;font-weight:600">Não atribuído</span>'}</td>
            <td><button class="btn-sm btn-purple" onclick="abrirModalConsulta(${c.id})">Detalhes</button></td>
            </tr>`).join('');
    }

    function setFiltroC(v, el) {
        _filtroC = v;
        document.querySelectorAll('#page-consultas .ftab').forEach(f => f.classList.remove('active'));
        el.classList.add('active');
        filtrarConsultas();
    }

    // ── Pagamentos tabela ─────────────────────────────────
    async function carregarPagamentos() {
        try {
            const [resP, resS] = await Promise.all([
                fetch(`${API_BASE}/recepcionista/${RECEPCIONISTA_ID}/pagamentos`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                }),
                fetch(`${API_BASE}/recepcionista/${RECEPCIONISTA_ID}/pagamentos/stats`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                }),
            ]);
            if (resP.ok) {
                _pagamentos = await resP.json();
                filtrarPagamentos();
            }
            if (resS.ok) {
                const s = await resS.json();
                renderPagStats(s);
            }
        } catch (e) {
            document.getElementById('pagamentosTbody').innerHTML = '<tr><td colspan="7" class="no-data" style="color:#c0392b">Erro ao carregar.</td></tr>';
        }
    }

    function renderPagStats(s) {
        document.getElementById('pagStats').innerHTML = `
            <div class="stat-card"><div class="stat-icon si-purple"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg></div><div><div class="stat-val">${numFmt(s.total_mes)} Kz</div><div class="stat-lbl">Receita do Mês</div></div></div>
            <div class="stat-card"><div class="stat-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><div><div class="stat-val">${numFmt(s.total_pago)} Kz</div><div class="stat-lbl">Total Pago</div></div></div>
            <div class="stat-card"><div class="stat-icon si-orange"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><div><div class="stat-val">${numFmt(s.total_pendente)} Kz</div><div class="stat-lbl">Total Pendente</div></div></div>`;
    }

    function filtrarPagamentos() {
        const q = (document.getElementById('pagSearch')?.value || '').toLowerCase();
        const lista = _pagamentos.filter(p => {
            const mF = _filtroP === 'todos' || (p.estado || '').toLowerCase() === _filtroP;
            const mS = !q || (p.paciente || '').toLowerCase().includes(q) || (p.metodo_pagamento || '').toLowerCase().includes(q);
            return mF && mS;
        });
        const tbody = document.getElementById('pagamentosTbody');
        if (!lista.length) {
            tbody.innerHTML = '<tr><td colspan="7" class="no-data">Nenhum pagamento encontrado.</td></tr>';
            return;
        }
        tbody.innerHTML = lista.map(p => `
            <tr>
            <td><strong>${fmt(p.data)}</strong></td>
            <td><strong>${p.paciente||'—'}</strong></td>
            <td>${p.metodo_pagamento||'—'}</td>
            <td>${(p.itens||[]).length} item${(p.itens||[]).length!==1?'s':''}</td>
            <td><strong>${numFmt(p.total_pago)} Kz</strong></td>
            <td><span class="badge ${badgeClass(p.estado)}">${badgeLabel(p.estado)}</span></td>
            <td><button class="btn-sm btn-purple" onclick="abrirModalPagamento(${p.id})">Detalhes</button></td>
            </tr>`).join('');
    }

    function setFiltroP(v, el) {
        _filtroP = v;
        document.querySelectorAll('#page-pagamentos .ftab').forEach(f => f.classList.remove('active'));
        el.classList.add('active');
        filtrarPagamentos();
    }

    // ── Modal consulta ────────────────────────────────────
    async function abrirModalConsulta(id) {
        document.getElementById('modalTitulo').textContent = 'Detalhes da Consulta';
        document.getElementById('modalMeta').textContent = '—';
        document.getElementById('modalBody').innerHTML = '<div class="skel" style="height:16px;width:50%;margin-bottom:10px"></div><div class="skel" style="height:80px;border-radius:10px"></div>';
        document.getElementById('modalOverlay').classList.add('open');
        try {
            const res = await fetch(`${API_BASE}/consulta/${id}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error();
            const c = await res.json();
            document.getElementById('modalTitulo').textContent = c.tipo_consulta || c.servico || 'Consulta';
            document.getElementById('modalMeta').textContent = `${fmt(c.data)}${c.hora?' · '+c.hora:''} · ${c.paciente||'—'}`;
            document.getElementById('modalBody').innerHTML = `
                <div class="modal-section">
                    <div class="modal-section-title">Informações</div>
                    <div class="info-grid">
                    <div class="info-item"><label>Paciente</label><span>${c.paciente||'—'}</span></div>
                    <div class="info-item"><label>Médico</label><span>${c.medico||'—'}</span></div>
                    <div class="info-item"><label>Data</label><span>${fmt(c.data)}</span></div>
                    <div class="info-item"><label>Hora</label><span>${c.hora||'—'}</span></div>
                    <div class="info-item"><label>Modalidade</label><span>${c.modalidade||'Presencial'}</span></div>
                    <div class="info-item"><label>Recepcionista</label><span>${c.recepcionista||'<span style="color:var(--accent)">Não atribuído</span>'}</span></div>
                    ${c.observacao?`<div class="info-item full"><label>Observação</label><span>${c.observacao}</span></div>`:''}
                    </div>
                </div>
                <div class="modal-section">
                    <div class="modal-section-title">Estado</div>
                    <span class="badge ${badgeClass(c.estado)}" style="font-size:13px;padding:4px 14px">${badgeLabel(c.estado)}</span>
                </div>`;
        } catch (e) {
            document.getElementById('modalBody').innerHTML = '<div class="no-data" style="color:#c0392b">Erro ao carregar.</div>';
        }
    }

    // ── Modal pagamento ───────────────────────────────────
    async function abrirModalPagamento(id) {
        const pag = _pagamentos.find(p => p.id === id);
        document.getElementById('modalTitulo').textContent = 'Detalhes do Pagamento';
        document.getElementById('modalMeta').textContent = pag ? `${fmt(pag.data)} · ${pag.paciente||'—'}` : '—';
        document.getElementById('modalOverlay').classList.add('open');
        if (!pag) {
            document.getElementById('modalBody').innerHTML = '<div class="no-data">Dados não encontrados.</div>';
            return;
        }
        const itens = pag.itens || [];
        document.getElementById('modalBody').innerHTML = `
            <div class="modal-section">
            <div class="modal-section-title">Informações do Pagamento</div>
            <div class="info-grid">
                <div class="info-item"><label>Paciente</label><span>${pag.paciente||'—'}</span></div>
                <div class="info-item"><label>Data</label><span>${fmt(pag.data)}</span></div>
                <div class="info-item"><label>Método</label><span>${pag.metodo_pagamento||'—'}</span></div>
                <div class="info-item"><label>Recepcionista</label><span>${pag.recepcionista||'—'}</span></div>
                <div class="info-item"><label>Estado</label><span><span class="badge ${badgeClass(pag.estado)}">${badgeLabel(pag.estado)}</span></span></div>
            </div>
            </div>
            <div class="modal-section">
            <div class="modal-section-title">Itens (${itens.length})</div>
            ${itens.length?itens.map(i=>`
                <div class="item-pag-row">
                <div><strong style="font-size:13px">${i.servico||'—'}</strong><div style="font-size:11px;color:var(--text-gray);margin-top:2px">Qtd: ${i.quantidade||1} · ${numFmt(i.valor)} Kz/un.</div></div>
                <strong>${numFmt(i.total)} Kz</strong>
                </div>`).join(''):'<div class="no-data">Sem itens.</div>'}
            <div class="total-pag-row">
                <div class="total-pag-lbl">Total Pago</div>
                <div class="total-pag-val">${numFmt(pag.total_pago)} Kz</div>
            </div>
            </div>`;
    }

    function fecharModal(e) {
        if (e.target === document.getElementById('modalOverlay')) fecharModalDireto();
    }

    function fecharModalDireto() {
        document.getElementById('modalOverlay').classList.remove('open');
    }

    init();
</script>
@endsection