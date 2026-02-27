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
            <a class="tab active" href="#" style="display: flex; align-items: center; gap:4px;"><i
                    class="fa-regular fa-clipboard"></i> Diagnóstico</a>
            <a class="tab" href="#" style="display: flex; align-items: center; gap:4px;"><i
                    class="fa-solid fa-file-waveform"></i> Exames</a>
            <a class="tab" href="#" style="display: flex; align-items: center; gap:4px;"><i
                    class="fa-solid fa-capsules"></i> Receita</a>
        </div>

        <!-- Diagnóstico -->
        <div class="tab-content active">
            <h3 class="rc-tab-title">Novo Diagnóstico</h3>
            <div class="mb-3">
                <label class="rc-tab-form-label"><i class="fa-regular fa-comment-dots"></i> Descrição do
                    Diagnóstico</label>
                <textarea class="form-control" id="diagnostico-textarea"
                    placeholder="Descreva o diagnóstico, sintomas observados, hipóteses e recomendações..." rows="10"></textarea>
            </div>
            <button class="btn btn-primary" style="width: 100%;" onclick="salvarDiagnostico()">Salvar Diagnóstico</button>

            <div>
                <div class="rc-section-title mt-4">
                    <i class="fa-regular fa-clock"></i> Histórico de Diagnóstico
                </div>
                <div class="rc-history-list" id="historico-diagnosticos">
                </div>
            </div>
        </div>

        <!-- Exames -->
        <div class="tab-content">
            <h3 class="rc-tab-title">Solicitar Exame</h3>
            <div style="display: flex; flex-direction: column;">
                <label class="mt-3 rc-tab-form-label" for="exame-select">Selecionar Exame</label>
                <select id="exame-select" class="form-control rc-tab-form-select mb-4" name="exame-select">
                    <option value="">Escolha um exame</option>
                    @foreach ($exames as $exame)
                    <option value="{{ $exame->id_servico_clinico }}">{{ $exame->nome }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" onclick="adicionarExame()"><i class="fa-solid fa-plus"></i> Adicionar
                    Exame</button>
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
                    <tbody id="tabela-exame">
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
                        <input type="text" class="form-control" id="receitaMedicamento" placeholder="Ex.: Paracetamol">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="rc-tab-form-label">
                            <i class="fa-solid fa-droplet"></i> Dosagem
                        </label>
                        <input type="text" class="form-control" id="receitaDosagem" placeholder="Ex.: 500mg">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="rc-tab-form-label">
                            <i class="fa-solid fa-clock"></i> Frequência
                        </label>
                        <input type="text" class="form-control" id="receitaFrequencia" placeholder="Ex.: 8/8h">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="rc-tab-form-label">
                            <i class="fa-solid fa-calendar"></i> Duração
                        </label>
                        <input type="text" class="form-control" id="receitaDuracao" placeholder="Ex.: 7 dias">
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-green" onclick="adicionarMedicamento()">
                        <i class="fa-solid fa-plus"></i> Adicionar Medicamento
                    </button>
                </div>
            </div>

            <div>
                <div class="rc-section-title">
                    Medicamentos Prescritos
                </div>

                <div class="medication-list mb-3" id="lista-medicamentos">
                    <!-- Lista de medicamentos será carregada aqui -->
                </div>

                <div>
                    <div class="mb-3">
                        <label class="rc-tab-form-label">Observações</label>
                        <textarea class="form-control" id="observacoes-receita" placeholder="Observações adicionais, recomendações, etc..." rows="10">{{ $receita->observacoes ?? '' }}</textarea>
                    </div>
                    <button class="btn btn-primary" style="width: 100%;" onclick="salvarObservacoesReceita()">Salvar Observações</button>
                </div>

                <div class="actions-bar">
                    <button class="btn btn-secondary" onclick="imprimirReceita()">
                        <i class="fa-solid fa-print"></i> Imprimir Receita
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="visualizarExameModal" tabindex="-1" aria-labelledby="visualizarExameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 0px;">
            <div class="modal-header" style="margin-bottom: 0px;">
                <h5 class="modal-title" id="exame-titulo-modal">Nome do Exame</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="" id="exame-id-modal">
                <div class="mb-3">
                    <label class="rc-tab-form-label"><i class="fa-solid fa-file-waveform"></i> Resultado do
                        Exame</label>
                    <textarea class="form-control" id="exame-resultado-modal" placeholder="Descreva o resultado do exame, observações e recomendações..."
                        rows="10"></textarea>

                </div>
                <div class="mb-3">
                    <label class="rc-tab-form-label"><i class="fa-regular fa-comment-dots"></i>Observações
                        Adicionais(opcional)</label>
                    <textarea class="form-control" id="exame-observacoes-modal" placeholder="observações gerais, recomendações ou notas do laboratório..."
                        rows="5"></textarea>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="salvar-resultado-exame-btn" onclick="salvarResultadoExame()">Salvar</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="/tabs.js"></script>
<script>
    const csrfToken = "{{ csrf_token() }}";
    const api = {
        salvarDiagnostico: "{{ route('api_salvar_diagnostico_consulta_medico', ['id_consulta' => $consulta->id_consulta]) }}",
        listarDiagnosticos: "{{ route('api_listar_diagnostico_consulta_medico', ['id_consulta' => $consulta->id_consulta]) }}",
        registroExame: "{{ route('api_registro_exame_consulta_medico', ['id_consulta' => $consulta->id_consulta]) }}",
        salvarResultadoExame: "{{ route('api_salvar_resultado_exame_consulta_medico', ['id_consulta' => $consulta->id_consulta, 'id_exame' => ':id_exame']) }}",
        buscarExame: "{{ route('api_buscar_exame_consulta_medico', ['id_exame' => ':id_exame']) }}",
        listarExames: "{{ route('api_listar_exames_consulta_medico', ['id_consulta' => $consulta->id_consulta]) }}",
        adicionarMedicamento: "{{ route('api_adicionar_medicamento_consulta_medico', ['id_consulta' => $consulta->id_consulta]) }}",
        listarMedicamentos: "{{ route('api_listar_medicamentos_consulta_medico', ['id_consulta' => $consulta->id_consulta]) }}",
        removerMedicamento: "{{ route('api_remover_medicamento_consulta_medico', ['id_consulta' => $consulta->id_consulta, 'id_medicamento' => ':id_medicamento']) }}",
        salvarObservacoesReceita: "{{ route('api_salvar_observacoes_receita_consulta_medico', ['id_consulta' => $consulta->id_consulta]) }}",
        buscarReceita: "{{ route('api_buscar_receita_para_imprimir_consulta_medico', ['id_consulta' => $consulta->id_consulta]) }}"
    }

    function badge_estados(estado) {
        let cor = '#000000'; // Cor padrão
        let estado_nome = '';
        switch (estado) {
            case 'PENDENTE':
                cor = '#f59e0b';
                estado_nome = 'Pendente';
                break;

            case 'REALIZADO':
                cor = '#10b981';
                estado_nome = 'Realizado';
                break;

        }

        return `<span style='padding: 4px 8px; background-color: ${cor}; color: white; border-radius: 4px;'>${estado_nome}</span>`;

    }
</script>
<script src="/realizar-consulta.js"></script>
@endsection
