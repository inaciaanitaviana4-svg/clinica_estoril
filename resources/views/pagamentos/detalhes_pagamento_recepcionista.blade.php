@extends('layouts.painel')
@section('titulo', 'detalhes do pagamento')
@section('conteudo')
    <section class="section active painel ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Detalhes do pagamento</strong> </h2>
            <br><br>
            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif

            <div>
                <!-- Informações do paciente -->
                <div class="editar-perfil-section">
                    <div class="coluna-div">
                        <div class="row">

                            {{ label_detalhes($pagamento, 'nome_paciente', 'Paciente', 'col') }}
                        </div>
                            <div class="row">
                            {{ label_detalhes($pagamento, 'data', 'Data', 'col') }}
                            {{ label_detalhes($pagamento, 'metodo_pagamento', 'Método de Pagamento', 'col') }}
                            {{ label_detalhes($pagamento, 'total_pago', 'Total Pago', 'col') }}
                            {{ label_detalhes($pagamento, 'estado', 'Estado', 'col') }}
                        </div>
                    </div>
                </div>
                <!-- Informações de pagamentos -->
                <div class="editar-perfil-section">
                    <h2 class="editar-perfil-section-title">
                        <span class="editar-perfil-section-icon"></span>
                        Itens do pagamento
                    </h2>

                    <div class="table-responsive-sm mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Serviço clínico</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itens_pagamento as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id_item_pagamento }}</th>
                                        <td>{{ $item->nome_servico_clinico }}</td>
                                        <td>{{ number_format($item->valor, 2, ',', '.') }}</td>
                                        <td>{{ $item->quantidade }}</td>
                                        <td>{{ number_format($item->total, 2, ',', '.') }}</td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                      <div class="row mt-4">
                        <form class="col"
                            action="{{ route('mudar_estado_pagamento_recepcionista', $pagamento->id_pagamento) }}"
                            method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="estado" value="cancelado">
                            <button  type="submit" class="btn btn-danger">Cancelar pagamento</button>
                        </form>
                        
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script></script>
@endsection
