@extends("layouts.painel")
@section("titulo", "notificações paciente")
@section("conteudo")
    <section class="section active painel">
        <div class="card">
            <div style="border:none;"class="card-header">
                <h2 class="card-title">Notificação</h2>
                <a class="btn btn-primary" href="/ler-todas-notificacoes">Marcar todas</a>
            </div>
        </div>
        <div class="notificacoes-list">
            @foreach($notificacoes as $notificacao)
                <div class="notificacoes-card {{ $notificacao->lida ? '' : 'notificacoes-card--unread' }} ">
                    <div class="notificacoes-card-header">
                        <h3 class="notificacoes-card-title">{{ $notificacao->titulo }}</h3>
                    </div>
                    <p class="notificacoes-card-message">
                        {{$notificacao->mensagem}}
                    </p>
                    <div class="notificacoes-card-footer">
                        <span class="notificacoes-date">{{$notificacao->data}}</span>
                        <a href="/ler-notificacao/{{ $notificacao->id_notificacao }}" class="notificacoes-btn {{ $notificacao->lida ? 'notificacoes-btn--read' : '' }}">Marcar como
                            lida</a>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection