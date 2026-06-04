@extends('layouts.admin')

@section('titulo', 'Histórico de Atividade')

@section('estilo')
<style>
:root {
    --hist-bg:          #f1f5f9;
    --hist-card-bg:     #ffffff;
    --hist-border:      #e2e8f0;
    --hist-text:        #1e293b;
    --hist-text-muted:  #64748b;
    --hist-shadow:      0 1px 3px rgba(0,0,0,.07), 0 1px 2px rgba(0,0,0,.04);
    --hist-shadow-lg:   0 4px 20px rgba(0,0,0,.10);
    --hist-radius:      14px;
    --hist-radius-sm:   8px;
    --brand:            #0066cc;
    --brand-hover:      #0052a3;

    --cor-registro:    #3b82f6;
    --cor-consulta:    #8b5cf6;
    --cor-atualizacao: #f59e0b;
    --cor-pagamento:   #10b981;
    --cor-mensagem:    #ec4899;
    --cor-sessao:          #06b6d4;
    --cor-sessao_falhada:  #ef4444;
    --cor-logout:          #64748b;

    --notif-new-bg:    #fffbeb;
    --notif-new-border:#fde68a;
    --notif-seen-bg:   var(--hist-card-bg);
    --notif-seen-border:var(--hist-border);
}
body.dark-mode {
    --hist-bg:         #0f172a;
    --hist-card-bg:    #1e293b;
    --hist-border:     #334155;
    --hist-text:       #f1f5f9;
    --hist-text-muted: #94a3b8;
    --hist-shadow:     0 1px 3px rgba(0,0,0,.3);
    --hist-shadow-lg:  0 4px 20px rgba(0,0,0,.45);
    --notif-new-bg:    #1c1a0f;
    --notif-new-border:#854d0e;
    --notif-seen-bg:   var(--hist-card-bg);
    --notif-seen-border:var(--hist-border);
}

.hist-wrapper { padding:28px 24px; background:var(--hist-bg); min-height:calc(100vh - 64px); color:var(--hist-text); }
.hist-page-header { display:flex; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:24px; }
.hist-page-header h1 { font-size:1.45rem; font-weight:700; margin:0; color:var(--hist-text); display:flex; align-items:center; gap:10px; }
.hist-page-header h1 i { color:var(--brand); font-size:1.25rem; }
.hist-page-header p { margin:4px 0 0; font-size:.85rem; color:var(--hist-text-muted); }
.hist-header-actions { display:flex; gap:8px; align-items:center; flex-wrap:wrap; }

