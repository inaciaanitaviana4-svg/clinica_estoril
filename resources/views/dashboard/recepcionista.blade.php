@extends('layouts.painel')
@section('titulo', 'Dashboard')
@section('estilo')
    <link rel="stylesheet" href="{{ asset('dashboard-recepcionista.css') }}">
@endsection
@section('conteudo')
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
                    <div class="stat-icon si-purple"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></div>
                    <div>
                        <div class="stat-val" id="statHoje">—</div>
                        <div class="stat-lbl">Consultas Hoje</div>
                        <div class="stat-sub" id="statHojeSub">—</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon si-blue"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                        </svg></div>
                    <div>
                        <div class="stat-val" id="statMes">—</div>
                        <div class="stat-lbl">Consultas no Mês</div>
                        <div class="stat-sub" id="statMesSub">—</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg></div>
                    <div>
                        <div class="stat-val" id="statReceitaMes">—</div>
                        <div class="stat-lbl">Receita do Mês (Kz)</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon si-orange"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
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
                            <div class="ct-icon si-purple"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg></div>
                            Consultas de Hoje
                        </div>
                        <a class="card-link" href="{{ route('mostrar_consultas_recepcionista') }}">Ver todas</a>
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
                            <div class="ct-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg></div>
                            Pagamentos Recentes
                        </div>
                        <a class="card-link" href="{{ route('mostrar_pagamentos_recepcionista') }}">Ver todos</a>
                    </div>
                    <div class="card-body" id="pagamentosRecentesList">
                        <div class="skel" style="height:42px;margin-bottom:8px;border-radius:8px;"></div>
                        <div class="skel" style="height:42px;margin-bottom:8px;border-radius:8px;opacity:.7"></div>
                        <div class="skel" style="height:42px;border-radius:8px;opacity:.4"></div>
                    </div>
                </div>
            </div>

        </div><!-- /page-dashboard -->
    </div>
@endsection
@section('script')
    <script>
        const MESES_PT = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
            'Outubro', 'Novembro', 'Dezembro'
        ];
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
        const csrfToken = "{{ csrf_token() }}";
        // ── Init ──────────────────────────────────────────────
        async function init() {
            try {
               const res = await fetch("{{ route('api_obter_dados_dashboard_recepcionista') }}", {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
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
            <div class="consulta-hoje-item">
            <div class="chi-hora"><div class="chi-hora-val">${c.hora||'—'}</div><div class="chi-hora-lbl">horas</div></div>
            <div class="chi-divider"></div>
            <div class="chi-info">
                <div class="chi-paciente">${c.paciente||'—'}${!c.id_recepcionista?'<span class="sem-recep">Sem recep.</span>':''}</div>
                <div class="chi-tipo">${c.medico||'—'} · ${c.tipo_consulta||c.servico_clinico||'—'}</div>
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
            <div class="pag-item" style="cursor:pointer">
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
        init();
    </script>
@endsection
