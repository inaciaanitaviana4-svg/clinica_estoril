@extends('layouts.admin')

@section('titulo', 'Backup do Sistema')

@section('estilo')
<style>
/* ─── Variáveis ──────────────────────────────────────────── */
:root {
    --bk-blue:    #0066cc;
    --bk-green:   #10b981;
    --bk-amber:   #f59e0b;
    --bk-red:     #ef4444;
    --bk-purple:  #8b5cf6;
    --bk-surface: #ffffff;
    --bk-muted:   #f8fafc;
    --bk-border:  #e2e8f0;
    --bk-text:    #1e293b;
    --bk-sub:     #64748b;
    --bk-shadow:  0 4px 24px rgba(0,0,0,.07);
    --bk-radius:  16px;
}
.dark-mode {
    --bk-surface: #1e293b;
    --bk-muted:   #0f172a;
    --bk-border:  #334155;
    --bk-text:    #f1f5f9;
    --bk-sub:     #94a3b8;
    --bk-shadow:  0 4px 24px rgba(0,0,0,.35);
}

/* ─── Layout ─────────────────────────────────────────────── */
.bk-wrap        { max-width: 1100px; margin: 0 auto; padding: 0 8px; }

/* ─── Hero Card ──────────────────────────────────────────── */
.bk-hero {
    background: linear-gradient(135deg, #0066cc 0%, #004fa3 60%, #003d80 100%);
    border-radius: var(--bk-radius);
    padding: 40px 40px 32px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 28px;
    position: relative;
    overflow: hidden;
}
.bk-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.bk-hero-title  { font-size: 28px; font-weight: 700; margin: 0 0 6px; }
.bk-hero-sub    { font-size: 14px; opacity: .8; margin: 0; }
.bk-hero-badge  {
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.25);
    backdrop-filter: blur(8px);
    border-radius: 50px;
    padding: 8px 18px;
    font-size: 13px;
    font-weight: 600;
    white-space: nowrap;
}
.bk-hero-badge i { margin-right: 6px; }

/* ─── Stat Cards ─────────────────────────────────────────── */
.bk-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 28px;
}
.bk-stat {
    background: var(--bk-surface);
    border: 1px solid var(--bk-border);
    border-radius: var(--bk-radius);
    padding: 20px 22px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: var(--bk-shadow);
    transition: transform .2s, box-shadow .2s;
}
.bk-stat:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(0,0,0,.1); }
.bk-stat-icon {
    width: 48px; height: 48px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; flex-shrink: 0;
}
.bk-stat-label { font-size: 12px; color: var(--bk-sub); margin: 0 0 4px; text-transform: uppercase; letter-spacing: .5px; }
.bk-stat-value { font-size: 22px; font-weight: 700; color: var(--bk-text); margin: 0; }

/* ─── Download Cards ─────────────────────────────────────── */
.bk-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
}
.bk-card {
    background: var(--bk-surface);
    border: 1px solid var(--bk-border);
    border-radius: var(--bk-radius);
    padding: 28px;
    box-shadow: var(--bk-shadow);
    display: flex;
    flex-direction: column;
    gap: 16px;
    transition: transform .2s, box-shadow .2s;
    position: relative;
    overflow: hidden;
}
.bk-card:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(0,0,0,.12); }
.bk-card-stripe {
    position: absolute; top: 0; left: 0; right: 0; height: 4px;
}
.bk-card-header { display: flex; align-items: center; gap: 14px; }
.bk-card-icon {
    width: 52px; height: 52px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; flex-shrink: 0;
}
.bk-card-title  { font-size: 17px; font-weight: 700; color: var(--bk-text); margin: 0 0 3px; }
.bk-card-sub    { font-size: 13px; color: var(--bk-sub); margin: 0; }
.bk-card-body   { font-size: 13px; color: var(--bk-sub); line-height: 1.7; }
.bk-card-body li { display: flex; align-items: center; gap: 8px; margin-bottom: 4px; list-style: none; padding: 0; }
.bk-card-body li i { font-size: 11px; }