.hist-btn { padding:8px 16px; border-radius:var(--hist-radius-sm); font-size:.85rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:6px; transition:all .18s; border:1px solid transparent; }
.hist-btn-primary { background:var(--brand); color:#fff; border-color:var(--brand); }
.hist-btn-primary:hover { background:var(--brand-hover); }
.hist-btn-outline { background:transparent; color:var(--hist-text-muted); border-color:var(--hist-border); }
.hist-btn-outline:hover { background:var(--hist-border); color:var(--hist-text); }

/* ── Cards de resumo — 6 agora ────────────────────────────── */
.hist-resumo-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:12px; margin-bottom:24px; }
.hist-resumo-card { background:var(--hist-card-bg); border:1px solid var(--hist-border); border-radius:var(--hist-radius); padding:16px; display:flex; align-items:center; gap:12px; box-shadow:var(--hist-shadow); cursor:pointer; transition:box-shadow .2s,transform .15s,border-color .2s; --card-cor:#6b7280; }
.hist-resumo-card:hover { box-shadow:var(--hist-shadow-lg); transform:translateY(-2px); }
.hist-resumo-card.ativo { border-color:var(--card-cor); box-shadow:0 0 0 3px color-mix(in srgb,var(--card-cor) 18%,transparent); }
.hist-resumo-icone { width:42px; height:42px; border-radius:var(--hist-radius-sm); display:flex; align-items:center; justify-content:center; font-size:1.1rem; color:#fff; flex-shrink:0; background:var(--card-cor); }
.hist-resumo-info strong { display:block; font-size:1.4rem; font-weight:700; line-height:1; color:var(--hist-text); }
.hist-resumo-info span { font-size:.75rem; color:var(--hist-text-muted); font-weight:500; }

/* ── Notificações ──────────────────────────────────────────── */
.hist-notif-section { margin-bottom:24px; animation:histFadeIn .35s ease; }
@keyframes histFadeIn { from{opacity:0;transform:translateY(-6px);} to{opacity:1;transform:none;} }
.hist-notif-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; flex-wrap:wrap; gap:8px; }
.hist-notif-titulo { display:flex; align-items:center; gap:10px; font-size:.95rem; font-weight:700; color:var(--hist-text); }
.hist-notif-badge { display:inline-flex; align-items:center; justify-content:center; min-width:22px; height:22px; padding:0 6px; background:#ef4444; color:#fff; border-radius:20px; font-size:.72rem; font-weight:800; line-height:1; transition:transform .2s; }
.hist-notif-badge.zero { background:var(--hist-border); color:var(--hist-text-muted); }
.hist-notif-badge.pulsar { animation:histPulsar .6s ease; }
@keyframes histPulsar { 0%,100%{transform:scale(1);} 50%{transform:scale(1.35);} }
.hist-notif-acoes { display:flex; gap:6px; align-items:center; }
.hist-notif-lista { display:flex; flex-direction:column; gap:8px; }
.hist-notif-item { display:grid; grid-template-columns:42px 1fr auto; border-radius:var(--hist-radius); border:1px solid var(--notif-new-border); background:var(--notif-new-bg); box-shadow:0 2px 8px rgba(245,158,11,.08); overflow:hidden; transition:background .25s,border-color .25s,opacity .3s,max-height .4s; max-height:200px; }
.hist-notif-item.visto { background:var(--notif-seen-bg); border-color:var(--notif-seen-border); box-shadow:none; opacity:.65; }
.hist-notif-barra { width:100%; background:var(--notif-cor,#f59e0b); display:flex; align-items:center; justify-content:center; color:#fff; font-size:.9rem; flex-shrink:0; }
.hist-notif-item.visto .hist-notif-barra { opacity:.5; }
.hist-notif-corpo { padding:12px 14px; display:flex; flex-direction:column; gap:3px; min-width:0; }
.hist-notif-cat { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:var(--notif-cor,#f59e0b); display:flex; align-items:center; gap:5px; }
.hist-notif-item.visto .hist-notif-cat { color:var(--hist-text-muted); }
.hist-notif-desc { font-size:.875rem; color:var(--hist-text); font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.hist-notif-item.visto .hist-notif-desc { font-weight:400; color:var(--hist-text-muted); }
.hist-notif-tempo { font-size:.75rem; color:var(--hist-text-muted); }
.hist-notif-acao-col { padding:12px 14px 12px 8px; display:flex; align-items:center; gap:6px; flex-shrink:0; }
.hist-btn-visto { padding:5px 12px; border:1px solid var(--hist-border); border-radius:6px; background:var(--hist-card-bg); color:var(--hist-text-muted); font-size:.78rem; font-weight:600; cursor:pointer; transition:all .15s; white-space:nowrap; }
.hist-btn-visto:hover { background:var(--brand); color:#fff; border-color:var(--brand); }
.hist-notif-item.visto .hist-btn-visto { background:transparent; color:var(--hist-text-muted); border-color:transparent; cursor:default; opacity:.5; pointer-events:none; }
.hist-notif-vazio { text-align:center; padding:28px 20px; color:var(--hist-text-muted); background:var(--hist-card-bg); border:1px solid var(--hist-border); border-radius:var(--hist-radius); font-size:.875rem; }
.hist-notif-vazio i { font-size:1.8rem; opacity:.3; display:block; margin-bottom:8px; }
.hist-notif-collapsible { overflow:hidden; transition:max-height .4s ease,opacity .3s; }
.hist-notif-collapsible.fechado { max-height:0 !important; opacity:0; }

/* ── Filtros ─────────────────────────────────────────────────  */
.hist-filtros { background:var(--hist-card-bg); border:1px solid var(--hist-border); border-radius:var(--hist-radius); padding:16px 20px; margin-bottom:18px; box-shadow:var(--hist-shadow); }
.hist-filtros-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1fr auto; gap:10px; align-items:end; }
@media(max-width:900px){ .hist-filtros-grid{grid-template-columns:1fr 1fr;} }
@media(max-width:560px){ .hist-filtros-grid{grid-template-columns:1fr;} }
.hist-filtro-grupo { display:flex; flex-direction:column; gap:5px; }
.hist-filtro-grupo label { font-size:.75rem; font-weight:600; color:var(--hist-text-muted); text-transform:uppercase; letter-spacing:.04em; }
.hist-filtro-grupo input,
.hist-filtro-grupo select { padding:8px 11px; border:1px solid var(--hist-border); border-radius:var(--hist-radius-sm); background:var(--hist-bg); color:var(--hist-text); font-size:.85rem; outline:none; transition:border-color .2s; width:100%; }
.hist-filtro-grupo input:focus,
.hist-filtro-grupo select:focus { border-color:var(--brand); }

/* ── Timeline ────────────────────────────────────────────────  */
.hist-timeline-container { background:var(--hist-card-bg); border:1px solid var(--hist-border); border-radius:var(--hist-radius); box-shadow:var(--hist-shadow); overflow:hidden; }
.hist-timeline-header { padding:14px 22px; border-bottom:1px solid var(--hist-border); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px; }
.hist-timeline-header strong { font-size:.9rem; font-weight:600; color:var(--hist-text); }
.hist-timeline-header span  { font-size:.83rem; color:var(--hist-text-muted); }
.hist-lista { list-style:none; margin:0; padding:0; }
.hist-item { display:grid; grid-template-columns:52px 1fr auto; border-bottom:1px solid var(--hist-border); transition:background .15s; }
.hist-item:last-child { border-bottom:none; }
.hist-item:hover { background:rgba(0,102,204,.03); }
body.dark-mode .hist-item:hover { background:rgba(255,255,255,.03); }
.hist-item-icone-col { display:flex; flex-direction:column; align-items:center; padding:16px 0 16px 18px; position:relative; }
.hist-item-icone-col::after { content:''; position:absolute; top:50px; bottom:0; left:37px; width:2px; background:var(--hist-border); }
.hist-item:last-child .hist-item-icone-col::after { display:none; }
.hist-icone-badge { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:.85rem; color:#fff; flex-shrink:0; z-index:1; }
.hist-item-corpo { padding:16px 14px; min-width:0; }
.hist-item-topo { display:flex; align-items:center; gap:7px; flex-wrap:wrap; margin-bottom:4px; }
.hist-badge-categoria { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.06em; padding:2px 8px; border-radius:20px; color:#fff; }
.hist-item-usuario { font-size:.855rem; font-weight:600; color:var(--hist-text); }
.hist-item-tipo-util { font-size:.72rem; color:var(--hist-text-muted); background:var(--hist-bg); border:1px solid var(--hist-border); padding:1px 7px; border-radius:20px; }
.hist-item-descricao { font-size:.855rem; color:var(--hist-text); margin:3px 0; line-height:1.42; }
.hist-item-meta { display:flex; align-items:center; gap:10px; flex-wrap:wrap; margin-top:5px; }
.hist-item-meta span { font-size:.76rem; color:var(--hist-text-muted); display:flex; align-items:center; gap:3px; }
.hist-campos-alterados { display:flex; flex-wrap:wrap; gap:4px; margin-top:5px; }
.hist-campo-tag { font-size:.7rem; background:rgba(245,158,11,.1); color:#92400e; border:1px solid rgba(245,158,11,.3); padding:2px 7px; border-radius:4px; font-weight:500; }
body.dark-mode .hist-campo-tag { color:#fcd34d; background:rgba(245,158,11,.15); border-color:rgba(245,158,11,.35); }
.hist-item-data-col { padding:16px 18px 16px 8px; display:flex; flex-direction:column; align-items:flex-end; justify-content:center; gap:4px; min-width:138px; }
.hist-item-data-hora { font-size:.78rem; font-weight:600; color:var(--hist-text); white-space:nowrap; }
.hist-item-data-relativa { font-size:.73rem; color:var(--hist-text-muted); white-space:nowrap; }
.hist-vazio { padding:56px 20px; text-align:center; color:var(--hist-text-muted); }
.hist-vazio i { font-size:2.8rem; opacity:.25; display:block; margin-bottom:10px; }
.hist-vazio p { margin:0; font-size:.875rem; }
.hist-skeleton-item { display:grid; grid-template-columns:52px 1fr auto; border-bottom:1px solid var(--hist-border); animation:histPulse 1.5s ease-in-out infinite; }
@keyframes histPulse { 0%,100%{opacity:1;} 50%{opacity:.4;} }
.hist-skel-icone { padding:16px 0 16px 18px; display:flex; align-items:flex-start; }
.hist-skel-circle { width:36px; height:36px; border-radius:50%; background:var(--hist-border); }
.hist-skel-corpo { padding:18px 14px; display:flex; flex-direction:column; gap:8px; }
.hist-skel-linha { height:11px; border-radius:6px; background:var(--hist-border); }
.hist-skel-data { padding:18px 18px 18px 8px; display:flex; flex-direction:column; gap:6px; align-items:flex-end; }
.hist-paginacao { display:flex; align-items:center; justify-content:space-between; padding:14px 22px; border-top:1px solid var(--hist-border); flex-wrap:wrap; gap:8px; background:var(--hist-card-bg); }
.hist-paginacao-info { font-size:.78rem; color:var(--hist-text-muted); }
.hist-paginacao-btns { display:flex; gap:4px; }
.hist-pag-btn { padding:5px 11px; border:1px solid var(--hist-border); border-radius:6px; background:var(--hist-card-bg); color:var(--hist-text); font-size:.78rem; cursor:pointer; transition:all .15s; }
.hist-pag-btn:hover:not(:disabled) { background:var(--brand); color:#fff; border-color:var(--brand); }
.hist-pag-btn.ativo { background:var(--brand); color:#fff; border-color:var(--brand); font-weight:600; }
.hist-pag-btn:disabled { opacity:.4; cursor:not-allowed; }
.hist-spinner { display:none; width:16px; height:16px; border:2px solid rgba(255,255,255,.35); border-top-color:#fff; border-radius:50%; animation:histSpin .6s linear infinite; }
@keyframes histSpin { to{transform:rotate(360deg);} }

@media(max-width:640px) {
    .hist-wrapper { padding:14px 10px; }
    .hist-item { grid-template-columns:42px 1fr; }
    .hist-item-data-col { display:none; }
    .hist-item-icone-col { padding-left:10px; }
    .hist-item-icone-col::after { left:29px; }
    .hist-notif-item { grid-template-columns:36px 1fr auto; }
}
</style>
@endsection

@section('conteudo')
<div class="hist-wrapper">

    {{-- CABEÇALHO --}}
    <div class="hist-page-header">
        <div>
            <h1><i class="fa-solid fa-clock-rotate-left"></i> Histórico de Atividade</h1>
            <p>Auditoria completa de todas as ações realizadas no sistema</p>
        </div>
        <div class="hist-header-actions">
            <button class="hist-btn hist-btn-outline" id="btnExportarCSV">
                <i class="fa-solid fa-download"></i> Exportar filtros
            </button>
        </div>
    </div>

    {{-- CARDS DE RESUMO — 6 categorias --}}
    <div class="hist-resumo-grid">
        <div class="hist-resumo-card" style="--card-cor:var(--cor-registro);" onclick="filtrarPorCategoria('registro')" data-categoria="registro">
            <div class="hist-resumo-icone"><i class="fa-solid fa-user-plus"></i></div>
            <div class="hist-resumo-info">
                <strong>{{ number_format($totalRegistos) }}</strong>
                <span>Registos</span>
            </div>
        </div>
        <div class="hist-resumo-card" style="--card-cor:var(--cor-consulta);" onclick="filtrarPorCategoria('consulta')" data-categoria="consulta">
            <div class="hist-resumo-icone"><i class="fa-solid fa-stethoscope"></i></div>
            <div class="hist-resumo-info">
                <strong>{{ number_format($totalConsultas) }}</strong>
                <span>Consultas</span>
            </div>
        </div>
        <div class="hist-resumo-card" style="--card-cor:var(--cor-atualizacao);" onclick="filtrarPorCategoria('atualizacao')" data-categoria="atualizacao">
            <div class="hist-resumo-icone"><i class="fa-solid fa-pen-to-square"></i></div>
            <div class="hist-resumo-info">
                <strong>{{ number_format($totalAtualizacoes) }}</strong>
                <span>Atualizações</span>
            </div>
        </div>
        <div class="hist-resumo-card" style="--card-cor:var(--cor-pagamento);" onclick="filtrarPorCategoria('pagamento')" data-categoria="pagamento">
            <div class="hist-resumo-icone"><i class="fa-solid fa-credit-card"></i></div>
            <div class="hist-resumo-info">
                <strong>{{ number_format($totalPagamentos) }}</strong>
                <span>Pagamentos</span>
            </div>
        </div>
        <div class="hist-resumo-card" style="--card-cor:var(--cor-mensagem);" onclick="filtrarPorCategoria('mensagem')" data-categoria="mensagem">
            <div class="hist-resumo-icone"><i class="fa-solid fa-comments"></i></div>
            <div class="hist-resumo-info">
                <strong>{{ number_format($totalMensagens) }}</strong>
                <span>Mensagens</span>
            </div>
        </div>
        <div class="hist-resumo-card" style="--card-cor:var(--cor-sessao);" onclick="filtrarPorCategoria('sessao')" data-categoria="sessao">
            <div class="hist-resumo-icone"><i class="fa-solid fa-right-to-bracket"></i></div>
            <div class="hist-resumo-info">
                <strong>{{ number_format($totalSessoes) }}</strong>
                <span>Inícios Sessão</span>
            </div>
        </div>
        <div class="hist-resumo-card" style="--card-cor:var(--cor-sessao_falhada);" onclick="filtrarPorCategoria('sessao_falhada')" data-categoria="sessao_falhada">
            <div class="hist-resumo-icone"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="hist-resumo-info">
                <strong>{{ number_format($totalSessoesFalhadas) }}</strong>
                <span>Tentativas Falhadas</span>
            </div>
        </div>
        <div class="hist-resumo-card" style="--card-cor:var(--cor-logout);" onclick="filtrarPorCategoria('logout')" data-categoria="logout">
            <div class="hist-resumo-icone"><i class="fa-solid fa-right-from-bracket"></i></div>
            <div class="hist-resumo-info">
                <strong>{{ number_format($totalLogouts) }}</strong>
                <span>Sessões Terminadas</span>
            </div>
        </div>
    </div>

    {{-- SECÇÃO DE NOTIFICAÇÕES / EVENTOS RECENTES --}}
    <div class="hist-notif-section" id="notifSection">
        <div class="hist-notif-header">
            <div class="hist-notif-titulo">
                <i class="fa-solid fa-bell" style="color:#f59e0b;"></i>
                Eventos Recentes
                <span class="hist-notif-badge" id="notifBadge">0</span>
            </div>
            <div class="hist-notif-acoes">
                <button class="hist-btn hist-btn-outline" id="btnMarcarTodosVisto" style="font-size:.78rem;padding:6px 12px;">
                    <i class="fa-solid fa-check-double"></i> Marcar todos como visto
                </button>
                <button class="hist-btn hist-btn-outline" id="btnToggleNotif" style="font-size:.78rem;padding:6px 12px;" title="Mostrar/ocultar">
                    <i class="fa-solid fa-chevron-up" id="iconToggleNotif"></i>
                </button>
            </div>
        </div>
        <div class="hist-notif-collapsible" id="notifCollapsible">
            <div class="hist-notif-lista" id="notifLista">
                <div class="hist-notif-vazio">
                    <i class="fa-regular fa-bell-slash"></i>
                    <span>A carregar eventos recentes...</span>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTROS --}}
    <div class="hist-filtros">
        <div class="hist-filtros-grid">
            <div class="hist-filtro-grupo">
                <label><i class="fa-solid fa-magnifying-glass" style="margin-right:4px;"></i>Pesquisar</label>
                <input type="text" id="filtro_pesquisar" placeholder="Nome, descrição, utilizador...">
            </div>
            <div class="hist-filtro-grupo">
                <label>Categoria</label>
                <select id="filtro_categoria">
                    <option value="todos">Todas</option>
                    <option value="registro">Registo</option>
                    <option value="consulta">Consulta</option>
                    <option value="atualizacao">Atualização</option>
                    <option value="pagamento">Pagamento</option>
                    <option value="mensagem">Mensagem</option>
                    <option value="sessao">Sessão (Início)</option>
                    <option value="sessao_falhada">Sessão Falhada</option>
                    <option value="logout">Sessões Terminadas</option>
                </select>
            </div>
            <div class="hist-filtro-grupo">
                <label>Data início</label>
                <input type="date" id="filtro_data_inicio">
            </div>
            <div class="hist-filtro-grupo">
                <label>Data fim</label>
                <input type="date" id="filtro_data_fim">
            </div>
            <div class="hist-filtro-grupo">
                <label>&nbsp;</label>
                <button class="hist-btn hist-btn-primary" onclick="aplicarFiltros()">
                    <span class="hist-spinner" id="spinnerFiltrar"></span>
                    <i class="fa-solid fa-filter" id="iconFiltrar"></i>
                    Pesquisar
                </button>
            </div>
        </div>
        <div style="margin-top:10px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <button class="hist-btn hist-btn-outline" onclick="limparFiltros()" style="font-size:.78rem;padding:6px 12px;">
                <i class="fa-solid fa-xmark"></i> Limpar filtros
            </button>
            <span id="filtros_ativos_label" style="font-size:.78rem;color:var(--hist-text-muted);display:none;">
                <i class="fa-solid fa-circle" style="font-size:.45rem;color:#f59e0b;margin-right:3px;"></i>Filtros activos
            </span>
        </div>
    </div>

    {{-- TIMELINE --}}
    <div class="hist-timeline-container">
        <div class="hist-timeline-header">
            <strong>Todos os Eventos <span id="labelCategoria"></span></strong>
            <span id="labelTotal">A carregar...</span>
        </div>
        <ul class="hist-lista" id="histLista">
            @for($i=0;$i<5;$i++)
            <li class="hist-skeleton-item">
                <div class="hist-skel-icone"><div class="hist-skel-circle"></div></div>
                <div class="hist-skel-corpo">
                    <div class="hist-skel-linha" style="width:{{ rand(28,55) }}%"></div>
                    <div class="hist-skel-linha" style="width:{{ rand(50,82) }}%"></div>
                    <div class="hist-skel-linha" style="width:{{ rand(18,38) }}%"></div>
                </div>
                <div class="hist-skel-data">
                    <div class="hist-skel-linha" style="width:88px;height:10px;"></div>
                    <div class="hist-skel-linha" style="width:66px;height:10px;"></div>
                </div>
            </li>
            @endfor
        </ul>
        <div class="hist-paginacao" id="histPaginacao" style="display:none;">
            <span class="hist-paginacao-info" id="paginacaoInfo"></span>
            <div class="hist-paginacao-btns" id="paginacaoBtns"></div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
const HIST_API = "{{ route('api_listar_historico_atividade') }}";
const CSRF     = "{{ csrf_token() }}";
const STOR_KEY = 'hist_vistos_{{ session("id_utilizador", "guest") }}';

let estado = {
    pagina:1, por_pagina:20,
    pesquisar:'', categoria:'todos',
    data_inicio:'', data_fim:'',
    carregando:false,
};

let vistos = new Set(JSON.parse(localStorage.getItem(STOR_KEY) || '[]'));

// Mapas — inclui mensagem e sessao
const CORES  = {
    registro:'#3b82f6', consulta:'#8b5cf6',
    atualizacao:'#f59e0b', pagamento:'#10b981',
    mensagem:'#ec4899', sessao:'#06b6d4',
    sessao_falhada:'#ef4444', logout:'#64748b',
    backup:'#0066cc'
};
const LABELS = {
    registro:'Registo', consulta:'Consulta',
    atualizacao:'Atualização', pagamento:'Pagamento',
    mensagem:'Mensagem', sessao:'Sessão',
    sessao_falhada:'Sessão Falhada', logout:'Sessão Terminada',
    backup:'Backup'
};
const ICONES = {
    registro:'fa-solid fa-user-plus', consulta:'fa-solid fa-stethoscope',
    atualizacao:'fa-solid fa-pen-to-square', pagamento:'fa-solid fa-credit-card',
    mensagem:'fa-solid fa-comments', sessao:'fa-solid fa-right-to-bracket',
    sessao_falhada:'fa-solid fa-triangle-exclamation', logout:'fa-solid fa-right-from-bracket',
    backup:'fa-solid fa-database'
};
const TIPOS = { admi:'Admin', recepcionista:'Recepcionista', medico:'Médico', paciente:'Paciente' };

// ── NOTIFICAÇÕES ────────────────────────────────────────────
let dadosRecentes = [];

async function carregarNotificacoes() {
    try {
        // Busca apenas os 5 eventos mais recentes (sliding window)
        const params = new URLSearchParams({ pagina:1, por_pagina:5 });
        const resp   = await fetch(`${HIST_API}?${params}`, {
            headers:{ 'X-CSRF-TOKEN':CSRF, 'Accept':'application/json' }
        });
        if (!resp.ok) return;
        const dados = await resp.json();
        // Guarda apenas os 5 mais recentes — se chegar novo, o mais antigo sai
        dadosRecentes = (dados.data || []).slice(0, 5);
        renderizarNotificacoes();
    } catch(e) { console.warn('Notificações:', e); }
}

function renderizarNotificacoes() {
    const lista = document.getElementById('notifLista');
    if (!dadosRecentes.length) {
        lista.innerHTML = `<div class="hist-notif-vazio"><i class="fa-regular fa-bell-slash"></i><span>Sem eventos recentes.</span></div>`;
        atualizarBadge();
        return;
    }
    lista.innerHTML = '';
    dadosRecentes.forEach(item => {
        const cor    = CORES[item.categoria]  || '#6b7280';
        const icone  = item.icone             || ICONES[item.categoria] || 'fa-solid fa-circle-info';
        const label  = LABELS[item.categoria] || item.categoria;
        const jVisto = vistos.has(String(item.id_historico));
        const li     = document.createElement('div');
        li.className  = 'hist-notif-item' + (jVisto ? ' visto' : '');
        li.dataset.id = item.id_historico;
        li.style.setProperty('--notif-cor', cor);
        li.innerHTML  = `
            <div class="hist-notif-barra"><i class="${icone}"></i></div>
            <div class="hist-notif-corpo">
                <span class="hist-notif-cat"><i class="${icone} fa-xs"></i>${escH(label)}</span>
                <span class="hist-notif-desc" title="${escH(formatarDescricao(item.descricao||item.acao))}">${escH(formatarDescricao(item.descricao||item.acao))}</span>
                <span class="hist-notif-tempo"><i class="fa-regular fa-clock fa-xs" style="margin-right:3px;"></i>${escH(item.criado_em_relativo)} &bull; ${escH(item.nome_util||'Sistema')}</span>
            </div>
            <div class="hist-notif-acao-col">
                <button class="hist-btn-visto" onclick="marcarVisto(${item.id_historico},this)" ${jVisto?'disabled':''}>
                    ${jVisto ? '<i class="fa-solid fa-check"></i>' : '<i class="fa-solid fa-eye"></i> Visto'}
                </button>
            </div>`;
        lista.appendChild(li);
    });
    atualizarBadge();
}

function marcarVisto(id, btnEl) {
    vistos.add(String(id));
    salvarVistos();
    const item = btnEl.closest('.hist-notif-item');
    if (item) {
        item.classList.add('visto');
        btnEl.innerHTML = '<i class="fa-solid fa-check"></i>';
        btnEl.disabled  = true;
    }
    atualizarBadge(true);
}

function marcarTodosVisto() {
    dadosRecentes.forEach(item => vistos.add(String(item.id_historico)));
    salvarVistos();
    document.querySelectorAll('.hist-notif-item:not(.visto)').forEach(el => {
        el.classList.add('visto');
        const btn = el.querySelector('.hist-btn-visto');
        if (btn) { btn.innerHTML = '<i class="fa-solid fa-check"></i>'; btn.disabled = true; }
    });
    atualizarBadge(true);
}

function atualizarBadge(pulsar=false) {
    const badge     = document.getElementById('notifBadge');
    const naoVistos = dadosRecentes.filter(i => !vistos.has(String(i.id_historico))).length;
    badge.textContent = naoVistos;
    badge.className   = 'hist-notif-badge' + (naoVistos === 0 ? ' zero' : '');
    if (pulsar) {
        badge.classList.add('pulsar');
        setTimeout(() => badge.classList.remove('pulsar'), 650);
    }
}

function salvarVistos() {
    localStorage.setItem(STOR_KEY, JSON.stringify([...vistos]));
}

let notifAberto = true;
document.getElementById('btnToggleNotif').addEventListener('click', () => {
    const col  = document.getElementById('notifCollapsible');
    const icon = document.getElementById('iconToggleNotif');
    notifAberto = !notifAberto;
    if (notifAberto) {
        col.style.maxHeight = col.scrollHeight + 'px';
        col.classList.remove('fechado');
        icon.className = 'fa-solid fa-chevron-up';
    } else {
        col.style.maxHeight = col.scrollHeight + 'px';
        requestAnimationFrame(() => { col.classList.add('fechado'); });
        icon.className = 'fa-solid fa-chevron-down';
    }
});
document.getElementById('btnMarcarTodosVisto').addEventListener('click', marcarTodosVisto);

// ── TIMELINE ─────────────────────────────────────────────────
async function carregarHistorico() {
    if (estado.carregando) return;
    estado.carregando = true;
    document.getElementById('spinnerFiltrar').style.display = 'inline-block';
    document.getElementById('iconFiltrar').style.display    = 'none';

    const params = new URLSearchParams({
        pagina:estado.pagina, por_pagina:estado.por_pagina,
        pesquisar:estado.pesquisar, categoria:estado.categoria,
        data_inicio:estado.data_inicio, data_fim:estado.data_fim,
    });
    try {
        const resp  = await fetch(`${HIST_API}?${params}`, {
            headers:{ 'X-CSRF-TOKEN':CSRF, 'Accept':'application/json' }
        });
        if (!resp.ok) throw new Error('HTTP ' + resp.status);
        const dados = await resp.json();
        renderizarLista(dados);
        renderizarPaginacao(dados);
        atualizarLabel(dados.total);
    } catch(err) {
        renderizarErro(err.message);
    } finally {
        estado.carregando = false;
        document.getElementById('spinnerFiltrar').style.display = 'none';
        document.getElementById('iconFiltrar').style.display    = 'inline';
    }
}

function renderizarLista(dados) {
    const lista = document.getElementById('histLista');
    lista.innerHTML = '';
    if (!dados.data?.length) {
        lista.innerHTML = `<li><div class="hist-vazio"><i class="fa-regular fa-folder-open"></i><p>Nenhum registo encontrado com os filtros selecionados.</p></div></li>`;
        return;
    }
    dados.data.forEach(item => {
        const cor      = CORES[item.categoria]  || '#6b7280';
        const icone    = item.icone             || ICONES[item.categoria] || 'fa-solid fa-circle-info';
        const label    = LABELS[item.categoria] || item.categoria;
        const tipoUtil = TIPOS[item.tipo_util]  || item.tipo_util || 'Sistema';

        const camposHTML = (item.campos_alterados?.length)
            ? `<div class="hist-campos-alterados">${item.campos_alterados.map(c =>
                `<span class="hist-campo-tag"><i class="fa-solid fa-pen fa-xs" style="margin-right:2px;"></i>${escH(c)}</span>`).join('')}</div>`
            : '';

        const entidadeHTML = item.nome_entidade
            ? `<span><i class="fa-solid fa-tag fa-xs"></i> ${escH(item.nome_entidade)}</span>` : '';

        lista.innerHTML += `
        <li class="hist-item">
            <div class="hist-item-icone-col">
                <div class="hist-icone-badge" style="background:${cor}"><i class="${icone}"></i></div>
            </div>
            <div class="hist-item-corpo">
                <div class="hist-item-topo">
                    <span class="hist-badge-categoria" style="background:${cor}">${label}</span>
                    <span class="hist-item-usuario">${escH(item.nome_util)}</span>
                    <span class="hist-item-tipo-util">${tipoUtil}</span>
                </div>
                <p class="hist-item-descricao">${escH(formatarDescricao(item.descricao||item.acao))}</p>
                ${camposHTML}
                <div class="hist-item-meta">
                    ${entidadeHTML}
                    ${item.ip ? `<span><i class="fa-solid fa-globe fa-xs"></i> ${escH(item.ip)}</span>` : ''}
                </div>
            </div>
            <div class="hist-item-data-col">
                <span class="hist-item-data-hora"><i class="fa-regular fa-clock fa-xs" style="margin-right:2px;"></i>${escH(item.criado_em)}</span>
                <span class="hist-item-data-relativa">${escH(item.criado_em_relativo)}</span>
            </div>
        </li>`;
    });
}

function renderizarPaginacao(dados) {
    const pag  = document.getElementById('histPaginacao');
    const info = document.getElementById('paginacaoInfo');
    const btns = document.getElementById('paginacaoBtns');
    pag.style.display = 'flex';
    const ini = ((dados.pagina_atual-1)*dados.por_pagina)+1;
    const fim = Math.min(dados.pagina_atual*dados.por_pagina, dados.total);
    info.textContent = `A mostrar ${ini}–${fim} de ${dados.total} registos`;
    btns.innerHTML = '';
    btns.appendChild(criarBtnPag('‹', dados.pagina_atual>1, function(){ estado.pagina--; carregarHistorico(); }));
    let pi=Math.max(1,dados.pagina_atual-2), pf=Math.min(dados.ultima_pagina,pi+4);
    pi=Math.max(1,pf-4);
    for(let p=pi;p<=pf;p++){
        // IIFE captura o valor correcto de p em cada iteração
        (function(pNum){
            const b=criarBtnPag(pNum, true, function(){ estado.pagina=pNum; carregarHistorico(); });
            if(pNum===dados.pagina_atual) b.classList.add('ativo');
            btns.appendChild(b);
        })(p);
    }
    btns.appendChild(criarBtnPag('›', dados.pagina_atual<dados.ultima_pagina, function(){ estado.pagina++; carregarHistorico(); }));
}

function criarBtnPag(txt,ok,fn) {
    const b=document.createElement('button');
    b.className='hist-pag-btn'; b.textContent=txt; b.disabled=!ok;
    if(ok) b.addEventListener('click',fn);
    return b;
}

function atualizarLabel(total) {
    const cat=estado.categoria;
    document.getElementById('labelCategoria').textContent = cat!=='todos' ? '— '+(LABELS[cat]||cat) : '';
    document.getElementById('labelTotal').textContent = total+(total===1?' registo':' registos');
}

function renderizarErro(msg) {
    document.getElementById('histLista').innerHTML=`<li><div class="hist-vazio"><i class="fa-solid fa-triangle-exclamation" style="color:#ef4444;opacity:1;"></i><p style="color:#ef4444;">Erro: ${escH(msg)}</p><button class="hist-btn hist-btn-outline" style="margin-top:12px;" onclick="carregarHistorico()"><i class="fa-solid fa-rotate-right"></i> Tentar novamente</button></div></li>`;
}

function aplicarFiltros() {
    estado.pagina      = 1;
    estado.pesquisar   = document.getElementById('filtro_pesquisar').value.trim();
    estado.categoria   = document.getElementById('filtro_categoria').value;
    estado.data_inicio = document.getElementById('filtro_data_inicio').value;
    estado.data_fim    = document.getElementById('filtro_data_fim').value;
    document.querySelectorAll('.hist-resumo-card').forEach(c=>c.classList.remove('ativo'));
    if (estado.categoria!=='todos') {
        document.querySelector(`[data-categoria="${estado.categoria}"]`)?.classList.add('ativo');
    }
    const ha = estado.pesquisar||estado.categoria!=='todos'||estado.data_inicio||estado.data_fim;
    document.getElementById('filtros_ativos_label').style.display = ha ? 'inline' : 'none';
    carregarHistorico();
}

function limparFiltros() {
    ['filtro_pesquisar','filtro_data_inicio','filtro_data_fim'].forEach(id=>document.getElementById(id).value='');
    document.getElementById('filtro_categoria').value='todos';
    Object.assign(estado,{pagina:1,pesquisar:'',categoria:'todos',data_inicio:'',data_fim:''});
    document.querySelectorAll('.hist-resumo-card').forEach(c=>c.classList.remove('ativo'));
    document.getElementById('filtros_ativos_label').style.display='none';
    carregarHistorico();
}

function filtrarPorCategoria(cat) {
    document.getElementById('filtro_categoria').value=cat;
    aplicarFiltros();
}

document.getElementById('btnExportarCSV').addEventListener('click', async()=>{
    const p=new URLSearchParams({pagina:1,por_pagina:9999,pesquisar:estado.pesquisar,categoria:estado.categoria,data_inicio:estado.data_inicio,data_fim:estado.data_fim});
    const resp=await fetch(`${HIST_API}?${p}`);
    const dados=await resp.json();
    if(!dados.data?.length){alert('Sem registos para exportar.');return;}
    const cab=['ID','Utilizador','Tipo','Categoria','Ação','Descrição','Entidade','ID Entidade','IP','Data'];
    const linhas=dados.data.map(r=>[r.id_historico,r.nome_util,r.tipo_util,r.categoria,r.acao,(r.descricao||'').replace(/,/g,' '),r.entidade||'',r.id_entidade||'',r.ip||'',r.criado_em].join(','));
    const csv=[cab.join(','),...linhas].join('\n');
    const a=document.createElement('a');
    a.href=URL.createObjectURL(new Blob(['\uFEFF'+csv],{type:'text/csv;charset=utf-8;'}));
    a.download='historico_'+new Date().toISOString().slice(0,10)+'.csv';
    a.click();
});

document.getElementById('filtro_pesquisar').addEventListener('keydown',e=>{if(e.key==='Enter')aplicarFiltros();});

// Substitui #45 por Nº 45 em descrições
function formatarDescricao(s) {
    if (s == null) return '';
    return String(s).replace(/#(\d+)/g, 'Nº $1');
}

function escH(s){
    if(s==null)return'';
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
}

document.addEventListener('DOMContentLoaded',()=>{
    document.getElementById('notifCollapsible').style.maxHeight='9999px';
    carregarNotificacoes();
    carregarHistorico();
    setInterval(carregarNotificacoes, 60_000);
});
</script>
@endsection