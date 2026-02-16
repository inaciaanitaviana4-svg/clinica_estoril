@extends('layouts.painel')
@section('titulo', 'fazer pagamento')

@section('estilo')
    <style>
        .btn-submit {
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: .75rem;
            font-weight: 600;
            font-size: 1rem;
            padding: .75rem 2.5rem;
            letter-spacing: .3px;
            transition: opacity .18s, transform .12s, box-shadow .18s;
            box-shadow: 0 4px 18px rgba(10, 92, 92, .25);
        }

        .btn-submit:hover {
            opacity: .9;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(10, 92, 92, .3);
        }

        .btn-clear {
            border-radius: .75rem;
            font-size: .9rem;
            padding: .75rem 1.5rem;
            color: var(--text-muted);
            border-color: var(--border);
        }

        .btn-clear:hover {
            background: var(--muted);
            color: var(--text);
        }

        .btn-delete {
            background: none;
            border: 1.5px solid #e8b4b4;
            color: var(--danger);
            border-radius: .5rem;
            padding: .25rem .55rem;
            font-size: .8rem;
            cursor: pointer;
            transition: background .15s, color .15s;
        }

        .btn-delete:hover {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
        }

        .total-bar {
            background: #0066cc70;
            color: #fff;
            border-radius: .85rem;
            padding: .9rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .total-bar .label {
            font-size: .82rem;
            opacity: .8;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .total-bar .amount {
            font-family: 'DM Serif Display', serif;
            font-size: 1.55rem;
        }
    </style>
@endsection

@section('conteudo')

    <section class="login-section">
        <div class="login-container">
            <!-- Seleção de Tipo de Usuário -->
            <div class="login-card" id="userTypeCard">
                <h2 style="text-align: center;"><strong>fazer pagamento</strong> </h2>
                <br><br>
                @if (session('erro'))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session('erro') }}
                    </div>
                @endif

                <form id="formPagamento" method="post" action="{{ route('salvar_pagamento_recepcionista') }}">
                    {{ csrf_field() }}
                    <span style="text-transform: uppercase">selecione o paciente ou consulta</span>
                    <div class="row">
                        <div class="col form-group">
                            <label for="id_paciente">Paciente</label>
                            <select class="w-100" id="id_paciente" name="id_paciente">
                                <option value="">Selecione o paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id_paciente }}">{{ $paciente->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="id_consulta">Consulta</label>
                            <select class="w-100" id="id_consulta" name="id_consulta">
                                <option value="">Selecione a consulta</option>
                                @foreach ($consultas as $consulta)
                                    <option value="{{ $consulta->id_consulta }}">{{ $consulta->tipo_consulta }} -
                                        {{ $consulta->nome_paciente }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="data">Data</label>
                            <input class="w-100" type="date" id="data" name="data" min="2025-01-01"
                                max="2026-06-20">
                        </div>
                        <div class="col form-group">
                            <label for="id_metodo_pagamento">Método de Pagamento</label>
                            <select class="w-100" id="id_metodo_pagamento" name="id_metodo_pagamento">
                                <option value="">Selecione o método de pagamento</option>
                                @foreach ($metodos_pagamentos as $metodo)
                                    <option value="{{ $metodo->id_metodo_pagamento }}">{{ $metodo->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <h2 class="perfil-section-title">
                        Itens do Pagamento
                    </h2>

                    <div class="row">
                        <div class="col form-group">
                            <label for="id_servico_clinico">Serviço Clínico</label>
                            <select class="w-100" id="servico_clinico_item">
                                <option value="">Selecione o serviço clínico</option>
                                @foreach ($servicos_clinicos as $servico)
                                    <option value="{{ $servico->id_servico_clinico }}" data-preco="{{ $servico->preco }}">
                                        {{ $servico->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="preco">Preço</label>
                            <input disabled name="preco" class="w-100" type="number" placeholder="0,00"
                                id="preco_item" />
                        </div>
                        <div class="col form-group">
                            <label for="quantidade">Quantidade</label>
                            <input class="w-100" type="number" placeholder="1" id="quantidade_item" />
                        </div>
                    </div>
                    <button id="adicionar-itens-pagamento-btn" class="btn btn-secondary">Adicionar</button>
                    <div class="table-responsive-sm mt-2">
                        <div hidden id="erro_item"
                            style="padding: 4px 8px; border-radius: 4px; background-color: red; color:white; width: 100%;">
                            Error</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Serviço clínico</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="tabelaItens">
                                <tr class="empty-row" id="emptyRow">
                                    <td colspan="6" style="text-align: center;">
                                        Nenhum item adicionado ainda
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="total-bar mt-3 mb-3" id="totalBar" style="display:none!important;">
                            <span class="label"><i class="fa-solid fa-calculator"></i>Total dos Itens</span>
                            <div>

                                <span class="amount" id="totalGeral">Kz 0,00</span>
                                <div class="form-group">
                                    <input class="w-100" type="number" id="valor_pago" name="valor_pago" step="0.01"
                                        placeholder="valor pago" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 flex-wrap">
                        <button type="button" class="btn btn-outline-secondary btn-clear mr-2"
                            onclick="limparFormulario()">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>Limpar
                        </button>
                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-check2-circle me-2"></i>Registrar Pagamento
                        </button>
                    </div>
                </form>
            </div>
    </section>
@endsection
@section('script')
    <script>
        let itens = [];
        let contadorItem = 0;

        document.addEventListener('DOMContentLoaded', () => {
            const hoje = new Date().toISOString().split('T')[0];
            document.getElementById('data').value = hoje;
        });

        function formatarMoeda(valor) {
            return valor.toLocaleString('pt-AO', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        const precoItem = document.getElementById('preco_item');
        const quantidadeItem = document.getElementById('quantidade_item');
        const servicoItemSelect = document.getElementById('servico_clinico_item')
        servicoItemSelect.addEventListener("change", (e) => {
            const resultado = getSelectValueText(e.target, "preco")
            precoItem.value = formatarMoeda(resultado.data)
        })

        const adicionarItemBtn = document.getElementById('adicionar-itens-pagamento-btn')
        const erroItem = document.getElementById('erro_item')
        adicionarItemBtn?.addEventListener("click", (e) => {
            e.preventDefault();
            adicionarItem()
        })
        const metodoPagamentoSelect = document.getElementById('id_metodo_pagamento');
        metodoPagamentoSelect.addEventListener("change", (e) => {
            const valorPagoInput = document.getElementById('valor_pago');
            if (e.target.value!=1) {
                valorPagoInput.style.display = 'none';
                valorPagoInput.parentElement.style.display = 'none';
            } else {
                valorPagoInput.style.display = 'block';
                valorPagoInput.value = '';
                valorPagoInput.parentElement.style.display = 'block';
            }
        })

        function renderizarTabela() {
            const tbody = document.getElementById('tabelaItens');
            const emptyR = document.getElementById('emptyRow');
            const totalBar = document.getElementById('totalBar');

            // Limpa linhas de dados (mantém emptyRow)
            tbody.querySelectorAll('tr.item-row').forEach(r => r.remove());

            if (itens.length === 0) {
                emptyR.style.display = '';
                totalBar.style.setProperty('display', 'none', 'important');
                return;
            }

            emptyR.style.display = 'none';
            totalBar.style.removeProperty('display');

            let totalGeral = 0;

            itens.forEach((item, idx) => {
                const total = item.quantidade * item.valor;
                totalGeral += total;

                const tr = document.createElement('tr');
                tr.className = 'item-row';
                tr.innerHTML = `
            <div hidden>
                <input name="itens_pagamento[${idx}][id_servico_clinico]" value="${item.servicoId}" />
                <input name="itens_pagamento[${idx}][quantidade]" value="${item.quantidade}" />
            </div>
        <td><span style="font-weight:600;color:var(--brand);">${idx + 1}</span></td>
        <td data-id='${item.servicoId}'>${item.servico}</td>
        <td class="text-center">
          <span style="background:var(--accent);color:var(--brand);border-radius:.4rem;padding:.1rem .55rem;font-weight:600;">${item.quantidade}</span>
        </td>
        <td class="text-end">${formatarMoeda(item.valor)}</td>
        <td class="text-end" style="font-weight:600;">${formatarMoeda(total)}</td>
        <td class="text-center">
          <button class="btn-delete" title="Remover item" onclick="removerItem(${item.id})">
            <i class="fa-solid fa-trash-can-arrow-up"></i>
          </button>
        </td>
      `;
                tbody.appendChild(tr);
            });

            document.getElementById('totalGeral').textContent = 'Kz ' + formatarMoeda(totalGeral);
        }

        function getSelectValueText(selectElement, attrData) {
            const selectedIndex = selectElement.selectedIndex;
            const selectedOption = selectElement.options[selectedIndex];

            const selectedText = selectedOption.text;
            const selectedValue = selectedOption.value;
            const selectedData = selectedOption.getAttribute(`data-${attrData}`)

            return {
                value: selectedValue,
                text: selectedText,
                data: selectedData
            }
        }

        function adicionarItem() {
            erroItem.setAttribute("hidden", "")

            const servico = getSelectValueText(servicoItemSelect, "preco");
            const quantidade = parseInt(quantidadeItem.value);
            const valor = parseFloat(servico?.data);

            if (!servico?.value) {
                erroItem.removeAttribute("hidden")
                erroItem.innerText = 'Informe o serviço clínico.'
                return;
            }

            if (!quantidade || quantidade < 1) {
                erroItem.removeAttribute("hidden")
                erroItem.innerText = 'Informe uma quantidade válida.'
                return;
            }
            if (!valor || valor <= 0) {
                erroItem.removeAttribute("hidden")
                erroItem.innerText = 'Informe um preço válido.'
                return;
            }

            contadorItem++;
            itens.push({
                id: contadorItem,
                servicoId: servico.value,
                servico: servico.text,
                quantidade,
                valor
            });

            renderizarTabela();

            // Limpar campos do painel
            servicoItemSelect.value = '';
            precoItem.value = '';
            quantidadeItem.value = '1';
            servicoItemSelect.focus();
        }

        function limparFormulario() {
            document.getElementById('formPagamento').reset();
            itens = [];
            contadorItem = 0;
            renderizarTabela();
        }

        function removerItem(id) {
            itens = itens.filter(i => i.id !== id);
            renderizarTabela();
            mostrarToast('Item removido.', 'error');
        }
    </script>
@endsection
