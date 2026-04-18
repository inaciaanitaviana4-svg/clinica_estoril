@extends('layouts.painel')
@section('titulo', 'Relatorios')
@section('conteudo')
    <section class="section active ">
        @if (session('erro'))
            <div style="background-color:red;color:white;text-align:center">
                {{ session('erro') }}
            </div>
        @endif
        <div class="tabs">
            <a class="tab active" href="#">Consultas</a>

        </div>
        <div class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Consultas</h2>
                </div>
                <form>
                    <div class="form-group">
                        <label for="id_paciente">
                            Consultas do paciente:
                        </label>
                        <select name="id_consulta" id="id_consulta">
                            <option value="">Todos</option>
                            @foreach ($consultas as $consulta)
                                <option value="{{ $consulta->id_consulta }}">
                                    {{ $consulta->tipo_consulta . ' - ' . $consulta->servico_clinico . ' - ' . $consulta->data . ' - ' . $consulta->hora }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full" id="gerar_relatorio_consultas_btn">
                        Gerar relatório
                    </button>
                </form>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script src="/tabs.js"></script>
    <script src="/relatorio-consultas.js"></script>
    <script src="/relatorio-prontuario.js"></script>
    <script>
        const url = "{{ route('api_relatorio_consultas') }}"
        const logo_url = "{{ asset('imagem/logo.png') }}"
        const csrfToken = "{{ csrf_token() }}";
        const gerar_relatorio_consultas_btn = document.getElementById('gerar_relatorio_consultas_btn')
        gerar_relatorio_consultas_btn.addEventListener('click', async (e) => {
            const id_paciente = document.getElementById('id_paciente').value || null
            const estado = document.getElementById('estado').value || null
            const id_recepcionista = document.getElementById('id_recepcionista').value || null
            const id_tipo_consulta = document.getElementById('id_tipo_consulta').value || null
            const id_servico_clinico = document.getElementById('id_servico_clinico').value || null
            const data_inicio = document.getElementById('data_inicio').value || null
            const data_fim = document.getElementById('data_fim').value || null
            try {
                e.preventDefault()
                const resultado = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        id_paciente,
                        estado,
                        id_recepcionista,
                        id_tipo_consulta,
                        id_servico_clinico,
                        data_inicio,
                        data_fim
                    }),
                })
                const dados = await resultado.json();
                if (!resultado.ok) {
                    throw new Error(
                        dados?.erro || "Erro ao gerar relatório de consultas",
                    );
                }
                const descricao = `${data_inicio} - ${data_fim} - ${estado}`

                const logotipo = await obterImagemBase64(logo_url)
                gerarRelatorioConsultasTabela(dados, {
                    logotipo,
                    descricao
                })
            } catch (error) {
                console.error("Erro ao gerar relatório de consultas :", error);
                mostrarMensagemErro(
                    "Ocorreu um erro ao gerar relatório de consultas. Por favor, tente novamente.\n" +
                    error?.message || "",
                );
            }
        })
        const gerar_relatorio_prontuario_btn = document.getElementById('gerar_relatorio_prontuario_btn')
        gerar_relatorio_prontuario_btn.addEventListener('click', async (e) => {
            const id_paciente = document.getElementById('id_paciente_prontuario')
            const data_inicio = document.getElementById('data_inicio_prontuario')
            const data_fim = document.getElementById('data_fim_prontuario')
            const rota =
                "{{ route('api_relatorio_prontuario_paciente', ['id_paciente' => ':id', 'data_inicio' => 'data_inicio_param', 'data_fim' => 'data_fim_param']) }}"
            const url = rota.replace(':id', id_paciente.value)
                .replaceAll('data_inicio_param', data_inicio.value ? encodeURIComponent(data_inicio.value) : '')
                .replaceAll('data_fim_param', data_fim.value ? encodeURIComponent(data_fim.value) : '')
                .replaceAll('amp;', '')
            try {
                e.preventDefault()
                const resultado = await fetch(url, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },

                })
                const dados = await resultado.json();
                if (!resultado.ok) {
                    throw new Error(
                        dados?.erro || "Erro ao gerar relatório de prontuario",
                    );
                }
                const descricao = `${dados.nome} `

                const logotipo = await obterImagemBase64(logo_url)
                gerarRelatorioProntuarioPacienteTabela(dados, {
                    logotipo,
                    descricao
                })
            } catch (error) {
                console.error("Erro ao gerar relatório de prontuario :", error);
                mostrarMensagemErro(
                    "Ocorreu um erro ao gerar relatório de prontuario. Por favor, tente novamente.\n" +
                    error?.message || "",
                );
            }
        })
    </script>
@endsection
