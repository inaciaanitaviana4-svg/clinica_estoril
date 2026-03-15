@extends('layouts.painel')
@section('titulo', 'Dashboard')
@section('estilo')
    <link rel="stylesheet" href="{{ asset('dashboard-paciente.css') }}">
@endsection
@section('conteudo')
    <div class="content">

        <!-- ══ PAGE: DASHBOARD ══════════════════ -->
        <div class="page active" id="page-dashboard">

            <div class="hero-card">
                <div>
                    <div class="hero-greeting">Bem-vindo de volta 👋</div>
                    <div class="hero-name" id="heroNome">—</div>
                    <div class="hero-msg">Acompanhe as suas consultas, exames e histórico clínico num só lugar.</div>
                </div>
                <div class="hero-ava" id="heroAva">—</div>
            </div>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon si-blue">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val" id="statTotal">—</div>
                        <div class="stat-lbl">Total de Consultas</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon si-green">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val" id="statRealizadas">—</div>
                        <div class="stat-lbl">Realizadas</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon si-orange">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val" id="statAgendadas">—</div>
                        <div class="stat-lbl">Agendadas</div>
                    </div>
                </div>
            </div>

            <!-- Próxima consulta -->
            <div id="proximaWrap"></div>

            <!-- Consultas recentes + Notificações -->
            <div class="grid-2">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="ct-icon si-blue" style="background:#eaf2ff">
                                <svg fill="none" viewBox="0 0 24 24" stroke="#0066cc" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                                </svg>
                            </div>
                            Consultas Recentes
                        </div>
                        <a class="card-link" href="{{ route('mostrar_consultas_paciente') }}">Ver todas</a>
                    </div>
                    <div class="card-body" id="dashConsultasRecentes">
                        <div class="skel" style="height:44px;margin-bottom:8px;border-radius:10px;"></div>
                        <div class="skel" style="height:44px;margin-bottom:8px;border-radius:10px;opacity:.7"></div>
                        <div class="skel" style="height:44px;border-radius:10px;opacity:.4"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="ct-icon" style="background:#fff0e8">
                                <svg fill="none" viewBox="0 0 24 24" stroke="#ff6b35" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                            Notificações Recentes
                        </div>
                        <a class="card-link" href="{{ route('listar_minhas_notificacoes') }}">Ver todas</a>
                    </div>
                    <div class="card-body" id="dashNotificacoes">
                        <div class="skel" style="height:44px;margin-bottom:8px;border-radius:10px;"></div>
                        <div class="skel" style="height:44px;margin-bottom:8px;border-radius:10px;opacity:.7"></div>
                        <div class="skel" style="height:44px;border-radius:10px;opacity:.4"></div>
                    </div>
                </div>
            </div>

        </div><!-- /page-dashboard -->

    </div>
