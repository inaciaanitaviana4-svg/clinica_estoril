@extends('layouts.painel')
@section('titulo', 'Dashboard')
@section('estilo')
    <link rel="stylesheet" href="{{ asset('dashboard-medico.css') }}">
@endsection
@section('conteudo')
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
                    <div class="stat-icon si-teal"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></div>
                    <div>
                        <div class="stat-val" id="statHoje">—</div>
                        <div class="stat-lbl">Consultas Hoje</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon si-blue"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                        </svg></div>
                    <div>
                        <div class="stat-val" id="statMes">—</div>
                        <div class="stat-lbl">Consultas no Mês</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                        </svg></div>
                    <div>
                        <div class="stat-val" id="statPacientes">—</div>
                        <div class="stat-lbl">Pacientes Atendidos</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon si-orange"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                            <div class="ct-icon si-teal"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg></div>
                            Agenda de Hoje
                        </div>
                        <a class="card-link" href="{{ route('mostrar_consultas_medico') }}">Ver todas</a>
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
                            <div class="ct-icon si-blue"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg></div>
                            Esta Semana
                        </div>
                        <a class="card-link" href="{{ route('mostrar_horarios_medico') }}">Detalhe</a>
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
                        <div class="ct-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                            </svg></div>
                        Pacientes Recentes
                    </div>
                    <a class="card-link" href="{{ route('mostrar_prontuarios_medico') }}">Ver prontuários</a>
                </div>
                <div class="card-body" id="pacientesRecentes">
                    <div class="skel" style="height:36px;margin-bottom:8px;border-radius:8px;"></div>
                    <div class="skel" style="height:36px;margin-bottom:8px;border-radius:8px;opacity:.7"></div>
                    <div class="skel" style="height:36px;border-radius:8px;opacity:.4"></div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
    <script>
        const csrfToken = "{{ csrf_token() }}";
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
        // ── Init ──────────────────────────────────────────────
        async function init() {
            try {
                const res = await fetch("{{ route('api_obter_dados_dashboard_medico') }}", {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
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
        }

        function renderMedico(m) {
            const nome = m.nome || 'Médico';
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
                el.innerHTML =
                    '<div class="empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><p>Sem consultas para hoje.</p></div>';
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
                return `<div class="consulta-dia-item ${proxima?'proxima':''}" onclick="abrirModalConsulta(${c.id_consulta})">
                <div class="cdi-hora"><div class="cdi-hora-val">${c.hora||'—'}</div><div class="cdi-hora-lbl">horas</div></div>
                <div class="cdi-divider ${proxima?'teal':''}"></div>
                <div class="cdi-info">
                    <div class="cdi-nome">${c.paciente||'—'}</div>
                    <div class="cdi-tipo">${c.tipo_consulta||c.servico_clinico||'—'} · ${c.modalidade||'Presencial'}</div>
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
            <div class="paciente-row" >
            <div class="pac-ava">${iniciais(p.paciente?.nome||p.nome||'?')}</div>
            <div>
                <div class="pac-nome">${p.paciente?.nome||p.nome||'—'}</div>
                <div class="pac-sub">${p.total_consultas||0} consulta${p.total_consultas!==1?'s':''}</div>
            </div>
            <div class="pac-data">${fmt(p.ultima_data)}</div>
            </div>`).join('');
        }
        init();
    </script>
@endsection
