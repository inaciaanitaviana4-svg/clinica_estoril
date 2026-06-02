@extends('layouts.admin')
@section('titulo', 'Cadastros')
@section('conteudo')
    <section class="section active">
        <div class="tabs">
            <a class="tab {{ $tab == '0' ? 'active' : '' }}"
               href="{{ route('mostrar_cadastros_admin', ['tab' => '0']) }}">Utilizadores</a>
            <a class="tab {{ $tab == '1' ? 'active' : '' }}"
               href="{{ route('mostrar_cadastros_admin', ['tab' => '1']) }}">Especialidades</a>
            <a class="tab {{ $tab == '2' ? 'active' : '' }}"
               href="{{ route('mostrar_cadastros_admin', ['tab' => '2']) }}">Tipo de Consultas</a>
            <a class="tab {{ $tab == '3' ? 'active' : '' }}"
               href="{{ route('mostrar_cadastros_admin', ['tab' => '3']) }}">Serviços Clínicos</a>
        </div>

        {{-- TAB 0 — Utilizadores --}}
        <div class="tab-content {{ $tab == '0' ? 'active' : '' }}">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Utilizadores</h2>
                    <a class="btn btn-primary"
                       href="/admin/cadastros/utilizadores/registro">Cadastrar</a>
                </div>
                @if (session('erro'))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session('erro') }}
                    </div>
                @endif
                <form method="GET" action="{{ route('mostrar_cadastros_admin') }}">
                    <input type="hidden" name="tab" value="0">
                    <div class="form-group"
                         style="display:flex;flex-direction:row;gap:8px;margin-top:20px">
                        <input name="pesquisar_utilizador"
                               value="{{ request('pesquisar_utilizador') }}"
                               type="text" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    @if (request('pesquisar_utilizador'))
                        <a style="margin-bottom:12px"
                           href="{{ route('mostrar_cadastros_admin', ['tab' => '0']) }}"
                           class="btn btn-danger">Limpar pesquisa</a>
                    @endif
                </form>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Gênero</th>
                                <th>Nível de acesso</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($utilizadores as $utilizador)
                                <tr>
<td>
    <div style="display:flex; align-items:center; gap:10px;">
        @if($utilizador->foto)
            <img src="{{ asset('storage/' . $utilizador->foto) }}"
                 alt="{{ $utilizador->nome }}"
                 style="width:36px; height:36px; border-radius:50%; object-fit:cover;
                        border:2px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.15);">
        @else
            <div style="width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#667eea,#764ba2);
                        display:flex; align-items:center; justify-content:center;
                        font-size:13px; font-weight:700; color:#fff; flex-shrink:0;
                        box-shadow:0 1px 3px rgba(0,0,0,.15);">
                {{ strtoupper(substr($utilizador->nome, 0, 1)) }}
            </div>
        @endif
        <span>{{ $utilizador->nome }}</span>
    </div>