@endsection
@section('script')
    <script>
        document.getElementById('remover-modal').style.display = 'none';
        // ── Estado global ─────────────────────────────────────
        let _todasConsultas = [];
        let _filtroAtual = 'todos';
        let _notificacoes = [];

        // ── Utilitários ───────────────────────────────────────
        const meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        const mesesFull = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
            'Outubro', 'Novembro', 'Dezembro'
        ];

        function fmtData(d) {
            if (!d) return '—';
            const [y, m, day] = d.split('-');
            return `${day}/${m}/${y}`;
        }

        function iniciais(nome = '') {
            return nome.split(' ').filter(Boolean).slice(0, 2).map(n => n[0].toUpperCase()).join('');
        }

        function badgeClass(e = '') {
            const v = e.toLowerCase();
            if (v === 'concluida' || v === 'realizada') return 'badge-realizada';
            if (v === 'cancelada') return 'badge-cancelada';
            if (v === 'pendente') return 'badge-pendente';
            return 'badge-agendada';
        }

        function badgeLabel(e = '') {
            const v = e.toLowerCase();
            if (v === 'concluida') return 'Concluída';
            if (v === 'cancelada') return 'Cancelada';
            if (v === 'agendada') return 'Agendada';
            return e;
        }
        const csrfToken = "{{ csrf_token() }}";
        // ── Init principal ────────────────────────────────────
        async function init() {
            try {
                const res = await fetch("{{ route('api_obter_dados_dashboard_paciente') }}", {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const data = await res.json();

                renderPaciente(data.paciente);
                renderStats(data.stats);
                renderProximaConsulta(data.proxima_consulta);
                renderDashConsultasRecentes(data.consultas?.slice(0, 5) || []);
                renderDashNotificacoes(data.notificacoes?.slice(0, 4) || []);
                renderConsultasTabela(data.consultas || []);
                renderNotificacoesPage(data.notificacoes || []);

                _todasConsultas = data.consultas || [];
                _notificacoes = data.notificacoes || [];

                // Badge de notificações não lidas
                const naoLidas = (_notificacoes).filter(n => !n.lida).length;
                if (naoLidas > 0) {
                    document.getElementById('navBadge').textContent = naoLidas;
                    document.getElementById('navBadge').style.display = 'inline-block';
                    document.getElementById('topbarDot').style.display = 'block';
                }

            } catch (err) {
                console.error('Erro ao carregar dashboard:', err);
            }
        }

        // ── Render paciente ───────────────────────────────────
        function renderPaciente(p = {}) {
            const nome = p.nome || 'Paciente';

            document.getElementById('heroNome').textContent = nome;
            document.getElementById('heroAva').textContent = iniciais(nome);
        }

        // ── Render stats ──────────────────────────────────────
        function renderStats(s = {}) {
            document.getElementById('statTotal').textContent = s.total ?? '0';
            document.getElementById('statRealizadas').textContent = s.concluidas ?? '0';
            document.getElementById('statAgendadas').textContent = s.agendadas ?? '0';
        }

        // ── Próxima consulta ──────────────────────────────────
        function renderProximaConsulta(c) {
            const wrap = document.getElementById('proximaWrap');
            if (!c) {
                wrap.innerHTML = '';
                return;
            }

            const d = c.data ? c.data.split('-') : ['?', '?', '?'];
            const dia = d[2] || '—';
            const mes = d[1] ? mesesFull[parseInt(d[1]) - 1] : '—';

            wrap.innerHTML = `
            <div class="proxima-card" style="margin-bottom:24px">
            <div class="proxima-date-box">
                <div class="proxima-date-day">${dia}</div>
                <div class="proxima-date-mes">${mes}</div>
            </div>
            <div class="proxima-info">
                <div class="proxima-tipo">Próxima Consulta: ${c.tipo_consulta || c.servico_clinico || '—'}</div>
                <div class="proxima-medico">Dr(a). ${c.medico || '—'}</div>
                <div class="proxima-chips">
                <span class="chip chip-blue">${c.hora || '—'}</span>
                <span class="chip chip-gray">${c.modalidade || ''}</span>
                <span class="chip chip-green">Agendada</span>
                </div>
            </div>
            </div>`;
        }

        // ── Consultas recentes no dashboard ───────────────────
        function renderDashConsultasRecentes(lista) {
            const el = document.getElementById('dashConsultasRecentes');
            if (!lista.length) {
                el.innerHTML = '<div class="no-data">Sem consultas registadas.</div>';
                return;
            }

            el.innerHTML = lista.map(c => {
                const partes = c.data ? c.data.split('-') : [];
                const dia = partes[2] || '—';
                const mon = partes[1] ? meses[parseInt(partes[1]) - 1] : '—';
                return `
                <div class="consulta-row" onclick="abrirModal(${c.id})">
                    <div class="cr-date-box">
                    <div class="cr-day">${dia}</div>
                    <div class="cr-mon">${mon}</div>
                    </div>
                    <div class="cr-info">
                    <div class="cr-tipo">${c.tipo_consulta || c.servico || '—'}</div>
                    <div class="cr-medico">${c.medico || '—'}</div>
                    </div>
                    <div class="cr-right">
                    <div class="cr-hora">${c.hora || ''}</div>
                    <div style="margin-top:4px">${badge_todos_estados(c.estado)}</div>
                    </div>
                </div>`;
            }).join('');
        }

        // ── Notificações no dashboard ─────────────────────────
        function renderDashNotificacoes(lista) {
            const el = document.getElementById('dashNotificacoes');
            if (!lista.length) {
                el.innerHTML = '<div class="no-data">Sem notificações.</div>';
                return;
            }

            el.innerHTML = lista.map(n => `
            <div class="notif-item" onclick="marcarLida(${n.id})">
            <div class="notif-dot-wrap">
                <div class="notif-dot-big ${n.lida ? 'lida' : ''}"></div>
            </div>
            <div>
                <div class="notif-titulo">${n.titulo || '—'}</div>
                <div class="notif-msg">${n.mensagem || ''}</div>
                <div class="notif-data">${fmtData(n.data)}</div>
            </div>
            </div>`).join('');
        }

        // ── Tabela de consultas ───────────────────────────────
        function renderConsultasTabela(lista) {
            _todasConsultas = lista;
            filtrarConsultas();
        }

        function filtrarConsultas() {
            const q = (document.getElementById('searchInput')?.value || '').toLowerCase();
            const lista = _todasConsultas.filter(c => {
                const matchFiltro = _filtroAtual === 'todos' || (c.estado || '').toLowerCase() === _filtroAtual;
                const matchSearch = !q ||
                    (c.medico || '').toLowerCase().includes(q) ||
                    (c.tipo_consulta || '').toLowerCase().includes(q) ||
                    (c.servico || '').toLowerCase().includes(q);
                return matchFiltro && matchSearch;
            });

            const tbody = document.getElementById('consultasTableBody');
            if (!lista.length) {
                tbody.innerHTML = `<tr><td colspan="5" class="no-data">Nenhuma consulta encontrada.</td></tr>`;
                return;
            }

            tbody.innerHTML = lista.map(c => `
            <tr>
            <td><strong>${fmtData(c.data)}</strong><div class="ct-sub">${c.hora || ''}</div></td>
            <td>
                <div class="ct-doctor">${c.tipo_consulta || '—'}</div>
                <div class="ct-sub">${c.servico || ''}</div>
            </td>
            <td>
                <div class="ct-doctor">${c.medico || '—'}</div>
                <div class="ct-sub">${c.modalidade || 'Presencial'}</div>
            </td>
            <td><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></td>
            <td><button class="btn-detalhe" onclick="abrirModal(${c.id})">Ver detalhes</button></td>
            </tr>`).join('');
        }

        function setFiltro(val, el) {
            _filtroAtual = val;
            document.querySelectorAll('.ftab').forEach(f => f.classList.remove('active'));
            el.classList.add('active');
            filtrarConsultas();
        }

        // ── Página de notificações ────────────────────────────
        function renderNotificacoesPage(lista) {
            _notificacoes = lista;
            const el = document.getElementById('notificacoesLista');
            if (!lista.length) {
                el.innerHTML =
                    '<div class="empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg><p>Sem notificações por agora.</p></div>';
                return;
            }

            el.innerHTML = lista.map(n => `
            <div class="notif-full-item ${!n.lida ? 'nao-lida' : ''}" onclick="marcarLida(${n.id}, this)">
            <div class="nfi-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <div style="flex:1">
                <div class="nfi-titulo">${n.titulo || '—'}</div>
                <div class="nfi-msg">${n.mensagem || ''}</div>
                <div class="nfi-data">${fmtData(n.data)}</div>
            </div>
            ${!n.lida ? '<span class="badge badge-agendada" style="flex-shrink:0;align-self:flex-start">Nova</span>' : ''}
            </div>`).join('');
        }

        // ── Marcar notificação como lida ──────────────────────
        async function marcarLida(id, el) {
            try {
                await fetch(`${API_BASE}/notificacao/${id}/lida`, {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (el) {
                    el.classList.remove('nao-lida');
                    el.querySelector('.badge')?.remove();
                }
                const n = _notificacoes.find(x => x.id === id);
                if (n) n.lida = true;
            } catch (e) {
                console.warn('Não foi possível marcar notificação:', e);
            }
        }

        async function marcarTodasLidas() {
            try {
                await fetch(`${API_BASE}/notificacoes/lidas`, {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                _notificacoes.forEach(n => n.lida = true);
                renderNotificacoesPage(_notificacoes);
                document.getElementById('navBadge').style.display = 'none';
                document.getElementById('topbarDot').style.display = 'none';
            } catch (e) {
                console.warn(e);
            }
        }

        // ── Modal de detalhes ─────────────────────────────────
        async function abrirModal(consultaId) {
            document.getElementById('modalBody').innerHTML = `
            <div class="skel" style="height:20px;width:50%;margin-bottom:12px;"></div>
            <div class="skel" style="height:14px;margin-bottom:8px;"></div>
            <div class="skel" style="height:14px;width:70%;margin-bottom:24px;"></div>
            <div class="skel" style="height:80px;border-radius:10px;"></div>`;
            document.getElementById('modalOverlay').classList.add('open');

            try {
                const res = await fetch(`${API_BASE}/consulta/${consultaId}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const c = await res.json();
                renderModalConteudo(c);
            } catch (e) {
                document.getElementById('modalBody').innerHTML =
                    `<div class="no-data" style="color:#c0392b">Erro ao carregar detalhes.</div>`;
            }
        }

        function renderModalConteudo(c) {
            document.getElementById('modalTitulo').textContent = c.tipo_consulta || c.servico || 'Consulta';
            document.getElementById('modalMeta').textContent =
                `${fmtData(c.data)}${c.hora ? ' · ' + c.hora : ''} · Dr(a). ${c.medico || '—'}`;

            const diags = c.diagnosticos || [];
            const exames = c.exames || [];
            const receitas = c.receitas || [];
            const pag = c.pagamento;

            document.getElementById('modalBody').innerHTML = `
            ${c.observacao ? `
                            <div class="modal-section">
                            <div class="modal-section-title">Observação</div>
                            <div class="obs-box">${c.observacao}</div>
                            </div>` : ''}

            <div class="modal-section">
            <div class="modal-section-title">Diagnósticos</div>
            ${diags.length
                ? diags.map(d=>`<div class="diag-item"><div class="diag-bullet"></div><div>${d.descricao}</div></div>`).join('')
                : '<div class="no-data">Nenhum diagnóstico registado.</div>'}
            </div>

            <div class="modal-section">
            <div class="modal-section-title">Exames Solicitados</div>
            ${exames.length
                ? exames.map(e=>`
                                    <div class="exame-row">
                                    <div>
                                        <div class="exame-nome">${e.servico_clinico || '—'}</div>
                                        <div class="exame-res">${e.resultado || 'Aguarda resultado'}</div>
                                    </div>
                                    <span class="badge ${e.status?.toLowerCase().includes('conclu') ? 'badge-realizada' : 'badge-pendente'}">${e.status || '—'}</span>
                                    </div>`).join('')
                : '<div class="no-data">Nenhum exame solicitado.</div>'}
            </div>

            <div class="modal-section">
            <div class="modal-section-title">Receita</div>
            ${receitas.length
                ? receitas.map(r=>`
                                    ${r.observacoes ? `<div class="obs-box" style="margin-bottom:12px">${r.observacoes}</div>` : ''}
                                    ${(r.itens||[]).map(i=>`
                    <div class="med-item">
                        <div class="med-name">💊 ${i.medicamento||'—'}</div>
                        <div class="med-detail"><span>Dosagem</span>${i.dosagem||'—'}</div>
                        <div class="med-detail"><span>Frequência</span>${i.frequencia||'—'}</div>
                        <div class="med-detail"><span>Duração</span>${i.duracao||'—'}</div>
                    </div>`).join('')}`).join('')
                : '<div class="no-data">Sem receita emitida.</div>'}
            </div>

            ${pag ? `
                            <div class="modal-section">
                            <div class="modal-section-title">Pagamento</div>
                            <div class="pagamento-row">
                                <div>
                                <div style="font-size:12px;color:var(--text-gray)">Método</div>
                                <div style="font-weight:600">${pag.metodo || '—'}</div>
                                </div>
                                <div style="text-align:right">
                                <div class="pagamento-val">${Number(pag.total_pago||0).toLocaleString('pt-AO')} Kz</div>
                                <span class="badge ${pag.estado?.toLowerCase()==='pago'?'badge-pago':'badge-pendente'}">${pag.estado||'—'}</span>
                                </div>
                            </div>
                            </div>` : ''}
        `;
        }

        function fecharModal(e) {
            if (e.target === document.getElementById('modalOverlay')) fecharModalDireto();
        }

        function fecharModalDireto() {
            document.getElementById('modalOverlay').classList.remove('open');
        }

        // ── Arranque ──────────────────────────────────────────
        init();
    </script>
@endsection
