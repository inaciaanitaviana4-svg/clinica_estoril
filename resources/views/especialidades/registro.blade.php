@extends("layouts.admin")
@section("titulo", "Registro de especialidade")
@section("conteudo")
    <section class="section active ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Registro de especialidade</strong> </h2>
            <br><br>
            @if(session("erro"))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session("erro") }}
                </div>
            @endif

            <form method="post"
                action="{{ route('salvar_registro_especialidade_admin', $especialidade->id_espec ?? null) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nome">
                        Nome
                    </label>
                    <input req value="{{ $especialidade->nome ?? "" }}" type="text" id="nome" name="nome" required
                        placeholder="digite o nome da especialidade">
                </div>


                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="5"
                        placeholder="Detalhes da especialidade">{{ $especialidade->descricao ?? "" }}</textarea>
                </div>
                <div class="form-options">
                    <label class="checkbox-label">
                        <input @checked($especialidade->activo ?? false) type="checkbox" name="activo">
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
@section("script")
    <script src="/tabs.js"></script>
@endsection