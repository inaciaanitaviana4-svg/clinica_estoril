@extends('layouts.admin')
@section('titulo', 'Registro de serviço clínico')
@section('estilo')
    <link rel="stylesheet" href="{{ asset('select2.min.css') }}">
@endsection
@section('conteudo')
    <section class="section active ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Registro de serviço clínico</strong> </h2>
            <br><br>
            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif

            <form method="post"
                action="{{ route('salvar_registro_servico_clinico_admin', $servico_clinico->id_servico_clinico ?? null) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nome">
                        Nome
                    </label>
                    <input req value="{{ $servico_clinico->nome ?? '' }}" type="text" id="nome" name="nome"
                        required placeholder="digite o nome do servico clínico">
                </div>
                <div class="form-group">
                    <label for="tipo_consulta">
                        Tipo de Consulta
                    </label>
                    <select name="id_tipo_consulta" id="id_tipo_consulta" required>
                        <option value="" disabled selected>Selecione o tipo de consulta</option>
                        @foreach ($tipos_consulta as $tipo_consulta)
                            <option value="{{ $tipo_consulta->id_tipo_consulta }}" @selected(($servico_clinico->id_tipo_consulta ?? null) == $tipo_consulta->id_tipo_consulta)>
                                {{ $tipo_consulta->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 1rem;" >
                    <label for="especialidade" style="font-weight: 600">
                        Especialidades
                    </label>
                    <select name="especialidades[]" id="id_especialidade" multiple="multiple" style="width: 100%; padding: 14px; border: 2px solid var(--border-color); border-radius: 4px;">
                        @foreach ($especialidades as $especialidade)
                            <option value="{{ $especialidade->id_especialidade }}">
                                {{ $especialidade->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="duracao">
                        Duração(minutos)
                    </label>
                    <input req value="{{ $servico_clinico->duracao_min ?? '' }}" type="number" id="duracao_min"
                        name="duracao_min" required placeholder="0">
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input req value="{{ $servico_clinico->preco ?? '' }}" type="number" id="preco" name="preco"
                        required placeholder="0">
                </div>
                <div class="form-options">
                    <label class="checkbox-label">
                        <input @checked($servico_clinico->activo ?? false) type="checkbox" name="activo">
                        <span>Activo</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-full">
                    Guardar
                </button>
                <a href="{{ route('mostrar_cadastros_admin') }}" class="btn btn-danger btn-full "
                    style="margin-top: 8px;">Cancelar </a>



            </form>
        </div>
    </section>

@endsection
@section('script')
    <script src="/tabs.js"></script>
    <script src="{{ asset('select2.min.js') }}"></script>
    <script>
        const especialidades = @json($especialidades);
     $(function() {
            $('#id_especialidade').select2({
                placeholder: "Selecione as especialidades",
                data: especialidades.map(e => ({
                    id: e.id_espec,
                    text: e.nome
                }))
            });
        });
    </script>
@endsection
