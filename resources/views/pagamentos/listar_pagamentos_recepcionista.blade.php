@extends("layouts.painel")
@section("titulo", "Pagamentos")
@section("conteudo")
    <section id="medico" class="section active painel">

        <div id="prontuarios" class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Pagamentos</h2>
                    <a class="btn btn-primary" href="{{ route('mostrar_fazer_pagamento_recepcionista') }}">Fazer Pagamento</a>
                </div>
                @if(session("erro"))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session("erro") }}
                    </div>
                @endif

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Data</th>
                                <th>Paciente</th>
                                <th>Metodo de Pagamento</th>
                                <th>Total Pago</th>
                                <th>Estado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagamentos as $pagamento)

                                <tr>
                                    <td>{{ $pagamento->id_pagamento }}</td>
                                    <td>{{ $pagamento->data }}</td>
                                    <td>{{ $pagamento->nome_paciente }}</td>
                                    <td>{{ $pagamento->metodo_pagamento }}</td>
                                    <td>{{ $pagamento->total_pago }}</td>
                                    <td>{{ badge_estados($pagamento->estado) }}</td>                               
                                    <td>
                                         <a  href="{{ route('detalhes_pagamento_recepcionista',$pagamento->id_pagamento) }}"class="btn  btn-small"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection