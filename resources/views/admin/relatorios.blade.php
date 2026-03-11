@extends('layouts.admin')
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
            <a class="tab" href="#">Prontuários</a>
            <a class="tab" href="#">Pagamentos</a>
            <a class="tab" href="#">Agenda Médica</a>

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
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id_paciente }}">{{ $paciente->nome }}</option>
                            @endforeach
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
                            @foreach ($recepcionistas as $recepcionista)
                                <option value="{{ $recepcionista->id_recepcionista }}">{{ $recepcionista->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_tipo_consulta">
                            Tipo de Consulta
                        </label>
                        <select name="id_tipo_consulta" id="id_tipo_consulta">
                            <option value="">Todos</option>
                            @foreach ($tipos_consultas as $tipo_consulta)
                                <option value="{{ $tipo_consulta->id_tipo_consulta }}">{{ $tipo_consulta->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_servico_clinico">
                            Serviço clinicos
                        </label>
                        <select name="id_servico_clinico" id="id_servico_clinico">
                            <option value="">Todos</option>
                            @foreach ($servicos_clinicos as $servico_clinico)
                                <option value="{{ $servico_clinico->id_servico_clinico }}">{{ $servico_clinico->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="data_inicio">
                            Data de início
                        </label>
                        <input name="data_inicio" id="data_inicio"type="date" />
                    </div>
                    <div class="form-group">
                        <label for="data_fim">
                            Data final
                        </label>
                        <input name="data_fim" id="data_fim" type="date" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-full" id="gerar_relatorio_consultas_btn">
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
                <form>
                    <div class="form-group">
                        <label for="id_paciente">
                            Paciente
                        </label>
                        <select name="id_paciente_prontuario" id="id_paciente_prontuario">
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id_paciente }}">{{ $paciente->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full" id="gerar_relatorio_prontuario_btn">
                        Gerar relatório
                    </button>
                </form>
            </div>
        </div>
        <div class="tab-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Pagamentos</h2>
                </div>
                <form>
                      <div class="form-group">
                        <label for="id_paciente">
                            Paciente
                        </label>
                        <select name="id_paciente" id="id_paciente">
                            <option value="">Todos</option>
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id_paciente }}">{{ $paciente->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estado">
                            Estado
                        </label>
                        <select name="estado" id="estado">
                            <option value="">Todos</option>
                            <option value="cancelada">cancelada</option>
                            <option value="sucesso">sucesso</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_recepcionista">
                            Recepcionista
                        </label>
                        <select name="id_recepcionista" id="id_recepcionista">
                            <option value="">Todos</option>
                            @foreach ($recepcionistas as $recepcionista)
                                <option value="{{ $recepcionista->id_recepcionista }}">{{ $recepcionista->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_servico_clinico">
                            Serviço clinicos
                        </label>
                        <select name="id_servico_clinico" id="id_servico_clinico">
                            <option value="">Todos</option>
                            @foreach ($servicos_clinicos as $servico_clinico)
                                <option value="{{ $servico_clinico->id_servico_clinico }}">{{ $servico_clinico->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_metodo_pagamento">
                            Metodo de pagamento
                        </label>
                        <select name="id_metodo_pagamento" id="id_metodo_pagamento">
                            <option value="">Todos</option>
                            @foreach ($metodos_pagamentos as $metodo_pagamento)
                                <option value="{{ $metodo_pagamento->id_metodo_pagamento}}">{{ $metodo_pagamento->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="data_inicio">
                            Data de início
                        </label>
                        <input name="data_inicio" id="data_inicio"type="date" />
                    </div>
                    <div class="form-group">
                        <label for="data_fim">
                            Data final
                        </label>
                        <input name="data_fim" id="data_fim" type="date" />
                    </div>

                    <button type="submit" class="btn btn-primary btn-full" id="gerar_relatorio_pagamentos_btn">
                        Gerar relatório
                    </button>
                </form>
            </div>
        </div>
        <div class="tab-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Agenda Médica</h2>
                </div>
                <form>
                    <div class="form-group">
                        <label for="id_paciente">
                            Paciente
                        </label>
                        <select name="id_paciente_prontuario" id="id_paciente_prontuario">
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id_paciente }}">{{ $paciente->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full" id="gerar_relatorio_prontuario_btn">
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
    <script src="/relatorio-pagamento.js"></script>
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
         
        const gerar_relatorio_pagamentos_btn = document.getElementById('gerar_relatorio_pagamentos_btn')
        gerar_relatorio_pagamentos_btn.addEventListener('click', async (e) => {
            const id_paciente = document.getElementById('id_paciente').value || null
            const estado = document.getElementById('estado').value || null
            const id_recepcionista = document.getElementById('id_recepcionista').value || null
            const id_metodo_pagamento = document.getElementById('id_metodo_pagamento').value || null
            const id_servico_clinico = document.getElementById('id_servico_clinico').value || null
            const data_inicio = document.getElementById('data_inicio').value || null
            const data_fim = document.getElementById('data_fim').value || null
            const url = "{{ route('api_relatorio_pagamentos') }}" 
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
                        id_metodo_pagamento,
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
                const descricao = ` `

                const logotipo = await obterImagemBase64(logo_url)
                gerarRelatorioPagamentosTabela(dados, {
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
            const id_paciente = document.getElementById('id_paciente_p')
            const rota = "{{ route('api_relatorio_prontuario_paciente', ['id_paciente' => ':id']) }}"
            const url = rota.replace(':id', id_paciente.value)
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
