@extends('layouts.admin')
@section('titulo', 'Registro de tipo de consulta')
@section('conteudo')
    <section class="section active ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Registro de tipo de consulta</strong> </h2>
            <br><br>
            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif

            <form method="post"
                action="{{ route('salvar_registro_tipo_consulta_admin', $tipo_consulta->id_tipo_consulta ?? null) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nome">
                        Nome
                    </label>
                    <input req value="{{ $tipo_consulta->nome ?? '' }}" type="text" id="nome" name="nome" required
                        placeholder="digite o nome do tipo de consulta">
                </div>
                <div class="form-group">
                    <label for="icone">
                        Ícone
                    </label>
                    <input req value="{{ $tipo_consulta->icone ?? '' }}" type="text" id="icone" name="icone" 
                        placeholder="digite o ícone do tipo de consulta">
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="5" placeholder="Detalhes do tipo de consulta">{{ $tipo_consulta->descricao ?? '' }}</textarea>
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
@endsection
