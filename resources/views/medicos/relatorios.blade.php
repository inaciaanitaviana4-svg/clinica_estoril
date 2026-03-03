@extends('layouts.painel')
@section('titulo', 'Relatorios')
@section('conteudo')
    <section class="section active painel ">
        @if (session('erro'))
            <div style="background-color:red;color:white;text-align:center">
                {{ session('erro') }}
            </div>
        @endif
        <div class="tabs">
            <a class="tab active" href="#">Consultas</a>
            <a class="tab" href="#">Prontuários</a>

        </div>
        <div class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Consultas</h2>
                </div>
                <form>
                    <div class="form-group">
                        <label for="id_paciente">
                            Paciente
                        </label>
                        <select name="id_paciente" id="id_paciente">
                            <option value="">Todos</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estado">
                            Estado
                        </label>
                        <select name="estado" id="estado">
                            <option value="">Todos</option>
                            <option value="pedente">Pedente</option>
                            <option value="agendada">Agendada</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="cancelada">cancelada</option>
                            <option value="concluida">concluida</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_recepcionista">
                            Recepcionista
                        </label>
                        <select name="id_recepcionista" id="id_recepcionista">
                            <option value="">Todos</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_tipo_consulta">
                            Tipo de Consulta
                        </label>
                        <select name="id_tipo_consulta" id="id_tipo_consulta">
                            <option value="">Todos</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_servico_clinico">
                            Serviço clinicos
                        </label>
                        <select name="id_servico_clinico" id="id_servico_clinico">
                            <option value="">Todos</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="data_inicio">
                            Data de início
                        </label>
                       <input  name="data_inicio" id="data_inicio"type="date"/>
                    </div>
                    <div class="form-group">
                        <label for="data_fim">
                            Data final
                        </label>
                       <input name="data_fim" id="data_fim" type="date"/>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full" onclick="gerar_relatorio_consultas()">
                        Gerar relatório
                    </button>
                </form>
            </div>
        </div>
        <div class="tab-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Prontuários</h2>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
<script src="/tabs.js"></script>
<script src="/relatorio-consultas.js"></script>
<script>
     const url = "{{ route('api_relatorio_consultas') }}"
      const csrfToken = "{{ csrf_token() }}";
      async function gerar_relatorio_consultas() {
        try {
            
        } catch (error) {
            
        }
      }
</script>
@endsection
