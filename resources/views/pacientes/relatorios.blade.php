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
        const rota = "{{ route('api_relatorio_consultas_paciente', ['id_consulta' => ':id_consulta']) }}"
        console.log('rota', rota)
        const logo_url = "{{ asset('imagem/logo.png') }}"
        const csrfToken = "{{ csrf_token() }}";
        const gerar_relatorio_consultas_btn = document.getElementById('gerar_relatorio_consultas_btn')
        gerar_relatorio_consultas_btn.addEventListener('click', async (e) => {
            const id_consulta = document.getElementById('id_consulta').value || null
            const url = rota.replace(':id_consulta', id_consulta)
            try {
                e.preventDefault()
                const resultado = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                })
                const dados = await resultado.json();
                if (!resultado.ok) {
                    throw new Error(
                        dados?.erro || "Erro ao gerar relatório de consultas",
                    );
                }
                const descricao = 'Relatório de Consultas - ' + dados.nome_paciente

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
    </script>
@endsection
