@extends('layouts.admin')
@section('titulo', 'Pagamentos')
@section('conteudo')
    <section id="medico" class="section active">

        <div id="prontuarios" class="tab-content active">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Pagamentos</h2>
                </div>
                @if (session('erro'))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session('erro') }}
                    </div>
                @endif
                <form method="GET" action="{{ route('mostrar_pagamentos_admin') }}">
                    <div class="form-group" style="display:flex;flex-direction:row;gap:8px;margin-top:20px">
                        <input name="pesquisar_pagamentos" value="{{ request('pesquisar_pagamentos') }}" type="text"
                            id="searchInput" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit" id="searchButton"><i
                                class="fa fa-search"></i></button>
                    </div>
                    @if (request('pesquisar_pagamentos'))
                        <a style="margin-bottom: 12px" href="{{ route('mostrar_pagamentos_admin') }}"
                            class="btn btn-danger">Limpar pesquisa</a>
                    @endif
                </form>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Data</th>
                                <th>Paciente</th>
                                <th>Recepcionista</th>
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
                                    <td>{{ $pagamento->nome_recepcionista }}</td>
                                    <td>{{ $pagamento->metodo_pagamento }}</td>
                                    <td>{{ $pagamento->total_pago }}</td>
                                    <td>{{ badge_estados($pagamento->estado) }}</td>
                                    <td>
                                        <button
                                            onclick="mostrarRemoverItemModal('{{ route('remover_pagamento_admin', $pagamento->id_pagamento) }}')"
                                            style="color:red;border:none;background-color:transparent"><i
                                                class="fa fa-trash" aria-hidden="true"></i></button>

                                        <a
                                            href="{{ route('detalhes_pagamentos_admin', $pagamento->id_pagamento) }}"class="btn  btn-small"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $pagamentos->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
@endsection
