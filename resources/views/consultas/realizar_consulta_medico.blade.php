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
                <textarea class="form-control" placeholder="Descreva o diagnóstico, sintomas observados, hipóteses e recomendações..." rows="10"></textarea>
            </div>
            <button class="btn btn-primary" style="width: 100%;">Salvar Diagnóstico</button>

            <div>
                <div class="rc-section-title mt-4">
                    <i class="fa-regular fa-clock"></i> Histórico de Diagnóstico
                </div>
                <div class="rc-history-list">
                    <div class="rc-history-item">
                        <div class="rc-history-meta">
                            <span><i class="fa-regular fa-calendar-days"></i> 15 Jan 2026</span>
                            <span><i class="fa-solid fa-user-doctor"></i> Dr. Miguel Costa</span>
                        </div>
                        <div class="rc-history-content">Paciente apresenta sintomas de gripe comum. Febre baixa (37.8°C), tosse seca e dor de garganta. Sem sinais de complicação respiratória. Recomendado repouso e hidratação adequada. Prescrever analgésico para controle da febre.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exames -->
        <div class="tab-content">
            <h3 class="rc-tab-title">Solicitar Exame</h3>
            <div style="display: flex; flex-direction: column;">
                <label class="mt-3 rc-tab-form-label" for="exame-select">Selecionar Exame</label>
                <select class="form-control rc-tab-form-select mb-4" name="exame-select">
                    <option value="">Escolha um exame</option>
                    @foreach($exames as $exame)
                    <option value="{{ $exame->id_servico_clinico }}">{{ $exame->nome }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Adicionar Exame</button>
            </div>

            <div class="table-responsive-sm mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">EXAME</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col" style="width: 0%;">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="align-content: center;">Hemograma Completo</td>
                            <td style="align-content: center;">{{ badge_estados('pendente') }}</td>
                            <td style="align-content: center;">
                                @if('concluida' !== 'pendente')
                                <button class="btn btn-green"><i class="fa-regular fa-pen-to-square"></i> Ver Resultado</button>
                                @else
                                <button class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Inserir Resultado</button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Receita -->
        <div class="tab-content">
            <h3 class="rc-tab-title">Receita Médica</h3>

            <div class="add-medication-panel">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4 mb-3">
                        <label class="rc-tab-form-label">
                            <i class="fa-solid fa-pills"></i> Medicamento
                        </label>
                        <input type="text" class="form-control" id="medName" placeholder="Ex.: Paracetamol">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="rc-tab-form-label">
                            <i class="fa-solid fa-droplet"></i> Dosagem
                        </label>
                        <input type="text" class="form-control" id="medDosage" placeholder="Ex.: 500mg">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="rc-tab-form-label">
                            <i class="fa-solid fa-clock"></i> Frequência
                        </label>
                        <input type="text" class="form-control" id="medFrequency" placeholder="Ex.: 8/8h">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="rc-tab-form-label">
                            <i class="fa-solid fa-calendar"></i> Duração
                        </label>
                        <input type="text" class="form-control" id="medDuration" placeholder="Ex.: 7 dias">
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-green" onclick="addMedication()">
                        <i class="fa-solid fa-plus"></i> Adicionar Medicamento
                    </button>
                </div>
            </div>

            <div>
                <div class="rc-section-title">
                    Medicamentos Prescritos
                </div>

                <div class="medication-list" id="medicationList">
                    <div class="medication-item">
                        <div class="medication-fields">
                            <div>
                                <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.2rem;">Medicamento</div>
                                <div style="font-weight:500;">Amoxicilina</div>
                            </div>
                            <div>
                                <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.2rem;">Dosagem</div>
                                <div>500mg</div>
                            </div>
                            <div>
                                <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.2rem;">Frequência</div>
                                <div>8/8h</div>
                            </div>
                            <div>
                                <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.2rem;">Duração</div>
                                <div>10 dias</div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-danger" onclick="removeMedication(0)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="actions-bar">
                    <button class="btn btn-primary" onclick="savePrescription()">
                        <i class="fa-regular fa-floppy-disk"></i> Salvar Receita
                    </button>
                    <button class="btn btn-secondary" onclick="printPrescription()">
                        <i class="fa-solid fa-print"></i> Imprimir Receita
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="/tabs.js"></script>
@endsection
