@extends("layouts.painel")
@section("titulo","Dashboard")
@section('estilo')
<link rel="stylesheet" href="{{ asset('dashboard-medico.css') }}">
@endsection
@section("conteudo")
<div class="content">

    <!-- ══ DASHBOARD ══════════════════════ -->
    <div class="page active" id="page-dashboard">

        <div class="hero-card">
            <div>
                <div class="hero-greeting">Bom dia 👨‍⚕️</div>
                <div class="hero-name" id="heroNome">—</div>
                <div class="hero-espec" id="heroEspec">—</div>
                <div class="hero-chips">
                    <span class="hero-chip" id="heroExp">— anos de experiência</span>
                    <span class="hero-chip" id="heroConsultasHoje">— consultas hoje</span>
                </div>
            </div>
            <div class="hero-ava" id="heroAva">—</div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon si-teal"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg></div>
                <div>
                    <div class="stat-val" id="statHoje">—</div>
                    <div class="stat-lbl">Consultas Hoje</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-blue"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                    </svg></div>
                <div>
                    <div class="stat-val" id="statMes">—</div>
                    <div class="stat-lbl">Consultas no Mês</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                    </svg></div>
                <div>
                    <div class="stat-val" id="statPacientes">—</div>
                    <div class="stat-lbl">Pacientes Atendidos</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-orange"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg></div>
                <div>
                    <div class="stat-val" id="statConcluidas">—</div>
                    <div class="stat-lbl">Concluídas (Mês)</div>
                </div>
            </div>
        </div>

        <div class="grid-3-1">
            <!-- Consultas do dia -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="ct-icon si-teal"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        Agenda de Hoje
                    </div>
                    <a class="card-link" onclick="showPage('consultas');return false;">Ver todas</a>
                </div>
                <div class="card-body" id="agendaHoje">
                    <div class="skel" style="height:52px;border-radius:10px;margin-bottom:6px;"></div>
                    <div class="skel" style="height:52px;border-radius:10px;margin-bottom:6px;opacity:.7"></div>
                    <div class="skel" style="height:52px;border-radius:10px;opacity:.4"></div>
                </div>
            </div>

            <!-- Horário resumo -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="ct-icon si-blue"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg></div>
                        Esta Semana
                    </div>
                    <a class="card-link" onclick="showPage('horarios');return false;">Detalhe</a>
                </div>
                <div class="card-body" id="horarioResumo">
                    <div class="horario-grid" id="horarioMini"></div>
                </div>
            </div>
        </div>

        <!-- Prontuários recentes -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="ct-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                        </svg></div>
                    Pacientes Recentes
                </div>
                <a class="card-link" onclick="showPage('prontuarios');return false;">Ver prontuários</a>
            </div>
            <div class="card-body" id="pacientesRecentes">
                <div class="skel" style="height:36px;margin-bottom:8px;border-radius:8px;"></div>
                <div class="skel" style="height:36px;margin-bottom:8px;border-radius:8px;opacity:.7"></div>
                <div class="skel" style="height:36px;border-radius:8px;opacity:.4"></div>
            </div>
        </div>
    </div>

    <!-- ══ CONSULTAS ══════════════════════ -->
    <div class="page" id="page-consultas">
        <div class="page-header">
            <h2>Minhas Consultas</h2>
            <div class="search-bar">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
                </svg>
                <input type="text" id="consultaSearch" placeholder="Pesquisar paciente..." oninput="filtrarConsultas()">
            </div>
        </div>
        <div class="filter-tabs">
            <div class="ftab active" onclick="setFiltroConsulta('todos',this)">Todas</div>
            <div class="ftab" onclick="setFiltroConsulta('agendada',this)">Agendadas</div>
            <div class="ftab" onclick="setFiltroConsulta('concluida',this)">Concluídas</div>
            <div class="ftab" onclick="setFiltroConsulta('cancelada',this)">Canceladas</div>
        </div>
        <div class="table-wrap">
            <table class="ct-table">
                <thead>
                    <tr>
                        <th>Data / Hora</th>
                        <th>Paciente</th>
                        <th>Tipo / Serviço</th>
                        <th>Modalidade</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="consultasTbody">
                    <tr>
                        <td colspan="6" class="no-data">A carregar...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ══ PRONTUÁRIOS ════════════════════ -->
    <div class="page" id="page-prontuarios">
        <div class="page-header">
            <h2>Prontuários dos Pacientes</h2>
            <div class="search-bar">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
                </svg>
                <input type="text" id="prontuarioSearch" placeholder="Pesquisar paciente..." oninput="filtrarProntuarios()">
            </div>
        </div>
        <div class="table-wrap">
            <table class="ct-table">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Idade</th>
                        <th>Género</th>
                        <th>Última Consulta</th>
                        <th>Total Consultas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="prontuariosTbody">
                    <tr>
                        <td colspan="6" class="no-data">A carregar...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ══ HORÁRIOS ═══════════════════════ -->
    <div class="page" id="page-horarios">
        <div class="page-header">
            <h2>Meus Horários</h2>
        </div>
        <div class="horarios-full-grid" id="horariosGrid">
            <div class="skel" style="height:200px;border-radius:14px;"></div>
            <div class="skel" style="height:200px;border-radius:14px;opacity:.8"></div>
            <div class="skel" style="height:200px;border-radius:14px;opacity:.6"></div>
            <div class="skel" style="height:200px;border-radius:14px;opacity:.4"></div>
        </div>
    </div>

