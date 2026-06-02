@extends('layouts.painel')

@section('titulo', 'Mensagens')

@section('estilo')
<style>
:root {
    --msg-blue:    #0066cc;
    --msg-blue-lt: #eff6ff;
    --msg-green:   #10b981;
    --msg-surface: #ffffff;
    --msg-muted:   #f8fafc;
    --msg-border:  #e2e8f0;
    --msg-text:    #1e293b;
    --msg-sub:     #64748b;
    --msg-radius:  16px;
    --sidebar-w:   320px;
}
.dark-mode {
    --msg-surface: #1e293b;
    --msg-muted:   #0f172a;
    --msg-border:  #334155;
    --msg-text:    #f1f5f9;
    --msg-sub:     #94a3b8;
    --msg-blue-lt: #1e3a5f;
}

/* ── Avatar com foto ou fallback ─────────────────────────── */
.av {
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
    display: block;
}
.av-fallback {
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
}
.av-fallback.azul  { background: linear-gradient(135deg, #0066cc, #004fa3); }
.av-fallback.verde { background: linear-gradient(135deg, #10b981, #059669); }

/* ── Layout ──────────────────────────────────────────────── */
.msg-wrap { display:flex; height:calc(100vh - 70px); overflow:hidden; background:var(--msg-muted); }
.msg-sidebar { width:var(--sidebar-w); flex-shrink:0; background:var(--msg-surface); border-right:1px solid var(--msg-border); display:flex; flex-direction:column; overflow:hidden; }
.msg-sidebar-head { padding:20px 20px 12px; border-bottom:1px solid var(--msg-border); }
.msg-sidebar-title { font-size:17px; font-weight:700; color:var(--msg-text); display:flex; align-items:center; gap:10px; margin:0 0 12px; }
.msg-sidebar-title .badge-total { background:var(--msg-blue); color:#fff; font-size:11px; font-weight:700; padding:2px 8px; border-radius:99px; }
.msg-search { display:flex; align-items:center; gap:8px; background:var(--msg-muted); border:1px solid var(--msg-border); border-radius:10px; padding:8px 12px; }
.msg-search input { background:transparent; border:none; outline:none; color:var(--msg-text); font-size:13px; width:100%; }
.msg-list { flex:1; overflow-y:auto; padding:8px; }
.msg-list::-webkit-scrollbar { width:4px; }
.msg-list::-webkit-scrollbar-thumb { background:var(--msg-border); border-radius:99px; }
.msg-item { display:flex; flex-direction:column; gap:4px; padding:12px 14px; border-radius:12px; cursor:pointer; text-decoration:none; transition:background .15s; border:1px solid transparent; margin-bottom:4px; }
.msg-item:hover { background:var(--msg-muted); }
.msg-item.active { background:var(--msg-blue-lt); border-color:#bfdbfe; }
.msg-item-top { display:flex; align-items:center; gap:10px; }
.msg-item-info { flex:1; min-width:0; }
.msg-item-nome { font-size:13px; font-weight:600; color:var(--msg-text); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.msg-item-esp  { font-size:11px; color:var(--msg-sub); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.msg-item-badge { background:var(--msg-blue); color:#fff; font-size:10px; font-weight:700; min-width:18px; height:18px; border-radius:99px; display:flex; align-items:center; justify-content:center; padding:0 5px; flex-shrink:0; }
.msg-item-data { font-size:11px; color:var(--msg-sub); display:flex; align-items:center; gap:6px; padding-left:2px; }
.msg-item-consulta-tag { font-size:10px; background:var(--msg-muted); border:1px solid var(--msg-border); color:var(--msg-sub); border-radius:6px; padding:2px 7px; }
.msg-empty-sidebar { padding:40px 20px; text-align:center; color:var(--msg-sub); font-size:13px; }
.msg-empty-sidebar i { font-size:36px; margin-bottom:12px; display:block; opacity:.3; }
.msg-main { flex:1; display:flex; flex-direction:column; overflow:hidden; }
.msg-chat-header { background:var(--msg-surface); border-bottom:1px solid var(--msg-border); padding:14px 24px; display:flex; align-items:center; gap:14px; flex-shrink:0; }
.msg-chat-header-info { flex:1; min-width:0; }
.msg-chat-nome { font-size:15px; font-weight:700; color:var(--msg-text); margin:0 0 2px; }
.msg-chat-sub  { font-size:12px; color:var(--msg-sub); margin:0; }
.msg-prontuario { background:var(--msg-surface); border-bottom:1px solid var(--msg-border); padding:8px 24px; display:flex; align-items:center; gap:20px; flex-wrap:wrap; flex-shrink:0; }
.msg-prontuario-item { display:flex; align-items:center; gap:6px; font-size:12px; color:var(--msg-sub); }
.msg-prontuario-item strong { color:var(--msg-text); }
.msg-prontuario-item i { color:var(--msg-blue); font-size:11px; }
.msg-bubbles { flex:1; overflow-y:auto; padding:20px 24px; display:flex; flex-direction:column; gap:10px; background:var(--msg-muted); }
.msg-bubbles::-webkit-scrollbar { width:4px; }
.msg-bubbles::-webkit-scrollbar-thumb { background:var(--msg-border); border-radius:99px; }
.msg-bubble-wrap { display:flex; align-items:flex-end; gap:8px; }
.msg-bubble-wrap.minha { flex-direction:row-reverse; }
.msg-bubble { max-width:65%; padding:10px 14px; border-radius:16px; font-size:13px; line-height:1.55; word-wrap:break-word; }
.msg-bubble.minha { background:var(--msg-blue); color:#fff; border-bottom-right-radius:4px; }
.msg-bubble.outra { background:var(--msg-surface); color:var(--msg-text); border:1px solid var(--msg-border); border-bottom-left-radius:4px; }
.msg-bubble-hora { font-size:10px; opacity:.65; display:block; margin-top:4px; text-align:right; }
.msg-bubble.outra .msg-bubble-hora { text-align:left; }
.msg-data-sep { text-align:center; font-size:11px; color:var(--msg-sub); margin:4px 0; }
.msg-data-sep span { background:var(--msg-muted); padding:3px 12px; border-radius:99px; border:1px solid var(--msg-border); }
.msg-input-area { background:var(--msg-surface); border-top:1px solid var(--msg-border); padding:12px 20px; flex-shrink:0; }
.msg-input-box { display:flex; align-items:flex-end; gap:10px; background:var(--msg-muted); border:1px solid var(--msg-border); border-radius:14px; padding:10px 14px; transition:border-color .2s; }
.msg-input-box:focus-within { border-color:var(--msg-blue); box-shadow:0 0 0 3px rgba(0,102,204,.1); }
.msg-input-box textarea { flex:1; background:transparent; border:none; outline:none; color:var(--msg-text); font-size:13px; resize:none; max-height:120px; line-height:1.5; font-family:inherit; }
.msg-send-btn { width:38px; height:38px; border-radius:10px; background:var(--msg-blue); color:#fff; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; flex-shrink:0; transition:background .2s,transform .1s; }
.msg-send-btn:hover  { background:#004fa3; }
.msg-send-btn:active { transform:scale(.95); }
.msg-send-btn:disabled { opacity:.5; cursor:default; }
.msg-placeholder { flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; color:var(--msg-sub); text-align:center; padding:40px; background:var(--msg-muted); }
.msg-placeholder i { font-size:56px; margin-bottom:20px; opacity:.2; color:var(--msg-blue); }
.msg-placeholder h3 { font-size:18px; font-weight:700; color:var(--msg-text); margin:0 0 8px; }
.msg-placeholder p  { font-size:13px; margin:0; }
@keyframes bounce { 0%,60%,100%{transform:translateY(0);} 30%{transform:translateY(-6px);} }
@media(max-width:768px) {
    :root { --sidebar-w:100%; }
    .msg-wrap { flex-direction:column; height:auto; }
    .msg-sidebar { width:100%; max-height:260px; border-right:none; border-bottom:1px solid var(--msg-border); }
    .msg-main { height:520px; }
}
</style>
@endsection

@section('conteudo')

{{-- ── Macro: renderiza foto ou fallback ──────────────────── --}}
@php
function avatarHtml(string $nome, ?string $foto, int $size, string $cor = 'azul'): string {
    $inicial = mb_strtoupper(mb_substr($nome, 0, 1));
    if ($foto) {
        $url = asset('storage/' . $foto);
        return "<img src=\"{$url}\" alt=\"{$nome}\" class=\"av\" width=\"{$size}\" height=\"{$size}\" style=\"width:{$size}px;height:{$size}px;\" onerror=\"this.replaceWith(criarFallback('{$inicial}',{$size},'{$cor}'))\">";
    }
    return "<div class=\"av-fallback {$cor}\" style=\"width:{$size}px;height:{$size}px;font-size:" . ($size * 0.38) . "px;\">{$inicial}</div>";
}
// Foto do utilizador logado (paciente)
$foto_eu = session('foto_utilizador');
$nome_eu = session('nome_utilizador') ?? 'Eu';
@endphp

<div class="msg-wrap">

    {{-- ── SIDEBAR ────────────────────────────────────────── --}}
    <div class="msg-sidebar">
        <div class="msg-sidebar-head">
            <p class="msg-sidebar-title">
                <i class="fa-solid fa-comments" style="color:var(--msg-blue);"></i>
                Mensagens
                @if($total_nao_lidas > 0)
                    <span class="badge-total">{{ $total_nao_lidas }}</span>
                @endif
            </p>
            <div class="msg-search">
                <i class="fa-solid fa-magnifying-glass" style="color:var(--msg-sub);font-size:12px;"></i>
                <input type="text" placeholder="Pesquisar médico ou consulta…" oninput="filtrarConsultas(this.value)">
            </div>
        </div>

        <div class="msg-list">
            @forelse($consultas as $c)
            <a href="?consulta={{ $c->id_consulta }}"
               class="msg-item {{ $consulta_sel && $consulta_sel->id_consulta == $c->id_consulta ? 'active' : '' }}"
               data-search="{{ strtolower($c->nome_medico . ' ' . $c->especialidade . ' ' . $c->tipo_consulta) }}">
                <div class="msg-item-top">
                    {!! avatarHtml('Dr. ' . $c->nome_medico, $c->foto_medico ?? null, 38, 'azul') !!}
                    <div class="msg-item-info">
                        <div class="msg-item-nome">Dr. {{ $c->nome_medico }}</div>
                        <div class="msg-item-esp">{{ $c->especialidade ?? $c->tipo_consulta ?? '—' }}</div>
                    </div>
                    @if($c->nao_lidas > 0)
                        <span class="msg-item-badge">{{ $c->nao_lidas > 9 ? '9+' : $c->nao_lidas }}</span>
                    @endif
                </div>
                <div class="msg-item-data">
                    <i class="fa-regular fa-calendar"></i>
                    {{ \Carbon\Carbon::parse($c->data)->format('d/m/Y') }}
                    <span class="msg-item-consulta-tag">#{{ $c->id_consulta }}</span>
                </div>
            </a>
            @empty
            <div class="msg-empty-sidebar">
                <i class="fa-solid fa-stethoscope"></i>
                <p>Sem consultas disponíveis.<br>As mensagens ficam disponíveis após uma consulta.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ── ÁREA PRINCIPAL ─────────────────────────────────── --}}
    <div class="msg-main">

        @if($consulta_sel && $id_util_medico)

            {{-- Header --}}
            <div class="msg-chat-header">
                {!! avatarHtml('Dr. ' . $consulta_sel->nome_medico, $consulta_sel->foto_medico ?? null, 44, 'azul') !!}
                <div class="msg-chat-header-info">
                    <p class="msg-chat-nome">Dr. {{ $consulta_sel->nome_medico }}</p>
                    <p class="msg-chat-sub">{{ $consulta_sel->especialidade ?? 'Médico' }} · Consulta #{{ $consulta_sel->id_consulta }}</p>
                </div>
                <span style="font-size:12px;color:var(--msg-sub);background:var(--msg-muted);padding:4px 12px;border-radius:99px;border:1px solid var(--msg-border);">
                    <i class="fa-solid fa-shield-halved" style="color:var(--msg-green);margin-right:4px;"></i> Conversa segura
                </span>
            </div>

            {{-- Prontuário resumo --}}
            <div class="msg-prontuario">
                <div class="msg-prontuario-item">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Data: <strong>{{ \Carbon\Carbon::parse($consulta_sel->data)->format('d/m/Y') }}</strong></span>
                </div>
                @if($consulta_sel->tipo_consulta)
                <div class="msg-prontuario-item">
                    <i class="fa-solid fa-stethoscope"></i>
                    <span>Tipo: <strong>{{ $consulta_sel->tipo_consulta }}</strong></span>
                </div>
                @endif
                @if($consulta_sel->servico)
                <div class="msg-prontuario-item">
                    <i class="fa-solid fa-briefcase-medical"></i>
                    <span>Serviço: <strong>{{ $consulta_sel->servico }}</strong></span>
                </div>
                @endif
                <div class="msg-prontuario-item">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Estado: <strong>{{ ucfirst($consulta_sel->estado) }}</strong></span>
                </div>
            </div>

            {{-- Bolhas --}}
            <div class="msg-bubbles" id="bubbles">
                @php $dataAnterior = null; @endphp
                @forelse($mensagens as $msg)
                    @php
                        $dataMsg = \Carbon\Carbon::parse($msg->created_at)->format('d/m/Y');
                        $minha   = $msg->id_remetente === $id_util;
                        $fotoB   = $minha ? ($foto_eu ?? null) : ($consulta_sel->foto_medico ?? null);
                        $nomeB   = $minha ? $nome_eu : ('Dr. ' . $consulta_sel->nome_medico);
                        $corB    = $minha ? 'verde' : 'azul';
                    @endphp

                    @if($dataMsg !== $dataAnterior)
                        <div class="msg-data-sep"><span>{{ $dataMsg }}</span></div>
                        @php $dataAnterior = $dataMsg; @endphp
                    @endif

                    <div class="msg-bubble-wrap {{ $minha ? 'minha' : '' }}" data-id="{{ $msg->id_mensagem }}">
                        {!! avatarHtml($nomeB, $fotoB, 30, $corB) !!}
                        <div class="msg-bubble {{ $minha ? 'minha' : 'outra' }}">
                            {{ $msg->conteudo }}
                            <span class="msg-bubble-hora">{{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }}</span>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center;padding:40px;color:var(--msg-sub);font-size:13px;">
                        <i class="fa-regular fa-comment-dots" style="font-size:32px;display:block;margin-bottom:10px;opacity:.3;"></i>
                        Ainda sem mensagens. Inicie a conversa!
                    </div>
                @endforelse
                <div id="typingWrap"></div>
            </div>

            {{-- Input --}}
            <div class="msg-input-area">
                <div class="msg-input-box">
                    <textarea id="msgTexto" rows="1"
                              placeholder="Escreva a sua mensagem…"
                              onkeydown="teclaEnter(event)"
                              oninput="ajustarAltura(this)"></textarea>
                    <button class="msg-send-btn" id="sendBtn" onclick="enviarMensagem()" title="Enviar">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
                <p style="font-size:11px;color:var(--msg-sub);margin:5px 0 0;text-align:right;">
                    <i class="fa-solid fa-lock" style="margin-right:4px;"></i>
                    Mensagens visíveis apenas entre si e o médico
                </p>
            </div>

        @else
            <div class="msg-placeholder">
                <i class="fa-regular fa-comments"></i>
                <h3>Seleccione uma consulta</h3>
                <p>Escolha uma consulta à esquerda para<br>ver ou iniciar uma conversa com o médico.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('script')
<script>
const ID_UTIL         = {{ $id_util }};
const ID_INTERLOCUTOR = {{ $id_util_medico ?? 'null' }};
const ID_CONSULTA     = {{ $consulta_sel->id_consulta ?? 'null' }};
const CSRF            = document.querySelector('meta[name=csrf-token]')?.content ?? '';

// Dados dos avatares para bolhas dinâmicas
const FOTO_EU        = @json($foto_eu ?? null);
const FOTO_MEDICO    = @json($consulta_sel->foto_medico ?? null);
const NOME_EU        = @json($nome_eu);
const NOME_MEDICO    = @json($consulta_sel ? 'Dr. ' . $consulta_sel->nome_medico : '');

let ultimaId = {{ $mensagens->last()->id_mensagem ?? 0 }};

// ── Constrói img ou div fallback no JS ───────────────────────
function criarFallback(inicial, size, cor) {
    const d = document.createElement('div');
    d.className = `av-fallback ${cor}`;
    d.style.cssText = `width:${size}px;height:${size}px;font-size:${size*0.38}px;`;
    d.textContent = inicial;
    return d;
}

function avatarEl(nome, foto, size, cor) {
    if (foto) {
        const img = document.createElement('img');
        img.src = '/storage/' + foto;
        img.alt = nome;
        img.className = 'av';
        img.style.cssText = `width:${size}px;height:${size}px;`;
        img.width = size; img.height = size;
        const inicial = nome.charAt(0).toUpperCase();
        img.onerror = function() { this.replaceWith(criarFallback(inicial, size, cor)); };
        return img;
    }
    return criarFallback(nome.charAt(0).toUpperCase(), size, cor);
}

function scrollFim() {
    const b = document.getElementById('bubbles');
    if (b) b.scrollTop = b.scrollHeight;
}
scrollFim();

// ── Enviar ────────────────────────────────────────────────────
async function enviarMensagem() {
    const textarea = document.getElementById('msgTexto');
    const texto = textarea.value.trim();
    if (!texto || !ID_CONSULTA || !ID_INTERLOCUTOR) return;

    const btn = document.getElementById('sendBtn');
    btn.disabled = true;

    try {
        const resp = await fetch('/api/mensagens/enviar', {
            method: 'POST',
            headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
            body: JSON.stringify({id_consulta:ID_CONSULTA, id_destinatario:ID_INTERLOCUTOR, conteudo:texto}),
        });
        const data = await resp.json();
        if (data.ok) {
            textarea.value = '';
            ajustarAltura(textarea);
            adicionarBolha({id_mensagem:data.id_mensagem, conteudo:texto, hora:data.created_at, minha:true});
            ultimaId = data.id_mensagem;
        }
    } catch(e) { console.error(e); }
    btn.disabled = false;
}

// ── Adicionar bolha ───────────────────────────────────────────
function adicionarBolha({id_mensagem, conteudo, hora, minha}) {
    const bubbles = document.getElementById('bubbles');
    if (!bubbles) return;

    const foto = minha ? FOTO_EU : FOTO_MEDICO;
    const nome = minha ? NOME_EU : NOME_MEDICO;
    const cor  = minha ? 'verde' : 'azul';

    const wrap = document.createElement('div');
    wrap.className = 'msg-bubble-wrap' + (minha ? ' minha' : '');
    wrap.dataset.id = id_mensagem;

    const avEl = avatarEl(nome, foto, 30, cor);

    const bubble = document.createElement('div');
    bubble.className = 'msg-bubble ' + (minha ? 'minha' : 'outra');
    bubble.innerHTML = conteudo.replace(/</g,'&lt;').replace(/>/g,'&gt;')
        + `<span class="msg-bubble-hora">${hora}</span>`;

    wrap.appendChild(avEl);
    wrap.appendChild(bubble);

    const typing = document.getElementById('typingWrap');
    bubbles.insertBefore(wrap, typing);
    scrollFim();
}

// ── Polling ───────────────────────────────────────────────────
async function buscarNovas() {
    if (!ID_CONSULTA || !ID_INTERLOCUTOR) return;
    try {
        const url = `/api/mensagens/novas?id_consulta=${ID_CONSULTA}&id_interlocutor=${ID_INTERLOCUTOR}&ultima_id=${ultimaId}`;
        const data = await (await fetch(url)).json();
        if (data.mensagens?.length) {
            data.mensagens.forEach(m => {
                if (!document.querySelector(`[data-id="${m.id_mensagem}"]`)) {
                    adicionarBolha({...m});
                    ultimaId = Math.max(ultimaId, m.id_mensagem);
                }
            });
        }
    } catch(e) {}
}
if (ID_CONSULTA) setInterval(buscarNovas, 5000);

function filtrarConsultas(q) {
    q = q.toLowerCase();
    document.querySelectorAll('.msg-item').forEach(el => {
        el.style.display = (el.dataset.search||'').includes(q) ? '' : 'none';
    });
}
function teclaEnter(e) {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); enviarMensagem(); }
}
function ajustarAltura(el) {
    el.style.height = 'auto';
    el.style.height = Math.min(el.scrollHeight, 120) + 'px';
}
</script>
@endsection