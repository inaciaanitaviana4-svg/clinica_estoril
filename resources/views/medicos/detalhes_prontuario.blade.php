@extends('layouts.painel')
@section('titulo', 'Detalhes do Prontuario')
@section('estilo')
<link rel="stylesheet" href="{{ asset('detalhes-prontuario.css') }}">
@endsection
@section('conteudo')

<div class="topbar">
    <a href="{{route('mostrar_prontuarios_medico')}}" class="topbar-back">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Prontuários
    </a>
    <div class="topbar-divider"></div>
    <span class="topbar-title">Detalhes do Prontuário</span>
</div>

<div class="page-container" style="padding-top: 170px;">
    <!-- LEFT: Patient + Consultas -->
    <div>
        <div class="patient-card">
            <div class="patient-card-header">
                <div class="patient-avatar" id="patientInitials">{{ substr($paciente->nome, 0, 1) . substr($paciente->nome, strpos($paciente->nome, ' ') + 1, 1) }}</div>
                <div class="patient-name" id="patientName">{{ $paciente->nome }}</div>
                <div class="patient-sub" id="patientAge">{{ date('Y') - date('Y', strtotime($paciente->data_nascimento)) }} ano(s) · {{ strtolower($paciente->genero) === 'm'?'Masculino':'Feminino' }}</div>
            </div>
            <div class="patient-info-grid">
                <div class="patient-info-item">
                    <label>Telefone</label>
                    <span id="patientPhone">{{ $paciente->num_telefone }}</span>
                </div>
                <div class="patient-info-item">
                    <label>Consultas</label>
                    <span id="patientConsultas">{{ $totalConsultas }} registros</span>
                </div>
                <div class="patient-info-item full">
                    <label>E-mail</label>
                    <span id="patientEmail">{{ $paciente->email }}</span>
                </div>
            </div>

            <div class="consultas-section">
                <div class="consultas-section-title">Consultas</div>
                <div id="consultasList">
                    @foreach($consultas as $consulta)
                    <div class="consulta-item" data-id="{{ $consulta->id }}" onclick="selectConsulta({{$consulta->id_consulta}})">
                        <div class="consulta-item-header">
                            <span class="consulta-date">{{ date('d/m/Y', strtotime($consulta->data)) }} · {{ date('H:i', strtotime($consulta->hora)) }}</span>
                            <div class="badge">
                                {{badge_estados($consulta->estado)}}
                            </div>

                        </div>
                        <div class="consulta-medico">{{ $consulta->nome_medico }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: Detail Panel -->
    <div class="right-panel" id="rightPanel">
        <div class="empty-state">
            <div class="empty-state-icon">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3>Nenhuma consulta selecionada</h3>
            <p>Selecione uma consulta na lista ao lado para visualizar os detalhes.</p>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const csrfToken = "{{ csrf_token() }}";

    const badgeEstados = (estado) => "{{ badge_estados(" + estado + ")}} ";

    // ---- RENDER CONSULTAS LIST ----
    function formatDate(d) {
        const [y, m, day] = d.split('-');
        return `${day}/${m}/${y}`;
    }
    // ---- SELECT CONSULTA ----
    async function selectConsulta(id) {
        const apiUrl = `{{ route('api_buscar_consultas_prontuario_medico', ['id_consulta' => ':id_consulta']) }}`.replace(':id_consulta', id);

        document.querySelectorAll('.consulta-item').forEach(el => el.classList.remove('active'));
        const activeEl = document.querySelector(`.consulta-item[data-id="${id}"]`);
        if (activeEl) activeEl.classList.add('active');



        try {
            const response = await fetch(apiUrl, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error("Erro ao buscar dados da consulta: " + data?.erro || "");
            }

            renderDetail(data);
        } catch (erro) {
            console.log(erro)
        }
    }

    function renderDetail(consulta) {
        const panel = document.getElementById('rightPanel');

        const diagHTML = consulta.diagnosticos.length ?
            consulta.diagnosticos.map(d => `<div class="diag-item"><div class="diag-bullet"></div><div>${d.descricao}</div></div>`).join('') :
            `<div class="no-data">Nenhum diagnóstico registrado.</div>`;

        const examesHTML = consulta.exames.length ?
            `<table class="exames-table">
          <thead><tr>
            <th>Serviço</th>
            <th>Resultado</th>
            <th>Observações</th>
            <th>Status</th>
          </tr></thead>
          <tbody>
          ${consulta.exames.map(e => `
            <tr>
              <td style="font-weight:500">${e.servico_clinico}</td>
              <td>${e.resultado || '—'}</td>
              <td style="color:var(--text-gray);font-size:12px">${e.observacoes || '—'}</td>
              <td>${badge_estados_exames(e.status)}</td>
            </tr>
          `).join('')}
          </tbody>
        </table>` :
            `<div class="no-data">Nenhum exame solicitado.</div>`;

        const receitasHTML = consulta.receitas.length ?
            consulta.receitas.map(r => `
          ${r.observacoes ? `<div class="receita-obs">${r.observacoes}</div>` : ''}
          ${r.itens.map(item => `
            <div class="med-item">
              <div class="med-name">💊 ${item.medicamento}</div>
              <div class="med-detail"><span>Dosagem</span>${item.dosagem}</div>
              <div class="med-detail"><span>Frequência</span>${item.frequencia}</div>
              <div class="med-detail"><span>Duração</span>${item.duracao}</div>
            </div>
          `).join('')}
        `).join('') :
            `<div class="no-data">Nenhuma receita emitida.</div>`;

        panel.innerHTML = `
      <div class="detail-header">
        <div class="detail-header-left">
          <h2>Consulta — ${formatDate(consulta.data)}</h2>
          <div class="detail-meta">
            <div class="meta-chip">
              <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              ${consulta.medico}
            </div>
            <div class="meta-chip">
              <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              ${consulta.hora}
            </div>
            <div>
                ${badge_todos_estados(consulta.estado)}
            </div>
          </div>
          ${consulta.observacao ? `<div class="obs-box">${consulta.observacao}</div>` : ''}
        </div>
      </div>

      <div class="detail-card">
        <div class="detail-card-title">
          <div class="card-icon card-icon-blue">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
          </div>
          Diagnósticos
        </div>
        <div class="detail-card-body">${diagHTML}</div>
      </div>

      <div class="detail-card">
        <div class="detail-card-title">
          <div class="card-icon card-icon-blue">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
          </div>
          Exames Solicitados
        </div>
        <div class="detail-card-body">${examesHTML}</div>
      </div>

      <div class="detail-card">
        <div class="detail-card-title">
          <div class="card-icon card-icon-green">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          Receitas
        </div>
        <div class="detail-card-body">${receitasHTML}</div>
      </div>
    `;
    }
</script>
@endsection