/* ─── Botões de download ─────────────────────────────────── */
.bk-btn {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    padding: 13px 24px; border: none; border-radius: 10px;
    font-size: 14px; font-weight: 600; cursor: pointer;
    text-decoration: none; transition: all .2s; position: relative; overflow: hidden;
    letter-spacing: .3px;
}
.bk-btn:hover { transform: translateY(-1px); filter: brightness(1.05); }
.bk-btn:active { transform: translateY(0); }
.bk-btn-blue    { background: var(--bk-blue);   color: #fff; }
.bk-btn-green   { background: var(--bk-green);  color: #fff; }
.bk-btn-amber   { background: var(--bk-amber);  color: #fff; }

/* Loading spinner dentro do botão */
.bk-btn .spinner {
    width: 16px; height: 16px; border: 2px solid rgba(255,255,255,.4);
    border-top-color: #fff; border-radius: 50%;
    animation: spin .7s linear infinite; display: none;
}
.bk-btn.loading .spinner { display: block; }
.bk-btn.loading .btn-label { display: none; }
.bk-btn.loading { pointer-events: none; opacity: .85; }

@keyframes spin { to { transform: rotate(360deg); } }

/* ─── Progress bar ───────────────────────────────────────── */
.bk-progress-wrap {
    background: var(--bk-muted); border: 1px solid var(--bk-border);
    border-radius: 12px; padding: 20px 24px;
    display: none; margin-bottom: 20px;
}
.bk-progress-wrap.visible { display: block; }
.bk-progress-label  { font-size: 13px; font-weight: 600; color: var(--bk-text); margin-bottom: 10px; display: flex; justify-content: space-between; }
.bk-progress-bar    { height: 8px; background: var(--bk-border); border-radius: 99px; overflow: hidden; }
.bk-progress-fill   { height: 100%; border-radius: 99px; background: linear-gradient(90deg, var(--bk-blue), #00aaff); width: 0; transition: width .4s; }

/* ─── Tabela de tabelas ──────────────────────────────────── */
.bk-table-wrap {
    background: var(--bk-surface);
    border: 1px solid var(--bk-border);
    border-radius: var(--bk-radius);
    box-shadow: var(--bk-shadow);
    overflow: hidden;
}
.bk-table-header {
    padding: 20px 24px 12px;
    display: flex; align-items: center; justify-content: space-between;
    border-bottom: 1px solid var(--bk-border);
    flex-wrap: wrap; gap: 10px;
}
.bk-table-title { font-size: 16px; font-weight: 700; color: var(--bk-text); margin: 0; }
.bk-search-box {
    display: flex; align-items: center; gap: 8px;
    background: var(--bk-muted); border: 1px solid var(--bk-border);
    border-radius: 8px; padding: 6px 12px; font-size: 13px;
}
.bk-search-box input {
    background: transparent; border: none; outline: none;
    color: var(--bk-text); width: 160px; font-size: 13px;
}
.bk-table { width: 100%; border-collapse: collapse; }
.bk-table thead tr { background: var(--bk-muted); }
.bk-table th { padding: 10px 16px; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .5px; color: var(--bk-sub);
    text-align: left; border-bottom: 1px solid var(--bk-border); }
.bk-table td { padding: 11px 16px; font-size: 13px; color: var(--bk-text);
    border-bottom: 1px solid var(--bk-border); }
.bk-table tbody tr:last-child td { border-bottom: none; }
.bk-table tbody tr:hover { background: var(--bk-muted); }
.bk-badge-count {
    display: inline-block; padding: 2px 10px; border-radius: 99px;
    font-size: 12px; font-weight: 600;
}

/* ─── Toast ──────────────────────────────────────────────── */
.bk-toast {
    position: fixed; bottom: 28px; right: 28px; z-index: 9999;
    background: var(--bk-surface); border: 1px solid var(--bk-border);
    border-radius: 12px; padding: 16px 22px; box-shadow: 0 8px 32px rgba(0,0,0,.18);
    display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 500;
    transform: translateY(80px); opacity: 0; transition: all .35s cubic-bezier(.34,1.56,.64,1);
    max-width: 360px; color: var(--bk-text);
}
.bk-toast.show { transform: translateY(0); opacity: 1; }
.bk-toast-icon { font-size: 20px; flex-shrink: 0; }

/* ─── Último backup ──────────────────────────────────────── */
.bk-last {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.12); border-radius: 8px;
    padding: 6px 14px; font-size: 13px; margin-top: 10px;
}

/* ─── Responsive ─────────────────────────────────────────── */
@media (max-width: 640px) {
    .bk-hero   { padding: 28px 22px; }
    .bk-hero-title { font-size: 22px; }
    .bk-card   { padding: 22px 18px; }
}
</style>
@endsection

@section('conteudo')
<div class="bk-wrap">

    {{-- ── Hero ─────────────────────────────────────────────── --}}
    <div class="bk-hero">
        <div>
            <h1 class="bk-hero-title"><i class="fa-solid fa-database" style="margin-right:10px;"></i>Backup do Sistema</h1>
            <p class="bk-hero-sub">Faça o download seguro dos dados e do código-fonte da Clínica Estoril</p>
            @if($stats['ultimo_backup'])
            <div class="bk-last">
                <i class="fa-regular fa-clock"></i>
                Último backup: <strong>{{ $stats['ultimo_backup'] }}</strong>
            </div>
            @endif
        </div>
        <div class="bk-hero-badge">
            <i class="fa-solid fa-shield-halved"></i>
          BACKUP  {{ strtoupper($stats['ambiente']) }} 
        </div>
    </div>

    {{-- ── Estatísticas ─────────────────────────────────────── --}}
    <div class="bk-stats">
        <div class="bk-stat">
            <div class="bk-stat-icon" style="background:#eff6ff; color:#0066cc;"><i class="fa-solid fa-table-list"></i></div>
            <div>
                <p class="bk-stat-label">Tabelas</p>
                <p class="bk-stat-value">{{ $stats['total_tabelas'] }}</p>
            </div>
        </div>
        <div class="bk-stat">
            <div class="bk-stat-icon" style="background:#f0fdf4; color:#10b981;"><i class="fa-solid fa-layer-group"></i></div>
            <div>
                <p class="bk-stat-label">Registros</p>
                <p class="bk-stat-value">{{ number_format($stats['total_registros'], 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="bk-stat">
            <div class="bk-stat-icon" style="background:#fefce8; color:#f59e0b;"><i class="fa-solid fa-hard-drive"></i></div>
            <div>
                <p class="bk-stat-label">Tamanho DB</p>
                <p class="bk-stat-value">{{ $stats['tamanho_db_mb'] }} MB</p>
            </div>
        </div>
        <div class="bk-stat">
            <div class="bk-stat-icon" style="background:#fdf4ff; color:#8b5cf6;"><i class="fa-solid fa-images"></i></div>
            <div>
                <p class="bk-stat-label">Armazenamento</p>
                <p class="bk-stat-value">{{ $stats['tamanho_storage'] }} MB</p>
            </div>
        </div>
        <div class="bk-stat">
            <div class="bk-stat-icon" style="background:#fff1f2; color:#ef4444;"><i class="fa-brands fa-php"></i></div>
            <div>
                <p class="bk-stat-label">PHP</p>
                <p class="bk-stat-value">{{ $stats['versao_php'] }}</p>
            </div>
        </div>
    </div>

    {{-- ── Barra de progresso ───────────────────────────────── --}}
    <div class="bk-progress-wrap" id="progressWrap">
        <div class="bk-progress-label">
            <span id="progressMsg">A preparar backup…</span>
            <span id="progressPct">0%</span>
        </div>
        <div class="bk-progress-bar"><div class="bk-progress-fill" id="progressFill"></div></div>
    </div>

    {{-- ── Cards de download ────────────────────────────────── --}}
    <div class="bk-cards">

        {{-- Card SQL --}}
        <div class="bk-card">
            <div class="bk-card-stripe" style="background: linear-gradient(90deg, #10b981, #059669);"></div>
            <div class="bk-card-header">
                <div class="bk-card-icon" style="background:#f0fdf4; color:#10b981;">
                    <i class="fa-solid fa-file-code"></i>
                </div>
                <div>
                    <p class="bk-card-title">Banco de Dados SQL</p>
                    <p class="bk-card-sub">Exportação completa · .sql</p>
                </div>
            </div>
            <ul class="bk-card-body">
                <li><i class="fa-solid fa-check" style="color:#10b981;"></i> Estrutura de todas as tabelas</li>
                <li><i class="fa-solid fa-check" style="color:#10b981;"></i> Todos os registros e históricos</li>
                <li><i class="fa-solid fa-check" style="color:#10b981;"></i> Utilizadores, consultas, pagamentos</li>
                <li><i class="fa-solid fa-check" style="color:#10b981;"></i> Compatível com MySQL / MariaDB</li>
            </ul>
            <a href="{{ route('backup_banco_dados') }}"
               class="bk-btn bk-btn-green"
               id="btnSql"
               onclick="iniciarDownload(this, 'Exportando banco de dados…')">
                <div class="spinner"></div>
                <span class="btn-label"><i class="fa-solid fa-download"></i> &nbsp;Baixar Banco de Dados (.sql)</span>
            </a>
        </div>

        {{-- Card ZIP --}}
        @php
            $zip_disponivel = class_exists('ZipArchive');
            $phar_disponivel = class_exists('PharData');
            $metodo_label   = $zip_disponivel ? 'ZipArchive · .zip' : ($phar_disponivel ? 'PharData · .tar.gz' : 'SQL + README · .sql');
            $metodo_formato = $zip_disponivel ? '.zip' : ($phar_disponivel ? '.tar.gz' : '.sql');
            $metodo_cor     = $zip_disponivel ? '#10b981' : ($phar_disponivel ? '#f59e0b' : '#ef4444');
            $metodo_ico     = $zip_disponivel ? 'fa-circle-check' : ($phar_disponivel ? 'fa-circle-exclamation' : 'fa-circle-info');
        @endphp
        <div class="bk-card">
            <div class="bk-card-stripe" style="background: linear-gradient(90deg, #0066cc, #004fa3);"></div>
            <div class="bk-card-header">
                <div class="bk-card-icon" style="background:#eff6ff; color:#0066cc;">
                    <i class="fa-solid fa-file-zipper"></i>
                </div>
                <div>
                    <p class="bk-card-title">Sistema Completo</p>
                    <p class="bk-card-sub">Código-fonte + Banco de Dados · {{ $metodo_formato }}</p>
                </div>
            </div>
            <ul class="bk-card-body">
                <li><i class="fa-solid fa-check" style="color:#0066cc;"></i> Todo o código-fonte Laravel</li>
                <li><i class="fa-solid fa-check" style="color:#0066cc;"></i> Dump SQL incluído no arquivo</li>
                <li><i class="fa-solid fa-check" style="color:#0066cc;"></i> Ficheiros de configuração (.env.example)</li>
                <li><i class="fa-solid fa-check" style="color:#0066cc;"></i> Guia de restauração (README)</li>
                <li>
                    <i class="fa-solid {{ $metodo_ico }}" style="color:{{ $metodo_cor }};"></i>
                    <span style="color:{{ $metodo_cor }}; font-weight:600;">Método: {{ $metodo_label }}</span>
                </li>
                <li><i class="fa-solid fa-warning" style="color:#f59e0b;"></i> Pode demorar alguns minutos</li>
            </ul>
            <a href="{{ route('backup_sistema_completo') }}"
               class="bk-btn bk-btn-blue"
               id="btnZip"
               onclick="iniciarDownload(this, 'A compactar o sistema… aguarde.')">
                <div class="spinner"></div>
                <span class="btn-label">
                    <i class="fa-solid fa-download"></i>
                    &nbsp;Baixar Sistema Completo ({{ $metodo_formato }})
                </span>
            </a>
        </div>

    </div>

    {{-- ── Tabela de tabelas ────────────────────────────────── --}}
    <div class="bk-table-wrap">
        <div class="bk-table-header">
            <p class="bk-table-title"><i class="fa-solid fa-database" style="margin-right:8px; color:#0066cc;"></i>Tabelas do Banco de Dados</p>
            <div class="bk-search-box">
                <i class="fa-solid fa-magnifying-glass" style="color:#94a3b8; font-size:12px;"></i>
                <input type="text" id="searchTabela" placeholder="Filtrar tabela…" oninput="filtrarTabelas(this.value)">
            </div>
        </div>
        <div style="overflow-x:auto;">
            <table class="bk-table" id="tabelaDb">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tabela</th>
                        <th>Registros</th>
                        <th>Volume</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['tabelas'] as $i => $t)
                    <tr>
                        <td style="color: var(--bk-sub); font-size:12px;">{{ $i + 1 }}</td>
                        <td style="font-weight:600; font-family: monospace; font-size:13px;">
                            <i class="fa-solid fa-table" style="color:#0066cc; margin-right:6px; font-size:11px;"></i>
                            {{ $t['tabela'] }}
                        </td>
                        <td>
                            @php
                                $cor = $t['registros'] == 0 ? '#94a3b8' : ($t['registros'] > 100 ? '#10b981' : '#0066cc');
                                $bg  = $t['registros'] == 0 ? '#f1f5f9' : ($t['registros'] > 100 ? '#f0fdf4' : '#eff6ff');
                            @endphp
                            <span class="bk-badge-count" style="background:{{$bg}}; color:{{$cor}};">
                                {{ number_format($t['registros'], 0, ',', '.') }}
                            </span>
                        </td>
                        <td>
                            @php
                                $pct = $stats['total_registros'] > 0
                                    ? round(($t['registros'] / $stats['total_registros']) * 100, 1)
                                    : 0;
                            @endphp
                            <div style="display:flex; align-items:center; gap:8px;">
                                <div style="flex:1; height:5px; background:var(--bk-border); border-radius:99px; overflow:hidden;">
                                    <div style="width:{{$pct}}%; height:100%; background:#0066cc; border-radius:99px;"></div>
                                </div>
                                <span style="font-size:11px; color:var(--bk-sub); width:35px; text-align:right;">{{$pct}}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

    {{-- ── Backups Guardados ──────────────────────────────── --}}
    @if(count($backups) > 0)
    <div class="bk-table-wrap" style="margin-top:28px;">
        <div class="bk-table-header">
            <p class="bk-table-title">
                <i class="fa-solid fa-folder-open" style="margin-right:8px; color:#0066cc;"></i>
                Backups Guardados
                <span style="font-size:12px; font-weight:500; color:var(--bk-sub); margin-left:8px;">
                    em <code style="font-size:11px;">storage/app/backups/</code>
                </span>
            </p>
            <span style="font-size:12px; color:var(--bk-sub);">{{ count($backups) }} ficheiro(s)</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="bk-table">
                <thead>
                    <tr>
                        <th>Ficheiro</th>
                        <th>Tipo</th>
                        <th>Tamanho</th>
                        <th>Data</th>
                        <th style="text-align:right;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($backups as $bk)
                    <tr>
                        <td style="font-family:monospace; font-size:12px; max-width:300px; word-break:break-all;">
                            <i class="fa-solid {{ $bk['icone'] }}" style="color:{{ $bk['cor'] }}; margin-right:6px;"></i>
                            {{ $bk['nome'] }}
                        </td>
                        <td>
                            <span class="bk-badge-count" style="background:{{ $bk['cor'] }}18; color:{{ $bk['cor'] }};">
                                {{ $bk['tipo'] }}
                            </span>
                        </td>
                        <td style="font-size:13px;">{{ $bk['tamanho'] }}</td>
                        <td style="font-size:13px; color:var(--bk-sub);">{{ $bk['data'] }}</td>
                        <td style="text-align:right;">
                            <div style="display:flex; gap:8px; justify-content:flex-end;">
                                <a href="{{ route('backup_download_guardado', $bk['nome']) }}"
                                   class="bk-btn bk-btn-green"
                                   style="padding:7px 14px; font-size:12px; border-radius:8px;"
                                   title="Baixar novamente">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                                <button onclick="apagarBackup('{{ $bk['nome'] }}', this)"
                                        class="bk-btn"
                                        style="padding:7px 14px; font-size:12px; border-radius:8px; background:#fee2e2; color:#ef4444;"
                                        title="Apagar backup">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div style="text-align:center; padding:32px; background:var(--bk-surface); border:1px dashed var(--bk-border); border-radius:var(--bk-radius); margin-top:28px; color:var(--bk-sub);">
        <i class="fa-solid fa-folder-open" style="font-size:32px; margin-bottom:12px; display:block; opacity:.4;"></i>
        <p style="margin:0; font-size:14px;">Nenhum backup guardado ainda.<br>Os backups serão listados aqui após o primeiro download.</p>
    </div>
    @endif

</div>

{{-- Toast --}}
<div class="bk-toast" id="bkToast">
    <span class="bk-toast-icon" id="bkToastIcon">⏳</span>
    <span id="bkToastMsg">A preparar download…</span>
</div>
@endsection

@section('script')
<script>
// ── Download com feedback ───────────────────────────────────
function iniciarDownload(btn, mensagem) {
    btn.classList.add('loading');

    // Progress bar
    const wrap  = document.getElementById('progressWrap');
    const fill  = document.getElementById('progressFill');
    const msg   = document.getElementById('progressMsg');
    const pct   = document.getElementById('progressPct');

    wrap.classList.add('visible');
    msg.textContent = mensagem;

    // Toast
    mostrarToast('⏳', mensagem);

    // Animação de progresso simulada (o download real é via <a>)
    let progresso = 0;
    const passos = [
        { ate: 30,  vel: 80,  msg: 'A recolher dados do sistema…' },
        { ate: 60,  vel: 120, msg: 'A gerar exportação…' },
        { ate: 85,  vel: 200, msg: 'A finalizar arquivo…' },
        { ate: 97,  vel: 300, msg: 'A preparar download…' },
    ];
    let passoAtual = 0;

    const intervalo = setInterval(function () {
        if (passoAtual < passos.length) {
            const p = passos[passoAtual];
            if (progresso < p.ate) {
                progresso += 1;
            } else {
                passoAtual++;
                if (passoAtual < passos.length) {
                    msg.textContent = passos[passoAtual].msg;
                }
            }
        }
        fill.style.width = progresso + '%';
        pct.textContent  = progresso + '%';
    }, 60);

    // Após 12s, considera terminado
    setTimeout(function () {
        clearInterval(intervalo);
        progresso = 100;
        fill.style.width = '100%';
        pct.textContent  = '100%';
        msg.textContent  = 'Download concluído!';
        btn.classList.remove('loading');
        mostrarToast('✅', 'Download iniciado com sucesso!');

        setTimeout(function () {
            wrap.classList.remove('visible');
            fill.style.width = '0';
        }, 3500);
    }, 12000);
}

// ── Toast ───────────────────────────────────────────────────
function mostrarToast(icon, mensagem) {
    const toast = document.getElementById('bkToast');
    document.getElementById('bkToastIcon').textContent = icon;
    document.getElementById('bkToastMsg').textContent  = mensagem;
    toast.classList.add('show');
    clearTimeout(window._toastTimer);
    window._toastTimer = setTimeout(function () {
        toast.classList.remove('show');
    }, 5000);
}

// ── Apagar backup guardado ─────────────────────────────────
async function apagarBackup(nome, btn) {
    if (! confirm('Apagar o backup "' + nome + '"? Esta ação não pode ser desfeita.')) return;

    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

    try {
        const resp = await fetch('/admin/backup/apagar/' + encodeURIComponent(nome), {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]') ? document.querySelector('meta[name=csrf-token]').content : '' }
        });
        const data = await resp.json();
        if (data.ok) {
            const linha = btn.closest('tr');
            linha.style.transition = 'opacity .3s';
            linha.style.opacity = '0';
            setTimeout(() => linha.remove(), 320);
            mostrarToast('🗑️', 'Backup apagado com sucesso.');
        } else {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-trash"></i>';
            mostrarToast('❌', 'Erro ao apagar backup.');
        }
    } catch(e) {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-trash"></i>';
        mostrarToast('❌', 'Erro de comunicação.');
    }
}

// ── Filtro de tabelas ───────────────────────────────────────
function filtrarTabelas(q) {
    const linhas = document.querySelectorAll('#tabelaDb tbody tr');
    q = q.toLowerCase();
    linhas.forEach(function (tr) {
        const nome = tr.cells[1].textContent.toLowerCase();
        tr.style.display = nome.includes(q) ? '' : 'none';
    });
}
</script>
@endsection