</td>
                                    <td>{{ $utilizador->email }}</td>
                                    <td>{{ $utilizador->num_telefone }}</td>
                                    <td>{{ $utilizador->genero }}</td>
                                    <td>
                                        @if ($utilizador->nivel_acesso == 0) Administrador
                                        @elseif($utilizador->nivel_acesso == 1) Recepcionista
                                        @elseif($utilizador->nivel_acesso == 2) Médico
                                        @elseif($utilizador->nivel_acesso == 3) Paciente
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button onclick="mostrarRemoverItemModal('{{ route('remover_utilizador_admin', $utilizador->id_util) }}')"
                                                    class="btn btn-bg-red btn-small">Remover</button>
                                            <a href="/admin/cadastros/utilizadores/registro/{{ $utilizador->id_util }}"
                                               class="btn btn-primary btn-small">Editar</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $utilizadores->appends(array_merge(request()->input(), ['tab' => '0']))->links('pagination::bootstrap-4') }}
            </div>
        </div>

        {{-- TAB 1 — Especialidades --}}
        <div class="tab-content {{ $tab == '1' ? 'active' : '' }}">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Especialidades</h2>
                    <a class="btn btn-primary"
                       href="/admin/cadastros/especialidades/registro">Adicionar</a>
                </div>
                <form method="GET" action="{{ route('mostrar_cadastros_admin') }}">
                    <input type="hidden" name="tab" value="1">
                    <div class="form-group"
                         style="display:flex;flex-direction:row;gap:8px;margin-top:20px">
                        <input name="pesquisar_especialidade"
                               value="{{ request('pesquisar_especialidade') }}"
                               type="text" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    @if (request('pesquisar_especialidade'))
                        <a style="margin-bottom:12px"
                           href="{{ route('mostrar_cadastros_admin', ['tab' => '1']) }}"
                           class="btn btn-danger">Limpar pesquisa</a>
                    @endif
                </form>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Activo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($especialidades as $especialidade)
                                <tr>
                                    <td>{{ $especialidade->nome }}</td>
                                    <td>{{ $especialidade->descricao }}</td>
                                    <td>{{ $especialidade->activo ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button onclick="mostrarRemoverItemModal('{{ route('remover_especialidade_admin', $especialidade->id_espec) }}')"
                                                    class="btn btn-bg-red btn-small">Remover</button>
                                            <a href="{{ route('mostrar_registro_especialidade_admin', $especialidade->id_espec) }}"
                                               class="btn btn-primary btn-small">Editar</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $especialidades->appends(array_merge(request()->input(), ['tab' => '1']))->links('pagination::bootstrap-4') }}
            </div>
        </div>

        {{-- TAB 2 — Tipo de Consultas --}}
        <div class="tab-content {{ $tab == '2' ? 'active' : '' }}">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Tipo de Consultas</h2>
                    <a class="btn btn-primary"
                       href="{{ route('mostrar_registro_tipo_consulta_admin') }}">Adicionar</a>
                </div>
                <form method="GET" action="{{ route('mostrar_cadastros_admin') }}">
                    <input type="hidden" name="tab" value="2">
                    <div class="form-group"
                         style="display:flex;flex-direction:row;gap:8px;margin-top:20px">
                        <input name="pesquisar_tipo_consulta"
                               value="{{ request('pesquisar_tipo_consulta') }}"
                               type="text" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    @if (request('pesquisar_tipo_consulta'))
                        <a style="margin-bottom:12px"
                           href="{{ route('mostrar_cadastros_admin', ['tab' => '2']) }}"
                           class="btn btn-danger">Limpar pesquisa</a>
                    @endif
                </form>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipo_consultas as $tipo_consulta)
                                <tr>
                                    <td>{{ $tipo_consulta->nome }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button onclick="mostrarRemoverItemModal('{{ route('remover_tipo_consulta_admin', $tipo_consulta->id_tipo_consulta) }}')"
                                                    class="btn btn-bg-red btn-small">Remover</button>
                                            <a href="{{ route('mostrar_registro_tipo_consulta_admin', $tipo_consulta->id_tipo_consulta) }}"
                                               class="btn btn-primary btn-small">Editar</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $tipo_consultas->appends(array_merge(request()->input(), ['tab' => '2']))->links('pagination::bootstrap-4') }}
            </div>
        </div>

        {{-- TAB 3 — Serviços Clínicos --}}
        <div class="tab-content {{ $tab == '3' ? 'active' : '' }}">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Serviços Clínicos</h2>
                    <a class="btn btn-primary"
                       href="{{ route('mostrar_registro_servico_clinico_admin') }}">Adicionar</a>
                </div>
                <form method="GET" action="{{ route('mostrar_cadastros_admin') }}">
                    <input type="hidden" name="tab" value="3">
                    <div class="form-group"
                         style="display:flex;flex-direction:row;gap:8px;margin-top:20px">
                        <input name="pesquisar_servico_clinico"
                               value="{{ request('pesquisar_servico_clinico') }}"
                               type="text" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    @if (request('pesquisar_servico_clinico'))
                        <a style="margin-bottom:12px"
                           href="{{ route('mostrar_cadastros_admin', ['tab' => '3']) }}"
                           class="btn btn-danger">Limpar pesquisa</a>
                    @endif
                </form>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Tipo de consulta</th>
                                <th>Duração</th>
                                <th>Preço</th>
                                <th>Activo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicos_clinicos as $servico_clinico)
                                <tr>
                                    <td>{{ $servico_clinico->nome }}</td>
                                    <td>{{ $servico_clinico->tipo_consulta }}</td>
                                    <td>{{ $servico_clinico->duracao_min }} min</td>
                                    <td>{{ $servico_clinico->preco }}</td>
                                    <td>{{ $servico_clinico->activo ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button onclick="mostrarRemoverItemModal('{{ route('remover_servico_clinico_admin', $servico_clinico->id_servico_clinico) }}')"
                                                    class="btn btn-bg-red btn-small">Remover</button>
                                            <a href="{{ route('mostrar_registro_servico_clinico_admin', $servico_clinico->id_servico_clinico) }}"
                                               class="btn btn-primary btn-small">Editar</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $servicos_clinicos->appends(array_merge(request()->input(), ['tab' => '3']))->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
@endsection

@section('script')
    {{--<script src="{{ asset('js/tabs.js') }}"></script>--}}
    {{-- Mantém se outras páginas precisarem --}}
@endsection