</div>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="fecharModal(event)">
    <div class="modal">
        <div class="modal-header">
            <div>
                <div class="modal-title" id="modalTitulo">Detalhes</div>
                <div class="modal-meta" id="modalMeta">—</div>
            </div>
            <button class="modal-close" onclick="fecharModalDireto()"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg></button>
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
    const MEDICO_ID = /* ID injectado pelo PHP */ 1;
    //
    //  Endpoints esperados:
    //  GET {API_BASE}/medico/{id}/dashboard
    //    → { medico:{nome,especialidade,ano_experiencia},
    //        stats:{hoje,mes,pacientes_atendidos,concluidas_mes},
    //        agenda_hoje:[{id,paciente,tipo_consulta,servico,hora,estado,modalidade}],
    //        horarios:[{dia_semana,hora,activo}],
    //        pacientes_recentes:[{id,paciente:{id,nome,data_nascimento,genero},ultima_data,total_consultas}] }
    //
    //  GET {API_BASE}/medico/{id}/consultas   → lista completa de consultas
    //  GET {API_BASE}/medico/{id}/prontuarios → lista de pacientes únicos com resumo
    //  GET {API_BASE}/consulta/{id}           → detalhes (diags, exames, receitas)
    //  GET {API_BASE}/paciente/{id}/prontuario → histórico completo do paciente
    // ════════════════════════════════════════════════════════

    const DIAS = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
    const DIAS_FULL = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
    const MESES = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

    let _consultas = [];
    let _prontuarios = [];
    let _filtroC = 'todos';
    let _modalType = null;

    // ── Helpers ───────────────────────────────────────────
    const fmt = d => {
        if (!d) return '—';
        const [y, m, day] = d.split('-');
        return `${day}/${m}/${y}`;
    };
    const iniciais = n => n?.split(' ').filter(Boolean).slice(0, 2).map(x => x[0].toUpperCase()).join('') || '?';

    function badgeClass(e = '') {
        const v = e.toLowerCase();
        if (v.includes('conclu') || v === 'realizada') return 'badge-realizada';
        if (v === 'cancelada') return 'badge-cancelada';
        return 'badge-agendada';
    }

    function badgeLabel(e = '') {
        const v = e.toLowerCase();
        if (v === 'concluida') return 'Concluída';
        if (v === 'cancelada') return 'Cancelada';
        if (v === 'agendada') return 'Agendada';
        return e;
    }

    // ── Navegação ─────────────────────────────────────────
    const titles = {
        dashboard: 'Visão Geral',
        consultas: 'Minhas Consultas',
        prontuarios: 'Prontuários',
        horarios: 'Meus Horários'
    };

    function showPage(id) {
        document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        document.getElementById('page-' + id).classList.add('active');
        document.querySelector(`[onclick="showPage('${id}');return false;"]`).classList.add('active');
        document.getElementById('topbarTitle').textContent = titles[id];
    }

    // ── Data actual ───────────────────────────────────────
    (function() {
        const now = new Date();
        document.getElementById('topbarDate').textContent =
            `${DIAS_FULL[now.getDay()]}, ${now.getDate()} de ${['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'][now.getMonth()]} de ${now.getFullYear()}`;
    })();

    // ── Init ──────────────────────────────────────────────
    async function init() {
        try {
            const res = await fetch(`${API_BASE}/medico/${MEDICO_ID}/dashboard`, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            const d = await res.json();
            renderMedico(d.medico || {});
            renderStats(d.stats || {});
            renderAgendaHoje(d.agenda_hoje || []);
            renderHorarioMini(d.horarios || []);
            renderPacientesRecentes(d.pacientes_recentes || []);
        } catch (e) {
            console.error(e);
        }

        // Carregar tabelas em paralelo
        carregarConsultas();
        carregarProntuarios();
    }

    function renderMedico(m) {
        const nome = m.nome || 'Médico';
        document.getElementById('sidebarInitials').textContent = iniciais(nome);
        document.getElementById('sidebarNome').textContent = nome;
        document.getElementById('sidebarEspec').textContent = m.especialidade || 'Médico';
        document.getElementById('heroNome').textContent = 'Dr(a). ' + nome;
        document.getElementById('heroEspec').textContent = m.especialidade || '—';
        document.getElementById('heroExp').textContent = (m.ano_experiencia || '—') + ' anos de experiência';
        document.getElementById('heroAva').textContent = iniciais(nome);
    }

    function renderStats(s) {
        document.getElementById('statHoje').textContent = s.hoje ?? '0';
        document.getElementById('statMes').textContent = s.mes ?? '0';
        document.getElementById('statPacientes').textContent = s.pacientes_atendidos ?? '0';
        document.getElementById('statConcluidas').textContent = s.concluidas_mes ?? '0';
        document.getElementById('heroConsultasHoje').textContent = (s.hoje ?? '0') + ' consultas hoje';
    }

    function renderAgendaHoje(lista) {
        const el = document.getElementById('agendaHoje');
        if (!lista.length) {
            el.innerHTML = '<div class="empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><p>Sem consultas para hoje.</p></div>';
            return;
        }
        const agora = new Date();
        el.innerHTML = lista.map((c, i) => {
            const [h, min] = (c.hora || '00:00').split(':');
            const horaC = new Date();
            horaC.setHours(+h, +min, 0);
            const proxima = horaC > agora && (i === 0 || (() => {
                const [ph, pm] = (lista[i - 1]?.hora || '00:00').split(':');
                const prev = new Date();
                prev.setHours(+ph, +pm, 0);
                return prev <= agora;
            })());
            return `<div class="consulta-dia-item ${proxima?'proxima':''}" onclick="abrirModalConsulta(${c.id})">
                <div class="cdi-hora"><div class="cdi-hora-val">${c.hora||'—'}</div><div class="cdi-hora-lbl">horas</div></div>
                <div class="cdi-divider ${proxima?'teal':''}"></div>
                <div class="cdi-info">
                    <div class="cdi-nome">${c.paciente||'—'}</div>
                    <div class="cdi-tipo">${c.tipo_consulta||c.servico||'—'} · ${c.modalidade||'Presencial'}</div>
                </div>
                <div class="cdi-right"><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></div>
                </div>`;
        }).join('');
    }

    function renderHorarioMini(horarios) {
        const el = document.getElementById('horarioMini');
        const hoje = new Date().getDay();
        const porDia = {};
        horarios.forEach(h => {
            const d = parseInt(h.dia_semana);
            if (!porDia[d]) porDia[d] = [];
            porDia[d].push(h);
        });
        el.innerHTML = DIAS.map((d, i) => `
            <div class="dia-col ${i===hoje?'hoje':''}">
            <div class="dia-label">${i===hoje?`<span>${d}</span>`:d}</div>
            ${(porDia[i]||[]).map(h=>`<div class="dia-slot ${h.activo?'slot-active':'slot-inactive'}">${h.hora?.slice(0,5)||'—'}</div>`).join('')||'<div style="font-size:10px;color:var(--text-light);text-align:center">—</div>'}
            </div>`).join('');
    }

    function renderPacientesRecentes(lista) {
        const el = document.getElementById('pacientesRecentes');
        if (!lista.length) {
            el.innerHTML = '<div class="no-data">Sem pacientes recentes.</div>';
            return;
        }
        el.innerHTML = lista.map(p => `
            <div class="paciente-row" onclick="abrirModalProntuario(${p.paciente?.id||p.id})">
            <div class="pac-ava">${iniciais(p.paciente?.nome||p.nome||'?')}</div>
            <div>
                <div class="pac-nome">${p.paciente?.nome||p.nome||'—'}</div>
                <div class="pac-sub">${p.total_consultas||0} consulta${p.total_consultas!==1?'s':''}</div>
            </div>
            <div class="pac-data">${fmt(p.ultima_data)}</div>
            </div>`).join('');
    }

    // ── Consultas tabela ──────────────────────────────────
    async function carregarConsultas() {
        try {
            const res = await fetch(`${API_BASE}/medico/${MEDICO_ID}/consultas`, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error();
            _consultas = await res.json();
            filtrarConsultas();
        } catch (e) {
            document.getElementById('consultasTbody').innerHTML = '<tr><td colspan="6" class="no-data" style="color:#c0392b">Erro ao carregar.</td></tr>';
        }
    }

    function filtrarConsultas() {
        const q = (document.getElementById('consultaSearch')?.value || '').toLowerCase();
        const lista = _consultas.filter(c => {
            const mF = _filtroC === 'todos' || (c.estado || '').toLowerCase() === _filtroC;
            const mS = !q || (c.paciente || '').toLowerCase().includes(q) || (c.tipo_consulta || '').toLowerCase().includes(q);
            return mF && mS;
        });
        const tbody = document.getElementById('consultasTbody');
        if (!lista.length) {
            tbody.innerHTML = '<tr><td colspan="6" class="no-data">Nenhuma consulta encontrada.</td></tr>';
            return;
        }
        tbody.innerHTML = lista.map(c => `
            <tr>
            <td><strong>${fmt(c.data)}</strong><div style="font-size:11px;color:var(--text-gray)">${c.hora||''}</div></td>
            <td><strong>${c.paciente||'—'}</strong></td>
            <td>${c.tipo_consulta||'—'}<div style="font-size:11px;color:var(--text-gray)">${c.servico||''}</div></td>
            <td>${c.modalidade||'Presencial'}</td>
            <td><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></td>
            <td><button class="btn-sm btn-teal" onclick="abrirModalConsulta(${c.id})">Detalhes</button></td>
            </tr>`).join('');
    }

    function setFiltroConsulta(v, el) {
        _filtroC = v;
        document.querySelectorAll('.ftab').forEach(f => f.classList.remove('active'));
        el.classList.add('active');
        filtrarConsultas();
    }

    // ── Prontuários tabela ────────────────────────────────
    async function carregarProntuarios() {
        try {
            const res = await fetch(`${API_BASE}/medico/${MEDICO_ID}/prontuarios`, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error();
            _prontuarios = await res.json();
            renderProntuariosTabela(_prontuarios);
        } catch (e) {
            document.getElementById('prontuariosTbody').innerHTML = '<tr><td colspan="6" class="no-data" style="color:#c0392b">Erro ao carregar.</td></tr>';
        }
    }

    function renderProntuariosTabela(lista) {
        const tbody = document.getElementById('prontuariosTbody');
        if (!lista.length) {
            tbody.innerHTML = '<tr><td colspan="6" class="no-data">Nenhum prontuário encontrado.</td></tr>';
            return;
        }
        tbody.innerHTML = lista.map(p => `
            <tr>
            <td><div style="display:flex;align-items:center;gap:10px"><div class="pac-ava" style="width:32px;height:32px;font-size:11px">${iniciais(p.nome)}</div><strong>${p.nome||'—'}</strong></div></td>
            <td>${p.idade||'—'}</td>
            <td>${p.genero||'—'}</td>
            <td>${fmt(p.ultima_consulta)}</td>
            <td>${p.total_consultas||0}</td>
            <td>
                <button class="btn-sm btn-teal" onclick="abrirModalProntuario(${p.id})" style="margin-right:4px">Prontuário</button>
            </td>
            </tr>`).join('');
    }

    function filtrarProntuarios() {
        const q = (document.getElementById('prontuarioSearch')?.value || '').toLowerCase();
        renderProntuariosTabela(q ? _prontuarios.filter(p => (p.nome || '').toLowerCase().includes(q)) : _prontuarios);
    }

    // ── Horários página ───────────────────────────────────
    async function carregarHorarios() {
        try {
            const res = await fetch(`${API_BASE}/medico/${MEDICO_ID}/dashboard`, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error();
            const d = await res.json();
            renderHorariosGrid(d.horarios || []);
        } catch (e) {}
    }

    function renderHorariosGrid(horarios) {
        const hoje = new Date().getDay();
        const porDia = {};
        horarios.forEach(h => {
            const d = parseInt(h.dia_semana);
            if (!porDia[d]) porDia[d] = [];
            porDia[d].push(h);
        });
        document.getElementById('horariosGrid').innerHTML = DIAS_FULL.map((d, i) => `
            <div class="hfg-col ${i===hoje?'hoje-col':''}">
            <div class="hfg-dia-header">${d}</div>
            <div class="hfg-slots">
                ${(porDia[i]||[]).length
                ? (porDia[i]||[]).map(h=>`<div class="hfg-slot ${h.activo?'activo':'inactivo'}">${h.hora?.slice(0,5)||'—'}</div>`).join('')
                : `<div class="hfg-empty">Sem horário</div>`}
            </div>
            </div>`).join('');
    }

    // ── Modais ────────────────────────────────────────────
    async function abrirModalConsulta(id) {
        _modalType = 'consulta';
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
            renderModalConsulta(c);
        } catch (e) {
            document.getElementById('modalBody').innerHTML = '<div class="no-data" style="color:#c0392b">Erro ao carregar.</div>';
        }
    }

    function renderModalConsulta(c) {
        const diags = (c.diagnosticos || []);
        const exames = (c.exames || []);
        const receitas = (c.receitas || []);
        document.getElementById('modalBody').innerHTML = `
            ${c.observacao?`<div class="modal-section"><div class="modal-section-title">Observação</div><div class="obs-box">${c.observacao}</div></div>`:''}
            <div class="modal-section"><div class="modal-section-title">Diagnósticos</div>
            ${diags.length?diags.map(d=>`<div class="diag-item"><div class="diag-bullet"></div><div>${d.descricao}</div></div>`).join(''):'<div class="no-data">Nenhum diagnóstico.</div>'}
            </div>
            <div class="modal-section"><div class="modal-section-title">Exames Solicitados</div>
            ${exames.length?exames.map(e=>`<div class="exame-row"><div><strong style="font-size:13px">${e.servico_clinico||'—'}</strong><div style="font-size:11px;color:var(--text-gray);margin-top:2px">${e.resultado||'Aguarda resultado'}</div></div><span class="badge ${e.status?.toLowerCase().includes('conclu')?'badge-realizada':'badge-pendente'}">${e.status||'—'}</span></div>`).join(''):'<div class="no-data">Nenhum exame.</div>'}
            </div>
            <div class="modal-section"><div class="modal-section-title">Receita</div>
            ${receitas.length?receitas.map(r=>`${r.observacoes?`<div class="obs-box" style="margin-bottom:10px">${r.observacoes}</div>`:''}`+(r.itens||[]).map(i=>`<div class="med-item"><div class="med-name">💊 ${i.medicamento||'—'}</div><div class="med-detail"><span>Dosagem</span>${i.dosagem||'—'}</div><div class="med-detail"><span>Frequência</span>${i.frequencia||'—'}</div><div class="med-detail"><span>Duração</span>${i.duracao||'—'}</div></div>`).join('')).join(''):'<div class="no-data">Sem receita.</div>'}
            </div>`;
    }

    async function abrirModalProntuario(pacienteId) {
        _modalType = 'prontuario';
        document.getElementById('modalTitulo').textContent = 'Prontuário do Paciente';
        document.getElementById('modalMeta').textContent = 'Carregando...';
        document.getElementById('modalBody').innerHTML = '<div class="skel" style="height:16px;width:50%;margin-bottom:10px"></div><div class="skel" style="height:80px;border-radius:10px"></div>';
        document.getElementById('modalOverlay').classList.add('open');
        try {
            const res = await fetch(`${API_BASE}/paciente/${pacienteId}/prontuario`, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error();
            const d = await res.json();
            document.getElementById('modalTitulo').textContent = d.paciente?.nome || 'Prontuário';
            document.getElementById('modalMeta').textContent = `${d.paciente?.idade||'—'} anos · ${d.paciente?.genero||'—'}`;
            renderModalProntuario(d);
        } catch (e) {
            document.getElementById('modalBody').innerHTML = '<div class="no-data" style="color:#c0392b">Erro ao carregar prontuário.</div>';
        }
    }

    function renderModalProntuario(d) {
        const p = d.paciente || {};
        const consultas = d.consultas || [];
        document.getElementById('modalBody').innerHTML = `
            <div class="modal-section">
            <div class="modal-section-title">Dados do Paciente</div>
            <div class="pac-info-grid">
                <div class="pac-info-item"><label>Telefone</label><span>${p.num_telefone||'—'}</span></div>
                <div class="pac-info-item"><label>Email</label><span>${p.email||'—'}</span></div>
                <div class="pac-info-item"><label>Data Nasc.</label><span>${fmt(p.data_nascimento)}</span></div>
                <div class="pac-info-item"><label>Nº BI</label><span>${p.num_bi||'—'}</span></div>
            </div>
            </div>
            <div class="modal-section">
            <div class="modal-section-title">Histórico de Consultas (${consultas.length})</div>
            ${consultas.length?consultas.map(c=>`
                <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;background:var(--bg-light);border-radius:8px;margin-bottom:6px;font-size:13px;cursor:pointer" onclick="fecharModalDireto();setTimeout(()=>abrirModalConsulta(${c.id}),300)">
                <div><strong>${fmt(c.data)}</strong> · ${c.hora||'—'}<div style="font-size:11px;color:var(--text-gray);margin-top:2px">${c.tipo_consulta||c.servico||'—'}</div></div>
                <span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span>
                </div>`).join(''):'<div class="no-data">Sem consultas registadas.</div>'}
            </div>`;
    }

    function fecharModal(e) {
        if (e.target === document.getElementById('modalOverlay')) fecharModalDireto();
    }

    function fecharModalDireto() {
        document.getElementById('modalOverlay').classList.remove('open');
    }

    // Carregar horários quando mudar de página
    document.querySelector(`[onclick="showPage('horarios');return false;"]`).addEventListener('click', () => {
        if (!document.getElementById('horariosGrid').querySelector('.hfg-col')) carregarHorarios();
    });

    init();
</script>
@endsection