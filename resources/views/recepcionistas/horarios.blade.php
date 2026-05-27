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


                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Médico</th>
                                <th>Dia da Semana</th>
                                <th>Hora</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horarios as $horario)
                                <tr>
                                    <td>{{ $horario->nome_medico }}</td>
                                    <td>{{ dia_semana($horario->dia_semana) }}</td>
                                    <td>{{ $horario->hora }}</td>
                                    <td>{{ $horario->activo ? 'Sim' : 'Não' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        const url = "{{ route('remover_horario_medico_recepcionista', ['id_horario' => ':id']) }}"
      const csrfToken = "{{ csrf_token() }}";
      function remover_horario(id_horario) {
        
          mostrarRemoverItemModal(
              url.replace(':id', id_horario), {
                  method: 'DELETE',
                  headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                }
            )
        }
    </script>
@endsection
