@extends('layouts.painel')
@section('titulo', 'Horários')
@section('conteudo')
    <section id="medico" class="section active">

        <div id="horarios" class="tab-content active">
            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Horários do Médico</h2>
                </div>

                <div class="horarios-grid">
                    @php
                        $horariosPorMedico = $horarios->groupBy('id_medico');
                    @endphp

                    @foreach ($horariosPorMedico as $id_medico => $horariosDoMedico)
                        @php
                            $primeiro = $horariosDoMedico->first();
                            $horariosPorDia = $horariosDoMedico->groupBy('dia_semana');
                            $diasOrdem = [1, 2, 3, 4, 5, 6, 7]; // Segunda a Domingo
                        @endphp

                        <div class="medico-card">
                            {{-- Cabeçalho do médico --}}
                            <div class="medico-card__header">
                                <div class="medico-card__foto-wrapper">
                                    @if (!empty($primeiro->foto))
                                        <img src="{{ asset('storage/' . $primeiro->foto) }}"
                                             alt="Foto de {{ $primeiro->nome_medico }}"
                                             class="medico-card__foto">
                                    @else
                                        <div class="medico-card__foto medico-card__foto--placeholder">
                                            {{ strtoupper(substr($primeiro->nome_medico, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="medico-card__info">
                                    <h3 class="medico-card__nome">{{ $primeiro->nome_medico }}</h3>
                                    @if (!empty($primeiro->especialidade))
                                        <p class="medico-card__especialidade">{{ $primeiro->especialidade }}</p>
                                    @endif
                                    <span class="medico-card__badge">
                                        <span class="badge-dot"></span> Disponível
                                    </span>
                                </div>
                            </div>

                            {{-- Tabela de horários por dia --}}
                            <div class="medico-card__schedule">
                                <p class="medico-card__schedule-label">Próximos horários disponíveis</p>
                                <div class="schedule-grid">
                                    @foreach ($diasOrdem as $diaNumero)
                                        @if (isset($horariosPorDia[$diaNumero]))
                                            <div class="schedule-day">
                                                <div class="schedule-day__name">
                                                    {{ abrev_dia_semana($diaNumero) }}
                                                </div>
                                                <div class="schedule-day__slots">
                                                    @foreach ($horariosPorDia[$diaNumero] as $horario)
                                                        @if ($horario->activo)
                                                            <span class="schedule-slot">
                                                                {{ \Carbon\Carbon::parse($horario->hora)->format('H:i') }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            {{-- Ações --}}
                            <div class="medico-card__actions">
                                @foreach ($horariosDoMedico as $horario)
                                    <div class="horario-row">
                                        <span class="horario-row__info">
                                            {{ dia_semana($horario->dia_semana) }} — {{ $horario->hora }}
                                        </span>
                                        
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection



@section('script')
    <script>
        const url = "{{ route('remover_horario_medico_recepcionista', ['id_horario' => ':id']) }}";
        const csrfToken = "{{ csrf_token() }}";

        function remover_horario(id_horario) {
            mostrarRemoverItemModal(
                url.replace(':id', id_horario), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                }
            );
        }
    </script>
@endsection