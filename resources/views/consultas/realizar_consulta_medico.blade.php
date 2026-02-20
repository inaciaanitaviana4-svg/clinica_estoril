@extends('layouts.painel')
@section('titulo', 'Realizar Consulta')
@section('conteudo')
<section id="medico" class="section active painel ">

    <div class="card">
        <h2 class="text-primary-color">{{ $paciente->nome }}</h2>
        <div class="row">
            <span class="col"><i class="fa-regular fa-calendar"></i>
                {{ date('Y') - date('Y', strtotime($paciente->data_nascimento)) }} ano(s) </span>
            <span class="col"><i class="fa-solid fa-venus"></i> {{ $paciente->genero }}</span>
            <span class="col"><i class="fa-solid fa-mobile-screen"></i> {{ $paciente->num_telefone }}</span>
            <span class="col"><i class="fa-regular fa-envelope"></i> {{ $paciente->email }}</span>
        </div>
        <div class="row mt-4 p-4" style="background-color: var(--bg-light)">
            <div class="col rc-container">
                <span class="rc-label">Consulta N.º</span>
                <span class="rc-valor">{{ $consulta->id_consulta }}</span>

            </div>
            <div class="col rc-container">
                <span class="rc-label">Data da Consulta</span>
                <span class="rc-valor">{{ $consulta->data }} - {{ $consulta->hora }}</span>

            </div>
            <div class="col rc-container">
                <span class="rc-label">Tipo</span>
                <span class="rc-valor">{{ $consulta->nome_tipo_consulta }}</span>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="tabs">
            <a class="tab active" href="#" style="display: flex; align-items: center; gap:4px;"><i class="fa-regular fa-clipboard"></i> Diagnóstico</a>
            <a class="tab" href="#" style="display: flex; align-items: center; gap:4px;"><i class="fa-solid fa-file-waveform"></i> Exames</a>
            <a class="tab" href="#" style="display: flex; align-items: center; gap:4px;"><i class="fa-solid fa-capsules"></i> Receita</a>
        </div>

        <!-- Diagnóstico -->
        <div class="tab-content active">
            <h3 class="rc-tab-title">Novo Diagnóstico</h3>
            <div class="mb-3">
                <label class="rc-tab-form-label"><i class="fa-regular fa-comment-dots"></i> Descrição do Diagnóstico</label>
                <textarea class="rc-tab-form-control" placeholder="Descreva o diagnóstico, sintomas observados, hipóteses e recomendações..."></textarea>
            </div>
            <button class="btn btn-primary" style="width: 100%;">Salvar Diagnóstico</button>

            <div>
                <div class="rc-section-title mt-4">
                    <i class="fa-regular fa-clock"></i> Histórico de Diagnóstico
                </div>
                <div class="rc-history-list">
                    <div class="rc-history-item">
                        <div class="rc-history-meta">
                            <span><i class="fa-regular fa-calendar-days"></i> 20 Fev 2026</span>
                            <span><i class="fa-solid fa-user-doctor"></i> Dr. Inácia Anita IAV</span>
                        </div>
                        <div class="rc-history-content">Paciente apresenta sintomas de gripe comum. Febre baixa (37.8°C), tosse seca e dor de garganta. Sem sinais de complicação respiratória. Recomendado repouso e hidratação adequada. Prescrever analgésico para controle da febre.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exames -->
        <div class="tab-content">
            <h3 class="rc-tab-title">Solicitar Exame</h3>
        </div>

        <!-- Receita -->
        <div class="tab-content">
            <h3 class="rc-tab-title">Receita Médica</h3>

        </div>
    </div>
</section>
@endsection
@section('script')
<script src="/tabs.js"></script>
@endsection
