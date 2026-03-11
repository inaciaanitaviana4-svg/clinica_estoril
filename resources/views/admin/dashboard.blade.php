@extends("layouts.admin")
@section("titulo","Dashboard")
@section('estilo')
<link rel="stylesheet" href="{{ asset('dashboard.css') }}">
@endsection
@section("conteudo")
<div class="content">
    <!-- KPIs -->
    <div class="kpi-grid">
        <div class="kpi-card blue">
            <div class="kpi-top">
                <div class="kpi-icon blue">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
            <div>
                <div class="kpi-value">{{ $totalPacientes['total'] }}</div>
                <div class="kpi-label">Pacientes Registados</div>
            </div>
        </div>

        <div class="kpi-card green">
            <div class="kpi-top">
                <div class="kpi-icon green">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span class="kpi-trend {{ $totalConsultas['percentagem'] > 0 ? 'up' : 'down' }}">{{ $totalConsultas['percentagem'] }}%</span>
            </div>
            <div>
                <div class="kpi-value">{{ $totalConsultas['total_mes'] }}</div>
                <div class="kpi-label">Consultas este mês</div>
                <div class="kpi-sub"> {{ $totalConsultas['total_hoje'] }} hoje</div>
            </div>
        </div>

        <div class="kpi-card orange">
            <div class="kpi-top">
                <div class="kpi-icon orange">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="kpi-trend {{ $totalPagamentos['percentagem'] > 0 ? 'up' : 'down' }}">{{ $totalPagamentos['percentagem'] }}%</span>
            </div>
            <div>
                <div class="kpi-value">{{ $totalPagamentos['receita_mes'] }}</div>
                <div class="kpi-label">Receita Total (Kz)</div>
                <div class="kpi-sub">Este mês</div>
            </div>
        </div>

        <div class="kpi-card purple">
            <div class="kpi-top">
                <div class="kpi-icon purple">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="kpi-trend {{ $totalMedicos['percentagem'] > 0 ? 'up' : 'down' }}">{{ $totalMedicos['percentagem'] }}%</span>
            </div>
            <div>
                <div class="kpi-value">{{ $totalMedicos['total_medicos_activos'] }}</div>
                <div class="kpi-label">Médicos Activos</div>
                <div class="kpi-sub"> {{ $totalMedicos['total_especialidades'] }} especialidades</div>
            </div>
        </div>
    </div>

    <!-- CONSULTAS + PAGAMENTOS POR MÉTODO -->
    <div class="three-col">
        <!-- Consultas por mês -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon blue">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    Consultas por Mês
                </div>
            </div>
            <div class="card-body">
                <div class="chart-bars" id="consultasBars"></div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-dot" style="background:var(--primary-color)"></div>Realizadas
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:var(--secondary-color)"></div>Agendadas
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagamentos por método -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon orange">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    Métodos de Pagamento
                </div>
            </div>
            <div class="card-body"id="pagamentosMetodoContainer">
            </div>
        </div>
    </div>

    <!-- CONSULTAS RECENTES + MÉDICOS -->
    <div class="two-col">
        <!-- Consultas recentes -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon blue">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    Consultas Recentes
                </div>
                <a href="{{route('mostrar_consultas_admin')}}" class="card-action">Ver todas</a>
            </div>
            <div class="card-body" style="padding-top:8px;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Médico</th>
                            <th>Data</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="consultasTable">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top médicos -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon purple">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    Top Médicos — Consultas
                </div>
            </div>
            <div class="card-body" id="topMedicos"></div>
        </div>
    </div>

    <!-- SERVIÇOS MAIS USADOS -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;">

        <!-- Serviços mais usados -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon green">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    Serviços Mais Usados
                </div>
            </div>
            <div class="card-body" id="servicosList"></div>
        </div>

        <!--  Resumo do sistema -->
        <div style="display:flex;flex-direction:column;gap:16px;">

            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-title-icon blue">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        Resumo do Sistema
                    </div>
                </div>
                <div class="card-body" style="padding-top:8px;">
                    <div class="stat-row">
                        <div class="stat-row-left">
                            <div class="stat-row-icon" style="background:#eaf2ff;color:var(--primary-color)">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            Especialidades
                        </div>
                        <span class="stat-row-val">{{ $resumoSistema['especialidades'] }}</span>
                    </div>
                    <div class="stat-row">
                        <div class="stat-row-left">
                            <div class="stat-row-icon" style="background:#d4f7e9;color:var(--secondary-color)">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            Tipos de Consulta
                        </div>
                        <span class="stat-row-val">{{ $resumoSistema['tipos_consulta'] }}</span>
                    </div>
                    <div class="stat-row">
                        <div class="stat-row-left">
                            <div class="stat-row-icon" style="background:#fff0e8;color:var(--accent-color)">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            Recepcionistas
                        </div>
                        <span class="stat-row-val">{{ $resumoSistema['recepcionistas'] }}</span>
                    </div>
                    <div class="stat-row">
                        <div class="stat-row-left">
                            <div class="stat-row-icon" style="background:#f3eeff;color:#7c3aed">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            Métodos de Pgto.
                        </div>
                        <span class="stat-row-val">{{ $resumoSistema['metodos_pagamento'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PAGAMENTOS RECENTES -->
    <div class="card" style="margin-bottom:24px">
        <div class="card-header">
            <div class="card-title">
                <div class="card-title-icon green">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                Pagamentos Recentes
            </div>
            <a href="{{ route('mostrar_pagamentos_admin') }}" class="card-action">Ver todos</a>
        </div>
        <div class="card-body" style="padding-top:8px;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Data</th>
                        <th>Método</th>
                        <th>Recepcionista</th>
                        <th>Total (Kz)</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="pagamentosTable"></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const csrfToken = "{{ csrf_token() }}";

    document.addEventListener('DOMContentLoaded', () => {
        loadingData()
    });

    async function loadingData() {
        try {
            const response = await fetch("{{ route('api_obter_dados_dashboard') }}", {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });
            const {
                consultas_por_mes,
                pagamentos_por_metodo,
                consultas_recentes,
                top_medicos,
                servicos_mais_usados,
                resumo_sistema,
                pagamentos_recentes,
                total_metodo_pagamento
            } = await response.json();
            renderizarConsultasPorMes(consultas_por_mes);
            renderizarConsultasRecentes(consultas_recentes);
            renderizarTopMedicos(top_medicos);
            renderizarServicos(servicos_mais_usados);
            renderizarPagamentosRecentes(pagamentos_recentes);
            renderizarPagamentosPorMetodo(total_metodo_pagamento);
        } catch (error) {
            console.error("Erro ao carregar dados do dashboard:", error);
        }
    }

    // --- CHART BARS ---
    function renderizarConsultasPorMes(consultas) {

        const realizadas = consultas.map((consulta, i) => {
            return Object.values(consulta)[0].concluidas || 0
        });
        const agendadas = consultas.map((consulta, i) => {
            return Object.values(consulta)[0].agendadas || 0
        });
        const maxVal = Math.max(...realizadas, ...agendadas);
        const barsEl = document.getElementById('consultasBars');

        consultas.forEach((consulta, i) => {
            const m = Object.keys(consulta)[0]
            const agendadas = Object.values(consulta)[0].agendadas || 0
            const realizadas = Object.values(consulta)[0].concluidas || 0

            const col = document.createElement('div');
            col.className = 'bar-col';
            const rH = Math.round((realizadas / maxVal) * 100);
            const aH = Math.round((agendadas / maxVal) * 100);
            col.innerHTML = `
                <div class="bar-val">${realizadas+agendadas}</div>
                <div class="bar-wrap" style="flex-direction:column;justify-content:flex-end;gap:2px;">
                <div class="bar blue" style="height:${rH}%" title="Realizadas: ${realizadas}"></div>
                <div class="bar green" style="height:${aH}%" title="Agendadas: ${agendadas}"></div>
                </div>
                <div class="bar-label">${m}</div>
            `;
            barsEl.appendChild(col);
        });
    }

    // --- CONSULTAS RECENTES ---
    function renderizarConsultasRecentes(consultasData) {
        const avatarColors = ['#0066cc', '#00a86b', '#7c3aed', '#ff6b35', '#e01b5d'];
        const tbody = document.getElementById('consultasTable');
        consultasData.forEach((c, i) => {
            const initials = c.paciente.split(' ').slice(0, 2).map(n => n[0]).join('');
            tbody.innerHTML += `<tr>
                <td><div class="td-name-wrap"><div class="td-avatar" style="background:${avatarColors[i%5]}">${initials}</div><span class="td-name">${c.paciente}</span></div></td>
                <td><span style="font-size:12px;color:var(--text-gray)">${c.medico}</span></td>
                <td><span style="font-size:12px">${c.data} · ${c.hora}</span></td>
                <td>${badge_todos_estados(c.estado)}</td>
            </tr>`;
        });
    }

    // --- TOP MÉDICOS ---
    const avatarColors = ['#0066cc', '#00a86b', '#7c3aed', '#ff6b35', '#e01b5d'];

    function renderizarTopMedicos(medicosData) {
        const medicos = medicosData.map((m) => ({
            nome: m.medico,
            esp: m.especialidade,
            consultas: m.consultas,
            cor: avatarColors[Math.floor(Math.random() * avatarColors.length)]
        }))
        const maxC = medicos[0].consultas;
        const medicosEl = document.getElementById('topMedicos');
        medicos.forEach((m, i) => {
            const pct = Math.round((m.consultas / maxC) * 100);
            medicosEl.innerHTML += `<div class="prog-wrap">
            <div class="prog-header">
            <div class="prog-label" style="display:flex;align-items:center;gap:6px">
                <div class="td-avatar" style="background:${m.cor};width:22px;height:22px;font-size:9px">${m.nome.split(' ').slice(0,2).map(n=>n[0]).join('')}</div>
                ${m.nome}<span style="color:var(--text-light);font-size:11px"> · ${m.esp}</span>
            </div>
            <div class="prog-val">${m.consultas}</div>
            </div>
            <div class="prog-bar"><div class="prog-fill" style="width:${pct}%;background:${m.cor}"></div></div>
        </div>`;
        });
    }

    // --- SERVIÇOS ---
    function renderizarServicos(servicosData) {
        const cores = ['var(--primary-color)', 'var(--secondary-color)', '#7c3aed', 'var(--accent-color)'];
        const servicos = servicosData.map((s) => ({
            nome: s.servico,
            usos: s.total,
            pct: Math.round((s.total / servicosData[0].total) * 100),
            cor: cores[Math.floor(Math.random() * cores.length)]
        }))
        const servicosEl = document.getElementById('servicosList');
        servicos.forEach(s => {
            servicosEl.innerHTML += `<div class="prog-wrap">
            <div class="prog-header">
            <div class="prog-label">${s.nome}</div>
            <div class="prog-val">${s.usos}</div>
            </div>
            <div class="prog-bar"><div class="prog-fill" style="width:${s.pct}%;background:${s.cor}"></div></div>
        </div>`;
        });
    }

    // --- PAGAMENTOS ---
    function renderizarPagamentosRecentes(pagamentosData) {

        const pagamentos = pagamentosData.map(p => ({
            paciente: p.paciente,
            data: new Date(p.data).toLocaleDateString('pt-PT'),
            metodo: p.metodo_pagamento,
            recep: p.recepcionista,
            total: p.total,
            estado: p.estado
        }))

        const pgTbody = document.getElementById('pagamentosTable');
        pagamentos.forEach((p, i) => {
            const initials = p.paciente.split(' ').slice(0, 2).map(n => n[0]).join('');
            pgTbody.innerHTML += `<tr>
            <td><div class="td-name-wrap"><div class="td-avatar" style="background:${avatarColors[i%5]}">${initials}</div><span class="td-name">${p.paciente}</span></div></td>
            <td style="font-size:12px;color:var(--text-gray)">${p.data}</td>
            <td style="font-size:12px">${p.metodo}</td>
            <td style="font-size:12px;color:var(--text-gray)">${p.recep}</td>
            <td style="font-weight:700;color:var(--secondary-color)">${p.total} Kz</td>
            <td>${badge_todos_estados(p.estado)}</td>
        </tr>`;
        });
    }

    function renderizarPagamentosPorMetodo(dados) {
        const container = document.getElementById('pagamentosMetodoContainer');
        if (!container) return;

        // Paleta de cores (expande automaticamente se houver mais métodos)
        const cores = ['#0066cc', '#00a86b', '#ff6b35', '#9b59b6', '#f39c12', '#1abc9c'];

        const totalGeral = dados.reduce((sum, item) => sum + Number(item.total), 0);
        const circunf = 2 * Math.PI * 48; // ≈ 301.6 — circunferência do círculo r=48

        // ── Gera os arcos do donut ────────────────────────────
        let offsetAcumulado = 0;
        const circulos = dados.map((item, i) => {
            const total = Number(item.total);
            const arco = totalGeral > 0 ? (total / totalGeral) * circunf : 0;
            const dasharray = `${arco.toFixed(2)} ${circunf.toFixed(2)}`;
            const dashoffset = -offsetAcumulado;
            offsetAcumulado += arco;

            return `<circle cx="60" cy="60" r="48" fill="none"
                    stroke="${cores[i % cores.length]}"
                    stroke-width="16"
                    stroke-dasharray="${dasharray}"
                    stroke-dashoffset="${dashoffset.toFixed(2)}" />`;
        }).join('\n');

        // ── Gera os itens da legenda ──────────────────────────
        const legendaHTML = dados.map((item, i) => `
        <div class="donut-legend-item">
            <div class="donut-legend-left">
                <div class="donut-legend-dot" style="background:${cores[i % cores.length]}"></div>
                ${item.nome}
            </div>
            <div class="donut-legend-val">${Number(item.total).toLocaleString('pt-AO')}</div>
        </div>`).join('\n');

        // ── Monta o HTML final ────────────────────────────────
        container.innerHTML = `
        <div class="donut-wrap">
            <svg width="120" height="120" viewBox="0 0 120 120">
                <circle cx="60" cy="60" r="48" fill="none" stroke="#f0f0f0" stroke-width="16" />
                ${totalGeral > 0 ? circulos : ''}
            </svg>
            <div class="donut-center">
                <div class="donut-center-val">${totalGeral.toLocaleString('pt-AO')}</div>
                <div class="donut-center-lbl">total</div>
            </div>
        </div>
        <div class="donut-legend">
            ${dados.length > 0 ? legendaHTML : '<div style="color:#999;font-size:13px">Sem dados</div>'}
        </div>
    `;
    }
</script>
@endsection